<?php

use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('agents search by words in the subject', function () {
    $match = Ticket::factory()->create(['subject' => 'Printer jam on floor two']);
    Ticket::factory()->create(['subject' => 'Printer offline']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'printer jam']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id)
            ->where('filters.q', 'printer jam'));
});

test('agents search by words in a reply', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $ticket->addReply($ticket->customer, 'The invoice shows the wrong address.');
    Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'invoice']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $ticket->id));
});

test('search does not look in internal notes', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $agent = User::factory()->agent()->create();
    $ticket->addNote($agent, 'Finance approved a chargeback.');

    $this->actingAs($agent)
        ->get(route('inbox', ['q' => 'chargeback']))
        ->assertInertia(fn (Assert $page) => $page->has('tickets.data', 0));
});

test('search combines with the filters', function () {
    $match = Ticket::factory()->create(['subject' => 'Refund request', 'status' => 'pending']);
    Ticket::factory()->create(['subject' => 'Refund request', 'status' => 'open']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'refund', 'status' => 'pending']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id));
});

test('page links keep the search', function () {
    Ticket::factory()->count(26)->create(['subject' => 'Refund request']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'refund']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 25)
            ->where('tickets.next_page_url', fn (string $url) => str_contains($url, 'q=refund')));
});
