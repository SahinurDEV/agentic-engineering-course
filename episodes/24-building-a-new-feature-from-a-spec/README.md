# Episode 24: Building a New Feature from a Spec

**Watch:** https://youtu.be/GCgcpqNzErU  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M10: Implementing a new feature  
**Length:** ~20 min

## What this episode covers

One new feature in the cart project, end to end with OpenSpec: free shipping over 50.00. We propose the change with /opsx:propose, review the proposal, delta spec, design and tasks in order (and hunt for what's missing), validate and commit the plan, clear the context, build it with /opsx:apply, verify with tests, a Playwright browser check and /opsx:verify, then archive it so the delta becomes the main spec.

Note: this is an illustrated walkthrough, not a recording; no Claude or tool output is shown. The change files are the reviewed versions, written for the course. Facts come from the official OpenSpec repository (version 1.14.1) and the Claude Code docs. Prices and the dev server address are illustrative.

## Chapters

```text
0:00 One feature, end to end: free shipping
0:28 Intro and what we'll cover
1:01 Propose and review
8:32 Apply: building from the task list
11:29 Verify and archive
15:30 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`openspec/changes/add-free-shipping/design.md`](openspec/changes/add-free-shipping/design.md)
- [`openspec/changes/add-free-shipping/proposal.md`](openspec/changes/add-free-shipping/proposal.md)
- [`openspec/changes/add-free-shipping/specs/shipping/spec.md`](openspec/changes/add-free-shipping/specs/shipping/spec.md)
- [`openspec/changes/add-free-shipping/tasks.md`](openspec/changes/add-free-shipping/tasks.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day25-ep24-script.md)

---
[← Ep 23](../23-spec-driven-development-and-openspec) · [Course home](../../README.md) · [Ep 25 →](../25-changing-a-feature-with-a-spec)
