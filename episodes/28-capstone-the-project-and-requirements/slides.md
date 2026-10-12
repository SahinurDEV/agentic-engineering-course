# Episode 28: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Capstone
Requirements

Agentic Engineering · Episode 28

The project, and what version one must do

### Slide 2
Three

parts

One real app, requirements first.

01

The
project

Support Desk, stack, scope

02

The
requirements

One file, every line testable

03

How we’ll
build it

Course tools, episode plan

### Slide 3
01

The
project

What we build, and why.

### Slide 4
From cart
to capstone

So far: cart

Small examples
One feature each
A few files

Good for learning one tool.

Capstone

One whole app
Roles and rules
Every tool

Same habits,
bigger stage

One
app
Start to finish.

### Slide 5
# Support Desk
customers: open
agents: reply, resolve
admins: set up

One place
for every
customer question

written for the course

The pitch

A small company’s support desk.

3

roles, one ticket queue

A familiar app, so we focus on building it well.

Illustration

### Slide 6
A ticket’s life

Opened

Assigned

Replies

Resolved

Closed

A customer reply reopens a resolved ticket

### Slide 7
Laravel 13
PHP 8.3 or newer
React kit
Inertia, React 19
PostgreSQL
swap from SQLite

The
stack

From the Laravel docs.

Auth

Fortify, in the kit

The stack our module 7 skills target.

### Slide 8
Why this

project

Four kinds of real.

01

Roles

Who sees what

04

Interface

Inbox, filters

02

Data

Tickets, notes, log

03

Rules

Reopen, closed

### Slide 9
Not in v1
email, attachments
SLA timers, chat
translations
AI replies

Out is
written
down
 
Drift?
file says no

In v1
Tickets, replies
Internal notes
Assign, status
Search, admin

How big is
version one?

Version one
Finishable in six episodes.

Illustration

### Slide 10
02

The
requirements

One file, every line testable.

### Slide 11
Requirements
or specs?

Requirements

Whole product
One page
Rarely changes

We use both, in that order.

Specs

One feature
Scenarios
OpenSpec change

Map, then
streets

Trace
back
Each spec to an R.

### Slide 12
goal   one place for questions
stack  Laravel, React, Postgres
roles  customer, agent, admin
new    sign-ups are customers
admin  first one from a seeder

Illustration

>_

requirements
.md

The top of the file.

Written for the course. Summary view.

Illustration

### Slide 13
Opens tickets

Sees own only

Every ticket

Replies, assigns

Agent, plus

Categories, roles

Three roles

Customer

Agent

Admin

### Slide 14
# ticket: 7 fields
subject, description
category, status
priority, customer

Assignee
may be empty
until assigned

from requirements.md

The ticket

What it holds, not how.

7

fields, no columns yet

Storage decisions come in data modeling.

Illustration

### Slide 15
Status and priority

From requirements.md.

4

Statuses

Open, pending, resolved, closed.

4

Priorities

Low, normal, high, urgent.

New status

open

New priority

normal

# status
open: agent acts
pending: wait on customer
resolved: fixed?
closed: final

Illustration

### Slide 16
The twelve

R lines

R1 to R12, four groups.

01

Customer

R1 to R3

04

Records

R11 and R12

02

Inbox

R4 to R6

03

Working

R7 to R10

### Slide 17
Agent reply
status unchanged
pending is set
on purpose
closed: refused

Cases
4 + 2
= 6
 
Tests
at least 6

Customer reply
open: stays open
pending: open
resolved: open
closed: refused

R10, the
status rule

A customer replies on
Four statuses, three outcomes.

Illustration

### Slide 18
01

Name the check

Policy, migration, test, browser.

02

From the docs

Feature tests, no lazy loading.

Quality requirements

Five rules for every feature.

Q1 to Q5 in requirements.md.

# Q1 to Q5
policies, migrations
tests in CI, phone width
no N + 1 queries

Illustration

### Slide 19
# a wish
the inbox is fast
# testable
25 per page, no N + 1

Ask
how would I
prove it broken?

written for the course

Make it testable

A wish can’t fail.

1

question per line

A sharp line gives the agent a sharp target.

Illustration

### Slide 20
Messages
email, live chat
Extras
files, translations
Later
SLA, AI replies

Out of
scope

Written down in the file.

6 items

all out of v1

Stops scope creep, in you and in Claude.

### Slide 21
Done means

Spec

Tests

CI green

Review

Merge

Archived spec, green CI, reviewed merge

### Slide 22
03

How we’ll
build it

Nine course topics, six episodes.

### Slide 23
CLAUDE.md

Points to the file

Plan mode, grill-me

Questions first

OpenSpec changes

Reviewed first

Before the code

Memory

Planning

Specs

### Slide 24
Four

guards

While Claude works.

01

Skills

React, security, DB

04

Review

Reviewer subagent

02

Hooks

Protect, format, test

03

MCP

Playwright browser

### Slide 25
run    claude
flag   --permission-mode plan
read   docs/requirements.md
ask    one question at a time
then   list edits, no code

Illustration

>_

Check it
first

Plan mode blocks edits.

Typed prompt only, no output.

Illustration

### Slide 26
Notes included?

R6 is silent

Last admin?

R12 is silent

Edit category?

No R covers it

Gaps still open

Search

Roles

Tickets

### Slide 27
The road ahead

From the course plan.

1

Setup

Episode 29.

2

Data modeling

Episodes 30 to 32.

Features

Ep 33 and 34

Finale

Ep 35

# six build episodes
29: setup
30 to 32: data
33 and 34: features
then 35: field notes

Illustration

### Slide 28
Core features,
two halves

Episode 33

R2, R3, R4
R5, R7
Usable end to end

R1 is checked during setup.

Episode 34

R6, R8, R9
R10, R11, R12
Agent tools

1 + 5 + 6
= 12

Each
once
All twelve covered.

### Slide 29
One requirement, one PR

Issue

Propose

Apply

PR + CI

Archive

R numbers link issue, spec, tests, PR

### Slide 30
One at a time
migrations
shared tables
on the main line
then build on top

Clean
merge
not proof
 
Shared
one track

In parallel
Search
Admin area
Own branches
Review one by one

Parallel,
safely

Episode 34 worktrees
Separate files, separate trees.

Illustration

### Slide 31
01

Find the gaps

List what the file doesn’t answer.

02

Prove it broken

Pick R3 or R10, write the check.

Your turn

Before Episode 29.

Own app? Keep the same shape.

# same shape
goal, roles
R lines, Q lines
out of scope, done

Illustration

### Slide 32
PHP
8.3 or newer
Composer
+ Laravel installer
Node, npm
or Bun

What to
have ready

From the Laravel docs.

Plus

PostgreSQL, git

And Claude Code, which you already have.

### Slide 33
“

“Requirements first. Code second.”

Every line something you can test.

### Slide 34
Episode 28

Recap

One real app, requirements first.

01

Support
Desk

Laravel, React, Postgres

02

12 R lines,
5 Q lines

Out of scope, done

03

R10:
6 cases

Each R built once

### Slide 35
Project Setup

Next in the playlist

Episode 29: Capstone, Project Setup.

EPISODE 29

Subscribe and turn on notifications for the playlist.

