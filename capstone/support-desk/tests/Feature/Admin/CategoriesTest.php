<?php

use App\Models\Category;
use App\Models\User;

test('an admin creates a category', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->post(route('admin.categories.store'), ['name' => 'Shipping'])
        ->assertRedirect();

    expect(Category::sole()->name)->toBe('Shipping');
});

test('a category name is required and unique', function () {
    $admin = User::factory()->admin()->create();
    Category::factory()->create(['name' => 'Billing']);

    $this->actingAs($admin)
        ->post(route('admin.categories.store'), ['name' => ''])
        ->assertSessionHasErrors('name');
    $this->actingAs($admin)
        ->post(route('admin.categories.store'), ['name' => 'Billing'])
        ->assertSessionHasErrors('name');

    expect(Category::count())->toBe(1);
});

test('an admin renames a category', function () {
    $category = Category::factory()->create(['name' => 'Billing']);

    $this->actingAs(User::factory()->admin()->create())
        ->patch(route('admin.categories.update', $category), ['name' => 'Payments'])
        ->assertRedirect();

    expect($category->fresh()->name)->toBe('Payments');
});

test('an admin archives a category instead of deleting it', function () {
    $category = Category::factory()->create();

    $this->actingAs(User::factory()->admin()->create())
        ->post(route('admin.categories.archive', $category))
        ->assertRedirect();

    expect($category->fresh()->archived_at)->not->toBeNull()
        ->and(Category::count())->toBe(1);
});

test('agents and customers cannot manage categories', function () {
    $category = Category::factory()->create(['name' => 'Billing']);

    foreach ([User::factory()->agent()->create(), User::factory()->create()] as $user) {
        $this->actingAs($user)->get(route('admin.categories.index'))->assertForbidden();
        $this->actingAs($user)->post(route('admin.categories.store'), ['name' => 'New'])->assertForbidden();
        $this->actingAs($user)->post(route('admin.categories.archive', $category))->assertForbidden();
    }

    expect(Category::count())->toBe(1)
        ->and($category->fresh()->archived_at)->toBeNull();
});
