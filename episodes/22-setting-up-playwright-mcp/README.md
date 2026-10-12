# Episode 22: Setting Up Playwright MCP

**Watch:** https://youtu.be/t9TorbIF3gc  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M9: Setting up Playwright MCP  
**Length:** ~7 min

## What this episode covers

We install the Playwright MCP server in Claude Code with claude mcp add, check it with claude mcp list, and share it through .mcp.json. Then we configure it: options in args, headed vs headless, isolated profiles, and the key idea of snapshots vs screenshots. Finally, we use it to verify a UI change in the cart project, read the console, and add a deny rule for the unsafe code tool.

Note: screens are drawn illustrations; no Claude or browser output is shown. The examples are written for the course; facts come from the Claude Code docs and the official Playwright MCP README. The dev server address and the cart steps are illustrative.

## Chapters

```text
0:00 From choosing servers to connecting one
0:27 Intro and what we'll cover
0:49 Installing the Playwright MCP server
2:27 Configuring it: modes, profiles, snapshots
5:00 Verifying a UI change in the cart
7:08 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.claude/settings.json`](.claude/settings.json)
- [`.mcp.json`](.mcp.json)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day23-ep22-script.md)

## Official docs

- Claude Code MCP quickstart: https://code.claude.com/docs/en/mcp-quickstart
- Claude Code MCP: https://code.claude.com/docs/en/mcp
- Playwright MCP: https://github.com/microsoft/playwright-mcp

---
[← Ep 21](../21-mcp-explained-and-choosing-servers) · [Course home](../../README.md) · [Ep 23 →](../23-spec-driven-development-and-openspec)
