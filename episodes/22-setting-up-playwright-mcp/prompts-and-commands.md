# Episode 22: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Command: add the server (from the Claude Code MCP quickstart)

```text
claude mcp add playwright -- npx -y @playwright/mcp@latest
claude mcp list
```

## Command: personal headless override (local scope, same name, so it wins over the project entry for you only)

```text
claude mcp add playwright -- npx -y @playwright/mcp@latest --headless --isolated --viewport-size 1280x720 --output-dir playwright-output
```

## Verification prompt (typed in a Claude Code session)

```text
Use playwright to open http://localhost:3000, add one item to the cart, apply the code SAVE10, and check that the total drops by 10 percent. Use snapshots to read the page. Save a screenshot as save10-check.png and report any console errors.
```

