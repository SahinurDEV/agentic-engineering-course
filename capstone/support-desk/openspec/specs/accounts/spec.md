# accounts Specification

## Purpose
How people get an account and get back into it (R1). Built by the starter kit with Laravel Fortify.

## Requirements

### Requirement: Register
A visitor SHALL register with a name, an email and a password, and is then signed in.

#### Scenario: New user registers
- **WHEN** a visitor sends a name, an email and a confirmed password
- **THEN** they are signed in and sent to the dashboard

### Requirement: Sign in and out
A user SHALL sign in with their email and password, and sign out. Repeated failed attempts SHALL be rate limited.

#### Scenario: Right password
- **WHEN** a user sends their email and the right password
- **THEN** they are signed in

#### Scenario: Wrong password
- **WHEN** a user sends a wrong password
- **THEN** they are not signed in

#### Scenario: Sign out
- **WHEN** a signed-in user signs out
- **THEN** they are a guest again

#### Scenario: Too many attempts
- **WHEN** a sign-in is tried again after five failed attempts
- **THEN** the answer is 429, too many requests

### Requirement: Reset a password
A user SHALL reset a forgotten password through a link sent by email.

#### Scenario: Ask for a link
- **WHEN** a user asks for a reset link with their email
- **THEN** a reset notification is sent to them

#### Scenario: Valid token
- **WHEN** a user sends a new password with a valid token
- **THEN** the password is changed

#### Scenario: Invalid token
- **WHEN** the token is not valid
- **THEN** the reset is refused with an error
