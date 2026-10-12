# Episode 17: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
A React Best
Practices Skill

Agentic Engineering · Episode 17

A free course on building software with AI agents

### Slide 2
Three

parts

A skill that brings your React rules to every React task.

01

Reference
skills

Task or reference, why React

02

Write
it

Frontmatter, paths, rules

03

Use and
test it

Review, baseline, limits

### Slide 3
01

A different
kind of skill

Reference, not task.

### Slide 4
Task or
reference

Task content

Step-by-step action
add-discount, grill-me
Has an end

Both types come from the skills docs.

Reference content

Conventions, patterns
Runs inline
Shapes every job

React rules:
reference

Not
a job
It changes how Claude does the work.

### Slide 5
Repeated
in every review
Forgotten
mid-task
Documented
on react.dev

Why
React

Established rules. Nothing to invent.

Skill

not CLAUDE.md

CLAUDE.md loads every session. A skill loads when needed.

### Slide 6
Four rule

groups

The uncontroversial basics, all from react.dev.

01

Purity, Hooks

Pure; rules of Hooks

04

Lists

Stable keys

02

State

Minimal, never mutated

03

Effects

Only for outside systems

### Slide 7
02

Writing
the skill

Frontmatter, paths, four rule groups.

### Slide 8
dir  .claude/skills/
       react-best-practices/
main   SKILL.md
ex     examples.md
      

Illustration

>_

A project
skill

Committed for the team.

Written for this course. Rules from react.dev, examples in a second file.

Illustration

### Slide 9
01

description

What it is and when to use it. Main use first.

02

when_to_use

Extra triggers. Shares the 1,536-character cap.

The frontmatter

No disable-model-invocation: Claude should pick it up.

Full file in the description.

name: react-best-practices
when_to_use: Creating a ...
paths:
  - "src/**/*.jsx"

Illustration

### Slide 10
What and when

Read by Claude

Trigger phrases

Appended to it

*.jsx, *.tsx under src

Auto-load only there

Three ways it’s matched

description

when_to_use

paths

### Slide 11
SKILL.md · react-best-practices
## Purity and Hooks
- Keep components pure
- Hooks at the top level
- No nested components

Side
effects go in
handlers
 
or
Effects.

Rules of Hooks
Top level only
Not in loops or conditions
Not in nested functions
Before any early return

Purity and
Hooks

Pure
Same inputs, same result. No side effects in render.

Illustration

### Slide 12
State and Effects

Calculate during render. Effects only for outside systems.

S

Minimal state

No redundant or copied props.

E

Events

Handle them in handlers.

Read-only

Replace, don’t mutate

Escape hatch

Effects sync outside

# SKILL.md · State
- Calculate, do not store
- Do not copy props
# SKILL.md · Effects
- Only for external systems

Illustration

### Slide 13
01

Stable keys

Unique among siblings, never changing. An id from the data.

02

Lint and tests

After every change. The Hooks lint plugin backs it up.

Lists and checks

Index keys break when items move.

Never generate keys during render.

## Lists
- A stable key, such as an id
## Checks
- Run lint and tests

Illustration

### Slide 14
# examples.md
## Stable keys
Avoid: key={index}
Prefer: key={item.id}

examples.md
avoid, prefer
read when needed

supporting file

examples.md

Avoid and prefer, per rule.

No

angle brackets

Plain text, no JSX tags: pastes cleanly into a YouTube description.

Illustration

### Slide 15
03

Using and
testing it

Automatic, by name, then a baseline.

### Slide 16
How it gets used

React task

paths

SKILL.md

Rules

Checks

Nothing special to type

### Slide 17
ask    add a remove button
       to the cart list
       # paths match: loads
type   /react-best-practices
         src/CartList.jsx

Illustration

>_

Or ask for
a review

User-invocable by default.

No placeholder: the path is appended as ARGUMENTS. Prompts only, no output.

Illustration

### Slide 18
Test it

twice

Then check the trigger: a non-React prompt should not load it.

01

Prompts

Ones that tempt bad patterns

04

Compare

Effects? Keys?

02

Skill on

Fresh session

03

Skill off

skillOverrides: "off"

### Slide 19
Skill
teaches
Lint
catches
Hook
enforces

Guidance, not
a guarantee

Claude follows a skill. It is not enforced.

Must hold?

use a hook

Hooks are later in Week 3.

### Slide 20
“

“A task skill does a job. A reference skill changes how every job gets done.”

Rules from react.dev.

### Slide 21
Episode 17

Recap

Reference content, loaded for React files, rules from react.dev.

01

Reference
skill

Inline, project, shared

02

Matched
by paths

*.jsx and *.tsx only

03

Tested and
backed

Baseline, lint, hooks

### Slide 22
A Laravel
Security Skill

Next in the playlist

Episode 18 continues Week 3 with skills.

EPISODE 18

Subscribe and turn on notifications for the playlist.

