# Episode 30: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Capstone
Data Modeling 1

Agentic Engineering · Episode 30

Roles, categories and tickets

### Slide 2
Three

parts

Decide, review, then build.

01

Plan the
model

Explore, propose, review

02

Migrations,
reviewed

SQL read before it runs

03

Models and
tests

Apply, test, archive, PR

### Slide 3
01

Plan the
model

Decisions before code.

### Slide 4
Three parts

Data modeling, three episodes.

1

Today

Roles, categories, tickets.

2

Episode 31

Replies and internal notes.

Episode 32

log, indexes

Each ends

green

# data modeling
30: core tables
31: replies, notes
32: log, indexes
tickets come first

Illustration

### Slide 5
+ role column

3 roles

new table

name, archived_at

new table

7 fields

Three tables today

users

categories

tickets

### Slide 6
cmd    /opsx:explore
scope  roles, categories, tickets
read   users migration, User
ask    one question at a time
about  storage, deletes, admin

Illustration

>_

Explore
first

Thinking, not code.

Typed prompt only. No output shown.

Illustration

### Slide 7
Four

choices

Settled before any code.

01

Storage

Enum or string?

04

First admin

No password in git

02

Values

Enums in migrations?

03

Deletes

Cascade, null, restrict?

### Slide 8
Enum column
or string?

Plain string

Checked in PHP
Easy to extend
DB takes anything

On PostgreSQL: a check constraint.

Enum column

DB refuses bad values
Cast to PHP enums
New value: migration

We pick
enum

R10
fixes
the four statuses.

### Slide 9
# kit sign-up
create(name, email,
  password)
role: not fillable

Mass
assignment:
the is_admin case

from the Laravel docs

Role, guarded

A request can never set it.

1

default: customer

Sign-up sends role admin? Still a customer.

Illustration

### Slide 10
Their tickets
deleted too
unassigned
refused
R12 archives

Keys
3 on
tickets
 
Rules
all differ

If deleted
customer
agent
category
(archived instead)

On delete:
three answers

Three foreign keys
Each with its own rule.

Illustration

### Slide 11
cmd    /opsx:propose
name   add-core-data-model
scope  data layer only
not    screens, policies, replies
tasks  group 1: my migrations

Illustration

>_

Propose
the change

Plan only. Nothing built.

Typed prompt only. No output shown.

Illustration

### Slide 12
01

user-roles

3 requirements, 4 scenarios.

02

tickets

4 requirements, 5 scenarios.

Two capabilities

Named for lasting behaviour.

Reviewed versions, written for the course.

# the change
proposal.md, design.md
specs: 2 files
tasks.md: 4 groups

Illustration

### Slide 13
Review in order

Proposal

Specs

Design

Tasks

Commit

validate --strict, then commit the plan

### Slide 14
02

Migrations,
reviewed

The SQL, read before it runs.

### Slide 15
/new-migration
only I start it
Pre-approves
make, pretend
Last step
stop, don’t run

Why I make
them

The skill from module 7.

I run

migrate, myself

Schema changes are the hardest to undo.

### Slide 16
# /new-migration
add role to users
customer, agent, admin
default customer

New
migration,
kit file untouched

typed by me

Role column

Up adds it, down drops it.

1

new migration file

Never edit a migration that ran elsewhere.

Illustration

### Slide 17
Read the SQL

migrate --pretend, before running.

1

Check

Exactly three values.

2

Default

customer, for existing rows.

Not null

yes

Run it?

not yet

# role column
type: varchar + check
values: 3
not null
default: customer

Illustration

### Slide 18
unique

no duplicates

archived_at

date = archived

created, updated

as usual

Categories

name

archived

timestamps

### Slide 19
Keys
category: restrict
customer: cascade
assignee: set null
assignee nullable

Checks
2 enum
columns
 
Keys
3 foreign

Fields
subject: string
description: text
status, priority
open, normal

The tickets
table

Seven fields
Two checks, three keys.

Illustration

### Slide 20
Literal values,
not enums

In the app

TicketStatus enum
Can change later
Typed code

Docs show cases(); we chose literals.

In the migration

Plain values
A fixed snapshot
No app imports

Snapshot,
forever

Old
means
the same, always.

### Slide 21
run    php artisan migrate
undo   migrate:rollback --step=3
again  php artisan migrate
where  my machine only
then   tick group 1, tasks.md

Illustration

>_

Then I
run it

Up, down, up again.

Typed commands only. No output shown.

Illustration

### Slide 22
01

No indexes yet

They come with the inbox queries.

02

No replies yet

Their own table, their own rules.

Missing on purpose

In PostgreSQL, a foreign key adds no index.

Index only where a query needs it.

# not today
replies, notes: Ep 31
change log: Ep 32
indexes: Ep 32

Illustration

### Slide 23
03

Models and
tests

Apply, check, archive.

### Slide 24
Clear, then apply

Clear

Apply

Models

Seeder

Tests

Hooks: Pint on each edit, tests on Stop

### Slide 25
# app/Enums
Role
TicketStatus
TicketPriority

Defaults
twice:
database, model

written for the course

Enums and casts

Typed values, not strings.

3

string backed enums

A new ticket says open before it’s saved.

Illustration

### Slide 26
belongs to

category, 2 users

has many

tickets, assigned

has many

tickets

Relationships

Ticket

User

Category

### Slide 27
Asks
name, email
Password
twice, hidden
Validates
like a sign-up

The first
admin

An interactive seeder.

Exists?

does nothing

No admin password in git.

### Slide 28
Twelve new

tests

Three files, 52 in the suite.

01

Roles

4 tests

04

Suite

40 + 12 = 52

02

Tickets

6 tests

03

Seeder

2 tests

### Slide 29
Deletes
customer: tickets go
agent: unassigned
category: refused
proves part one

Seeder
expects
question
 
Result
12 green

Direct write
status: reopened
priority: critical
expect exception
failing line last

Tests that ask
the database

Skip the model
Only the database says no.

Illustration

### Slide 30
Then archive

Reviewer first, then the record.

1

Review

The reviewer reports, never edits.

2

Archive

Deltas merge into main specs.

Specs

2 files

Added

7 reqs

# openspec/specs
user-roles: 3
tickets: 4
change: archived
the record for Ep 31

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

Explore yours

Write your four answers down.

02

Skip the model

Write a bad value. Is it refused?

Your turn

Before Episode 31.

Own app? Same four questions.

# four answers
storage, values
deletes
first admin

Illustration

### Slide 33
Ready for
replies

Today

Roles, categories
Tickets, guarded
12 tests, 2 specs

One branch, one pull request.

Next

Public replies
Internal notes
One table or two?

R7 and
R8

Notes
stay
Hidden from customers.

### Slide 34
“

“Decide in plain words first.”

Then let the database hold the line.

### Slide 35
Episode 30

Recap

Decide, review, then build.

01

Plan
first

Explore, propose, review

02

SQL
read

3 migrations, rollback

03

Tested
model

12 tests, archived, PR

### Slide 36
Data Modeling

Next in the playlist

Episode 31: Capstone, Data Modeling Part 2.

EPISODE 31

Subscribe and turn on notifications for the playlist.

