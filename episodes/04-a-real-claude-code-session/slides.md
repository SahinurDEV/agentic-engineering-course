# Episode 4: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
A Real Claude
Code Session

Agentic Engineering · Episode 4

A free course on building software with AI agents

### Slide 2
One

session

One small feature, start to finish. An illustrated walkthrough of what a session like this looks like.

01

Start and plan

Clean tree, plan mode, tweak the plan

04

Try it yourself

Four tips for your own project

02

Edit and test

Prompts, tests, a failing test

03

Review and commit

/diff, commit, /clear or /compact

### Slide 3
The session map

Start

Plan

Edit

Test

Commit

Test fails? Fix and re-run

### Slide 4
01

Start
and plan

A clean tree, then a plan before any edit.

### Slide 5
$ cd ep01-cart
$ git status
  working tree clean
$ claude
  manual mode on
  plan mode on

Illustration

>_

Start
clean

Clean tree, then claude.

Check git status first, so every change in the diff is from this session. Then Shift+Tab to plan.

### Slide 6
Plan with a spec

Claude reads the project and writes a plan. No edits yet.

1

Write a spec

The pattern, the limits, and the check to run.

2

Choose how to go on

Here: approve edits manually.

Not a wish

"Add a discount" is too vague

The check

Add tests, run npm test

# illustration
> Add SAVE10: 10% off.
  Never below 0. Add tests.
Plan ready. Proceed?
  Yes, and use auto mode
> Yes, manually approve edits

### Slide 7
Ctrl+G · Illustration
open  plan in your text editor
+     Round to whole cents
+     Test an odd total
save  back to Claude
then  approve the plan

Tweak
before you approve.

Decide now
not later.

Plan · illustration
1  Add SAVE10 to the discounts map
2  Apply 10%, never below 0
3  Add tests next to the existing ones
4  Run npm test

Tweak the
plan

Read it like a PR
Totals are in cents. How does 10% get rounded?

### Slide 8
02

Edit
and test

Prompts where you want them.

### Slide 9
// src/discounts.js
  FLAT500: ...
+ SAVE10: ...

Yes
Don't ask again
No (Esc)

Illustration: edit prompt

Approve
each edit

You see the exact change first.

1 edit

one prompt

"Don't ask again" for edits lasts until the session ends. Esc says no.

### Slide 10
01

Yes

Runs it once. It asks again next time.

02

Don't ask again

Saves a rule for npm test in this repo.

Running the tests

Running a command is its own prompt.

Review or change saved rules any time with /permissions.

Bash command: npm test
saved: .claude/settings.local.json
/permissions   review your rules

### Slide 11
Fails
read
Fix
re-run
Pass

When a
test fails

That is the loop working: Claude reads the failure, fixes, and runs the tests again.

Esc

Stop it and redirect

Fix the code, not the test. Esc Esc opens the rewind menu.

### Slide 12
03

Review
and commit

Your turn: read it, then save it.

### Slide 13
Review
the diff

Look at it

/diff  changes in your working tree
!git diff  in shell mode
/code-review  a second opinion

It says it's done. Now it's my turn.

Check

Follows the pattern
Never below 0
Tests test the right thing

Including the
rounding case

Not
git
Checkpoints undo things in a session. The commit is the real save point.

### Slide 14
01

Ask

Commit this with a descriptive message.

02

Approve

git commit is a shell command, so it asks.

Commit it

Read the message before you approve.

Checkpoints are not git. The commit is the real save point.

> commit this with a descriptive message
Bash command: git commit ...
working tree clean

### Slide 15
New, unrelated task

/clear  (old one: /resume)

Same task, long session

/compact with a focus

Pick up later

claude --continue

Between tasks

Clear

Compact

Continue

### Slide 16
Try it

yourself

Pick a small feature in a project that already has tests.

01

Clean tree

So the diff is all Claude's work

04

Read the diff

Before every commit

02

Plan with a spec

Limits and the check to run

03

Give it a check

Without tests, you are the test suite

### Slide 17
“

“Claude does the typing and the test running. I do the specifying, reviewing, and verifying.”

The mental model for every session

### Slide 18
Episode 4

Recap

One session, start to commit: plan first, approve what matters, verify, then review and save.

01

Start
and plan

Clean tree, plan mode, Ctrl+G tweak

02

Edit
and test

Prompts, npm test, fix the code

03

Review
and commit

/diff, commit, /clear or /compact

### Slide 19
Context Management Basics

Next in the playlist

What fills the context window, and how to fill it well.

EPISODE 5

Subscribe and turn on notifications for the playlist.

