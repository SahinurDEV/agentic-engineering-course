import { Link } from '@inertiajs/react';
import { PriorityBadge, StatusBadge } from '@/components/ticket-badges';
import { show } from '@/routes/tickets';
import type { TicketListItem } from '@/types';

function details(ticket: TicketListItem): string {
    const parts = [ticket.category];

    if (ticket.customer !== undefined) {
        parts.push(ticket.customer);
    }

    if (ticket.assignee !== undefined) {
        parts.push(ticket.assignee ?? 'Unassigned');
    }

    parts.push(new Date(ticket.created_at).toLocaleDateString());

    return parts.join(' · ');
}

export function TicketList({
    tickets,
    empty,
}: {
    tickets: TicketListItem[];
    empty: string;
}) {
    if (tickets.length === 0) {
        return (
            <p className="rounded-xl border p-6 text-sm text-muted-foreground">
                {empty}
            </p>
        );
    }

    return (
        <ul className="divide-y rounded-xl border">
            {tickets.map((ticket) => (
                <li key={ticket.id}>
                    <Link
                        href={show(ticket.id)}
                        className="flex flex-col gap-2 p-4 hover:bg-muted/50 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div className="min-w-0">
                            <p className="truncate font-medium">
                                #{ticket.id} {ticket.subject}
                            </p>
                            <p className="text-sm text-muted-foreground">
                                {details(ticket)}
                            </p>
                        </div>
                        <div className="flex shrink-0 gap-2">
                            <StatusBadge status={ticket.status} />
                            <PriorityBadge priority={ticket.priority} />
                        </div>
                    </Link>
                </li>
            ))}
        </ul>
    );
}
