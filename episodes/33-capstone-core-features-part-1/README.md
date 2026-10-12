# Episode 33: Capstone, Core Features Part 1

**Watch:** https://youtu.be/xxufoTeH3ro  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M13: Core Feature Development (first half)  
**Length:** ~40 min

## What this episode covers

Support Desk core features, part 1: open a ticket (R2), own tickets only (R3), the agent inbox (R4) with filters (R5), and public replies (R7). One policy behind the ticket routes, four Inertia React pages, 21 new tests, a phone-width browser check. Screens are drawn illustrations; no output is shown. Files are written for the course.

## Chapters

```text
0:00 Nowhere to report a problem
0:35 Intro and what we'll cover
1:12 Plan the screens
7:41 Build the pages
14:06 Test and check
17:37 Your turn
18:14 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`app/Http/Controllers/InboxController.php`](app/Http/Controllers/InboxController.php)
- [`app/Http/Controllers/ReplyController.php`](app/Http/Controllers/ReplyController.php)
- [`app/Http/Controllers/TicketController.php`](app/Http/Controllers/TicketController.php)
- [`app/Http/Requests/StoreReplyRequest.php`](app/Http/Requests/StoreReplyRequest.php)
- [`app/Http/Requests/StoreTicketRequest.php`](app/Http/Requests/StoreTicketRequest.php)
- [`app/Policies/TicketPolicy.php`](app/Policies/TicketPolicy.php)
- [`check.mjs`](check.mjs)
- [`diffs/php-edits.diff`](diffs/php-edits.diff)
- [`diffs/react-edits.diff`](diffs/react-edits.diff)
- [`diffs/routes.diff`](diffs/routes.diff)
- [`edits-and-excerpts.md`](edits-and-excerpts.md)
- [`openspec/changes/add-core-ticket-features/design.md`](openspec/changes/add-core-ticket-features/design.md)
- [`openspec/changes/add-core-ticket-features/proposal.md`](openspec/changes/add-core-ticket-features/proposal.md)
- [`openspec/changes/add-core-ticket-features/specs/agent-inbox/spec.md`](openspec/changes/add-core-ticket-features/specs/agent-inbox/spec.md)
- [`openspec/changes/add-core-ticket-features/specs/customer-tickets/spec.md`](openspec/changes/add-core-ticket-features/specs/customer-tickets/spec.md)
- [`openspec/changes/add-core-ticket-features/specs/ticket-replies/spec.md`](openspec/changes/add-core-ticket-features/specs/ticket-replies/spec.md)
- [`openspec/changes/add-core-ticket-features/tasks.md`](openspec/changes/add-core-ticket-features/tasks.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`resources/js/components/pagination-links.tsx`](resources/js/components/pagination-links.tsx)
- [`resources/js/components/ticket-badges.tsx`](resources/js/components/ticket-badges.tsx)
- [`resources/js/components/ticket-list.tsx`](resources/js/components/ticket-list.tsx)
- [`resources/js/pages/inbox.tsx`](resources/js/pages/inbox.tsx)
- [`resources/js/pages/tickets/create.tsx`](resources/js/pages/tickets/create.tsx)
- [`resources/js/pages/tickets/index.tsx`](resources/js/pages/tickets/index.tsx)
- [`resources/js/pages/tickets/show.tsx`](resources/js/pages/tickets/show.tsx)
- [`resources/js/types/tickets.ts`](resources/js/types/tickets.ts)
- [`tests/Feature/Tickets/CustomerTicketsTest.php`](tests/Feature/Tickets/CustomerTicketsTest.php)
- [`tests/Feature/Tickets/InboxTest.php`](tests/Feature/Tickets/InboxTest.php)
- [`tests/Feature/Tickets/OpenTicketTest.php`](tests/Feature/Tickets/OpenTicketTest.php)
- [`tests/Feature/Tickets/RepliesTest.php`](tests/Feature/Tickets/RepliesTest.php)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day34-ep33-script.md)

The finished Support Desk app is in [`capstone/support-desk`](../../capstone/support-desk). Files here are the versions shown in this episode, so later episodes may change them.

---
[← Ep 32](../32-capstone-data-modeling-part-3) · [Course home](../../README.md) · [Ep 34 →](../34-capstone-core-features-part-2)
