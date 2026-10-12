## MODIFIED Requirements

### Requirement: Open a ticket
A customer SHALL open a ticket with a subject, a description and an active category. The app SHALL set the customer, the status and the priority, never the request. Archived categories SHALL NOT be offered or accepted for a new ticket, and existing tickets SHALL keep their category.

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

#### Scenario: Form lists active categories
- **WHEN** a customer opens the new ticket form
- **THEN** only categories that are not archived are listed

#### Scenario: Archived category sent
- **WHEN** a customer sends an archived category
- **THEN** no ticket is saved and the form shows an error

#### Scenario: Existing ticket keeps its category
- **WHEN** an admin archives a category that tickets use
- **THEN** those tickets keep the category
