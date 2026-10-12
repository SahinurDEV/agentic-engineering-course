## Decisions
- One ticket_changes table: field (status, priority or assignee), old and new value as text, user, created_at only. Entries are never edited. Alternative: a column per field.
- changeStatus, changePriority and assignTo save the ticket and its entries in one transaction, and skip values that didn't change. Alternative: a model event, which would have to read the signed-in user.
- Assignee values are user ids as text; the screen shows a deleted user when the id is gone.
- Inbox order is id descending: a unique order for paging, served by the primary key.
- Indexes, from EXPLAIN on 100,000 tickets: (customer_id, id), (assignee_id, id), (category_id, id); (ticket_id, id) on replies, internal_notes and ticket_changes; full text on subject and reply body, language english. No index on status or priority: four values each, and the primary key scan was enough.
- Search unions subject and reply matches, so each full text index is used. Notes are not searched (R6).
- Model::preventLazyLoading outside production, for Q5.

## Risks / Trade-offs
- A direct status update skips the log → features call these methods; tests in Episodes 33 and 34.
- Each index slows writes a little → only the indexes above.
