# Episode 1: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
From Autocomplete
to Agent

Agentic Engineering · Episode 1

A free course on building software with AI agents

### Slide 2
On the agenda

Today

Three parts: what agentic engineering actually means, the shift from AI as autocomplete to AI as an agent (with a live demo), and why your engineering fundamentals matter more now, not less.

01

What agentic
engineering is

Model + tools + loop, and who owns the outcome

02

The shift: autocomplete
to agent

You drive, it suggests → it drives, you steer. Plus a live demo.

03

Why fundamentals
still matter

Specify, review, verify: where your effort goes now

### Slide 3
Understands and writes code

Takes actions, not just text

Read files, edit, run commands and tests

Search, change, and test code

Repeats until the goal is met

Step, check the result, next step

What is an AI coding agent?

Model

Tools

Loop

### Slide 4
Not a
slot machine.
A dependable
teammate.

Agentic
engineering

Building software by directing AI agents, while you own the outcome.

You own

the outcome

The agent does more of the hands-on-keyboard work. You decide what gets built and check that it’s correct.

### Slide 5
Who does what: the agent
and you

The agent does

Reads files, code, and errors
Edits the code
Runs commands, like your test suite

More of the hands-on-keyboard work.

You do

Define the goal
Give the right context
Set the constraints

Review what comes back
Verify that it’s correct

You own
the outcome
Someone has to stand behind the code. That is still you.

### Slide 6
01

The
shift

AI coding moved from autocomplete to agent.

### Slide 7
The autocomplete

loop

You write, the AI suggests, you accept, and then you do it all again. Every single step goes through you.

01

You write or ask

Some code, or a question

04

Repeat, manually

Over and over again

02

AI suggests or answers

A completion, or an answer

03

You accept and keep typing

Back to the keyboard

### Slide 8
The agent loop

Your goal

Read

Act

Verify

Done

Not done yet? Loop back

### Slide 9
// cart.js

function total(items) {
  return items.|
}

reduce(...)
map(...)
filter(...)

Tab to accept

Yesterday: AI
as autocomplete

You drive. It suggests.

1 file

at a time

No memory, no tools. It sees only what you paste in.

### Slide 10
> Add SAVE10: 10% off, add tests

Read  src/cart.js
Read  src/discounts.js
Edit  src/discounts.js
Run   npm test
      tests passed

Whole repos, tests, PRs

>_

Today: AI
as agent

It drives. You steer.

It works across whole repos. It reads, edits, runs your tests, and can even open pull requests.

### Slide 11
“

“The bottleneck is no longer typing. It’s specifying, reviewing, verifying.”

The line to remember from this episode

### Slide 12
Agent style
Read  the repo: cart, discounts, tests
Edit  discounts.js and its tests
Run   npm test, loop until green
You   review the diff

Chat
You did every step.

Agent
It looped. You reviewed.

Chat style
Paste a file into the chat
Copy the answer back by hand
Run the tests yourself, paste errors back

Demo: same
task, two ways

The task
Add a SAVE10 code: 10% off, total never below 0, with tests.

### Slide 13
Why fundamentals
still matter

Your effort moves from typing to judgment

In that demo, the effort did not go into typing. It went into three things: specifying, reviewing, and verifying.

This course won’t replace your fundamentals. It puts them to work.

Typing

now the cheap part

Your effort
moves to

Judgment

the real work now

1 Specify
2 Review
3 Verify

### Slide 14
01

Know what correct means

The agent can only aim at the target you give it.

02

Know the codebase

Edge cases, constraints, and where things belong.

1 · Specify

You can only get what you can clearly describe: goals, edge cases, constraints, structure.

Vague: “Add a discount.”
Spec: “10% off, never below 0, follow the existing pattern, add tests.”

### Slide 15
2 · Review

Fast, plausible-looking code still needs a critical human read.

+-

Read the diff like a PR

Check the rounding, the rules, and the tests.

!

Look for what hides

A bad abstraction, a security hole, a subtle bug.

Fast

A lot of code, quickly

Plausible

It usually looks right

$ git diff

+ SAVE10: 10% off
+ total never below 0
+ tests for SAVE10

? rounding in cents
? testing the right thing

### Slide 16
01

Know how and what to test

Good tests, real checks. A green run proves only what the tests check.

02

Check by hand when it counts

Know when a passing run is not enough.

3 · Verify

Passing tests mean something only if the tests are good.

In the demo, the agent ran npm test on its own. Your job is to make sure those tests test the right thing.

$ npm test
tests passed
# but do they check SAVE10 and the zero floor?

### Slide 17
Good engineering
fast, right direction

Weak engineering
fast mess

Agents are
amplifiers

Good engineering gets faster. Bad engineering gets messier, faster.

Amplified

whatever engineering you bring

Clear requirements, good structure, and real tests: it moves fast in the right direction.

### Slide 18
Episode 1

Recap

Agentic engineering means building software by directing AI agents, while you own the outcome.

01

Agent = model
+ tools + loop

It takes actions, not just writes text

02

It drives,
you steer

From autocomplete to agent

03

Fundamentals
decide the result

Specify, review, verify

### Slide 19
Claude Code 101

Next episode

How Claude Code works, and the anatomy of a session.

EPISODE 2

Subscribe and turn on notifications for the playlist.

