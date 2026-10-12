# Day 6 · Episode 5: Context Management Basics

**Series:** Agentic Engineering (free YouTube course) · Week 1: Foundations
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 11:30
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 3 lessons):** (1) Basics of Context Management · (2) Filling Context Well

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. Every terminal view in this episode is a **drawn terminal graphic** labelled "Illustration", not a screen recording. Bars and lists on those screens are schematic; they show no real token counts. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:00–5:15 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · The basics: working memory, what fills it, why quality drops, /context | Lesson 1 |
| 5:15–10:15 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Filling context well: six habits | Lesson 2 |
| 10:15–10:50 | [VOICEOVER + SLIDE] | Before you hit Enter: a checklist | n/a |
| 10:50–11:30 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> In episode four, we walked through a complete Claude Code session, from a clean project folder to a commit. And context kept coming up: clearing it between tasks, compacting it when a session got long, continuing it the next time.
> That's not an accident. Most of what makes a session go well or go badly comes down to one thing: what's in Claude's context window.

**Visual / B-roll:**
- Quick callback to three Episode 4 slides (`/clear`, `/compact`, `claude --continue`), then the words "context window" fill the screen. Cut to the title card.

---

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: title slide*
> Welcome back to Agentic Engineering. I'm Sahinur Islam, a full-stack software engineer, and this is episode five: context management basics.

*Cue: agenda slide*
> Two parts today. First, the basics: what the context window is, what fills it, why quality drops as it fills, and how to see what's in yours. Then, the practical half: six habits for filling context well, so Claude has what it needs, and as little else as possible.

**Visual / B-roll:**
- Title slide: "Context Management Basics", "Agentic Engineering · Episode 5", name card "Sahinur Islam".
- Agenda: 01 What it is · 02 What fills it · 03 Why quality drops · 04 Filling it well.

---

### 1:00–5:15 · Part 1: The basics
**Marker:** [VOICEOVER + SLIDE] (with one [VOICEOVER + SCREEN] for /context)

**Say:**

*Cue: divider "01 · The basics"*
> Part one. The basics.

*Cue: slide "The agent's working memory"*
> Anthropic's docs describe the context window like this: it holds everything Claude knows about your session. Your instructions, the files it reads, its own responses, and content that never appears in your terminal.
> I think of it as the agent's working memory. The model doesn't look things up in some hidden memory of your project. If it's not in the context window, Claude doesn't know it right now. And if it is in there, it's shaping every answer.
> Two more things make this matter. It fills up as you work. And sessions are independent: each new session starts with a fresh context window, without the conversation from previous sessions. Anything you want Claude to know every time has to be loaded again, which is exactly what CLAUDE dot M D is for.

*Cue: slide "What fills it", the flow builds left to right*
> So what actually goes in? It's easiest to follow one session in order.
> Before you type anything, some things load automatically. Then your prompt goes in. Then, as Claude works, every file it reads and every command it runs adds more. And its own responses go in too. Every turn adds to the pile.

*Cue: slide "Before you type, and as it works"*
> Let's look closer. Before your first prompt, Claude Code loads its system instructions, which you never see. It loads your CLAUDE dot M D files, both your personal one and the project one. It loads auto memory, which is notes Claude kept from earlier sessions. Plus information about your environment, like the working directory and your git status, and short lists of the tools and skills that are available.
> Then the session itself: your messages, Claude's replies, and the results of every tool call.
> And here's the part that surprises people. When Claude reads a file, your terminal shows one short line, like "Read discounts dot J S". But the entire contents of that file are now in the context window. Same with command output and search results. The docs put it plainly: file reads dominate context usage. That's why being specific matters so much, and we'll come back to that in part two.
> Picture the cart session from episode four. Before I typed a word, the system instructions, my CLAUDE dot M D, and the environment info were already there. Then my prompt. Then Claude read the discounts file, the cart file, and the existing tests, and every one of those reads stayed in context. Then the test output went in, including the failing run. Then the fix, the second test run, the diff, and the commit. By the end, one small feature had filled the context with a lot of material, and almost none of it is useful for the next, unrelated task.

*Cue: slide "Why quality drops"*
> Now, why does any of this matter? Because, in the words of Anthropic's own best practices guide, Claude's context window fills up fast, and performance degrades as it fills. When it's getting full, Claude may start forgetting earlier instructions, or making more mistakes.
> It's not only about size. Irrelevant content hurts too. Old conversation from a finished task crowds out the files you need next, and long sessions with irrelevant context can reduce performance and distract Claude.
> Claude Code does help here. As you approach the limit, it manages context automatically: it clears older tool outputs first, then summarizes the conversation if needed. Your requests and key code snippets are kept. But detailed instructions from early in the conversation may be lost. That's why the docs say: put persistent rules in CLAUDE dot M D, not in a message you typed an hour ago.

*Cue: drawn /context screen*
> So how do you see what's in yours? Type slash context. It gives you a live breakdown of what's using space, by category, with suggestions for freeing some up. It also shows which CLAUDE dot M D and memory files actually loaded, which is handy when Claude seems to ignore a rule. And slash memory opens those files so you can edit them.
> Make it a habit: when a session starts to feel off, check slash context before you blame the model.

**Visual / B-roll:**
- Divider: big "01", "The basics".
- "Working memory" slide: three coral squares, **Everything** (all Claude knows about this session) · **Fills up** (every message, file, and output) · **Fresh** (each new session starts empty).
- "What fills it" flow: Startup (black) → Your prompt → File reads → Tool output → Replies (coral); loop label "Every turn adds more".
- "Before you type, and as it works" slide: white card list of startup items; dark terminal (Illustration) contrasting `Read src/discounts.js` (what you see) with "the whole file is now in context" (what Claude has); coral column "File reads dominate context use".
- "Why quality drops" slide: black panel "Fuller / more mistakes / Noisier / less focus"; side box "Auto-compact near the limit".
- `/context` monitor screen (Illustration): schematic rows (system and tools · memory files · conversation · free space) with `#` bars and no numbers; caption "Your numbers will differ. Run it yourself."

---

### 5:15–10:15 · Part 2: Filling context well
**Marker:** [VOICEOVER + SLIDE] (with drawn terminal graphics)

**Say:**

*Cue: divider "02 · Filling it well"*
> Part two. Filling context well. The goal is simple to say: give Claude what this task needs, and as little else as possible. Here are six habits that get you there.

*Cue: slide "Point at the right files", drawn @ mention*
> Habit one: point at the right files. If you know where the code lives, say so. Type an at sign and a file path, and Claude reads that file before it responds. You get autocomplete for the path, too.
> Compare "fix the discount bug" with "fix the rounding bug in at src slash discounts dot J S". The first one sends Claude searching, and every file it opens along the way lands in context. The second one goes straight to the point.
> You can also point at patterns: "follow the way the existing codes are written in discounts dot J S". That's one file read that saves a lot of guessing.

*Cue: slide "Give specs, examples, and constraints"*
> Habit two: give specs, examples, and constraints. Claude can infer intent, but it can't read your mind.
> Anthropic's best practices guide has a good example. Instead of "implement a function that validates email addresses", say: write a validate email function, here are example test cases, this address is valid, this one isn't, and run the tests after implementing.
> Examples remove ambiguity. Constraints rule out wrong answers: "totals must never go below zero", "no new dependencies", "avoid mocks". And a check, like "run the tests", lets Claude verify its own work instead of guessing it's done.
> Remember the prompt from episode four: add SAVE ten for ten percent off, follow the pattern of the existing code, totals never below zero, add tests, and run them. Every part of that sentence closes off a wrong turn Claude might otherwise take, and each wrong turn would have cost context to undo.

*Cue: slide "Share the error output"*
> Habit three: share the actual error. "The build is failing" gives Claude nothing to work with. Paste the error message, the stack trace, the failing test output. The docs suggest something like: the build fails with this error, then the error itself, fix it, verify the build succeeds, and address the root cause instead of suppressing the error.
> You can also run the command inside the session. Start a message with an exclamation mark to run it in shell mode, and the output lands in the conversation. Or pipe it in from your terminal: for example, cat the error log into claude dash p, and ask it to explain the error.
> One caution: paste the relevant part. A ten-thousand-line log is context too.

*Cue: slide "Let it explore before acting"*
> Habit four: let it explore before it acts. For anything that isn't trivial, I start in plan mode, like in episode four. Claude reads the relevant code and builds an understanding first, and only then proposes changes. That exploration is context well spent: it's reading the right things on purpose.
> You can also just ask questions first. "How are discounts applied in this project?" is a cheap way to check that Claude has found the right code before you ask it to change anything.
> But scope it. One of the failure patterns the docs call out is the infinite exploration: you ask Claude to "investigate" something with no boundaries, and it reads hundreds of files and fills the context. Name the folder, the feature, the question. For really big investigations, the docs suggest using subagents, which explore in their own separate context and only send back a summary. We'll get to those later in the course.

*Cue: slide "One task per session, then start fresh"*
> Habit five: one task per session. The docs have a name for the opposite: the kitchen sink session. You start one task, ask something unrelated, then go back to the first task, and now the context is full of things that don't matter. If you just need a quick side answer, slash b t w asks a question whose answer never enters the conversation history.
> And habit six: start fresh with slash clear. When you finish a task and move to something unrelated, clear the context. The old conversation isn't lost; slash resume brings it back.
> Slash clear is also the fix when a session goes in circles. The docs' rule of thumb: if you've corrected Claude more than twice on the same issue, the context is cluttered with failed approaches. Clear it, and start again with a better prompt that includes what you learned. A clean session with a better prompt almost always beats a long session full of corrections.

**Visual / B-roll:**
- Divider: big "02", "Filling it well".
- Tablet graphic (Illustration): prompt `> fix the rounding bug in @src/dis` with an autocomplete popup listing `src/discounts.js`, `src/cart.js`, `test/discounts.test.js`.
- Two-column slide: **Vague** ("implement a function that validates email addresses") vs **Specific** (function name, example cases, "run the tests"); coral card "Can't read your mind".
- "Share the error output" slide: two points (Paste the real error · Run it in the session) and a terminal strip: `the build fails with this error: …` · `! npm test` · `cat error.log | claude -p "explain this error"`.
- "Explore before acting" slide: plan mode reminder, "Scope it" box, terminal strip contrasting `investigate the app` (grey) with `in src/cart/, how are discounts applied?` (white).
- "One task per session" slide: two points (One task per session · Start fresh with /clear) and a terminal strip: `/btw  quick side question` · `/clear  new task, empty context` · `/resume  bring the old one back`.

---

### 10:15–10:50 · Before you hit Enter
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: checklist slide*
> Here's a quick checklist I run before I hit Enter on a real task.
> Right files: did I point at them, or will Claude have to go searching?
> Clear spec: did I give the constraints, an example, and a way to check the result?
> Evidence: if something's broken, did I paste the actual error?
> And a clean slate: is this session about this task, or is it carrying leftovers from the last one?

**Visual / B-roll:**
- Four numbered columns: 01 Right files · 02 Clear spec · 03 Real evidence · 04 Clean slate.

---

### 10:50–11:30 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: quote slide*
> Here's the mental model: context is the agent's working memory. Fill it with what the task needs, and keep everything else out.

*Cue: recap slide*
> Quick recap. The context window holds everything Claude knows about your session, and every file, output, and message adds to it. As it fills, and as irrelevant content piles up, quality drops, so check it with slash context. And fill it well: point at files, give specs and examples, share real errors, explore before acting, keep one task per session, and clear between tasks.

*Cue: next-episode slide*
> Today was about filling context well. Next in the playlist is episode six: controlling context and writing good prompts, where we go deeper on compacting, CLAUDE dot M D, and how to write the prompt itself. Subscribe and turn on notifications for the playlist so you don't miss it.

**Visual / B-roll:**
- Quote slide: "Context is the agent's working memory. Fill it with what the task needs, and keep everything else out."
- Recap slide, three items: 01 Working memory · 02 Fills, then drops · 03 Fill it well.
- End screen: "Next: Ep 6 · Controlling Context and Writing Good Prompts", playlist tile, subscribe element.

---

## Production notes
- Spoken word count is about 1,750 words, roughly 11:30 at a steady TTS pace with slide pauses.
- **No invented numbers.** Don't put token counts, window sizes or percentages on screen. The `/context` screen is schematic (bars, no numbers) and labelled "Illustration". The docs' interactive context-window simulation uses "representative" token counts; don't quote them as real.
- The two direct paraphrases from Anthropic's docs ("fills up fast, and performance degrades as it fills"; "file reads dominate context usage") are attributed in the narration to Anthropic's docs. They are paraphrased, not presented as exact quotes, and are not given quote marks on screen.
- The "more than twice" rule for clearing comes from the best practices guide; keep it framed as a rule of thumb.
- Subagents, compaction controls and CLAUDE.md are only previewed here; Episode 6 and later episodes go deeper.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Claude Code Context Management Basics: What Fills the Context Window and How to Fill It Well (Agentic Engineering Ep 5)
2. Why Your AI Coding Agent Gets Worse in Long Sessions, and How to Fix It | Agentic Engineering Ep 5
3. The Context Window Is Your Agent's Working Memory: 6 Habits for Claude Code | Ep 5

### Description
```
Episode 5 of Agentic Engineering, a free course on building real software with AI coding agents.

Most of what makes a Claude Code session go well or badly comes down to one thing: what's in the context window. In this episode I cover what the context window is and why it's the agent's working memory; what fills it (system instructions, CLAUDE.md, auto memory, your conversation, file reads and tool output); why quality drops as it fills and as irrelevant content piles up; how to see your own usage with /context; and six habits for filling context well: point at the right files with @, give specs, examples and constraints, share the real error output, let Claude explore before it acts, keep one task per session, and start fresh with /clear.

Note: terminal screens are drawn illustrations, not recordings, and show no real token counts.

Chapters:
0:00 Why context keeps coming up
0:30 Intro and what we'll cover
1:00 The context window: the agent's working memory
5:15 Filling context well: six habits
10:15 Before you hit Enter: a checklist
10:50 Recap and next episode

Official docs:
Explore the context window: https://code.claude.com/docs/en/context-window
How Claude Code works: https://code.claude.com/docs/en/how-claude-code-works
Best practices: https://code.claude.com/docs/en/best-practices
Interactive mode: https://code.claude.com/docs/en/interactive-mode
Commands: https://code.claude.com/docs/en/commands

Next in the playlist: Ep 6 · Controlling Context and Writing Good Prompts

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, claude code context window, context management, claude code context, claude code /context, claude code /clear, claude.md, prompt engineering for coding, ai coding agent, agentic coding, context engineering, claude code tips, claude code best practices, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"CONTEXT = MEMORY"**, with a smaller line under it: **"fill it well"**.
Visual: a tall bar filling from grey to coral, the top portion scribbled with noise; a small `/context` terminal tag. "EP 5" badge.

---

## Suggested slide list (Episode 5 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Context Management Basics | Agentic Engineering · Episode 5 |
| 2 | Today | 01 What it is · 02 What fills it · 03 Why quality drops · 04 Filling it well |
| 3 | 01 · The basics | What's in Claude's working memory |
| 4 | The agent's working memory | Everything · Fills up · Fresh |
| 5 | What fills it | Startup → Your prompt → File reads → Tool output → Replies |
| 6 | Before you type, and as it works | Startup items; one terminal line vs a whole file; file reads dominate |
| 7 | Why quality drops | Fuller → more mistakes; noisier → less focus; auto-compact; rules in CLAUDE.md |
| 8 | See it: /context | Breakdown by category, suggestions, which memory files loaded; /memory |
| 9 | 02 · Filling it well | What the task needs, nothing else |
| 10 | Point at the right files | @ mentions; be specific so it reads less; point at patterns |
| 11 | Give specs, examples, constraints | Vague vs specific; a check it can run |
| 12 | Share the error output | Paste the real error; ! shell mode; pipe into claude -p |
| 13 | Let it explore before acting | Plan mode; scope the investigation; subagents later |
| 14 | One task, then start fresh | Kitchen sink session; /btw; /clear; two corrections rule |
| 15 | Before you hit Enter | Right files · Clear spec · Real evidence · Clean slate |
| 16 | The mental model | "Context is the agent's working memory. Fill it with what the task needs, and keep everything else out." |
| 17 | Recap | Working memory · Fills, then drops · Fill it well |
| 18 | Next: Controlling Context and Writing Good Prompts | Episode 6 |

## Sources
- Explore the context window: https://code.claude.com/docs/en/context-window (the context window "holds everything Claude knows about your session"; what loads before you type: CLAUDE.md, auto memory, environment info, MCP tool names, skill descriptions; file reads show as one line but their content enters context; "file reads dominate context usage"; `/context` live breakdown by category with optimization suggestions and which CLAUDE.md / auto memory files loaded; `/memory`; `/clear` between tasks because old conversation crowds out what you need next; simulation numbers are representative only).
- How Claude Code works: https://code.claude.com/docs/en/how-claude-code-works (what the context window holds; sessions are independent and start fresh; when context fills up: older tool outputs cleared first, then summarized, early detailed instructions may be lost, put persistent rules in CLAUDE.md; subagents use their own context window).
- Best practices: https://code.claude.com/docs/en/best-practices ("context window fills up fast, and performance degrades as it fills"; forgetting earlier instructions / more mistakes; specific prompts and the validateEmail example; reference files with `@`; pipe data with `claude -p`; paste the error and address the root cause; explore → plan → code; infinite exploration and kitchen sink failure patterns; `/btw`; `/clear` between tasks and after two failed corrections; subagents for investigation).
- Interactive mode: https://code.claude.com/docs/en/interactive-mode (`@` file path mention with autocomplete; `!` shell mode adds command output to the conversation).
- Commands: https://code.claude.com/docs/en/commands (`/context`, `/memory`, `/clear`, `/resume`, `/btw`).
- Episode 4 reference: /workspace/agentic-course/day05-ep04-script.md.
