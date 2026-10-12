# Support Desk: requirements, v1
Written for the Agentic Engineering course capstone.

## Goal
One place where a small company answers customer questions.
Customers open tickets. Agents reply, assign and resolve them.

## Stack
Laravel 13 with the React starter kit, and PostgreSQL.

## Roles
- Customer: opens tickets, sees only their own.
- Agent: works on every ticket.
- Admin: an agent who also manages categories and roles.
New sign-ups are customers. The first admin comes from a seeder.

## Tickets
- Fields: subject, description, category, status, priority, customer, assignee.
- Status: open, pending, resolved or closed. New tickets are open.
- Priority: low, normal, high or urgent. New tickets are normal.

## Functional requirements
R1 Customers register, sign in and reset their password.
R2 A customer opens a ticket with a subject, a description and a category.
R3 A customer sees only their own tickets, and never internal notes.
R4 Agents see an inbox of all tickets, newest first, 25 per page.
R5 Agents filter the inbox by status, priority, category and assignee.
R6 Agents search tickets by words in the subject or the replies.
R7 Customers and agents add public replies to a ticket.
R8 Agents add internal notes that customers never see.
R9 Agents assign a ticket to any agent, or unassign it.
R10 Agents change status and priority. A customer reply on a pending or resolved ticket sets it to open. Closed tickets take no replies.
R11 Every status, priority and assignee change is logged with who and when, and shown on the ticket.
R12 Admins create, rename and archive categories, and set user roles. Archived categories cannot be picked for new tickets.

## Quality requirements
Q1 Security: every ticket action is checked by a policy. Follow the laravel-security skill.
Q2 Data: schema changes only through migrations, with foreign keys. Follow the database-conventions skill.
Q3 Tests: every R has at least one feature test. CI runs the tests on every pull request.
Q4 UI: every page works at phone width, checked in a browser with Playwright MCP.
Q5 Speed: the inbox loads without N + 1 queries.

## Out of scope for v1
Email notifications, file attachments, SLA timers, live chat, translations, AI replies.

## Done means
A requirement is done when its spec is archived into openspec/specs, its tests pass in CI, and its pull request is reviewed and merged.
