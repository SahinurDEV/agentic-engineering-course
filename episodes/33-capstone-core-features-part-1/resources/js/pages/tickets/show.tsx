import { Form, Head, Link, usePage } from '@inertiajs/react';
import ReplyController from '@/actions/App/Http/Controllers/ReplyController';
import InputError from '@/components/input-error';
import { PriorityBadge, StatusBadge } from '@/components/ticket-badges';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { inbox } from '@/routes';
import { index } from '@/routes/tickets';
import type { TicketPriority, TicketStatus } from '@/types';

type Ticket = {
    id: number;
    subject: string;
    description: string;
    status: TicketStatus;
    priority: TicketPriority;
    category: string;
    customer: string;
    assignee: string | null;
    created_at: string;
};

type Reply = {
    id: number;
    body: string;
    author: string | null;
    from_agent: boolean;
    created_at: string;
};

export default function ShowTicket({
    ticket,
    replies,
}: {
    ticket: Ticket;
    replies: Reply[];
}) {
    const { auth } = usePage().props;
    const back = auth.can.viewInbox
        ? { href: inbox(), label: 'Back to the inbox' }
        : { href: index(), label: 'Back to my tickets' };

    return (
        <>
            <Head title={`#${ticket.id} ${ticket.subject}`} />
            <div className="flex max-w-3xl flex-1 flex-col gap-6 p-4">
                <Link
                    href={back.href}
                    className="text-sm text-muted-foreground hover:underline"
                >
                    {back.label}
                </Link>

                <header className="space-y-2">
                    <h1 className="text-xl font-semibold tracking-tight break-words">
                        #{ticket.id} {ticket.subject}
                    </h1>
                    <div className="flex flex-wrap items-center gap-2 text-sm text-muted-foreground">
                        <StatusBadge status={ticket.status} />
                        <PriorityBadge priority={ticket.priority} />
                        <span>{ticket.category}</span>
                        <span>From {ticket.customer}</span>
                        <span>
                            {ticket.assignee
                                ? `Assigned to ${ticket.assignee}`
                                : 'Unassigned'}
                        </span>
                    </div>
                </header>

                <p className="rounded-xl border p-4 text-sm whitespace-pre-line">
                    {ticket.description}
                </p>

                <section className="space-y-3" aria-label="Replies">
                    <h2 className="font-medium">Replies</h2>
                    {replies.length === 0 && (
                        <p className="text-sm text-muted-foreground">
                            No replies yet.
                        </p>
                    )}
                    {replies.map((reply) => (
                        <article
                            key={reply.id}
                            className={
                                reply.from_agent
                                    ? 'rounded-xl border bg-muted/50 p-4'
                                    : 'rounded-xl border p-4'
                            }
                        >
                            <p className="mb-1 text-xs text-muted-foreground">
                                {reply.author ?? 'Deleted user'}
                                {reply.from_agent && ' · Support'} ·{' '}
                                {new Date(reply.created_at).toLocaleString()}
                            </p>
                            <p className="text-sm whitespace-pre-line">
                                {reply.body}
                            </p>
                        </article>
                    ))}
                </section>

                <Form
                    {...ReplyController.store.form(ticket.id)}
                    options={{ preserveScroll: true }}
                    resetOnSuccess
                    className="space-y-3"
                >
                    {({ processing, errors }) => (
                        <>
                            <Label htmlFor="body">Your reply</Label>
                            <textarea
                                id="body"
                                name="body"
                                required
                                rows={4}
                                className="w-full rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-xs md:text-sm"
                            />
                            <InputError message={errors.body} />
                            <Button disabled={processing}>Send reply</Button>
                        </>
                    )}
                </Form>
            </div>
        </>
    );
}
