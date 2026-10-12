# Episode 16: edits and excerpts

Changes to existing files, and summarised versions of longer files, as shown in this episode (copied from the episode script). The full files are in this folder where available and in [capstone/support-desk](../../capstone/support-desk) for the final app.

## Example `SPEC.md` shape for the cart (written by hand for the course, not Claude output)

```markdown
# SPEC: Two discount codes on one order

## Goal
A customer can apply up to two discount codes to one order.

## Out of scope
Checkout redesign. Gift cards.

## Decisions (from the interview)
- Percent codes apply before fixed codes.
- The same code can't be used twice on one order.
- The discount never takes the total below zero.

## Files and interfaces
- src/discounts.js and its tests

## Edge cases
- One of the two codes is expired.
- Both codes are the same.
- All amounts stay in integer cents.

## Verification (end to end)
- A test for each edge case above, then `npm test` for the full suite.
```

