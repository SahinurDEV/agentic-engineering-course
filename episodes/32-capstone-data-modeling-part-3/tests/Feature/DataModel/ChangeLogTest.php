<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketChange;
use App\Models\User;

test('changing the status logs the old and new value, who and when', function () {
    $this->freezeSecond();
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->changeStatus($agent, TicketStatus::Pending);

    $change = $ticket->history->sole();
    expect($ticket->fresh()->status)->toBe(TicketStatus::Pending)
        ->and($change->only(['field', 'old_value', 'new_value', 'user_id']))
        ->toBe(['field' => 'status', 'old_value' => 'open', 'new_value' => 'pending', 'user_id' => $agent->id])
        ->and($change->created_at->equalTo(now()))->toBeTrue();
});

test('changing the priority is logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->changePriority($agent, TicketPriority::Urgent);

    expect($ticket->history->sole()->only(['field', 'old_value', 'new_value']))
        ->toBe(['field' => 'priority', 'old_value' => 'normal', 'new_value' => 'urgent']);
});

test('assigning and unassigning are both logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->assignTo($agent, $agent);
    $ticket->assignTo($agent, null);

    expect($ticket->history->map->only(['field', 'old_value', 'new_value'])->all())->toBe([
        ['field' => 'assignee', 'old_value' => null, 'new_value' => (string) $agent->id],
        ['field' => 'assignee', 'old_value' => (string) $agent->id, 'new_value' => null],
    ]);
});

test('setting a value the ticket already has logs nothing', function () {
    $ticket = Ticket::factory()->create();

    $ticket->changeStatus(User::factory()->agent()->create(), TicketStatus::Open);

    expect($ticket->history)->toHaveCount(0);
});

test('only agents can be assigned', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    expect(fn () => $ticket->assignTo($agent, $ticket->customer))
        ->toThrow(InvalidArgumentException::class);

    expect($ticket->fresh()->assignee_id)->toBeNull()
        ->and(TicketChange::count())->toBe(0);
});

test('deleting the person who made a change keeps the entry, without them', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $ticket->changePriority($agent, TicketPriority::High);

    $agent->delete();

    $change = TicketChange::sole();
    expect($change->user_id)->toBeNull()
        ->and($change->new_value)->toBe('high');
});

test('deleting a ticket deletes its history', function () {
    $ticket = Ticket::factory()->create();
    $ticket->changeStatus(User::factory()->agent()->create(), TicketStatus::Resolved);

    $ticket->delete();

    expect(TicketChange::count())->toBe(0);
});
