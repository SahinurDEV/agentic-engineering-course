# Episode 22: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Playwright MCP

Agentic Engineering · Episode 22

Give Claude a browser, then check the cart

### Slide 2
Three

parts

Set up a browser Claude can drive, and use it well.

01

Install
the server

Add, check, share

02

Configure
it

Modes, profiles, snapshots

03

Verify
the cart

One change, checked

### Slide 3
01

Install
the server

Add, check, use.

### Slide 4
Before and
after

Without

Claude edits the UI
But can’t see it
You look and describe

Docs: a browser to navigate, click, and read.

With Playwright

Claude opens the page
Reads and clicks
Checks the result

You look, or
it looks

Needs
Node 18+
No account needed.

### Slide 5
claude mcp add

playwright -- npx ...

claude mcp list

Retry while npx loads

Ask a browser task

Name the server

Add, check, use

Add

Check

Use

### Slide 6
CLI
more token efficient
MCP
persistent browser
Both
from Playwright

MCP or
CLI?

A note from the Playwright MCP readme.

Ours

the MCP server

The CLI works through skills, with smaller context.

### Slide 7
01

Local scope

The command adds it just for you.

02

.mcp.json

Project scope: shared, approved on first use.

Share it with the team

The docs show this .mcp.json entry.

Local servers use stdio.

# .mcp.json entry
"type": "stdio",
"command": "npx",
"args": ["-y", ...]

Illustration

### Slide 8
02

Configure
it

Modes, profiles, tools.

### Slide 9
mode   --headless
which  --browser firefox
size   --viewport-size 1280x720
phone  --device "iPhone 15"
clean  --isolated

Illustration

>_

Options go
in args

From the readme.

Option names only, no output. --config takes a JSON file.

Illustration

### Slide 10
Headed or

headless

Headed by default: a window you can watch.

01

Headed

Default. Watch it

04

Docker

Headless chromium

02

Headless

No window needed

03

Idle

Headless: 1 hour

### Slide 11
# .mcp.json
"playwright"
--isolated
1280x720

Same layout
fresh profile
screenshots folder

written for the course

.mcp.json

Cart project, committed.

Headless?

local

Same name at local scope wins, for you only.

Illustration

### Slide 12
Core tools

Navigate

Snapshot

Click

Wait

Picture

Tool names start with browser_

### Slide 13
Screenshot
an image
can’t act on it
saved to a file
evidence for you

Act
on snapshots
no vision model
 
Keep
screenshots

Snapshot
Accessibility tree
Roles, names, text
A ref per element
“Better than screenshot”

Two views
of a page

Snapshot vs screenshot
One is for Claude. One is for you.

Illustration

### Slide 14
03

Verify
the cart

One change, checked.

### Slide 15
Four

steps

Docs: point it at your local dev server.

01

Run

Your dev server

04

Keep

Screenshot, tests

02

Ask

One specific check

03

Read

Snapshots, console

### Slide 16
The prompt

Written for the course. Typed in a session.

S

Steps

Add item, SAVE10.

E

Expected

Total drops 10%.

Read

with snapshots

Keep

save10-check.png

# prompt
use playwright
open localhost:3000
apply SAVE10
report console errors

Illustration

### Slide 17
01

The total

Read from a snapshot, as text.

02

The console

A page can look right and still log errors.

Read the page

Tool names only, no output.

Browser checks add to tests.

# tool names
browser_navigate
browser_snapshot
browser_console_messages

Illustration

### Slide 18
file   .claude/settings.json
rule   deny
tool   mcp__playwright__
       browser_run_code_unsafe
why    runs arbitrary JS

Illustration

>_

Deny the
unsafe tool

RCE-equivalent.

Project settings.json, written for the course.

Illustration

### Slide 19
Origins
not a boundary
Profile
isolated for tests
Pages
external content

Not a security
boundary

The readme says it plainly.

Use it on

your dev server

Web pages can carry prompt injection.

### Slide 20
“

“Act on snapshots. Keep screenshots as proof.”

Claude reads structure. You keep evidence.

### Slide 21
Episode 22

Recap

Give Claude a browser, then check one change.

01

Add and
share

mcp add, .mcp.json

02

Headed by
default

Headless, isolated

03

Snapshots
to act

Verify, deny unsafe

### Slide 22
Spec-Driven Development
and OpenSpec

Next in the playlist

Episode 23 begins Module 10.

EPISODE 23

Subscribe and turn on notifications for the playlist.

