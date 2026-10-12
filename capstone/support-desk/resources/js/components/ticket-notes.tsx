import { Form } from '@inertiajs/react';
import NoteController from '@/actions/App/Http/Controllers/NoteController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';

export type Note = {
    id: number;
    body: string;
    author: string | null;
    created_at: string;
};

export function TicketNotes({
    ticketId,
    notes,
}: {
    ticketId: number;
    notes: Note[];
}) {
    return (
        <section
            className="space-y-3 rounded-xl border border-dashed p-4"
            aria-label="Internal notes"
        >
            <div>
                <h2 className="font-medium">Internal notes</h2>
                <p className="text-xs text-muted-foreground">
                    Only agents see these. Customers never do.
                </p>
            </div>
            {notes.map((note) => (
                <article key={note.id} className="text-sm">
                    <p className="mb-1 text-xs text-muted-foreground">
                        {note.author ?? 'Deleted user'} ·{' '}
                        {new Date(note.created_at).toLocaleString()}
                    </p>
                    <p className="whitespace-pre-line">{note.body}</p>
                </article>
            ))}
            <Form
                {...NoteController.store.form(ticketId)}
                options={{ preserveScroll: true }}
                resetOnSuccess
                className="space-y-2"
            >
                {({ processing, errors }) => (
                    <>
                        <Label htmlFor="note">New note</Label>
                        <textarea
                            id="note"
                            name="body"
                            required
                            rows={3}
                            className="w-full rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-xs md:text-sm"
                        />
                        <InputError message={errors.body} />
                        <Button variant="secondary" disabled={processing}>
                            Add note
                        </Button>
                    </>
                )}
            </Form>
        </section>
    );
}
