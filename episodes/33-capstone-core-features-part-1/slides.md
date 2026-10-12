# Episode 33: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Capstone
Core Features 1

Agentic Engineering · Episode 33

Tickets, inbox, filters, replies

### Slide 2
Three

parts

Policy first. Pages second.

01

Plan the
screens

Explore, propose, review

02

Build the
pages

Policy, routes, React

03

Test and
check

Tests, browser, review

### Slide 3
01

Plan the
screens

Four questions, then a plan.

### Slide 4
Episode 32
8 indexes
Specs
5 capabilities
Tests
73 passing

Where we
left off

Data layer done.

Today

R2, R3, R4, R5, R7

After today: usable end to end.

### Slide 5
R2, R3

open, own list

R4, R5

inbox, filters

R7

public replies

Who gets what

customers

agents

both

### Slide 6
cmd    /opsx:explore
scope  R2 to R5, R7; Q1, Q4, Q5
read   routes, Ticket, specs
ask    one question at a time
about  access, privacy, filters, pages

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

Access

Where are checks?

04

Screens

Who finds what?

02

Privacy

Not your ticket?

03

Filters

Unknown values?

### Slide 8
Where do
checks live?

Controllers

Gate per method
Spread out
Easy to miss

One missed call is a leak.

Routes

can middleware
One policy
One file

We pick
routes

Q1
every
ticket action, one policy.

### Slide 9
Forbidden
says it exists
try numbers
learn real ids
clear, but leaky

Others
get
404
 
Agents
see all

Not found
hides the ticket
same as missing
ids tell nothing
policy decides

403 or 404?

denyAsNotFound
From the Laravel docs.

Illustration

### Slide 10
# ticket page loads
category, people
replies + authors
notes: never

Only
the fields
the page shows

picked in the controller

What a customer sees

Never load what must stay hidden.

0

notes sent to the page

Agents don’t open tickets.

Illustration

### Slide 11
Safe filters

From the address bar, so checked.

1

Known values

Enum values, numbers, none.

2

Anything else

Ignored, never an error.

Links

keep filters

Order

id desc

# /inbox?status=deleted
tryFrom: null
filter skipped
no error page
withQueryString

Illustration

### Slide 12
01

Four pages

Mine, new, ticket, inbox.

02

Sidebar by role

Answers from the policy.

Four pages, one sidebar

React reads, the server decides.

No worktrees: shared files today.

# pages
tickets/index, create
tickets/show, inbox
auth.can

Illustration

### Slide 13
cmd    /opsx:propose
name   add-core-ticket-features
scope  policy, pages, tests
not    search, notes, R10
tests  one per scenario

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

5 reqs, 21 scenarios, validate --strict

### Slide 15
02

Build the
pages

Policy first, then pages.

### Slide 16
# TicketPolicy
viewAny: agents
view: agent or owner
create: customers

Else
404:
denyAsNotFound

found by its name

TicketPolicy

One class, every ticket rule.

4

abilities in the policy

reply = view, until R10.

Illustration

### Slide 17
Checks on routes

The can middleware, per route.

1

With a ticket

Name the route parameter.

2

No ticket yet

Pass the Ticket class.

Guests

to login

Requests

validate

# routes/web.php
create: Ticket class
show: view, ticket
replies: reply, ticket
inbox: viewAny

Illustration

### Slide 18
index  own tickets, 25 a page
form   subject, category, text
store  customer from session
flash  toast: Ticket opened.
show   replies, never notes

Illustration

>_

Customer
side

R2 and R3.

Drawn summary of the code. No output.

Illustration

### Slide 19
Avoided
lazy loads
raw input
filter errors
lost filters

Q5
no
N + 1
 
Links
keep filters

Inbox
with: 3 relations
when: 4 filters
order: id desc
25 per page

The inbox query

Eager loading
One query per relation.

Illustration

### Slide 20
Form and
filters

Form

Inertia Form
Wayfinder action
Errors per field

Two ways to send data.

Filters

router.get
preserveState
replace history

Inertia
both

URL
holds
the filters, so links work.

### Slide 21
# reply form
author: signed-in user
resetOnSuccess
preserveScroll

Not
yet:
closed tickets

R10, Episode 34

Replies

Whoever can see it can reply.

1

form for both sides

Agent replies say Support.

Illustration

### Slide 22
01

Share

auth.can, from the policy.

02

Read

usePage in the sidebar.

Sidebar by role

Pattern from the Laravel docs.

The route still checks every visit.

# auth.can
openTicket: create
viewInbox: viewAny
server decides

Illustration

### Slide 23
Phone width first

Q4 shaped the markup.

1

Rows stack

Side by side from sm up.

2

Filters

Two per row on a phone.

Keys

ticket ids

Subjects

truncated

# ticket-list.tsx
flex-col
sm:flex-row
key: ticket.id
truncate

Illustration

### Slide 24
Symptom
page tests fail
not in manifest
new pages
not a code bug

Docs
dev server
or build
 
CI
builds first

Fix
npm run build
run alone
tests green
CI builds too

One trap: Vite

Build once
Or run the dev server.

Illustration

### Slide 25
Apply in order

Access

Customer

Inbox

Replies

Checks

5 groups, generated files never edited

### Slide 26
03

Test and
check

Tests, a browser, a reviewer.

### Slide 27
right person

right page

403, 404

or login page

bad input

author, filters

What the tests prove

allowed

refused

ignored

### Slide 28
Break it
no owner check
Result
2 tests fail
Restore
all green

Break it on
purpose

Then put it back.

Q5

queries counted

3 tickets or 25: same count.

### Slide 29
01

Customer

Open a ticket, reply.

02

Agent

Filters, next page.

Phone check

390 by 844, with Playwright.

No sideways scroll. Server stopped.

# phone check
viewport 390 x 844
scroll width = width
console errors

Illustration

### Slide 30
21 new

tests

Four files, 73 + 21 = 94.

01

Open ticket

5 tests

04

Replies

5 tests

02

Own tickets

4 tests

03

Inbox

7 tests

### Slide 31
PHP style

passed

analysis

passed

format, lint

passed

Three more checks

Pint

PHPStan

vp check

### Slide 32
Review, archive, merge

Review

Archive

Commit

PR

Merge

+5 requirements, 8 capabilities, CI

### Slide 33
Usable end
to end

Your turn

403 or 404?
Share an ability
Route still checks

Pick one page.

Done

Open and reply
Inbox, filters
94 tests, 8 specs

Next:
part two

Server
decides
and React follows.

### Slide 34
“

“The server decides. The page only follows.”

Policies first, pages second.

### Slide 35
Episode 33

Recap

Policy first. Pages second.

01

One
policy

On the routes, 404

02

Four
pages

Customer and agent

03

Tested
change

21 tests, browser, PR

### Slide 36
Core Features

Next in the playlist

Episode 34: Capstone, Core Features Part 2.

EPISODE 34

Subscribe and turn on notifications for the playlist.

