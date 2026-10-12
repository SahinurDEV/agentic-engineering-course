# Day 12 · Episode 11: Generating and Maintaining CLAUDE.md

**Series:** Agentic Engineering (free YouTube course) · Week 2
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 10:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 5 lessons):** (1) Generating a CLAUDE.md · (2) Maintaining CLAUDE.md

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. Every terminal or file view in this episode is a **drawn graphic** labelled "Illustration", not a screen recording. The "generated draft" shown in Part 1 is an **example written for this course** to show the kind of thing to review; it is not real `/init` output, and real output will differ.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:25–0:55 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 0:55–3:45 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Generate a starter with /init, review it, add real rules | Lesson 1 |
| 3:45–6:45 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Keep it true: add rules, /memory, prune, review in git | Lesson 2 |
| 6:45–9:15 | [VOICEOVER + SLIDE] | Part 3 · Bigger projects, personal notes, maintenance checklist | Lesson 2 |
| 9:15–10:00 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we took apart a CLAUDE dot M D: what belongs in it, what stays out, and how to review one line by line.
> Today, two practical questions. How do you get a good first version without writing it from scratch? And how do you stop it going stale, a month from now, when the project has moved on?

**Visual / B-roll:**
- Episode 10 "Tighten it" card, then the title card.

### 0:25–0:55 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode eleven: generating and maintaining CLAUDE dot M D.

*Cue: agenda slide*
> Four parts. Generating a starter. Trimming it and adding your real rules. Keeping it true over time. And scaling it up for bigger projects and personal preferences. As always, the screens are illustrations, not recordings.

**Visual / B-roll:**
- Agenda: 01 Generate · 02 Trim and add · 03 Keep it true · 04 Scale it.

### 0:55–3:45 · Part 1: Generate a starter
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Generate a starter"*
> Part one. Generate a starter.

*Cue: slide "Start with /init"*
> In the first session in a repo, run slash init. The docs describe what it does: Claude analyzes your codebase and creates a CLAUDE dot M D with the build commands, test instructions, and project conventions it discovers.
> If a CLAUDE dot M D already exists, slash init doesn't overwrite it. It suggests improvements instead. So it's safe to run on a project that already has one.
> That makes it useful twice: once on day one, and again later as a second opinion on a file that has drifted. Either way, you read what it suggests before you accept it.
> The docs' suggested next step is slash memory, to open the file and refine it.

*Cue: slide "Guided /init"*
> There's also a more guided version. Set the environment variable CLAUDE underscore CODE underscore NEW underscore INIT to one before you run slash init.
> With that set, slash init asks which things to set up: CLAUDE dot M D files, skills, and hooks. It explores the codebase with a subagent, asks you follow-up questions to fill gaps, and shows you a proposal to review before it writes any files.
> For a team project, that review step is worth a lot. Nothing lands until you've read it.

*Cue: drawn generated draft*
> Whichever way you run it, treat the result as a draft. Here's an example of the kind of draft you might review for the cart project. I wrote this one for the course, so don't expect your output to match it.
> It lists the files in source and what each one does. It says the project uses Node and N P M. It says to follow the existing code style. And it says to run tests with N P M test.
> Apply last episode's question to every line: would removing this cause Claude to make mistakes? The test command stays. The file tour goes, because Claude can read the code. "Uses Node and N P M" goes too: Claude can see that from package dot json. And "follow the existing code style" is too vague to check. Make it specific, or cut it.
> Then check the commands are real. A generator can only write down what it can see. If the project lints with N P M run lint, but that script lives somewhere it didn't look, the draft won't mention it. Run each command in the file once yourself, and fix any that don't work. A wrong command in CLAUDE dot M D sends Claude down the wrong path in every session.

*Cue: slide "Add the team's real rules"*
> Then add what a generator can't know. The docs say it directly: refine from there with instructions Claude wouldn't discover on its own.
> For the cart project, that's the gotchas and decisions that live in people's heads. Prices are integer cents, never floats. Discount dates compare in the store's timezone. Plan multi-file changes in PLAN dot M D first. Run N P M test before every commit.
> Short, specific, and each one is a mistake you'd otherwise correct by hand.

**Visual / B-roll:**
- Two points + Illustration terminal: slash init.
- Card: CLAUDE_CODE_NEW_INIT=1 flow, with a review-before-write step.
- Card + Illustration: example draft, labelled "Example, written for the course".
- Black panel: three real rules added.

### 3:45–6:45 · Part 2: Keep it true
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "02 · Keep it true"*
> Part two. Keeping it true.

*Cue: slide "When to update it"*
> A CLAUDE dot M D isn't finished when you write it. The docs list the moments to add to it: when Claude makes the same mistake a second time, when a code review catches something Claude should have known, when you type the same correction you typed last session, and when a new teammate would need the same context.
> So the loop is simple. A mistake repeats. You add a rule. The change gets reviewed. You watch whether Claude's behaviour actually shifts. And now and then, you prune.
> On the cart project, here's what that looks like. Say that in two different sessions I have to remind Claude that discount dates compare in the store's timezone. The same reminder twice is the signal. So that line goes into CLAUDE dot M D, and the reminder never needs typing again.

*Cue: slide "Adding a rule"*
> Two ways to add a rule. Ask Claude directly: add this to CLAUDE dot M D, followed by the rule. Or run slash memory, pick the file, and edit it in your editor yourself.
> One detail from the docs that catches people out. If you say "remember this", Claude saves it to auto memory, not to CLAUDE dot M D. Auto memory is useful, but it's not the shared team file. If the rule is for the whole team, say CLAUDE dot M D explicitly.

*Cue: slide "Prune stale lines"*
> Rules pile up, and some go stale: a file that moved, a version that changed, two instructions that contradict each other. The docs warn that when two instructions conflict, Claude may pick one arbitrarily.
> Claude Code can help you find these. On recent versions, slash doctor proposes trims for a checked-in CLAUDE dot M D, cutting things Claude can derive from the codebase. And slash doctor prompt audit looks for outdated or conflicting instructions and references to files or commands that don't exist. Nothing changes until you ask it to apply the edits.

*Cue: drawn git diff of CLAUDE.md*
> And check the file into git. The docs recommend it so the team can contribute, and the file compounds in value over time.
> That also means changes to it get reviewed like code. A pull request that changes CLAUDE dot M D changes how the agent behaves for everyone, so it deserves the same review as a change to the code itself. Here, one stale line comes out and the timezone rule goes in, and both changes are visible in the diff.

**Visual / B-roll:**
- Five-box loop: Mistake → Add rule → Review → Watch → Prune.
- Two points + Illustration terminal: "add to CLAUDE.md" prompt, slash memory.
- Two columns: Signs of stale vs Tools to find it; card "Wrong is worse than none".
- Illustration: git diff of CLAUDE.md.

### 6:45–9:15 · Part 3: Bigger projects and personal notes
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "03 · Scale it"*
> Part three. Scaling it up.

*Cue: slide "Organize as it grows"*
> As a project grows, one file stops being enough, and the docs give you four tools.
> One: a CLAUDE dot M D in a subfolder. It loads on demand, only when Claude works with files in that folder, so it doesn't cost context in every session.
> Two: the dot claude slash rules folder. One markdown file per topic, and rules can be scoped to file paths, so they only load when Claude works with matching files.
> Three: in a large monorepo, the claude M D excludes setting lets you skip other teams' CLAUDE dot M D files that aren't relevant to you.
> Four: imports with the at sign, to organize. Remember, they don't save context.

*Cue: slide "Personal preferences"*
> And keep your personal preferences out of the team file. Preferences for all your projects go in your user file, in your home folder under dot claude. Notes for just this project, like your sandbox URL or test data, go in CLAUDE dot local dot M D at the project root. Add it to dot gitignore so it isn't committed.
> One gotcha from the docs: if you use git worktrees, a gitignored local file only exists in the worktree where you created it. To share personal notes across worktrees, import a file from your home folder instead.
> A simple test for where a line belongs: would a new teammate need it? If yes, it goes in the project file. If it's only true for you, it goes in your local or user file.

*Cue: slide "Maintenance checklist"*
> Here's the maintenance checklist I use. One: a mistake happened twice? Add a rule. Two: every line passes the "would removing this cause mistakes" test. Three: changes to the file are reviewed in pull requests. Four: prune regularly, looking for stale, conflicting, or vague lines, with slash doctor to help.

**Visual / B-roll:**
- Four numbered items: Subfolder CLAUDE.md · .claude/rules/ · claudeMdExcludes · @imports.
- Black panel: Just you → CLAUDE.local.md · All projects → ~/.claude/CLAUDE.md · Worktrees → import from home.
- Four-item checklist.

### 9:15–10:00 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model, from Anthropic's guide: treat CLAUDE dot M D like code. Review it when things go wrong, and prune it regularly.

*Cue: recap slide*
> Recap. Generate a starter with slash init, then trim it and add the rules only your team knows. Keep it true: add a rule when a mistake repeats, edit with slash memory, prune stale lines, and review changes in git. And as the project grows, use subfolder files and rules, and keep personal notes in your local or user file.

*Cue: next-episode slide*
> Next in the playlist is episode twelve: what subagents are, and when to use them. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 12 · What Subagents Are and When to Use Them".

---

## Production notes
- Spoken word count is about 1,430 words, roughly 10 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic labelled "Illustration". The generated draft is written for the course; it is not real `/init` output.
- The "#" quick-memory shortcut is not described in the current memory, commands or interactive-mode docs, so the episode uses the confirmed routes instead: asking Claude "add this to CLAUDE.md" and editing via `/memory`.
- `/doctor` trims require Claude Code v2.1.206 or later; `/doctor prompt-audit` requires v2.1.283 or later. The narration says "on recent versions".
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Generating and Maintaining CLAUDE.md: /init, /memory and Keeping It True | Agentic Engineering Ep 11
2. Don't Let Your CLAUDE.md Go Stale: A Maintenance Workflow | Agentic Engineering Ep 11
3. /init Is a Draft: How to Build and Maintain CLAUDE.md | Ep 11

### Description
```
Episode 11 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode: generating a starter CLAUDE.md with /init (and the interactive CLAUDE_CODE_NEW_INIT flow); reviewing and trimming the draft; adding the team's real rules; then maintaining it: when to update, adding rules by asking Claude or editing with /memory, why "remember this" goes to auto memory, pruning stale and conflicting lines with /doctor, checking it into git and reviewing changes like code; subfolder CLAUDE.md files, .claude/rules/ and claudeMdExcludes for bigger repos; CLAUDE.local.md and user-level preferences; and a maintenance checklist. Continues the cart project from earlier episodes.

Note: screens are drawn illustrations, and the generated draft is an example written for the course.

Chapters:
0:00 A good first version, and keeping it true
0:25 Intro and what we'll cover
0:55 Generate a starter with /init
3:45 Keep it true: add, edit, prune, review
6:45 Bigger projects and personal notes
9:15 Recap and next episode

Official docs:
Memory (CLAUDE.md): https://code.claude.com/docs/en/memory
Commands: https://code.claude.com/docs/en/commands
Best practices: https://code.claude.com/docs/en/best-practices

Next in the playlist: Ep 12 · What Subagents Are and When to Use Them

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude.md, claude code init, /init, claude code memory, /memory, claude.local.md, claude rules folder, claude code doctor, ai coding agent setup, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"/init IS A DRAFT"**, small line: **"generate · trim · maintain"**.
Visual: a CLAUDE.md card with a git diff strip below it. "EP 11" badge.

---

## Suggested slide list (Episode 11 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Generating and Maintaining CLAUDE.md | Agentic Engineering · Episode 11 |
| 2 | Four parts | 01 Generate · 02 Trim and add · 03 Keep it true · 04 Scale it |
| 3 | 01 · Generate a starter | /init is a draft |
| 4 | Start with /init | Analyzes the codebase; suggests improvements if a file exists |
| 5 | Guided /init | CLAUDE_CODE_NEW_INIT=1; proposal before writing |
| 6 | Review the draft | Example draft; keep, cut, make specific |
| 7 | Add the real rules | What Claude wouldn't discover on its own |
| 8 | 02 · Keep it true | Update, prune, review |
| 9 | When to update it | Mistake → Add rule → Review → Watch → Prune |
| 10 | Adding a rule | "add this to CLAUDE.md" or /memory |
| 11 | Prune stale lines | Stale signs; /doctor and prompt-audit |
| 12 | Checked into git | Review CLAUDE.md changes like code |
| 13 | 03 · Scale it | Bigger projects, personal notes |
| 14 | Organize as it grows | Subfolder · rules · excludes · imports |
| 15 | Personal preferences | CLAUDE.local.md · user file · worktrees |
| 16 | Maintenance checklist | Twice? · Every line · PRs · Prune |
| 17 | Quote | Treat CLAUDE.md like code |
| 18 | Recap | Generate · Keep true · Scale |
| 19 | Next | Episode 12 · What Subagents Are and When to Use Them |

---

## Sources
- Memory: https://code.claude.com/docs/en/memory (`/init` analyzes the codebase and creates a file with build commands, test instructions and conventions; suggests improvements if CLAUDE.md exists; refine with instructions Claude wouldn't discover on its own; `CLAUDE_CODE_NEW_INIT=1` flow: asks which artifacts (CLAUDE.md files, skills, hooks), explores with a subagent, follow-up questions, reviewable proposal before writing; when to add to CLAUDE.md; conflicting instructions may be picked arbitrarily; `/doctor prompt-audit`; `/doctor` proposes trims; `/memory`; "remember" saves to auto memory, "add this to CLAUDE.md" to write the file; subfolder CLAUDE.md loads on demand; `.claude/rules/` and path-scoped rules; `claudeMdExcludes`; imports don't reduce context; `CLAUDE.local.md` in `.gitignore`; worktrees and home-directory imports).
- Commands: https://code.claude.com/docs/en/commands (first session in a repo: `/init` then `/memory`; `/init` and `CLAUDE_CODE_NEW_INIT`; `/doctor` incl. `prompt-audit`).
- Best practices: https://code.claude.com/docs/en/best-practices (treat CLAUDE.md like code: review it when things go wrong, prune it regularly; check it into git so your team can contribute; the file compounds in value over time).
- Episode 10 reference: /workspace/agentic-course/day11-ep10-script.md.
