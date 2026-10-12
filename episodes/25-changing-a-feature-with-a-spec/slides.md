# Episode 25: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Changing a
Feature

Agentic Engineering · Episode 25

Free shipping from 40.00, with a spec

### Slide 2
Three

parts

Change an archived feature, the spec-first way.

01

A new
change

Update or start new

02

The delta
spec

MODIFIED, and checks

03

Apply, verify,
archive

Tests, browser, record

### Slide 3
01

A new
change

The old one is history.

### Slide 4
Update, or
start new?

Update

Same goal, refined
Better approach
Narrower scope

Our change is archived, so this one is new.

Start new

Intent has changed
Scope is new work
Different work

Refine, or
begin again

New
change
Against the main spec.

### Slide 5
specs/shipping

3 requirements, 6 scenarios

add-free-shipping

Why it was built

A constant: 50.00

Design said: change it

What we start from

Spec

Archive

Code

### Slide 6
type   /opsx:propose
what   Lower the free shipping
       threshold: 50.00 to 40.00
keep   the 4.99 fee
keep   everything else

Illustration

>_

The propose
prompt

Say what must not change.

Written for the course. Claude’s reply isn’t shown.

Illustration

### Slide 7
Review the

plan

Same order as last time.

01

proposal

Modifies shipping

04

tasks

5 tasks, 3 groups

02

specs

Part two

03

design

None needed

### Slide 8
02

The delta
spec

MODIFIED, done right.

### Slide 9
MODIFIED

It replaces the whole requirement when you archive.

1

Copy

The entire block.

2

Match

The header, exactly.

Edit

to the new behavior

Purpose

not for existing specs

# spec delta
## MODIFIED
### Requirement:
#### Scenario: ...
all scenarios, whole

Illustration

### Slide 10
01

Fee and threshold

50.00 becomes 40.00 in both sentences.

02

Shipping shown

Same sentence, but 42.00 now ships free.

The ripple

One number, three requirements.

A false scenario must change.

# scenarios
exactly 40.00: free
44.00 SAVE10: 44.59
42.00 becomes 32.00

Illustration

### Slide 11
# delta, counted
3 MODIFIED
6 scenarios
3 changed

Also counted
2 new sentences
no ADDED/REMOVED

written for the course

By the numbers

They match the file exactly.

Copied

3 unchanged

Each block is copied whole, so 3 scenarios stay as they were.

Illustration

### Slide 12
Header renamed
validate still passes
but notes the refusal
archive refuses
no files changed

Read
everything
validate says
 
Not just
the last line

Scenario left out
Strict validate: error
Archive refuses
No files changed
Copy the block whole

What it
checks

Two mistakes, on purpose
Tried in a throwaway copy, OpenSpec 1.14.1.

Illustration

### Slide 13
Reason
why it goes
Migration
what to use instead
Whole
requirement only

And
REMOVED?

Not needed here.

All three

still hold

Dropping part of a requirement is MODIFIED.

### Slide 14
Before you build

Validate

Diff

Commit

Clear

Apply

show --diff: before and after

### Slide 15
03

Apply, verify,
archive

Then the record.

### Slide 16
Threshold

Constant, tests

Discount case

44.00 with SAVE10

Check

npm test, browser

Five tasks, three groups

2 tasks

1 task

2 tasks

### Slide 17
fresh  /clear
build  /opsx:apply
         lower-free-shipping-
         threshold
test   npm test

Illustration

>_

Apply

In a fresh session.

Typed commands only, no output.

Illustration

### Slide 18
01

Tests

Exactly 40.00 and 32.00 fail on 50.00.

02

Browser

The summary text depends on it.

Verify the change

Old 50.00 tests: changed, not left.

No summary code task needed.

# tests
39.99, 40.00, 60.00
44.00 SAVE10: 44.59
npm test

Illustration

### Slide 19
# check prompt
use playwright
32.00: 4.99 shown
60.00: Free

Snapshots
to read the page
console errors

written for the course

In the browser

Playwright MCP, from Ep 22.

32.00

Add 8.00 more

At 60.00: Shipping Free, and no message.

Illustration

### Slide 20
Archive

it

What it did in our throwaway run.

01

Check

The tasks

04

Move

Dated folder

02

Sync

The delta

03

Replace

3 requirements

### Slide 21
Main spec
40.00 everywhere
Archive
2 shipping changes
Git
the code

The record
now

Why 40.00? It’s written down.

Commit

loop closed

The archived proposal answers why, with a date.

### Slide 22
“

“Change one number, then read every scenario.”

The review catches the ripple.

### Slide 23
Episode 25

Recap

A change to a feature is a new change.

01

Copy the
whole block

Match the header

02

Fix false
scenarios

One number, 3 blocks

03

Validate,
then apply

Verify, archive

### Slide 24
GitHub
Integration

Next in the playlist

Episode 26 starts Module 11.

EPISODE 26

Subscribe and turn on notifications for the playlist.

