<?php

use App\Enums\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('an admin sets a user role', function () {
    $user = User::factory()->create();

    $this->actingAs(User::factory()->admin()->create())
        ->patch(route('admin.users.role', $user), ['role' => 'agent'])
        ->assertRedirect();

    expect($user->fresh()->role)->toBe(Role::Agent);
});

test('agents and customers cannot change roles', function () {
    $user = User::factory()->create();

    foreach ([User::factory()->agent()->create(), $user] as $actor) {
        $this->actingAs($actor)->get(route('admin.users.index'))->assertForbidden();
        $this->actingAs($actor)
            ->patch(route('admin.users.role', $user), ['role' => 'admin'])
            ->assertForbidden();
    }

    expect($user->fresh()->role)->toBe(Role::Customer);
});

test('an unknown role is refused', function () {
    $user = User::factory()->create();

    $this->actingAs(User::factory()->admin()->create())
        ->patch(route('admin.users.role', $user), ['role' => 'owner'])
        ->assertSessionHasErrors('role');

    expect($user->fresh()->role)->toBe(Role::Customer);
});

test('the last admin cannot remove their own admin role', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.role', $admin), ['role' => 'agent'])
        ->assertSessionHasErrors(['role' => 'There must always be at least one admin.']);

    expect($admin->fresh()->role)->toBe(Role::Admin);
});

test('with two admins, one can step down', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.role', $admin), ['role' => 'agent'])
        ->assertSessionHasNoErrors();

    expect($admin->fresh()->role)->toBe(Role::Agent);
});

test('the users page lists admins first, then agents', function () {
    User::factory()->create(['name' => 'Aaron Customer']);
    User::factory()->agent()->create(['name' => 'Bea Agent']);
    $admin = User::factory()->admin()->create(['name' => 'Zed Admin']);

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertInertia(fn (Assert $page) => $page
            ->where('users.data.0.name', 'Zed Admin')
            ->where('users.data.1.name', 'Bea Agent')
            ->where('users.data.2.name', 'Aaron Customer'));
});
