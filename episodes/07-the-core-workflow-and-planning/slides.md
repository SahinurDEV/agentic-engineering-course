# Episode 7: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
The Core Workflow
and Planning

Agentic Engineering · Episode 7

A free course on building software with AI agents

### Slide 2
Four

parts

Week 2 starts: turn prompts into a repeatable workflow, with the plan at its centre.

01

Why workflow

Repeatable beats ad hoc

04

Worked example

Discount code expiry

02

The loop

Explore, plan, build, verify, commit

03

A good plan

Contents, review, PLAN.md, size

### Slide 3
01

Why
workflow

Repeatable beats ad hoc.

### Slide 4
Ad hoc vs
a workflow

Ad hoc

Straight to code
Choices made for you
A surprise diff at the end

It can solve the wrong problem, well.

Workflow

Same steps, every time
Decisions in a plan
Checked before commit

Understand, decide,
build, prove, save

Routine
beats clever
Nothing fancy. The same steps on every task that matters.

### Slide 5
Caught in the plan

where mistakes are cheap

No surprises

The diff matches the plan

Proven, not "looks done"

A check at the end

What a workflow buys you

Right
problem

Reviewable

Verifiable

### Slide 6
02

The
loop

Explore, plan, implement, verify, commit.

### Slide 7
The core loop

Explore

Plan

Implement

Verify

Commit

Verify fails? Back to implement

### Slide 8
Illustration
> read src/discounts.js and the
  tests. How are codes applied?
> I want codes to expire. What
  files change? Create a plan.
  plan mode on

No edits
until you approve.

Ask first
then plan.

Two prompts
Explore: read, and ask how it works
Plan: which files, which steps
Research first, then plan
A plan without reading is a guess

Explore,
then plan

Plan mode
Shift+Tab or --permission-mode plan. Reads, no source edits.

### Slide 9
01

Implement

Against the plan, with the check named in the prompt.

02

Verify

Tests pass, then you read the evidence and the diff.

Build, prove, save

Verification fails? Back to implement, not on to commit.

/code-review gives a second opinion on the diff.

# illustration
> implement the plan, run npm test, fix failures
/code-review
> commit with a descriptive message

### Slide 10
Plan it
unsure approach
Plan it
many files
Skip it
one-sentence diff

Plan it, or
skip it?

Plan mode is useful, but it adds overhead.

Small?

just ask directly

Typo, log line, rename: no plan needed.

### Slide 11
03

Defining
a plan

What goes in, and how to review it.

### Slide 12
## Goal
## Out of scope
## Files to touch
## Steps
## Risks
## Verify

Illustration

>_

What goes
in a plan

Six parts, every time.

Self-contained: name the files, state what is out of scope, end with how to verify.

### Slide 13
Review the plan

Read it like a teammate's pull request before you approve.

?

Check four things

Files, step order, risks, and scope.

G

Ctrl+G

Edit the plan in your text editor.

Off?

Keep planning, say what to change

Scope creep?

Move extras to out of scope

# illustration
Plan: 5 steps, 2 files
Ready to code?
  Yes, approve the plan
> No, keep planning
  ctrl+g to edit in editor

### Slide 14
01

Write it to a file

After approval, save the plan to PLAN.md.

02

Fresh session, same plan

It survives /clear. Point at it with @.

Save it: PLAN.md

A plan in the conversation is gone after /clear. A file is not.

Big feature? Let Claude interview you, then write the spec.

# illustration
> save the approved plan to PLAN.md
/clear
> implement step 1 of @PLAN.md

### Slide 15
One-sentence diff

Skip the plan, just ask

A few files, clear goal

Plan mode, one session

Many files, unknowns

PLAN.md, one step per loop

Size the task

Small

Medium

Large

### Slide 16
Worked example:
code expiry

The request

Discount codes can expire
Expired codes are rejected
Existing codes unchanged

One feature on the cart project.

The process

Plan mode, explore first
Six-part plan
Review, save PLAN.md

Then execute it:
Episode 8

Plan first
code later
Every decision that matters is made before the first edit.

### Slide 17
Steps · Illustration
1 optional expiry date per code
2 reject if expiry has passed
3 add tests
4 run npm test
5 review the diff, commit

Risk
The expiry day itself.

Decided
Valid through that day.

Files to touch
src/discounts.js
test/discounts.test.js
Out of scope
cart.js, gift cards, UI
Changing existing codes

PLAN.md
(example)

Goal
Expired codes are rejected. Codes without expiry work as before.

### Slide 18
How to

verify

Four checks, written before any code exists. Today's date is passed in, so tests control it.

01

Future expiry

The code still applies

04

Old tests

All still pass

02

Expired

The code is rejected

03

Expiry day

Still applies, as decided

### Slide 19
“

“A plan is cheap to change. Code is not. Make the decisions where they’re cheap.”

The mental model for planning

### Slide 20
Episode 7

Recap

A repeatable loop, with the plan at its centre: decide before you build.

01

Why
workflow

Right problem, reviewable, proven

02

The
loop

Explore, plan, implement, verify, commit

03

A good
plan

Six parts, reviewed, saved, sized

### Slide 21
Executing the Plan

Next in the playlist

We build this exact PLAN.md, step by step.

EPISODE 8

Subscribe and turn on notifications for the playlist.

