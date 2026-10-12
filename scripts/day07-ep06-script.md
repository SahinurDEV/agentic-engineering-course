# Day 7 · Episode 6: Controlling Context and Writing Good Prompts

**Series:** Agentic Engineering (free YouTube course) · Week 1: Foundations (final episode of Week 1)
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 13:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 3 lessons):** (1) Controlling Context · (2) Good and Bad Prompts

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. Every terminal view in this episode is a **drawn terminal graphic** labelled "Illustration", not a screen recording. Menus and prompts on those screens are simplified. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:00–6:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Controlling context: /clear vs /compact, /rewind, /resume, subagents, trimming MCP | Lesson 1 |
| 6:00–11:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Good and bad prompts: four before/after pairs, a template, anti-patterns | Lesson 2 |
| 11:30–13:00 | [VOICEOVER + SLIDE] | Mental model, recap, Week 1 wrap-up + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> In episode five, we looked at what fills Claude's context window, why quality drops as it fills, and six habits for filling it well.
> Today we take control of it on purpose: when to clear, when to compact, how to go back in time. And then the other half of the same skill: writing prompts that put the right things into context in the first place.

**Visual / B-roll:**
- Callback to the Episode 5 "What fills it" flow, then the bar empties as `/clear` appears. Cut to the title card.

---

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: title slide*
> Welcome back to Agentic Engineering. I'm Sahinur Islam, a full-stack software engineer, and this is episode six: controlling context and writing good prompts.

*Cue: agenda slide*
> Four parts. First, clear versus compact. Second, rewinding, resuming, and a first look at subagents. Third, good and bad prompts, with real before and after pairs on our cart project. And fourth, a simple prompt template you can use on any task.

**Visual / B-roll:**
- Title slide: "Controlling Context and Writing Good Prompts", "Agentic Engineering · Episode 6".
- Agenda: 01 Clear or compact · 02 Rewind, resume, subagents · 03 Good vs bad prompts · 04 A prompt template.

---

### 1:00–6:00 · Part 1: Controlling context
**Marker:** [VOICEOVER + SLIDE] (with drawn terminal graphics)

**Say:**

*Cue: divider "01 · Controlling context"*
> Part one. Controlling context.

*Cue: slide "Three moves"*
> Last episode was about what goes into the context window. This one is about the moves you make when it's time to change what's in there. There are three basic ones. Clear, to start over with nothing. Compact, to keep a summary and drop the details. And rewind, to go back to an earlier point.

*Cue: slide "Clear or compact?"*
> Clear and compact sound similar, but they answer different questions.
> Slash clear starts a new conversation with an empty context. Use it when the next task is unrelated to the last one. It's also free: Anthropic's cost guide points out that when you want a fresh start instead of continuity, slash clear costs nothing. And the old conversation isn't deleted. A good habit from the docs: run slash rename first, give the session a name, so you can find it later with slash resume.
> Slash compact keeps you in the same conversation, but replaces the history with a summary. Use it when you're still on the same task and the session has gotten long. One thing to know: compacting has to read the conversation it summarizes, so on a big context, the compact itself is a big request.
> My rule: new task, clear. Same task, long session, compact.

*Cue: slide "Compact with a focus"*
> Compact gets much better when you tell it what matters. Claude Code compacts automatically as you approach the limit, but then it has to guess what's important. When you run it yourself, you can add instructions, like: slash compact, focus on the discount rules and the failing test.
> You can also make that permanent. Add a section to your CLAUDE dot M D called compact instructions, and write what should survive, for example: focus on test output and code changes. Now every compaction keeps what you care about.

*Cue: slide "Rewind to a checkpoint"*
> Move three: rewind. Every prompt you send creates a checkpoint, and Claude Code snapshots files before it edits them. Press Escape twice on an empty prompt, or type slash rewind, and you get a list of your earlier prompts.
> Pick one, and you can restore the code and the conversation, just the conversation, or just the code. So if an approach goes sideways, you don't argue with it for ten messages. You rewind to before it started and try a better prompt.
> There are also two summarize options in that menu, summarize from here and summarize up to here, which work like a targeted compact on part of the conversation.
> Two limits to remember. Checkpoints only track edits made through Claude's file editing tools, not files changed by shell commands. And they're not a replacement for git. Commit the things you want to keep.

*Cue: drawn terminal, resume and continue*
> Sessions also outlive your terminal. Claude Code saves conversations locally. Claude dash dash continue picks up the most recent conversation in this folder. Claude dash dash resume, or slash resume inside a session, opens a picker so you can choose one, which is where those slash rename names pay off.
> And if you want to try a different direction without losing where you are, slash branch creates a branch of the current conversation, and you can get back to the original with slash resume.

*Cue: slide "Subagents keep your context clean"*
> Now a first look at a bigger tool: subagents. A subagent is a separate assistant that works in its own context window. When a side task would flood your conversation with search results, logs, or file contents you won't need again, a subagent can do that work in its own context, and only a summary comes back to yours.
> You can ask for it in plain language, like: use a subagent to investigate how discounts are applied across the project. Your main context stays clean for the actual change. We'll build our own subagents in episodes twelve and thirteen.

*Cue: slide "Trim what loads"*
> One last control: things that load whether you use them or not. If you've connected M C P servers, which are external tool integrations, their tool names and server instructions take up context even before Claude uses them. Run slash context to see the cost, and slash M C P to see your configured servers and disable the ones you're not actively using.
> The docs also suggest preferring command line tools like the GitHub C L I when they exist, because they don't add a listing of tools to your context at all.

**Visual / B-roll:**
- Divider: big "01", "Controlling context".
- "Three moves": three coral squares, **Clear** (start over, empty) · **Compact** (keep a summary) · **Rewind** (back to a checkpoint).
- "Clear or compact?": two columns (/clear: new task · empty context · costs nothing · /rename first; /compact: same task · keeps a summary · add a focus · a large request itself) and a coral card "New task: clear. Same task: compact."
- "Compact with a focus": two points and a terminal strip with `/compact focus on the discount rules and the failing test` and a CLAUDE.md snippet `# Compact instructions`.
- "Rewind" slide: rewind-menu illustration with the options Restore code and conversation · Restore conversation · Restore code · Summarize from here · Never mind.
- Monitor terminal (Illustration): `claude --continue`, `claude --resume`, `/rename discount-work`, `/resume`, `/branch`.
- Subagent flow: Main session → Delegate → Subagent reads (its own context) → Summary → Main stays clean; label "Deeper in Episodes 12 and 13".
- "Trim what loads": black panel `/mcp · disable unused · CLI tools · over MCP`.

---

### 6:00–11:30 · Part 2: Good and bad prompts
**Marker:** [VOICEOVER + SLIDE] (with drawn prompt graphics)

**Say:**

*Cue: divider "02 · Good and bad prompts"*
> Part two. Good and bad prompts. Controlling context is about what you remove. Prompting is about what you put in. Let's do four before and after pairs, all on the cart project from episode one.

*Cue: slide "Pair 1: vague vs specific"*
> Pair one: vague versus specific. Before: fix the discount bug.
> Claude has to guess which bug, where, and what "fixed" means. After: SAVE ten gives the wrong total for odd amounts, for example nineteen ninety-nine cents. Look at the apply discount function in at src slash discounts dot J S. Write a failing test that reproduces it, then fix it.
> That follows a pattern straight from Anthropic's best practices: describe the symptom, the likely location, and what fixed looks like.

*Cue: slide "Pair 2: no check vs with tests"*
> Pair two: no verification versus a check it can run. Before: add a SAVE twenty code.
> It'll probably write something plausible, and then stop when it looks done. After: add a SAVE twenty code for twenty percent off. Add tests for a normal cart, an empty cart, and a total smaller than the discount. Run N P M test and fix any failures.
> The docs are blunt about why: without a check it can run, "looks done" is the only signal Claude has, and you become the verification loop. With tests, Claude does the work, runs the check, reads the result, and keeps going until it passes.

*Cue: slide "Pair 3: too big vs scoped"*
> Pair three: too big versus scoped. Before: add coupons, gift cards, and a loyalty points system.
> That's three features, several files, and a lot of decisions you haven't made yet. Claude will make them for you, all at once, and the diff will be too big to review properly. After: add an expiry date to discount codes, so an expired code is rejected. Discounts file only. Gift cards come later.
> And when a change really is big, don't cram it into one prompt. Start in plan mode, get a plan, and work through it one step at a time. The flip side, also from the docs: if you could describe the diff in one sentence, skip the plan and just ask.

*Cue: slide "Pair 4: no constraints vs patterns"*
> Pair four: no constraints versus patterns to follow. Before: add a free shipping code.
> Claude might invent a new structure, add a library, or put the logic in the cart file. After: add a free shipping code. Follow the pattern of the existing codes in the discounts map in discounts dot J S. Keep amounts in cents. No new dependencies. Totals never go below zero.
> Pointing at an existing pattern is one of the highest-value things you can write. It's one file read, and it saves Claude from guessing your conventions.

*Cue: slide "A prompt template"*
> If you look at the good versions, they share the same four parts. I use them as a template.
> Goal: what should be true when this is done. Context: the files, the symptom, the error, the existing pattern. Constraints: what it must not do, and the rules it has to follow. Verification: how Claude should check its own work, usually the tests.
> You don't need headings in every prompt. For a small fix it's one sentence each. But if one of the four is missing, that's usually where things go wrong.

*Cue: drawn terminal, the template filled in*
> Here's the template filled in for the expiry feature. Goal: expired discount codes are rejected. Context: the discount codes live in the discounts map in discounts dot J S, and the existing tests are in the test folder. Constraints: follow the existing pattern, no new dependencies, don't change the cart file. Verification: add tests for a valid code, an expired code, and a code that expires today, then run N P M test.
> That's four short lines, and almost every decision that matters is already made.

*Cue: slide "Anti-patterns"*
> Finally, the anti-patterns. These are the ones I see most, and most of them are named in Anthropic's own guide.
> The kitchen sink session: one task, then something unrelated, then back again, until the context is full of noise. Fix: slash clear between tasks.
> The correction loop: you correct Claude, it's still wrong, you correct it again. Fix: after two failed corrections, clear, and write a better first prompt with what you learned.
> Trust without verification: a plausible-looking change that doesn't handle the edge cases. Fix: always give it a way to check its work.
> And the unscoped investigation: "investigate this" with no boundaries, and Claude reads hundreds of files. Fix: scope it, or hand it to a subagent.
> One fair caveat: vague prompts aren't always wrong. When you're exploring, something like "what would you improve in this file?" can surface ideas you wouldn't have thought to ask about. Just be vague on purpose, not by accident.

**Visual / B-roll:**
- Divider: big "02", "Good and bad prompts".
- Pair 1 (two columns + card): Before (grey) vs After (bold); card "Symptom, location, what fixed looks like".
- Pair 2 (two points + terminal): Before / After, terminal strip with the full "after" prompt.
- Pair 3 (card / terminal / coral): Before card, a numbered scoped plan, terminal `/plan add an expiry date…` (Illustration), coral column "One prompt, one change".
- Pair 4 (plan layout): the "after" prompt in the terminal; points "Point at the pattern" and "State the limits".
- Template: four numbered columns, 01 Goal · 02 Context · 03 Constraints · 04 Verification.
- Filled template on the monitor terminal (Illustration), with the four labels in coral.
- Anti-patterns: black panel listing Kitchen sink · Correction loop · No verification · Unscoped search.

---

### 11:30–13:00 · Mental model, recap, Week 1 wrap-up + CTA
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: quote slide*
> Here's the mental model for both halves of today: a good prompt decides what goes into context, and clear, compact, and rewind decide what stays.

*Cue: recap slide*
> Quick recap. Clear for a new task, compact with a focus for a long one, and rewind when an approach goes sideways. Resume and continue bring sessions back, and subagents keep big side tasks out of your context. For prompts: be specific, give it a check, keep the scope small, and point at the patterns to follow. Goal, context, constraints, verification.

*Cue: Week 1 slide*
> And that wraps up week one. We started with what an AI coding agent is, met Claude Code and how it works, learned its controls, walked through a real session, and today and last time, learned to manage context and write prompts that work. That's the foundation everything else in this course builds on.

*Cue: next-episode slide*
> Week two starts with workflow. Next in the playlist is episode seven: the core workflow and planning, where we turn all of this into a repeatable way of working. Subscribe and turn on notifications for the playlist so you don't miss it.

**Visual / B-roll:**
- Quote slide: "A good prompt decides what goes into context. Clear, compact, and rewind decide what stays."
- Recap slide, three items: 01 Clear, compact, rewind · 02 Resume and subagents · 03 Goal, context, constraints, verification.
- Week 1 flow: Agents → Claude Code → Controls → A session → Context and prompts; label "Next: Week 2, the core workflow".
- End screen: "Next: Ep 7 · The Core Workflow and Planning", playlist tile, subscribe element.

---

## Production notes
- Spoken word count is about 1,800 words, roughly 12:30 to 13:00 at a steady TTS pace with slide pauses.
- No recording: every terminal and menu is a drawn graphic labelled "Illustration". The rewind-menu option names follow the checkpointing docs; layout is simplified.
- The before/after prompts are written for this course; they are not quotes from the docs. The two framings that do come from Anthropic's best practices ("symptom, likely location, what fixed looks like"; "looks done is the only signal") are attributed in narration and paraphrased.
- "Costs nothing" for `/clear` and "compacting a large context is itself a large request" come from the costs and prompt-caching docs; keep them as stated, no numbers.
- Subagents are only introduced here; Episodes 12 and 13 build them.
- "Nineteen ninety-nine cents" = 1999 cents in the example; show `1999` on screen.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Controlling Context and Writing Good Prompts in Claude Code (Agentic Engineering Ep 6)
2. /clear vs /compact, Rewind, and 4 Before-and-After Prompts for Claude Code | Agentic Engineering Ep 6
3. Bad Prompts vs Good Prompts for AI Coding Agents: A Simple Template | Ep 6

### Description
```
Episode 6 of Agentic Engineering, a free course on building real software with AI coding agents. This episode wraps up Week 1.

Part one is about controlling context on purpose: /clear vs /compact (and when each one fits), compacting with focus instructions and "Compact instructions" in CLAUDE.md, rewinding to a checkpoint with Esc Esc or /rewind, picking sessions back up with claude --continue, claude --resume, /rename and /branch, a first look at subagents for keeping your main context clean, and trimming unused MCP servers with /mcp.

Part two is good vs bad prompts: four before-and-after pairs on a small Node.js cart project (vague vs specific, no check vs with tests, too big vs scoped, no constraints vs patterns to follow), a four-part prompt template (goal, context, constraints, verification), and the anti-patterns to avoid.

Note: terminal screens are drawn illustrations, not recordings.

Chapters:
0:00 Taking control of context
0:30 Intro and what we'll cover
1:00 Controlling context: clear, compact, rewind, resume, subagents
6:00 Good and bad prompts: four before-and-after pairs
11:30 Recap, Week 1 wrap-up and next episode

Official docs:
Best practices: https://code.claude.com/docs/en/best-practices
Manage costs effectively: https://code.claude.com/docs/en/costs
Explore the context window: https://code.claude.com/docs/en/context-window
Checkpointing: https://code.claude.com/docs/en/checkpointing
Commands: https://code.claude.com/docs/en/commands
Subagents: https://code.claude.com/docs/en/sub-agents

Next in the playlist: Ep 7 · The Core Workflow and Planning

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, claude code context, claude code /compact, claude code /clear, claude code rewind, claude code checkpoints, claude code resume, claude code subagents, claude code mcp, prompt engineering, prompts for coding agents, good prompts vs bad prompts, ai coding prompts, agentic coding, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"BAD PROMPT → GOOD PROMPT"**, small line: **"+ /clear vs /compact"**.
Visual: left, a grey card "fix the discount bug" with a red ✗; right, a white card with four coral labels (Goal · Context · Constraints · Verify) and a green ✓. "EP 6" badge.

---

## Suggested slide list (Episode 6 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Controlling Context and Writing Good Prompts | Agentic Engineering · Episode 6 |
| 2 | Today | 01 Clear or compact · 02 Rewind, resume, subagents · 03 Good vs bad prompts · 04 A prompt template |
| 3 | 01 · Controlling context | Decide what stays |
| 4 | Three moves | Clear · Compact · Rewind |
| 5 | Clear or compact? | New task: clear (free, /rename first) · same task: compact (summary, large request) |
| 6 | Compact with a focus | /compact focus … · "Compact instructions" in CLAUDE.md |
| 7 | Rewind to a checkpoint | Esc Esc or /rewind; restore code / conversation / both; summarize; limits |
| 8 | Pick it back up | --continue · --resume · /rename · /resume · /branch |
| 9 | Subagents keep it clean | Delegate → own context → summary back; Episodes 12–13 |
| 10 | Trim what loads | /mcp disable unused servers; prefer CLI tools |
| 11 | 02 · Good and bad prompts | Decide what goes in |
| 12 | Pair 1: vague vs specific | Symptom, location, what fixed looks like |
| 13 | Pair 2: add a check | Tests named, run npm test, fix failures |
| 14 | Pair 3: scope it | One feature at a time; plan big changes |
| 15 | Pair 4: patterns and limits | Follow the discounts map; cents; no new deps |
| 16 | A prompt template | Goal · Context · Constraints · Verification |
| 17 | The template, filled in | Expiry-date feature in four lines |
| 18 | Anti-patterns | Kitchen sink · correction loop · no verification · unscoped search |
| 19 | The mental model | "A good prompt decides what goes into context. Clear, compact, and rewind decide what stays." |
| 20 | Recap | Clear, compact, rewind · resume and subagents · the template |
| 21 | Week 1, done | Agents → Claude Code → Controls → A session → Context and prompts |
| 22 | Next: The Core Workflow and Planning | Episode 7 |

## Sources
- Best practices: https://code.claude.com/docs/en/best-practices (give Claude a way to verify; "looks done" is the only signal without a check; specific prompts: scope the task, point to sources, reference existing patterns, describe the symptom / location / what fixed looks like; skip the plan if the diff fits in one sentence; vague prompts useful when exploring; `/clear` between tasks; `/compact <focus>`; rewind and checkpoints; subagents for investigation; failure patterns: kitchen sink, correcting over and over, trust-then-verify gap, infinite exploration).
- Manage costs effectively: https://code.claude.com/docs/en/costs (`/clear` costs nothing when you want a fresh start; `/compact` reads the conversation it summarizes; `/rename` before clearing, `/resume` to return; "Compact instructions" in CLAUDE.md; disable unused MCP servers with `/mcp`; prefer CLI tools; delegate verbose operations to subagents).
- Explore the context window: https://code.claude.com/docs/en/context-window (automatic compaction near the limit; compact with a focus; summarize part of the conversation from `/rewind`; `/clear` between tasks; delegate large reads).
- Checkpointing: https://code.claude.com/docs/en/checkpointing (checkpoint per prompt; Esc twice or `/rewind`; restore code and conversation / conversation / code; summarize from here / up to here; Bash changes not tracked; not a replacement for git).
- Commands: https://code.claude.com/docs/en/commands (`/compact [instructions]`, `/rewind`, `/resume`, `/rename`, `/branch`, `/mcp … disable`).
- Subagents: https://code.claude.com/docs/en/sub-agents (own context window; returns only the summary).
- How Claude Code works: https://code.claude.com/docs/en/how-claude-code-works (`claude --continue`, `claude --resume`; sessions saved locally).
- Episode 5 reference: /workspace/agentic-course/day06-ep05-script.md.
