## ADDED Requirements

### Requirement: Search
Agents SHALL search tickets by words in the subject or the public replies. Internal notes SHALL NOT be searched. Search SHALL combine with the filters and stay in the page links.

#### Scenario: Words in the subject
- **WHEN** an agent searches for printer jam
- **THEN** only tickets with both words are listed

#### Scenario: Word in a reply
- **WHEN** a word appears only in a reply
- **THEN** the ticket is listed

#### Scenario: Word in a note
- **WHEN** a word appears only in an internal note
- **THEN** the ticket is not listed

#### Scenario: Search and a filter
- **WHEN** an agent searches for refund and filters by pending
- **THEN** only pending tickets about a refund are listed

#### Scenario: Next page
- **WHEN** a search has a next page
- **THEN** the next page link keeps the search
