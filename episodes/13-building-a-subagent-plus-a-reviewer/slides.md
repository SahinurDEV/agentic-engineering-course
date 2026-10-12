# Episode 13: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Building a Subagent
(plus a Reviewer)

Agentic Engineering · Episode 13

A free course on building software with AI agents

### Slide 2
Four

parts

Write your own subagent, then a reviewer for the cart project. Week 2 ends here.

01

Create one

Scope, file format, fields

04

Week 2 wrap

What we built this week

02

Make it work

Description, tools, testing

03

A reviewer

code-reviewer for the cart

### Slide 3
01

Create a
subagent

A markdown file with a small header.

### Slide 4
01

Ask Claude

Describe it and where to save it. Claude writes the file.

02

Or write the file

A markdown file with a small header on top.

Two ways to create

/agents now prints a reminder: ask Claude or edit the folders.

Up to v2.1.197, /agents opened a wizard.

> create a code-reviewer
  subagent in .claude/agents/.
  read-only. use sonnet.

Illustration

### Slide 5
Project or
user scope

Project

.claude/agents/
This codebase only
Checked into git

Wins on a name clash with user scope.

User

~/.claude/agents/
All your projects
Just for you

Folders scan
recursively

Check it
in
Project subagents live in git, so the team can improve them.

### Slide 6
The file format

YAML frontmatter between --- lines, then a markdown body.

1

Frontmatter

What it is and what it can do.

2

Body

Its system prompt, on every run.

Required

name and description

Exact names

Unknown fields are ignored

---
name: code-reviewer
description: when to use it
tools: Read, Grep, Glob
---
You are a code reviewer...

Illustration

### Slide 7
Body
= system prompt
Only
this prompt
Still
loads CLAUDE.md

The body is
the prompt

It gets only this prompt, plus basic environment details.

So:

make it stand alone

Who it is, the steps when invoked, what to send back.

### Slide 8
The fields that

matter

Also: disallowedTools, maxTurns, and more. Names must match exactly.

01

name

Unique id, required

04

model

sonnet, opus, haiku, inherit

02

description

When to delegate, required

03

tools

Allowlist; omit to inherit

### Slide 9
02

Make it
work well

Description, tools, invoking, testing.

### Slide 10
A good description

Claude delegates using your request, the description, and context.

1

Say when

Not just what it is.

2

Keep it short

It costs context in every session.

Proactive?

Add "use proactively"

Detail

goes in the body

# weak
Reviews code.
# strong
Reviews the diff for bugs,
edge cases, off-plan changes.
Use after tests pass.

Illustration

### Slide 11
01

An allowlist

Read, Grep, Glob, Bash. No Write, no Edit.

02

Or remove a few

disallowedTools takes tools away from the inherited set.

Restrict the tools

Bash can still run any command.

"Never edit" in a prompt is an instruction. Hooks enforce: Week 3.

tools: Read, Grep, Glob, Bash
# or start wide and remove:
disallowedTools: Write, Edit

Illustration

### Slide 12
Ways to invoke it

Automatic

By name

@-mention

--agent

Setting

From a hint to a guarantee

### Slide 13
Ask
it
Read
the result
Edit
the file

Test and
iterate

Edits are picked up within seconds. No restart needed.

New dir?

restart once

Test both: a request that should trigger it, and one that should not.

### Slide 14
03

A reviewer
subagent

For the cart project.

### Slide 15
code-reviewer.md

An example file written for this course. A starting point, not a standard.

R

Identity

You review; you never edit files.

5

Five steps

Diff, plan, edge cases, money, tests.

Model

sonnet

Scope

.claude/agents/ in the repo

---
name: code-reviewer
description: Reviews the diff
  ... Use before committing.
tools: Read, Grep, Glob, Bash
model: sonnet

Illustration

### Slide 16
What the prompt

tells it

Then report: verdict, must fix, should fix, outside the plan. Keep it short.

01

Read the diff

git diff, changed files

04

Money, tests

Integer cents, npm test

02

Check the plan

Flag off-plan files

03

Edge cases

A test for each one

### Slide 17
01

By name

Claude usually delegates when you name it.

02

By @-mention

Guarantees this subagent runs for the task.

After a feature

Tests pass, then review, then commit.

Its reading stays in its own context, not yours.

> have the code-reviewer
  subagent review vs @PLAN.md
> @"code-reviewer (agent)"
  review the expiry changes

Illustration

### Slide 18
How the summary
comes back

In the subagent

git diff, file reads
The full test run
The plan comparison

All of it stays in its context.

In your session

Verdict: ...
Must fix: ...
Outside the plan: ...

The format, not
a real review

Findings,
not files
Read the verdict, fix, re-run, then read the diff yourself.

### Slide 19
Plan
it
Execute
it
Verify
it

Week 2,
done

A workflow, a CLAUDE.md, and subagents.

Week 3:

skills, hooks, MCP

Plus a reviewer that checks the work against the plan.

### Slide 20
“

“A subagent is only as good as its description and its last line.”

Description decides when. The report format decides what.

### Slide 21
Episode 13

Recap

A markdown file, a sharp description, and a short report.

01

Create
one

.claude/agents/, frontmatter

02

Make it
work

Description, tools, invoking

03

A
reviewer

Diff vs plan, short verdict

### Slide 22
Introduction
to Skills

Next in the playlist · Week 3

Week 3 starts here: reusable skills.

EPISODE 14

Subscribe and turn on notifications for the playlist.

