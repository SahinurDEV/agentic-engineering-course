# discounts Specification

## Purpose
Describe how discount codes change the cart total in the cart project, including the SAVE10 code and code expiry dates.

## Requirements

### Requirement: SAVE10 discount
The cart SHALL take 10 percent off the cart total when the code SAVE10 is applied.

#### Scenario: Code applied to a normal cart
- **WHEN** the cart total is 50.00 and the user applies SAVE10
- **THEN** the total becomes 45.00

### Requirement: Total never below zero
The cart total MUST never go below 0 after discounts are applied.

#### Scenario: Discount larger than the total
- **WHEN** a discount would reduce the total below 0
- **THEN** the total is 0

### Requirement: Expiry dates
A discount code with an expiry date SHALL apply up to and including its expiry day, and SHALL be rejected after it.

#### Scenario: Code used on its expiry day
- **WHEN** the user applies a code on its expiry day
- **THEN** the discount applies

#### Scenario: Code used after its expiry day
- **WHEN** the user applies a code the day after its expiry day
- **THEN** the code is rejected and the total is unchanged
