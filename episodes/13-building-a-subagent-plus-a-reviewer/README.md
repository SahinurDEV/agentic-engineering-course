# Episode 13: Building a Subagent (plus a Reviewer)

**Watch:** https://youtu.be/OpVRnecyUCY  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M6: Creating a Subagent, A Reviewer Subagent  
**Length:** ~17 min

## What this episode covers

In this episode: creating a custom subagent (ask Claude or write the file; what /agents does now); project vs user scope (.claude/agents/ and ~/.claude/agents/); the file format: YAML frontmatter (name, description, tools, model, and more) plus a markdown system prompt; writing a description that triggers delegation at the right time; restricting tools; invoking automatically, by name, by @-mention, or with --agent; testing and iterating. Then a full code-reviewer subagent for a small Node.js cart project: what its prompt tells it to do, how to run it after a feature, and how its short report comes back.

Note: screens are drawn illustrations, and the reviewer file is an example written for the course. The report on screen shows the format we ask for, not a real review.

## Chapters

```text
0:00 From what subagents are to building one
0:35 Intro and what we'll cover
0:56 Create a subagent: scope, file format, fields
4:48 Make it work well: description, tools, invoking, testing
8:21 A code-reviewer for the cart project
12:06 Week 2 wrap-up and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.claude/agents/code-reviewer.md`](.claude/agents/code-reviewer.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day14-ep13-script.md)

## Official docs

- Subagents: https://code.claude.com/docs/en/sub-agents

---
[← Ep 12](../12-what-subagents-are-and-when-to-use-them) · [Course home](../../README.md) · [Ep 14 →](../14-introduction-to-skills)
