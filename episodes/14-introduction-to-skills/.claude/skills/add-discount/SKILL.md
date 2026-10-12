---
name: add-discount
description: Adds or changes a discount code in the cart project. Use when the user asks for a new code, an expiry date, or a change to a discount rule.
---

Add or change a discount code:
1. Edit the codes table in src/discounts.js. See reference.md for the format.
2. Keep every amount in integer cents, never floats.
3. Add tests for the expiry edge cases: expired, expires today, timezone.
4. Run `npm test` and report the result.

## Additional resources
- Codes table format: see [reference.md](reference.md)
- List current codes: run scripts/list-codes.sh
