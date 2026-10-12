<?php

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\LazyLoadingViolationException;
use Illuminate\Support\Facades\Schema;

test('the inbox, filter and search indexes exist', function () {
    expect(Schema::hasIndex('tickets', ['customer_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('tickets', ['assignee_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('tickets', ['category_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('tickets', 'tickets_subject_fulltext'))->toBeTrue()
        ->and(Schema::hasIndex('replies', ['ticket_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('replies', 'replies_body_fulltext'))->toBeTrue()
        ->and(Schema::hasIndex('internal_notes', ['ticket_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('ticket_changes', ['ticket_id', 'id']))->toBeTrue();
});

test('search finds tickets with every word in the subject', function () {
    Ticket::factory()->create(['subject' => 'Printer offline']);
    $jam = Ticket::factory()->create(['subject' => 'Printer jam on floor two']);

    expect(Ticket::search('printer jam')->pluck('id')->all())->toBe([$jam->id]);
});

test('search finds a word in a reply', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $ticket->addReply($ticket->customer, 'The invoice shows the wrong address.');

    expect(Ticket::search('invoice')->pluck('id')->all())->toBe([$ticket->id]);
});

test('search ignores words that are only in an internal note', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $ticket->addNote(User::factory()->agent()->create(), 'Finance approved a chargeback.');

    expect(Ticket::search('chargeback')->count())->toBe(0);
});

test('search matches other forms of a word', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Refund for order 1042']);

    expect(Ticket::search('refunds')->pluck('id')->all())->toBe([$ticket->id]);
});

test('lazy loading a relationship on a list of tickets throws', function () {
    Ticket::factory()->count(2)->create();

    $tickets = Ticket::all();
    expect(fn () => $tickets->first()->customer)
        ->toThrow(LazyLoadingViolationException::class);

    $tickets = Ticket::with('customer')->get();
    expect($tickets->first()->customer)->toBeInstanceOf(User::class);
});
