## Why
Agents need to see who changed a ticket and when, and the inbox, filters and search must stay fast as tickets pile up. Covers the data side of R11 (change log), R4, R5 and R6 (inbox, filters, search) and Q5 (no N + 1).

## What Changes
- New ticket_changes table, written by Ticket methods.
- Indexes chosen from the real queries, checked with EXPLAIN.
- A search scope over subjects and replies.
- Lazy loading throws outside production.

## Capabilities
### New Capabilities
- `ticket-history`: the change log.
- `ticket-queries`: indexes, search, no lazy loading.

## Out of scope
Who may change a ticket (policies), the R10 reply rules, screens, and the inbox page itself.

## Impact
Four migrations, one model, Ticket methods, AppServiceProvider, tests.
