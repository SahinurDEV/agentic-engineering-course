# Episode 32: Capstone, Data Modeling Part 3

**Watch:** https://youtu.be/v5Em3SsfmNI  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M13: Data Modeling 2 (second half)  
**Length:** ~26 min

## What this episode covers

Support Desk data modeling, part 3: a change log (R11) and indexes for the inbox, filters and search (R4 to R6, Q5), chosen with EXPLAIN on 100,000 fake tickets. 13 new tests on PostgreSQL. Screens are drawn illustrations; no output is shown. Files are written for the course.

## Chapters

```text
0:00 Who changed this ticket?
0:34 Intro and what we'll cover
1:19 Plan the log and the queries
8:12 Migrations and EXPLAIN
14:14 Code and tests
18:56 Your turn
19:35 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`app/Models/Ticket.php`](app/Models/Ticket.php)
- [`app/Models/TicketChange.php`](app/Models/TicketChange.php)
- [`database/migrations/2026_10_11_190635_create_ticket_changes_table.php`](database/migrations/2026_10_11_190635_create_ticket_changes_table.php)
- [`database/migrations/2026_10_11_190636_add_indexes_to_tickets_table.php`](database/migrations/2026_10_11_190636_add_indexes_to_tickets_table.php)
- [`database/migrations/2026_10_11_190637_add_indexes_to_replies_table.php`](database/migrations/2026_10_11_190637_add_indexes_to_replies_table.php)
- [`database/migrations/2026_10_11_190638_add_indexes_to_internal_notes_table.php`](database/migrations/2026_10_11_190638_add_indexes_to_internal_notes_table.php)
- [`diffs/provider-edits.diff`](diffs/provider-edits.diff)
- [`diffs/ticket-edits.diff`](diffs/ticket-edits.diff)
- [`edits-and-excerpts.md`](edits-and-excerpts.md)
- [`explain.sql`](explain.sql)
- [`openspec/changes/add-change-log-and-indexes/design.md`](openspec/changes/add-change-log-and-indexes/design.md)
- [`openspec/changes/add-change-log-and-indexes/proposal.md`](openspec/changes/add-change-log-and-indexes/proposal.md)
- [`openspec/changes/add-change-log-and-indexes/specs/ticket-history/spec.md`](openspec/changes/add-change-log-and-indexes/specs/ticket-history/spec.md)
- [`openspec/changes/add-change-log-and-indexes/specs/ticket-queries/spec.md`](openspec/changes/add-change-log-and-indexes/specs/ticket-queries/spec.md)
- [`openspec/changes/add-change-log-and-indexes/tasks.md`](openspec/changes/add-change-log-and-indexes/tasks.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`seed-volume.sql`](seed-volume.sql)
- [`tests/Feature/DataModel/ChangeLogTest.php`](tests/Feature/DataModel/ChangeLogTest.php)
- [`tests/Feature/DataModel/TicketQueriesTest.php`](tests/Feature/DataModel/TicketQueriesTest.php)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day33-ep32-script.md)

The finished Support Desk app is in [`capstone/support-desk`](../../capstone/support-desk). Files here are the versions shown in this episode, so later episodes may change them.

---
[← Ep 31](../31-capstone-data-modeling-part-2) · [Course home](../../README.md) · [Ep 33 →](../33-capstone-core-features-part-1)
