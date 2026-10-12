# Episode 17: A React Best Practices Skill

**Watch:** https://youtu.be/yS6tCtExXFk  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M7: React Best Practice Skill  
**Length:** ~11 min

## What this episode covers

In this episode we write a React best practices skill: a reference skill that Claude applies whenever it works on React code. We cover the difference between task and reference skills, why React rules fit a skill better than CLAUDE.md, the description and when_to_use fields, limiting automatic loading to React files with paths, the four rule groups from react.dev (pure components and the Rules of Hooks, minimal and immutable state, Effects only for external systems, stable keys), a supporting examples.md file, invoking it for a review, testing it with a baseline, and why must-hold rules belong in a hook.

Note: screens are drawn illustrations. The skill is written for the course; the React rules come from react.dev.

## Chapters

```text
0:00 From task skills to reference skills
0:31 Intro and what we'll cover
0:55 A reference skill, and why React
2:51 Writing the React best practices skill
8:03 Using and testing it
10:14 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.claude/skills/react-best-practices/SKILL.md`](.claude/skills/react-best-practices/SKILL.md)
- [`.claude/skills/react-best-practices/examples.md`](.claude/skills/react-best-practices/examples.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day18-ep17-script.md)

## Official docs

- Skills: https://code.claude.com/docs/en/skills
- Rules of React: https://react.dev/reference/rules
- You Might Not Need an Effect: https://react.dev/learn/you-might-not-need-an-effect

---
[← Ep 16](../16-the-grill-me-skill) · [Course home](../../README.md) · [Ep 18 →](../18-a-laravel-security-skill)
