# Proposal: Free shipping over 50.00

## Why
Shoppers can't see what shipping will cost until the end, and they have no reason to add one more item. A clear free shipping threshold fixes both.

## What Changes
- Add a flat shipping fee of 4.99 to carts below 50.00
- Make shipping free when the cart total after discounts is 50.00 or more
- Show the shipping line in the cart summary, and how much more is needed for free shipping

## Capabilities

### New Capabilities
- `shipping`: how the cart works out the shipping fee and shows it to the shopper

### Modified Capabilities
None.

## Impact
- New module src/shipping.js. src/cart.js adds shipping to the order total. The cart summary in src/CartList.jsx shows the shipping line.
- New tests in the existing node --test suite, run with npm test.
- No new dependencies.

## Out of scope
- Shipping by country, weight or delivery speed
- Any change to how discount codes work
