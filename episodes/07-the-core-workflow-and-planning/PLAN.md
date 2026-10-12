# PLAN.md (example)

Assembled from the worked example slides in Episode 7 (discount code expiry on the small Node.js cart project). Written for the course; not Claude output.

## Goal
Expired codes are rejected. Codes without expiry work as before.

## Out of scope
- cart.js, gift cards, UI
- Changing existing codes

## Files to touch
- src/discounts.js
- test/discounts.test.js

## Steps
1. Optional expiry date per code
2. Reject if expiry has passed
3. Add tests
4. Run npm test
5. Review the diff, commit

## Risks
The expiry day itself. Decided: valid through that day.

## Verify
Four checks, written before any code exists. Today's date is passed in, so tests control it.
1. Future expiry: the code still applies
2. Expired: the code is rejected
3. Expiry day: still applies, as decided
4. Old tests: all still pass
