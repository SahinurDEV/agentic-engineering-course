export type TicketStatus = 'open' | 'pending' | 'resolved' | 'closed';
export type TicketPriority = 'low' | 'normal' | 'high' | 'urgent';

export type TicketListItem = {
    id: number;
    subject: string;
    status: TicketStatus;
    priority: TicketPriority;
    category: string;
    created_at: string;
    customer?: string;
    assignee?: string | null;
};

export type Paginated<T> = {
    data: T[];
    current_page: number;
    last_page: number;
    total: number;
    prev_page_url: string | null;
    next_page_url: string | null;
};

export type Option = {
    id: number;
    name: string;
};
