import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import type { Paginated } from '@/types';

export function PaginationLinks({ page }: { page: Paginated<unknown> }) {
    if (page.last_page <= 1) {
        return null;
    }

    return (
        <nav
            aria-label="Pagination"
            className="flex items-center justify-between gap-2 text-sm"
        >
            {page.prev_page_url ? (
                <Button variant="outline" size="sm" asChild>
                    <Link href={page.prev_page_url}>Previous</Link>
                </Button>
            ) : (
                <Button variant="outline" size="sm" disabled>
                    Previous
                </Button>
            )}
            <span className="text-muted-foreground">
                Page {page.current_page} of {page.last_page}
            </span>
            {page.next_page_url ? (
                <Button variant="outline" size="sm" asChild>
                    <Link href={page.next_page_url}>Next</Link>
                </Button>
            ) : (
                <Button variant="outline" size="sm" disabled>
                    Next
                </Button>
            )}
        </nav>
    );
}
