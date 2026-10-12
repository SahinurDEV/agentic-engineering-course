import { Form, Head } from '@inertiajs/react';
import UserController from '@/actions/App/Http/Controllers/Admin/UserController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { PaginationLinks } from '@/components/pagination-links';
import { Button } from '@/components/ui/button';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { index } from '@/routes/admin/users';
import type { Paginated } from '@/types';

type Role = 'customer' | 'agent' | 'admin';

type UserRow = {
    id: number;
    name: string;
    email: string;
    role: Role;
};

const roles: Role[] = ['customer', 'agent', 'admin'];

export default function Users({ users }: { users: Paginated<UserRow> }) {
    return (
        <>
            <Head title="Users" />
            <div className="flex max-w-3xl flex-1 flex-col gap-6 p-4">
                <Heading
                    title="Users"
                    description="Set each person's role. There is always at least one admin."
                />
                <ul className="divide-y rounded-xl border">
                    {users.data.map((user) => (
                        <li
                            key={user.id}
                            className="flex flex-col gap-3 p-4 sm:flex-row sm:items-center sm:justify-between"
                        >
                            <div className="min-w-0">
                                <p className="truncate font-medium">
                                    {user.name}
                                </p>
                                <p className="truncate text-sm text-muted-foreground">
                                    {user.email}
                                </p>
                            </div>
                            <Form
                                {...UserController.updateRole.form(user.id)}
                                options={{ preserveScroll: true }}
                                className="grid gap-1"
                            >
                                {({ processing, errors }) => (
                                    <>
                                        <div className="flex gap-2">
                                            <Select
                                                name="role"
                                                defaultValue={user.role}
                                            >
                                                <SelectTrigger
                                                    aria-label={`Role of ${user.name}`}
                                                    className="w-32"
                                                >
                                                    <SelectValue />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {roles.map((role) => (
                                                        <SelectItem
                                                            key={role}
                                                            value={role}
                                                        >
                                                            {role}
                                                        </SelectItem>
                                                    ))}
                                                </SelectContent>
                                            </Select>
                                            <Button
                                                variant="outline"
                                                disabled={processing}
                                            >
                                                Save
                                            </Button>
                                        </div>
                                        <InputError message={errors.role} />
                                    </>
                                )}
                            </Form>
                        </li>
                    ))}
                </ul>
                <PaginationLinks page={users} />
            </div>
        </>
    );
}

Users.layout = {
    breadcrumbs: [{ title: 'Users', href: index() }],
};
