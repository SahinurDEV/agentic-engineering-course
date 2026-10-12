## 1. Migrations (I run these with /new-migration)
- [ ] 1.1 Role column on users, default customer; check the SQL with migrate --pretend
- [ ] 1.2 Categories table; check the SQL
- [ ] 1.3 Tickets table with foreign keys; check the SQL, then I run migrate

## 2. Models
- [ ] 2.1 Role, TicketStatus and TicketPriority enums, cast on the models
- [ ] 2.2 Category and Ticket models with relationships; User gets role helpers and ticket relationships
- [ ] 2.3 Factories: agent and admin states, CategoryFactory, TicketFactory

## 3. First admin
- [ ] 3.1 AdminSeeder, called from DatabaseSeeder

## 4. Tests
- [ ] 4.1 A Pest test for every scenario, in tests/Feature/DataModel
- [ ] 4.2 Run php artisan test, all green
