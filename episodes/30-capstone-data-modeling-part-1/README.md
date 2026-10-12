# Episode 30: Capstone, Data Modeling Part 1

**Watch:** https://youtu.be/4bHT3o-6k4U  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M13: Data Modeling 1  
**Length:** ~35 min

## What this episode covers

Support Desk data modeling, part 1: roles, categories and tickets. Spec first, SQL read before it runs, 12 tests on PostgreSQL. Screens are drawn illustrations; no output is shown. Files are written for the course.

## Chapters

```text
0:00 From setup to the first real data
0:35 Intro and what we'll cover
1:18 Plan the model
10:59 Migrations, reviewed first
17:58 Models and tests
25:32 Your turn
25:56 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`app/Enums/Role.php`](app/Enums/Role.php)
- [`app/Enums/TicketPriority.php`](app/Enums/TicketPriority.php)
- [`app/Enums/TicketStatus.php`](app/Enums/TicketStatus.php)
- [`app/Models/Category.php`](app/Models/Category.php)
- [`app/Models/Ticket.php`](app/Models/Ticket.php)
- [`database/factories/CategoryFactory.php`](database/factories/CategoryFactory.php)
- [`database/factories/TicketFactory.php`](database/factories/TicketFactory.php)
- [`database/migrations/2026_10_10_024840_add_role_to_users_table.php`](database/migrations/2026_10_10_024840_add_role_to_users_table.php)
- [`database/migrations/2026_10_10_024841_create_categories_table.php`](database/migrations/2026_10_10_024841_create_categories_table.php)
- [`database/migrations/2026_10_10_024842_create_tickets_table.php`](database/migrations/2026_10_10_024842_create_tickets_table.php)
- [`database/seeders/AdminSeeder.php`](database/seeders/AdminSeeder.php)
- [`diffs/kit-edits.diff`](diffs/kit-edits.diff)
- [`edits-and-excerpts.md`](edits-and-excerpts.md)
- [`openspec/changes/add-core-data-model/design.md`](openspec/changes/add-core-data-model/design.md)
- [`openspec/changes/add-core-data-model/proposal.md`](openspec/changes/add-core-data-model/proposal.md)
- [`openspec/changes/add-core-data-model/specs/tickets/spec.md`](openspec/changes/add-core-data-model/specs/tickets/spec.md)
- [`openspec/changes/add-core-data-model/specs/user-roles/spec.md`](openspec/changes/add-core-data-model/specs/user-roles/spec.md)
- [`openspec/changes/add-core-data-model/tasks.md`](openspec/changes/add-core-data-model/tasks.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`tests/Feature/DataModel/AdminSeederTest.php`](tests/Feature/DataModel/AdminSeederTest.php)
- [`tests/Feature/DataModel/RolesTest.php`](tests/Feature/DataModel/RolesTest.php)
- [`tests/Feature/DataModel/TicketDataTest.php`](tests/Feature/DataModel/TicketDataTest.php)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day31-ep30-script.md)

The finished Support Desk app is in [`capstone/support-desk`](../../capstone/support-desk). Files here are the versions shown in this episode, so later episodes may change them.

---
[← Ep 29](../29-capstone-project-setup) · [Course home](../../README.md) · [Ep 31 →](../31-capstone-data-modeling-part-2)
