#!/bin/bash
# PreToolUse hook for Edit and Write: deny edits to protected files.
INPUT=$(cat)
FILE_PATH=$(echo "$INPUT" | jq -r '.tool_input.file_path // empty')

deny() {
  jq -n --arg reason "$1" '{hookSpecificOutput: {hookEventName: "PreToolUse", permissionDecision: "deny", permissionDecisionReason: $reason}}'
  exit 0
}

if [[ "$FILE_PATH" == *".."* ]]; then
  deny "Blocked: paths containing .. are not allowed."
fi

PROTECTED=(".env" ".git/" "composer.lock" "package-lock.json")
for pattern in "${PROTECTED[@]}"; do
  if [[ "$FILE_PATH" == *"$pattern"* ]]; then
    deny "Blocked: $FILE_PATH is protected ($pattern). Ask the user to change it."
  fi
done

exit 0
