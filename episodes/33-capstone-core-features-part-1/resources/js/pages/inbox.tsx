import { Head, Link, router } from '@inertiajs/react';
import Heading from '@/components/heading';
import { PaginationLinks } from '@/components/pagination-links';
import { TicketList } from '@/components/ticket-list';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { inbox } from '@/routes';
import type { Option, Paginated, TicketListItem } from '@/types';

type Filters = {
    status: string | null;
    priority: string | null;
    category: number | null;
    assignee: number | 'none' | null;
};

const statuses = ['open', 'pending', 'resolved', 'closed'];
const priorities = ['low', 'normal', 'high', 'urgent'];

function FilterSelect({
    label,
    value,
    options,
    onChange,
}: {
    label: string;
    value: string;
    options: { value: string; label: string }[];
    onChange: (value: string) => void;
}) {
    return (
        <Select value={value} onValueChange={onChange}>
            <SelectTrigger aria-label={label} className="w-full sm:w-40">
                <SelectValue />
            </SelectTrigger>
            <SelectContent>
                <SelectItem value="all">Any {label.toLowerCase()}</SelectItem>
                {options.map((option) => (
                    <SelectItem key={option.value} value={option.value}>
                        {option.label}
                    </SelectItem>
                ))}
            </SelectContent>
        </Select>
    );
}

export default function Inbox({
    tickets,
    filters,
    categories,
    agents,
}: {
    tickets: Paginated<TicketListItem>;
    filters: Filters;
    categories: Option[];
    agents: Option[];
}) {
    function apply(key: keyof Filters, value: string) {
        const next = { ...filters, [key]: value === 'all' ? null : value };
        const query = Object.fromEntries(
            Object.entries(next).filter(([, v]) => v !== null),
        );

        router.get(inbox().url, query, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        });
    }

    const filtered = Object.values(filters).some((value) => value !== null);

    return (
        <>
            <Head title="Inbox" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <Heading
                    title="Inbox"
                    description={`${tickets.total} tickets, newest first.`}
                />
                <div className="grid grid-cols-2 gap-2 sm:flex sm:flex-wrap sm:items-center">
                    <FilterSelect
                        label="Status"
                        value={filters.status ?? 'all'}
                        options={statuses.map((s) => ({ value: s, label: s }))}
                        onChange={(value) => apply('status', value)}
                    />
                    <FilterSelect
                        label="Priority"
                        value={filters.priority ?? 'all'}
                        options={priorities.map((p) => ({
                            value: p,
                            label: p,
                        }))}
                        onChange={(value) => apply('priority', value)}
                    />
                    <FilterSelect
                        label="Category"
                        value={
                            filters.category ? String(filters.category) : 'all'
                        }
                        options={categories.map((c) => ({
                            value: String(c.id),
                            label: c.name,
                        }))}
                        onChange={(value) => apply('category', value)}
                    />
                    <FilterSelect
                        label="Assignee"
                        value={
                            filters.assignee ? String(filters.assignee) : 'all'
                        }
                        options={[
                            { value: 'none', label: 'Unassigned' },
                            ...agents.map((a) => ({
                                value: String(a.id),
                                label: a.name,
                            })),
                        ]}
                        onChange={(value) => apply('assignee', value)}
                    />
                    {filtered && (
                        <Link
                            href={inbox()}
                            className="col-span-2 text-sm text-muted-foreground hover:underline"
                        >
                            Clear filters
                        </Link>
                    )}
                </div>
                <TicketList
                    tickets={tickets.data}
                    empty="No tickets match these filters."
                />
                <PaginationLinks page={tickets} />
            </div>
        </>
    );
}

Inbox.layout = {
    breadcrumbs: [{ title: 'Inbox', href: inbox() }],
};
