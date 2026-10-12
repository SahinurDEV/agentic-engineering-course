<?php

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('the new ticket form lists active categories only', function () {
    Category::factory()->create(['name' => 'Billing']);
    Category::factory()->create(['name' => 'Legacy', 'archived_at' => now()]);

    $this->actingAs(User::factory()->create())
        ->get(route('tickets.create'))
        ->assertInertia(fn (Assert $page) => $page
            ->has('categories', 1)
            ->where('categories.0.name', 'Billing'));
});

test('a ticket cannot be opened in an archived category', function () {
    $archived = Category::factory()->create(['archived_at' => now()]);

    $this->actingAs(User::factory()->create())
        ->post(route('tickets.store'), [
            'subject' => 'Old thing',
            'description' => 'Still broken.',
            'category_id' => $archived->id,
        ])
        ->assertSessionHasErrors('category_id');

    expect(Ticket::count())->toBe(0);
});

test('existing tickets keep an archived category', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create(['category_id' => $category->id]);

    $this->actingAs(User::factory()->admin()->create())
        ->post(route('admin.categories.archive', $category));

    expect($ticket->fresh()->category_id)->toBe($category->id);
});
