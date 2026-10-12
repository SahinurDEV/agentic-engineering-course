<?php

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Testing\AssertableInertia as Assert;

test('agents see every ticket, newest first, 25 per page', function () {
    $tickets = Ticket::factory()->count(26)->create();

    $this->actingAs(User::factory()->agent()->create())->get(route('inbox'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('inbox')
            ->has('tickets.data', 25)
            ->where('tickets.data.0.id', $tickets->last()->id)
            ->where('tickets.last_page', 2));
});

test('the inbox filters by status and priority', function () {
    $match = Ticket::factory()->create(['status' => 'pending', 'priority' => 'urgent']);
    Ticket::factory()->create(['status' => 'pending', 'priority' => 'low']);
    Ticket::factory()->create(['status' => 'open', 'priority' => 'urgent']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['status' => 'pending', 'priority' => 'urgent']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id));
});

test('the inbox filters by category', function () {
    $category = Category::factory()->create();
    $match = Ticket::factory()->for($category)->create();
    Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['category' => $category->id]))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id));
});

test('the inbox filters by assignee, or by no assignee', function () {
    $agent = User::factory()->agent()->create();
    $assigned = Ticket::factory()->assignedTo($agent)->create();
    $unassigned = Ticket::factory()->create();

    $this->actingAs($agent)->get(route('inbox', ['assignee' => $agent->id]))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $assigned->id));

    $this->actingAs($agent)->get(route('inbox', ['assignee' => 'none']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $unassigned->id));
});

test('unknown filter values are ignored', function () {
    Ticket::factory()->count(2)->create();

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['status' => 'deleted', 'priority' => 'x', 'category' => 'abc']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 2)
            ->where('filters.status', null)
            ->where('filters.priority', null));
});

test('page links keep the filters', function () {
    Ticket::factory()->count(26)->create(['status' => 'open']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['status' => 'open']))
        ->assertInertia(fn (Assert $page) => $page
            ->where('tickets.next_page_url', fn (string $url) => str_contains($url, 'status=open')));
});

test('the inbox runs the same number of queries for 3 tickets or 25', function () {
    $agent = User::factory()->agent()->create();
    $countQueries = function () use ($agent) {
        DB::flushQueryLog();
        DB::enableQueryLog();
        $this->actingAs($agent)->get(route('inbox'))->assertOk();

        return count(DB::getQueryLog());
    };

    Ticket::factory()->count(3)->assignedTo($agent)->create();
    $few = $countQueries();
    Ticket::factory()->count(22)->assignedTo($agent)->create();

    expect($countQueries())->toBe($few);
});
