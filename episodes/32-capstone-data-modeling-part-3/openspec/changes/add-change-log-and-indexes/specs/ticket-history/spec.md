## ADDED Requirements

### Requirement: Logged changes
Each change to a ticket's status, priority or assignee SHALL be logged with the old value, the new value, who made it and when.

#### Scenario: Status changed
- **WHEN** an agent sets an open ticket to pending
- **THEN** one entry records status, open, pending, that agent and the time

#### Scenario: Priority changed
- **WHEN** an agent sets the priority to urgent
- **THEN** one entry records priority, normal, urgent

#### Scenario: Assigned, then unassigned
- **WHEN** an agent assigns a ticket and then unassigns it
- **THEN** two assignee entries are recorded, in that order

### Requirement: Unchanged values
Setting a value the ticket already has SHALL NOT be logged.

#### Scenario: Same status
- **WHEN** an open ticket is set to open
- **THEN** no entry is recorded

### Requirement: Assignees
Only an agent SHALL be assigned. An admin counts as an agent.

#### Scenario: Customer assigned
- **WHEN** a customer is assigned to a ticket
- **THEN** it is refused, and nothing is saved or logged

### Requirement: History and deletes
A deleted ticket's history SHALL be deleted. A deleted user's entries SHALL stay, with no user.

#### Scenario: User deleted
- **WHEN** an agent who changed a ticket is deleted
- **THEN** the entry stays, with no user

#### Scenario: Ticket deleted
- **WHEN** a ticket is deleted
- **THEN** its history is deleted
