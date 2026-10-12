# Episode 34: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Capstone
Core Features 2

Agentic Engineering · Episode 34

Decisions, worktrees, all 12 done

### Slide 2
Three

parts

Decide first. Then build.

01

Decide and
plan

Three decisions, two plans

02

Build in two
worktrees

Two branches, one merge

03

Test and
finish

Tests, phone, done

### Slide 3
01

Decide and
plan

Three answers, then two plans.

### Slide 4
Episode 33
first screens
Specs
8 capabilities
Tests
94 passing

Where we
left off

6 of 12 requirements done.

Today

R6, R8 to R12

After today: all twelve.

### Slide 5
R6

search

R8 to R11

notes, status, log

R12

categories, roles

Six to go

find

work

admin

### Slide 6
cmd    /opsx:explore
scope  R6, R8 to R12
gaps   three, from Ep 28
plus   can the work split?
ask    one question at a time

Illustration

>_

Explore
the gaps

Decisions before code.

Typed prompt only. No output shown.

Illustration

### Slide 7
Four

questions

Three decisions, one split.

01

Search

Notes included?

04

Split

Two at once?

02

Admins

The last one?

03

Category

Customer edits?

### Slide 8
Search the
notes?

Include

Useful words
Two search paths
Easy to leak

Notes hold error codes.

Leave out

Subject, replies
Built in Ep 32
One public rule

We pick
leave out

D1
notes
are not searched.

### Slide 9
Allow
zero admins
no role changes
no categories
database by hand

Last
admin
stays
 
Others
may step down

Refuse
one admin left
role stays admin
clear message
two? one may go

The last admin

D2: refuse it
There must always be one.

Illustration

### Slide 10
# after opening
subject: fixed
category: fixed
say so: reply

D3
no
customer edits

including the category

Wrong category?

Not in the twelve requirements.

3

decisions in the requirements

Committed on main first.

Illustration

### Slide 11
Two worktrees

Two halves that rarely meet.

1

Ticket work

Policy, ticket page, inbox.

2

Admin area

New controllers and pages.

Shared

routes file

Merge

small

# branches
add-ticket-work
  main checkout
add-admin-area
  ../support-desk-admin

Illustration

### Slide 12
01

Customer

4 cases: stay, reopen x2, refuse.

02

Agent

2 cases: unchanged, refuse.

R10 in six cases

As corrected in episode 28.

Six cases, six tests.

# reply on ...
open: stays open
pending, resolved: open
closed: refused

Illustration

### Slide 13
git    worktree add ../support-desk-admin
       -b add-admin-area
setup  composer, npm ci, .env
db     its own test database
plan   one propose per folder

Illustration

>_

Two worktrees,
two plans

Each folder set up alone.

Typed commands only. No output shown.

Illustration

### Slide 14
Two plans, reviewed

Proposal

Spec

Design

Tasks

Commit

Both plans, validate --strict

### Slide 15
02

Build in two
worktrees

Two branches, then one merge.

### Slide 16
# TicketPolicy
reply: not if closed
update: agents
addNote: agents

Owner
403,
others 404

agents only, kindly

TicketPolicy, extended

Two new abilities, one new rule.

6

abilities in the policy

Closed: no replies, for anyone.

Illustration

### Slide 17
One change route

PATCH, checked with can update.

1

Validate

Only fields that are sent.

2

Save

Model methods, one transaction.

Assignee

agents only

Log

for free

# UpdateTicketRequest
sometimes
Rule::enum
none to null
agent or admin

Illustration

### Slide 18
if     closed: refuse
tx     one transaction
add    the reply
if     customer + pending/resolved
then   status open, logged

Illustration

>_

Reply rules
in the model

Ticket::respond

Drawn summary of the code. No output.

Illustration

### Slide 19
Never
internal notes
a second path
an error page
lost on page 2

D1
one test
proves it
 
R6
done

Inbox
q, trimmed
100 characters
plus 4 filters
links keep it

Search, not notes

Ep 32 scope
Subject and replies only.

Illustration

### Slide 20
Notes and
activity

Notes

R8
Agents only
Loaded for agents

Two audiences, one page.

Activity

R11
Everyone on it
Names, one query

Not loaded,
not leaked

Null
notes
for every customer.

### Slide 21
# ticket page
manage form
notes, activity
closed: one line

Can
flags
from the policy

the page only reads them

The ticket page

Three selects, one save button.

3

new sections for agents

The inbox gets a search box.

Illustration

### Slide 22
01

The form

Active categories only.

02

The request

Archived ones refused.

Archive, don’t delete

Old tickets keep their category.

The form helps. The request rules.

# Category
scope: active()
archive(): archived_at
exists, whereNull

Illustration

### Slide 23
Last admin, locked

Decision two, safe at the same moment.

1

Lock

Admin rows, lockForUpdate.

2

Check

Only admin, stepping down?

Refused

error shown

Else

saved

# updateRole
transaction
lock admin rows
count 1, it is you?
at least one admin

Illustration

### Slide 24
Conflict
routes/web.php
the use lines
update controller
vs Category

Git
merged
the rest
 
Tests
in worktree

Order
tickets to main
main to admin
fix, test
admin to main

One merge conflict

Keep both
Both imports are needed.

Illustration

### Slide 25
Merge in order

Ticket work

Into admin

All tests

Admin in

Remove

Each merge is a pull request with CI

### Slide 26
03

Test and
finish

Tests, a phone, done.

### Slide 27
agents work

admins manage

closed, roles

customers edit

every change

who and what

What the tests prove

allowed

refused

logged

### Slide 28
Break 1
no reopen rule
Result
cases 2, 3 fail
Restore
all green

Break it
twice

Then put it back.

Break 2

last admin check

One test failed, then green.

### Slide 29
01

Three people

Agent, customer, admin.

02

One finding

Admins first on users.

Phone check

390 by 844, with Playwright.

No sideways scroll. Server stopped.

# phone check
search, note, close
closed message
last admin error

Illustration

### Slide 30
39 new

tests

94 + 39 = 133, all passing.

01

Search, notes

9 tests

04

Admin area

14 tests

02

Assign, status

7 tests

03

Replies, log

9 tests

### Slide 31
archived

in openspec/specs

pass in CI

every one

reviewed

and merged

Three conditions for done

spec

tests

PR

### Slide 32
Audit for done

R1 to R12

R1 spec

Archive

CI check

Merge

11 capabilities, every requirement

### Slide 33
Twelve of
twelve

Your turn

Decide one gap
Write it down
Two worktrees

One decision, one folder.

Done

12 requirements
11 capabilities
133 tests

Next:
the finale

Three
roles
each with their own screens.

### Slide 34
“

“Decide it, write it down, then build it.”

Decisions first, code second.

### Slide 35
Episode 34

Recap

Decide first. Then build.

01

Three
decisions

Notes, admin, category

02

Two
worktrees

One conflict, fixed

03

All twelve
done

39 tests, specs, merged locally

### Slide 36
Field Notes

Next in the playlist

Episode 35: Field Notes and Wrap-Up, the finale.

EPISODE 35

Subscribe and turn on notifications for the playlist.

