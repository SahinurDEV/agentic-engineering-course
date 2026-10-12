# Day 5 · Episode 4: A Real Claude Code Session

**Series:** Agentic Engineering (free YouTube course) · Week 1: Foundations
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 8:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 2 lesson):** A Real Claude Session: one complete session, from an empty prompt to a commit

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. This episode is an **illustrated walkthrough**: every terminal view is a **drawn, animated terminal graphic** labelled "Illustration", not a screen recording. The lines on those screens are simplified examples of what a session like this looks like, not a transcript of real model output. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Step |
|---|---|---|---|
| 0:00–0:25 | [VOICEOVER + SCREEN] | Hook | n/a |
| 0:25–0:55 | [VOICEOVER + SLIDE] | Intro + the session map | n/a |
| 0:55–2:50 | [VOICEOVER + SCREEN] | 01 · Start and plan: project folder, plan mode, reviewing and tweaking the plan | Steps 1–3 |
| 2:50–4:50 | [VOICEOVER + SCREEN] | 02 · Edit and test: permission prompts, running tests, a failing test | Steps 4–6 |
| 4:50–6:40 | [VOICEOVER + SCREEN] | 03 · Review and commit: the diff, the commit, /clear or /compact | Steps 7–9 |
| 6:40–7:20 | [VOICEOVER + SLIDE] | Try it yourself: four tips | n/a |
| 7:20–8:00 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SCREEN]

**Say:**
> In episode three, we went through the controls one at a time: the permission modes, the slash commands, models and effort, and the keyboard shortcuts.
> Today, we put them together. One small feature, one complete session, from typing claude in a project folder to a clean commit, step by step.

**Visual / B-roll:**
- Drawn terminal graphic, fast montage of the steps: `claude` → status bar `plan mode on` → a plan → a permission prompt → test output with one red line, then green → `/diff` → a commit line. Freeze, cut to the title card.
- Corner tag on every drawn terminal: "Illustration".

---

### 0:25–0:55 · Intro + the session map
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: title slide*
> Welcome back to Agentic Engineering. I'm Sahinur Islam, a full-stack software engineer, and this is episode four: a real Claude Code session.

*Cue: session map slide*
> I want to be upfront about what this is. It's an illustrated walkthrough: here's what a session like this looks like, step by step, drawn out on screen. The exact words Claude uses will be different every time you run it. The shape of the session is what matters.
> The shape is this: start, plan, edit, test, and commit. And if a test fails, you loop back and fix it before you commit.

**Visual / B-roll:**
- Title slide: "A Real Claude Code Session", "Agentic Engineering · Episode 4", name card "Sahinur Islam".
- Session map: five boxes, Start → Plan → Edit → Test → Commit, with a loop arrow "Test fails? Fix and re-run".

---

### 0:55–2:50 · Part 1: Start and plan
**Marker:** [VOICEOVER + SCREEN] (drawn terminal graphics; opens with a [VOICEOVER + SLIDE] divider)

**Say:**

*Cue: divider "01 · Start and plan"*
> Part one. Start and plan.

*Cue: drawn terminal: cd into the project, git status, claude*
> The project is the little cart repo from episode one. There's a cart file, a discounts file with one discount code already in it, and tests that run with N P M test. The task: add a code called SAVE ten, for ten percent off. Totals can never go below zero, and we need tests.
> I go into the project folder, and before I start Claude, I check git status. I want a clean working tree, so that afterwards, every change in the diff is from this session. Then I type claude.
> For this walkthrough, I press Shift plus Tab until the status bar says manual mode, so we see every permission prompt along the way. Then one more press puts me in plan mode.

*Cue: plan-mode slide: the prompt and the plan-approval options*
> In plan mode, I write the task as a spec, not a vague wish: Add a discount code SAVE ten that takes ten percent off the cart total. Follow the pattern of the existing code in discounts dot J S. Totals must never go below zero. Add tests and run N P M test.
> Claude reads the project first. It finds the discounts file, sees how the existing code is structured, and looks at the tests. It doesn't edit anything. Then it presents a plan.

*Cue: slide "Review and tweak the plan"*
> This is the moment to slow down. A plan for this task would look something like: add SAVE ten to the discounts map, apply ten percent and keep the total at zero or above, add tests next to the existing ones, and run the suite.
> I read it like a teammate's proposal. And I notice one thing it doesn't say: totals are in cents, so how does ten percent of an odd amount get rounded? I want that decided now, not discovered later. So I press Control plus G, the plan opens in my text editor, and I add one line: round to whole cents, and add a test for an odd total.
> Then I approve the plan. Because I want to see each edit, I choose the option to approve edits manually, instead of handing it over to auto mode.

**Visual / B-roll:**
- Divider: big "01", "Start and plan".
- Monitor terminal graphic (Illustration): `$ cd ep01-cart`; `$ git status` → `nothing to commit, working tree clean`; `$ claude`; status bar `manual mode on` → `plan mode on`.
- Plan-mode slide: the spec prompt; the three plan-approval options with "Yes, manually approve edits" highlighted.
- Plan review slide: white card "Plan (illustration)": 1 Add SAVE10 to the discounts map · 2 Apply 10%, never below 0 · 3 Add tests · 4 Run npm test. Dark terminal: `Ctrl+G` and the added line `+ Round to whole cents; test an odd total`. Coral column "Tweak before you approve".

---

### 2:50–4:50 · Part 2: Edit and test
**Marker:** [VOICEOVER + SCREEN] (drawn terminal graphics; opens with a [VOICEOVER + SLIDE] divider)

**Say:**

*Cue: divider "02 · Edit and test"*
> Part two. Edit and test.

*Cue: drawn edit permission prompt*
> Now Claude starts working through the plan, and because I'm in manual mode, it stops before each edit. The prompt shows the file and the exact change: here, a new entry next to the existing code in discounts dot J S. I read it, and I say yes.
> If I trust the direction, I can choose the "don't ask again" option for edits. For file edits, that only lasts until the end of this session. And if something looks wrong, Escape says no, and I tell Claude what I want instead.

*Cue: slide "Running the tests"*
> Then it wants to run N P M test. Running a command is another prompt. This one is worth a closer look, because it offers "Yes, and don't ask again" for N P M test. For a shell command, that choice is saved as a rule for this repository, in a local settings file in the dot claude folder, so future sessions won't ask either. Test commands are a good candidate. You can see and edit those rules later with slash permissions.

*Cue: slide "When a test fails"*
> Now let's say one test fails. In a session like this, it's often an edge case: say, the rounding on an odd number of cents. That's not a disaster. That's the loop working.
> Claude reads the failure, looks at the code again, makes a fix, which is another edit I approve, and runs the tests again, until they pass.
> One thing I watch for here: the fix should go into the code, not into the test, unless the test itself is wrong. If Claude starts changing a test just to make it pass, I press Escape, and I redirect it: fix the code so the original test passes. And if the whole approach went sideways, Escape twice on an empty prompt opens the rewind menu, where I can restore the code and the conversation to an earlier prompt.

**Visual / B-roll:**
- Divider: big "02", "Edit and test".
- Tablet graphic (Illustration): a small diff in `src/discounts.js` (`+ SAVE10: …`) with a white popup: "Yes" (bold) · "Yes, don't ask again" · "No".
- "Running the tests" slide: two points (Yes once · Yes, and don't ask again for `npm test *`) and a terminal strip: `Bash command: npm test` · `Saved to .claude/settings.local.json` · `/permissions  review your rules`.
- "When a test fails" slide: black panel listing Fails → Read → Fix → Re-run → Pass; note "Fix the code, not the test. Esc to redirect."

---

### 4:50–6:40 · Part 3: Review and commit
**Marker:** [VOICEOVER + SCREEN] (drawn terminal graphics; opens with a [VOICEOVER + SLIDE] divider)

**Say:**

*Cue: divider "03 · Review and commit"*
> Part three. Review and commit.

*Cue: slide "Review the diff"*
> The tests pass, and Claude summarizes what it changed. I'm not done just because it says it's done. Now it's my turn: I read the diff.
> Slash diff shows the changes in my working tree, including the edits Claude made. Or I can run git diff myself with an exclamation mark in front, in shell mode.
> I check three things. Does SAVE ten follow the existing pattern? Is the never-below-zero rule really respected? And do the tests test the right thing, including the rounding case I asked for? If I want a second opinion, slash code review checks the current diff for bugs.

*Cue: slide "Commit it"*
> When I'm happy, I just ask: commit this with a descriptive message. Claude writes a message based on the changes, and since git commit is a shell command, I get one more permission prompt. I read the message, and approve.
> Remember, Claude's checkpoints help you undo things inside a session, but they're not a replacement for git. The commit is the real save point.

*Cue: slide "Between tasks"*
> Last step: what happens next. If my next task is unrelated, I run slash clear and start the new task with an empty context. The old conversation isn't gone; slash resume brings it back.
> If I'm continuing the same feature and the session has gotten long, slash compact summarizes it instead, and I can tell it what to keep, like: focus on the discount rules.
> And if I'm done for the day, I just exit. Later, I can run claude dash dash continue in the same folder to pick up the most recent conversation.

**Visual / B-roll:**
- Divider: big "03", "Review and commit".
- "Review the diff" slide: left column "Look at it" (`/diff` · `!git diff` · `/code-review`), right column "Check" (follows the pattern · never below 0 · tests test the right thing), coral card "Checkpoints are not git".
- "Commit it" slide: two points (Ask for a commit · Approve the git commit prompt) and a terminal strip: `> commit this with a descriptive message` · `Bash command: git commit …` · `1 commit, working tree clean`.
- "Between tasks" slide: three coral squares, `/clear` (new, unrelated task) · `/compact` (same task, long session) · `--continue` (pick up later).

---

### 6:40–7:20 · Try it yourself
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: slide "Try it yourself"*
> If you want to try this yourself, pick a small feature in a project that already has tests, and keep four things in mind.
> One: start from a clean git tree, so the diff is all Claude's work.
> Two: plan first, and write the task as a spec, with the constraints and the check it should run.
> Three: give it a way to verify its work. Tests are the easiest. Without them, you become the test suite.
> And four: read the diff before you commit. Every time.

**Visual / B-roll:**
- Four numbered columns: 01 Clean git tree · 02 Plan with a spec · 03 Give it a check · 04 Read the diff.

---

### 7:20–8:00 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: quote slide*
> Here's how I think about a session like this: Claude does the typing and the test running. I do the specifying, the reviewing, and the verifying.

*Cue: recap slide*
> Quick recap. Start in a clean project folder and plan first. Tweak the plan before you approve it. Let Claude edit and test, with prompts where you want them, and treat a failing test as the loop doing its job. Then read the diff, commit, and clear or compact before the next task.

*Cue: next-episode slide*
> You might have noticed how often context came up today: clearing, compacting, continuing. That's the next topic. Next in the playlist is episode five: context management basics. Subscribe and turn on notifications for the playlist so you don't miss it.

**Visual / B-roll:**
- Quote slide: "Claude does the typing and the test running. I do the specifying, reviewing, and verifying."
- Recap slide, three items: 01 Start and plan · 02 Edit and test · 03 Review and commit.
- End screen: "Next: Ep 5 · Context Management Basics", playlist tile, subscribe element.

---

## Production notes
- Spoken word count is about 1,300 words, roughly 8 minutes at a steady TTS pace with slide pauses.
- **Honesty rule for this episode:** there is no recording. Every terminal is a drawn graphic labelled "Illustration", and the narration says so in the intro. Don't add footage or captions that imply a real transcript. The plan text, prompt wording and test failure on screen are simplified examples; the narration frames the failing test as "let's say".
- Permission prompt wording on the slides is simplified. The option names used ("Yes, and don't ask again", "Yes, manually approve edits") follow the official docs; the exact layout of the real prompts can differ by version.
- "Don't ask again" behaviour differs by tool: for file edits it lasts until the session ends; for a shell command it is saved per repository in `.claude/settings.local.json` (per the permissions docs). Keep that distinction on screen.
- The walkthrough deliberately uses Manual mode to show the prompts; mention on screen that recent versions often start in Auto mode.
- Demo repo: the same small Node `ep01-cart` project from Episode 1 (`src/cart.js`, `src/discounts.js`, `test/*.test.js`, `npm test` = `node --test`).

---

## YouTube metadata

### Title options
1. A Real Claude Code Session, Step by Step: Plan, Edit, Test, Commit (Agentic Engineering Ep 4)
2. From Prompt to Commit: One Complete Claude Code Session | Agentic Engineering Ep 4
3. How I Run a Claude Code Session: Plan Mode, Permission Prompts, Failing Tests and the Diff | Ep 4

### Description
```
Episode 4 of Agentic Engineering, a free course on building real software with AI coding agents.

This is an illustrated, step-by-step walkthrough of one complete Claude Code session on a small Node.js cart project: adding a SAVE10 discount code (10% off, totals never below 0, with tests). It shows how the controls from Episodes 2 and 3 come together: starting in a clean project folder, getting a plan first in plan mode, tweaking the plan with Ctrl+G, approving edits and commands at the permission prompts, running the tests, handling a failing test, reviewing the diff with /diff, committing, and using /clear or /compact before the next task. Plus four tips to try it yourself.

Note: the terminal screens are drawn illustrations of what a session like this looks like, not a recording. Claude's exact output will differ every time.

Chapters:
0:00 From prompt to commit
0:25 Intro and the session map
0:55 Start and plan
2:50 Edit and test
4:50 Review and commit
6:40 Try it yourself
7:20 Recap and next episode

Official docs:
Best practices: https://code.claude.com/docs/en/best-practices
Permission modes: https://code.claude.com/docs/en/permission-modes
Permissions: https://code.claude.com/docs/en/permissions
Checkpointing: https://code.claude.com/docs/en/checkpointing
Commands: https://code.claude.com/docs/en/commands

Next in the playlist: Ep 5 · Context Management Basics

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, claude code tutorial, claude code session, claude code walkthrough, claude code plan mode, claude code permission prompt, claude code tests, claude code diff, claude code commit, claude code workflow, agentic coding, ai coding agent, ai pair programming, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"PROMPT → COMMIT"**, with a smaller line under it: **"one real session"**.
Visual: a dark terminal with a vertical row of five small steps (plan · edit · test · diff · commit), one red ✗ turning into a green ✓ on "test". Small "EP 4" badge and an "Illustrated walkthrough" corner tag.

---

## Suggested slide list (Episode 4 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | A Real Claude Code Session | Agentic Engineering · Episode 4 |
| 2 | Today | 01 Start and plan · 02 Edit and test · 03 Review and commit · 04 Try it yourself |
| 3 | The session map | Start → Plan → Edit → Test → Commit; test fails? fix and re-run |
| 4 | 01 · Start and plan | Clean tree, plan first |
| 5 | Start clean | git status, cd, claude; Shift+Tab to manual, then plan (Illustration) |
| 6 | Plan mode, with a spec | The SAVE10 spec prompt; approve with manual edits |
| 7 | Review and tweak the plan | Plan card; Ctrl+G adds the rounding rule; tweak before you approve |
| 8 | 02 · Edit and test | Prompts where you want them |
| 9 | Approve each edit | Edit prompt: Yes · don't ask again (this session) · No/Esc |
| 10 | Running the tests | npm test prompt; "don't ask again" saves a repo rule; /permissions |
| 11 | When a test fails | Fails → read → fix → re-run → pass; fix the code, not the test; Esc, Esc Esc |
| 12 | 03 · Review and commit | Your turn |
| 13 | Review the diff | /diff, !git diff, /code-review; three checks; checkpoints are not git |
| 14 | Commit it | Ask for a descriptive commit; approve git commit |
| 15 | Between tasks | /clear · /compact · claude --continue |
| 16 | Try it yourself | Clean tree · plan with a spec · give it a check · read the diff |
| 17 | The mental model | "Claude does the typing and the test running. I do the specifying, reviewing, and verifying." |
| 18 | Recap | Start and plan · Edit and test · Review and commit |
| 19 | Next: Context Management Basics | Episode 5 |

## Sources
- Best practices: https://code.claude.com/docs/en/best-practices (explore → plan → implement → commit workflow; plan mode via Shift+Tab or `--permission-mode plan`; Ctrl+G to edit the plan; give Claude a way to verify its work; "commit with a descriptive message"; Esc to stop and redirect; Esc Esc / `/rewind`; `/clear` between unrelated tasks; `/compact` with a focus; `claude --continue`; checkpoints are not a replacement for git).
- Permission modes: https://code.claude.com/docs/en/permission-modes (Manual, plan mode and its approval options incl. "Yes, manually approve edits", Shift+Tab cycle, auto as starting mode on recent versions).
- Permissions: https://code.claude.com/docs/en/permissions ("Yes, and don't ask again": permanent per repository and command for Bash, until session end for file edits; saved to `.claude/settings.local.json`; `/permissions`).
- Checkpointing: https://code.claude.com/docs/en/checkpointing (checkpoint per prompt, rewind menu: restore code and conversation; Esc twice on an empty prompt; not a replacement for version control).
- Commands: https://code.claude.com/docs/en/commands (`/diff` reviews changes in the working tree including Claude's edits; `/code-review` checks the current diff for bugs; `/clear`, `/resume`, `/compact`).
- Interactive mode: https://code.claude.com/docs/en/interactive-mode (`!` shell mode, Esc, Esc Esc).
- Episode 1 demo repo and task: /workspace/agentic-course/day02-ep01-script.md · Episode 3 reference: /workspace/agentic-course/day04-ep03-script.md.
