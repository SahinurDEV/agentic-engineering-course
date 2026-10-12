# Episode 19: Database Skills and Writing Your Own

**Watch:** https://youtu.be/ms_sgaG5jxw  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M7: Database Skills, Creating your own Skills  
**Length:** ~12 min

## What this episode covers

In this episode we finish the skills module. We write two database skills that work as a pair: database-conventions, a reference skill loaded by paths for migrations and models (migrations only, a down for every up, foreign keys, eager loading, transactions, sensible indexes, no destructive commands without asking), and new-migration, a manual task skill with a narrow allowed-tools grant that stops at the migrate --pretend SQL. Then a six-step recipe for writing any skill of your own: spot the signal, pick the type, choose the place, write the frontmatter, write the body, and test it with a baseline.

Note: screens are drawn illustrations. Both skills and the starter template are written for the course; the rules come from laravel.com/docs and postgresql.org/docs.

## Chapters

```text
0:00 From security rules to database skills
0:32 Intro and what we'll cover
0:58 A database reference skill
4:38 A migration task skill
6:47 Writing your own: a six-step recipe
9:54 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.claude/skills/database-conventions/SKILL.md`](.claude/skills/database-conventions/SKILL.md)
- [`.claude/skills/new-migration/SKILL.md`](.claude/skills/new-migration/SKILL.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`skill-template.md`](skill-template.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day20-ep19-script.md)

## Official docs

- Skills: https://code.claude.com/docs/en/skills
- Laravel migrations: https://laravel.com/docs/migrations
- PostgreSQL CREATE INDEX: https://www.postgresql.org/docs/current/sql-createindex.html

---
[← Ep 18](../18-a-laravel-security-skill) · [Course home](../../README.md) · [Ep 20 →](../20-hooks)
