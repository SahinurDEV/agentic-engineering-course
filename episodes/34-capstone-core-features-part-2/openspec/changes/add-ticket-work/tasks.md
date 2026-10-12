## 1. Rules
- [x] 1.1 TicketPolicy: reply refuses closed tickets; update and addNote for agents
- [x] 1.2 Ticket::respond with the reopen rule

## 2. Server
- [x] 2.1 TicketUpdateController and UpdateTicketRequest; NoteController and StoreNoteRequest; routes
- [x] 2.2 Ticket page props: history with names, notes and agents for agents, can flags
- [x] 2.3 Inbox search, combined with the filters

## 3. Pages
- [x] 3.1 Manage form, internal notes and activity on the ticket page; closed message instead of the reply form
- [x] 3.2 Search box in the inbox

## 4. Checks
- [x] 4.1 A Pest test for every scenario, including the six R10 cases
- [x] 4.2 Pint, PHPStan, lint, types, all tests green
- [x] 4.3 Playwright check at phone width
