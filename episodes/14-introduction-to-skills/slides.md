# Episode 14: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Introduction
to Skills

Agentic Engineering · Episode 14

A free course on building software with AI agents

### Slide 2
Four

parts

What a skill is, where it lives, how it compares, and its format. Week 3 starts here.

01

What it is

A folder, loaded in layers

04

Format and fit

SKILL.md, and when to use one

02

Where it lives

Personal, project, plugins

03

How it compares

CLAUDE.md, commands, subagents

### Slide 3
01

What is a
skill

A folder with a SKILL.md.

### Slide 4
One
folder per skill
SKILL.md
the instructions
Extras
refs and scripts

A folder with
a SKILL.md

Claude uses it when relevant, or you type /skill-name.

Only

SKILL.md is required

Running skills properly is the next episode.

### Slide 5
Loads in layers

Listing

Match

SKILL.md

Ref file

Script

More loads only when needed

### Slide 6
Name and description

Always in context

The full SKILL.md

Loads when invoked

Supporting files

Read only when needed

Three layers

Listing

Body

Files

### Slide 7
dir  .claude/skills/
       add-discount/
main   SKILL.md
ref    reference.md
run    scripts/list-codes.sh

Illustration

>_

A skill
folder

Example: add-discount.

Written for this course. SKILL.md stays short and points to the rest.

Illustration

### Slide 8
02

Where it
fits

Where skills live, and how they compare.

### Slide 9
Personal or
project

Personal

~/.claude/skills/
All your projects
On this machine

Either way: <skill-name>/SKILL.md inside the folder.

Project

.claude/skills/
This repository
Shared via git

add-discount:
project scope

Commit
it
Project skills in git reach the whole team.

### Slide 10
More places

You will meet these later. Same folder shape everywhere.

P

Plugins

Invoked as /plugin:skill.

N

Nested

Load when Claude works there.

Enterprise

Via managed settings

--add-dir

Skills from that folder

# paths
~/.claude/skills/
.claude/skills/
<plugin>/skills/
apps/web/.claude/skills/
  <skill-name>/SKILL.md

Illustration

### Slide 11
Skills vs the

others

A CLAUDE.md section that grew into a procedure? Make it a skill.

01

CLAUDE.md

Facts, loaded every session

04

Subagent

Own context, returns a summary

02

Skill

Procedures, loaded when used

03

Command

Now merged into skills

### Slide 12
# same command
commands/deploy.md
skills/deploy/SKILL.md

/deploy
either file
works the same

old and new format

Commands
became skills

Same /name, more features.

Still

old files work

Skills add a folder, invocation control, and auto-loading.

Illustration

### Slide 13
Illustration · forked skill
context: fork
agent: Explore
# runs in a subagent
# no chat history

Skill
how to do it.
 
Subagent
who does it,
and where.

Subagent
A worker with its own context
Sends back only a summary
Good for noisy research
Can preload skills

Skill or
subagent?

Skill
Instructions. Runs inline, with your conversation.

Illustration

### Slide 14
03

The SKILL.md
format

Frontmatter, fields, and fit.

### Slide 15
01

Frontmatter

YAML between --- lines: when to use the skill.

02

Then the body

Markdown steps Claude follows when it runs.

Frontmatter + body

The opening --- must be the very first line.

add-discount: an example written for this course.

name: add-discount
description: Adds or changes a
  discount code. Use when...
1. Edit the codes table

Illustration

### Slide 16
Fields worth

knowing

All optional; description is recommended. Unknown names are ignored.

01

name

Defaults to the folder

04

allowed-tools

Pre-approve tools

02

description

When to use it, key use first

03

Manual only

disable-model-invocation

### Slide 17
01

Under 500 lines

Move detailed reference into separate files.

02

Link the extras

Say what each file holds, so Claude knows when to open it.

Keep it lean

Once loaded, the body stays in context. Every line costs.

State what to do, not a long why.

## Additional resources
- Codes format: reference.md
- List codes: scripts/list-codes.sh

Illustration

### Slide 18
Repeated
instructions
Procedure
in CLAUDE.md
Long
reference

When a skill
is right

You keep pasting the same checklist into chat.

Always?

use a hook

Facts every session: CLAUDE.md. Noisy jobs: a subagent.

### Slide 19
“

“CLAUDE.md is what Claude always knows. A skill is what it knows how to do.”

Loaded only when it is needed.

### Slide 20
Episode 14

Recap

A folder, loaded in layers, with a sharp description.

01

What it
is

SKILL.md, loads in layers

02

Where it
lives

.claude/skills/, plugins

03

How it
compares

Facts, procedures, workers

### Slide 21
Running
a Skill

Next in the playlist

Putting add-discount to work, both ways.

EPISODE 15

Subscribe and turn on notifications for the playlist.

