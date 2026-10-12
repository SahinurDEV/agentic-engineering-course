## ADDED Requirements

### Requirement: Manage categories
An admin SHALL create, rename and archive categories. A category name SHALL be required and unique. Categories SHALL be archived, never deleted.

#### Scenario: Create a category
- **WHEN** an admin sends a new name
- **THEN** the category is saved

#### Scenario: Missing or taken name
- **WHEN** the name is empty or already used
- **THEN** nothing is saved and the form shows an error

#### Scenario: Rename a category
- **WHEN** an admin sends a new name for a category
- **THEN** the category has the new name

#### Scenario: Archive a category
- **WHEN** an admin archives a category
- **THEN** the category is marked archived and still exists

#### Scenario: Not an admin
- **WHEN** an agent or a customer opens the categories page or sends a change
- **THEN** the answer is 403 and nothing changes

### Requirement: Manage roles
An admin SHALL set each user's role to customer, agent or admin. A change that would leave no admin SHALL be refused.

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
