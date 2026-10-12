# Episode 32: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Capstone
Data Modeling 3

Agentic Engineering · Episode 32

The change log and the indexes

### Slide 2
Three

parts

Log every change. Index from evidence.

01

Plan the log
and queries

Explore, propose, review

02

Migrations
and EXPLAIN

Before and after, on volume

03

Code and
tests

Log, search, lazy loading

### Slide 3
01

Plan the log
and queries

Four questions, then a plan.

### Slide 4
Episode 31
2 tables
Specs
3 capabilities
Tests
60 passing

Where we
left off

Replies and notes, apart.

Today

R11, R4 to R6, Q5

Log changes. Index the busy queries.

### Slide 5
4 values

open to closed

4 values

low to urgent

an agent

or nobody

Three things to log

status

priority

assignee

### Slide 6
cmd    /opsx:explore
scope  R11, R3 to R6, Q5
read   Ticket, migrations
ask    one question at a time
about  log, writer, indexes, search

Illustration

>_

Explore
first

Thinking, not code.

Typed prompt only. No output shown.

Illustration

### Slide 7
Four

questions

Settled before any code.

01

Shape

One table?

04

Search

Subjects, replies?

02

Writer

Who logs it?

03

Indexes

Which queries?

### Slide 8
One log
or three?

Per field

status from, to
Real types
Three sources

One timeline means merging.

One table

field, old, new
who, when
Values as text

We pick
one

R11
one
timeline on the ticket.

### Slide 9
Model event
runs on save
who? unknown
reads sign-in
seeders: none

Who
is passed
in
 
Error
rolls back

Methods
changeStatus
changePriority
assignTo
take the user

Who writes
the entry?

One transaction
Both saved, or neither.

Illustration

### Slide 10
# an entry
same value: none
assignee: agents
UPDATED_AT = null

Never
edited:
created_at only

checked in the throwaway

Rules for an entry

Small rules, decided now.

3

rules from explore

Assign a customer? It throws.

Illustration

### Slide 11
Deletes, again

Two foreign keys, two answers.

1

Ticket deleted

Its history goes too.

2

User deleted

Entries stay, no user.

Pattern

as Episode 31

History

keeps shape

# on delete
ticket_id: cascade
user_id: set null
user_id: nullable
shown as deleted user

Illustration

### Slide 12
01

List the queries

Inbox, filters, lists, search.

02

Ask PostgreSQL

EXPLAIN on a volume copy.

Ask, don’t guess

Each index costs every write.

Empty tables make every plan fast.

# queries to check
inbox, newest first
customer, filters
EXPLAIN ANALYZE

Illustration

### Slide 13
cmd    /opsx:propose
name   add-change-log-and-indexes
scope  data layer only
not    policies, screens, R10
tasks  group 1: migrations, EXPLAIN

Illustration

>_

Propose
the change

Plan only. Nothing built.

Typed prompt only. No output shown.

Illustration

### Slide 14
Review in order

Proposal

Spec

Design

Tasks

Commit

7 reqs, 13 scenarios, validate --strict

### Slide 15
02

Migrations
and EXPLAIN

Measure, index, measure again.

### Slide 16
# /new-migration
create ticket_changes
ticket: cascade
user: set null

Field
check:
three names only

typed by me

ticket_changes

Pretend first, then stop.

7

columns in the table

Index: ticket_id, then id.

Illustration

### Slide 17
Read the SQL

migrate --pretend, before running.

1

Field

A varchar with a check.

2

Keys

Cascade, and set null.

created_at

not null

Matches?

yes

# create table ticket_changes
field varchar check
old_value varchar null
new_value varchar null
index (ticket_id, id)

Illustration

### Slide 18
db     support_desk_explain
env    DB_DATABASE, then migrate
fill   psql -f seed-volume.sql
rows   100,000 tickets
then   psql -f explain.sql

Illustration

>_

A copy with
volume

Never the dev database.

Typed commands only. No output shown.

Illustration

### Slide 19
Slow
customer: scan
replies: scan
rare values
search: scans

Read
100,000
rows
 
Found
5

Fast
inbox, newest
status open
busy agent
pkey, backward

Before:
EXPLAIN said

Primary key
Inbox and open: fast.

Illustration

### Slide 20
Busy agent,
new agent

Busy agent

4,000 tickets
~500 rows read
Fast

Same query, different value.

New agent

2 old tickets
99,998 rows skipped
Slow

Test rare
values

Plan
per
value, not per query.

### Slide 21
# /new-migration x3
tickets: 3 + full text
replies: 1 + full text
notes: 1

Not
indexed:
status, priority

EXPLAIN said no need

Index migrations

One migration per table.

8

new indexes in total

Foreign key first, id second.

Illustration

### Slide 22
01

Leading column

Equality first, then id order.

02

Deletes too

FK checks can use it.

Why the id at the end?

From the PostgreSQL docs.

Scanned backward for newest first.

# one index serves
customer_id = ?
order by id desc
limit 25

Illustration

### Slide 23
Same expression

GIN: the preferred text index.

1

Index

to_tsvector, english.

2

Query

The same expression.

simple?

table scan

Language

set twice

# tickets_subject_fulltext
using gin
to_tsvector(
  'english', subject)
query: same expression

Illustration

### Slide 24
Still pkey
busy agent
status open
planner chose
not a gap

Read
2
rows
 
Search
next

Now indexed
customer
new agent
new category
replies

After:
EXPLAIN

New indexes
Rare values: 2 rows.

Illustration

### Slide 25
Run, roll back, run

Migrate

Rollback

Migrate

Copy

Tests

rollback --step=4, still 60 passing

### Slide 26
03

Code and
tests

Log, search, lazy loading.

### Slide 27
has many

ordered by id

3 methods

status, priority, assign

a scope

subject or reply

Ticket gets new methods

history

change

search

### Slide 28
saveAndLog
one helper
No change?
no write
Customer?
exception

Saved
together

Or not at all.

R10, later

reopen is logged

The customer shows up as the user.

### Slide 29
01

With or

Subject index unused.

02

With union

Both full text indexes.

Search: union, not or

Same results, better plan.

Notes are not searched (R6).

# search scope
ids: subject matches
union reply matches
then those tickets

Illustration

### Slide 30
13 new

tests

Two files, 60 + 13 = 73.

01

Change log

7 tests

04

Lazy loading

1 test

02

Indexes

1 test

03

Search

4 tests

### Slide 31
up to 76

queries for 25 rows

at most 4

with relationships

throws

outside production

Q5: no N + 1

lazy

eager

guard

### Slide 32
Review, archive, merge

Review

Archive

Commit

PR

Merge

+7 requirements, 5 capabilities, CI

### Slide 33
Data layer
done

Your turn

EXPLAIN a list
Try a rare value
Block lazy loads

Count what breaks.

Done

Every table
Who and when
73 tests, 5 specs

Next:
features

Built
on
evidence, not guesses.

### Slide 34
“

“Don’t guess where the index goes. Ask the database.”

EXPLAIN first, index second.

### Slide 35
Episode 32

Recap

Log every change. Index from evidence.

01

Change
log

Who, when, together

02

EXPLAIN
first

Rare values too

03

Tested
change

13 tests, archived, PR

### Slide 36
Core Features

Next in the playlist

Episode 33: Capstone, Core Features Part 1.

EPISODE 33

Subscribe and turn on notifications for the playlist.

