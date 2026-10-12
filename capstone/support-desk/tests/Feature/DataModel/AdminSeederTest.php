<?php

use App\Enums\Role;
use App\Models\User;
use Database\Seeders\AdminSeeder;

test('the seeder creates the first admin', function () {
    $this->artisan('db:seed', ['--class' => AdminSeeder::class])
        ->expectsQuestion('Admin name', 'Sam')
        ->expectsQuestion('Admin email', 'sam@example.com')
        ->expectsQuestion('Admin password', 'a-long-Passw0rd')
        ->expectsQuestion('Confirm the password', 'a-long-Passw0rd')
        ->assertSuccessful();

    expect(User::where('email', 'sam@example.com')->first()->role)->toBe(Role::Admin);
});

test('the seeder does nothing when an admin exists', function () {
    User::factory()->admin()->create();

    $this->artisan('db:seed', ['--class' => AdminSeeder::class])->assertSuccessful();

    expect(User::where('role', Role::Admin)->count())->toBe(1);
});
