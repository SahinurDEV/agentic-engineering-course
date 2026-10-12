# user-roles Specification

## Purpose
The three roles, customer, agent and admin, and how users get them.

## Requirements

### Requirement: Roles
Every user SHALL have one role: customer, agent or admin. An admin SHALL count as an agent.

#### Scenario: Admin
- **WHEN** a user is an admin
- **THEN** they count as an agent and as an admin

#### Scenario: Customer
- **WHEN** a user is a customer
- **THEN** they do not count as an agent

### Requirement: New sign-ups are customers
A new sign-up SHALL be a customer, whatever the request sends.

#### Scenario: Sign-up sends a role
- **WHEN** someone registers with role admin
- **THEN** the new user is a customer

### Requirement: First admin
A seeder SHALL create the first admin from details it asks for, and SHALL do nothing if an admin exists.

#### Scenario: Admin exists
- **WHEN** the seeder runs and an admin exists
- **THEN** no user is created
