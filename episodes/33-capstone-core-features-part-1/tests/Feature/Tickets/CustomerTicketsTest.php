<?php

use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('a customer sees only their own tickets, newest first', function () {
    $customer = User::factory()->create();
    $older = Ticket::factory()->for($customer, 'customer')->create();
    $newer = Ticket::factory()->for($customer, 'customer')->create();
    Ticket::factory()->create();

    $this->actingAs($customer)->get(route('tickets.index'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('tickets/index')
            ->has('tickets.data', 2)
            ->where('tickets.data.0.id', $newer->id)
            ->where('tickets.data.1.id', $older->id));
});

test('a customer cannot open another customer\'s ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('tickets.show', $ticket))
        ->assertNotFound();
});

test('the ticket page never includes internal notes', function () {
    $ticket = Ticket::factory()->create();
    $ticket->addReply($ticket->customer, 'Any news?');
    $ticket->addNote(User::factory()->agent()->create(), 'Customer is on the refund watch list.');

    $this->actingAs($ticket->customer)->get(route('tickets.show', $ticket))
        ->assertOk()
        ->assertSee('Any news?')
        ->assertDontSee('refund watch list');
});

test('customers cannot open the inbox', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('inbox'))
        ->assertForbidden();
});
