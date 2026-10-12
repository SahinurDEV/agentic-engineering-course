# Episode 26: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
GitHub
Integration

Agentic Engineering · Episode 26

Claude in your issues, PRs and checks

### Slide 2
Three

parts

Claude Code, working where your team works.

01

Use
cases

Two places, two modes

02

Setting
up

App, secret, workflow

03

Example
usages

Issue, @claude, review

### Slide 3
01

Use
cases

Where Claude meets GitHub.

### Slide 4
Two
places

Your machine

The gh CLI
Issues, PRs, comments
You watch each step

Without gh, API calls often hit rate limits.

GitHub Actions

The Claude Code action
Triggered by @claude
Runs on GitHub

Local, or
in the repo

Same
Claude
A different machine.

### Slide 5
On your machine

Nothing in the repo

claude-code-action

You write the workflow

Code Review

Managed, research preview

Three products, one name

gh

Action

Review

### Slide 6
What it’s

for

Use cases from the docs.

01

Issue

Into a branch

04

Automate

Any event, even cron

02

Fix

From a comment

03

Answer

In the thread

### Slide 7
Interactive
waits for @claude
Automation
runs a prompt
Results
comment, or log

Two
modes

The workflow file picks one.

No mode

setting

Automation posts only when told to.

### Slide 8
Human actor
bots are rejected
unless listed
stops loops
schedules too

Check
who starts
a run
 
Before
what it does

Write access
Issue and PR events
Trigger needs write
Strangers: no run
Opening it up: risky

Who can
start it

Two checks, every run
If either rejects, the run fails.

Illustration

### Slide 9
02

Setting
up

App, secret, workflow.

### Slide 10
get    cli.github.com
login  gh auth login
check  gh auth status
open   claude
type   /install-github-app

Illustration

>_

gh first

Then one command.

Typed commands only, no output.

Illustration

### Slide 11
What the command does

App

Secret

Branch

PR ready

You merge

Nothing runs until you merge

### Slide 12
Which
secret?

API key

From the Console
Billed to the API
Best for org secrets

Saved in Secrets and variables, Actions.

Subscription

claude setup-token
Pro, Max, Team, Ent.
Tied to one person

Pick one,
store it

Never
commit
The file names the secret.

### Slide 13
# the action uses
contents: rw
issues: rw
pull requests: rw

Full app set
13 permissions
all or none

from the official docs

Permissions

Read them before you click.

3

used by the action

Smallest set: your own app, with just those 3.

Illustration

### Slide 14
When it runs

claude.yml, part one. Written for the course.

1

Events

Two kinds of comment.

2

Filter

Only with @claude.

Missing

new-issue mentions

Where

.github/workflows

# claude.yml, part 1
on: issue_comment
pull_request_review_
  comment
if: comment has @claude

Illustration

### Slide 15
01

Permissions

5: three write, id-token, actions read.

02

Steps

Checkout, then the action at v1.

What it does

Two limits: 15 minutes, 10 turns.

Both from the docs’ cost advice.

# claude.yml, part 2
checkout@v6
claude-code-action@v1
--max-turns 10

Illustration

### Slide 16
GitHub runners

Billed by GitHub

API key or plan

Specific asks, fewer turns

10 turns, 15 minutes

Keep CLAUDE.md short

Two costs, two caps

Minutes

Tokens

Caps

### Slide 17
03

Example
usages

In the cart project.

### Slide 18
# issue #12
Run the tests on
every pull request
npm test: PRs, main

Done when
each PR runs tests
main does too

written for the course

Issue twelve

A drawn issue, not a real one.

#12

Open

Nothing runs the cart’s tests on GitHub yet.

Illustration

### Slide 19
read   gh issue view 12
add    test.yml, Node 22
on     branch ci-tests
open   gh pr create
body   Closes #12

Illustration

>_

The prompt

Issue to pull request.

Written for the course. Claude’s reply isn’t shown.

Illustration

### Slide 20
The test workflow

test.yml. Written for the course.

1

When

PRs, and pushes to main.

2

Steps

Four, in order.

PR runs on

open, push, reopen

Job

one, on Ubuntu

# test.yml
on: pull_request
push: main
node-version: 22
npm install, npm test

Illustration

### Slide 21
It doesn’t prove
tests are complete
the page works
the change is right
so: review

Green
means
passed
 
Not
correct

It proves
Tests pass
on a fresh machine
for that commit
not just your laptop

What green
proves

A green check means
npm test passed for that commit.

Illustration

### Slide 22
The local loop

Open

Checks

Review

Fix

Merge

gh pr checks, then /code-review

### Slide 23
01

You comment

@claude, on issue #13.

02

Claude pushes

A new branch, and a PR link.

@claude on an issue

Claude doesn’t open the PR.

You create it from the link.

# the run
comment has @claude
checks: write, human
branch, then a link

Illustration

### Slide 24
# comment on #13
@claude add a short
Shipping section
match the spec

Claude replies
in a comment
updates as it works

written for the course

The comment

Specific asks need fewer turns.

#13

README only

It points at specs/shipping/spec.md.

Illustration

### Slide 25
You open the PR
the tests run
App sign-in
pushes run tests
GITHUB_TOKEN
no new runs

Will the
tests run?

It depends on the token.

Default

app sign-in

Don’t pass GITHUB_TOKEN to the action.

### Slide 26
Four ways to

review

From lightest to most managed.

01

Local

/code-review

04

Managed

Code Review service

02

Posted

--comment on a PR

03

Workflow

In GitHub Actions

### Slide 27
branch /code-review
pr     /code-review 14
post   /code-review --comment 14
apply  /code-review --fix
risk   /security-review

Illustration

>_

Review
commands

Typed in Claude Code.

Typed commands only, no output.

Illustration

### Slide 28
Pull request types

open, push, ready, reopen

Posts on the PR

Without it: run log only

Inline comments

Named in claude_args

The review workflow

4 events

--comment

1 tool

### Slide 29
Stay
safe

Do

Keys in secrets
Least permissions
Review, then merge

Issues and comments are untrusted input.

Don’t

Commit keys
Open it to everyone
Tag unread issues

Read before
you tag

You
merge
The action doesn’t merge.

### Slide 30
“

“Claude pushes the branch. A human merges.”

Review stays with people.

### Slide 31
Episode 26

Recap

Claude in GitHub, with a human at the merge.

01

Two
places

gh, and Actions

02

Write access
to trigger

Caps: turns, time

03

Green is
not right

A human merges

### Slide 32
Parallel
Development

Next in the playlist

Episode 27, with Conductor. Module 12.

EPISODE 27

Subscribe and turn on notifications for the playlist.

