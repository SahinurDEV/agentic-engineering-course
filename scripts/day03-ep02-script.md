# Day 3 · Episode 2: Claude Code 101

**Series:** Agentic Engineering (free YouTube course) · Week 1: Foundations
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 7:45
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 2 lessons):** (1) Introduction to Claude Code · (2) How Claude Code Works · (3) Anatomy of a Session

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. In this episode every terminal view is a **drawn, animated terminal graphic** built from the slide art (typed lines appearing one by one), not a screen recording. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:25 | [VOICEOVER + SCREEN] | Hook | n/a |
| 0:25–0:55 | [VOICEOVER + SLIDE] | Intro + roadmap for today | n/a |
| 0:55–2:15 | [VOICEOVER + SLIDE] | What Claude Code is, installing, starting it | Lesson 1 |
| 2:15–4:15 | [VOICEOVER + SLIDE] | How Claude Code works: the agent loop, tools, permissions | Lesson 2 |
| 4:15–6:45 | [VOICEOVER + SCREEN] | Anatomy of a session (drawn walkthrough) + context + first commands | Lesson 3 |
| 6:45–7:45 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SCREEN]

**Say:**
> In the last episode, I gave an agent a goal, and it read the project, made the change, and ran the tests on its own.
> Today we open the hood. What is Claude Code, how does it actually decide what to do next, and what happens, step by step, between the moment you type a request and the moment it says it's done?

**Visual / B-roll:**
- Drawn terminal graphic (dark window, coral prompt): `$ cd ep01-cart` then `$ claude`, then a typed request. Tool-call lines appear one by one: `Read src/discounts.js`, `Edit test/discounts.test.js`, `Bash npm test`. Freeze, then cut to the title card.
- Small corner tag on all drawn terminals: "Illustration".

---

### 0:25–0:55 · Intro + today's roadmap
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: title slide*
> Welcome back to Agentic Engineering. I'm Sahinur Islam, a full-stack software engineer, and this is episode two: Claude Code one-oh-one.

*Cue: agenda slide*
> Three parts today. First, what Claude Code is, and how you get it running. Second, how it works: the agent loop, the tools, and the permission prompts that keep you in control. And third, the anatomy of a session, from typing claude in a project folder to reviewing what changed.

**Visual / B-roll:**
- Title slide: "Claude Code 101", "Agentic Engineering · Episode 2", name card "Sahinur Islam".
- Agenda: 01 What it is · 02 How it works · 03 Anatomy of a session.

---

### 0:55–2:15 · Part 1: What Claude Code is
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: slide "What is Claude Code?"*
> So, what is Claude Code?
> Claude Code is Anthropic's agentic coding tool. The version we'll use in this course runs in your terminal, inside your project. You describe what you want in plain language, and it reads your codebase, edits files, and runs commands to get it done.
> It's also available in I D E extensions, a desktop app, and the browser, but the agent underneath is the same. In this course, we'll live in the terminal.

*Cue: slide "Install it, then start it"*
> Getting started is short. On mac O S, Linux, or W S L, the recommended install is one command from Anthropic's docs: curl, with the install script from claude dot A I. Windows has its own PowerShell command, and Homebrew works too.
> Then check it with claude dash dash version. To start, you go into a project folder and type claude. The first time, it asks you to log in. You'll need a Claude subscription or an Anthropic Console account.

*Cue: slide "It sees the project, not just a file"*
> Here's the part that matters most. An inline assistant mostly sees the file you have open. When you run claude in a folder, Claude Code can work with the whole project: the files in that folder and below it, your terminal, and your git state, like the current branch and uncommitted changes.
> You don't paste context in. It goes and gets it.

**Visual / B-roll:**
- Slide "What is Claude Code?": three coral boxes **Reads** (your codebase) · **Edits** (files across the project) · **Runs** (commands, tests, git). Caption: "Anthropic's agentic coding tool. Lives in your terminal, works in your repo."
- Slide "Install it, then start it": drawn terminal with `curl -fsSL https://claude.ai/install.sh | bash`, `claude --version`, `cd your-project`, `claude`. Small note: "Windows: see the official docs for the PowerShell command."
- Slide "It sees the project, not just a file": a drawn editor window with one file highlighted vs a folder tree fully highlighted. Labels: files · terminal · git state.

---

### 2:15–4:15 · Part 2: How Claude Code works
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: divider "02 · How it works"*
> Part two. How Claude Code works.

*Cue: slide "The agent loop"*
> Remember the agent loop from episode one? Anthropic's own docs describe Claude Code's version in three phases: gather context, take action, and verify results.
> You give it a task. It gathers context: it searches and reads the files it needs. It takes action: it edits code, or runs a command. Then it verifies: it runs the tests, or checks the output. If the job isn't done, it goes around again, using what it just learned to choose the next step.
> And you're part of that loop too. You can interrupt at any point and steer it.

*Cue: slide "Models reason, tools act"*
> Two things power that loop. The model reasons: it reads code, works out what needs to change, and decides the next step. The tools act: they're how it actually touches your project.
> Claude Code is the layer around the model. It provides the tools and manages what the model can see. Without tools, a model can only answer with text. With tools, it can do the work.

*Cue: slide "The core tools"*
> The core tools fall into a few groups. Reading files. Searching: finding files by name, and searching their contents. Editing: changing existing files and creating new ones. And running shell commands: your tests, your build, git, package managers. It can also search the web and fetch documentation when it needs to.
> Every tool call returns a result, and that result feeds the next decision.

*Cue: slide "You stay in control"*
> Now, an agent that can edit files and run commands needs guardrails. That's what permissions are for.
> Depending on the permission mode you're in, Claude Code stops and asks before it edits a file or runs a command. You see exactly what it wants to do, and you approve it or say no. You can also allow commands you trust, like your test command, so it doesn't ask every single time.
> And if an edit goes wrong, Claude Code takes a snapshot before it changes a file, so you can rewind. We'll cover the permission modes properly in the next episode.

**Visual / B-roll:**
- Divider: big "02", "How it works".
- Loop diagram: *Your task → Gather context → Take action → Verify → Done*, with a coral return arrow "Not done yet? Loop back". Small source tag: "Phases as described in Anthropic's Claude Code docs".
- Two-part slide: black panel "Model reasons / Tools act", coral panel "The harness: Claude Code".
- Four numbered columns: 01 Read · 02 Search · 03 Edit · 04 Run commands, each with one example line.
- Permissions slide: drawn terminal showing an illustrative approval step: `Edit test/discounts.test.js` with options `Yes / No`; side boxes "It asks first" and "You decide".

---

### 4:15–6:45 · Part 3: Anatomy of a session
**Marker:** [VOICEOVER + SCREEN] (drawn terminal walkthrough; opens with a [VOICEOVER + SLIDE] divider)

**Production note:** this walkthrough is an illustration drawn on slides, not a recording. Real Claude Code output looks different from run to run and changes between versions; the graphic shows the shape of a session, not exact on-screen text.

**Say:**

*Cue: divider "03 · Anatomy of a session"*
> Part three. The anatomy of a session. I'll walk through one, drawn out step by step, using the little cart project from episode one.

*Cue: walkthrough slide, step 1 highlighted (start)*
> Step one: start. I go into the project folder and type claude. The session is tied to that folder. Above the prompt, Claude Code shows its version, the current model, and the working directory.

*Cue: step 2 highlighted (prompt)*
> Step two: the prompt. I type a plain-language request: add a test that checks a discount can never push the total below zero, then run the tests.

*Cue: step 3 highlighted (gather context)*
> Step three: it gathers context. I didn't tell it which files to open. It searches the project, reads the discounts file, and looks at the existing tests to see how they're written.

*Cue: step 4 highlighted (propose and approve)*
> Step four: it proposes an action. It shows me the edit it wants to make to the test file, and asks. I read it, and approve. Then it wants to run N P M test, and asks again. I approve that too.

*Cue: step 5 highlighted (verify and report)*
> Step five: it verifies and reports. It reads the test output, and if something failed, it would go around the loop again. When it's done, it summarizes what it changed. And then I do my part: I look at the diff myself.

*Cue: slide "What the session holds"*
> While all that happens, the session is building up context. The context window holds the conversation, the contents of every file it read, the output of every command, your CLAUDE dot M D file if you have one, and Claude Code's own instructions.
> Two things to remember. First, context fills up. Claude Code compacts it automatically when it gets close to the limit, but details from early in the conversation can get lost. Second, each new session starts fresh. It doesn't carry the conversation over, so rules you want every time belong in CLAUDE dot M D. That gets its own episodes later in the course.

*Cue: quote slide*
> So here's the mental model I want you to leave with: you don't paste context in. It goes and gets it. And you decide what it's allowed to do.

*Cue: slide "Your first commands"*
> A few commands to get you through your first session. Type slash help to see what's available. Slash context shows what's using up the context window. Slash clear starts a fresh conversation when you switch tasks. Press the Escape key to stop Claude mid-step and redirect it. And slash exit when you're done. If you want to come back later, claude dash dash continue picks up your most recent conversation in that folder.

**Visual / B-roll:**
- Divider: big "03", "Anatomy of a session".
- Walkthrough slide: left column lists five steps (Start · Prompt · Gather context · Propose and approve · Verify and report); right side is a drawn terminal transcript that reveals one block per step: `$ claude` / `> add a test that checks a discount never pushes the total below 0, then run the tests` / `Search, Read src/discounts.js, Read test/discounts.test.js` / `Edit test/discounts.test.js  (approve? Yes)` / `Bash npm test  (approve? Yes)` / `tests pass, summary`. Highlight each step in coral as it is spoken. Corner tag "Illustration".
- "What the session holds": two columns. **In the context window:** conversation · files it read · command output · CLAUDE.md · system instructions. **Keep in mind:** fills up, then auto-compacts · each session starts fresh · persistent rules go in CLAUDE.md.
- Quote slide, big type: "It goes and gets the context. You decide what it's allowed to do."
- Commands slide: drawn terminal card listing `/help`, `/context`, `/clear`, `Esc`, `/exit`, `claude --continue`, each with a short label.

---

### 6:45–7:45 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: recap slide*
> Quick recap. Claude Code is Anthropic's agentic coding tool: it runs in your terminal and works across your whole project. It works in a loop: gather context, take action, verify, with tools for reading, searching, editing, and running commands. And a session is a conversation tied to a folder, where it proposes, you approve, and everything it reads fills the context window.

*Cue: next-episode slide*
> Next episode is Claude Code controls: the edit and permission modes, the slash commands worth knowing, choosing models, and the keyboard shortcuts that make it fast. Subscribe and turn on notifications for the playlist, and I'll see you tomorrow.

**Visual / B-roll:**
- Recap slide with three items appearing as spoken: 01 Terminal agent, whole project · 02 Gather, act, verify · 03 You approve, context fills.
- End screen: "Next: Ep 3 · Claude Code Controls", playlist tile, subscribe element.

---

## Production notes
- Spoken word count is about 1,200 words, roughly 7:45 to 8:00 at a steady TTS pace with slide pauses.
- No live demo is recorded for this episode. All terminal views are drawn graphics labelled "Illustration". Do not add footage that implies a recording unless you actually record one, and then rewrite the walkthrough lines to match what really happened.
- Keep the permission explanation general ("depending on the permission mode"). The available modes and the default have changed between Claude Code versions; Episode 3 covers them in detail.
- Re-check the install command against the official docs on publish day, since install methods change.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Claude Code 101: How Claude Code Actually Works (Agentic Engineering Ep 2)
2. What Happens Inside a Claude Code Session? The Agent Loop Explained | Agentic Engineering Ep 2
3. Claude Code for Beginners: Install, Agent Loop, Permissions and Your First Session | Ep 2

### Description
```
Episode 2 of Agentic Engineering, a free course on building real software with AI coding agents.

Claude Code is Anthropic's agentic coding tool. It runs in your terminal, works across your whole project, and can read files, search, edit code, and run commands. In this episode I explain what Claude Code is and how to install and start it, how it works (the agent loop of gathering context, taking action, and verifying, plus the tools behind it), how permission prompts keep you in control, and the anatomy of a session: from typing claude in a project folder to reviewing the diff. I also cover what fills the context window and the first commands to know: /help, /context, /clear, Esc, /exit, and claude --continue.

"You don't paste context in. It goes and gets it. You decide what it's allowed to do."

Chapters:
0:00 What happens inside a session?
0:25 Intro and what we'll cover
0:55 What is Claude Code?
2:15 How Claude Code works: the agent loop
4:15 Anatomy of a session
6:45 Recap and next episode

Official docs: https://docs.claude.com/en/docs/claude-code/overview
Next: Ep 3 · Claude Code Controls (edit modes, slash commands, models, shortcuts)

I'm Sahinur Islam, a full-stack software engineer. New episode every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, claude code tutorial, claude code 101, claude code for beginners, how claude code works, agentic coding, ai coding agent, agent loop, claude code permissions, claude code session, context window, anthropic claude code, agentic engineering, ai for software engineers, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"CLAUDE CODE 101"**, with a smaller line under it: **"Gather. Act. Verify."**
Visual: a dark terminal window with a coral `$ claude` prompt on the left; on the right a three-step loop ring (Gather → Act → Verify). Small "EP 2" badge.

---

## Suggested slide list (Episode 2 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Claude Code 101 | Agentic Engineering · Episode 2 |
| 2 | Today | What it is · How it works · Anatomy of a session |
| 3 | What is Claude Code? | Anthropic's agentic coding tool: reads, edits, runs, in your terminal and repo |
| 4 | Install it, then start it | Install script, claude --version, cd your-project, claude |
| 5 | It sees the project, not just a file | Files, terminal, git state: you don't paste context in |
| 6 | 02 · How it works | The loop, the tools, the permissions |
| 7 | The agent loop | Your task → Gather context → Take action → Verify (loop back) → Done |
| 8 | Models reason, tools act | Claude Code is the harness around the model |
| 9 | The core tools | Read · Search · Edit · Run commands |
| 10 | You stay in control | It asks before edits and commands (by mode); checkpoints let you rewind |
| 11 | 03 · Anatomy of a session | From `claude` to reviewing the diff |
| 12 | A session, step by step | Start → Prompt → Gather → Propose and approve → Verify and report |
| 13 | What the session holds | Context window contents; fills up, starts fresh, CLAUDE.md persists |
| 14 | The mental model | "It goes and gets the context. You decide what it's allowed to do." |
| 15 | Your first commands | /help · /context · /clear · Esc · /exit · claude --continue |
| 16 | Recap | Terminal agent, whole project · Gather, act, verify · You approve, context fills |
| 17 | Next: Claude Code Controls | Edit modes, slash commands, models, shortcuts |

## Sources
- Claude Code overview: https://docs.claude.com/en/docs/claude-code/overview (redirects to code.claude.com/docs/en/overview): definition, surfaces, install commands, `cd your-project` then `claude`, login on first use.
- How Claude Code works: https://code.claude.com/docs/en/how-claude-code-works: agentic loop (gather context, take action, verify results), models + tools, tool categories, what Claude can access, sessions start fresh, context window and auto-compaction, `/context`, checkpoints (snapshot before edits, Esc twice to rewind), permission modes and Shift+Tab, allowing commands in settings, Esc to interrupt.
- Quickstart: https://code.claude.com/docs/en/quickstart: `claude --version`, session header (version, model, working directory), `/help`, `/clear`, `/exit`, `claude -c` (continue), approving a change when asked.
