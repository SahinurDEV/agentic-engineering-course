# Episode 19: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Database Skills,
Writing Your Own

Agentic Engineering · Episode 19

A free course on building software with AI agents

### Slide 2
Three

parts

Two database skills, then a recipe for writing your own.

01

Reference
skill

Database conventions

02

Task
skill

/new-migration

03

Your
own

A six-step recipe

### Slide 3
01

A database
reference skill

Conventions for migrations and models.

### Slide 4
Shared
by every database
Hard to undo
data can be lost
Easy to forget
down, keys, indexes

Why the
database

A schema change runs everywhere.

Two

skills, one pair

One reference skill, one task skill.

### Slide 5
Four rule

groups

database-conventions, from the Laravel and PostgreSQL docs.

01

Schema

Migrations, reversible

04

Checks

Tests after changes

02

Queries

No N + 1, transactions

03

Safety

Ask before destroying

### Slide 6
dir  .claude/skills/
ref    database-conventions/
         SKILL.md
task   new-migration/
         SKILL.md

Illustration

>_

Two project
skills

Committed with the code.

database-conventions loads by paths: migrations and models.

Illustration

### Slide 7
SKILL.md · database-conventions
## Schema changes
- Migrations only
- down reverses up
- Add a new one instead

Never
change a
table by hand
 
Always
a migration.

Rules
make:migration only
A down for every up
Never edit one that ran
Foreign key constraints

Schema
changes

Migrations
Version control for your database.

Illustration

### Slide 8
Queries and safety

Fewer queries, safe writes, no surprises.

E

Eager load

Avoids N + 1 queries.

T

Transactions

All writes or none.

Indexes

Where queries need them

Ask first

fresh, refresh, wipe

# SKILL.md · Queries
- Eager load in loops
- DB::transaction
# SKILL.md · Safety
- Never --force, ask first

Illustration

### Slide 9
02

A migration
task skill

One you start yourself.

### Slide 10
01

Manual only

disable-model-invocation: true. You start it.

02

A narrow grant

Two commands, for one turn. Nothing else changes.

The frontmatter

$ARGUMENTS takes the change you type.

Full file in the description.

name: new-migration
disable-model-invocation:
  true
argument-hint: "[change]"

Illustration

### Slide 11
What /new-migration does

Read

Generate

up, down

--pretend

Stop

You run the migration

### Slide 12
type   /new-migration
         add a shipped_at
         timestamp to orders
      
       # prompt only

Illustration

>_

Starting
it

Type the change.

Manual only: its description is not in Claude’s context. Prompt only, no output.

Illustration

### Slide 13
Starts the job

/new-migration

Adds the rules

New file matches

Run the migration

After the SQL

Two skills, one change

Task

paths

You

### Slide 14
03

Writing
your own

A six-step recipe.

### Slide 15
Steps one
and two

1 · Signal

Pasting it again
CLAUDE.md grew a procedure
Same review comments

From the skills docs.

2 · Type

Reference: Claude loads it
Add paths for some files
Task: maybe manual only

Side effects?
You start it

Decide
first
Type shapes every field after it.

### Slide 16
Steps three

to six

Short body, standing instructions, under 500 lines.

01

Place

Personal or project

04

Test

Trigger, then baseline

02

Frontmatter

Main use first

03

Body

Rules, checks, files

### Slide 17
# skill-template.md
name: [skill-name]
description: [...]
## [Rule group]

skill-template.md
frontmatter
rules, checks

starter template

A starter template

The recipe, as a file you copy.

[ ]

for blanks

Square brackets, no angle brackets: pastes cleanly into a YouTube description.

Illustration

### Slide 18
01

Does it trigger?

Prompts that should load it, and some that should not.

02

Does it help?

Fresh session, skill on, then off. Compare.

Step six: test it

Measure the two separately.

Edits load without a restart.

# trigger check
What skills are available?
# baseline
skillOverrides: "off"

Illustration

### Slide 19
A fact
CLAUDE.md
Must hold
a hook
One-off
just ask

When it’s not
a skill

Not everything needs a file.

Unused?

/skill-doctor

Shows what each skill costs and how often it is used.

### Slide 20
“

“Reference skills shape the work. Task skills do the work. Decide which before you write a word.”

The recipe starts with the type.

### Slide 21
Episode 19

Recap

Two database skills as a pair, and a six-step recipe for your own.

01

database-
conventions

Reference, by paths

02

new-
migration

Task, stops at the SQL

03

Six-step
recipe

Signal to baseline

### Slide 22
Hooks

Next in the playlist

Episode 20: make a rule hold every time.

EPISODE 20

Subscribe and turn on notifications for the playlist.

