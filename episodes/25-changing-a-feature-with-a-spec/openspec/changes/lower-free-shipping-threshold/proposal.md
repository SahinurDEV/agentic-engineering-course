# Proposal: Lower the free shipping threshold to 40.00

## Why
We want more shoppers to reach free shipping, so the threshold drops from 50.00 to 40.00.

## What Changes
- Free shipping starts at 40.00 after discounts, instead of 50.00
- The flat fee of 4.99 now applies below 40.00
- The summary message counts up to the new threshold

## Capabilities

### New Capabilities
None.

### Modified Capabilities
- `shipping`: the free shipping threshold moves from 50.00 to 40.00

## Impact
- One constant in src/shipping.js, and the tests that use 50.00
- No new dependencies

## Out of scope
- Changing the 4.99 fee
- Any change to discount codes
