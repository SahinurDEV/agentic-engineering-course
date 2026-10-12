## 1. Migrations (I run these with /new-migration)
- [x] 1.1 ticket_changes table; check the SQL with migrate --pretend
- [x] 1.2 Indexes on tickets, replies and internal_notes; check the SQL, then I run migrate
- [x] 1.3 EXPLAIN the inbox, filter and search queries before and after, on volume data

## 2. Code
- [x] 2.1 TicketChange model; Ticket history, changeStatus, changePriority, assignTo
- [x] 2.2 Ticket search scope
- [x] 2.3 Model::preventLazyLoading outside production

## 3. Tests
- [x] 3.1 A Pest test for every scenario, in tests/Feature/DataModel
- [x] 3.2 Run php artisan test, all green
