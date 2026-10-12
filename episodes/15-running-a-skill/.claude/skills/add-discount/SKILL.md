---
name: add-discount
description: Adds or changes a discount code in the cart project. Use when the user asks for a new code, an expiry date, or a change to a discount rule.
argument-hint: "[code] [percent-off]"
arguments: [code, percent]
allowed-tools: Bash(${CLAUDE_SKILL_DIR}/scripts/list-codes.sh *) Bash(git log *)
---

## Recent changes
!`git log -5 --oneline`

## Your task
Add or change discount code $code at $percent% off. If either value is empty, ask the user.
1. Run `${CLAUDE_SKILL_DIR}/scripts/list-codes.sh --all` to see the current codes.
2. Edit the codes table in src/discounts.js. See reference.md for the format.
3. Keep every amount in integer cents, never floats.
4. Add tests for the expiry edge cases: expired, expires today, timezone.
5. Run `npm test` after every edit and report the result.

## Additional resources
- Codes table format: see [reference.md](reference.md)
