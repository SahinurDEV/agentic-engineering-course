## Why
Agents can read and answer tickets, but they can't work them yet. This change adds search, internal notes, assignment, status and priority with the reopen rule, and the change log on the ticket. Covers R6, R8, R9, R10 and R11, plus decision D1 (notes are not searched).

## What Changes
- A search box in the inbox that combines with the filters.
- A manage form on the ticket for status, priority and assignee, for agents.
- The R10 reply rules: closed tickets take no replies; a customer reply on a pending or resolved ticket sets it to open.
- Internal notes on the ticket page, for agents only.
- An activity list on the ticket page from the change log.

## Capabilities
### New Capabilities
- `ticket-management`: status and priority, assignment, internal notes, and the change log on the ticket.

### Modified Capabilities
- `agent-inbox`: adds search.
- `ticket-replies`: closed tickets take no replies, and the reopen rule.

## Out of scope
The admin area, archived categories and roles (R12, in the add-admin-area change).

## Impact
TicketPolicy, Ticket::respond, two controllers, two form requests, routes, the ticket and inbox pages, three components, tests.
