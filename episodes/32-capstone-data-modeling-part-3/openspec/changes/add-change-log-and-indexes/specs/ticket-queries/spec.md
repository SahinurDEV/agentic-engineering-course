## ADDED Requirements

### Requirement: Query indexes
The schema SHALL have indexes for a customer's tickets, the category and assignee filters, a ticket's replies, notes and history, and search.

#### Scenario: Migrated schema
- **WHEN** the migrations have run
- **THEN** the eight indexes exist

### Requirement: Search
Search SHALL find tickets with every given word, in any form, in the subject or in a public reply. Internal notes SHALL NOT be searched.

#### Scenario: Words in the subject
- **WHEN** an agent searches for printer jam
- **THEN** only tickets with both words are found

#### Scenario: Word in a reply
- **WHEN** a word appears only in a reply
- **THEN** the ticket is found

#### Scenario: Word in a note
- **WHEN** a word appears only in an internal note
- **THEN** the ticket is not found

#### Scenario: Other form
- **WHEN** an agent searches for refunds
- **THEN** a ticket about a refund is found

### Requirement: No lazy loading
Outside production, reading a relationship that was not eager loaded on tickets loaded as a list SHALL throw.

#### Scenario: Missing eager load
- **WHEN** code reads the customer of a ticket from a list without eager loading
- **THEN** Laravel throws a lazy loading error
