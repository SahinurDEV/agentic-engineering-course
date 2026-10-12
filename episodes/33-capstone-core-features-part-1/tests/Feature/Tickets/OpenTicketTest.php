<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;

test('a customer opens a ticket', function () {
    $customer = User::factory()->create();
    $category = Category::factory()->create();

    $response = $this->actingAs($customer)->post(route('tickets.store'), [
        'subject' => 'Printer offline',
        'description' => 'It stopped after the update.',
        'category_id' => $category->id,
    ]);

    $ticket = Ticket::sole();
    $response->assertRedirect(route('tickets.show', $ticket));
    expect($ticket->customer_id)->toBe($customer->id)
        ->and($ticket->status)->toBe(TicketStatus::Open)
        ->and($ticket->priority)->toBe(TicketPriority::Normal);
});

test('subject, description and category are required', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('tickets.store'), [])
        ->assertSessionHasErrors(['subject', 'description', 'category_id']);

    expect(Ticket::count())->toBe(0);
});

test('the form cannot choose the customer, status or priority', function () {
    $customer = User::factory()->create();
    $other = User::factory()->create();

    $this->actingAs($customer)->post(route('tickets.store'), [
        'subject' => 'Refund',
        'description' => 'Charged twice.',
        'category_id' => Category::factory()->create()->id,
        'customer_id' => $other->id,
        'status' => 'closed',
        'priority' => 'urgent',
    ]);

    $ticket = Ticket::sole();
    expect($ticket->customer_id)->toBe($customer->id)
        ->and($ticket->status)->toBe(TicketStatus::Open)
        ->and($ticket->priority)->toBe(TicketPriority::Normal);
});

test('agents cannot open tickets', function () {
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)->get(route('tickets.create'))->assertForbidden();
    $this->actingAs($agent)->post(route('tickets.store'), [
        'subject' => 'Test',
        'description' => 'Test',
        'category_id' => Category::factory()->create()->id,
    ])->assertForbidden();
});

test('guests are sent to the login page', function () {
    $this->get(route('tickets.create'))->assertRedirect(route('login'));
});
