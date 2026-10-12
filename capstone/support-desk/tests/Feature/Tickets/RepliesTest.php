<?php

use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;

test('a customer replies on their own ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Still broken.'])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->replies()->sole()->author_id)->toBe($ticket->customer_id);
});

test('an agent replies on any ticket', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Try the new driver.'])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->replies()->sole()->author_id)->toBe($agent->id);
});

test('a customer cannot reply on another customer\'s ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->create())
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Hello'])
        ->assertNotFound();

    expect(Reply::count())->toBe(0);
});

test('a reply needs a body', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => ''])
        ->assertSessionHasErrors('body');

    expect(Reply::count())->toBe(0);
});

test('the request cannot choose the author', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Hi', 'author_id' => $agent->id]);

    expect($ticket->replies()->sole()->author_id)->toBe($ticket->customer_id);
});
