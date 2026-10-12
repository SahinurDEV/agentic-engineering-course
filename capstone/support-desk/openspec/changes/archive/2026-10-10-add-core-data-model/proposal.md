## Why
Every feature reads or writes tickets, so roles, categories and tickets need tables first. Covers the data side of R1 (sign-ups are customers), R2 (ticket fields) and R10 (status and priority values).

## What Changes
- Users get a role: customer, agent or admin. New sign-ups are customers.
- A seeder creates the first admin.
- New categories table, with archiving.
- New tickets table with the seven fields, four statuses and four priorities.

## Capabilities
### New Capabilities
- `user-roles`: who is a customer, an agent or an admin.
- `tickets`: what a ticket holds and its allowed values.

## Out of scope
Replies, internal notes, the change log, indexes and search (Episodes 31 and 32). Screens, policies and status rules (Episodes 33 and 34).

## Impact
Three migrations, three enums, two new models, factories, a seeder, tests.
