# Episode 27: Parallel Development with Conductor

**Watch:** https://youtu.be/P_lRFov85xM  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M12: Introduction to Conductor, Running parallel sessions  
**Length:** ~21 min

## What this episode covers

Run several Claude Code sessions at once without them colliding. We cover Conductor (what it is, workspaces, git worktrees underneath, setup and run scripts, ports, files to copy, review and merge), then the same idea on any platform with git worktrees and claude --worktree.

Platform: Conductor is a Mac app. Its docs say it is not available for Windows or Linux yet. Part 3 shows plain worktrees, which work wherever git runs.

## Chapters

```text
0:00 One task at a time, until now
0:30 Intro and what we'll cover
1:02 Conductor: what it is, Mac only, worktrees underneath
5:28 Running parallel sessions in Conductor
12:54 Without Conductor: git worktrees and claude --worktree
18:18 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.conductor/settings.toml`](.conductor/settings.toml)
- [`.github/workflows/test.yml`](.github/workflows/test.yml)
- [`.worktreeinclude`](.worktreeinclude)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day28-ep27-script.md)

---
[← Ep 26](../26-github-integration) · [Course home](../../README.md) · [Ep 28 →](../28-capstone-the-project-and-requirements)
