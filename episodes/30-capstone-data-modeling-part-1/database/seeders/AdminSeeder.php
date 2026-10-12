<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Create the first admin. Asks for the details, so no password lives in the repo.
     */
    public function run(CreateNewUser $creator): void
    {
        if (User::where('role', Role::Admin)->exists()) {
            $this->command->info('An admin already exists. Nothing to do.');

            return;
        }

        $admin = $creator->create([
            'name' => $this->command->ask('Admin name', 'Admin'),
            'email' => $this->command->ask('Admin email'),
            'password' => $this->command->secret('Admin password'),
            'password_confirmation' => $this->command->secret('Confirm the password'),
        ]);

        $admin->role = Role::Admin;
        $admin->save();
        $admin->markEmailAsVerified();

        $this->command->info("Admin created: {$admin->email}");
    }
}
