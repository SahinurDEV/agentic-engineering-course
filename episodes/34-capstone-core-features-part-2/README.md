# Episode 34: Capstone, Core Features Part 2

**Watch:** https://youtu.be/lN4gnV8FdVs  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M13: Core Feature Development (second half)  
**Length:** ~45 min

## What this episode covers

Support Desk core features, part 2: search (R6), internal notes (R8), assignment (R9), status and reply rules (R10), activity (R11), and the admin area (R12). Three decisions, two git worktrees, 39 new tests, a phone check, and all 12 requirements done. Screens are drawn illustrations; no output is shown. Files are written for the course.

## Chapters

```text
0:00 The reply on a resolved ticket
0:34 Intro and what we'll cover
1:11 Decide and plan
7:27 Build in two worktrees
13:09 Test and finish
16:33 Your turn
17:07 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`app/Http/Controllers/Admin/CategoryController.php`](app/Http/Controllers/Admin/CategoryController.php)
- [`app/Http/Controllers/Admin/UserController.php`](app/Http/Controllers/Admin/UserController.php)
- [`app/Http/Controllers/InboxController.php`](app/Http/Controllers/InboxController.php)
- [`app/Http/Controllers/NoteController.php`](app/Http/Controllers/NoteController.php)
- [`app/Http/Controllers/ReplyController.php`](app/Http/Controllers/ReplyController.php)
- [`app/Http/Controllers/TicketController.php`](app/Http/Controllers/TicketController.php)
- [`app/Http/Controllers/TicketUpdateController.php`](app/Http/Controllers/TicketUpdateController.php)
- [`app/Http/Requests/Admin/StoreCategoryRequest.php`](app/Http/Requests/Admin/StoreCategoryRequest.php)
- [`app/Http/Requests/Admin/UpdateCategoryRequest.php`](app/Http/Requests/Admin/UpdateCategoryRequest.php)
- [`app/Http/Requests/Admin/UpdateUserRoleRequest.php`](app/Http/Requests/Admin/UpdateUserRoleRequest.php)
- [`app/Http/Requests/StoreNoteRequest.php`](app/Http/Requests/StoreNoteRequest.php)
- [`app/Http/Requests/UpdateTicketRequest.php`](app/Http/Requests/UpdateTicketRequest.php)
- [`app/Policies/CategoryPolicy.php`](app/Policies/CategoryPolicy.php)
- [`app/Policies/TicketPolicy.php`](app/Policies/TicketPolicy.php)
- [`app/Policies/UserPolicy.php`](app/Policies/UserPolicy.php)
- [`check.mjs`](check.mjs)
- [`diffs/decisions.diff`](diffs/decisions.diff)
- [`diffs/php-edits.diff`](diffs/php-edits.diff)
- [`diffs/react-edits.diff`](diffs/react-edits.diff)
- [`diffs/routes.diff`](diffs/routes.diff)
- [`edits-and-excerpts.md`](edits-and-excerpts.md)
- [`openspec/changes/add-accounts-spec/proposal.md`](openspec/changes/add-accounts-spec/proposal.md)
- [`openspec/changes/add-accounts-spec/specs/accounts/spec.md`](openspec/changes/add-accounts-spec/specs/accounts/spec.md)
- [`openspec/changes/add-accounts-spec/tasks.md`](openspec/changes/add-accounts-spec/tasks.md)
- [`openspec/changes/add-admin-area/design.md`](openspec/changes/add-admin-area/design.md)
- [`openspec/changes/add-admin-area/proposal.md`](openspec/changes/add-admin-area/proposal.md)
- [`openspec/changes/add-admin-area/specs/admin-area/spec.md`](openspec/changes/add-admin-area/specs/admin-area/spec.md)
- [`openspec/changes/add-admin-area/specs/customer-tickets/spec.md`](openspec/changes/add-admin-area/specs/customer-tickets/spec.md)
- [`openspec/changes/add-admin-area/tasks.md`](openspec/changes/add-admin-area/tasks.md)
- [`openspec/changes/add-ticket-work/design.md`](openspec/changes/add-ticket-work/design.md)
- [`openspec/changes/add-ticket-work/proposal.md`](openspec/changes/add-ticket-work/proposal.md)
- [`openspec/changes/add-ticket-work/specs/agent-inbox/spec.md`](openspec/changes/add-ticket-work/specs/agent-inbox/spec.md)
- [`openspec/changes/add-ticket-work/specs/ticket-management/spec.md`](openspec/changes/add-ticket-work/specs/ticket-management/spec.md)
- [`openspec/changes/add-ticket-work/specs/ticket-replies/spec.md`](openspec/changes/add-ticket-work/specs/ticket-replies/spec.md)
- [`openspec/changes/add-ticket-work/tasks.md`](openspec/changes/add-ticket-work/tasks.md)
- [`openspec/changes/list-admins-first/proposal.md`](openspec/changes/list-admins-first/proposal.md)
- [`openspec/changes/list-admins-first/specs/admin-area/spec.md`](openspec/changes/list-admins-first/specs/admin-area/spec.md)
- [`openspec/changes/list-admins-first/tasks.md`](openspec/changes/list-admins-first/tasks.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`resources/js/components/ticket-history.tsx`](resources/js/components/ticket-history.tsx)
- [`resources/js/components/ticket-manage-form.tsx`](resources/js/components/ticket-manage-form.tsx)
- [`resources/js/components/ticket-notes.tsx`](resources/js/components/ticket-notes.tsx)
- [`resources/js/pages/admin/categories.tsx`](resources/js/pages/admin/categories.tsx)
- [`resources/js/pages/admin/users.tsx`](resources/js/pages/admin/users.tsx)
- [`resources/js/pages/inbox.tsx`](resources/js/pages/inbox.tsx)
- [`resources/js/pages/tickets/show.tsx`](resources/js/pages/tickets/show.tsx)
- [`tests/Feature/Admin/CategoriesTest.php`](tests/Feature/Admin/CategoriesTest.php)
- [`tests/Feature/Admin/UsersTest.php`](tests/Feature/Admin/UsersTest.php)
- [`tests/Feature/Tickets/ArchivedCategoriesTest.php`](tests/Feature/Tickets/ArchivedCategoriesTest.php)
- [`tests/Feature/Tickets/AssignmentTest.php`](tests/Feature/Tickets/AssignmentTest.php)
- [`tests/Feature/Tickets/HistoryTest.php`](tests/Feature/Tickets/HistoryTest.php)
- [`tests/Feature/Tickets/NotesTest.php`](tests/Feature/Tickets/NotesTest.php)
- [`tests/Feature/Tickets/ReplyStatusRulesTest.php`](tests/Feature/Tickets/ReplyStatusRulesTest.php)
- [`tests/Feature/Tickets/SearchTest.php`](tests/Feature/Tickets/SearchTest.php)
- [`tests/Feature/Tickets/StatusAndPriorityTest.php`](tests/Feature/Tickets/StatusAndPriorityTest.php)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day35-ep34-script.md)

The finished Support Desk app is in [`capstone/support-desk`](../../capstone/support-desk). Files here are the versions shown in this episode, so later episodes may change them.

---
[← Ep 33](../33-capstone-core-features-part-1) · [Course home](../../README.md) · [Ep 35 →](../35-field-notes-and-wrap-up-course-finale)
