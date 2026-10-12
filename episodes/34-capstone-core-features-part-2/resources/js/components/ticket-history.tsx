export type HistoryEntry = {
    id: number;
    field: 'status' | 'priority' | 'assignee';
    old: string | null;
    new: string | null;
    user: string | null;
    created_at: string;
};

export function TicketHistory({ history }: { history: HistoryEntry[] }) {
    return (
        <section className="space-y-3" aria-label="Activity">
            <h2 className="font-medium">Activity</h2>
            {history.length === 0 ? (
                <p className="text-sm text-muted-foreground">No changes yet.</p>
            ) : (
                <ol className="space-y-2 border-l pl-4 text-sm">
                    {history.map((entry) => (
                        <li key={entry.id}>
                            <span className="font-medium">
                                {entry.user ?? 'Deleted user'}
                            </span>{' '}
                            changed {entry.field} from{' '}
                            <span className="font-medium">
                                {entry.old ?? 'nobody'}
                            </span>{' '}
                            to{' '}
                            <span className="font-medium">
                                {entry.new ?? 'nobody'}
                            </span>
                            <span className="block text-xs text-muted-foreground">
                                {new Date(entry.created_at).toLocaleString()}
                            </span>
                        </li>
                    ))}
                </ol>
            )}
        </section>
    );
}
