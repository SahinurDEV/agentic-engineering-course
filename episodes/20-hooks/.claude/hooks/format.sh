#!/bin/bash
# PostToolUse hook for Edit and Write: format the edited file.
FILE_PATH=$(jq -r '.tool_input.file_path // empty')
cd "$CLAUDE_PROJECT_DIR" || exit 0

case "$FILE_PATH" in
  *.php) ./vendor/bin/pint "$FILE_PATH" ;;
  *.js|*.jsx|*.ts|*.tsx) npx prettier --write "$FILE_PATH" ;;
esac

exit 0
