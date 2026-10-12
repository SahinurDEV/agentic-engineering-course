# Episode 20: Hooks

**Watch:** https://youtu.be/hu01cRMJ_0U  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M8: Introduction, Hooks Worth Shipping, Setting up Hooks  
**Length:** ~14 min

## What this episode covers

In this episode we cover Claude Code hooks: shell commands Claude Code runs at lifecycle events, so a rule holds every time instead of relying on the model. We cover events (SessionStart, PreToolUse, PostToolUse, Stop, Notification), matchers, the JSON input on stdin, and the three ways a hook answers: exit 0, exit 2, or JSON output. Then four hooks worth shipping: protect files before edits, format after edits with Pint and Prettier, run tests before Claude stops, and a desktop notification when Claude needs approval. Finally, setting hooks up safely: five setup steps, testing a hook by hand, where hooks live, why a deny can't be bypassed, and the security cautions from the docs.

Note: screens are drawn illustrations. The hook files are written for the course; every hooks fact comes from the official Claude Code hooks guide and reference.

## Chapters

```text
0:00 Rules that hold every time
0:26 Intro and what we'll cover
0:49 What hooks are: events, input, answers
4:09 Four hooks worth shipping
7:30 Setting up hooks safely
11:13 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.claude/hooks/format.sh`](.claude/hooks/format.sh)
- [`.claude/hooks/protect-files.sh`](.claude/hooks/protect-files.sh)
- [`.claude/hooks/stop-tests.sh`](.claude/hooks/stop-tests.sh)
- [`.claude/settings.json`](.claude/settings.json)
- [`prompts-and-commands.md`](prompts-and-commands.md)
- [`user-level/.claude/settings.json`](user-level/.claude/settings.json)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day21-ep20-script.md)

## Official docs

- Hooks guide: https://code.claude.com/docs/en/hooks-guide
- Hooks reference: https://code.claude.com/docs/en/hooks

---
[← Ep 19](../19-database-skills-and-writing-your-own) · [Course home](../../README.md) · [Ep 21 →](../21-mcp-explained-and-choosing-servers)
