## ADDED Requirements

### Requirement: Reply on a ticket
Whoever can see a ticket SHALL add a public reply to it: the customer who owns it, and any agent. The app SHALL set the author.

#### Scenario: Customer replies
- **WHEN** a customer replies on their own ticket
- **THEN** the reply is saved with the customer as author

#### Scenario: Agent replies
- **WHEN** an agent replies on any ticket
- **THEN** the reply is saved with the agent as author

#### Scenario: Another customer's ticket
- **WHEN** a customer replies on a ticket that is not theirs
- **THEN** the answer is 404 and nothing is saved

#### Scenario: Empty reply
- **WHEN** the reply body is empty
- **THEN** nothing is saved and the form shows an error

#### Scenario: Request sends an author
- **WHEN** the request also sends an author
- **THEN** it is ignored
