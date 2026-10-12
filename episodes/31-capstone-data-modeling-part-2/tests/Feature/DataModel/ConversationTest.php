<?php

use App\Models\InternalNote;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;

test('customers and agents both add public replies', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->addReply($ticket->customer, 'It still fails.');
    $ticket->addReply($agent, 'Try the new link.');

    expect($ticket->replies->pluck('author_id')->all())->toBe([$ticket->customer->id, $agent->id]);
});

test('replies never include internal notes', function () {
    $ticket = Ticket::factory()->create();
    $ticket->addReply($ticket->customer, 'Any news?');
    $ticket->addNote(User::factory()->agent()->create(), 'Refund approved by finance.');

    $json = $ticket->load('replies')->toJson();

    expect($ticket->replies)->toHaveCount(1)
        ->and($json)->not->toContain('Refund approved by finance.');
});

test('agents and admins can write internal notes', function () {
    $ticket = Ticket::factory()->create();

    $ticket->addNote(User::factory()->agent()->create(), 'Checked the logs.');
    $ticket->addNote(User::factory()->admin()->create(), 'Escalated.');

    expect($ticket->internalNotes)->toHaveCount(2);
});

test('customers cannot write internal notes', function () {
    $ticket = Ticket::factory()->create();

    expect(fn () => $ticket->addNote($ticket->customer, 'Let me in.'))
        ->toThrow(InvalidArgumentException::class);
    expect(InternalNote::count())->toBe(0);
});

test('replies stay in the order they were written, even after an edit', function () {
    $ticket = Ticket::factory()->create();
    $first = $ticket->addReply($ticket->customer, 'first');
    $ticket->addReply($ticket->customer, 'second');

    $first->update(['body' => 'first, edited']);

    expect($ticket->replies()->pluck('body')->all())->toBe(['first, edited', 'second']);
});

test('a request cannot choose the author', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $reply = $ticket->replies()->create(['body' => 'Hello', 'author_id' => $agent->id]);

    expect($reply->author_id)->toBeNull();
});

test('deleting a ticket deletes its replies and notes', function () {
    $ticket = Ticket::factory()->create();
    $ticket->addReply($ticket->customer, 'Hello');
    $ticket->addNote(User::factory()->agent()->create(), 'Internal');

    $ticket->delete();

    expect(Reply::count())->toBe(0)
        ->and(InternalNote::count())->toBe(0);
});

test('deleting an author keeps their replies and notes, without an author', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $reply = $ticket->addReply($agent, 'On it.');
    $note = $ticket->addNote($agent, 'Customer is a VIP.');

    $agent->delete();

    expect($reply->fresh()->author_id)->toBeNull()
        ->and($note->fresh()->author_id)->toBeNull();
});
