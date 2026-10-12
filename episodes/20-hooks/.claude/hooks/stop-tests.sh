#!/bin/bash
# Stop hook: keep Claude working while the test suite fails, once.
INPUT=$(cat)
if [ "$(echo "$INPUT" | jq -r '.stop_hook_active')" = "true" ]; then
  exit 0
fi

cd "$CLAUDE_PROJECT_DIR" || exit 0
if OUTPUT=$(php artisan test); then
  exit 0
fi

LAST_LINES=$(echo "$OUTPUT" | tail -n 20)
jq -n --arg reason "The test suite is failing. Fix the failures before you finish. Last lines: $LAST_LINES" '{decision: "block", reason: $reason}'
exit 0
