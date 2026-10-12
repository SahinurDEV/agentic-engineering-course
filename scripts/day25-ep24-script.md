# Day 25 · Episode 24: Building a New Feature from a Spec

**Series:** Agentic Engineering (free YouTube course) · Module 10
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 19:00 to 20:00
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 10 lesson):** Implementing a new feature

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. The change `add-free-shipping` (proposal, delta spec, design, tasks) and the prompts are **written for this course** (full text under "Example files"); they are the reviewed versions of the plan, not something Claude produced on camera. Nothing Claude or any tool printed is shown. OpenSpec facts come from the official repository at version 1.14.1 (README, docs, source); Claude Code facts from code.claude.com/docs; Playwright MCP facts from the official README, as in Episode 22.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:00–9:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Propose and review |
| 9:00–13:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Apply |
| 13:30–19:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Verify and archive |
| 19:00–19:45 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we installed Open Spec in the cart project and wrote its first spec, for discount codes.
> Today we use it for real. One new feature, from the first prompt to the archived spec: free shipping over fifty. Every step, every file, and every check.

**Visual / B-roll:**
- Episode 23 recap panel, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-four: building a new feature from a spec.

*Cue: agenda slide "Three parts"*
> Three parts. First, propose and review: we ask for the change, then read the plan before any code exists. Second, apply: Claude builds it from the task list. Third, verify and archive: tests, a browser check, and filing the change away so the spec becomes the record.
> This is an illustrated walkthrough, not a recording. The files on screen are the reviewed versions of the plan, written for this course, and printed in full in the description. What Claude drafts for you will be worded differently.

**Visual / B-roll:**
- Three items: 01 Propose and review · 02 Apply · 03 Verify and archive.

### 1:00–9:00 · Part 1: Propose and review
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Propose and review"*
> Part one. Propose and review.

*Cue: two columns "The feature"*
> Here's the feature. Today, the cart has no shipping line at all. Shoppers can't see what shipping will cost, and nothing nudges them to add one more item.
> After the change, carts below fifty get a flat shipping fee of four ninety-nine. Carts of fifty or more ship free. And the cart summary shows the shipping line, plus how much more you need to spend for free shipping.
> One detail decides a lot: the threshold uses the total after discounts. Keep that in mind, because it's exactly the kind of thing a plan has to pin down.

*Cue: squares "Where we start"*
> We're not starting from nothing. Three things are already in place from earlier episodes.
> The config file from episode twenty-three. Its context tells Open Spec about the project, and its rules ask every proposal to state what's out of scope, every spec to cover edge cases, and every task list to include running N P M test.
> The discounts spec, also from episode twenty-three, which says how save ten works.
> And the Playwright server from episode twenty-two, which we'll use to check the result in a real browser.

*Cue: flow "The whole walkthrough"*
> Here's the whole walkthrough in five steps. Propose. Review. Apply. Verify. Archive.
> Open Spec's guide on reviewing changes says there are exactly two moments to review: after propose, before any code, and after building. We'll do both.

*Cue: drawn terminal "The propose prompt"*
> Step one. In the Claude Code chat, type slash O P S X propose. The command takes a short change name or a plain description, so I give it a description, and the exact wording is on screen.
> Free shipping when the cart total after discounts is fifty or more. Otherwise, a flat fee of four ninety-nine. Show the shipping line, and how much more is needed.
> Propose creates a change folder, here called add free shipping, under open spec slash changes. It writes the planning artifacts, and it stops when the change is ready to apply. It does not write code.
> If the idea were still fuzzy, I'd start with slash O P S X explore instead, and think it through before proposing. Here the feature is clear, so propose is the right start.
> I'm not showing what Claude prints. What matters is the files it leaves behind, and reading them.

*Cue: four numbered "Review in this order"*
> Step two, the review. The docs say to read the files in the order that lets you quit earliest if something's wrong, with one question for each.
> The proposal first: is this the right problem?
> Then the delta specs: is done defined correctly? The docs call this the heart of the review.
> The design, if there is one: is the approach sound?
> And the tasks last: is the plan of work sane?
> The bet, in the docs' own words: catching a wrong turn in a one-paragraph plan is nearly free. Catching the same wrong turn in three hundred lines of code is not.
> The docs also say to right-size the review. A one-file typo fix deserves a quick skim. A change that touches payments deserves every question. Shipping fees are money, so this one gets the full pass.

*Cue: phone "proposal.md"*
> Here's our proposal, the reviewed version, written for this course.
> Why: shoppers can't see the shipping cost, and have no reason to add one more item.
> What changes: the flat fee, free shipping at fifty after discounts, and the summary line.
> Capabilities: one new capability called shipping, and no modified ones, because discounts work exactly as before.
> Impact: a new shipping module, changes to the cart totals and the cart summary, new tests, and no new dependencies.
> And because our config asks for it, out of scope: shipping by country, weight or speed, and any change to discount codes.
> The docs list the red flags here: a slightly different problem than the one you asked for, scope that has grown, or vague wording. If you see one, stop and fix the proposal before reading on.

*Cue: plan "The delta spec"*
> Next, the delta spec, in specs slash shipping slash spec dot M D. It's a new capability, so it starts with a short purpose, then a section of added requirements. Three of them.
> One: a flat shipping fee. The cart shall add four ninety-nine when the total after discounts is above zero and below fifty.
> Two: the free shipping threshold. The cart shall charge no shipping at fifty or more.
> Three: shipping shown in the cart. The summary shall show the shipping line, and how much more is needed below the threshold.
> Each requirement uses shall, and each has scenarios written as when, then.

*Cue: two points "The scenarios that matter"*
> The docs say the most valuable catch in a review is what's missing. The A I writes down what you said. Your job is to notice what you forgot to say.
> So I check for the edge cases. Two matter most here.
> Exactly fifty. A total of exactly fifty must ship free, not one cent short.
> And a discount that crosses the line. A fifty-five cart with save ten comes to forty-nine fifty, so it pays shipping, for an order total of fifty-four forty-nine.
> If a draft is missing a case like that, I ask for it: add a scenario for exactly fifty. That's cheap now, and expensive later.

*Cue: card "design.md"*
> Then the design. Open Spec's schema says to write a design only when it's needed: for a change across modules, a new dependency, real complexity, or ambiguity. This one crosses three files, so a short design earns its place.
> It makes four decisions. A new module, shipping dot J S, holds the rule and its two constants. The cart applies discounts first, then adds shipping, which is what makes the save ten scenario come out right. Money is compared in whole cents, so fifty is exactly fifty. And the summary does no shipping maths of its own.
> It also lists one risk with its fix: a floating point total landing a cent off the threshold. The fix is cents, and a test for exactly fifty.

*Cue: panel "tasks.md"*
> Last, the tasks. Four groups, with checkboxes.
> One, the shipping rule and its tests. Two, the cart totals, including the save ten test. Three, the cart summary. And four, run N P M test and fix any failures, which our config's rule asked for.
> The docs' red flags here: a task with no matching requirement, one giant task that hides the real decisions, or a task outside the scope you just approved. Every task here maps back to a requirement.
> The docs end the review with a short checklist, and its last line is the one I like best: I'd be comfortable if the A I built exactly this, and nothing more.

*Cue: two columns "Pushing back is cheap"*
> And if anything fails the review, push back. The docs give two ways, and both are fine.
> Edit the file yourself. It's plain markdown: tighten a requirement, cut a task, fix the scope line.
> Or tell Claude what's wrong, in plain words, and let it revise the artifact with the whole change as context.
> Then re-read what changed. Before applying, I also run open spec validate on the change, in strict mode, in the terminal. Our reviewed change passes. Re-draft until it's a plan you'd sign your name to.

**Visual / B-roll:**
- Two columns: today vs after the change.
- Squares: config.yaml · discounts spec · Playwright MCP.
- Flow: Propose → Review → Apply → Verify → Archive.
- Monitor + Illustration: the propose prompt as typed.
- Four numbered: proposal · specs · design · tasks, with the question for each.
- Phone + Illustration: proposal.md.
- Plan + Illustration: three requirements.
- Two points + Illustration: the 50.00 and SAVE10 scenarios.
- Card + Illustration: design decisions.
- Panel: four task groups.
- Two columns: edit the file vs tell Claude.

### 9:00–13:30 · Part 2: Apply
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Apply"*
> Part two. Apply.

*Cue: squares "Before you apply"*
> Three things before the build starts.
> Validate. The plan passed strict validation, so the format is right.
> Commit the plan. The change folder is just files, so I commit it, and the agreed plan is in history before any code changes.
> And clear the context. The Open Spec readme says to clear your context before starting implementation. In Claude Code, slash clear starts a new conversation with empty context, while keeping project memory. It's the same move as episode sixteen: plan in one session, build in a fresh one.

*Cue: drawn terminal "Start the build"*
> In the fresh session, type slash O P S X apply, with the change name. The docs say the name is inferred from context if you leave it out, but in a fresh session I'd rather say it.
> Everything Claude needs is in the change folder: the proposal, the spec, the design, and the tasks. Nothing depends on the chat we just cleared.
> On screen are only the commands I type. No output is shown.

*Cue: four numbered "What apply does"*
> Here's what apply does, from the commands reference.
> It reads tasks dot M D, and finds the tasks that aren't done.
> It works through them one by one.
> It writes code, creates files, and runs tests as needed.
> And it marks each task complete, by ticking its checkbox. Completion is tracked right there in tasks dot M D.

*Cue: flow "Task by task"*
> For our change, that's the shipping rule first, then its tests, then the cart totals, then the summary, and finally the full test run.
> Because progress lives in the checkboxes, apply can resume where it left off. If the session ends halfway, run apply again, and it picks up from the first unticked task.

*Cue: panel "While it works"*
> While it works, you're still in charge, with the same tools from earlier episodes.
> Claude Code still asks permission before editing files, unless you've chosen a mode that doesn't.
> Escape stops it mid-action, and the context is kept, so you can redirect, as we saw in episode eight.
> The task list can change too. The docs call it a living checklist: add tasks you discover, remove ones you don't need, or reorder them.
> And the plan is alive. The docs say artifacts are the live plan, not a signed contract. If the design turns out wrong, edit design dot M D, or ask Claude to, and run apply again. It reads the current files.

*Cue: two points "When code and spec disagree"*
> Sometimes you'll edit code by hand, and then the code and the spec disagree. The docs say to reconcile in whichever direction is true.
> If the code is now right and the spec is stale, update the delta spec to describe what you actually built.
> If the spec is right and the code drifted, keep fixing until the code matches.
> Either way, do it before archiving, because archiving merges the spec into your source of truth.

**Visual / B-roll:**
- Squares: Validate · Commit · Clear.
- Monitor + Illustration: /clear and /opsx:apply as typed.
- Four numbered: Read · One by one · Code and tests · Tick.
- Flow: Rule → Tests → Totals → Summary → npm test.
- Panel: permissions · Escape · living plan.
- Two points + Illustration: spec stale vs code drifted.

### 13:30–19:00 · Part 3: Verify and archive
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Verify and archive"*
> Part three. Verify and archive. Ticked boxes mean Claude thinks it's done. Now we check.

*Cue: card "Tests first"*
> Tests first. Run N P M test yourself, in the terminal, and read the result with your own eyes.
> Then check coverage against the spec, scenario by scenario. Small cart. Empty cart. Exactly fifty. Fifty-five with save ten. Below the threshold, and above it. Every scenario should have a test that would fail if the behavior broke.
> The tasks asked for tests at zero, twenty, forty-nine ninety-nine, fifty, and sixty, plus the save ten case. If a scenario has no test, that's a task to add, not something to wave through.

*Cue: phone "Check it in the browser"*
> Tests check the logic. The summary line is U I, so I check it in a browser too, with the Playwright server from episode twenty-two.
> Start the cart's dev server yourself. Then give Claude one specific check. The prompt is written for this course and printed in full: open the cart, add items to reach forty-two, and check the summary says shipping four ninety-nine, and add eight more for free shipping. Then add items to pass fifty, and check shipping says free and the message is gone. Use snapshots to read the page, save a screenshot, and report console errors.
> As in episode twenty-two: act on snapshots, keep the screenshot as proof.

*Cue: plan "A second review: verify"*
> The docs describe a second review, after building, with slash O P S X verify. It re-reads the artifacts and the code, and checks three things.
> Completeness: every task done, every requirement implemented, scenarios covered.
> Correctness: the code matches the spec's intent, and edge cases are handled.
> Coherence: the design decisions actually show up in the code.
> It flags issues as critical, warning, or suggestion, and it doesn't block archiving. Verify is in the expanded profile, so turn it on with open spec config profile, then open spec update. Or do the same review by hand: read the change, and read the diff.

*Cue: four numbered "What archive does"*
> When the code and the spec agree, archive. Type slash O P S X archive. From the commands reference, it does four things.
> It checks the artifacts and the tasks, and warns if any task is unfinished.
> It offers to sync the delta specs into the main specs, if you haven't already.
> On sync, our three added requirements become a new main spec, open spec slash specs slash shipping.
> And it moves the change folder into the archive, with the date at the front of its name.

*Cue: drawn terminal "After the archive"*
> Afterwards, three terminal commands. Open spec list, with dash dash specs, now shows two capabilities: discounts and shipping. Open spec show, for the shipping spec, displays the requirements that are now the record. And validate, with dash dash all, checks everything.
> I ran this whole change through Open Spec version one point fourteen point one in a scratch copy of the project, and the plan validated and archived cleanly. That's how I know the files in the description work. None of that output is shown here.
> Then commit. That's the last step of the loop from episode seven: explore, plan, implement, verify, commit.

*Cue: two points "What the repo now holds"*
> So what changed in the repository, apart from the code?
> One: a new main spec for shipping. Next time anyone touches shipping, a person or an agent, this is how the system is supposed to behave.
> Two: the archived change, with its proposal, design, and tasks. That's the why behind the code, kept next to it, with a date.
> And when shipping needs to change later, the docs give a simple rule. If it's the same work, refined, update the change you're on. If the intent is different, start a new change. Once this one is archived, any later change to shipping is a new change, against the spec we just wrote.

*Cue: quote slide*
> The line to remember: review the plan while it's still just words.

*Cue: recap slide*
> Recap. Propose with a clear description, then review in order: proposal, specs, design, tasks, hunting for what's missing, like exactly fifty and the save ten case. Validate, commit the plan, clear the context, and apply, task by task. Verify with your own test run, a browser check through Playwright, and optionally slash O P S X verify. Then archive, and the delta becomes the main spec.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-five: changing a feature with a spec. We'll change this shipping feature, and see what modified requirements look like. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Card + Illustration: npm test and scenario coverage.
- Phone + Illustration: Playwright check prompt.
- Plan + Illustration: completeness, correctness, coherence.
- Four numbered: Check · Sync · Merge · Move.
- Monitor + Illustration: typed CLI commands only.
- Two points: new main spec · archived change.
- Quote card, recap card, next-episode card "Episode 25 · Changing a Feature with a Spec".

---

## Example files (written for the course)

These are the reviewed versions of the `add-free-shipping` change in the cart project. All blocks are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. OpenSpec's own templates contain HTML comments and angle-bracket placeholders; none were kept. The change passes `openspec validate add-free-shipping --strict` with OpenSpec 1.14.1, and archives cleanly, creating `openspec/specs/shipping/spec.md` (checked in a scratch copy of the project; no output shown). Prices and the dev server address are illustrative.

### Prompts (typed in the Claude Code chat)

```text
/opsx:propose Free shipping when the cart total after discounts is 50.00 or more, otherwise a flat fee of 4.99. Show the shipping line in the cart summary and how much more is needed for free shipping.
```

```text
/clear
/opsx:apply add-free-shipping
```

```text
Use playwright to open http://localhost:3000, add items until the cart total is 42.00, and check that the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping. Then add items until the total is over 50.00 and check that it shows Shipping Free with no free shipping message. Use snapshots to read the page. Save a screenshot as free-shipping-check.png and report any console errors.
```

```text
/opsx:archive add-free-shipping
```

### Commands (typed in the terminal; no output shown)

```text
openspec validate add-free-shipping --strict
git add openspec/changes/add-free-shipping
git commit -m "Plan: add free shipping"
npm test
openspec list --specs
openspec show shipping --type spec
openspec validate --all --strict
```

### `openspec/changes/add-free-shipping/proposal.md`

```markdown
# Proposal: Free shipping over 50.00

## Why
Shoppers can't see what shipping will cost until the end, and they have no reason to add one more item. A clear free shipping threshold fixes both.

## What Changes
- Add a flat shipping fee of 4.99 to carts below 50.00
- Make shipping free when the cart total after discounts is 50.00 or more
- Show the shipping line in the cart summary, and how much more is needed for free shipping

## Capabilities

### New Capabilities
- `shipping`: how the cart works out the shipping fee and shows it to the shopper

### Modified Capabilities
None.

## Impact
- New module src/shipping.js. src/cart.js adds shipping to the order total. The cart summary in src/CartList.jsx shows the shipping line.
- New tests in the existing node --test suite, run with npm test.
- No new dependencies.

## Out of scope
- Shipping by country, weight or delivery speed
- Any change to how discount codes work
```

### `openspec/changes/add-free-shipping/specs/shipping/spec.md`

```markdown
# Spec Delta

## Purpose
Define how the cart works out the shipping fee and how it shows shipping to the shopper, including the free shipping threshold.

## ADDED Requirements

### Requirement: Flat shipping fee
The cart SHALL add a shipping fee of 4.99 when the cart total after discounts is above 0 and below 50.00.

#### Scenario: Small cart
- **WHEN** the cart total after discounts is 20.00
- **THEN** the shipping fee is 4.99 and the order total is 24.99

#### Scenario: Empty cart
- **WHEN** the cart is empty
- **THEN** the shipping fee is 0

### Requirement: Free shipping threshold
The cart SHALL charge no shipping when the cart total after discounts is 50.00 or more.

#### Scenario: Exactly at the threshold
- **WHEN** the cart total after discounts is exactly 50.00
- **THEN** the shipping fee is 0 and the order total is 50.00

#### Scenario: A discount takes the cart below the threshold
- **WHEN** the cart total is 55.00 and the user applies SAVE10
- **THEN** the cart total after discounts is 49.50, the shipping fee is 4.99, and the order total is 54.49

### Requirement: Shipping shown in the cart
The cart summary SHALL show a shipping line, and SHALL show how much more is needed for free shipping when the cart is below the threshold.

#### Scenario: Below the threshold
- **WHEN** the cart total after discounts is 42.00
- **THEN** the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping

#### Scenario: At or above the threshold
- **WHEN** the cart total after discounts is 60.00
- **THEN** the summary shows Shipping Free and no free shipping message
```

### `openspec/changes/add-free-shipping/design.md`

```markdown
# Design

## Context
Discounts are applied in src/discounts.js, cart totals are worked out in src/cart.js, and the cart summary is shown by src/CartList.jsx. Shipping touches all three, so a short design is worth writing down before any code.

## Goals / Non-Goals

**Goals:**
- One place in the code decides the shipping fee
- Shipping is always based on the cart total after discounts

**Non-Goals:**
- Shipping rules by country, weight or delivery speed

## Decisions
- A new module, src/shipping.js, holds the rule: one function, shippingFor, and two constants, FREE_SHIPPING_THRESHOLD set to 50.00 and SHIPPING_FEE set to 4.99. Alternative considered: putting the rule inside src/cart.js. Not chosen, so the rule has one home and its own tests.
- src/cart.js applies discounts first, then asks src/shipping.js for the fee, then adds it to get the order total. This order is what makes the 55.00 with SAVE10 scenario come out right.
- Money is compared in whole cents, so a total of exactly 50.00 is at the threshold and never a fraction below it.
- The cart summary reads the fee and the amount still needed from src/cart.js. It does no shipping maths itself.

## Risks / Trade-offs
- Risk: floating point totals land a cent off the threshold. Mitigation: compare in cents, and test the exact 50.00 case.
- Trade-off: the threshold is a constant, so changing it needs a code change. Accepted for now.
```

### `openspec/changes/add-free-shipping/tasks.md`

```markdown
# Tasks

## 1. Shipping rule

- [ ] 1.1 Create src/shipping.js with FREE_SHIPPING_THRESHOLD, SHIPPING_FEE and shippingFor, comparing money in whole cents
- [ ] 1.2 Add tests for cart totals of 0, 20.00, 49.99, 50.00 and 60.00

## 2. Cart totals

- [ ] 2.1 In src/cart.js, apply discounts first, then add shipping to get the order total
- [ ] 2.2 Return the amount still needed for free shipping
- [ ] 2.3 Add a test for a 55.00 cart with SAVE10 giving an order total of 54.49

## 3. Cart summary

- [ ] 3.1 Show the shipping line in src/CartList.jsx, as 4.99 or Free
- [ ] 3.2 Show the message Add X more for free shipping when the cart is below the threshold

## 4. Check

- [ ] 4.1 Run npm test and fix any failures
```

---

## Production notes
- Spoken word count is about 2,550 words, roughly 18 minutes at a steady TTS pace, about 19 with slide pauses (plan target about 20).
- Illustrated walkthrough, not a recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. The change files are presented as the reviewed plan, written for the course; the narration says Claude's own draft will be worded differently. No Claude, OpenSpec, test, or browser output is shown.
- The agenda says three parts and the script has three parts (three dividers).
- Spoken episode numbers: "episode twenty-four" (this one), "episode twenty-three", "episode twenty-two", "episode sixteen", "episode eight", "episode seven", "episode twenty-five" (next).
- Arithmetic in the spec: 20.00 + 4.99 = 24.99; 55.00 less 10 percent = 49.50, plus 4.99 = 54.49; 50.00 minus 42.00 = 8.00.
- OpenSpec facts (1.14.1): `/opsx:propose [change-name-or-description]` creates `openspec/changes/NAME/`, generates the planning artifacts and stops when ready for apply (docs/commands.md). Review: two moments, read order, one question per file, red flags, "the heart of the review", "the most valuable catch of all: what's missing", "nearly free" vs "300 lines of code", pushing back two ways (docs/reviewing-changes.md). Design only when needed (schemas/spec-driven/schema.yaml). New capability delta has a Purpose and ADDED Requirements (templates/spec.md). `/opsx:apply [change-name]`: name inferred if omitted; reads tasks.md; works one by one; writes code, runs tests as needed; marks `[x]`; resumes (docs/commands.md, docs/editing-changes.md). Artifacts are "the live plan, not a signed contract"; reconcile code and spec in whichever direction is true before archive (docs/editing-changes.md). `/opsx:verify`: completeness, correctness, coherence; CRITICAL/WARNING/SUGGESTION; does not block archiving; expanded profile via `openspec config profile` then `openspec update` (docs/reviewing-changes.md). `/opsx:archive`: checks artifacts and tasks, warns if incomplete, offers to sync, moves to `archive/YYYY-MM-DD-NAME/` (docs/commands.md). README: clear your context before starting implementation.
- Claude Code facts: `/clear` starts a new conversation with empty context and keeps project memory (code.claude.com/docs/en/commands). Escape stops Claude mid-action with context kept (as in Episode 8). Permission prompts before edits in the default mode (earlier episodes).
- Playwright MCP: as Episode 22 (snapshots to act, screenshots as evidence, console messages).
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Building a New Feature from a Spec with OpenSpec and Claude Code | Agentic Engineering Ep 24
2. OpenSpec End to End: Propose, Review, Apply, Verify, Archive | Ep 24
3. Free Shipping, Spec First: A Full OpenSpec Walkthrough | Agentic Engineering Ep 24

### Description
```
Episode 24 of Agentic Engineering, a free course on building real software with AI coding agents.

One new feature in the cart project, end to end with OpenSpec: free shipping over 50.00. We propose the change with /opsx:propose, review the proposal, delta spec, design and tasks in order (and hunt for what's missing), validate and commit the plan, clear the context, build it with /opsx:apply, verify with tests, a Playwright browser check and /opsx:verify, then archive it so the delta becomes the main spec.

Note: this is an illustrated walkthrough, not a recording; no Claude or tool output is shown. The change files are the reviewed versions, written for the course. Facts come from the official OpenSpec repository (version 1.14.1) and the Claude Code docs.

Example files:

[paste the prompts, commands, proposal.md, spec.md, design.md and tasks.md from the script here; none contain angle brackets]

Next in the playlist: Episode 25 · Changing a Feature with a Spec.
```

### Tags
Claude Code, OpenSpec, spec-driven development, opsx, delta specs, code review, AI coding agents, agentic engineering, Playwright MCP, feature development, requirements

### Thumbnail text idea
"SPEC → SHIPPED" in coral, with a drawn checklist icon.

---

## Suggested slide list (Episode 24 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 24 · Building a New Feature from a Spec |
| 2 | Agenda | Three parts: Propose and review · Apply · Verify and archive |
| 3 | 01 · Propose and review | Divider |
| 4 | The feature | Today vs after |
| 5 | Where we start | config.yaml · discounts spec · Playwright MCP |
| 6 | The whole walkthrough | Propose → Review → Apply → Verify → Archive |
| 7 | The propose prompt | Typed prompt (Illustration) |
| 8 | Review in this order | Four files, four questions |
| 9 | proposal.md | (Illustration) |
| 10 | The delta spec | Three requirements (Illustration) |
| 11 | The scenarios that matter | 50.00 exactly · SAVE10 (Illustration) |
| 12 | design.md | Decisions (Illustration) |
| 13 | tasks.md | Four groups |
| 14 | Pushing back is cheap | Edit vs tell |
| 15 | 02 · Apply | Divider |
| 16 | Before you apply | Validate · Commit · Clear |
| 17 | Start the build | /clear, /opsx:apply (Illustration) |
| 18 | What apply does | Four steps |
| 19 | Task by task | Rule → Tests → Totals → Summary → npm test |
| 20 | While it works | Permissions · Escape · living plan |
| 21 | When code and spec disagree | (Illustration) |
| 22 | 03 · Verify and archive | Divider |
| 23 | Tests first | (Illustration) |
| 24 | Check it in the browser | Playwright prompt (Illustration) |
| 25 | A second review: verify | Three dimensions (Illustration) |
| 26 | What archive does | Check · Sync · Merge · Move |
| 27 | After the archive | CLI commands (Illustration) |
| 28 | What the repo now holds | Main spec · archived change |
| 29 | Quote | Review the plan while it's words |
| 30 | Recap | |
| 31 | Next | Episode 25 · Changing a Feature with a Spec |

---

## Sources
- OpenSpec 1.14.1: https://github.com/Fission-AI/OpenSpec (README; docs/commands.md, docs/reviewing-changes.md, docs/editing-changes.md, docs/getting-started.md; schemas/spec-driven/schema.yaml and templates)
- Claude Code: https://code.claude.com/docs/en/commands (/clear)
- Playwright MCP: https://github.com/microsoft/playwright-mcp
- Course: Episode 7 (day08-ep07-script.md), Episode 8 (day09-ep08-script.md), Episode 16 (day17-ep16-script.md), Episode 22 (day23-ep22-script.md), Episode 23 (day24-ep23-script.md).
