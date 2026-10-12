# Day 9 · Episode 8: Executing the Plan

**Series:** Agentic Engineering (free YouTube course) · Week 2: Workflow
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 11:30
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 4 lesson):** Executing the Plan

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. Every terminal view in this episode is a **drawn terminal graphic** labelled "Illustration", not a screen recording. This is an illustrated walkthrough: the prompts are written for the course, the surprise in Part 2 is a "say this happens" scenario, and no model output is shown as real. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:00–4:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Start fresh: the plan file, permission mode, one step per loop | Executing the Plan |
| 4:00–7:45 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Stay on the plan: Esc and redirects, surprises, rewind, commits | Executing the Plan |
| 7:45–10:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Long runs: when to re-plan, lean context, progress in the file | Executing the Plan |
| 10:30–11:30 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we wrote a plan. A real one, for discount code expiry dates on the cart project, saved to a file called PLAN dot M D.
> A plan on its own changes nothing. Today we run it: step by step, with the agent kept on the plan, and with you ready to steer when reality doesn't match what you wrote.

**Visual / B-roll:**
- The Episode 7 PLAN.md card slides in, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode eight: executing the plan.

*Cue: agenda slide*
> Four parts. Starting fresh from the plan file. Running it one step at a time. Staying on the plan when things go sideways. And handling long implementations without filling up your context. One honest note first: everything on screen is an illustration I drew. It's not a recording, and Claude's real replies will be worded differently.

**Visual / B-roll:**
- Agenda: 01 Start fresh · 02 Run the steps · 03 Stay on plan · 04 Long runs.

### 1:00–4:00 · Part 1: Start fresh
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Start fresh"*
> Part one. Start fresh.

*Cue: slide "Start from the file"*
> In episode seven, planning used up a lot of context. Claude read the discount code, the tests, and our back-and-forth about the expiry day. None of that conversation is needed any more, because the decisions now live in PLAN dot M D.
> So I run slash clear, and I start the new conversation by pointing at the file with the at sign. My first prompt is something like: read at PLAN dot M D, implement step one only, run N P M test, and stop when it passes.
> Two things matter in that prompt. "Step one only" keeps the work small enough to review. And "stop when it passes" gives the step a clear finish line, so Claude doesn't wander into step two before I've looked.
> Before that first prompt, I also read the plan once more with fresh eyes. If something in it already looks wrong, now is the cheapest moment to fix it: edit the file, not the code. A plan that was right yesterday can still be missing something today.

*Cue: slide "Pick a permission mode"*
> Before I hit enter, I choose a permission mode. Shift plus Tab cycles through them, and the status bar shows which one is on.
> Manual mode asks before edits and commands. That's right for sensitive code, but on a five-step plan you end up clicking through prompts instead of reading them.
> Accept edits mode lets Claude edit files in your working folder without asking, and it still asks before most other commands. For a plan I've already reviewed, that's my usual choice: edits flow, and I review the diff at the end of each step.
> Auto mode goes further. A separate classifier reviews actions in the background and blocks what looks risky. The docs suggest it for long tasks and cutting prompt fatigue, and on recent versions it's the starting mode in the terminal.
> And bypass permissions skips the checks entirely. The docs say isolated containers and virtual machines only. Not your laptop.

*Cue: slide "One step per loop"*
> Then I run the plan as a loop, one step at a time. Read the step. Implement it. Run the tests. Review the diff. Commit. Then back to the top for the next step.
> On the cart project, step one adds an optional expiry date to the discount entries. Step two rejects a code when its expiry has passed, with today's date passed in so tests can control it. Steps three and four add the tests and run them. Step five is the final review and commit.
> Each pass through the loop is small. That's the point. A small step is easy to check, easy to undo, and easy to explain in a commit message.
> Reviewing the diff doesn't mean skimming it. For step two, I check three things against the plan. Did the change stay inside the files we listed? Does it do what the step says, and nothing more? And is the expiry-day decision we made, valid through the end of that day, actually what the code does? If any answer is no, the step isn't done, even if the tests are green.

**Visual / B-roll:**
- Illustration terminal: slash clear, then the "step one only" prompt.
- Permission modes card with the Shift+Tab cycle as plain status-bar labels.
- Five-box loop: Read step → Implement → Test → Review diff → Commit.

### 4:00–7:45 · Part 2: Stay on the plan
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "02 · Stay on the plan"*
> Part two. Staying on the plan.

*Cue: slide "Course-correct early"*
> Even with a good plan, you'll sometimes see Claude heading the wrong way. Say that during step two it starts editing cart dot J S, which our plan lists as out of scope.
> Don't wait for it to finish. Press Escape. That stops Claude mid-action, and the docs say the context is kept, so you can redirect straight away.
> Then make the redirect clear and specific. Not "no, wrong". Something like: stop. Step two only. Cart dot J S is out of scope in PLAN dot M D. Keep the change inside discounts dot J S.
> A clear redirect names the step, names the boundary, and points back at the plan. You're not arguing with the agent. You're pointing at the decision you already made.
> There's a gentler option too. If Claude is doing fine and you just want to add something, type your message and press Enter while it works. Claude Code queues it instead of interrupting the turn. Use Escape when it's going the wrong way, and a queued message when it's going the right way and only needs a nudge.

*Cue: slide "Surprise? Update the plan"*
> Sometimes the surprise is real. Say Claude finds that checkout also re-checks discount codes in a second file we didn't know about. The plan was missing something.
> The tempting move is to just say "fine, fix that too". That's drift. The work and the plan stop matching, and the next session, or the next reviewer, has no idea why that file changed.
> Instead, stop and update PLAN dot M D first. Add the file to files to touch, add a step, or decide it's out of scope for now. Then continue from the updated plan. The file stays the single source of truth.

*Cue: drawn rewind menu*
> And if a step goes badly wrong, you can go back. Claude Code takes a checkpoint before each prompt you send. Press Escape twice with an empty input, or run slash rewind, and you get a menu.
> You can restore the code and conversation, restore just the conversation, restore just the code, or summarize from a point to free up context.
> On the cart project, say step two ended with a messy change that touched far more than it should. I don't untangle it by hand. I rewind to the prompt that started step two, restore the code, and send a clearer version of that prompt. The bad attempt is gone, and I've learned what to say more precisely.
> Two limits from the docs. Checkpoints track edits made with Claude's file editing tools, not files changed by bash commands. And they're not a replacement for git.

*Cue: slide "Commit as you go"*
> Which is why I commit as I go. One step, tests green, then a commit with a message that names the step. For example: discounts, add optional expiry date.
> Small commits give you real save points that outlive the session. If step four breaks something, step two is already safe in git, and the diff for each step is small enough to read properly.

**Visual / B-roll:**
- Card + Illustration terminal: the redirect prompt after Esc.
- Black panel: Found a surprise → Update PLAN.md → Then continue.
- Drawn rewind menu, labelled Illustration, with the option names from the docs.
- Three squares: Small · Green · Named.

### 7:45–10:30 · Part 3: Long runs
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Long runs"*
> Part three. Long runs, and knowing when to stop.

*Cue: slide "Keep going, or re-plan?"*
> Not every problem should be fixed by pushing on. Keep going when the step is working, the fixes are small, and the plan is still true.
> Stop and re-plan when the plan's assumptions turn out wrong, when the scope keeps growing, or when you're correcting the same thing again and again. Anthropic's guide is direct about this: if you've corrected Claude more than twice on the same issue in one session, the context is cluttered with failed approaches. Clear it, and start fresh with a better prompt that includes what you learned.
> Re-planning isn't failure. It's going back to plan mode with better information, updating PLAN dot M D, and running the loop again.
> For our feature, a re-plan might look like this. The checkout surprise turns out to be bigger than one extra file. So I stop, commit what's working, switch back to plan mode, and ask Claude to update the plan with what we now know. Then I review the new steps exactly like I reviewed the first ones.

*Cue: slide "Keep context lean"*
> Long implementations fill context, and long sessions full of irrelevant history can reduce performance. Four habits help.
> If you want to see what's using space, slash context shows you.
> One: slash clear between steps once a step is committed. The plan file carries the decisions, so you lose nothing important.
> Two: slash compact with a focus when you want to stay in the session, for example: focus on the discount changes.
> Three: send research to subagents. They explore in their own context and report back a summary, so your main conversation stays clean for implementation.
> Four: for a quick side question, slash B T W answers without adding to the conversation history.

*Cue: slide "Track progress in the file"*
> One more habit for multi-session work. When a step is done and committed, have Claude tick it off in PLAN dot M D. Then the next fresh session reads the file and knows exactly where things stand: steps one and two done, step three next.
> The prompt for a new session stays the same shape every time: read at PLAN dot M D, do the next unchecked step only, run the tests, and stop.

**Visual / B-roll:**
- Two columns: Keep going vs Re-plan; card "Two strikes? Clear".
- Four numbered habits: /clear · /compact · subagents · /btw.
- Illustration: PLAN.md with steps ticked off, plus the "next unchecked step" prompt.

### 10:30–11:30 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> Here's the mental model. Drift is just a plan change nobody wrote down. When reality disagrees with the plan, change the plan, then the code.

*Cue: recap slide*
> Quick recap. Start fresh: clear, point at the plan file, and pick a permission mode that fits the risk. Run one step per loop: implement, test, review the diff, commit. And stay on the plan: Escape and a clear redirect, update the file when you hit a surprise, rewind when a step goes wrong, and re-plan when you keep correcting the same thing.

*Cue: next-episode slide*
> Next in the playlist is episode nine: verifying the work. Tests passing is a start, not the finish, and we'll look at how to really prove the feature works. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 9 · Verifying the Work".

---

## Production notes
- Spoken word count is about 1,640 words, roughly 11 to 12 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal, menu and plan is a drawn graphic labelled "Illustration". Prompts are written for the course; no Claude output is shown as real.
- The checkout surprise is a hypothetical ("say Claude finds"), used to show how to update the plan. It is not a claim about the example project's real code.
- Permission-mode descriptions follow the permission-modes docs: Manual (config value `default`), `acceptEdits`, `auto` (classifier reviews actions; built-in starting mode in terminal and VS Code with v2.1.283 or later), `bypassPermissions` for isolated containers and VMs only. The narration says "recent versions" instead of a version number.
- Rewind menu option names follow the checkpointing docs. Checkpoints do not track Bash-made file changes and are not a replacement for version control.
- Ticking steps off in PLAN.md is a working habit, not a Claude Code feature.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Executing a Plan with Claude Code: Step by Step, Without Drift (Agentic Engineering Ep 8)
2. How to Keep an AI Coding Agent on the Plan | Agentic Engineering Ep 8
3. Esc, Rewind, Commit: Running a PLAN.md with Claude Code | Ep 8

### Description
```
Episode 8 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we execute the PLAN.md from Episode 7 (discount code expiry dates on a small Node.js cart project): starting a fresh session with the plan file referenced, choosing a permission mode for execution, running one step per loop (implement, test, review the diff, commit), course-correcting with Esc and clear redirects, updating the plan when you hit a surprise instead of drifting, checkpoints and /rewind, incremental commits, when to stop and re-plan, and keeping context lean during long implementations.

Note: terminal screens are drawn illustrations written for the course, not recordings.

Chapters:
0:00 From plan to execution
0:30 Intro and what we'll cover
1:00 Start fresh: plan file, permission mode, one step per loop
4:00 Stay on the plan: Esc, redirects, surprises, rewind, commits
7:45 Long runs: re-plan, lean context, progress in the file
10:30 Recap and next episode

Official docs:
Best practices: https://code.claude.com/docs/en/best-practices
Permission modes: https://code.claude.com/docs/en/permission-modes
Checkpointing: https://code.claude.com/docs/en/checkpointing
Interactive mode: https://code.claude.com/docs/en/interactive-mode

Next in the playlist: Ep 9 · Verifying the Work

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, executing a plan, plan.md, claude code permission modes, accept edits mode, auto mode, claude code rewind, checkpoints, esc to interrupt, incremental commits, ai coding workflow, context management, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"RUN THE PLAN"**, small line: **"one step · test · commit"**.
Visual: PLAN.md with two ticked steps and a coral Esc key. "EP 8" badge.

---

## Suggested slide list (Episode 8 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Executing the Plan | Agentic Engineering · Episode 8 |
| 2 | Four parts | 01 Start fresh · 02 Run the steps · 03 Stay on plan · 04 Long runs |
| 3 | 01 · Start fresh | Clear, then point at the plan |
| 4 | Start from the file | /clear, @PLAN.md, step one only, stop when it passes |
| 5 | Permission mode | Manual · Accept edits · Auto · Bypass (containers only) |
| 6 | One step per loop | Read step → Implement → Test → Review diff → Commit |
| 7 | 02 · Stay on the plan | Steer early, write changes down |
| 8 | Steer early | Esc keeps context; redirect names step, boundary, plan |
| 9 | Surprise? Update the plan | Update PLAN.md first, then continue |
| 10 | Rewind | Esc Esc or /rewind; restore or summarize; not git |
| 11 | Commit as you go | Small · Green · Named |
| 12 | 03 · Long runs | Know when to stop |
| 13 | Keep going, or re-plan? | Corrected twice? Clear and restart |
| 14 | Keep context lean | /clear · /compact · subagents · /btw |
| 15 | Track progress | Tick steps; next unchecked step only |
| 16 | Quote | Drift is a plan change nobody wrote down |
| 17 | Recap | Start fresh · One step per loop · Stay on plan |
| 18 | Next | Episode 9 · Verifying the Work |

---

## Sources
- Best practices: https://code.claude.com/docs/en/best-practices (reference files with `@`; course-correct early and often: `Esc` stops Claude mid-action with context preserved, `Esc + Esc` or `/rewind`, `/clear`; corrected more than twice on the same issue → `/clear` and start fresh with a more specific prompt; long sessions with irrelevant context can reduce performance; `/compact <instructions>`; use subagents for investigation, they report back summaries; Manual mode prompts become tedious).
- Permission modes: https://code.claude.com/docs/en/permission-modes (mode table: Manual/`default`, `acceptEdits`, `plan`, `auto`, `dontAsk`, `bypassPermissions` "Isolated containers and VMs only"; Shift+Tab cycles modes and the status bar shows the active one; auto mode classifier; auto as built-in starting mode with v2.1.283 or later).
- Checkpointing: https://code.claude.com/docs/en/checkpointing (checkpoint before each prompt; `/rewind` or Esc twice with empty input; menu options; Bash changes not tracked; not a replacement for version control).
- Interactive mode: https://code.claude.com/docs/en/interactive-mode (`Esc` interrupts and Claude keeps the work done so far; `/btw` side questions without adding to conversation history; queue messages while Claude works by typing and pressing Enter).
- Costs: https://code.claude.com/docs/en/costs (`/context` shows what's consuming space).
- Episode 7 reference: /workspace/agentic-course/day08-ep07-script.md.
