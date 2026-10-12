# Episode 24: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
A Feature
from a Spec

Agentic Engineering · Episode 24

Free shipping, end to end with OpenSpec

### Slide 2
Three

parts

One new feature, from first prompt to archived spec.

01

Propose and
review

Read the plan first

02

Apply

Build it, task by task

03

Verify and
archive

Check, then file it

### Slide 3
01

Propose and
review

Before any code.

### Slide 4
The
feature

Today

No shipping line
Cost is a surprise
No nudge to add more

The threshold uses the total after discounts.

After

Below 50.00: 4.99
50.00 or more: free
Shows what’s still needed

Free over
50.00

One
change
add-free-shipping

### Slide 5
config.yaml, Ep 23

Context and rules

discounts, Ep 23

How SAVE10 works

Playwright, Ep 22

Check the real UI

Where we start

Config

Spec

Browser

### Slide 6
The whole walkthrough

Propose

Review

Apply

Verify

Archive

Two reviews: the plan, then the code

### Slide 7
type   /opsx:propose
what   Free shipping at 50.00+
       after discounts,
       else a flat 4.99
show   line, amount still needed

Illustration

>_

The propose
prompt

Typed in the chat.

Written for the course. Claude’s reply isn’t shown.

Illustration

### Slide 8
Review in this

order

Quit at the first file that’s wrong.

01

proposal

Right problem?

04

tasks

Sane plan?

02

specs

Done defined?

03

design

Sound approach?

### Slide 9
# proposal.md
## Why
## What Changes
## Out of scope

New capability
shipping
no modified ones

written for the course

proposal.md

The reviewed version.

Flags

scope

A different problem, grown scope, or vague words.

Illustration

### Slide 10
The delta spec

specs/shipping/spec.md. A new capability, so it has a Purpose.

1

Flat fee

4.99 below 50.00.

2

Threshold

Free at 50.00 or more.

Shown

line, amount needed

Format

SHALL, WHEN, THEN

# spec delta
## Purpose
## ADDED
3 requirements
6 scenarios

Illustration

### Slide 11
01

Exactly 50.00

Ships free, not one cent short.

02

55.00 with SAVE10

49.50 after discount: pays 4.99.

Key scenarios

The best catch is what’s missing.

Missing? Ask for it now.

# edge cases
WHEN total is 50.00
THEN shipping is 0
55.00 SAVE10: 54.49

Illustration

### Slide 12
Risk
a cent off 50.00
floating point
fix: whole cents
test exactly 50.00

Only
when needed
says the schema
 
Here,
it earns it

Decisions
src/shipping.js
Discounts first
Compare in cents
Summary does no maths

design.md

Why write one?
It crosses three files: discounts, cart, summary.

Illustration

### Slide 13
1. Rule
shipping.js, tests
2. Totals
cart.js, SAVE10
3. Summary
CartList.jsx

tasks.md

Four groups, each with checkboxes.

4. Check

npm test

Every task maps back to a requirement.

### Slide 14
Pushing back
is cheap

Edit it

Plain markdown
Tighten a requirement
Cut a task

Then validate the change, in strict mode.

Tell Claude

Say what’s wrong
It revises the file
Re-read the change

Either
works

Until
you’d sign it
A plan worth your name.

### Slide 15
02

Apply

Build it from the tasks.

### Slide 16
--strict passes

Format is right

The change folder

Plan in history

/clear

Fresh context

Before you apply

Validate

Commit

Clear

### Slide 17
fresh  /clear
build  /opsx:apply
         add-free-shipping
reads  the change folder
not    the old chat

Illustration

>_

Start the
build

A fresh session.

Typed commands only, no output.

Illustration

### Slide 18
What apply

does

From the OpenSpec commands reference.

01

Read

Unfinished tasks

04

Tick

Checkbox done

02

Work

One by one

03

Build

Code, tests

### Slide 19
Task by task

Rule

Tests

Totals

Summary

npm test

Resumes at the first open box

### Slide 20
Permissions
still asked
Escape
stops, keeps context
Tasks
a living checklist

While it
works

You’re still in charge.

Live plan

not a contract

Edit design.md, then run apply again.

### Slide 21
01

Spec is stale

Code is right: update the delta spec.

02

Code drifted

Spec is right: fix the code to match.

When they disagree

Reconcile before you archive.

Archive makes the spec the record.

# reconcile
which one is true?
fix the other one
then archive

Illustration

### Slide 22
03

Verify and
archive

Check, then file it.

### Slide 23
Tasks asked for
0, 20.00, 49.99
50.00, 60.00
the SAVE10 case
no test? add one

Each
scenario
has a test
 
Or
a new task

Scenarios
Small and empty cart
Exactly 50.00
55.00 with SAVE10
Below and above

Tests
first

npm test
Run it yourself, and read the result.

Illustration

### Slide 24
# check prompt
use playwright
42.00: 4.99 shown
50.00+: Free

Snapshots
to read the page
keep a screenshot

written for the course

In the browser

Playwright MCP, from Ep 22.

Run

dev server

Start it yourself. Report console errors too.

Illustration

### Slide 25
A second review

/opsx:verify re-reads the artifacts and the code.

1

Complete

Tasks, requirements.

2

Correct

Intent, edge cases.

Coherent

design shows in code

Profile

expanded, opt in

# verify flags
CRITICAL
WARNING
SUGGESTION
never blocks archive

Illustration

### Slide 26
What archive

does

/opsx:archive, once code and spec agree.

01

Check

Warns if unfinished

04

Move

Dated folder

02

Sync

Offers to merge

03

Merge

specs/shipping

### Slide 27
specs  openspec list --specs
show   openspec show shipping
all    openspec validate --all
save   git commit
loop   plan, build, verify, commit

Illustration

>_

After the
archive

Check, then commit.

Typed commands only, no output.

Illustration

### Slide 28
01

A new main spec

How shipping should behave, for people and agents.

02

The archived change

The why behind the code, with a date.

What the repo holds

Checked with OpenSpec 1.14.1.

Later change? A new change.

# openspec/
specs/discounts
specs/shipping
changes/archive/...

Illustration

### Slide 29
“

“Review the plan while it’s still just words.”

A wrong turn is cheapest there.

### Slide 30
Episode 24

Recap

One feature, from prompt to archived spec.

01

Propose,
review

Hunt for what’s missing

02

Clear,
apply

Task by task

03

Verify,
archive

Tests, browser, merge

### Slide 31
Changing a Feature
with a Spec

Next in the playlist

Episode 25 changes the shipping feature.

EPISODE 25

Subscribe and turn on notifications for the playlist.

