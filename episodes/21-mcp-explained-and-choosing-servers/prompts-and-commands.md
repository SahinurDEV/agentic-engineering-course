# Episode 21: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Commands (typed in your terminal; no output shown)

```text
claude mcp add --transport http claude-code-docs https://code.claude.com/docs/mcp
claude mcp add playwright -- npx -y @playwright/mcp@latest
claude mcp add --transport stdio db -- npx -y @bytebase/dbhub --dsn "postgresql://readonly:PASSWORD@localhost:5432/cart"
claude mcp list
claude mcp get github
claude mcp remove db
```

## Inside a session

```text
/mcp
```

## Permission rule names (illustrative)

```text
mcp__github__*
mcp__db__*
```

