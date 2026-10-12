# Spec Delta

## Purpose
Define how the cart works out the shipping fee and how it shows shipping to the shopper, including the free shipping threshold.

## ADDED Requirements

### Requirement: Flat shipping fee
The cart SHALL add a shipping fee of 4.99 when the cart total after discounts is above 0 and below 50.00.

#### Scenario: Small cart
- **WHEN** the cart total after discounts is 20.00
- **THEN** the shipping fee is 4.99 and the order total is 24.99

#### Scenario: Empty cart
- **WHEN** the cart is empty
- **THEN** the shipping fee is 0

### Requirement: Free shipping threshold
The cart SHALL charge no shipping when the cart total after discounts is 50.00 or more.

#### Scenario: Exactly at the threshold
- **WHEN** the cart total after discounts is exactly 50.00
- **THEN** the shipping fee is 0 and the order total is 50.00

#### Scenario: A discount takes the cart below the threshold
- **WHEN** the cart total is 55.00 and the user applies SAVE10
- **THEN** the cart total after discounts is 49.50, the shipping fee is 4.99, and the order total is 54.49

### Requirement: Shipping shown in the cart
The cart summary SHALL show a shipping line, and SHALL show how much more is needed for free shipping when the cart is below the threshold.

#### Scenario: Below the threshold
- **WHEN** the cart total after discounts is 42.00
- **THEN** the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping

#### Scenario: At or above the threshold
- **WHEN** the cart total after discounts is 60.00
- **THEN** the summary shows Shipping Free and no free shipping message
