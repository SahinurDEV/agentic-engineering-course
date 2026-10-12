# Day 2 · Episode 1: From Autocomplete to Agent

**Series:** Agentic Engineering (free YouTube course) · Week 1: Foundations
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 9:00
**Format:** faceless: slides + screen recordings + AI voiceover, no presenter on screen
**Covers (Module 1 lessons):** (1) Agentic Engineering · (2) Autocomplete to Agent · (3) Why Fundamentals Matter

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = screen recording (terminal/editor/browser) with voiceover

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SCREEN] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap for today | n/a |
| 1:00–2:40 | [VOICEOVER + SLIDE] | What agentic engineering is | Lesson 1 |
| 2:40–4:40 | [VOICEOVER + SLIDE] | 01 · The shift: autocomplete to agent | Lesson 2 |
| 4:40–7:00 | [VOICEOVER + SCREEN] | Same task, two ways: chat-style vs Claude Code | Lesson 2 (demo) |
| 7:00–8:25 | [VOICEOVER + SLIDE] | Why fundamentals still matter | Lesson 3 |
| 8:25–9:00 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SCREEN]

**Say:**
> Here's a task: add a discount code to a shopping cart, and make sure the tests still pass.
> I'm going to do it twice. Once the old way: I ask an AI, it gives me a snippet, I copy, paste, run the tests, and paste the errors back. Then the new way: I give an agent the goal, and it reads the project, makes the change, and runs the tests itself.
> Same AI family, completely different way of working. That difference is what this whole course is about.

**Visual / B-roll:**
- 1-second flash-forward: split screen of the browser chat (left) and the Claude Code terminal (right) from the demo segment.
- Title card at 0:25: "Ep 1 · From Autocomplete to Agent".

---

### 0:30–1:00 · Intro + today's roadmap
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Welcome to Agentic Engineering. I'm Sahinur Islam, a full-stack software engineer, and this is episode one of this free course.
> Today has three parts. First, what "agentic engineering" actually means. Second, the shift from AI as autocomplete to AI as an agent, with a live demo. And third, why your engineering fundamentals matter more now, not less.

**Visual / B-roll:**
- Title slide with name card: "Sahinur Islam · Full-Stack Software Engineer".
- Three-item agenda slide: 1 What it is · 2 The shift · 3 Fundamentals.

---

### 1:00–2:40 · Part 1: What agentic engineering is
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: slide "What is an AI coding agent?"*
> So, what is agentic engineering?
> Let's start with the word "agent." An AI coding agent is a language model that can take actions, not just produce text. It has tools: it can read files, search the codebase, edit code, and run commands like your test suite. And it works in a loop: it decides on a step, takes it, looks at the result, and decides on the next step, until the goal is done or it needs you.

*Cue: slide "Agentic engineering"*
> Agentic engineering is the discipline of building software with agents like that. You're still the engineer. You decide what should be built, you give the agent the right context and constraints, and you check that what comes back is actually correct. The agent does more of the hands-on-keyboard work. You own the outcome.

*Cue: slide with the word "engineering" highlighted*
> And notice the word "engineering." It's not "type a wish and accept whatever comes back." That might be fine for a weekend toy. But for code that real people use, someone has to understand it, review it, and stand behind it. That someone is still you.
>
> Over this course, "engineering" is going to mean concrete habits: managing the agent's context, planning before executing, verifying after, and giving the agent the project knowledge and tools it needs. That's what turns an agent from a slot machine into a dependable teammate.

**Visual / B-roll:**
- Slide "What is an AI coding agent?": `Model + Tools + Loop`. Three icons: brain (model), wrench (tools: read, search, edit, run), circular arrow (loop).
- Slide "Agentic engineering": "Building software by directing AI agents, while you own the outcome." Below it, two columns: **Agent does:** reads, edits, runs commands · **You do:** define the goal, give context, set constraints, review, verify.
- At "slot machine": quick playful graphic of a slot lever, then a checklist replacing it.

---

### 2:40–4:40 · Part 2: 01 · The shift (autocomplete to agent)
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: slide "01 · The shift"*
> The first big idea: AI coding moved from autocomplete to agent.

*Cue: slide "The autocomplete loop"*
> Here's the autocomplete loop. You write some code, or ask a question. The AI suggests a completion, or gives an answer. You accept it and keep typing. And you repeat that, manually, over and over. Every step goes through you.

*Cue: slide "The agent loop"*
> Now the agent loop. It starts with your goal. Then the agent reads: the files, the code, the errors. It acts: it edits code, runs a command. Then it verifies: did the tests pass, did the build work? If not, it loops back, reads again, acts again, verifies again. And when the goal is met, it's done.

*Cue: slide "Yesterday vs Today"*
> So, yesterday: AI as autocomplete. You drive. It suggests. It worked one file at a time, with no memory of your project and no tools. It could only see what you put in front of it.
>
> Today: AI as agent. It drives. You steer. It works across whole repos. It reads, it edits, it runs your tests, it can even open pull requests.

*Cue: closing quote slide*
> And that leads to the line I want you to remember from this episode:
> "The bottleneck is no longer typing. It's specifying, reviewing, verifying."
> Typing code is now the cheap part. Saying precisely what you want, reading what came back, and proving it works: that's where the real work is.

**Visual / B-roll:**
- Slide "01 · The shift": headline "AI coding moved from autocomplete to agent."
- Autocomplete loop diagram (animate step by step): *You write/ask → AI suggests/answers → You accept, keep typing → repeat manually* (arrow back to start, labelled "manual").
- Agent loop diagram: *Your goal → [Read → Act → Verify ↺] → Done*. Animate the Read/Act/Verify ring spinning twice before "Done" lights up.
- Two-column slide: **Yesterday: AI as autocomplete** ("You drive. It suggests." · one file at a time · no memory · no tools) vs **Today: AI as agent** ("It drives. You steer." · whole repos · reads, edits, runs tests, opens PRs).
- Full-screen quote slide, big type: "The bottleneck is no longer typing. It's specifying, reviewing, verifying."

---

### 4:40–7:00 · Live demo: same task, two ways
**Marker:** [VOICEOVER + SCREEN] (opens with a 5 s [VOICEOVER + SLIDE] transition card)

**Demo setup (prepare before recording):**
- Small Node.js repo, e.g. `agentic-course-demos/ep01-cart`:
  - `src/cart.js`: `cartTotal(items)` returns the total in cents.
  - `src/discounts.js`: an existing `applyDiscount(total, code)` with one code already supported (e.g. `FLAT500` = 500 cents off) and a `DISCOUNTS` map.
  - `test/cart.test.js` and `test/discounts.test.js` using `node:test` (`npm test` = `node --test`).
  - The detail that matters: discount logic lives in `discounts.js`, *not* `cart.js`, and there is an existing rule that totals can't go below zero. Someone who only sees `cart.js` won't know that.
- Task (identical for both runs): **"Add a discount code SAVE10 that takes 10% off the cart total. Totals must never go below 0. Add tests."**
- Commit a clean starting point and make a branch per run so you can reset between takes.
- Be honest in the recording: agent output varies from run to run. Show whatever actually happens. If the agent needs a second loop to fix a failing test, that's a *better* demo of Read → Act → Verify.
- Record the screen first, then adjust the demo narration below to match what actually happened before generating the voiceover.

**Say:**

*Cue: transition card "Same task, two ways"*
> Okay, let's actually see it. Same small project, same task, two ways.

*Cue: screen, repo tree in the editor*
> Here's the project: a cart, a discounts file, and tests. The task: add a code called SAVE ten, for ten percent off. Totals can't go below zero, and we need tests.
>
> Round one: autocomplete-style chat.

*Cue: screen, browser chat*
> I open a chat assistant, paste in cart dot J S, because that's the file that looks relevant, and paste the task.
> It gives me a reasonable-looking function. But look: it's guessing. It doesn't know a discounts dot J S file already exists, it doesn't know how the existing codes are structured, and it doesn't know which test runner I use.

*Cue: screen, copy-paste into the editor, run `npm test` manually, show the result you actually get*
> So I copy, paste, adapt it by hand, and run the tests myself. And now I'm pasting errors back into the chat and going around again. Every single step goes through me. That's the autocomplete loop.
>
> Round two: an agent.

*Cue: screen, reset to the clean branch, open a terminal, start `claude` in the repo, paste the identical task prompt*
> Now the same task in Claude Code. I'm not pasting any files. I just give it the goal.

*Cue: zoom in on the agent's tool calls*
> Watch what it does first. It's reading: it lists the project, opens cart dot J S, finds discounts dot J S, and looks at the existing tests. That's the Read step.
> Now it's editing: adding SAVE ten next to the existing code, in the existing style, and writing tests. That's Act.
> And now it runs N P M test on its own. That's Verify.

*Cue: only if a test fails in your recording, use this line*
> It failed, so it reads the error, fixes it, and runs again. That's the loop going around.

*Cue: screen, agent summary*
> And it tells me what it changed.

*Cue: screen, run `git diff`*
> But here's the important part: I'm not done just because it says it's done. I read the diff. Is the ten percent rounding sensible for cents? Is the "never below zero" rule respected? Are the tests testing the right thing? That is my job now: specifying, reviewing, verifying.

**Visual / B-roll:**
- Zoom-ins on: the moment the chat answer assumes a structure that doesn't match the repo; the agent's tool-call lines (file reads, `npm test`); the green test output; the `git diff`.
- On-screen labels pop up in sync: "READ", "ACT", "VERIFY ↺" on the agent run; "manual copy/paste" on the chat run.
- Optional split-screen recap (5 s): left "You did every step", right "Agent looped; you reviewed".
- Speed up long agent thinking stretches (2x–4x) with a small "sped up" tag.

---

### 7:00–8:25 · Part 3: Why fundamentals still matter
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: slide "Why fundamentals still matter"*
> Which brings us to part three, and it's the one people skip: why fundamentals still matter.
>
> You just saw where my effort went in that demo. Not typing. Three things.

*Cue: slide "1 · Specify"*
> One: specifying. The agent can only aim at the target you give it. To write a good task, you have to know what "correct" means: the edge cases, the constraints, where things belong in the codebase. "Add a discount" is vague. "Ten percent off, never below zero, follow the existing pattern, add tests" is a spec. Writing that takes engineering knowledge.

*Cue: slide "2 · Review"*
> Two: reviewing. Agents can produce a lot of code fast, and it usually looks right. If you can't read it critically and spot a bad abstraction, a security hole, or a subtle bug, you'll merge it anyway. The faster the code arrives, the more your reviewing skill matters.

*Cue: slide "3 · Verify"*
> Three: verifying. "The tests pass" only means something if the tests are good. You need to know how to test, what to test, and when to check things by hand.

*Cue: slide "Agents are amplifiers"*
> Here's the way I think about it: an agent amplifies whatever engineering you bring. Bring clear requirements, good structure, and real tests, and it'll move fast in the right direction. Bring vague goals and no tests, and it'll move just as fast, in the wrong direction, and generate a lot more mess than you could have typed yourself.
> So this course won't replace your fundamentals. It's going to put them to work.

**Visual / B-roll:**
- Three-card slide that builds one card at a time: **Specify** (know what "correct" means) · **Review** (read the code critically) · **Verify** (good tests, real checks).
- At "Add a discount" vs the full spec: side-by-side text comparison on screen, vague prompt in grey and precise prompt in bold.
- "Amplifier" slide: a dial/amplifier icon with two outputs: "Good engineering → fast, right direction" and "Weak engineering → fast mess".

---

### 8:25–9:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Quick recap. Agentic engineering means building software by directing AI agents while you own the outcome. AI moved from autocomplete, where you drive and it suggests, to agents, where it drives and you steer. And because typing isn't the bottleneck anymore, your fundamentals, specifying, reviewing, and verifying, are what make the difference.
> Next episode is Claude Code one-oh-one: how it works, and what actually happens in a session. Demo code from today is linked below. Subscribe and turn on notifications for the playlist, and I'll see you tomorrow.

**Visual / B-roll:**
- Recap overlay with three bullets appearing as spoken.
- End screen: "Next: Ep 2 · Claude Code 101", playlist tile, subscribe element.

---

## Production notes
- Spoken word count is about 1,400 words, roughly 9 minutes including demo pauses. If you run long, trim the chat round of the demo, not the agent round or the review step.
- Don't claim specific speedups or numbers. Let the demo speak for itself.
- Keep the chat round fair: use a capable assistant and paste `cart.js` honestly. The point is the *workflow* (manual loop, limited context), not that chat models are bad.
- Generate the voiceover from the `>` quote blocks only, then cut the slides and screen recording to it. Stretch or trim the demo footage (speed-ups, freeze frames) so each narration line lands on the matching action.
- Push the demo repo to the public course repo under `ep01-cart` (or a branch `ep01`) before publishing.

---

## YouTube metadata

### Title options
1. From Autocomplete to AI Agent: What Agentic Engineering Really Means (Ep 1)
2. AI Doesn't Just Suggest Code Anymore: Autocomplete vs Agent, Live Demo | Agentic Engineering Ep 1
3. Why AI Agents Make Engineering Fundamentals MORE Important | Agentic Engineering Ep 1

### Description
```
Episode 1 of Agentic Engineering, a free course on building real software with AI coding agents.

AI coding has moved from autocomplete (you drive, it suggests) to agents (it drives, you steer). In this episode I explain what agentic engineering actually means, walk through the autocomplete loop vs the agent loop (Read → Act → Verify), do the same small task both ways live (chat-style copy-paste vs Claude Code working in the repo), and explain why your engineering fundamentals matter more than ever.

"The bottleneck is no longer typing. It's specifying, reviewing, verifying."

Chapters:
0:00 Same task, two ways
0:30 Intro and what we'll cover
1:00 What is agentic engineering?
2:40 The shift: autocomplete to agent
4:40 Live demo: chat vs Claude Code
7:00 Why fundamentals still matter
8:25 Recap and next episode

▶ Demo code: [GITHUB REPO LINK]/ep01-cart
▶ Slides: [SLIDES LINK]
▶ Full playlist: [PLAYLIST LINK]
▶ Next: Ep 2 · Claude Code 101

I'm Sahinur Islam, a full-stack software engineer. New episode every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
agentic engineering, ai coding agent, autocomplete vs agent, claude code, claude code tutorial, what is an ai agent, ai agents for developers, ai pair programming, ai coding workflow, software engineering fundamentals, read act verify, agentic coding, free ai coding course, ai for software engineers, sahinur islam

### Thumbnail text idea
Big text: **"AUTOCOMPLETE → AGENT"**, with a smaller line under it: **"It drives. You steer."**
Visual: left half shows a greyed inline code suggestion; right half shows a terminal with a green "tests passed"; a big arrow in the middle pointing right. Small "EP 1" badge.

---

## Suggested slide list (Episode 1 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | From Autocomplete to Agent | Agentic Engineering · Episode 1 |
| 2 | Today | What agentic engineering is · The shift · Why fundamentals matter |
| 3 | What is an AI coding agent? | Model + tools + loop: it takes actions, not just writes text |
| 4 | Agentic engineering | Building software by directing agents, while you own the outcome |
| 5 | Who does what | Agent: read, edit, run · You: goal, context, constraints, review, verify |
| 6 | 01 · The shift | AI coding moved from autocomplete to agent |
| 7 | The autocomplete loop | You write/ask → AI suggests → you accept, keep typing → repeat manually |
| 8 | The agent loop | Your goal → Read → Act → Verify (loop back) → Done |
| 9 | Yesterday: AI as autocomplete | You drive, it suggests: one file at a time, no memory, no tools |
| 10 | Today: AI as agent | It drives, you steer: whole repos; reads, edits, runs tests, opens PRs |
| 11 | The new bottleneck | "The bottleneck is no longer typing. It's specifying, reviewing, verifying." |
| 12 | Demo: same task, two ways | Add SAVE10 (10% off, never below 0, with tests): chat vs Claude Code |
| 13 | Why fundamentals still matter | Your effort moves from typing to judgment |
| 14 | 1 · Specify | You can only get what you can clearly describe: edge cases, constraints, structure |
| 15 | 2 · Review | Fast, plausible-looking code still needs a critical human read |
| 16 | 3 · Verify | Passing tests mean something only if the tests are good |
| 17 | Agents are amplifiers | Good engineering gets faster; bad engineering gets messier, faster |
| 18 | Recap | Agent = model + tools + loop · It drives, you steer · Fundamentals decide the result |
| 19 | Next: Claude Code 101 | How Claude Code works and the anatomy of a session |
