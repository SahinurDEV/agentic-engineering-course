# Day 10 · Episode 9: Verifying the Work

**Series:** Agentic Engineering (free YouTube course) · Week 2: Workflow
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 7:30
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 4 lesson):** Verifying the Work

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. Every terminal view in this episode is a **drawn terminal graphic** labelled "Illustration", not a screen recording. This is an illustrated walkthrough: the prompts, the diff and the test names are written for the course, and no model or review output is shown as real. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:25–0:50 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 0:50–2:50 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Why verify, and checks Claude can run | Verifying the Work |
| 2:50–4:50 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Read the diff, test the right thing | Verifying the Work |
| 4:50–6:50 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Review, manual checks, checklist, commit | Verifying the Work |
| 6:50–7:30 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we executed the plan for discount code expiry dates, one step at a time, with commits along the way. The tests are green.
> So we're done, right? Not yet. Green tests tell you the tests passed. They don't tell you the feature works. That gap is what this episode is about.

**Visual / B-roll:**
- Episode 8 "one step per loop" card, then the title card.

### 0:25–0:50 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode nine: verifying the work.

*Cue: agenda slide*
> Four parts. Why verification matters. Checks Claude can run itself. Reading the diff and the tests yourself. And review, a checklist, then the commit. As always, the screens are illustrations I drew, not recordings.

**Visual / B-roll:**
- Agenda: 01 Why verify · 02 Checks it runs · 03 Read the diff · 04 Review, commit.

### 0:50–2:50 · Part 1: Why verify
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Why verify"*
> Part one. Why verify.

*Cue: slide "The step people skip"*
> Verification is the step people skip, because by the time you get there the work looks finished. And it's the one that matters most, because everything before it was a guess about what the code would do.
> Anthropic's guide puts it plainly: Claude stops when the work looks done. Without a check it can run, "looks done" is the only signal, and you become the verification loop. Every mistake waits for you to notice it.
> On the cart project, "looks done" might mean the expiry check exists and the old tests pass. But an old test suite has never seen an expired code. It would pass whether the new check works or not.

*Cue: slide "Give Claude a check"*
> So the first job is to give Claude something that returns a pass or a fail. Tests. A type check. A linter. A build and its exit code. For UI work, a screenshot of the result compared against the design.
> Once a check exists, the loop closes on its own: Claude does the work, runs the check, reads the result, and keeps going until it passes.
> If you want the check to hold for a whole session, not just one prompt, the docs describe two stronger options: set it as a slash goal condition, which is re-checked after every turn, or add a Stop hook, a script that blocks the turn from ending until the check passes.

*Cue: slide "Ask for evidence"*
> Put the check in the prompt. For our feature: run N P M test and the linter, fix any failures, and fix the root cause, don't suppress the error.
> Then ask for evidence, not a claim. Show me the command you ran and what it returned. The guide recommends exactly this: reviewing evidence is faster than re-running everything yourself, and it works even for a session you weren't watching.

**Visual / B-roll:**
- Black panel: Looks done → Is it done? → Prove it.
- Five-box flow: Tests → Types → Lint → Build → Screenshot.
- Illustration terminal with the two prompts.

### 2:50–4:50 · Part 2: Read the diff, test the right thing
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "02 · Read the diff"*
> Part two. Read the diff yourself.

*Cue: drawn diff view*
> Inside Claude Code, slash diff shows the changes in your working tree, including the edits Claude has made so far. Outside it, git diff does the same job.
> I read it against PLAN dot M D. Did the change stay inside discounts dot J S and its test file? Does the expiry check do what step two says, and nothing more? Is there anything in there I didn't ask for? A diff that touches files outside the plan is a question, even if every test passes.
> Two things I look for every time: tests that were deleted or skipped, and assertions that got weaker. If a test was changed to match the code, instead of the code being fixed to match the test, the green tick means nothing.

*Cue: slide "Do the tests test the right thing?"*
> Then I read the tests, because passing tests can still test the wrong thing. A test that never builds an expired code can't catch a broken expiry check.
> The plan already listed the edge cases, so I check each one has a test. An expired code is rejected. A code on its expiry day still applies, because we decided codes are valid through the end of that day. A code with no expiry works as before.
> A quick way to check a test is real: break the code on purpose. Comment out the expiry check and run the tests. If nothing fails, that test isn't testing what you think. Then put the check back.
> And reading the tests surfaces one the plan missed: timezone. "Today" depends on where you ask. If the server and the store disagree about the date, the expiry day can end early or late. So, just like last episode, I don't patch it quietly. I add a decision to PLAN dot M D, for example: compare dates in the store's timezone. Then I ask for a test that pins it down.

**Visual / B-roll:**
- Illustration: drawn diff of src/discounts.js.
- Test checklist card with the four edge cases; "timezone" highlighted in coral.

### 4:50–6:50 · Part 3: Review, manual checks, checklist, commit
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Review and commit"*
> Part three. Review, then commit.

*Cue: slide "A second pair of eyes"*
> Next, a review. Slash code review checks the current diff for correctness bugs, right from the session you're working in.
> For a stronger second opinion, use fresh context. The docs point out that a new session reviews better because Claude won't be biased toward code it just wrote. That's the writer and reviewer pattern: one session writes, a second session reviews. A verification subagent does a similar job, so the agent doing the work isn't the one grading it.

*Cue: slide "Manual checks when it counts"*
> Automated checks cover most of it. But when it counts, check by hand. Discount codes touch money, so I'd apply a real expired code in the running app myself and watch it get rejected. The guide also mentions running slash verify yourself after Claude's checks pass, to confirm the change against the running app.
> Money, logins, and user data are where I always add a manual check.
> It takes two minutes, and it's the only check that sees what a customer would see.

*Cue: slide "Verification checklist"*
> Here's the checklist I run before every commit. One: the checks are green, and I've seen the evidence. Two: I've read the diff against the plan. Three: the edge cases have tests that would fail if the code were wrong. Four: it's been reviewed, and anything risky was checked by hand.

*Cue: slide "Then commit"*
> Only then, commit. Ask Claude to commit with a descriptive message, tick the step off in PLAN dot M D, and the feature is truly done.

**Visual / B-roll:**
- Card + Illustration terminal: slash code-review, then a fresh-session review prompt.
- Two columns: Automated vs By hand; card "Money? Check by hand".
- Four-item checklist.
- Illustration terminal: commit prompt, PLAN.md tick.

### 6:50–7:30 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model: green tests are evidence, not proof. Done means you checked.

*Cue: recap slide*
> Recap. Give Claude a check it can run, and ask for evidence. Read the diff and the tests against the plan, including the edge cases. Then review, check by hand when it counts, and commit.

*Cue: next-episode slide*
> Next in the playlist is episode ten: CLAUDE dot M D explained, the file that tells Claude how your project works, every session. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 10 · CLAUDE.md Explained".

---

## Production notes
- Spoken word count is about 1,050 words, roughly 7 to 8 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal, diff and test list is a drawn graphic labelled "Illustration", written for the course. No Claude or /code-review output is shown as real.
- The timezone rule ("compare dates in the store's timezone") is a design decision for the example, not a fact about any library.
- `/diff`, `/code-review` and `/verify` are confirmed in the commands docs and best practices; the writer/reviewer pattern and "won't be biased toward code it just wrote" are from best practices.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Verifying AI-Written Code: Tests, Diffs and Reviews with Claude Code (Agentic Engineering Ep 9)
2. Green Tests Aren't Proof: How to Verify Claude Code's Work | Agentic Engineering Ep 9
3. /diff, /code-review and a Verification Checklist | Ep 9

### Description
```
Episode 9 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we verify the discount code expiry feature from Episodes 7 and 8: why verification is the step people skip and the one that matters most; giving Claude a check it can run (tests, type checks, linters, a build, screenshots for UI) and asking for evidence; reading the diff yourself with /diff or git diff; checking the tests cover the plan's edge cases (expired code, expiry today, timezone); a review with /code-review or a fresh session; manual checks when it counts; a verification checklist; then the commit.

Note: terminal screens are drawn illustrations written for the course, not recordings.

Chapters:
0:00 Green tests, done?
0:25 Intro and what we'll cover
0:50 Why verify, and checks Claude can run
2:50 Read the diff, test the right thing
4:50 Review, manual checks, checklist, commit
6:50 Recap and next episode

Official docs:
Best practices: https://code.claude.com/docs/en/best-practices
Commands: https://code.claude.com/docs/en/commands
Interactive mode (/diff): https://code.claude.com/docs/en/interactive-mode
Code review: https://code.claude.com/docs/en/code-review

Next in the playlist: Ep 10 · CLAUDE.md Explained

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, verify ai code, claude code diff, claude code code review, code review ai, testing ai generated code, edge cases, verification checklist, ai coding workflow, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"GREEN ≠ DONE"**, small line: **"verify before you commit"**.
Visual: a green test badge with a coral question mark next to a drawn diff. "EP 9" badge.

---

## Suggested slide list (Episode 9 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Verifying the Work | Agentic Engineering · Episode 9 |
| 2 | Four parts | 01 Why verify · 02 Checks it runs · 03 Read the diff · 04 Review, commit |
| 3 | 01 · Why verify | Looks done isn't done |
| 4 | The step people skip | Looks done → Is it done? → Prove it |
| 5 | Give Claude a check | Tests · Types · Lint · Build · Screenshot |
| 6 | Ask for evidence | Check in the prompt; show the command and output |
| 7 | 02 · Read the diff | Against the plan |
| 8 | /diff | Illustration of the discounts.js diff |
| 9 | Test the right thing | Expired · Expiry day · No expiry · Timezone |
| 10 | 03 · Review and commit | A second opinion, then commit |
| 11 | A second pair of eyes | /code-review · fresh session · subagent |
| 12 | Manual checks | Automated vs by hand; money, logins, data |
| 13 | Verification checklist | Green · Diff read · Edge cases · Reviewed |
| 14 | Then commit | Descriptive message, tick PLAN.md |
| 15 | Quote | Green tests are evidence, not proof |
| 16 | Recap | Checks · Read · Review |
| 17 | Next | Episode 10 · CLAUDE.md Explained |

---

## Sources
- Best practices: https://code.claude.com/docs/en/best-practices ("Give Claude a check it can run: tests, a build, a screenshot to compare"; Claude stops when the work looks done, without a check you become the verification loop; checks include a test suite, build exit code, linter, browser screenshot; address root causes, don't suppress the error; run `/verify` yourself after Claude's check passes; gate the stop with a `/goal` condition or a Stop hook; second opinion via a verification subagent; have Claude show evidence rather than asserting success; a fresh context improves code review since Claude won't be biased toward code it just wrote; Writer/Reviewer pattern; commit with a descriptive message).
- Commands: https://code.claude.com/docs/en/commands (`/diff` reviews working-tree changes including Claude's edits; `/code-review` reviews the current diff for correctness bugs).
- Interactive mode: https://code.claude.com/docs/en/interactive-mode (Review changes with /diff).
- Code review: https://code.claude.com/docs/en/code-review (Review a diff locally with /code-review).
- Episode 8 reference: /workspace/agentic-course/day09-ep08-script.md.
