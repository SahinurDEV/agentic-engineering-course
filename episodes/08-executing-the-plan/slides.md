# Episode 8: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Executing
the Plan

Agentic Engineering · Episode 8

A free course on building software with AI agents

### Slide 2
Four

parts

Run the PLAN.md from Episode 7, one step at a time, without drift.

01

Start fresh

Clear, then point at the plan

04

Long runs

Re-plan, lean context

02

Run the steps

Mode, loop, review, commit

03

Stay on plan

Esc, surprises, rewind

### Slide 3
01

Start
fresh

Clear, then point at the plan.

### Slide 4
01

Clear first

Planning chatter goes. The decisions live in PLAN.md.

02

Point at the plan

Step one only, with a clear finish line.

Start from the file

Read the plan once more before the first prompt.

"Stop when it passes" keeps Claude out of step two.

# illustration
/clear
> read @PLAN.md, do step 1 only.
> run npm test. stop when it passes.

### Slide 5
Permission mode

Shift+Tab cycles the modes. The status bar shows which one is on.

M

Manual

Asks before edits and most commands.

A

Accept edits

Edits without asking. My usual pick.

Auto

A classifier checks actions

Bypass

Isolated containers and VMs only

# illustration: status bar
manual mode on
accept edits on
plan mode on
auto mode on
shift+tab to cycle

### Slide 6
One step per loop

Read step

Implement

Test

Review

Commit

Next step? Back to the start

### Slide 7
02

Stay on
the plan

Steer early. Write changes down.

### Slide 8
Illustration
> stop. step 2 only. cart.js is
  out of scope in @PLAN.md.
  keep the change inside
  src/discounts.js.
  # sent after pressing Esc

Wrong way?
Esc, then redirect.

Right way?
Queue a nudge.

A clear redirect
Names the step
Names the boundary
Points back at the plan
Nudge? Type it, press Enter

Steer
early

Esc
Stops Claude mid-action. Context is kept, so you can redirect.

### Slide 9
Found
a surprise
Update
PLAN.md
Then
continue

Surprise?
Update the plan

Fixing it without writing it down is drift.

Say:

checkout re-checks codes

Add the file, add a step, or mark it out of scope.

### Slide 10
> Restore code and conversation
  Restore conversation
  Restore code
  Summarize from here
  Summarize up to here
  Never mind

Illustration

>_

Checkpoints
and rewind

Esc Esc or /rewind.

A checkpoint before each prompt. Bash file changes aren't tracked, and it's not a replacement for git.

### Slide 11
One step per commit

Easy to read and undo

Tests pass first

No broken save points

Message names the step

e.g. add optional expiry

Commit as you go

Small

Green

Named

### Slide 12
03

Long
runs

Know when to stop and re-plan.

### Slide 13
Keep going,
or re-plan?

Keep going

The step is working
Fixes are small
The plan is still true

Push on, one step at a time.

Re-plan

Assumptions were wrong
Scope keeps growing
Same correction again

Back to plan mode,
update PLAN.md

Twice?
Clear it
Corrected more than twice? /clear and restart with a better prompt.

### Slide 14
Keep context

lean

Long sessions with irrelevant history can reduce performance. /context shows what uses space.

01

/clear

Between committed steps

04

/btw

Side questions, kept out of history

02

/compact

With a focus, to stay in session

03

Subagents

Research in their own context

### Slide 15
01

Tick it off

When a step is committed, mark it done in PLAN.md.

02

Same prompt, every session

Read the plan, do the next unchecked step, stop.

Track progress

The next fresh session knows exactly where things stand.

Ticking steps off is a habit, not a built-in feature.

# illustration
- [x] 1 optional expiry date
- [x] 2 reject expired codes
> do the next unchecked step only

### Slide 16
“

“Drift is just a plan change nobody wrote down.”

Change the plan, then the code

### Slide 17
Episode 8

Recap

Run the plan one small step at a time, and write every change down.

01

Start
fresh

Clear, @PLAN.md, pick a mode

02

One step
per loop

Implement, test, review, commit

03

Stay on
plan

Esc, update, rewind, re-plan

### Slide 18
Verifying the Work

Next in the playlist

Green tests are a start. Next, we prove it works.

EPISODE 9

Subscribe and turn on notifications for the playlist.

