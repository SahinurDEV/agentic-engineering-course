# Day 20 · Episode 19: Database Skills and Writing Your Own

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 12:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 7 lessons):** Database Skills, Creating your own Skills

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `database-conventions` and `new-migration` skills and the starter template are **written for this course** (full text under "Example files" below). The database rules come from the official Laravel docs (laravel.com/docs) and PostgreSQL docs (postgresql.org/docs). No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) | n/a |
| 1:00–4:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · A database reference skill | Database Skills |
| 4:30–7:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · A migration task skill | Database Skills |
| 7:30–11:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Writing your own: a six-step recipe | Creating your own Skills |
| 11:00–12:00 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we wrote a Laravel security skill: rules that load whenever Claude writes P H P, so it doesn't step around Laravel's safe defaults.
> Today we finish the skills module. Two database skills that work as a pair, and then the part I most want you to keep: a recipe you can reuse to write any skill of your own.

**Visual / B-roll:**
- Episode 18 recap panel, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode nineteen: database skills, and writing your own.

*Cue: agenda slide "Three parts"*
> Three parts. First, a database reference skill: the conventions Claude follows whenever it touches migrations or models. Second, a migration task skill, one you start yourself. Third, a six-step recipe for writing your own. Everything on screen is an illustration. Both skills are written for this course, and the database rules come from the official Laravel and PostgreSQL docs.

**Visual / B-roll:**
- Three items: 01 Reference skill · 02 Task skill · 03 Your own.

### 1:00–4:30 · Part 1: A database reference skill
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · A database reference skill"*
> Part one. A database reference skill.

*Cue: panel "Why the database"*
> Why the database? Three reasons.
> It's shared. A schema change doesn't stay on your machine. It runs on every teammate's database, on staging, and on production.
> It's hard to undo. The Laravel docs say plainly that some migration operations are destructive, which means they may cause you to lose data.
> And the details are easy to forget: a down method, a foreign key, an index, a transaction.
> So this time I wrote two skills. One reference skill for the conventions, and one task skill for the job of creating a migration.

*Cue: four numbered "Four rule groups"*
> The reference skill is called database conventions, and it has four groups of rules.
> Schema changes: migrations only, and every change can be reversed.
> Queries: no N plus one, and transactions for writes that belong together.
> Safety: no destructive commands without asking.
> And checks: run the tests after every schema change.

*Cue: drawn folder tree "Two project skills"*
> Both are project skills, committed with the code, under dot claude slash skills. One folder is database dash conventions. The other is new dash migration. Each has a single SKILL dot M D. The full text of both is in the description.
> The reference skill uses paths, like the last two episodes. Its patterns are the P H P files under database slash migrations and app slash Models. So Claude loads it automatically when it works on a migration or a model, and not when it edits a Blade view.

*Cue: card "Schema changes"*
> The body opens with the standing instruction: apply these rules to all database work in this task.
> Group one is schema changes. The Laravel docs describe migrations as version control for your database, so your team can define and share the schema. The rule: change the schema only through migrations made with make migration. Never change a table by hand.
> A migration has two methods, up and down. The docs say the down method should reverse what the up method did, so the skill requires one.
> Never edit a migration that has already run anywhere but your own machine. Add a new one instead. That's standard practice, because other databases have already recorded the old one as done.
> And add foreign key constraints for relationships. The docs say they enforce referential integrity at the database level.

*Cue: plan "Queries and safety"*
> Group two is queries. Eager load the relationships you use in a loop. The Eloquent docs say eager loading alleviates the N plus one query problem, where one query for a list turns into one more query for every row.
> Wrap writes that must succeed or fail together in D B transaction. The docs say if an exception is thrown inside, the transaction is rolled back automatically.
> Indexes go where queries need them. The PostgreSQL docs say indexes add overhead to the database system as a whole, so they should be used sensibly. And on PostgreSQL, a normal index build locks out writes to the table until it's done. For a big production table, the skill says to raise create index concurrently with me first.
> Group three is safety. Never run migrate fresh, migrate refresh, migrate reset, or d b wipe, and never add the force flag, without asking. Those commands drop or roll back everything.
> Then the check: run the test suite after every schema change, and report the result.

**Visual / B-roll:**
- Panel: Shared · Hard to undo · Easy to forget.
- Four numbered: Schema changes · Queries · Safety · Checks.
- Monitor + Illustration: two skill folders.
- Card + Illustration: Schema changes section.
- Plan + Illustration: Queries and Safety sections.

### 4:30–7:30 · Part 2: A migration task skill
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · A migration task skill"*
> Part two. A migration task skill.

*Cue: two points "The frontmatter"*
> New migration is task content: step by step instructions for one action. So its frontmatter looks different.
> Disable model invocation is true. Creating a migration is something I want to start myself. The docs say this stops Claude from loading the skill on its own, and its description isn't even in Claude's context.
> Argument hint is change, in square brackets, so the menu shows what to type. The body uses the arguments placeholder, so whatever I type after the name lands in the instructions.
> And it has an allowed tools field, but a narrow one. It pre-approves two commands: make migration, and migrate with the pretend flag. The docs say this grant lasts only for the turn that invokes the skill, and it doesn't restrict anything else. Every other command still goes through your normal permissions.

*Cue: flow "What /new-migration does"*
> The body is five numbered steps.
> One, read the related models and the latest migrations for that table.
> Two, run make migration with a descriptive name.
> Three, write the up method and a down method that reverses it.
> Four, run migrate with the pretend flag. The Laravel docs say this shows the S Q L the migrations would run, without running them. Show me that S Q L.
> Five, stop. Don't run the migration. I run it myself, after I've read the S Q L.

*Cue: drawn terminal "Starting it"*
> To use it, type slash new dash migration, then the change, like: add a shipped at timestamp to orders.
> On screen is only what I'd type. No output is shown.

*Cue: squares "Two skills, one change"*
> Here's why they're a pair. The task skill starts the job. When Claude writes the new migration file, that file matches the reference skill's paths, so the conventions can load too. And the last step stays with you: you run the migration.
> One honest note. Telling Claude not to run migrate fresh is guidance. If you want it blocked every time, add a deny rule in your permission settings, or a hook, which is next in the playlist.

**Visual / B-roll:**
- Two points + Illustration: new-migration frontmatter.
- Flow: Read → make:migration → up and down → --pretend → Stop.
- Monitor + Illustration: typed prompt only.
- Squares: Task starts · paths adds rules · You run it.

### 7:30–11:00 · Part 3: Writing your own
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Writing your own"*
> Part three. Writing your own. Here's the recipe I've used for every skill in this module. Six steps.

*Cue: two columns "Steps one and two"*
> Step one, spot the signal. The skills docs put it simply: create a skill when you keep pasting the same instructions, checklist, or procedure into chat, or when a section of CLAUDE dot M D has grown into a procedure rather than a fact.
> Step two, pick the type. Is it reference content, conventions Claude applies to whatever it's doing? Then let Claude load it, and add paths if it only matters for certain files. Or is it a task, a job with steps and an end? If it has side effects, or you want to control the timing, set disable model invocation to true.

*Cue: four numbered "Steps three to six"*
> Step three, choose the place. Personal skills live in your home folder and follow you to every project. Project skills live in the repository and reach the whole team.
> Step four, write the frontmatter. Description first, with the main use case at the front, because Claude reads it to decide when to use the skill. Add when to use for trigger phrases.
> Step five, write the body. Keep it short. The docs say once a skill loads it stays in context, so every line is a recurring cost. Write standing instructions, not one-time steps. Keep SKILL dot M D under five hundred lines, and move detail into supporting files.
> Step six, test it. We'll come back to that in a moment.

*Cue: phone "A starter template"*
> To make the recipe repeatable, I keep a starter template. It's in the description too. Frontmatter with a name, a description, and when to use, plus commented options for paths or disable model invocation. Then a standing instruction, a few rule groups, a checks section, and a link to any supporting file.
> I wrote it with square brackets for the blanks, not angle brackets, so it pastes cleanly into a YouTube description.

*Cue: two points "Step six: test it"*
> Testing has two halves, and the docs say to measure them separately.
> First, does Claude use the skill when it should? Ask, what skills are available, then try prompts that should trigger it, and a few that shouldn't.
> Second, does the result get better? Run a few realistic prompts in a fresh session with the skill on, then again with it off using skill overrides, and compare. A fresh session matters, because leftover context from writing the skill hides gaps.
> If you'd like to automate that loop, the docs describe a skill creator plugin that runs it for you. And Claude Code picks up edits to a skill file during a session, so you can tweak and re-test without restarting.

*Cue: panel "When it's not a skill"*
> And know when the answer isn't a skill.
> A short fact that's true in every session belongs in CLAUDE dot M D.
> A rule that must hold every time belongs in a hook, because a skill is guidance.
> And a one-off request? Just ask. Not everything needs a file.
> Later, the slash skill doctor command shows what each skill costs and how often it's used, so you can turn off the ones you don't need.

**Visual / B-roll:**
- Two columns: Signal vs Type.
- Four numbered: Place · Frontmatter · Body · Test.
- Phone + Illustration: skill-template.md.
- Two points + Illustration: trigger check and baseline.
- Panel: Fact → CLAUDE.md · Must hold → hook · One-off → just ask.

### 11:00–12:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: reference skills shape the work, task skills do the work, and you decide which one you're writing before you write a word.

*Cue: recap slide*
> Recap. Database conventions is a reference skill, loaded by paths for migrations and models: migrations only, a down for every up, foreign keys, eager loading, transactions, sensible indexes, and no destructive commands without asking. New migration is a task skill: manual only, with a narrow tool grant, and it stops at the pretend S Q L. And the recipe: spot the signal, pick the type, choose the place, write the frontmatter, write the body, and test it with a baseline.

*Cue: next-episode slide*
> Next in the playlist is episode twenty: hooks, the way to make a rule hold every time. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 20 · Hooks".

---

## Example files (written for the course)

All three files are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. Laravel code would normally use `->` and `=>`; the files name methods and commands in plain words or `Facade::method` form instead, and the template uses square brackets for blanks.

### `.claude/skills/database-conventions/SKILL.md`

```markdown
---
name: database-conventions
description: Database conventions for this Laravel project, from the Laravel and PostgreSQL docs. Use when writing or reviewing migrations, models, relationships, or database queries.
when_to_use: Adding or changing a table, column, index, or foreign key, writing a migration, adding a relationship, or fixing a slow query.
paths:
  - "database/migrations/**/*.php"
  - "app/Models/**/*.php"
---

Apply these rules to all database work in this task.

## Schema changes
- Change the schema only through migrations made with php artisan make:migration. Never change a table by hand.
- Give every up method a down method that reverses it.
- Never edit a migration that has run anywhere except your own machine. Add a new migration instead.
- Add foreign key constraints for relationships.

## Queries
- Eager load relationships used in a loop, to avoid N + 1 queries.
- Wrap writes that must succeed or fail together in DB::transaction.
- Add an index only where a query needs it. Indexes add overhead to every write.
- On PostgreSQL, ask me before adding an index to a large production table. A standard index build locks out writes; CREATE INDEX CONCURRENTLY does not.
- Use bindings for every value. Follow the laravel-security skill for raw SQL.

## Safety
- Never run migrate:fresh, migrate:refresh, migrate:reset, or db:wipe, and never add --force, without asking me first.
- Before running new migrations, show the SQL with php artisan migrate --pretend.

## Checks
- Run the test suite after every schema change, and report the result.
```

### `.claude/skills/new-migration/SKILL.md`

```markdown
---
name: new-migration
description: Create a Laravel migration for a schema change and show its SQL without running it.
disable-model-invocation: true
argument-hint: "[change]"
allowed-tools: Bash(php artisan make:migration *) Bash(php artisan migrate --pretend)
---

Create a migration for this change: $ARGUMENTS

1. Read the related models and the latest migrations for the table.
2. Run php artisan make:migration with a descriptive snake_case name.
3. Write the up method, and a down method that reverses it. Follow the database-conventions skill.
4. Run php artisan migrate --pretend and show me the SQL.
5. Stop. Do not run the migration. I run it myself after reading the SQL.
```

### Starter template: `skill-template.md`

```markdown
---
name: [skill-name]
description: [What it does and when to use it. Main use case first.]
when_to_use: [Trigger phrases or example requests.]
# Reference content only matters for some files? Add:
# paths:
#   - "[glob pattern]"
# A task with side effects, or one you want to time yourself? Add:
# disable-model-invocation: true
---

Apply these rules to all [area] work in this task.

## [Rule group]
- [One rule per line. Say what to do, not why.]

## Checks
- [Run the tests after every change, and report the result.]

For [detail], see [reference.md](reference.md).
```

Folders:
```text
.claude/skills/
├── database-conventions/
│   └── SKILL.md
└── new-migration/
    └── SKILL.md
```

What you type (no output shown):
```text
/new-migration add a shipped_at timestamp to orders
```

---

## Production notes
- Spoken word count is about 1,670 words, roughly 11 to 12 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. Both skills and the template are written for the course; the orders table and `shipped_at` column are illustrative. No Claude output is shown.
- The agenda says three parts and the script has three parts (three dividers).
- "Never edit a migration that has already run elsewhere" is presented as standard practice, not as a quote from the Laravel docs.
- Claude Code facts (skills page): when to create a skill (repeated pasting; CLAUDE.md section grown into a procedure); task vs reference content; `paths`; `disable-model-invocation: true` (Claude can't load it; description not in context); `argument-hint`; `$ARGUMENTS`; `allowed-tools` grants for the invoking turn only and does not restrict other tools; personal vs project locations; keep the body concise, content stays in context; standing instructions; SKILL.md under 500 lines, supporting files; evaluate separately whether it triggers and whether output improves; baseline in fresh sessions with `skillOverrides` "off"; "What skills are available?"; skill-creator plugin; live change detection for SKILL.md edits; `/skill-doctor` (v2.1.252+); must-hold rules go in a hook. Permissions page: deny rules block matching Bash commands.
- Laravel facts: migrations are like version control for your database; `make:migration`; up and down, down should reverse up; destructive operations may lose data, `--force`; `migrate --pretend` shows SQL without running; `migrate:refresh` re-creates the database (/migrations). Foreign key constraints force referential integrity (/migrations). Eager loading alleviates N + 1 (/eloquent-relationships). `DB::transaction` rolls back on exception (/database).
- PostgreSQL facts: indexes add overhead, use sensibly (/indexes.html); standard index build locks out writes, CONCURRENTLY does not (/sql-createindex.html).
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Claude Code Database Skills and a Recipe for Writing Your Own | Agentic Engineering Ep 19
2. A Reference Skill and a Task Skill for Laravel Migrations | Claude Code Skills Ep 19
3. How to Write Your Own Claude Code Skill: a Six-Step Recipe | Agentic Engineering Ep 19

### Description
```
Episode 19 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we finish the skills module. We write two database skills that work as a pair: database-conventions, a reference skill loaded by paths for migrations and models (migrations only, a down for every up, foreign keys, eager loading, transactions, sensible indexes, no destructive commands without asking), and new-migration, a manual task skill with a narrow allowed-tools grant that stops at the migrate --pretend SQL. Then a six-step recipe for writing any skill of your own: spot the signal, pick the type, choose the place, write the frontmatter, write the body, and test it with a baseline.

Note: screens are drawn illustrations. Both skills and the starter template are written for the course; the rules come from laravel.com/docs and postgresql.org/docs.

Full text of the skills and the template:

[paste both SKILL.md files and skill-template.md from the script here; none contains angle brackets]

Next in the playlist: Episode 20 · Hooks.
```

### Tags
Claude Code, Claude Code skills, SKILL.md, write your own skill, Laravel migrations, database migrations, PostgreSQL, N+1 queries, database transactions, AI coding agents, agentic engineering

### Thumbnail text idea
"YOUR OWN SKILL" in coral, with a small database cylinder icon and "SKILL.md".

---

## Suggested slide list (Episode 19 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 19 · Database Skills and Writing Your Own |
| 2 | Agenda | Three parts: Reference skill · Task skill · Your own |
| 3 | 01 · A database reference skill | Divider |
| 4 | Why the database | Shared · Hard to undo · Easy to forget |
| 5 | Four rule groups | Schema changes · Queries · Safety · Checks |
| 6 | Two project skills | Folder tree (Illustration) |
| 7 | Schema changes | Skill section (Illustration) |
| 8 | Queries and safety | Skill sections (Illustration) |
| 9 | 02 · A migration task skill | Divider |
| 10 | The frontmatter | new-migration frontmatter (Illustration) |
| 11 | What /new-migration does | Read → make:migration → up and down → --pretend → Stop |
| 12 | Starting it | Typed prompt only (Illustration) |
| 13 | Two skills, one change | Task starts · paths adds rules · You run it |
| 14 | 03 · Writing your own | Divider |
| 15 | Steps one and two | Signal vs Type |
| 16 | Steps three to six | Place · Frontmatter · Body · Test |
| 17 | A starter template | skill-template.md (Illustration) |
| 18 | Step six: test it | Trigger check · Baseline (Illustration) |
| 19 | When it's not a skill | CLAUDE.md · Hook · Just ask |
| 20 | Quote | Reference shapes, task does, decide first |
| 21 | Recap | Two database skills · six-step recipe |
| 22 | Next | Episode 20 · Hooks |

---

## Sources
- Skills: https://code.claude.com/docs/en/skills (getting started; types of skill content; frontmatter reference; control who invokes a skill; skill content lifecycle; pre-approve tools; pass arguments; add supporting files; evaluate and iterate; find unused skills; edit a skill during a session; troubleshooting).
- Permissions: https://code.claude.com/docs/en/permissions (deny rules).
- Laravel: https://laravel.com/docs/migrations · /eloquent-relationships · /database
- PostgreSQL: https://www.postgresql.org/docs/current/indexes.html · /sql-createindex.html
- Episode 18: /workspace/agentic-course/day19-ep18-script.md.
