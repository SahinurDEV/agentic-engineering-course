import { Badge } from '@/components/ui/badge';
import type { TicketPriority, TicketStatus } from '@/types';

export function StatusBadge({ status }: { status: TicketStatus }) {
    return (
        <Badge variant={status === 'open' ? 'default' : 'secondary'}>
            {status}
        </Badge>
    );
}

export function PriorityBadge({ priority }: { priority: TicketPriority }) {
    return (
        <Badge variant={priority === 'urgent' ? 'destructive' : 'outline'}>
            {priority}
        </Badge>
    );
}
