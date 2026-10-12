<?php

use App\Models\InternalNote;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('an agent adds an internal note', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->post(route('tickets.notes.store', $ticket), ['body' => 'Customer is on the refund watch list.'])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->internalNotes()->sole()->author_id)->toBe($agent->id);
});

test('agents see internal notes on the ticket page', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $ticket->addNote($agent, 'Check the billing system first.');

    $this->actingAs($agent)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page
            ->has('notes', 1)
            ->where('notes.0.body', 'Check the billing system first.')
            ->where('notes.0.author', $agent->name));
});

test('a customer cannot add a note, even on their own ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.notes.store', $ticket), ['body' => 'Hello'])
        ->assertForbidden();

    $this->actingAs($ticket->customer)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page->where('notes', null));

    expect(InternalNote::count())->toBe(0);
});

test('a note needs a body', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->post(route('tickets.notes.store', $ticket), ['body' => ''])
        ->assertSessionHasErrors('body');

    expect(InternalNote::count())->toBe(0);
});
