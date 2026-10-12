# Episode 23: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Spec-Driven
Development

Agentic Engineering · Episode 23

And getting started with OpenSpec

### Slide 2
Three

parts

Agree on what to build, and keep the record.

01

Spec-
driven

From plans to specs

02

Installing
OpenSpec

Install, init, config

03

The
workflow

Artifacts and commands

### Slide 3
01

Spec-driven
development

Specs before code.

### Slide 4
Chat only or
spec first

Chat only

Requirements in chat
The session ends
Results unpredictable

README: unpredictable when requirements live only in chat.

Spec first

Agree before code
Written in the repo
Kept after the build

Chat, or
files

Specs
in the repo
Not in a chat that ends.

### Slide 5
The loop

Saved PLAN.md

Grill me

Wrote SPEC.md

Specs that stay

The system’s record

You’ve done this already

Ep 7

Ep 16

OpenSpec

### Slide 6
Fluid
not rigid
Iterative
not waterfall
Brownfield
not just greenfield

The OpenSpec
idea

Its philosophy, from the README.

One folder

per change

Update any file in it at any time. No rigid phase gates.

### Slide 7
01

Terminal

Commands that start with openspec.

02

Claude Code chat

Slash commands that start with /opsx:

Two places to type

Docs: the most common early stumble.

Mixing them up.

# terminal
openspec init
# chat
/opsx:propose

Illustration

### Slide 8
02

Installing
OpenSpec

Install, init, config.

### Slide 9
get    npm install -g
       @fission-ai/openspec@latest
init   openspec init --tools claude
later  openspec update
stats  OPENSPEC_TELEMETRY=0

Illustration

>_

Install
and init

Node 20.19 or higher.

Typed commands only, no output. Homebrew also works.

Illustration

### Slide 10
What init

creates

All inside a new openspec folder.

01

specs

How it behaves now

04

config

config.yaml

02

changes

One folder each

03

archive

Finished changes

### Slide 11
# .claude/
skills/
  openspec-*
commands/opsx/

Core profile
six skills
six commands

drawn, not output

Claude Code

What init adds to .claude.

Type

/opsx:

Skills, like the ones we built. OpenSpec ships its own.

Illustration

### Slide 12
The core commands

explore

propose

apply

sync

archive

Plus /opsx:update for the plan

### Slide 13
rules
proposal: out of scope
specs: a scenario each
specs: edge cases
tasks: run npm test

Context
goes into
every artifact
 
Rules,
just one

context
Node.js cart project
src/discounts.js
npm test
No new dependencies

config
for the cart

openspec/config.yaml
Written for the course. Schema: spec-driven.

Illustration

### Slide 14
03

The change
workflow

Artifacts and commands.

### Slide 15
Four

artifacts

/opsx:propose writes them into one change folder.

01

proposal

Why and what

04

tasks

A checklist

02

specs

Requirements

03

design

How, if needed

### Slide 16
Delta specs

Docs: the key concept. A change says only what’s different.

A

ADDED

Appended on archive.

M

MODIFIED

Replaces the old one.

REMOVED

deleted on archive

Main spec

stays the record

# delta spec
## ADDED
## MODIFIED
## REMOVED
merged on archive

Illustration

### Slide 17
01

Requirement

Behavior, stated with SHALL or MUST.

02

Scenario

WHEN this happens, THEN that happens.

Spec format

Our first cart spec, written for the course.

It passes strict validation.

# specs/discounts
SAVE10: SHALL ...
WHEN total is 50.00
THEN it is 45.00

Illustration

### Slide 18
list   openspec list
show   openspec show discounts
check  openspec validate --strict
view   openspec view
chat   /opsx:archive

Illustration

>_

Check from
the terminal

Any time, any change.

Typed commands only, no output.

Illustration

### Slide 19
Tasks
warns if unfinished
Specs
offers to sync
Folder
moved, dated

Archive
closes the loop

The change becomes history.

Then

clear context

README tip: clear your context before implementing.

### Slide 20
“

“Agree on what to build before any code is written.”

The OpenSpec README.

### Slide 21
Episode 23

Recap

Requirements in files, not chat history.

01

Plans
that stay

From Ep 7 and Ep 16

02

Install
and init

Set up for Claude Code

03

Four
artifacts

Propose, apply, archive

### Slide 22
Building a New
Feature from a Spec

Next in the playlist

Episode 24 puts OpenSpec to work.

EPISODE 24

Subscribe and turn on notifications for the playlist.

