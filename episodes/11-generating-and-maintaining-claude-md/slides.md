# Episode 11: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Generating and
Maintaining CLAUDE.md

Agentic Engineering · Episode 11

A free course on building software with AI agents

### Slide 2
Four

parts

Get a good first version fast, then keep it true as the project changes.

01

Generate

/init gives you a draft

04

Scale it

Subfolders, rules, personal

02

Trim and add

Cut, then add real rules

03

Keep it true

Update, prune, review

### Slide 3
01

Generate a
starter

/init is a draft.

### Slide 4
01

Analyzes the codebase

Writes the build commands, test steps, and conventions it finds.

02

Already have one?

It suggests improvements instead of overwriting.

Start with /init

First session in a repo: /init, then /memory to refine.

Treat the result as a draft, not a finished file.

/init
# then refine it:
/memory

Illustration

### Slide 5
Guided /init

Set CLAUDE_CODE_NEW_INIT=1 before you run /init for a guided flow.

?

Asks what to set up

CLAUDE.md files, skills, and hooks.

S

Explores first

A subagent reads the code, then asks you questions.

Then

A proposal to review

Nothing written

until you have read it

# shell
export CLAUDE_CODE_NEW_INIT=1
claude
# in the session
/init
review the proposal

Illustration

### Slide 6
Example draft
- src/ has cart.js, discounts.js...
- Uses Node.js and npm
- Follow the existing code style
- Run tests with npm test
  # keep: the test command

Keep
npm test

Cut
tour, Node, vague style

For each line
Would removing it cause mistakes?
Can Claude see it in the code?
Specific enough to check?
Does the command really work?

Review the
draft

Example draft
Written for this course. Real /init output will differ.

Illustration

### Slide 7
Add
integer cents
Add
store timezone
Add
plan first

Add the team's
real rules

What Claude wouldn't discover on its own.

Plus:

npm test before commits

Each one is a correction you would otherwise type by hand.

### Slide 8
02

Keep it
true

Update, prune, review.

### Slide 9
When to update it

Mistake

Add rule

Review

Watch

Prune

Same mistake twice? Add a rule

### Slide 10
01

Ask Claude

"Add this to CLAUDE.md", then the rule.

02

Or edit it yourself

/memory opens the file in your editor.

Adding a rule

"Remember this" goes to auto memory, not CLAUDE.md.

Team rule? Say CLAUDE.md explicitly.

> add this to CLAUDE.md:
  discount dates compare in the
  store timezone
/memory

Illustration

### Slide 11
Prune stale
lines

Signs of stale

A file that moved
A version that changed
Two rules that conflict

Conflicts: Claude may pick one arbitrarily.

Tools to find it

/doctor proposes trims
/doctor prompt-audit
Your own review

Nothing changes until
you apply the edits

Stale
is worse
A wrong instruction is worse than no instruction.

### Slide 12
$ git diff CLAUDE.md
- Use Node 16
+ Discount dates: store timezone
  Prices: integer cents
  npm test before every commit
  Plan multi-file changes first

Drawn for the course

>_

Checked
into git

Reviewed like code.

A change to CLAUDE.md changes how the agent behaves for everyone.

Illustration

### Slide 13
03

Scale
it

Bigger projects, personal notes.

### Slide 14
Organize as

it grows

One file stops being enough. Four tools from the docs.

01

Subfolders

CLAUDE.md loads on demand

04

@imports

Organize; no context saved

02

Rules

.claude/rules/, path-scoped

03

Excludes

claudeMdExcludes in monorepos

### Slide 15
Just you
CLAUDE.local.md
All projects
your user file
Worktrees
import from home

Personal
preferences

Keep personal notes out of the team file.

Gitignore

CLAUDE.local.md

New teammate needs it? Project file. Only you? Local or user file.

### Slide 16
Maintenance

checklist

Run it whenever Claude surprises you, and on a regular rhythm.

01

Twice?

Add a rule

04

Prune

Stale, conflicting, vague

02

Every line

Would removing it hurt?

03

In PRs

Changes reviewed like code

### Slide 17
“

“Treat CLAUDE.md like code: review it when things go wrong, prune it regularly.”

Anthropic's Claude Code best practices

### Slide 18
Episode 11

Recap

Generate a draft, add the real rules, and keep the file true.

01

Generate
and trim

/init, then cut and add

02

Keep it
true

Add, edit, prune, review

03

Scale
it

Subfolders, rules, local file

### Slide 19
What Subagents Are
and When to Use Them

Next in the playlist

Separate context for focused work, and when it pays off.

EPISODE 12

Subscribe and turn on notifications for the playlist.

