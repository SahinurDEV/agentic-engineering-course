# Design

## Context
Discounts are applied in src/discounts.js, cart totals are worked out in src/cart.js, and the cart summary is shown by src/CartList.jsx. Shipping touches all three, so a short design is worth writing down before any code.

## Goals / Non-Goals

**Goals:**
- One place in the code decides the shipping fee
- Shipping is always based on the cart total after discounts

**Non-Goals:**
- Shipping rules by country, weight or delivery speed

## Decisions
- A new module, src/shipping.js, holds the rule: one function, shippingFor, and two constants, FREE_SHIPPING_THRESHOLD set to 50.00 and SHIPPING_FEE set to 4.99. Alternative considered: putting the rule inside src/cart.js. Not chosen, so the rule has one home and its own tests.
- src/cart.js applies discounts first, then asks src/shipping.js for the fee, then adds it to get the order total. This order is what makes the 55.00 with SAVE10 scenario come out right.
- Money is compared in whole cents, so a total of exactly 50.00 is at the threshold and never a fraction below it.
- The cart summary reads the fee and the amount still needed from src/cart.js. It does no shipping maths itself.

## Risks / Trade-offs
- Risk: floating point totals land a cent off the threshold. Mitigation: compare in cents, and test the exact 50.00 case.
- Trade-off: the threshold is a constant, so changing it needs a code change. Accepted for now.
