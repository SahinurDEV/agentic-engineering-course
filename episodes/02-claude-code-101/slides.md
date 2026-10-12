# Episode 2: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Claude Code
101

Agentic Engineering · Episode 2

A free course on building software with AI agents

### Slide 2
On the agenda

Today

Three parts: what Claude Code is and how to start it, how it works under the hood, and what actually happens in a session, step by step.

01

What Claude
Code is

Anthropic's terminal agent, install, first run

02

How it
works

Gather, act, verify. Tools and permissions.

03

Anatomy of
a session

From typing claude to reviewing the diff

### Slide 3
Your codebase

Searches and opens files itself

Files across the project

Changes code, creates files

Commands, tests, git

Right in your terminal

What is Claude Code?

Reads

Edits

Runs

### Slide 4
$ curl -fsSL https://claude.ai/install.sh
    | bash
$ claude --version
$ cd your-project
$ claude
  session starts in this folder

macOS · Linux · WSL

>_

Install it,
then start it

One command, then claude.

Install with the command from Anthropic's docs, check the version, then run claude inside a project folder. The first run asks you to log in.

### Slide 5
// ep01-cart/
src/ cart.js
src/ discounts.js
test/ cart.test.js
test/ discounts.test.js
package.json

Search  src/
Read  2 files
Run  git status

Claude Code gathers it

Whole project,
not one file

It goes and gets the context.

1 folder

and below it

Files, your terminal, and your git state: branch and uncommitted changes.

### Slide 6
02

How it
works

The loop, the tools, and the permissions.

### Slide 7
The agent loop

Your task

Gather
context

Take
action

Verify

Done

Not done yet? Loop back

### Slide 8
The model
reasons
The tools
act

Models reason,
tools act

Claude Code is the layer around the model: it provides the tools and manages what the model sees.

Harness

Claude Code, around the model

Without tools, a model can only answer in text. With tools, it can do the work.

### Slide 9
The core

tools

Every tool call returns a result, and that result feeds the next decision. It can also search the web and fetch docs.

01

Read files

Code, configs, output

04

Run commands

Tests, builds, git

02

Search

Find files, grep contents

03

Edit

Change and create files

### Slide 10
Permissions

Depending on the permission mode, it asks before it edits a file or runs a command.

?

It asks first

You see the exact edit or command, then say yes or no.

<-

Rewind if needed

It snapshots files before editing. Esc twice rewinds.

Allow

Trusted commands, like npm test

Modes

Shift+Tab cycles them. More in Ep 3

# illustration
Edit  test/discounts.test.js
+ test: total never below 0
Allow this edit?
> Yes
  No, cancel

### Slide 11
03

The
session

Anatomy of a session, from claude to the diff.

### Slide 12
Illustration
Read  src/discounts.js
Read  test/discounts.test.js
Edit  test/discounts.test.js  (approved)
Run   npm test  (approved)
Done  tests pass, summary of changes

It proposes
Shows the edit or command.

You approve
Then you read the diff.

The five steps
1  Start: claude in the project folder
2  Prompt: say what you want
3  Gather: it searches and reads files
4  Propose: you approve edits, commands
5  Verify: it runs tests and reports

A session,
step by step

The prompt
Add a test that a discount never pushes the total below 0, then run the tests.

### Slide 13
What the session
keeps in context

In the context window

Your conversation
Files it read, command output
CLAUDE.md, system instructions

Everything it reads takes up space.

Keep in mind

It fills up as you work
Then it auto-compacts
Early details can fade

See it: /context
Reset it: /clear

Starts
fresh
Each new session starts with a fresh context. Lasting rules go in CLAUDE.md.

### Slide 14
“

“It goes and gets the context. You decide what it’s allowed to do.”

The mental model for every session

### Slide 15
01

Stop and steer

Press Esc to stop it mid-step, then give it a new direction.

02

Come back later

claude --continue resumes your last conversation here.

First commands

A few commands to get you through your first session.

Type a slash to see every command available to you.

/help     show available commands
/context  see what's using space
/clear    fresh start  ·  /exit  quit

### Slide 16
Episode 2

Recap

Claude Code is Anthropic's agentic coding tool: it runs in your terminal and works across your whole project.

01

Terminal agent,
whole project

Reads, edits, runs commands

02

Gather, act,
verify

The loop, powered by tools

03

You approve,
context fills

Permissions and the session

### Slide 17
Claude Code Controls

Next episode

Edit modes, slash commands, models, and shortcuts.

EPISODE 3

Subscribe and turn on notifications for the playlist.

