# Episode 3: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Claude Code
Controls

Agentic Engineering · Episode 3

A free course on building software with AI agents

### Slide 2
Four

controls

What Claude Code may do on its own, how you command it, which model thinks, and the keys that keep you fast.

01

Permission modes

Manual, Accept edits, Plan, Auto

04

Shortcuts

Keys that keep you in charge

02

Slash commands

The ones worth learning first

03

Models and effort

/model, /effort, ultrathink

### Slide 3
01

Permission
modes

What it may do without asking you first.

### Slide 4
Shift+Tab cycles modes

Shift
+ Tab

Manual

Accept
edits

Plan

Auto

Press again: around the cycle

### Slide 5
Illustration · status bar
1  manual mode on
2  accept edits on
3  plan mode on
4  auto mode on
   Shift+Tab to cycle

Bypass
Isolated containers and VMs only.

Not default
Not in the default cycle.

Runs without asking
Manual: reads only
Accept edits: + file edits, file commands
Plan: reads and plans, no source edits
Auto: a classifier reviews each action

Mode by
mode

Read the status bar
It always shows which mode is active.

### Slide 6
Plan mode

It researches and writes a plan. No source edits until you approve.

/

/plan your task

Or press Shift+Tab until it says plan mode.

G

Ctrl+G

Opens the plan in your text editor.

Or start in it

Use the --permission-mode flag

Plan first

For big or unfamiliar changes

# illustration
Plan: 4 steps, 3 files
Ready to code?
> Yes, and use auto mode
  Yes, manually approve edits
  No, keep planning

### Slide 7
Which mode,
when?

My rule of thumb

Big or unfamiliar: Plan
Sensitive work: Manual
Iterating, diff later: Accept edits

Switch at any moment. It is not a big commitment.

Auto mode

Long, trusted tasks
Risky actions blocked
Not a safety guarantee

Start in a mode:
--permission-mode

One key
to switch
Shift+Tab moves to the next mode. The status bar confirms it.

### Slide 8
02

Slash
commands

Control Claude Code itself.

### Slide 9
// type / to open
/init
/plan
/model
/effort
/clear

/compact
/context
/config

Illustration: typing /co

Type a
slash

Every command, one menu.

1 key

opens the menu

Keep typing to filter. Commands work at the start of a message.

### Slide 10
Slash commands

By stage

The ones I would learn first, grouped by when you use them in a session. Type /help any time for the full list.

01

At the
start

/init  starter CLAUDE.md · /permissions  allow, ask, deny

02

During
a task

/plan · /model · /effort · /context

03

After a
change

/diff  what changed · /rewind · /resume

### Slide 11
01

See it

/context shows what's filling the context window.

02

Free it

/compact summarizes. /clear starts fresh.

Keep context lean

Three commands keep a long session on track.

Switched tasks? /clear. The old one stays in /resume.

/context   what's using the space
/compact   focus on the API changes
/clear     new task, empty context

### Slide 12
03

Models
and effort

Which model thinks, and how hard.

### Slide 13
Daily coding

/model sonnet

Complex reasoning

/model opus

Fast, simple tasks

/model haiku

Pick a model by alias

Sonnet

Opus

Haiku

### Slide 14
> /model
  Default
  Sonnet
> Opus
  Haiku
  <- -> effort  Enter: save  s: session

Illustration

>_

Switching
models

Type /model for the picker.

Enter saves it as your default; s is this session only. opusplan: Opus plans, Sonnet builds.

### Slide 15
low
medium
high
xhigh
max

Effort
levels

How far the model may go when it decides whether, and how much, to think.

Default

Suits most coding tasks

Lower is faster and cheaper. Higher reasons deeper. Levels depend on the model.

### Slide 16
01

Go lower

Quick exchanges you review: renames, sketches.

02

Go higher

Bugs and edge cases where verification matters.

Turn it up

max can overthink and lasts only this session. Test it first.

One hard prompt? Add the word ultrathink.

/effort         open the slider
/effort high    set a level
ultrathink      deeper, this turn only

### Slide 17
Four keys

first

If you learn nothing else, learn these. Part four of today.

01

Shift+Tab

Cycle permission modes

04

Ctrl+O

Transcript viewer

02

Esc

Stop and redirect; on a prompt, no

03

Esc Esc

Empty prompt: rewind menu

### Slide 18
Input · Illustration
!  npm test   shell mode
@  src/cart.js   mention a file
\  then Enter   new line
Up previous prompts
?  on an empty prompt: help

Forgot?
Type ? on an empty prompt.

It varies
By platform and terminal.

Control
Shift+Tab  cycle modes
Esc  stop · Esc Esc  rewind
Ctrl+O  transcript viewer
Ctrl+G  prompt in your editor
Ctrl+R  search your history

The cheat
sheet

Exit
Ctrl+C interrupts or clears input. Ctrl+D twice exits.

### Slide 19
“

“The mode decides what it may do. Model and effort decide how hard it thinks. You decide both.”

The mental model for Claude Code controls

### Slide 20
Episode 3

Recap

Controls decide what Claude Code may do, which model thinks and how hard, and how fast you steer.

01

Modes,
Shift+Tab

Manual, Accept edits, Plan, Auto

02

Commands
and models

/context, /compact, /model, /effort

03

Keys that
steer

Shift+Tab, Esc, Esc Esc, Ctrl+O

### Slide 21
A Real Claude Code Session

Next in the playlist

Everything together, from first prompt to reviewed change.

EPISODE 4

Subscribe and turn on notifications for the playlist.

