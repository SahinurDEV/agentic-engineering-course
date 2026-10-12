# Episode 26: GitHub Integration

**Watch:** https://youtu.be/Uf0Cd4yLU8o  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M11: Introduction & Use cases, Setting up, Example usages  
**Length:** ~22 min

## What this episode covers

Claude Code meets GitHub: the gh CLI on your machine, and Claude Code GitHub Actions in your repository. We cover use cases, the two modes, who can trigger a run, /install-github-app, secrets and permissions, then three examples in the cart project: an issue turned into a pull request, an @claude comment, and code review.

Screens are drawn illustrations; no Claude, GitHub or CI output is shown. Issue and PR numbers are illustrative.

## Chapters

```text
0:00 From one laptop to GitHub
0:27 Intro and what we'll cover
1:04 Use cases, modes, who can trigger
4:54 Setting up: gh, the app, secrets, claude.yml
10:47 Examples: issue to PR, @claude, code review
19:50 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.github/workflows/claude-code-review.yml`](.github/workflows/claude-code-review.yml)
- [`.github/workflows/claude.yml`](.github/workflows/claude.yml)
- [`.github/workflows/test.yml`](.github/workflows/test.yml)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day27-ep26-script.md)

---
[← Ep 25](../25-changing-a-feature-with-a-spec) · [Course home](../../README.md) · [Ep 27 →](../27-parallel-development-with-conductor)
