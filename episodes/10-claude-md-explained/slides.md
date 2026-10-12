# Episode 10: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
CLAUDE.md
Explained

Agentic Engineering · Episode 10

A free course on building software with AI agents

### Slide 2
Four

parts

The file Claude reads every session, and how to review one.

01

What it is

Persistent instructions

04

Review one

A sample cart CLAUDE.md

02

Where it lives

User, project, local, subfolder

03

What goes in

And what stays out

### Slide 3
01

What is
CLAUDE.md

Persistent instructions.

### Slide 4
Every
session
starts
fresh
CLAUDE.md
loads at start

Persistent
instructions

Markdown you write. Claude reads it at the start of every session.

Context,

not enforced config

Must always happen? That is a job for a hook.

### Slide 5
CLAUDE.md vs
auto memory

CLAUDE.md

You write it
Instructions and rules
Project, user, or org

Both load at the start of every conversation.

Auto memory

Claude writes it
Learnings and patterns
Per repository

Browse both with
/memory

Specific
and short
The more specific and concise, the more consistently Claude follows it.

### Slide 6
user    ~/.claude/CLAUDE.md
project ./CLAUDE.md
project ./.claude/CLAUDE.md
local   ./CLAUDE.local.md
subdir  src/api/CLAUDE.md
managed /etc/claude-code/CLAUDE.md

Illustration

>_

Where it
lives

Broad to specific.

The project file is shared in git. CLAUDE.local.md is just for you: add it to .gitignore.

### Slide 7
How they load

Managed

User

Project

Local

Subfolder

Subfolders load on demand

### Slide 8
02

What goes
in it

And what stays out.

### Slide 9
What

belongs

What Claude can't guess and needs every session. Workflow rules too, like plan first.

01

Commands

Build, test, lint it can't guess

04

Gotchas

What isn't self-evident

02

Style

Rules that differ from defaults

03

Architecture

Decisions specific to you

### Slide 10
Long docs
link instead
Obvious
the code shows it
Secrets
never

What
stays out

Tutorials, file-by-file tours, info that changes often.

In git?

then no keys in it

The project file is shared with everyone who has the repo.

### Slide 11
01

Under 200 lines

The docs' target per file. Longer costs context and adherence.

02

One question per line

Would removing this cause Claude to make mistakes?

Keep it concise

It loads every session, so every line costs context.

One rule keeps getting skipped? IMPORTANT on that line only.

# illustration
/context   # see Memory files
/memory    # open and edit

### Slide 12
Imports with @

@path pulls another file in at launch, next to the CLAUDE.md that names it.

@

Relative paths

Resolve from the importing file.

4

Four hops

Imports can import, four levels deep.

No savings

Imports still load at launch

Backticks

keep an @path literal

# illustration: CLAUDE.md
See @README for the overview
and @package.json for scripts.
# Personal
- @~/.claude/cart-prefs.md
`@README` stays literal

### Slide 13
03

Review a
CLAUDE.md

Line by line, like a pull request.

### Slide 14
Illustration · example CLAUDE.md
- Write clean, readable code
- Use Node 16
- src/cart.js does the cart, src/...
- Prices are integers in cents
- PAYMENT_KEY=xxxx

Review it
like a PR.

Each line
earns its place.

Also in the file
A paragraph of history
Run tests with npm test
Be careful with checkout
Dates: store timezone

The sample
file

Before
A cart CLAUDE.md written for this course, with problems on purpose.

### Slide 15
Vague
"clean code"
Stale
"Node 16"
Risky
a payment key

Spot the
problems

Keep: npm test, integer cents, store timezone.

Bloated?

history, file tour

"Careful with checkout": make it checkable, or cut it.

### Slide 16
01

Concrete, or cut

Every line passes the "would removing this cause mistakes" test.

02

Headers and bullets

Grouped sections are easier to follow.

Tighten it

Commands, gotchas, workflow. Nothing the code already shows.

Check it loaded: /context, under Memory files.

# illustration: after
- npm test before every commit
- Prices: integer cents, no floats
- Discount dates: store timezone

### Slide 17
“

“Would removing this cause Claude to make mistakes? If not, cut it.”

Anthropic's Claude Code best practices

### Slide 18
Episode 10

Recap

A short, specific file Claude reads every session.

01

What
it is

Persistent instructions, as context

02

What
goes in

Commands, style, gotchas

03

How to
review

Cut vague, stale, bloat, secrets

### Slide 19
Generating and
Maintaining CLAUDE.md

Next in the playlist

A good first version fast, and keeping it true.

EPISODE 11

Subscribe and turn on notifications for the playlist.

