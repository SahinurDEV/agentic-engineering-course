# Episode 15: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Running
a Skill

Agentic Engineering · Episode 15

A free course on building software with AI agents

### Slide 2
Four

parts

Run it, feed it, extend it, test it. add-discount does the work.

01

Run it

Automatic, or /name

04

Test it

Fresh sessions, baseline

02

Arguments

$ARGUMENTS, $0, $code

03

Files, scripts

Bundled scripts, live data

### Slide 3
01

Two ways
to run it

Automatic, or by name.

### Slide 4
Claude picks it up

Your ask

Listing

Match

SKILL.md

Steps

The description is all Claude sees first

### Slide 5
ask    add a summer code
       # matches description
type   /add-discount
       # runs directly
args   /add-discount SUMMER10 10

Illustration

>_

Or call it
by name

Type /add-discount.

Name = folder, or the name field. Text after it becomes arguments.

Illustration

### Slide 6
Where the
name goes

At the start

/add-discount ...
Runs the skill
Right away

No slash at all: you are only talking about it.

After plain text

... then /add-discount
Permission only
Claude judges

Same name,
two meanings

Lead
with it
Start the message with /name to run it.

### Slide 7
You and Claude

Description in context

disable-model-invocation

Description not in context

user-invocable: false

Hidden from the / menu

Who can invoke it

Default

Manual

Claude

### Slide 8
# deploy/SKILL.md
name: deploy
disable-model-
  invocation: true

/deploy
you run it
Claude cannot

manual only

Keep side
effects manual

Commit, deploy, send: you pick when.

Or

skillOverrides

/skills menu: Space cycles, Esc saves. add-discount stays automatic.

Illustration

### Slide 9
One
message
Stays
across turns
Not
re-read

After it
runs

The rendered SKILL.md enters the conversation once.

5,000

tokens kept per skill

After compaction, from a shared 25,000 budget. Key steps go at the top.

### Slide 10
02

Arguments
and scripts

Feed it values. Give it tools.

### Slide 11
01

Placeholder

$ARGUMENTS becomes whatever follows the name.

02

No placeholder?

Claude Code appends ARGUMENTS: <value> at the end.

Pass it arguments

Both you and Claude can pass them.

add-discount: written for this course.

# SKILL.md body
Add or change code $ARGUMENTS
> /add-discount SUMMER10
# Add or change code SUMMER10

Illustration

### Slide 12
Arguments by

position

Quote multi-word values. Write a literal \$1.00 with a backslash.

01

$ARGUMENTS

Everything, as typed

04

argument-hint

Shown in autocomplete

02

$0, $1

By position, from zero

03

$code

Declared in arguments

### Slide 13
SKILL.md · add-discount
allowed-tools: Bash(
  ${CLAUDE_SKILL_DIR}/
  scripts/list-codes.sh *)
# executed, not loaded

Script
is run,
not loaded.
 
Claude
orchestrates.

allowed-tools
Pre-approves the listed tools
For the turn that invokes it
Clears on your next message
Restricts nothing else

Bundle a
script

${CLAUDE_SKILL_DIR}
The skill folder, wherever it is installed.

Illustration

### Slide 14
Live data, inline

!`command` runs before Claude reads the skill. Its output replaces the line.

F

Fails?

Aborts the whole skill.

P

Permissions

Checked against your rules.

Non-zero exit?

Append || true

Off switch

One setting turns it off

# SKILL.md body
## Recent changes
!`git log -5 --oneline`
## Your task
Add $code at $percent% off

Illustration

### Slide 15
03

Test and
iterate

Fresh sessions, a baseline, small edits.

### Slide 16
01

Ask naturally

Use words that match the description. Did it trigger?

02

Call it by name

/add-discount with arguments. Did it follow the steps?

Test it both ways

Not listed? Ask: What skills are available?

Edits to SKILL.md apply in the same session.

> add a summer code, 10% off
> /add-discount SUMMER10 10
# two prompts, fresh session

Illustration

### Slide 17
Compare to a

baseline

Triggering means Claude found it, not that it did the job.

01

Collect

A few realistic prompts

04

Compare

With vs without

02

Fresh session

No leftover context

03

Skill off

skillOverrides: "off"

### Slide 18
Not
triggering
Too
often
Stops
following

When it
misbehaves

Sharpen the description first.

Must hold?

use a hook

YAML error? Try --debug.

### Slide 19
1      write real prompts
2      run with skill on
3      run with skill "off"
4      compare results
5      tighten, save, rerun

Illustration

>_

Iterate on
add-discount

One small edit at a time.

Keep the prompt list. It is your check every time the skill changes.

Illustration

### Slide 20
“

“The description decides when a skill runs. The body decides what it does.”

Test both.

### Slide 21
Episode 15

Recap

Run it two ways, feed it arguments, test it on and off.

01

Run
it

Automatic or /name

02

Feed
it

$ARGUMENTS, scripts

03

Test
it

Fresh, skill on vs off

### Slide 22
The “Grill Me”
Skill

Next in the playlist

Episode 16 continues Week 3 with skills.

EPISODE 16

Subscribe and turn on notifications for the playlist.

