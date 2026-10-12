# Day 8 · Episode 7: The Core Workflow and Planning

**Series:** Agentic Engineering (free YouTube course) · Week 2: Workflow (first episode of Week 2)
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 15:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 4 lessons):** (1) Why Workflow · (2) The Loop · (3) Defining a Plan

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. Every terminal view in this episode is a **drawn terminal graphic** labelled "Illustration", not a screen recording. The worked-example plan is written for this course as an example of a good plan; it is not output captured from Claude. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:35 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:35–1:05 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:05–3:30 | [VOICEOVER + SLIDE] | Part 1 · Why workflow | Lesson 1 |
| 3:30–7:15 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · The loop: explore, plan, implement, verify, commit | Lesson 2 |
| 7:15–11:15 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Defining a plan: contents, review, PLAN.md, sizing | Lesson 3 |
| 11:15–14:00 | [VOICEOVER + SCREEN] | Worked example: discount code expiry | Lesson 3 |
| 14:00–15:00 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:35 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode closed week one. We learned to control context with clear, compact, and rewind, and to write prompts with a goal, context, constraints, and a way to verify.
> Week two is about turning all of that into a workflow: the same steps, in the same order, on every task that matters. And the step that decides most of the outcome happens before Claude writes a single line of code. It's the plan.

**Visual / B-roll:**
- "Week 1, done" slide from Episode 6 slides away; a new "Week 2: Workflow" card slides in. Cut to the title card.

---

### 0:35–1:05 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: title slide*
> Welcome back to Agentic Engineering. I'm Sahinur Islam, a full-stack software engineer, and this is episode seven: the core workflow and planning.

*Cue: agenda slide*
> Four parts today. Why a workflow beats ad hoc prompting. The loop itself: explore, plan, implement, verify, and commit. What makes a good plan, and how to review it, save it, and size it. And then a full worked example: a plan for a new feature on our cart project.

**Visual / B-roll:**
- Title slide: "The Core Workflow and Planning", "Agentic Engineering · Episode 7".
- Agenda: 01 Why workflow · 02 The loop · 03 A good plan · 04 Worked example.

---

### 1:05–3:30 · Part 1: Why workflow
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: divider "01 · Why workflow"*
> Part one. Why a workflow at all?

*Cue: slide "Ad hoc vs a workflow"*
> Here's what ad hoc prompting looks like. You have a task, you type it in, and Claude starts coding right away. Sometimes that's great. But on anything bigger than a small fix, a few things tend to happen. Claude solves a slightly different problem than the one you meant. It makes decisions you didn't know were open. And you find out at the end, looking at a large diff you now have to untangle.
> Anthropic's best practices guide says it directly: letting Claude jump straight to coding can produce code that solves the wrong problem.
> A workflow is the opposite. It's the same steps every time: understand first, decide what to do, build it, prove it works, and save it. Nothing clever. Just repeatable.
> Picture this on the cart project. I type: add expiry dates to discount codes. Claude picks a date format, decides what happens on the expiry day, maybe adds a date library, and edits three files. Every one of those choices might be reasonable. But I didn't make any of them, and now I'm reviewing decisions instead of code. With a workflow, those same choices come up in a plan, one screen long, before anything is written.

*Cue: slide "Three things a workflow buys you"*
> That repeatability buys you three things.
> The right problem. Exploring and planning before code means misunderstandings show up in a plan, where they're cheap to fix, not in code, where they're expensive.
> Reviewable work. When the change follows a plan you approved, the diff holds no surprises. You're checking it against something you already agreed to.
> And verifiable work. A workflow always ends with a check, like tests that pass, so "done" means proven, not just "looks done".
> And there's a bonus: a workflow is what lets you trust Claude with bigger tasks. Not because the model got smarter, but because the process catches mistakes early.

**Visual / B-roll:**
- Divider: big "01", "Why workflow".
- Two-column slide: **Ad hoc** (straight to code · wrong problem, solved well · surprise diff) vs **Workflow** (same steps every time · problems caught early · nothing to untangle); coral card "Routine beats clever".
- Three coral squares: **Right problem** · **Reviewable** · **Verifiable**.

---

### 3:30–7:15 · Part 2: The loop
**Marker:** [VOICEOVER + SLIDE] (with drawn terminal graphics)

**Say:**

*Cue: divider "02 · The loop"*
> Part two. The loop.

*Cue: slide "The core loop"*
> Anthropic's best practices recommend a workflow in four phases: explore, plan, implement, and commit. I split one more step out of implement and give it its own name, because it's the one people skip: verify. So the loop I use is explore, plan, implement, verify, commit. And if verification fails, you go back to implement, not forward to commit.

*Cue: slide "Explore, then plan"*
> Explore and plan both happen in plan mode. Press Shift plus Tab until the status bar says plan mode, or start the session with claude dash dash permission mode plan. In plan mode, Claude reads files and answers questions, but it doesn't edit your source.
> Explore is about understanding. The docs' example is a prompt like: read the auth folder and understand how we handle sessions and login. For us, it might be: read src slash discounts dot J S and the tests, and explain how discount codes are applied. Ask questions until you're both clear on how the code works today.
> Then plan. Ask for a detailed implementation plan: I want to add expiry dates to discount codes. What files need to change? Create a plan.
> Notice that I asked Claude to research before planning. A plan written without reading the code is a guess with numbered steps.

*Cue: slide "Implement, verify, commit"*
> Implement. When the plan is right, approve it, or press Shift plus Tab to leave plan mode, and let Claude build it, checking its work against the plan. A good implementation prompt names the check: implement the plan, write tests for the new behaviour, run the test suite, and fix any failures.
> Verify. This is the step that turns "looks done" into "done". The tests run, and then you look at the evidence yourself: the test output, and the diff. If something fails, you're back in implement. A second opinion helps here too; slash code review checks the current diff for bugs in a fresh context.
> Commit. Ask Claude to commit with a descriptive message, and open a pull request if that's how your team works. The commit is your save point before the next loop.

*Cue: slide "Plan it, or skip it?"*
> Now, an honest caveat from the docs: plan mode is useful, but it adds overhead. For a small, clear change, like fixing a typo, adding a log line, or renaming a variable, just ask Claude to do it directly.
> The docs give a great rule of thumb: if you could describe the diff in one sentence, skip the plan. Planning pays off when you're not sure about the approach, when the change touches several files, or when you don't know the code well.

**Visual / B-roll:**
- Divider: big "02", "The loop".
- Loop flow: Explore (black) → Plan → Implement → Verify → Commit (coral); return arrow "Verify fails? Back to implement".
- "Explore, then plan" slide: white card (Explore: read and ask · Plan: files, steps, a plan), dark terminal (Illustration) with the two prompts, coral column "No source edits until you approve".
- "Implement, verify, commit": two points and a terminal strip: `implement the plan. write tests, run npm test, fix failures` · `/code-review` · `commit with a descriptive message`.
- "Plan it, or skip it?": black panel "Plan it: unsure approach · Plan it: many files · Skip it: one-sentence diff".

---

### 7:15–11:15 · Part 3: Defining a plan
**Marker:** [VOICEOVER + SLIDE] (with drawn terminal graphics)

**Say:**

*Cue: divider "03 · Defining a plan"*
> Part three. Defining a good plan.

*Cue: drawn PLAN.md skeleton*
> So what goes into a plan? Here's the structure I ask for, every time. Six parts.
> Goal: what's true when we're done, in a sentence or two.
> Out of scope: what we're deliberately not doing. This one is underrated. It stops the change from growing.
> Files to touch: which files change, and which new ones get created.
> Steps: the order of the work, small enough that each one can be checked.
> Risks: edge cases, open questions, anything that could break existing behaviour.
> And verify: exactly how we'll know it works, the tests to add and the commands to run.
> This lines up with what Anthropic's guide says about good specs: they're self-contained, they name the files and interfaces involved, they state what's out of scope, and they end with an end-to-end verification step.
> Compare that with a weak plan. Step one: update the discount logic. Step two: add tests. Step three: make sure everything works. Every line is true, and none of it helps. It doesn't say which file, what the new behaviour is, which tests, or what could break. If you can't tell from a plan what the diff will roughly look like, the plan isn't done yet.

*Cue: slide "Review the plan"*
> When Claude presents the plan, it asks how to proceed: approve it and continue, or say no and keep planning. Don't approve on autopilot. Read it like a pull request from a teammate.
> Check the files: is it touching something it shouldn't? Check the steps: are they in a sensible order? Check the risks: did it notice the edge case you know about? And check the scope: did it quietly add work you didn't ask for?
> If something's off, choose to keep planning and tell Claude what to change. Or, for direct edits, press Control plus G, and the plan opens in your text editor. Fix it there, save, and Claude continues with your version.

*Cue: slide "Save it: PLAN.md"*
> Here's a habit that makes plans much more useful: write the plan to a file. Once it's approved, ask Claude to save it to a markdown file like PLAN dot M D.
> Why? Because a plan in the conversation lives in the context window. Clear the context, and it's gone. A plan in a file survives slash clear. So you can plan in one session, clear, and start implementation in a fresh session with clean context, just by pointing at the file: implement step one of at PLAN dot M D.
> The docs describe the same pattern for larger features: write a complete spec to a file, then start a fresh session to execute it, so the new session has clean context focused entirely on implementation. A file on disk is also something you can review later, in a pull request or against the final diff.
> For bigger features, there's a nice way to write that spec: ask Claude to interview you first. The docs suggest a prompt like: I want to build this feature, interview me in detail using the ask user question tool. Claude asks about the edge cases and tradeoffs you hadn't thought of, and then writes the spec.

*Cue: slide "Size the task"*
> The last planning skill is sizing. I think of tasks in three sizes.
> Small: you could describe the diff in one sentence. Skip the plan and just ask.
> Medium: a few files, a clear goal. Plan mode, review the plan, implement in the same session.
> Large: many files, real unknowns. Write PLAN dot M D, and take it one step per loop: implement a step, verify it, commit it, and clear before the next one.
> If a plan has more steps than you can comfortably review in one sitting, that's your signal to split the work into separate tasks.

**Visual / B-roll:**
- Divider: big "03", "Defining a plan".
- Monitor terminal (Illustration): a PLAN.md skeleton with six headings: `## Goal` · `## Out of scope` · `## Files to touch` · `## Steps` · `## Risks` · `## Verify`.
- "Review the plan" slide: plan-approval prompt with "No, keep planning" highlighted; boxes "Check: files, steps, risks, scope" and "Ctrl+G: edit in your editor".
- "Save it" slide: two points (Write it to a file · Fresh session, same plan) and a terminal strip: `> save the approved plan to PLAN.md` · `/clear` · `> implement step 1 of @PLAN.md`.
- Sizing slide: three coral squares, **Small** (one-sentence diff: just ask) · **Medium** (plan mode, one session) · **Large** (PLAN.md, one step per loop).

---

### 11:15–14:00 · Worked example: discount code expiry
**Marker:** [VOICEOVER + SCREEN] (drawn plan graphics)

**Say:**

*Cue: slide "Worked example"*
> Let's put it all together with a full example on the cart project. The feature: discount codes can have an expiry date, and an expired code is rejected.
> I start in plan mode and explore first: read src slash discounts dot J S and the discount tests, and explain how codes are looked up and applied. Then I ask for the plan in my six-part structure. Once I've reviewed and approved it, Claude saves it to PLAN dot M D. Here's what a good version of that plan looks like.

*Cue: slide "PLAN.md: goal, files, steps"*
> Goal: an expired discount code is rejected, and codes without an expiry date keep working exactly as before.
> Out of scope: the cart file, gift cards, any user interface, and changes to the existing codes.
> Files to touch: src slash discounts dot J S, for the data and the check, and test slash discounts dot test dot J S, for the new tests.
> Steps. One: add an optional expiry date to the discount entries. Two: when a code is applied, reject it if the expiry date has passed. Three: add tests. Four: run N P M test. Five: review the diff, and commit.
> When I reviewed the first version of a plan like this, the kind of thing I look for is scope creep: say it also proposed showing a message in the cart when a code expires. Reasonable idea, but not this task. So I keep planning, ask Claude to drop it, and it moves to out of scope. That one edit keeps the diff small and reviewable.
> And the risks. The big one is time: what does "expired" mean on the expiry day itself? Is a code that expires today still valid? And whose clock decides? Those are product decisions, so I make them in the plan, not in the code. In this example, I decide: a code stays valid through the end of its expiry date. I also decide to pass the current date into the check, so the tests can control it instead of depending on the real clock.

*Cue: slide "PLAN.md: how to verify"*
> And verification. Four checks, written down before any code exists.
> One: a valid code with a future expiry date still applies.
> Two: an expired code is rejected.
> Three: a code on its expiry day still applies, because that's what we decided.
> Four: all the existing tests still pass, so codes without an expiry behave exactly as before.
> Now look at what we have. Every important decision is made. The scope is fenced. And we know exactly how to prove it works. Executing that plan is the next episode.

**Visual / B-roll:**
- Worked example slide (two columns): **The request** (codes can expire · expired codes are rejected · existing codes unchanged) vs **The process** (plan mode · explore first · six-part plan · save to PLAN.md); coral card "Plan first, code later".
- PLAN.md slide (card / terminal / coral, Illustration): Goal card; Files and Out of scope list; terminal with Steps 1–5; coral column "Risks: the expiry day itself. Decide it in the plan."
- Verify slide: four numbered checks: 01 Future expiry applies · 02 Expired is rejected · 03 Expiry day applies · 04 Old tests pass.

---

### 14:00–15:00 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: quote slide*
> Here's the mental model: a plan is cheap to change, and code is not. So make the decisions where they're cheap.

*Cue: recap slide*
> Quick recap. A workflow beats ad hoc prompting because it catches the wrong problem early, keeps work reviewable, and ends with proof. The loop is explore, plan, implement, verify, commit. A good plan has a goal, what's out of scope, the files, the steps, the risks, and how to verify. Review it before you approve, edit it with Control plus G, save it to PLAN dot M D so it survives a clear, and size the task before you start.

*Cue: next-episode slide*
> We have a plan. Next in the playlist is episode eight: executing the plan, where we take this exact PLAN dot M D and build it, step by step. Subscribe and turn on notifications for the playlist so you don't miss it.

**Visual / B-roll:**
- Quote slide: "A plan is cheap to change. Code is not. Make the decisions where they're cheap."
- Recap slide, three items: 01 Why workflow · 02 The loop · 03 A good plan.
- End screen: "Next: Ep 8 · Executing the Plan", playlist tile, subscribe element.

---

## Production notes
- Spoken word count is about 2,100 words, roughly 14 to 15 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and plan is a drawn graphic labelled "Illustration". The PLAN.md shown is an example written for the course, not captured model output; Claude's real plans will differ in wording and detail.
- The docs describe four phases (explore, plan, implement, commit) and put verification inside implement plus a separate "give Claude a way to verify" section. The narration says plainly that splitting verify into its own step is my choice.
- Plan mode blocks source edits, so PLAN.md is written after the plan is approved (as an edit you approve), not during planning.
- The plan-approval option names follow the permission-modes docs ("No, keep planning"); the approve options vary by setup, so the narration keeps them generic.
- The expiry-day rule ("valid through the end of the expiry date") and passing in the current date are design decisions made for the example, not facts about any library.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. The Core Workflow for AI Coding Agents: Explore, Plan, Implement, Verify, Commit (Agentic Engineering Ep 7)
2. How to Write a Good Plan for Claude Code (with a Full PLAN.md Example) | Agentic Engineering Ep 7
3. Stop Prompting Ad Hoc: The Claude Code Planning Workflow | Ep 7

### Description
```
Episode 7 of Agentic Engineering, a free course on building real software with AI coding agents. Week 2 starts here.

In this episode: why a repeatable workflow beats ad hoc prompting; the core loop from Anthropic's best practices (explore, plan, implement, commit), with verify as its own step; and how to define a good plan in depth: plan mode, asking Claude to research first, what a good plan contains (goal, out of scope, files to touch, steps, risks, how to verify), reviewing the plan and editing it with Ctrl+G, saving it to PLAN.md so it survives /clear, and sizing tasks. Then a full worked example: a plan for discount code expiry dates on a small Node.js cart project.

Note: terminal screens and the example plan are drawn illustrations written for the course, not recordings.

Chapters:
0:00 Week 2: from prompts to a workflow
0:35 Intro and what we'll cover
1:05 Why a workflow beats ad hoc prompting
3:30 The loop: explore, plan, implement, verify, commit
7:15 Defining a good plan
11:15 Worked example: discount code expiry
14:00 Recap and next episode

Official docs:
Best practices: https://code.claude.com/docs/en/best-practices
Permission modes (plan mode): https://code.claude.com/docs/en/permission-modes
Commands: https://code.claude.com/docs/en/commands

Next in the playlist: Ep 8 · Executing the Plan

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, claude code plan mode, claude code workflow, explore plan code commit, ai coding workflow, plan.md, writing a plan for ai, claude code planning, agentic coding workflow, ai coding agent, spec driven development, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"PLAN FIRST"**, small line: **"explore → plan → build → verify → commit"**.
Visual: a PLAN.md card with six coral headings (Goal · Out of scope · Files · Steps · Risks · Verify) next to a small loop diagram. "EP 7" badge.

---

## Suggested slide list (Episode 7 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | The Core Workflow and Planning | Agentic Engineering · Episode 7 |
| 2 | Today | 01 Why workflow · 02 The loop · 03 A good plan · 04 Worked example |
| 3 | 01 · Why workflow | Repeatable beats ad hoc |
| 4 | Ad hoc vs a workflow | Straight to code vs the same steps every time |
| 5 | What a workflow buys you | Right problem · Reviewable · Verifiable |
| 6 | 02 · The loop | Explore, plan, implement, verify, commit |
| 7 | The core loop | Explore → Plan → Implement → Verify → Commit; fails? back to implement |
| 8 | Explore, then plan | Plan mode; research first; ask for a plan |
| 9 | Implement, verify, commit | Name the check; read the evidence; commit |
| 10 | Plan it, or skip it? | Unsure / many files: plan · one-sentence diff: skip |
| 11 | 03 · Defining a plan | What goes in, how to review it |
| 12 | What goes in a plan | Goal · Out of scope · Files · Steps · Risks · Verify |
| 13 | Review the plan | Read it like a PR; keep planning; Ctrl+G |
| 14 | Save it: PLAN.md | Survives /clear; fresh session with @PLAN.md; interview for big features |
| 15 | Size the task | Small · Medium · Large |
| 16 | Worked example | Discount code expiry: the request and the process |
| 17 | PLAN.md: goal, files, steps | Steps 1–5; risk: the expiry day itself |
| 18 | PLAN.md: how to verify | Future expiry · expired · expiry day · old tests |
| 19 | The mental model | "A plan is cheap to change. Code is not." |
| 20 | Recap | Why workflow · The loop · A good plan |
| 21 | Next: Executing the Plan | Episode 8 |

## Sources
- Best practices: https://code.claude.com/docs/en/best-practices ("Explore first, then plan, then code": letting Claude jump straight to coding can solve the wrong problem; the four phases explore, plan, implement, commit with the example prompts; Ctrl+G to edit the plan; switch out of plan mode by approving or Shift+Tab; "commit with a descriptive message and open a PR"; plan mode adds overhead, skip it for small clear changes and when the diff fits in one sentence; planning is most useful when unsure, multi-file, or unfamiliar; give Claude a way to verify; let Claude interview you with AskUserQuestion and write SPEC.md, then a fresh session to execute it; good specs name files and interfaces, state what is out of scope, end with an end-to-end verification step; reviewing a diff against PLAN.md; `/code-review`).
- Permission modes: https://code.claude.com/docs/en/permission-modes (plan mode reads and plans without editing source; `claude --permission-mode plan`; Shift+Tab or `/plan`; approval prompt incl. "No, keep planning"; Ctrl+G opens the plan in your editor; approving exits plan mode).
- Commands: https://code.claude.com/docs/en/commands (`/plan`, `/clear`, `/code-review`).
- Episode 6 reference: /workspace/agentic-course/day07-ep06-script.md.
