# Episode 16: The "Grill Me" Skill

**Watch:** https://youtu.be/BG_hwGaok1g  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M7: Grill Me Skill  
**Length:** ~20 min

## What this episode covers

In this episode we write a "grill me" skill: a skill that makes Claude interview you about a feature before any code is written, then write a spec to SPEC.md. It's built on the "let Claude interview you" pattern from Anthropic's Claude Code best practices.

We cover: why hidden decisions cost you at review time, where the skill lives (a personal skill in ~/.claude/skills/), why it's manual only with disable-model-invocation, taking the feature as $ARGUMENTS, why it runs inline instead of with context: fork, writing standing rules, supporting files for question areas and a spec template, answering AskUserQuestion questions, running it on the cart project, handing the spec to a fresh session, and tuning the skill.

## Chapters

```text
0:00 A skill that asks before it builds
0:33 Intro and what we'll cover
0:56 Why grill me: the interview pattern
3:52 Writing the grill-me skill
10:59 Running it on the cart and tuning it
15:59 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`edits-and-excerpts.md`](edits-and-excerpts.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`user-level/.claude/skills/grill-me/SKILL.md`](user-level/.claude/skills/grill-me/SKILL.md)
- [`user-level/.claude/skills/grill-me/question-areas.md`](user-level/.claude/skills/grill-me/question-areas.md)
- [`user-level/.claude/skills/grill-me/spec-template.md`](user-level/.claude/skills/grill-me/spec-template.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day17-ep16-script.md)

## Official docs

- Skills: https://code.claude.com/docs/en/skills
- Best practices (Let Claude interview you): https://code.claude.com/docs/en/best-practices
- Tools reference (AskUserQuestion): https://code.claude.com/docs/en/tools-reference

---
[← Ep 15](../15-running-a-skill) · [Course home](../../README.md) · [Ep 17 →](../17-a-react-best-practices-skill)
