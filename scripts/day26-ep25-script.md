# Day 26 · Episode 25: Changing a Feature with a Spec

**Series:** Agentic Engineering (free YouTube course) · Module 10
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 12:00
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 10 lesson):** Implementing a change in a feature

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. The change `lower-free-shipping-threshold` (proposal, delta spec, tasks) and the prompts are **written for this course** (full text under "Example files"); they are the reviewed versions of the plan, not something Claude produced on camera. Nothing Claude or any tool printed is shown. OpenSpec facts come from the official repository at version 1.14.1 (docs, schema, and behavior checked by running the change in a throwaway copy of the project); Claude Code and Playwright MCP facts as in Episodes 22 and 24.

**Counts drawn on slides (checked against the files):** delta spec: 3 MODIFIED requirements, 6 scenarios, 3 of them changed, 2 requirement sentences changed; 0 ADDED, 0 REMOVED. Tasks: 5 tasks in 3 groups (2, 1, 2). No design.md.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook |
| 0:25–0:55 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 0:55–3:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · A new change |
| 3:30–7:45 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · The delta spec |
| 7:45–11:15 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Apply, verify, archive |
| 11:15–12:00 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we built free shipping over fifty, from the first prompt to an archived spec.
> Now the business wants a change: free shipping from forty instead. Most real work looks like this. Not new features, but changes to old ones.

**Visual / B-roll:**
- Episode 24 recap panel, then the title card.

### 0:25–0:55 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-five: changing a feature with a spec.

*Cue: agenda slide "Three parts"*
> Three parts. First, why this is a new change, and what we start from. Second, the delta spec: modified requirements, the rules Open Spec checks, and why we don't need removed. Third, apply, verify, and archive. It's an illustrated walkthrough. The files are written for this course, checked with Open Spec version one point fourteen point one, and printed in full in the description.

**Visual / B-roll:**
- Three items: 01 A new change · 02 The delta spec · 03 Apply, verify, archive.

### 0:55–3:30 · Part 1: A new change
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · A new change"*
> Part one. A new change.

*Cue: two columns "Update, or start new?"*
> Open Spec's docs give a simple rule. Update a change when it's the same work, refined. Start a new change when the intent has changed, or the scope has grown into different work.
> The docs give examples. Same goal, better approach: update. Scope narrowing, like shipping a smaller first version: update, archive, then start a new change for phase two. And if the problem itself changed, start new.
> Our free shipping change was archived last episode. It's finished history. So lowering the threshold is a new change, made against the main spec we wrote.

*Cue: squares "What we start from"*
> Here's what we start from.
> The main shipping spec: three requirements, with six scenarios. That's the agreed behavior today.
> The archived change from episode twenty-four, with its proposal, design, and tasks, so we can see why it was built that way.
> And the code. Its design said the threshold is a constant, so changing it needs a code change. It accepted that, for now. Today is that day.

*Cue: drawn terminal "The propose prompt"*
> In the Claude Code chat, type slash O P S X propose, with a plain description. Lower the free shipping threshold from fifty to forty. Keep the four ninety-nine fee and everything else the same.
> That last sentence matters. It tells Claude what must not change, and it gives me something to check the plan against.
> The schema tells the agent to check the existing specs first, with open spec list dash dash specs, and to reuse the exact path of a capability that already exists. So the delta should land in specs slash shipping, not in a new, near-duplicate capability.

*Cue: four numbered "Review the plan"*
> Then the review, in the same order as last time.
> The proposal: no new capabilities, and one modified capability, shipping. Out of scope: the fee, and discount codes. I check it against my own prompt. I said keep the fee, so if the proposal touches the fee, that's scope creep, and I stop there.
> The delta spec: the heart of it, and the whole of part two.
> The design: none. The schema says to write one only when it's needed, and this is one constant in one module. Open Spec still validates and archives the change without it. I checked.
> And the tasks: five tasks, in three groups.

**Visual / B-roll:**
- Two columns: update vs new change.
- Squares: main spec · archived change · code.
- Monitor + Illustration: the propose prompt as typed.
- Four numbered: proposal · specs · design (none) · tasks.

### 3:30–7:45 · Part 2: The delta spec
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · The delta spec"*
> Part two. The delta spec.

*Cue: plan "How MODIFIED works"*
> A modified requirement replaces the old one completely when you archive. So the schema gives a short workflow.
> Find the requirement in the main spec. Copy the entire block, from the requirement header through all its scenarios. Paste it under modified requirements. Then edit it to the new behavior.
> And the header text must match the existing one exactly. That's how Open Spec knows which requirement you mean.
> Also, a delta for an existing capability has no purpose section. That was only for the new capability last time.

*Cue: two points "The ripple"*
> Now the interesting part. We only changed one number. How many requirements does it touch?
> The flat fee says below fifty. That becomes below forty. The threshold says fifty or more. That becomes forty or more, and its two scenarios change too: exactly forty ships free, and the save ten case becomes a forty-four cart, which drops to thirty-nine sixty and pays shipping.
> And the third requirement, shipping shown in the cart, has the same sentence as before. But its scenario used a forty-two cart, with add eight more for free shipping. At forty, a forty-two cart ships free. That scenario is now false. So it moves to a thirty-two cart.
> One number, three requirements. That's the review catching what the A I might not.

*Cue: phone "The delta, by the numbers"*
> So here's the delta, by the numbers, and they match the file exactly.
> Three modified requirements. Six scenarios in total, because each block is copied whole. Three of those scenarios changed, and three are copied unchanged. Two requirement sentences changed. Nothing added, and nothing removed.
> Copying the unchanged scenarios feels like extra work. It isn't optional.

*Cue: card "What OpenSpec checks"*
> Here's why. I tried both mistakes in a throwaway copy of the project, with version one point fourteen point one.
> First, I left the empty cart scenario out of the flat fee block. Strict validation reported an error: the modified block omits a scenario the current spec still has. And archive refused, and changed no files.
> Second, I renamed a header, so it no longer matched. Validation still passed, but it noted that archive would refuse the delta. And archive did refuse, with no files changed.
> So the lesson: run validate, and read everything it says, not just the last line.

*Cue: panel "And REMOVED?"*
> What about removed requirements? The schema says a removed requirement must include a reason and a migration: why it's going, and what to use instead.
> We don't need one. All three requirements still hold. They just have new numbers. And dropping part of a requirement is a modified requirement, not a removed one.
> You'd use removed when a whole behavior goes away. For example, if the business dropped the add more for free shipping message entirely, and it had its own requirement.

*Cue: flow "Before you build"*
> Before building, five steps. Validate in strict mode. Then show the change with dash dash diff, which prints each modified requirement as a before and after. It's the fastest review of a modified delta. Commit the plan. Clear the context. And apply.

**Visual / B-roll:**
- Plan + Illustration: copy the block, match the header.
- Two points + Illustration: 50.00 to 40.00 ripple, the 42.00 scenario.
- Phone + Illustration: 3 MODIFIED, 6 scenarios, 3 changed.
- Card + Illustration: omitted scenario and header mismatch.
- Panel: REMOVED needs Reason and Migration.
- Flow: Validate → Diff → Commit → Clear → Apply.

### 7:45–11:15 · Part 3: Apply, verify, archive
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Apply, verify, archive"*
> Part three. Apply, verify, archive.

*Cue: squares "Five tasks, three groups"*
> The tasks are small, as they should be for a small change.
> Group one, the threshold, has two tasks: set the constant to forty, and update the threshold tests to thirty-nine ninety-nine, forty, and sixty.
> Group two, the discount case, has one: replace the fifty-five save ten test with forty-four, for an order total of forty-four fifty-nine.
> Group three, the check, has two: run N P M test, and check the cart summary in the browser.
> Notice there's no task to change the summary code. Last episode's design said the summary reads the amount still needed from the cart, and does no shipping maths of its own. That decision pays off now. The message updates by itself, so we only need to check it.

*Cue: drawn terminal "Apply"*
> In a fresh session, slash O P S X apply, with the change name. Claude works through the five tasks and ticks each box in tasks dot M D.
> Then I run N P M test myself, in the terminal. On screen are only the commands. No output is shown.

*Cue: two points "Verify the change"*
> Two checks. First, the tests. Every changed scenario needs a matching test. Exactly forty, and the thirty-two cart that needs eight more, both fail on the old threshold. The forty-four save ten case passes either way, so it checks that the discount still pays shipping. And the old fifty tests must be gone, or changed, not left passing by accident.
> Second, the browser, because the summary text depends on the threshold.

*Cue: phone "Check it in the browser"*
> With the Playwright server from episode twenty-two, and the dev server running, the check prompt is written for this course. At thirty-two, the summary should show shipping four ninety-nine, and add eight more for free shipping. At sixty, shipping free, and no message. Use snapshots to read the page, and report console errors.
> If you've turned on the expanded profile, slash O P S X verify is a second review here too. It checks completeness, correctness, and coherence between the change and the code.
> And if anything disagrees, reconcile before archiving, in whichever direction is true. Archive makes the spec the record.

*Cue: four numbered "Archive"*
> Then archive, with slash O P S X archive. In our throwaway run, it did four things.
> It checked the tasks.
> It synced the delta.
> It replaced all three requirements in the main shipping spec, with no additions and no removals.
> And it moved the change into the archive, with the date in its name.

*Cue: panel "The record now"*
> So what does the record look like now?
> The main shipping spec says forty, everywhere. Validation passes for every spec.
> The archive holds two changes for shipping: the one that built it, and the one that changed it, each with its own proposal and tasks.
> And git has the code. Commit, and the loop is closed.
> Months from now, when someone asks why free shipping starts at forty, the answer isn't buried in an old chat. It's in the archived proposal, with a date, right next to the code.

*Cue: quote slide*
> The line to remember: change one number, then read every scenario.

*Cue: recap slide*
> Recap. An archived change is history, so a change to the feature is a new change. Modified requirements replace the old ones, so copy each whole block, match the header exactly, and fix every scenario the change makes false. Use removed only when a whole requirement goes, with a reason and a migration. Validate in strict mode, read the diff, then apply, verify, and archive.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-six: GitHub integration. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Squares: Threshold (2) · Discount case (1) · Check (2).
- Monitor + Illustration: typed commands only.
- Two points + Illustration: tests and browser.
- Phone + Illustration: Playwright prompt.
- Four numbered: Check · Sync · Replace · Move.
- Panel: the record now.
- Quote card, recap card, next-episode card "Episode 26 · GitHub Integration".

---

## Example files (written for the course)

The reviewed versions of the `lower-free-shipping-threshold` change. All blocks are free of `<` and `>` characters. The change passes `openspec validate lower-free-shipping-threshold --strict` with OpenSpec 1.14.1 and archives cleanly (`~ 3 modified`, no additions or removals), starting from the main spec created by Episode 24's change (checked in a throwaway copy; no output shown). Prices and the dev server address are illustrative.

### Prompts (typed in the Claude Code chat)

```text
/opsx:propose Lower the free shipping threshold from 50.00 to 40.00. Keep the 4.99 fee and everything else the same.
```

```text
/clear
/opsx:apply lower-free-shipping-threshold
```

```text
Use playwright to open http://localhost:3000, add items until the cart total is 32.00, and check that the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping. Then add items until the total is 60.00 and check that it shows Shipping Free with no message. Use snapshots to read the page and report any console errors.
```

```text
/opsx:archive lower-free-shipping-threshold
```

### Commands (typed in the terminal; no output shown)

```text
openspec validate lower-free-shipping-threshold --strict
openspec show lower-free-shipping-threshold --diff
npm test
openspec show shipping --type spec
```

### `openspec/changes/lower-free-shipping-threshold/proposal.md`

```markdown
# Proposal: Lower the free shipping threshold to 40.00

## Why
We want more shoppers to reach free shipping, so the threshold drops from 50.00 to 40.00.

## What Changes
- Free shipping starts at 40.00 after discounts, instead of 50.00
- The flat fee of 4.99 now applies below 40.00
- The summary message counts up to the new threshold

## Capabilities

### New Capabilities
None.

### Modified Capabilities
- `shipping`: the free shipping threshold moves from 50.00 to 40.00

## Impact
- One constant in src/shipping.js, and the tests that use 50.00
- No new dependencies

## Out of scope
- Changing the 4.99 fee
- Any change to discount codes
```

### `openspec/changes/lower-free-shipping-threshold/specs/shipping/spec.md`

```markdown
# Spec Delta

## MODIFIED Requirements

### Requirement: Flat shipping fee
The cart SHALL add a shipping fee of 4.99 when the cart total after discounts is above 0 and below 40.00.

#### Scenario: Small cart
- **WHEN** the cart total after discounts is 20.00
- **THEN** the shipping fee is 4.99 and the order total is 24.99

#### Scenario: Empty cart
- **WHEN** the cart is empty
- **THEN** the shipping fee is 0

### Requirement: Free shipping threshold
The cart SHALL charge no shipping when the cart total after discounts is 40.00 or more.

#### Scenario: Exactly at the threshold
- **WHEN** the cart total after discounts is exactly 40.00
- **THEN** the shipping fee is 0 and the order total is 40.00

#### Scenario: A discount takes the cart below the threshold
- **WHEN** the cart total is 44.00 and the user applies SAVE10
- **THEN** the cart total after discounts is 39.60, the shipping fee is 4.99, and the order total is 44.59

### Requirement: Shipping shown in the cart
The cart summary SHALL show a shipping line, and SHALL show how much more is needed for free shipping when the cart is below the threshold.

#### Scenario: Below the threshold
- **WHEN** the cart total after discounts is 32.00
- **THEN** the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping

#### Scenario: At or above the threshold
- **WHEN** the cart total after discounts is 60.00
- **THEN** the summary shows Shipping Free and no free shipping message
```

### `openspec/changes/lower-free-shipping-threshold/tasks.md`

```markdown
# Tasks

## 1. Threshold

- [ ] 1.1 Set FREE_SHIPPING_THRESHOLD to 40.00 in src/shipping.js
- [ ] 1.2 Update the threshold tests to 39.99, 40.00 and 60.00

## 2. Discount case

- [ ] 2.1 Replace the 55.00 SAVE10 test with 44.00 SAVE10, giving an order total of 44.59

## 3. Check

- [ ] 3.1 Run npm test and fix any failures
- [ ] 3.2 Check the cart summary in the browser at 32.00 and 60.00
```

---

## Production notes
- Spoken word count is about 1,571 words, roughly 10.8 minutes at a steady TTS pace, plus slide pauses.
- Illustrated walkthrough, not a recording. No Claude, OpenSpec, test, or browser output is shown. The narration describes, in its own words, what validate and archive did with two deliberate mistakes in a throwaway copy; no tool output appears on screen.
- The agenda says three parts and the script has three parts (three dividers).
- Spoken episode numbers: "episode twenty-five" (this one), "episode twenty-four", "episode twenty-two", "episode twenty-six" (next).
- Counts (verified by counting the files): 3 `### Requirement:` blocks under `## MODIFIED Requirements`; 6 `#### Scenario:` blocks; changed scenarios: Exactly at the threshold, A discount takes the cart below the threshold, Below the threshold (3); unchanged: Small cart, Empty cart, At or above the threshold (3); changed requirement sentences: Flat shipping fee, Free shipping threshold (2). Tasks: 5 checkboxes in 3 groups (2, 1, 2).
- Arithmetic: 44.00 less 10 percent = 39.60, below 40.00, plus 4.99 = 44.59; 40.00 minus 32.00 = 8.00; 42.00 is now at or above the threshold, so Episode 24's 42.00 scenario became false.
- OpenSpec 1.14.1 facts: update vs new change (docs/editing-changes.md, docs/workflows.md); MODIFIED "MUST include full updated content", copy the entire block, header must match exactly (whitespace-insensitive), common pitfall of partial content; REMOVED "MUST include Reason and Migration"; no `## Purpose` in a delta for an existing capability; check existing specs with `openspec list --specs` and reuse the exact path; design "create only if" (schemas/spec-driven/schema.yaml). `openspec show NAME --diff` shows per-requirement diffs (src/cli/index.ts). Behaviors checked in a throwaway copy: no design.md, still valid and archivable; omitted scenario in a MODIFIED block gives a strict validation ERROR and archive aborts with no files changed; mismatched header gives an INFO note that archive would refuse, and archive aborts with no files changed; correct change archives as 3 modified.
- YouTube description: the ready-to-paste description below includes all prompts, commands and the three course files, and is 3,847 characters, under the 5,000 limit. It contains no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Changing a Feature with a Spec: MODIFIED Requirements in OpenSpec | Agentic Engineering Ep 25
2. OpenSpec Delta Specs: Change One Number, Read Every Scenario | Ep 25
3. Changing Existing Features with OpenSpec and Claude Code | Agentic Engineering Ep 25

### Description (ready to paste, 3,847 characters)
```
Episode 25 of Agentic Engineering, a free course on building real software with AI coding agents.

We change the free shipping feature from Episode 24 with OpenSpec 1.14.1: the threshold drops from 50.00 to 40.00. A new change, a MODIFIED delta spec (and why not REMOVED), the rules OpenSpec checks, then apply, verify and archive.

Screens are drawn illustrations; no Claude or tool output is shown. Files are written for the course and were checked with OpenSpec 1.14.1.

Prompts:
/opsx:propose Lower the free shipping threshold from 50.00 to 40.00. Keep the 4.99 fee and everything else the same.
/clear
/opsx:apply lower-free-shipping-threshold
Use playwright to open http://localhost:3000, add items until the cart total is 32.00, and check that the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping. Then add items until the total is 60.00 and check that it shows Shipping Free with no message. Use snapshots to read the page and report any console errors.
/opsx:archive lower-free-shipping-threshold

Terminal:
openspec validate lower-free-shipping-threshold --strict
openspec show lower-free-shipping-threshold --diff
npm test
openspec show shipping --type spec

openspec/changes/lower-free-shipping-threshold/proposal.md
# Proposal: Lower the free shipping threshold to 40.00

## Why
We want more shoppers to reach free shipping, so the threshold drops from 50.00 to 40.00.

## What Changes
- Free shipping starts at 40.00 after discounts, instead of 50.00
- The flat fee of 4.99 now applies below 40.00
- The summary message counts up to the new threshold

## Capabilities

### New Capabilities
None.

### Modified Capabilities
- `shipping`: the free shipping threshold moves from 50.00 to 40.00

## Impact
- One constant in src/shipping.js, and the tests that use 50.00
- No new dependencies

## Out of scope
- Changing the 4.99 fee
- Any change to discount codes

specs/shipping/spec.md
# Spec Delta

## MODIFIED Requirements

### Requirement: Flat shipping fee
The cart SHALL add a shipping fee of 4.99 when the cart total after discounts is above 0 and below 40.00.

#### Scenario: Small cart
- **WHEN** the cart total after discounts is 20.00
- **THEN** the shipping fee is 4.99 and the order total is 24.99

#### Scenario: Empty cart
- **WHEN** the cart is empty
- **THEN** the shipping fee is 0

### Requirement: Free shipping threshold
The cart SHALL charge no shipping when the cart total after discounts is 40.00 or more.

#### Scenario: Exactly at the threshold
- **WHEN** the cart total after discounts is exactly 40.00
- **THEN** the shipping fee is 0 and the order total is 40.00

#### Scenario: A discount takes the cart below the threshold
- **WHEN** the cart total is 44.00 and the user applies SAVE10
- **THEN** the cart total after discounts is 39.60, the shipping fee is 4.99, and the order total is 44.59

### Requirement: Shipping shown in the cart
The cart summary SHALL show a shipping line, and SHALL show how much more is needed for free shipping when the cart is below the threshold.

#### Scenario: Below the threshold
- **WHEN** the cart total after discounts is 32.00
- **THEN** the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping

#### Scenario: At or above the threshold
- **WHEN** the cart total after discounts is 60.00
- **THEN** the summary shows Shipping Free and no free shipping message

tasks.md
# Tasks

## 1. Threshold

- [ ] 1.1 Set FREE_SHIPPING_THRESHOLD to 40.00 in src/shipping.js
- [ ] 1.2 Update the threshold tests to 39.99, 40.00 and 60.00

## 2. Discount case

- [ ] 2.1 Replace the 55.00 SAVE10 test with 44.00 SAVE10, giving an order total of 44.59

## 3. Check

- [ ] 3.1 Run npm test and fix any failures
- [ ] 3.2 Check the cart summary in the browser at 32.00 and 60.00

Next in the playlist: Episode 26 · GitHub Integration.
```

### Tags
Claude Code, OpenSpec, spec-driven development, delta specs, MODIFIED requirements, opsx, change management, AI coding agents, agentic engineering, Playwright MCP, requirements

### Thumbnail text idea
"50 → 40: READ EVERY SCENARIO" in coral, with a drawn checklist icon.

---

## Suggested slide list (Episode 25 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 25 · Changing a Feature with a Spec |
| 2 | Agenda | Three parts: A new change · The delta spec · Apply, verify, archive |
| 3 | 01 · A new change | Divider |
| 4 | Update, or start new? | Docs rule |
| 5 | What we start from | Main spec (3 requirements, 6 scenarios) · archived change · code |
| 6 | The propose prompt | Typed prompt (Illustration) |
| 7 | Review the plan | proposal · specs · design (none) · tasks (5 in 3 groups) |
| 8 | 02 · The delta spec | Divider |
| 9 | How MODIFIED works | Copy the block, match the header (Illustration) |
| 10 | The ripple | 50.00 to 40.00, the 42.00 scenario (Illustration) |
| 11 | The delta, by the numbers | 3 MODIFIED · 6 scenarios · 3 changed (Illustration) |
| 12 | What OpenSpec checks | Omitted scenario · header mismatch (Illustration) |
| 13 | And REMOVED? | Reason and Migration |
| 14 | Before you build | Validate → Diff → Commit → Clear → Apply |
| 15 | 03 · Apply, verify, archive | Divider |
| 16 | Five tasks, three groups | 2 · 1 · 2 |
| 17 | Apply | Typed commands (Illustration) |
| 18 | Verify the change | Tests and browser (Illustration) |
| 19 | Check it in the browser | Playwright prompt (Illustration) |
| 20 | Archive | Check · Sync · Replace · Move |
| 21 | The record now | Main spec · two archived changes · git |
| 22 | Quote | Change one number, read every scenario |
| 23 | Recap | |
| 24 | Next | Episode 26 · GitHub Integration |

---

## Sources
- OpenSpec 1.14.1: https://github.com/Fission-AI/OpenSpec (docs/concepts.md, docs/editing-changes.md, docs/workflows.md, docs/commands.md; schemas/spec-driven/schema.yaml; src/cli/index.ts)
- Claude Code: https://code.claude.com/docs/en/commands (/clear)
- Playwright MCP: https://github.com/microsoft/playwright-mcp
- Course: Episode 22 (day23-ep22-script.md), Episode 24 (day25-ep24-script.md).
