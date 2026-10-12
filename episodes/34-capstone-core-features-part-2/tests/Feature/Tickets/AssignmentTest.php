<?php

use App\Models\Ticket;
use App\Models\User;

test('an agent assigns a ticket to any agent, and it is logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $other = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->patch(route('tickets.update', $ticket), ['assignee_id' => $other->id])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->fresh()->assignee_id)->toBe($other->id)
        ->and($ticket->history()->sole()->only(['field', 'new_value', 'user_id']))
        ->toBe(['field' => 'assignee', 'new_value' => (string) $other->id, 'user_id' => $agent->id]);
});

test('an agent unassigns a ticket', function () {
    $agent = User::factory()->agent()->create();
    $ticket = Ticket::factory()->assignedTo($agent)->create();

    $this->actingAs($agent)->patch(route('tickets.update', $ticket), ['assignee_id' => 'none']);

    expect($ticket->fresh()->assignee_id)->toBeNull();
});

test('a customer cannot be assigned', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->patch(route('tickets.update', $ticket), ['assignee_id' => $ticket->customer_id])
        ->assertSessionHasErrors('assignee_id');

    expect($ticket->fresh()->assignee_id)->toBeNull()
        ->and($ticket->history()->count())->toBe(0);
});

test('a customer cannot assign their own ticket', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($ticket->customer)
        ->patch(route('tickets.update', $ticket), ['assignee_id' => $agent->id])
        ->assertForbidden();

    expect($ticket->fresh()->assignee_id)->toBeNull();
});
