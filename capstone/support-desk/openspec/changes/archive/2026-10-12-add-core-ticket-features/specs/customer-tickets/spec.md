## ADDED Requirements

### Requirement: Open a ticket
A customer SHALL open a ticket with a subject, a description and a category. The app SHALL set the customer, the status and the priority, never the request.

#### Scenario: Customer opens a ticket
- **WHEN** a customer sends a subject, a description and a category
- **THEN** a ticket is saved for that customer, open, with normal priority

#### Scenario: Missing fields
- **WHEN** the subject, description or category is missing
- **THEN** no ticket is saved and the form shows errors

#### Scenario: Request sends other fields
- **WHEN** the request also sends a customer, a status or a priority
- **THEN** they are ignored

#### Scenario: Agent tries to open a ticket
- **WHEN** an agent opens the new ticket form or sends it
- **THEN** the answer is 403

#### Scenario: Guest
- **WHEN** a guest opens the new ticket form
- **THEN** they are sent to the login page

### Requirement: Own tickets only
A customer SHALL see only their own tickets, newest first, and never internal notes.

#### Scenario: My tickets
- **WHEN** a customer opens my tickets
- **THEN** only their tickets are listed, newest first

#### Scenario: Another customer's ticket
- **WHEN** a customer opens a ticket that is not theirs
- **THEN** the answer is 404

#### Scenario: Ticket with a note
- **WHEN** a customer opens their ticket that has an internal note
- **THEN** the page does not include the note
