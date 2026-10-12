## Decisions
- D1: search uses the existing search scope, so it covers subjects and public replies only, never notes.
- One PATCH route changes status, priority and assignee, through changeStatus, changePriority and assignTo in one transaction, so every change is logged (R11). Alternative: one route per field.
- The form sends "none" for unassigned; the request turns it into null. The assignee must be an agent or admin.
- The reply rules live in Ticket::respond: it refuses a closed ticket and reopens on a customer reply, in one transaction. The policy also refuses replies on closed tickets, so the page can hide the form.
- An agent reply never changes the status. Agents set pending on purpose.
- update and addNote are agents only: the ticket's customer gets 403, anyone else 404.
- Notes are loaded only for agents. The history is shown to everyone who can see the ticket; assignee ids become names in one query, or "Deleted user".

## Risks / Trade-offs
- Customers see agent names in the activity list → they already see them on replies.
- A search with common words matches many tickets → paged, 25 per page, newest first.
