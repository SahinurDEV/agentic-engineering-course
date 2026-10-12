## ADDED Requirements

### Requirement: Inbox
Agents SHALL see an inbox of all tickets, newest first, 25 per page. Customers SHALL NOT see the inbox.

#### Scenario: Agent opens the inbox
- **WHEN** an agent opens the inbox with 26 tickets
- **THEN** the first page lists the newest 25, and there are 2 pages

#### Scenario: Customer opens the inbox
- **WHEN** a customer opens the inbox
- **THEN** the answer is 403

#### Scenario: No N + 1
- **WHEN** the inbox lists 3 tickets, and then 25
- **THEN** both pages run the same number of queries

### Requirement: Filters
Agents SHALL filter the inbox by status, priority, category and assignee. Filters SHALL combine, and SHALL stay in the page links.

#### Scenario: Status and priority
- **WHEN** an agent filters by pending and urgent
- **THEN** only pending, urgent tickets are listed

#### Scenario: Category
- **WHEN** an agent filters by a category
- **THEN** only that category's tickets are listed

#### Scenario: Assignee
- **WHEN** an agent filters by an agent, or by unassigned
- **THEN** only tickets assigned to that agent, or to nobody, are listed

#### Scenario: Unknown value
- **WHEN** a filter has a value that does not exist
- **THEN** that filter is ignored

#### Scenario: Next page
- **WHEN** a filtered inbox has a next page
- **THEN** the next page link keeps the filters
