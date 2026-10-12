## Decisions
- Two tables, replies and internal_notes, not one table with an is_internal flag. A customer page that loads replies cannot pick up a note by mistake. Alternative: one table, and a where clause everywhere it's read.
- Same columns in both: ticket, nullable author, body, timestamps.
- Ticket cascades; author becomes null, so history survives a deleted account.
- author_id is not fillable. addReply and addNote set it, and addNote refuses customers.
- Order by id: timestamps are whole seconds, and Postgres doesn't promise row order without an order by.

## Risks / Trade-offs
- The agent timeline merges two lists → done in the view in Episode 34.
- No index on ticket_id yet → Episode 32.
