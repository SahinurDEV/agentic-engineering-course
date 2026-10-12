<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;

test('an agent changes status and priority, and both are logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->patch(route('tickets.update', $ticket), ['status' => 'pending', 'priority' => 'urgent'])
        ->assertRedirect(route('tickets.show', $ticket));

    $ticket->refresh();
    expect($ticket->status)->toBe(TicketStatus::Pending)
        ->and($ticket->priority)->toBe(TicketPriority::Urgent)
        ->and($ticket->history->map->only(['field', 'old_value', 'new_value', 'user_id'])->all())->toBe([
            ['field' => 'status', 'old_value' => 'open', 'new_value' => 'pending', 'user_id' => $agent->id],
            ['field' => 'priority', 'old_value' => 'normal', 'new_value' => 'urgent', 'user_id' => $agent->id],
        ]);
});

test('a customer cannot change status or priority', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->patch(route('tickets.update', $ticket), ['status' => 'closed'])
        ->assertForbidden();

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open);
});

test('an unknown status is refused', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->patch(route('tickets.update', $ticket), ['status' => 'deleted'])
        ->assertSessionHasErrors('status');

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open);
});
