# Episode 27: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Parallel
Development

Agentic Engineering · Episode 27

Conductor, and git worktrees anywhere

### Slide 2
Three

parts

Several agents at once, without collisions.

01

Conductor

What it is, where it runs

02

Parallel
sessions

Two tasks, two workspaces

03

Plain
worktrees

Any OS, claude --worktree

### Slide 3
01

Conductor

What it is, and what’s under it.

### Slide 4
One folder,
or one each?

Shared folder

Same files on disk
Edits collide
One branch for all

Two sessions, one checkout: trouble.

Folder per task

Own files
Own branch
Own review

Conductor, or
plain git

One
task
One folder, one branch.

### Slide 5
Claude Code, Codex,

Cursor, OpenCode

One per task

Branch, files, terminal

Diff, PR, merge

Then archive

What Conductor is

Agents

Workspaces

Review

### Slide 6
macOS
available
Windows
not yet
Linux
not yet

Mac only,
for now

From Conductor’s install page.

Other OS?

see part three

Cloud workspaces are used from the Mac app.

### Slide 7
The

model

From Conductor’s docs.

01

Project

1 repository

04

Working tree

Files on disk

02

Workspace

1 branch

03

Branch

1 working tree

### Slide 8
Git worktrees

Many working trees, one repository.

1

Separate

Files, branch, processes.

2

Shared

History, refs, remotes.

Rule

1 branch, 1 worktree

Where

~/conductor

# one repository
main worktree
linked: task A
linked: task B
one .git, shared

Illustration

### Slide 9
Not isolated
your permissions
your whole Mac
shell commands
no sandboxing

Separate
folders
only
 
Extra safe?
use a VM

Isolated
Files on disk
The branch
Running processes
The review path

Not a
sandbox

Development isolation
not a security boundary.

Illustration

### Slide 10
02

Parallel
sessions

Two tasks at once.

### Slide 11
app    drag to Applications
gh     gh auth status
agent  claude /login
need   GitHub + 1 agent
os     macOS only

Illustration

>_

Before you
start

GitHub, plus one agent.

Typed commands only, no output.

Illustration

### Slide 12
Your first workspace

Add repo

Workspace

Setup

Chat

Review

Starts with tracked files only

### Slide 13
# settings.toml
setup: npm install
run: dev, test
run_mode: concurrent

Setup runs
after create
in each workspace

written for the course

The settings file

Commit it to share it.

1 + 2

setup + run scripts

Local-only values go in settings.local.toml.

Illustration

### Slide 14
01

Ports

10 per workspace, from CONDUCTOR_PORT.

02

Files

Ignored and matching: copied.

Ports and files

Two dev servers, no port fight.

Default pattern without a file: .env*

# .worktreeinclude
.env
.env.local
gitignored files only

Illustration

### Slide 15
One workspace
or many?

Many

Ship separately
One per issue
Experiments

Agents in one workspace share files.

One

Build + review
Fix the tests
Land together

Decide by
shipping

Ship
apart?
Then split it.

### Slide 16
README section

README.md only

Node 22 and 24

test.yml only

0 files

Merge in any order

Two tasks, two workspaces

Task A

Task B

Shared

### Slide 17
A      Shipping section,
       README.md only
B      matrix: Node 22, 24
       test.yml only
check  npm test

Illustration

>_

Two prompts

One per workspace.

Written for the course. Replies aren’t shown.

Illustration

### Slide 18
Review, one

at a time

Each workspace on its own.

01

Diff

Read every file

04

Merge

Approved, green

02

Review

An agent pass

03

Checks

Blockers first

### Slide 19
They don’t prove
the README is right
the merge works
so update branch B
and re-run checks

Clean
merge
only
 
Not
correct

They prove
npm test passes
on Node 22
and on Node 24
for that commit

What checks
prove

Two Node versions
So two test jobs per run.

Illustration

### Slide 20
Merge
approved, green
Archive
leaves the sidebar
Restore
from History

Merge, then
archive

Keep only live work in view.

Archive

script runs first

Discarding an experiment costs nothing.

### Slide 21
# one port? one DB?
run_mode =
  "nonconcurrent"
or Spotlight

Spotlight
tests from root
one at a time

from the official docs

Can’t run twice?

Two answers from the docs.

1

run script at a time

Our cart can run twice, so it stays concurrent.

Illustration

### Slide 22
03

Plain
worktrees

Mac, Windows, or Linux.

### Slide 23
Conductor or
worktrees?

Conductor

Mac app
Scripts, sidebar
Diff, checks, PR

Conductor builds on worktrees.

Plain worktrees

Any OS with git
Built into Claude
You set it up

Same idea
underneath

Same
idea
One task, one tree.

### Slide 24
trust  claude
tab 1  claude --worktree
         readme-shipping
tab 2  claude --worktree
         ci-node-matrix

Illustration

>_

The worktree
flag

Built into Claude Code.

Typed commands only, no output.

Illustration

### Slide 25
What it does

Defaults from Claude Code’s docs.

1

Folder

.claude/worktrees/

2

Branch

worktree-NAME

Base

default branch

Ignore

.claude/worktrees/

# fresh checkout
npm install there
.worktreeinclude
  copies .env
PR: --worktree "#N"

Illustration

### Slide 26
01

Four checks

Edits, cwd, git redirects, unclear git.

02

The limit

cp or a redirect isn’t tracked.

How it stays isolated

The main checkout is blocked.

Permissions still matter.

# blocked in a worktree
edit main checkout
run in main checkout
git -C main checkout

Illustration

### Slide 27
# by hand, with git
git worktree add
git worktree list
git worktree remove

After 2 adds
list: 3 entries
main first

written for the course

By hand, with git

Any branch, any folder.

1

branch per worktree

Git refuses a branch already checked out.

Illustration

### Slide 28
Cleaning up

Exit

Check

Clean

Has work

Keep

Remove deletes the work: push first

### Slide 29
One finishable task

Name the check command

Different files

Avoid shared refactors

Context in the repo

CLAUDE.md, specs

Keep sessions coordinated

Narrow

Separate

Shared

### Slide 30
“

“One task, one worktree, one review.”

Parallel, but never tangled.

### Slide 31
Episode 27

Recap

Several agents, each in its own worktree.

01

Mac app,
for now

Worktrees anywhere

02

Split if they
ship apart

Own ports, own setup

03

Merge one,
update next

Not a sandbox

### Slide 32
The Capstone

Next in the playlist

Episode 28: the project and requirements.

EPISODE 28

Subscribe and turn on notifications for the playlist.

