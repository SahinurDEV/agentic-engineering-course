## 1. Migrations (I run these with /new-migration)
- [ ] 1.1 Replies table; check the SQL with migrate --pretend
- [ ] 1.2 Internal notes table; check the SQL, then I run migrate

## 2. Models
- [ ] 2.1 Reply and InternalNote models with ticket and author
- [ ] 2.2 Ticket: replies and internalNotes ordered by id; addReply and addNote
- [ ] 2.3 ReplyFactory and InternalNoteFactory

## 3. Tests
- [ ] 3.1 A Pest test for every scenario, in tests/Feature/DataModel
- [ ] 3.2 Run php artisan test, all green
