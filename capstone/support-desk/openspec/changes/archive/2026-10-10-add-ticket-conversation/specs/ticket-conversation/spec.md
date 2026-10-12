## ADDED Requirements

### Requirement: Public replies
A ticket SHALL have public replies, each with a body and an author.

#### Scenario: Both sides reply
- **WHEN** the customer and an agent each reply
- **THEN** the ticket has two replies, with those authors

### Requirement: Notes apart from replies
Internal notes SHALL be stored apart from replies, so a ticket's replies never include a note.

#### Scenario: Ticket with both
- **WHEN** a ticket has a reply and a note
- **THEN** its replies hold only the reply

### Requirement: Note authors
Only an agent SHALL write an internal note. An admin counts as an agent.

#### Scenario: Customer writes a note
- **WHEN** a customer is the author of a note
- **THEN** the note is refused

### Requirement: Order
Replies and notes SHALL be listed in the order they were written.

#### Scenario: Edited reply
- **WHEN** an older reply is edited
- **THEN** it keeps its place

### Requirement: Authors and deletes
The author SHALL be set by the app, never by request input. A deleted ticket's replies and notes SHALL be deleted. A deleted author's replies and notes SHALL stay, with no author.

#### Scenario: Input sends an author
- **WHEN** reply input includes an author
- **THEN** it is ignored

#### Scenario: Author deleted
- **WHEN** an agent who replied is deleted
- **THEN** the reply stays, with no author

#### Scenario: Ticket deleted
- **WHEN** a ticket is deleted
- **THEN** its replies and notes are deleted
