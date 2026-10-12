# Episode 31: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Capstone
Data Modeling 2

Agentic Engineering · Episode 31

Public replies and internal notes

### Slide 2
Three

parts

Shape the data, then trust it.

01

Plan the
conversation

Explore, propose, review

02

Two
migrations

SQL read, rollback checked

03

Models and
tests

One test broken on purpose

### Slide 3
01

Plan the
conversation

One table or two, decided first.

### Slide 4
Episode 30
3 tables
Specs
2 capabilities
Tests
52 passing

Where we
left off

Varchar columns with checks.

Today

R7, R8, and R3

Customers never see internal notes.

### Slide 5
public

both sides read

internal

agents only

almost the same

body, author, time

Two kinds of message

reply

note

shape

### Slide 6
cmd    /opsx:explore
scope  R7, R8 in requirements.md
read   tickets migration, Ticket
ask    one question at a time
about  tables, authors, deletes, order

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

Tables

One or two?

04

Order

Which comes first?

02

Authors

Who sets them?

03

Deletes

What survives?

### Slide 8
One table
or two?

One table

is_internal flag
One model, one list
Filter everywhere

Forget the filter once: a leak.

Two tables

Replies, notes apart
Same columns
Timeline merges two

We pick
two

R3
keeps
notes from customers.

### Slide 9
One table
needs a filter
or a global scope
switched off
for agents

Safe
query is
the only
 
Policies
Ep 33, 34

Two tables
page loads replies
no path to notes
safe by shape
(policies still)

Why two
tables win

Loaded relations
They come along in JSON.

Illustration

### Slide 10
# reply input
body: fillable
author_id: dropped
addReply(user, body)

Mass
assignment:
silently dropped

from the Laravel docs

Author, in code

A request can never set it.

2

helpers set the author

Post as an agent? The field is dropped.

Illustration

### Slide 11
Two delete rules

Two foreign keys per table.

1

Ticket deleted

Its messages go too.

2

Author deleted

Messages stay, no author.

Account gone

tickets cascade

History

survives

# on delete
ticket_id: cascade
author_id: set null
author_id: nullable
shown as deleted user

Illustration

### Slide 12
01

Timestamps tie

Whole seconds on PostgreSQL.

02

No order by?

Rows come back unspecified.

Order: id, not time

Ids only grow.

Id order is the order written.

# relationships
replies: orderBy id
notes: orderBy id
every caller, for free

Illustration

### Slide 13
cmd    /opsx:propose
name   add-ticket-conversation
scope  data layer only
not    policies, screens, R10, indexes
tasks  group 1: my migrations

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

5 reqs, 7 scenarios, validate --strict

### Slide 15
02

Two
migrations

Read the SQL, check the rollback.

### Slide 16
# /new-migration
create replies
ticket: cascade
author: set null

Up
and down:
down drops the table

typed by me

Replies table

Pretend first, then stop.

2

foreign keys

Author names users: no authors table.

Illustration

### Slide 17
Read the SQL

migrate --pretend, before running.

1

Keys

Cascade, and set null.

2

Timestamps

Precision 0: whole seconds.

author_id

null allowed

Matches?

yes

# create table replies
ticket_id bigint not null
author_id bigint null
body text not null
timestamp(0), twice

Illustration

### Slide 18
migration 1

5 parts

migration 2

same 5 parts

why separate

change one alone

Same shape, twice

replies

notes

own file

### Slide 19
Foreign keys
2 cascade
2 set null
no is_internal
the table is the line

Tables
2 new
no flag
 
Keys
4 foreign

Columns
id, ticket_id
author_id
body
timestamps

What the SQL
shows

Two tables
Five parts each.

Illustration

### Slide 20
run    php artisan migrate
undo   migrate:rollback --step=2
again  php artisan migrate
where  my machine only
then   tick group 1, run tests

Illustration

>_

Then I
run them

Up, down, up again.

Typed commands only. No output shown.

Illustration

### Slide 21
Still not
here

Indexes

ticket_id lookups
FK adds no index
Episode 32

Chosen from the real queries.

Who may do what

Others’ tickets
Closed tickets, R10
Episodes 33, 34

On
purpose

Data
first
Rules stand on it.

### Slide 22
03

Models and
tests

Apply, test, break, archive.

### Slide 23
Clear, then apply

Clear

Apply

Models

Factories

Tests

Hooks: Pint on each edit, tests on Stop

### Slide 24
# app/Models
Reply
InternalNote
fillable: body only

Belongs
to:
ticket, author

written for the course

Two small models

Body in, author by code.

2

factories, ready for tests

A note factory’s author is an agent.

Illustration

### Slide 25
has many

ordered by id

has many

internalNotes, by id

create, associate

addReply, addNote

Ticket gets four methods

replies

notes

helpers

### Slide 26
addNote
agents only
Customer?
exception
Admin
counts as agent

Notes:
agents only

A fact about the data.

Backstop

policies check first

It throws, and nothing is saved.

### Slide 27
Eight new

tests

One file, 52 + 8 = 60.

01

Replies

2 tests

04

Deletes

2 tests

02

Notes

2 tests

03

Order, author

2 tests

### Slide 28
Real test
edits reply one
order by removed
test failed
restored: passed

Seen
it
fail
 
Then
trust it

Naive test
two replies
check the order
passes anyway
proves nothing

A test that
can fail

Edit the first reply
Disk order changes.

Illustration

### Slide 29
01

Exactly one reply

The note is not in replies.

02

Not in the JSON

The note’s text appears nowhere.

The leak test

Load replies, then toJson.

It pins the decision from part one.

# leak test
1 reply, 1 note
load replies, toJson
note text: absent

Illustration

### Slide 30
Then archive

Reviewer first, then the record.

1

Review

The reviewer reports, never edits.

2

Archive

Five requirements merge in.

Specs

3 capabilities

Added

5 reqs

# openspec/specs
user-roles
tickets
ticket-conversation
the record for Ep 32

Illustration

### Slide 31
Done means

Commit

Push

PR

CI

Merge

gh pr create --fill, CI on PostgreSQL

### Slide 32
01

Find the filter

List queries that must remember.

02

Remove an order by

Still passes? It tests nothing.

Your turn

Before Episode 32.

Public and private in one table?

# your risk list
shared tables
queries with a filter
tests never seen failing

Illustration

### Slide 33
Ready for
the log

Today

Replies, notes
Authors in code
8 tests, 3 specs

One branch, one pull request.

Next

Change log, R11
Who and when
Indexes from queries

R11 and
indexes

Log
every
status, priority, assignee.

### Slide 34
“

“Make the safe query the only query.”

Shape the data so the mistake is hard.

### Slide 35
Episode 31

Recap

Shape the data, then trust it.

01

Two
tables

No flag, no leak

02

Order
by id

Timestamps tie

03

Tested
change

8 tests, archived, PR

### Slide 36
Data Modeling

Next in the playlist

Episode 32: Capstone, Data Modeling Part 3.

EPISODE 32

Subscribe and turn on notifications for the playlist.

