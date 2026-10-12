# ticket-replies Specification

## Purpose
How replies are posted and how a reply changes the ticket status (R7, R10).

## Requirements

### Requirement: Reply on a ticket
Whoever can see a ticket SHALL add a public reply to it, unless the ticket is closed: the customer who owns it, and any agent. The app SHALL set the author.

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

### Requirement: Status rule on reply
A customer reply on a pending or resolved ticket SHALL set it to open, logged with the customer as the user. An agent reply SHALL NOT change the status. Closed tickets SHALL take no replies.

#### Scenario: Customer, open ticket
- **WHEN** a customer replies on an open ticket
- **THEN** it stays open and nothing is logged

#### Scenario: Customer, pending ticket
- **WHEN** a customer replies on a pending ticket
- **THEN** it becomes open, logged with the customer as the user

#### Scenario: Customer, resolved ticket
- **WHEN** a customer replies on a resolved ticket
- **THEN** it becomes open

#### Scenario: Customer, closed ticket
- **WHEN** a customer replies on a closed ticket
- **THEN** the answer is 403 and nothing is saved

#### Scenario: Agent, open, pending or resolved ticket
- **WHEN** an agent replies on an open, pending or resolved ticket
- **THEN** the status does not change

#### Scenario: Agent, closed ticket
- **WHEN** an agent replies on a closed ticket
- **THEN** the answer is 403 and nothing is saved
