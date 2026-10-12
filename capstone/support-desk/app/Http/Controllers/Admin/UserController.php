<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Every user and their role, 25 per page, admins first, then agents (R12).
     */
    public function index(): Response
    {
        return Inertia::render('admin/users', [
            'users' => User::query()
                ->orderByRaw("case role when 'admin' then 0 when 'agent' then 1 else 2 end")
                ->orderBy('name')
                ->paginate(25)
                ->through(fn (User $user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ]),
        ]);
    }

    /**
     * Set a role. The last admin keeps the admin role (decision D2).
     */
    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        $role = Role::from($request->validated('role'));

        DB::transaction(function () use ($user, $role) {
            $admins = User::query()->where('role', Role::Admin)->lockForUpdate()->pluck('id');

            if ($admins->count() === 1 && $admins->contains($user->id) && $role !== Role::Admin) {
                throw ValidationException::withMessages([
                    'role' => __('There must always be at least one admin.'),
                ]);
            }

            $user->role = $role;
            $user->save();
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Role updated.')]);

        return back();
    }
}
