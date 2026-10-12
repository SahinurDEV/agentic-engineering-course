import { Form } from '@inertiajs/react';
import TicketUpdateController from '@/actions/App/Http/Controllers/TicketUpdateController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import type { Option, TicketPriority, TicketStatus } from '@/types';

const statuses: TicketStatus[] = ['open', 'pending', 'resolved', 'closed'];
const priorities: TicketPriority[] = ['low', 'normal', 'high', 'urgent'];

function Field({
    id,
    label,
    defaultValue,
    options,
    error,
}: {
    id: string;
    label: string;
    defaultValue: string;
    options: { value: string; label: string }[];
    error?: string;
}) {
    return (
        <div className="grid gap-2">
            <Label htmlFor={id}>{label}</Label>
            <Select name={id} defaultValue={defaultValue}>
                <SelectTrigger id={id}>
                    <SelectValue />
                </SelectTrigger>
                <SelectContent>
                    {options.map((option) => (
                        <SelectItem key={option.value} value={option.value}>
                            {option.label}
                        </SelectItem>
                    ))}
                </SelectContent>
            </Select>
            <InputError message={error} />
        </div>
    );
}

export function TicketManageForm({
    ticket,
    agents,
}: {
    ticket: {
        id: number;
        status: TicketStatus;
        priority: TicketPriority;
        assignee_id: number | null;
    };
    agents: Option[];
}) {
    return (
        <Form
            {...TicketUpdateController.form(ticket.id)}
            options={{ preserveScroll: true }}
            className="grid gap-4 rounded-xl border p-4 sm:grid-cols-3"
            aria-label="Manage ticket"
        >
            {({ processing, errors }) => (
                <>
                    <Field
                        id="status"
                        label="Status"
                        defaultValue={ticket.status}
                        options={statuses.map((s) => ({ value: s, label: s }))}
                        error={errors.status}
                    />
                    <Field
                        id="priority"
                        label="Priority"
                        defaultValue={ticket.priority}
                        options={priorities.map((p) => ({
                            value: p,
                            label: p,
                        }))}
                        error={errors.priority}
                    />
                    <Field
                        id="assignee_id"
                        label="Assignee"
                        defaultValue={
                            ticket.assignee_id
                                ? String(ticket.assignee_id)
                                : 'none'
                        }
                        options={[
                            { value: 'none', label: 'Unassigned' },
                            ...agents.map((a) => ({
                                value: String(a.id),
                                label: a.name,
                            })),
                        ]}
                        error={errors.assignee_id}
                    />
                    <Button
                        className="sm:col-span-3 sm:justify-self-start"
                        disabled={processing}
                    >
                        Save changes
                    </Button>
                </>
            )}
        </Form>
    );
}
