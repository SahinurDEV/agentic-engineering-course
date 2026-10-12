# Episode 6: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Controlling Context and
Writing Good Prompts

Agentic Engineering · Episode 6

A free course on building software with AI agents

### Slide 2
Four

parts

Control what stays in context, then write prompts that put the right things in.

01

Clear or compact

Two moves, different jobs

04

A prompt template

Goal, context, limits, check

02

Rewind, resume

Checkpoints, sessions, subagents

03

Good vs bad prompts

Four pairs on the cart project

### Slide 3
01

Controlling
context

Decide what stays.

### Slide 4
Start over

Empty context, new task

Keep a summary

Same task, long session

Go back

To an earlier checkpoint

Three moves

Clear

Compact

Rewind

### Slide 5
Clear or
compact?

/clear

New, unrelated task
Empty context, costs nothing
/rename first, /resume later

The old conversation is not deleted.

/compact

Same task, long session
Keeps a summary
Add a focus

A large request
on a big context

New task:
clear
Same task, long session: compact with a focus.

### Slide 6
01

Compact with a focus

Tell it what to keep, instead of letting it guess.

02

Make it permanent

Add "Compact instructions" to CLAUDE.md.

Keep what matters

Auto-compaction near the limit has to guess what matters.

Your own /compact can say what to keep.

/compact focus on the discount rules
# Compact instructions
Focus on test output and code changes

### Slide 7
Rewind

Every prompt creates a checkpoint. Go back when an approach goes sideways.

2x

Esc Esc or /rewind

On an empty prompt. Pick an earlier prompt.

!

Limits

Edits made by shell commands are not tracked.

Summarize

From here, or up to here

Not git

Commit what you want to keep

# illustration: rewind
> Restore code and conversation
  Restore conversation
  Restore code
  Summarize from here
  Never mind

### Slide 8
$ claude --continue
$ claude --resume
  pick a session from the list
> /rename discount-work
> /resume
> /branch

Illustration

>_

Pick it
back up

They outlive the terminal.

--continue resumes the latest one here. --resume and /resume open a picker. /branch tries another direction.

### Slide 9
Subagents keep it clean

Main

Hand
off

Own
context

Summary

Main
clean

Deeper in Episodes 12 and 13

### Slide 10
/mcp
disable unused
CLI tools
over MCP

Trim what
loads

MCP tool names and server instructions take up context before they are used.

/context

see what it costs

Prefer CLI tools like gh. They add no tool listing.

### Slide 11
02

Good and
bad prompts

Decide what goes in.

### Slide 12
Pair 1: vague
vs specific

Before

"Fix the discount bug."

Which bug? Where? What does fixed mean?

After

SAVE10 is wrong on 1999
Look at @src/discounts.js
Failing test first, then fix

Symptom, location,
what fixed means

Be
specific
Describe the symptom, the likely location, and what fixed looks like.

### Slide 13
01

Before

"Add a SAVE20 code." It stops when it looks done.

02

After

Name the tests, run npm test, fix failures.

Add a check

Pair 2. Without a check, "looks done" is the only signal.

With tests, Claude iterates until they pass.

> add SAVE20 (20% off). Test a normal cart,
  an empty cart, and a total under the discount.
  Run npm test and fix any failures.

### Slide 14
Illustration
> /plan add an expiry date
  to discount codes,
  discounts.js only.
  Expired codes are rejected.
  Test valid and expired codes.

One prompt
one change.

One sentence?
Skip the plan.

After: one change at a time
1  Expiry date for discount codes
2  Discounts file only
3  Gift cards: a later prompt
4  Big change? Plan mode first

Pair 3:
scope it

Before
"Add coupons, gift cards, and a loyalty points system."

### Slide 15
Patterns, limits

Pair 4. Point at the pattern to follow, and state the limits.

P

Point at the pattern

The discounts map in discounts.js.

!

State the limits

Cents, no new deps, never below 0.

Before

"Add a free shipping code."

Why

One file read saves the guessing

# illustration
> add a free shipping code.
  Follow the DISCOUNTS map
  in discounts.js. Cents.
  No new dependencies.
  Never below 0.

### Slide 16
A prompt

template

Four parts. For a small fix, one sentence each is enough.

01

Goal

What is true when it is done

04

Verification

How it checks its own work

02

Context

Files, symptom, error, pattern

03

Constraints

Rules, and what not to do

### Slide 17
Goal    expired codes are rejected
Context DISCOUNTS in src/discounts.js
Limits  follow the pattern, no deps,
        cart.js unchanged
Verify  test valid, expired, today;
        then run npm test

Illustration

>_

Filled
in

Expiry, in four lines.

Almost every decision that matters is made before Claude starts.

### Slide 18
Kitchen sink
correction loop
No verification
unscoped search

Anti-
patterns

Most are named in Anthropic's own best practices guide.

Fix

clear, check, scope

Vague on purpose is fine when exploring. Vague by accident is not.

### Slide 19
“

“A good prompt decides what goes into context. Clear, compact, and rewind decide what stays.”

The mental model for this episode

### Slide 20
Episode 6

Recap

Control what stays with clear, compact, and rewind. Control what goes in with better prompts.

01

Clear, compact,
rewind

New task, long task, wrong turn

02

Resume,
subagents

--continue, /resume, own context

03

The
template

Goal, context, constraints, verification

### Slide 21
Week 1, done

Agents

Claude
Code

Controls

A
session

Context

Next: Week 2, the core workflow

### Slide 22
The Core Workflow
and Planning

Next in the playlist

Week 2 starts here: a repeatable way of working.

EPISODE 7

Subscribe and turn on notifications for the playlist.

