## Context
Categories already have an archived_at column from the data model. Roles live in the users.role column (customer, agent, admin).

## Decisions
- Archive, never delete. Archiving sets archived_at once. Tickets keep their category_id.
- The active() scope lists categories with no archived_at. The new ticket form and the store rule both use it.
- D2, last admin: inside a transaction, lock the admin rows, then refuse when the change would remove the only admin. The lock stops two admins demoting each other at the same moment.
- Authorization lives in CategoryPolicy and UserPolicy, admin only, applied on the routes with can.

## Risks / Trade-offs
- Renaming a category renames it on old tickets too. That is wanted: the category is one record.
