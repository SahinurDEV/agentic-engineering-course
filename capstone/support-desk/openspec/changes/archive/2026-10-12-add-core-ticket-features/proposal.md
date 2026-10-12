## Why
The data model is done, but nobody can use it yet. This change adds the first screens, so a customer can open a ticket and talk to support, and agents can work through the inbox. Covers R2, R3, R4, R5 and R7, plus Q1, Q4 and Q5 for these pages.

## What Changes
- A TicketPolicy for every ticket action.
- Pages: my tickets, new ticket, ticket, inbox.
- Inbox filters by status, priority, category and assignee, kept in the page links.
- A reply form on the ticket page.
- Sidebar links that follow the user's role.

## Capabilities
### New Capabilities
- `customer-tickets`: opening and seeing your own tickets.
- `agent-inbox`: the inbox and its filters.
- `ticket-replies`: the reply form.

## Out of scope
Search, internal notes, assignment, status changes, the R10 reply rules, the change log on screen and the admin area (Episode 34). Archived categories still show in the new ticket form until R12.

## Impact
One policy, three controllers, two form requests, routes, shared props, four pages, three components, tests.
