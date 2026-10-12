# Episode 29: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Capstone
Project Setup

Agentic Engineering · Episode 29

From an empty folder to the first commit

### Slide 2
Three

parts

One app, one setup, one commit.

01

App and
database

Laravel, React kit, Postgres

02

Claude Code
layer

Memory, skills, hooks, MCP

03

GitHub, first
commit

CI, push, GitHub app

### Slide 3
01

App and
database

Laravel 13 on PostgreSQL.

### Slide 4
PHP 8.3+
Composer, installer
Node 22+
npm, or Bun
PostgreSQL
running locally

What to
install

Laravel docs, plus the install.

Plus

git, gh, jq, Claude

jq is for our module 8 hooks.

### Slide 5
mac    php.new install script
linux  php.new install script
win    PowerShell, as admin
php?   laravel/installer only
after  restart the terminal

Illustration

>_

Install
PHP

One command per system.

From the Laravel docs. No output shown.

Illustration

### Slide 6
# laravel new support-desk
--react --pest --npm
--database=pgsql
--no-boost

Flags
from the
installer’s help

laravel new --help

Create the app

Answers as flags, repeatable.

5

flags, one command

SQLite is the default; one flag switches it.

Illustration

### Slide 7
Three

prompts

Plus one flag: no Boost.

01

Provider

Built-in, not WorkOS

04

Boost

Skipped, add later

02

Teams

No, we have roles

03

Features

Keep the defaults

### Slide 8
What the kit
gives you

The kit

Inertia, React 19
TypeScript, shadcn
Fortify auth

Plus Pest tests and a CI workflow.

Still ours

A Postgres user
Requirements
Claude Code layer

Kit first,
then ours

React
pages in
resources/js/pages

### Slide 9
Two databases

One role owns both. Run in psql.

1

Role

support_desk, with login.

2

Databases

One for the app, one for tests.

Owner

the role

Tests

own db

# one role, two dbs
role: support_desk
app: support_desk
tests: support_desk_test
data never mixes

Illustration

### Slide 10
01

.env

Username and password. Never committed.

02

.env.example

Username only. The shared template.

Point Laravel at it

Two files, two jobs.

Then delete the empty database.sqlite.

# .env
DB_DATABASE=support_desk
DB_USERNAME=support_desk
DB_PASSWORD=your own

Illustration

### Slide 11
After
pgsql
support_desk_test
same engine
separate data

Why
full text
search
 
Values
2 changed

Before
sqlite
:memory:
fast, but
not what ships

Tests on
PostgreSQL

phpunit.xml
Two values change.

Illustration

### Slide 12
First run

Migrate

Test

Dev server

Port 8000

Welcome

composer run dev: server, queue worker, Vite

### Slide 13
RegistrationTest

2 tests

AuthenticationTest

6 tests

PasswordResetTest

5 tests

R1, checked by the kit

Register

Sign in

Reset

### Slide 14
02

Claude Code
layer

Shared with the team, in git.

### Slide 15
The .gitignore
surprise

Lines out

/.claude
/CLAUDE.md
/.mcp.json

Then copy in docs/requirements.md.

Lines in

settings.local.json
CLAUDE.local.md
playwright-output

3 out,
3 in

Team
layer
Committed to git.

### Slide 16
line3  @docs/requirements.md
stack  Laravel, React, Postgres
cmds   dev, test, pint, ci
where  pages, routes, specs
rules  seven, one per line

Illustration

>_

CLAUDE
.md

Short, with one import.

Written for the course. Summary view.

Illustration

### Slide 17
Four

skills

From module 7. One edit.

01

React

Paths: resources/js

04

Migration

As it was

02

Security

As it was

03

Database

As it was

### Slide 18
# settings.json
protect files
format edits
tests on Stop

Format
now with
vp fmt

the kit uses Vite+

Three hooks

Plus one deny rule.

1

settings file, shared

Pint still formats PHP, as before.

Illustration

### Slide 19
Support Desk
OpenSpec change
Pest per scenario
policies, notes
php artisan test

Same
shape
new checks
 
Edits?
never

Cart version
plan file
prices in cents
npm test
cart only

The reviewer,
adapted

code-reviewer
Reviews, never edits.

Illustration

### Slide 20
Playwright MCP

Project scope, from module 9.

1

Add

Writes .mcp.json, shared.

2

Approve

Once, on first start.

Viewport

1280x720

Mode

isolated

# R1 in a browser
register a customer
sign out, sign in
request a reset link
report console errors

Illustration

### Slide 21
6 added

by openspec init

6 added

the opsx set

1 context note

3 rule groups

OpenSpec

Skills

Commands

Config

### Slide 22
01

Tool files

Written by Claude Code and OpenSpec.

02

Ignore list

Five patterns in vite.config.ts.

Formatter vs tools

Found by running the kit’s checks.

Code formatted, tool files untouched.

# fmt ignorePatterns
.claude, .mcp.json
CLAUDE.md, docs
openspec

Illustration

### Slide 23
03

GitHub and
first commit

CI, push, and the GitHub app.

### Slide 24
image  postgres
db     support_desk_test
check  pg_isready
port   5432, on localhost
env    6 DB settings

Illustration

>_

CI on
PostgreSQL

A service container.

Written for the course. Summary view.

Illustration

### Slide 25
Before the first commit

ci:check

git status

No .env

Commit

Push

Run what CI runs, then read the list

### Slide 26
Failed
TypeScript check
Where
generated routes
Ours?
no, upstream

A red
check?

Seen in my throwaway install.

First

check the kit repo

Never hand-edit generated files.

### Slide 27
# first commit
git init -b main
git add -A
gh repo create

Push
starts the
kit’s workflow

runs on push to main

First commit

One commit, one push.

1

private repo

The push flag sends the commit.

Illustration

### Slide 28
Connect

GitHub

/install-github-app

01

App

Installs the app

04

Review

Read, then merge

02

Secret

Adds your secret

03

Pull request

Workflow, prepared

### Slide 29
Not committed
.env
vendor, node_modules
settings.local.json
playwright-output

Clone
own .env
own db
 
Approve
once

Committed
app, CLAUDE.md
docs, openspec
.claude folder
.mcp.json, CI

What’s in
the repo

First commit
Every rule and tool.

Illustration

### Slide 30
Ready for
data modeling

Today

App on Postgres
R1 checked
Claude layer, CI

Every next step starts as a spec.

Next

Roles first
Then tickets
And categories

R1 done
with roles

Spec
first
Then migrations.

### Slide 31
“

“Set up once, carefully.”

Every session after starts on solid ground.

### Slide 32
Episode 29

Recap

From an empty folder to the first commit.

01

Laravel on
Postgres

Tests on Postgres too

02

R1
checked

Tests and a browser

03

Claude
layer

CI and the GitHub app

### Slide 33
Data Modeling

Next in the playlist

Episode 30: Capstone, Data Modeling Part 1.

EPISODE 30

Subscribe and turn on notifications for the playlist.

