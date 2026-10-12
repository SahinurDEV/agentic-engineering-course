## ADDED Requirements

### Requirement: Status and priority
Agents SHALL change a ticket's status and priority. Each change SHALL be logged with who made it.

#### Scenario: Agent changes both
- **WHEN** an agent sets an open, normal ticket to pending and urgent
- **THEN** both are saved, and two entries are logged with that agent

#### Scenario: Customer tries
- **WHEN** a customer changes the status of their own ticket
- **THEN** the answer is 403 and nothing changes

#### Scenario: Unknown status
- **WHEN** the request sends a status that does not exist
- **THEN** it is refused and nothing changes

### Requirement: Assignment
Agents SHALL assign a ticket to any agent, or unassign it. An admin counts as an agent. Each change SHALL be logged.

#### Scenario: Assign
- **WHEN** an agent assigns a ticket to another agent
- **THEN** the ticket has that assignee, and the change is logged with the agent who made it

#### Scenario: Unassign
- **WHEN** an agent chooses unassigned
- **THEN** the ticket has no assignee

#### Scenario: Customer as assignee
- **WHEN** an agent tries to assign a customer
- **THEN** it is refused and nothing is logged

#### Scenario: Customer assigns
- **WHEN** a customer tries to assign their own ticket
- **THEN** the answer is 403

### Requirement: Internal notes
Agents SHALL add internal notes and see them on the ticket page. Customers SHALL NOT add or receive notes.

#### Scenario: Agent adds a note
- **WHEN** an agent adds a note
- **THEN** it is saved with the agent as author

#### Scenario: Agent reads notes
- **WHEN** an agent opens a ticket with a note
- **THEN** the page includes the note and its author

#### Scenario: Customer tries
- **WHEN** a customer adds a note on their own ticket
- **THEN** the answer is 403, nothing is saved, and their page has no notes

#### Scenario: Empty note
- **WHEN** the note body is empty
- **THEN** nothing is saved and the form shows an error

### Requirement: Change log on the ticket
The ticket page SHALL show every logged change with the field, the old and new value, who made it and when, to everyone who can see the ticket.

#### Scenario: Status change
- **WHEN** an agent has set a ticket to pending
- **THEN** the page shows status, open, pending and the agent's name

#### Scenario: Assignee names
- **WHEN** the customer opens a ticket that was assigned
- **THEN** the page shows the assignee's name, not an id

#### Scenario: Deleted assignee
- **WHEN** an assigned agent's account was deleted
- **THEN** the page shows a deleted user
