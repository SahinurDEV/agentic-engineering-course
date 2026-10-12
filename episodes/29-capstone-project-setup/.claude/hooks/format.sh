#!/bin/bash
# PostToolUse hook for Edit and Write: format the edited file.
# Support Desk version: the React kit formats with Vite+ (vp fmt), not Prettier.
FILE_PATH=$(jq -r '.tool_input.file_path // empty')
cd "$CLAUDE_PROJECT_DIR" || exit 0

case "$FILE_PATH" in
  *.php) ./vendor/bin/pint "$FILE_PATH" ;;
  *.js|*.jsx|*.ts|*.tsx|*.css) npx vp fmt "$FILE_PATH" ;;
esac

exit 0
