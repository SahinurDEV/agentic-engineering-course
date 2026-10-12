# Episode 18: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
A Laravel
Security Skill

Agentic Engineering · Episode 18

A free course on building software with AI agents

### Slide 2
Three

parts

Laravel security rules that load whenever Claude writes PHP.

01

Why a
skill

Defaults, escape hatches

02

Write
it

Paths, rules, checklist

03

Use and
test it

Review, baseline, limits

### Slide 3
01

Why security
needs a skill

Even with safe defaults.

### Slide 4
Blade
escapes output
Bindings
stop injection
Models
guarded by default

Secure by
default

Laravel does a lot out of the box.

But

each has a way around

CSRF tokens too: one per user session.

### Slide 5
DB::raw, whereRaw

No guarantee

Unescaped Blade

Careful with user data

Every attribute open

Hand-craft every array

Three escape hatches

Raw SQL

{!! !!}

Unguarded

### Slide 6
Skill or
review?

/security-review

Built-in command
Checks your branch
After the fact

Same name as a built-in? Yours replaces it.

laravel-security

Reference content
Runs inline
While code is written

Different name,
different job

Use
both
Write it safely, then review it.

### Slide 7
Four rule

groups

Lined up with the OWASP Top 10:2025.

01

Input, queries

Validate, bind

04

Secrets

No .env, no debug

02

Output

Escape every echo

03

Access

Authorize, CSRF, throttle

### Slide 8
02

Writing
the skill

Paths, four rule groups, a checklist.

### Slide 9
dir  .claude/skills/
       laravel-security/
main   SKILL.md
list   checklist.md
      

Illustration

>_

A project
skill

Committed for the team.

No allowed-tools field. Review that field in any repository skill.

Illustration

### Slide 10
01

description

Main use first: controllers, routes, models, views.

02

paths

PHP files under app, routes, and views.

The frontmatter

Blade files end in .blade.php, so the views pattern matches.

Full file in the description.

name: laravel-security
when_to_use: Adding a ...
paths:
  - "app/**/*.php"

Illustration

### Slide 11
SKILL.md · laravel-security
## Input and queries
- Validate every request
- Only validated data
- Never Unguarded

Every
request field
is untrusted
 
Even
headers.

Queries
Query builder or Eloquent
Bindings, never raw input
No user-chosen columns
Allow list for order by

Input and
queries

Validate
Then pass only validated data to create or update.

Illustration

### Slide 12
Output and access

Escape every echo. Authorize every action.

O

Escaped echo

Blade {{ }} for user data.

A

Authorize

A policy or a gate.

CSRF

@csrf on every form

Throttle

Login, password reset

# SKILL.md · Output
- Echo with {{ }}
- No {!! !!} for user data
# SKILL.md · Access
- Authorize every action

Illustration

### Slide 13
01

No secrets in code

Never commit .env. APP_DEBUG false in production.

02

Tests and summary

Run the tests, then list every security change.

Secrets and checks

Hash passwords with the Hash facade.

Never log a password or token.

## Secrets and configuration
- Never commit .env
## Checks
- List security changes

Illustration

### Slide 14
# checklist.md
## Access (A01)
Change the id in
the URL: blocked?

checklist.md
OWASP-mapped
read for reviews

supporting file

checklist.md

Questions, grouped by OWASP risk.

No

angle brackets

Plain words, no arrows or HTML tags: pastes cleanly into a YouTube description.

Illustration

### Slide 15
03

Using and
testing it

Automatic, by name, then a baseline.

### Slide 16
How it gets used

Laravel task

paths

SKILL.md

Rules

Checks

Nothing special to type

### Slide 17
type   /laravel-security
         app/Http/Controllers/
         OrderController.php
then   /security-review
       # prompts only

Illustration

>_

Or ask for
a review

Then /security-review.

No placeholder: the path is appended as ARGUMENTS. Prompts only, no output.

Illustration

### Slide 18
Test it

twice

Then check the trigger: a frontend prompt should not load it.

01

Prompts

Ones that tempt shortcuts

04

Compare

Authorized? Escaped?

02

Skill on

Fresh session

03

Skill off

skillOverrides: "off"

### Slide 19
Skill
teaches
Hook
enforces
Review
catches the rest

Guidance, not
a guarantee

Claude follows a skill. Nothing enforces it.

Must hold?

use a hook

Like blocking edits to .env. Hooks are later in Week 3.

### Slide 20
“

“Laravel’s defaults are safe. The skill keeps Claude from stepping around them.”

Rules from laravel.com/docs.

### Slide 21
Episode 18

Recap

Reference content for PHP files, rules from the Laravel docs, an OWASP checklist.

01

Reference
skill

Project skill, PHP paths

02

Four rule
groups

Input, output, access, secrets

03

Tested and
backed

Baseline, hooks, review

### Slide 22
Database Skills,
Writing Your Own

Next in the playlist

Episode 19 continues Week 3 with skills.

EPISODE 19

Subscribe and turn on notifications for the playlist.

