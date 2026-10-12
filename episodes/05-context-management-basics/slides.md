# Episode 5: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Context
Management Basics

Agentic Engineering · Episode 5

A free course on building software with AI agents

### Slide 2
Two

parts

First the basics: what the context window is and what fills it. Then six habits for filling it well.

01

What it is

The agent's working memory

04

Filling it well

Six habits, one checklist

02

What fills it

Startup, prompts, files, output

03

Why quality drops

Fuller and noisier is worse

### Slide 3
01

The
basics

What's in Claude's working memory.

### Slide 4
All it knows right now

about this session

As you work

Messages, files, output

Each new session

starts with an empty window

The agent's working memory

Everything

Fills up

Fresh

### Slide 5
What fills it

Startup

Your
prompt

File
reads

Tool
output

Replies

Every turn adds more

### Slide 6
Illustration
you see  Read src/discounts.js
context  + the whole file
you see  Bash npm test
context  + all of its output
         one line for you, all for Claude

File reads
dominate context use.

Be specific
so it reads less.

Loaded before you type
System instructions (hidden)
CLAUDE.md: personal and project
Auto memory from earlier sessions
Environment and git info
Tool and skill lists

What loads
first

Then, as it works
Your messages, its replies, every tool result.

### Slide 7
Fuller
more mistakes
Noisier
less focus

Why quality
drops

As context fills, Claude may forget earlier instructions or make more mistakes.

Auto

compacts near the limit

Early detailed instructions can get lost. Lasting rules go in CLAUDE.md.

### Slide 8
> /context
  system, tools   ###
  memory files    #
  conversation    ########
  free space      ..........
  + tips to free up space

Illustration

>_

See it:
/context

A live breakdown.

Plus suggestions, and which CLAUDE.md and memory files loaded. /memory opens them.

### Slide 9
02

Filling
it well

What the task needs, and nothing else.

### Slide 10
// prompt
> fix the rounding bug
  in @src/dis

src/discounts.js
src/cart.js
test/

Illustration: @ autocomplete

Point at the
right files

Type @ and a path.

1 file

instead of a search

Claude reads it before it responds. Point at patterns, too.

### Slide 11
Specs, examples,
constraints

Vague

"Implement a function that
validates email addresses."

Claude has to guess what done means.

Specific

validateEmail()
Example test cases
Run the tests after

Constraint:
never below 0

Can't
read minds
Examples remove ambiguity. Constraints rule out wrong answers.

### Slide 12
01

Paste the real error

Message, stack trace, failing test. The relevant part.

02

Run it in the session

! runs a shell command. The output lands in context.

Share the error

"The build is failing" gives Claude nothing to work with.

Ask for a root-cause fix, verified by a passing build.

the build fails with this error: ...
! npm test
cat error.log | claude -p "explain this error"

### Slide 13
Explore, then act

Let Claude read the right code and plan before it changes anything.

?

Ask first

"How are discounts applied here?"

P

Plan mode

Reads and plans. No source edits.

Scope it

Name the folder and the question

Big search?

Subagents: later in the course

# illustration
> investigate the app
  (reads everything)
Better:
> in src/, how are
  discounts applied?

### Slide 14
01

One task per session

No kitchen sink. Side question? Use /btw.

02

Start fresh

/clear between unrelated tasks.

Then start fresh

Corrected it twice on the same issue? Clear, and write a better prompt.

The old conversation stays in /resume.

/btw      quick side question
/clear    new task, empty context
/resume   bring the old one back

### Slide 15
Before Enter

check

Four questions I ask before I send a real task.

01

Right files

Did I point at them?

04

Clean slate

No leftovers from the last task

02

Clear spec

Constraints, example, a check

03

Real evidence

The actual error, pasted

### Slide 16
“

“Context is the agent’s working memory. Fill it with what the task needs, and keep everything else out.”

The mental model for every session

### Slide 17
Episode 5

Recap

The context window is working memory: it fills as you work, quality drops as it fills, so fill it well.

01

Working
memory

All Claude knows about the session

02

Fills, then
drops

Check it with /context

03

Fill it
well

Files, specs, errors, one task, /clear

### Slide 18
Controlling Context and
Writing Good Prompts

Next in the playlist

Compacting, CLAUDE.md, and how to write the prompt itself.

EPISODE 6

Subscribe and turn on notifications for the playlist.

