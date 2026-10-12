# Episode 20: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Make the scripts executable

```text
chmod +x .claude/hooks/protect-files.sh .claude/hooks/format.sh .claude/hooks/stop-tests.sh
```

## What you type to test (no output shown)

```text
echo '{"tool_name":"Edit","tool_input":{"file_path":".env"}}' | .claude/hooks/protect-files.sh
echo $?
add a comment to the .env file
```

