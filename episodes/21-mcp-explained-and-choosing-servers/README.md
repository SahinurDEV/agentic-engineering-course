# Episode 21: MCP Explained and Choosing Servers

**Watch:** https://youtu.be/LsesoYD5lXg  
**Playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54  
**Covers:** M9: Introduction to MCP, Choosing MCP Servers  
**Length:** ~10 min

## What this episode covers

In this episode we explain the Model Context Protocol (MCP): hosts, clients and servers; the tools, resources and prompts a server offers; and the stdio and HTTP transports. Then we add and manage servers in Claude Code with claude mcp add, the local, project and user scopes, a shared .mcp.json with secrets in environment variables, sign-in through /mcp, and what servers cost in context (tool search, output limits). Finally, four questions for choosing any server: do you need it, do you trust it, what is the least access it needs, and what does it cost.

Note: screens are drawn illustrations. The examples are written for the course; facts come from the Claude Code docs and modelcontextprotocol.io. Servers named are examples from the official docs, not endorsements.

## Chapters

```text
0:00 Reaching tools outside your project
0:31 Intro and what we'll cover
0:51 What MCP is
2:51 Adding and managing servers
6:28 Choosing servers: four questions
9:03 Recap and next episode
```

## Files in this folder

Paths mirror where each file lives in a project, so you can copy them in place. Files under `user-level/` belong in your home folder (`~/`), not the project.

- [`.mcp.json`](.mcp.json)
- [`prompts-and-commands.md`](prompts-and-commands.md)

- [`slides.md`](slides.md): on-screen text from the episode's slides and illustrations
- [Narration script](../../scripts/day22-ep21-script.md)

## Official docs

- Claude Code MCP: https://code.claude.com/docs/en/mcp
- Model Context Protocol: https://modelcontextprotocol.io

---
[← Ep 20](../20-hooks) · [Course home](../../README.md) · [Ep 22 →](../22-setting-up-playwright-mcp)
