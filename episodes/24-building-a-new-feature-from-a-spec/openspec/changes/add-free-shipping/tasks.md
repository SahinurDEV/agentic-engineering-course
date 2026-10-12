# Tasks

## 1. Shipping rule

- [ ] 1.1 Create src/shipping.js with FREE_SHIPPING_THRESHOLD, SHIPPING_FEE and shippingFor, comparing money in whole cents
- [ ] 1.2 Add tests for cart totals of 0, 20.00, 49.99, 50.00 and 60.00

## 2. Cart totals

- [ ] 2.1 In src/cart.js, apply discounts first, then add shipping to get the order total
- [ ] 2.2 Return the amount still needed for free shipping
- [ ] 2.3 Add a test for a 55.00 cart with SAVE10 giving an order total of 54.49

## 3. Cart summary

- [ ] 3.1 Show the shipping line in src/CartList.jsx, as 4.99 or Free
- [ ] 3.2 Show the message Add X more for free shipping when the cart is below the threshold

## 4. Check

- [ ] 4.1 Run npm test and fix any failures
