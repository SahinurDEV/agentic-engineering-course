## ADDED Requirements

### Requirement: Ticket fields
A ticket SHALL have a subject, description, category, status, priority and customer, and MAY have an assignee.

#### Scenario: Defaults
- **WHEN** a customer opens a ticket
- **THEN** it is open, normal priority and unassigned

### Requirement: Allowed values
The database SHALL refuse a status other than open, pending, resolved or closed, and a priority other than low, normal, high or urgent.

#### Scenario: Unknown status
- **WHEN** a ticket is saved with status reopened
- **THEN** the database refuses it

### Requirement: Categories
Category names SHALL be unique. A category in use SHALL be archived, never deleted.

#### Scenario: Delete a used category
- **WHEN** a category with tickets is deleted
- **THEN** the database refuses it

### Requirement: Deleted users
A deleted customer's tickets SHALL be deleted. A deleted assignee's tickets SHALL become unassigned.

#### Scenario: Agent deleted
- **WHEN** an assigned agent is deleted
- **THEN** their tickets have no assignee

#### Scenario: Customer deleted
- **WHEN** a customer deletes their account
- **THEN** their tickets are deleted
