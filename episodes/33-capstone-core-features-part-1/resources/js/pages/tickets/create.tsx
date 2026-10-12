import { Form, Head } from '@inertiajs/react';
import TicketController from '@/actions/App/Http/Controllers/TicketController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { create, index } from '@/routes/tickets';
import type { Option } from '@/types';

export default function CreateTicket({ categories }: { categories: Option[] }) {
    return (
        <>
            <Head title="New ticket" />
            <div className="flex max-w-2xl flex-1 flex-col p-4">
                <Heading
                    title="New ticket"
                    description="Tell us what went wrong. An agent will reply here."
                />
                <Form {...TicketController.store.form()} className="space-y-6">
                    {({ processing, errors }) => (
                        <>
                            <div className="grid gap-2">
                                <Label htmlFor="subject">Subject</Label>
                                <Input
                                    id="subject"
                                    name="subject"
                                    required
                                    maxLength={255}
                                />
                                <InputError message={errors.subject} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="category_id">Category</Label>
                                <Select name="category_id" required>
                                    <SelectTrigger id="category_id">
                                        <SelectValue placeholder="Choose a category" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {categories.map((category) => (
                                            <SelectItem
                                                key={category.id}
                                                value={String(category.id)}
                                            >
                                                {category.name}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <InputError message={errors.category_id} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="description">Description</Label>
                                <textarea
                                    id="description"
                                    name="description"
                                    required
                                    rows={6}
                                    className="rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-xs md:text-sm"
                                />
                                <InputError message={errors.description} />
                            </div>

                            <Button disabled={processing}>Open ticket</Button>
                        </>
                    )}
                </Form>
            </div>
        </>
    );
}

CreateTicket.layout = {
    breadcrumbs: [
        { title: 'My tickets', href: index() },
        { title: 'New ticket', href: create() },
    ],
};
