# Episode 16: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
The “Grill Me”
Skill

Agentic Engineering · Episode 16

A free course on building software with AI agents

### Slide 2
Four

parts

Why, write, run, tune. A skill that asks before it builds.

01

Why

Hidden decisions

04

Tune it

Baseline, one edit

02

Write it

Frontmatter and rules

03

Run it

On the cart, to a spec

### Slide 3
01

Why grill
me

Decisions before code.

### Slide 4
Open
decisions
Made
silently
Found
at review

Hidden
decisions

One line, many choices: format, expiry day, clock.

Ask

before the plan

A plan is Claude’s proposal. An interview comes first.

### Slide 5
01

Minimal prompt

Ask Claude to interview you with AskUserQuestion.

02

Hard parts

Skip the obvious. Keep going, then write SPEC.md.

The docs’ prompt

From the best practices guide.

Section: Let Claude interview you.

I want to build [brief
description]. Interview me in
detail using AskUserQuestion.
# ... then write SPEC.md

Illustration

### Slide 6
The interview loop

Short ask

Read

Ask

Answer

SPEC.md

Repeat until covered

### Slide 7
Same prompt every time

A reason to make a skill

Same areas, same spec

Via supporting files

/grill-me [feature]

Nothing else to type

Why make it a skill

Repeated

Consistent

One line

### Slide 8
02

Writing
grill-me

Folder, frontmatter, rules, files.

### Slide 9
dir  ~/.claude/skills/
       grill-me/
main   SKILL.md
ask    question-areas.md
spec   spec-template.md

Illustration

>_

The grill-me
folder

Personal: every project.

Written for this course. Personal wins over a project skill of the same name.

Illustration

### Slide 10
# grill-me/SKILL.md
name: grill-me
disable-model-
  invocation: true

/grill-me
[feature]
you start it

manual only

Frontmatter:
manual only

You decide when to be grilled.

Hint

"[feature]"

argument-hint is quoted, so YAML reads the brackets as text.

Illustration

### Slide 11
Frontmatter

choices

Each one deliberate. Full file in the description.

01

Manual only

disable-model-invocation

04

Inline

No context: fork

02

$ARGUMENTS

The feature you type

03

allowed-tools

Left out: keep the prompt

### Slide 12
Frontmatter · grill-me
name: grill-me
disable-model-invocation: true
# no context: fork line
# runs inline

Fork
work you
hand off.
 
Inline
work you join.

context: fork
No conversation history
Skill content is the prompt
Background by default
Result arrives at the end

Inline, not
forked

Inline
Every answer stays in your conversation.

Illustration

### Slide 13
01

One question at a time

With AskUserQuestion. Follow up on vague answers.

02

No code edits

Each rule covers the whole interview, not one step.

Standing rules

The file is not re-read on later turns.

Ends: confirm, write SPEC.md, stop.

Interview me about this
feature first: $ARGUMENTS
- Ask with AskUserQuestion
- Do not edit any code

Illustration

### Slide 14
Supporting files

Linked from SKILL.md, read only when Claude needs them.

Q

question-areas.md

What to ask about.

S

spec-template.md

The shape of SPEC.md.

Under 500

lines in SKILL.md

Cart extras

Cents and time zones

# SKILL.md (end)
## Additional resources
- Areas: question-areas.md
- Spec: spec-template.md
# written for this course

Illustration

### Slide 15
Answering
questions

Pick an option

Multiple choice
From AskUserQuestion
One click

Typed answers are relayed neutrally, as you wrote them.

Type your own

The Other row
Or the notes field
Followed as written

Stays open
by default

No
timeout
Leave askUserQuestionTimeout off.

### Slide 16
03

Run and
tune it

On the cart, to a spec, then better.

### Slide 17
type   /grill-me let a customer
       use two discount codes
       on one order
      
       # name first: runs directly

Illustration

>_

Grill me on
the cart

Two codes, one order.

Only the typed command is shown. Questions differ from run to run.

Illustration

### Slide 18
Decide
don’t defer
Name
the out of scope
Type
your own

Your side of
the interview

“Whatever you think” hands the decision back.

Answer

like the product owner

Percent or fixed first?
You choose.

### Slide 19
01

Decisions

Percent before fixed. No repeats. Never below zero.

02

Verification

A test per edge case, then the full suite.

The spec shape

Example written for this course.

Goal, out of scope, files, edge cases.

# SPEC: Two discount codes
## Goal: up to two codes
## Out of scope: checkout
## Decisions: percent first

Illustration

### Slide 20
The hand-off

SPEC.md

Fresh

Plan mode

Implement

Verify

Clean context for the build

### Slide 21
Tune it like

any skill

Manual skill: compare the bare prompt with /grill-me.

01

Baseline

Prompt vs /grill-me

04

One edit

Then run again

02

Fresh

No leftover context

03

Check

Hard parts? All sections?

### Slide 22
SKILL.md · grill-me
Rules for the whole
interview: ... (at the top)
# the start survives
# compaction

Rules
go at
the top.
 
Compacted?
Invoke again.

Too many questions?
Add a rule for when to stop
e.g. every section filled
Edits code anyway?
Must-hold rules go in a hook

When it
misbehaves

Too obvious?
Add hard, specific areas to the checklist.

Illustration

### Slide 23
“

“Every question before the code is a decision you make, not one you find in the diff.”

Get grilled early.

### Slide 24
Episode 16

Recap

An interview skill: manual, inline, ends in SPEC.md.

01

Write
it

Personal, manual only

02

Run
it

/grill-me [feature]

03

Tune
it

Baseline, one edit

### Slide 25
A React Best
Practices Skill

Next in the playlist

Episode 17 continues Week 3 with skills.

EPISODE 17

Subscribe and turn on notifications for the playlist.

