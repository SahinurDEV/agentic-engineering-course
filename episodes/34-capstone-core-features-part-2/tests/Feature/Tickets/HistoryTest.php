<?php

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('the ticket page shows each change with who made it', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create(['name' => 'Alex Agent']);
    $ticket->changeStatus($agent, TicketStatus::Pending);

    $this->actingAs($agent)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page
            ->has('history', 1)
            ->where('history.0.field', 'status')
            ->where('history.0.old', 'open')
            ->where('history.0.new', 'pending')
            ->where('history.0.user', 'Alex Agent'));
});

test('assignee changes show names, and the customer sees the history too', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create(['name' => 'Alex Agent']);
    $ticket->assignTo($agent, $agent);

    $this->actingAs($ticket->customer)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page
            ->where('history.0.field', 'assignee')
            ->where('history.0.old', null)
            ->where('history.0.new', 'Alex Agent'));
});

test('a deleted assignee shows as a deleted user', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $gone = User::factory()->agent()->create();
    $ticket->assignTo($agent, $gone);
    $gone->delete();

    $this->actingAs($agent)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page->where('history.0.new', 'Deleted user'));
});
