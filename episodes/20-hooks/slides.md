# Episode 20: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Hooks

Agentic Engineering · Episode 20

A free course on building software with AI agents

### Slide 2
Three

parts

Make a rule hold every time, without relying on the model.

01

What hooks
are

Events, exit codes, JSON

02

Worth
shipping

Four hooks

03

Setting
up

Steps, testing, security

### Slide 3
01

What hooks
are

Deterministic control.

### Slide 4
Skill or
hook

Skill

Instructions Claude reads
Followed with judgment
Can be skipped

Hooks guide: deterministic control.

Hook

Code Claude Code runs
Every time it fires
Claude doesn’t decide

Teach, or
enforce

Skills
teach
Hooks enforce what must hold.

### Slide 5
Events worth

knowing

Plus Notification, when Claude needs you.

01

SessionStart

Begins or resumes

04

Stop

Claude finishes

02

PreToolUse

Before a call. Can block

03

PostToolUse

After success. No undo

### Slide 6
event  PreToolUse
match  "Edit|Write"
type   "command"
run    protect-files.sh
      

Illustration

>_

Anatomy of
a hook

Event, matcher, hooks.

In a settings file, under "hooks". Matchers are case sensitive.

Illustration

### Slide 7
01

Standard input

Event data arrives as JSON.

02

Tool input

The arguments Claude passed, like file_path.

Input and output

Every event includes session_id and cwd.

The answer: exit code, or JSON.

"hook_event_name":
  "PreToolUse",
"tool_name": "Edit",
"tool_input": { ... }

Illustration

### Slide 8
No objection

Permissions still apply

Block

Reason on stderr

Structured control

Deny, with a reason

Three ways to answer

exit 0

exit 2

JSON

### Slide 9
02

Hooks worth
shipping

Four, written for the course.

### Slide 10
protect-files.sh
FILE_PATH=$(jq ...)
path has .. : deny
protected: deny
exit 0

Deny
with a reason
Claude reads
 
JSON,
not exit 2.

Protected
.env
.git/
composer.lock
package-lock.json

Protect
files

PreToolUse
Edit|Write, before every file edit.

Illustration

### Slide 11
Format after edits

PostToolUse. Runs after each file edit.

P

Pint

PHP files.

J

Prettier

JS and TS files.

Silent

stdout to debug log

Limit

Bash edits not seen

# format.sh
case "$FILE_PATH" in
  *.php) pint
  *.tsx) prettier
exit 0

Illustration

### Slide 12
01

Tests fail?

Block, with a reason. Claude keeps working.

02

Already continuing?

stop_hook_active is true: let it stop.

Tests before stopping

One more pass, then back to you.

Stop fires after every response.

# stop-tests.sh
active? exit 0
php artisan test
fail: decision block

Illustration

### Slide 13
# ~/.claude/
"Notification"
permission_prompt
notify-send ...

Notify me
approval needed
desktop alert

personal settings

Notify me

Personal settings, not the project.

Mac?

osascript

Linux uses notify-send. The hooks guide shows both.

Illustration

### Slide 14
03

Setting up
hooks

Steps, testing, security.

### Slide 15
Five setup steps

Write

chmod +x

Register

/hooks

Test

Same for every command hook

### Slide 16
pipe   echo '{"tool_input":
        {"file_path":".env"}}'
       | protect-files.sh
code   echo $?
ask    add a comment to .env

Illustration

>_

Test it
by hand

Pipe sample JSON in.

Then ask for a real .env edit. Commands only, no output.

Illustration

### Slide 17
Deny
wins in every mode
Allow
can’t loosen rules
Off switch
disableAllHooks

Hooks can’t be
talked around

They fire before permission-mode checks.

Tighten,

never loosen

A deny holds even in bypassPermissions.

### Slide 18
Where hooks

live

Notify me is personal. The other three go in the project.

01

User

All your projects

04

Skill

After it is invoked

02

Project

Committed, shared

03

Local

You, one project

### Slide 19
Full
user permissions
Trust
dialog first
-p runs
repo hooks

Security
cautions

Review and test every hook command.

Quote

every variable

Block .., use absolute paths, skip sensitive files.

### Slide 20
“

“Skills ask. Hooks insist.”

Deterministic, every time.

### Slide 21
Episode 20

Recap

Shell commands at lifecycle events, run every time.

01

Events and
matchers

JSON in, exit code out

02

Four worth
shipping

Protect, format, test, notify

03

Set up
safely

Five steps, review all

### Slide 22
MCP Explained,
Choosing Servers

Next in the playlist

Episode 21 continues Week 3 with MCP.

EPISODE 21

Subscribe and turn on notifications for the playlist.

