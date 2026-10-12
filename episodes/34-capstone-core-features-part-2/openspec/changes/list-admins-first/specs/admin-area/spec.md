## MODIFIED Requirements

### Requirement: Manage roles
An admin SHALL set each user's role to customer, agent or admin. A change that would leave no admin SHALL be refused. The users page SHALL list admins first, then agents, then customers.

#### Scenario: Set a role
- **WHEN** an admin sets a user's role to agent
- **THEN** the user is an agent

#### Scenario: Not an admin
- **WHEN** an agent or a customer opens the users page or sends a role
- **THEN** the answer is 403 and nothing changes

#### Scenario: Unknown role
- **WHEN** the role is not customer, agent or admin
- **THEN** nothing changes and the form shows an error

#### Scenario: Last admin steps down
- **WHEN** the only admin sets their own role to agent
- **THEN** the change is refused with "There must always be at least one admin."

#### Scenario: Two admins
- **WHEN** there are two admins and one sets their own role to agent
- **THEN** the change is saved

#### Scenario: Users page order
- **WHEN** an admin opens the users page
- **THEN** admins are listed first, then agents, then customers, each by name
