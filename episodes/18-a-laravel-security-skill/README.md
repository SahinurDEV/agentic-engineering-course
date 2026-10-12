# Episode 18: A Laravel Security Skill

**Watch:** https://youtu.be/5FtQcIkYoX0  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M7: Laravel Security Skill  
**Length:** ~13 min

## What this episode covers

In this episode we write a Laravel security skill: a reference skill that Claude applies whenever it works on Laravel code. We cover why a secure-by-default framework still needs one (raw expressions, unescaped Blade, unguarded models), how it differs from the built-in /security-review command, limiting it to PHP files with paths, four rule groups from the Laravel docs (validated input and bound queries, escaped output, authorization, CSRF and rate limiting, secrets and APP_DEBUG), a review checklist mapped to the OWASP Top 10:2025, testing it with tempting prompts and a baseline, and why must-hold rules belong in a hook.

Note: screens are drawn illustrations. The skill is written for the course; the rules come from laravel.com/docs and the checklist headings from the OWASP Top 10:2025.

## Chapters

```text
0:00 Safe defaults, and the ways around them
0:29 Intro and what we'll cover
0:55 Why security needs a skill
3:50 Writing the Laravel security skill
9:04 Using and testing it
11:26 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.claude/skills/laravel-security/SKILL.md`](.claude/skills/laravel-security/SKILL.md)
- [`.claude/skills/laravel-security/checklist.md`](.claude/skills/laravel-security/checklist.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day19-ep18-script.md)

## Official docs

- Skills: https://code.claude.com/docs/en/skills
- Laravel docs: https://laravel.com/docs

---
[← Ep 17](../17-a-react-best-practices-skill) · [Course home](../../README.md) · [Ep 19 →](../19-database-skills-and-writing-your-own)
