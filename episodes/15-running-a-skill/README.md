# Episode 15: Running a Skill

**Watch:** https://youtu.be/sXb2s2MfRoo  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M7: Running a Skill  
**Length:** ~13 min

## What this episode covers

In this episode we put the add-discount skill to work: how Claude picks a skill up automatically from its description, how to invoke it yourself with /skill-name (and why it matters where you type the name), how disable-model-invocation and user-invocable control who can run it, what happens to a skill's content after it runs, passing arguments with $ARGUMENTS, $0 and named arguments, bundling scripts with ${CLAUDE_SKILL_DIR} and allowed-tools, live data with inline !`command` injection, and how to test and iterate on a skill with a baseline comparison.

Note: screens are drawn illustrations, and the add-discount skill is an example written for the course.

## Chapters

```text
0:00 A skill in a folder doesn't run itself
0:31 Intro and what we'll cover
0:52 Two ways to run a skill
5:04 Arguments, bundled scripts and live data
8:37 Testing and iterating on a skill
11:10 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.claude/skills/add-discount/SKILL.md`](.claude/skills/add-discount/SKILL.md)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day16-ep15-script.md)

## Official docs

- Skills: https://code.claude.com/docs/en/skills

---
[← Ep 14](../14-introduction-to-skills) · [Course home](../../README.md) · [Ep 16 →](../16-the-grill-me-skill)
