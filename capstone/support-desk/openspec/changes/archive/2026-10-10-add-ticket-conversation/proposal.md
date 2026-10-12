## Why
Customers and agents talk on a ticket, and agents need private notes. Covers the data side of R7 (public replies), R8 (internal notes) and R3 (customers never see notes).

## What Changes
- New replies table: public messages on a ticket.
- New internal_notes table, kept apart from replies.
- Ticket helpers that set the author in code.

## Capabilities
### New Capabilities
- `ticket-conversation`: replies and internal notes on a ticket.

## Out of scope
Who may reply or read notes (policies), closed tickets taking no replies and status changes on reply (R10), screens, the change log and indexes.

## Impact
Two migrations, two models, factories, Ticket helpers, tests.
