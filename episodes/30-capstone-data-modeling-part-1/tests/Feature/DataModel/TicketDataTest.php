<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

test('a new ticket is open, normal priority and unassigned', function () {
    $customer = User::factory()->create();

    $ticket = $customer->tickets()->create([
        'subject' => 'Cannot sign in',
        'description' => 'The reset link expired.',
        'category_id' => Category::factory()->create()->id,
    ])->fresh();

    expect($ticket->status)->toBe(TicketStatus::Open)
        ->and($ticket->priority)->toBe(TicketPriority::Normal)
        ->and($ticket->assignee)->toBeNull()
        ->and($ticket->customer->is($customer))->toBeTrue();
});

test('the database refuses a status outside the four', function () {
    $ticket = Ticket::factory()->create();

    DB::table('tickets')->where('id', $ticket->id)->update(['status' => 'reopened']);
})->throws(QueryException::class);

test('the database refuses a priority outside the four', function () {
    $ticket = Ticket::factory()->create();

    DB::table('tickets')->where('id', $ticket->id)->update(['priority' => 'critical']);
})->throws(QueryException::class);

test('deleting an agent unassigns their tickets', function () {
    $agent = User::factory()->agent()->create();
    $ticket = Ticket::factory()->assignedTo($agent)->create();

    $agent->delete();

    expect($ticket->fresh()->assignee_id)->toBeNull();
});

test('deleting a customer deletes their tickets', function () {
    $ticket = Ticket::factory()->create();

    $ticket->customer->delete();

    expect(Ticket::find($ticket->id))->toBeNull();
});

test('a category with tickets cannot be deleted', function () {
    $ticket = Ticket::factory()->create();

    $ticket->category->delete();
})->throws(QueryException::class);
