<?php

use App\Enums\TicketStatus;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;

// R10: four customer reply cases and two agent reply cases.

test('1. a customer reply on an open ticket keeps it open', function () {
    $ticket = Ticket::factory()->create(['status' => 'open']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Any news?']);

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open)
        ->and($ticket->replies()->count())->toBe(1)
        ->and($ticket->history()->count())->toBe(0);
});

test('2. a customer reply on a pending ticket sets it to open, logged as the customer', function () {
    $ticket = Ticket::factory()->create(['status' => 'pending']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Here is the screenshot.']);

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open)
        ->and($ticket->history()->sole()->only(['field', 'old_value', 'new_value', 'user_id']))
        ->toBe(['field' => 'status', 'old_value' => 'pending', 'new_value' => 'open', 'user_id' => $ticket->customer_id]);
});

test('3. a customer reply on a resolved ticket sets it to open', function () {
    $ticket = Ticket::factory()->create(['status' => 'resolved']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'It broke again.']);

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open);
});

test('4. a customer reply on a closed ticket is refused', function () {
    $ticket = Ticket::factory()->create(['status' => 'closed']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Hello?'])
        ->assertForbidden();

    expect(Reply::count())->toBe(0)
        ->and($ticket->fresh()->status)->toBe(TicketStatus::Closed);
});

test('5. an agent reply leaves an open, pending or resolved ticket unchanged', function () {
    $agent = User::factory()->agent()->create();

    foreach (['open', 'pending', 'resolved'] as $status) {
        $ticket = Ticket::factory()->create(['status' => $status]);

        $this->actingAs($agent)
            ->post(route('tickets.replies.store', $ticket), ['body' => 'Looking into it.']);

        expect($ticket->fresh()->status->value)->toBe($status)
            ->and($ticket->replies()->count())->toBe(1);
    }
});

test('6. an agent reply on a closed ticket is refused', function () {
    $ticket = Ticket::factory()->create(['status' => 'closed']);

    $this->actingAs(User::factory()->agent()->create())
        ->post(route('tickets.replies.store', $ticket), ['body' => 'One more thing.'])
        ->assertForbidden();

    expect(Reply::count())->toBe(0);
});
