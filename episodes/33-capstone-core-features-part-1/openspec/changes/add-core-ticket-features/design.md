## Decisions
- Authorization sits on the routes with the can middleware, backed by TicketPolicy. Form requests only validate. Alternative: Gate calls in each controller.
- Another customer's ticket answers 404, not 403, with denyAsNotFound, so ticket ids reveal nothing.
- Agents (admins count as agents) do not open tickets; customers do not see the inbox.
- The ticket page loads replies only, never internal notes, so a customer cannot receive a note by mistake.
- Inbox filters come from the query string. Unknown values are ignored, not errors. Filters stay in the page links with withQueryString.
- Inbox order is id descending, 25 per page, with category, customer and assignee eager loaded (Q5). A test counts the queries.
- Pages get only the fields they show, mapped in the controller.
- The sidebar reads auth.can, shared from the policy, instead of checking roles in React.

## Risks / Trade-offs
- Filter values that are ignored give no feedback → the filter controls only offer valid values.
- The new ticket form lists archived categories → fixed with R12 in Episode 34.
