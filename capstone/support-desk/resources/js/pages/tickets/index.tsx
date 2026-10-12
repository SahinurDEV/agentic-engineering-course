import { Head, Link, usePage } from '@inertiajs/react';
import Heading from '@/components/heading';
import { PaginationLinks } from '@/components/pagination-links';
import { TicketList } from '@/components/ticket-list';
import { Button } from '@/components/ui/button';
import { create, index } from '@/routes/tickets';
import type { Paginated, TicketListItem } from '@/types';

export default function TicketsIndex({
    tickets,
}: {
    tickets: Paginated<TicketListItem>;
}) {
    const { auth } = usePage().props;

    return (
        <>
            <Head title="My tickets" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <div className="flex flex-wrap items-start justify-between gap-4">
                    <Heading
                        title="My tickets"
                        description="Every ticket you have opened, newest first."
                    />
                    {auth.can.openTicket && (
                        <Button asChild>
                            <Link href={create()}>New ticket</Link>
                        </Button>
                    )}
                </div>
                <TicketList
                    tickets={tickets.data}
                    empty="You have not opened a ticket yet."
                />
                <PaginationLinks page={tickets} />
            </div>
        </>
    );
}

TicketsIndex.layout = {
    breadcrumbs: [{ title: 'My tickets', href: index() }],
};
