# Day 24 · Episode 23: Spec-Driven Development and OpenSpec

**Series:** Agentic Engineering (free YouTube course) · Module 10
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 8:00
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 10 lessons):** Introduction, Installing OpenSpec

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The cart project's `openspec/config.yaml` and `openspec/specs/discounts/spec.md` are **written for this course** (full text under "Example files"). OpenSpec facts come only from the official repository (github.com/Fission-AI/OpenSpec: README, docs folder, and source, version 1.14.1) and openspec.dev. No Claude output and no OpenSpec output is shown: commands appear only as typed commands.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:20 | [VOICEOVER + SLIDE] | Hook |
| 0:20–0:45 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 0:45–2:45 | [VOICEOVER + SLIDE] | Part 1 · Spec-driven development |
| 2:45–5:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Installing OpenSpec |
| 5:00–7:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · The change workflow |
| 7:30–8:15 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:20 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we gave Claude a browser with Playwright M C P, and used it to check a change in the cart.
> Today we step back to the start of every change: the plan. We've written plans before. This time, we keep them.

**Visual / B-roll:**
- Episode 22 recap panel, then the title card.

### 0:20–0:45 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-three: spec-driven development and Open Spec.

*Cue: agenda slide "Three parts"*
> Three parts. First, what spec-driven development is, and how it grows out of what we've already done. Second, installing Open Spec in the cart project. Third, the change workflow: the files it writes and the commands that move a change along. Everything on screen is an illustration, and the facts come from Open Spec's official repository.

**Visual / B-roll:**
- Three items: 01 Spec-driven · 02 Installing · 03 The workflow.

### 0:45–2:45 · Part 1: Spec-driven development
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "01 · Spec-driven"*
> Part one. Spec-driven development.

*Cue: two columns "Chat only vs spec first"*
> The Open Spec readme names the problem in one line: A I coding assistants are powerful but unpredictable when requirements live only in chat history.
> The answer is a written spec. You and the agent agree on what to build before any code is written, and that agreement lives in files in your repository, not in a conversation that ends.

*Cue: squares "You've done this already"*
> This isn't new to you. In episode seven, the loop was explore, plan, implement, verify, commit, and we saved the plan to PLAN dot M D.
> In episode sixteen, the grill me skill interviewed us and wrote SPEC dot M D, and then we started a fresh session to build it.
> Open Spec takes the same idea one step further. The spec doesn't get thrown away after the build. It becomes the record of how the system behaves.

*Cue: panel "The OpenSpec idea"*
> Its philosophy, from the readme: fluid, not rigid. Iterative, not waterfall. Easy, not complex. And built for brownfield, not just greenfield, which means existing projects like our cart.
> In practice, each change gets its own folder, and you can update any file in it at any time. There are no rigid phase gates.

*Cue: two points "Two places to type"*
> One thing trips people up, and the docs call it the most common early stumble. There are two places to type.
> Commands that start with open spec run in your terminal. Commands that start with slash O P S X run in the Claude Code chat, like any other slash command.

**Visual / B-roll:**
- Two columns: chat history vs files in the repo.
- Squares: Ep 7 PLAN.md · Ep 16 SPEC.md · OpenSpec specs.
- Panel: fluid · iterative · brownfield.
- Two points + Illustration: terminal vs chat.

### 2:45–5:00 · Part 2: Installing OpenSpec
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Installing"*
> Part two. Installing Open Spec.

*Cue: drawn terminal "Install and init"*
> Open Spec needs Node version twenty point one nine or higher. Install it globally with N P M: npm install, dash g, at fission dash A I slash openspec, at latest. On mac O S or Linux, there's also a Homebrew formula.
> Then, in the project folder, run open spec init. It asks which tools to set up. To pick Claude Code directly, pass dash dash tools claude.
> Later, after you upgrade, run open spec update in each project to refresh the commands.
> One note from the readme: Open Spec collects anonymous usage stats, only command names and version. You can turn that off with the open spec telemetry environment variable set to zero.

*Cue: four numbered "What init creates"*
> Init creates a folder called open spec, with four things in it.
> Specs: the source of truth, describing how your system behaves today, organized by area.
> Changes: one folder per proposed change.
> Archive, inside changes: where finished changes go.
> And config dot yaml, for project settings.

*Cue: phone "What Claude Code gets"*
> For Claude Code, init also writes into the dot claude folder. With the default profile, that's six skills in the skills folder, each named open spec dash something, and six slash commands in a folder called O P S X.
> These are the same kinds of skills we built in earlier episodes. Open Spec just ships its own.

*Cue: flow "The core commands"*
> The default profile is called core, and here are its commands in order.
> Explore, which is optional: a thinking partner that reads your code before you commit to anything. Propose, which creates the change and writes the plan. Apply, which builds it. Sync, which merges the change's specs into the main specs. And archive, which files the change away.
> There's also update, which revises a change's planning files and never edits code. More commands, like verify, come with the expanded profile, through open spec config profile.

*Cue: card "config.yaml for the cart"*
> Here's the cart's config dot yaml, written for this course. The schema line says spec-driven, the default.
> Context describes the project: Node, where the discount code lives, and how tests run. The docs say context is added to every file Open Spec generates.
> Rules apply to one kind of file. Ours ask the proposal to state what's out of scope, the specs to cover edge cases, and the tasks to include running N P M test. That's the grill me checklist, now built into every plan.

**Visual / B-roll:**
- Monitor + Illustration: typed commands only.
- Four numbered: specs · changes · archive · config.yaml.
- Phone + Illustration: .claude/skills and .claude/commands/opsx.
- Flow: explore → propose → apply → sync → archive.
- Card + Illustration: config.yaml.

### 5:00–7:30 · Part 3: The change workflow
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · The workflow"*
> Part three. The change workflow.

*Cue: four numbered "Four artifacts"*
> When you run slash O P S X propose with a short change name, Open Spec creates a folder for the change and up to four artifacts in it.
> The proposal: the why and the what, including scope.
> Specs: the requirements that change, with scenarios.
> The design: the how. The schema says to write it only when it's needed, like a change across modules, a new dependency, or real ambiguity.
> And tasks: an implementation checklist with checkboxes. The proposal comes first, and tasks come last, after the specs and the design.

*Cue: plan "Delta specs"*
> The docs call delta specs the key concept. A change doesn't rewrite the whole spec. It says what's different, in sections: added requirements, modified requirements, and removed requirements.
> When you archive the change, added ones are appended to the main spec, modified ones replace the old version, and removed ones are deleted.

*Cue: two points "Requirement and scenario"*
> Inside a spec, the format is plain markdown. A requirement states behavior with the word shall or must, and strict validation checks for those words.
> Each requirement has scenarios, written as when this happens, then that happens.
> To get the cart started, I wrote a first main spec for its discounts, describing what it already does: save ten, totals never below zero, and the expiry day rule from episode seven. It's printed in full in the description, and it passes open spec validate in strict mode.

*Cue: drawn terminal "Check from the terminal"*
> The terminal commands let you check things at any point. Open spec list shows active changes. Show displays one. Validate checks the format. And view opens an interactive dashboard.
> On screen are only the commands. No output is shown.

*Cue: panel "Archive"*
> And archive closes the loop. It checks the tasks and warns if any are unfinished. It offers to sync the specs if you haven't. Then it moves the change folder into the archive, with the date in its name, so you keep the history.
> The readme gives one more tip that we already know from episode sixteen: clear your context before you start implementing.

**Visual / B-roll:**
- Four numbered: proposal · specs · design · tasks.
- Plan + Illustration: ADDED, MODIFIED, REMOVED.
- Two points + Illustration: SHALL, WHEN, THEN.
- Monitor + Illustration: typed CLI commands only.
- Panel: archive steps.

### 7:30–8:15 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The line to remember, from the Open Spec readme: agree on what to build before any code is written.

*Cue: recap slide*
> Recap. Spec-driven development keeps requirements in files, not chat history, and it grows straight out of our plan and grill me episodes. Install Open Spec with N P M, run open spec init with tools claude, and you get a specs folder, a changes folder, a config file, and six commands in Claude Code. Each change gets a proposal, delta specs, an optional design, and tasks. And explore, propose, apply, and archive move it from idea to record.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-four: building a new feature from a spec. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 24 · Building a New Feature from a Spec".

---

## Example files (written for the course)

All blocks are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. Note: OpenSpec's own docs and generated templates use angle-bracket placeholders (for example in folder layouts); these course files don't.

### Commands (typed in your terminal; no output shown)

```text
npm install -g @fission-ai/openspec@latest
cd cart
openspec init --tools claude
openspec list
openspec show discounts --type spec
openspec validate discounts --type spec --strict
openspec view
openspec update
```

Optional, to turn off OpenSpec's anonymous usage stats (from the README):

```text
export OPENSPEC_TELEMETRY=0
```

Slash commands (typed in the Claude Code chat):

```text
/opsx:explore
/opsx:propose add-a-change-name
/opsx:apply
/opsx:archive
```

### `openspec/config.yaml` (cart project, committed)

```yaml
schema: spec-driven

context: |
  Small Node.js cart project. Discount logic lives in src/discounts.js, cart totals in src/cart.js.
  Tests use node --test and run with npm test.
  No new dependencies without asking first.

rules:
  proposal:
    - Always state what is out of scope
  specs:
    - Every requirement needs at least one scenario
    - Cover the edge cases, like totals near zero and dates on the boundary
  tasks:
    - Include a task to run npm test

operations:
  apply:
    guidance:
      - Run npm test after each task group
```

### `openspec/specs/discounts/spec.md` (cart project, first main spec)

```markdown
# discounts Specification

## Purpose
Describe how discount codes change the cart total in the cart project, including the SAVE10 code and code expiry dates.

## Requirements

### Requirement: SAVE10 discount
The cart SHALL take 10 percent off the cart total when the code SAVE10 is applied.

#### Scenario: Code applied to a normal cart
- **WHEN** the cart total is 50.00 and the user applies SAVE10
- **THEN** the total becomes 45.00

### Requirement: Total never below zero
The cart total MUST never go below 0 after discounts are applied.

#### Scenario: Discount larger than the total
- **WHEN** a discount would reduce the total below 0
- **THEN** the total is 0

### Requirement: Expiry dates
A discount code with an expiry date SHALL apply up to and including its expiry day, and SHALL be rejected after it.

#### Scenario: Code used on its expiry day
- **WHEN** the user applies a code on its expiry day
- **THEN** the discount applies

#### Scenario: Code used after its expiry day
- **WHEN** the user applies a code the day after its expiry day
- **THEN** the code is rejected and the total is unchanged
```

---

## Production notes
- Spoken word count is about 1,218 words, roughly 8 to 8.5 minutes (plan target about 8) at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. No Claude output and no OpenSpec output is shown.
- The agenda says three parts and the script has three parts (three dividers).
- Spoken episode numbers: "episode twenty-three" (this one), "episode seven", "episode sixteen", "episode twenty-four" (next).
- Verified against OpenSpec 1.14.1 (latest release, published 6 Oct 2026): package `@fission-ai/openspec`, Node `>=20.19.0` in package.json; `openspec init --tools claude` (init options in src/cli/index.ts); default delivery `both`; core profile `propose, explore, apply, update, sync, archive` (src/core/profiles.ts); with the core profile, init for Claude Code writes six skills in `.claude/skills/openspec-*/SKILL.md` and six commands in `.claude/commands/opsx/` (checked by running init in a scratch folder, not shown); init creates `openspec/specs`, `openspec/changes`, `openspec/changes/archive` and `openspec/config.yaml`. Schema `spec-driven`: proposal (requires nothing), specs and design (require proposal), tasks (require specs and design); design "create only if" cross-cutting, new dependency, security/performance/migration complexity, or ambiguity. The validator checks for SHALL or MUST. The course `discounts` spec passes `openspec validate --strict`, and the course `config.yaml` context and rules are picked up by `openspec instructions proposal` (checked in a scratch folder).
- Docs facts: README (problem statement, philosophy, Quick Start, Homebrew formula, `openspec update`, telemetry and opt-out, context hygiene), docs/getting-started.md (terminal vs chat, "the most common early stumble", folder layout, artifacts, delta specs and what happens on archive, CLI list/show/validate/view), docs/commands.md (each slash command; `/opsx:update` never edits code; archive warns on incomplete tasks, offers to sync, moves to `archive/YYYY-MM-DD-name/`), docs/customization.md (config.yaml: context in all artifacts, rules only for the matching artifact), docs/supported-tools.md (Claude Code paths, `--tools`).
- Course tie-backs: Episode 7 (the loop and PLAN.md), Episode 16 (grill me writes SPEC.md, then a fresh session). The discount behaviors in the course spec match earlier episodes (SAVE10, never below 0, expiry day still applies).
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Spec-Driven Development with OpenSpec and Claude Code | Agentic Engineering Ep 23
2. OpenSpec Explained: Install, Init, Proposals, Delta Specs, Archive | Ep 23
3. Stop Losing Your Plans in Chat: Spec-Driven Development with OpenSpec | Agentic Engineering Ep 23

### Description
```
Episode 23 of Agentic Engineering, a free course on building real software with AI coding agents.

Spec-driven development keeps requirements in files instead of chat history. We connect it to the planning and grill-me episodes, then install OpenSpec in the cart project with npm and openspec init --tools claude, look at what init creates (specs, changes, archive, config.yaml, and six Claude Code skills and commands), and walk the change workflow: proposal, delta specs, design, tasks, and the explore, propose, apply, sync and archive commands.

Note: screens are drawn illustrations; no Claude or OpenSpec output is shown. The config.yaml and discounts spec are written for the course; facts come from the official OpenSpec repository (version 1.14.1).

Example files:

[paste the commands, config.yaml and spec.md from the script here; none contain angle brackets]

Next in the playlist: Episode 24 · Building a New Feature from a Spec.
```

### Tags
Claude Code, OpenSpec, spec-driven development, specs, AI coding agents, agentic engineering, delta specs, opsx, planning, requirements, software design

### Thumbnail text idea
"PLANS END. SPECS STAY." in coral, with a drawn folder icon.

---

## Suggested slide list (Episode 23 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 23 · Spec-Driven Development and OpenSpec |
| 2 | Agenda | Three parts: Spec-driven · Installing · The workflow |
| 3 | 01 · Spec-driven | Divider |
| 4 | Chat only vs spec first | Problem statement |
| 5 | You've done this already | Ep 7 · Ep 16 · OpenSpec |
| 6 | The OpenSpec idea | Philosophy |
| 7 | Two places to type | Terminal vs chat (Illustration) |
| 8 | 02 · Installing | Divider |
| 9 | Install and init | Typed commands (Illustration) |
| 10 | What init creates | specs · changes · archive · config.yaml |
| 11 | What Claude Code gets | Skills and commands (Illustration) |
| 12 | The core commands | explore → propose → apply → sync → archive |
| 13 | config.yaml for the cart | (Illustration) |
| 14 | 03 · The workflow | Divider |
| 15 | Four artifacts | proposal · specs · design · tasks |
| 16 | Delta specs | ADDED · MODIFIED · REMOVED (Illustration) |
| 17 | Requirement and scenario | SHALL · WHEN · THEN (Illustration) |
| 18 | Check from the terminal | CLI commands (Illustration) |
| 19 | Archive | Warn, sync, move |
| 20 | Quote | Agree before any code |
| 21 | Recap | Why · install · artifacts · commands |
| 22 | Next | Episode 24 · Building a New Feature from a Spec |

---

## Sources
- OpenSpec README: https://github.com/Fission-AI/OpenSpec · site: https://openspec.dev
- Docs: docs/getting-started.md, docs/commands.md, docs/customization.md, docs/supported-tools.md, docs/installation.md (all in the repository)
- Source checked: package.json, src/cli/index.ts, src/core/profiles.ts, src/core/global-config.ts, schemas/spec-driven/schema.yaml, src/core/validation/constants.ts (release v1.14.1)
- Course: Episode 7 (/workspace/agentic-course/day08-ep07-script.md), Episode 16 (day17-ep16-script.md), Episode 22 (day23-ep22-script.md).
