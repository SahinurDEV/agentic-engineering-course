# Episode 31: Capstone, Data Modeling Part 2

**Watch:** https://youtu.be/BaxrtXVKT7k  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M13: Data Modeling 2 (first half)  
**Length:** ~26 min

## What this episode covers

Support Desk data modeling, part 2: public replies and internal notes. One table or two, authors set in code, order by id, 8 new tests on PostgreSQL. Screens are drawn illustrations; no output is shown. Files are written for the course.

## Chapters

```text
0:00 A ticket nobody can answer
0:32 Intro and what we'll cover
1:13 Plan the conversation
3:32 One table or two?
8:28 Two migrations, reviewed
11:33 Models and tests
14:17 A test that can fail
16:22 Your turn
16:45 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`app/Models/InternalNote.php`](app/Models/InternalNote.php)
- [`app/Models/Reply.php`](app/Models/Reply.php)
- [`database/factories/InternalNoteFactory.php`](database/factories/InternalNoteFactory.php)
- [`database/factories/ReplyFactory.php`](database/factories/ReplyFactory.php)
- [`database/migrations/2026_10_10_042336_create_replies_table.php`](database/migrations/2026_10_10_042336_create_replies_table.php)
- [`database/migrations/2026_10_10_042337_create_internal_notes_table.php`](database/migrations/2026_10_10_042337_create_internal_notes_table.php)
- [`diffs/ticket-edits.diff`](diffs/ticket-edits.diff)
- [`edits-and-excerpts.md`](edits-and-excerpts.md)
- [`openspec/changes/add-ticket-conversation/design.md`](openspec/changes/add-ticket-conversation/design.md)
- [`openspec/changes/add-ticket-conversation/proposal.md`](openspec/changes/add-ticket-conversation/proposal.md)
- [`openspec/changes/add-ticket-conversation/specs/ticket-conversation/spec.md`](openspec/changes/add-ticket-conversation/specs/ticket-conversation/spec.md)
- [`openspec/changes/add-ticket-conversation/tasks.md`](openspec/changes/add-ticket-conversation/tasks.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`tests/Feature/DataModel/ConversationTest.php`](tests/Feature/DataModel/ConversationTest.php)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day32-ep31-script.md)

The finished Support Desk app is in [`capstone/support-desk`](../../capstone/support-desk). Files here are the versions shown in this episode, so later episodes may change them.

---
[← Ep 30](../30-capstone-data-modeling-part-1) · [Course home](../../README.md) · [Ep 32 →](../32-capstone-data-modeling-part-3)
