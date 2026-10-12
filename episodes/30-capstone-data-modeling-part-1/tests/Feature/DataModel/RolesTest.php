<?php

use App\Enums\Role;
use App\Models\User;

test('a new sign-up is a customer', function () {
    $this->post(route('register.store'), [
        'name' => 'Ana',
        'email' => 'ana@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    expect(User::where('email', 'ana@example.com')->first()->role)->toBe(Role::Customer);
});

test('a sign-up cannot choose its own role', function () {
    $this->post(route('register.store'), [
        'name' => 'Ben',
        'email' => 'ben@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'admin',
    ]);

    expect(User::where('email', 'ben@example.com')->first()->role)->toBe(Role::Customer);
});

test('agents and admins count as agents, customers do not', function () {
    expect(User::factory()->agent()->create()->isAgent())->toBeTrue()
        ->and(User::factory()->admin()->create()->isAgent())->toBeTrue()
        ->and(User::factory()->create()->isAgent())->toBeFalse();
});

test('only admins are admins', function () {
    expect(User::factory()->admin()->create()->isAdmin())->toBeTrue()
        ->and(User::factory()->agent()->create()->isAdmin())->toBeFalse()
        ->and(User::factory()->create()->isAdmin())->toBeFalse();
});
