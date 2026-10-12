# Day 4 · Episode 3: Claude Code Controls

**Series:** Agentic Engineering (free YouTube course) · Week 1: Foundations
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 9:30
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 2 lessons):** (1) Edit and Permission Modes · (2) Slash Commands · (3) Models and Effort Levels · (4) Key Shortcuts

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. In this episode every terminal view is a **drawn, animated terminal graphic** built from the slide art and labelled "Illustration", not a screen recording. Nothing in this episode is presented as a live recording.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:25 | [VOICEOVER + SCREEN] | Hook | n/a |
| 0:25–0:55 | [VOICEOVER + SLIDE] | Intro + roadmap for today | n/a |
| 0:55–3:45 | [VOICEOVER + SLIDE] | 01 · Permission modes: Manual, Accept edits, Plan, Auto; Shift+Tab | Lesson 1 |
| 3:45–5:30 | [VOICEOVER + SCREEN] | 02 · Slash commands worth knowing | Lesson 2 |
| 5:30–7:35 | [VOICEOVER + SLIDE] | 03 · Models and effort levels | Lesson 3 |
| 7:35–8:50 | [VOICEOVER + SCREEN] | 04 · Key shortcuts | Lesson 4 |
| 8:50–9:30 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SCREEN]

**Say:**
> In episode two, I kept saying the same phrase: depending on the permission mode. Claude Code asks before it edits or runs something, depending on the mode you're in.
> Today, that phrase gets real. One key changes how much Claude Code is allowed to do on its own, one command changes which model is thinking, and a handful of shortcuts make the whole thing fast.

**Visual / B-roll:**
- Drawn terminal graphic: the status bar under the prompt changes as an on-screen key cap "Shift + Tab" is pressed: `manual mode on` → `accept edits on` → `plan mode on` → `auto mode on`. Then `/model` types into the prompt. Freeze, cut to the title card.
- Corner tag on all drawn terminals: "Illustration".

---

### 0:25–0:55 · Intro + today's roadmap
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: title slide*
> Welcome back to Agentic Engineering. I'm Sahinur Islam, a full-stack software engineer, and this is episode three: Claude Code controls.

*Cue: agenda slide*
> Four parts today. First, the permission modes, and how to switch between them. Second, the slash commands that are actually worth knowing. Third, choosing a model and an effort level. And fourth, the keyboard shortcuts I'd learn first.

**Visual / B-roll:**
- Title slide: "Claude Code Controls", "Agentic Engineering · Episode 3", name card "Sahinur Islam".
- Agenda: 01 Permission modes · 02 Slash commands · 03 Models and effort · 04 Shortcuts.

---

### 0:55–3:45 · Part 1: Permission modes
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: divider "01 · Permission modes"*
> Part one. Permission modes.

*Cue: slide "Shift plus Tab cycles the modes"*
> A permission mode sets which actions Claude Code can take without asking you first. You switch modes during a session with one key: Shift plus Tab. Each press moves to the next mode, and the status bar under the prompt shows which one is active.
> The cycle goes Manual, then Accept edits, then Plan, and, when it's available to you, Auto, and then around again. On recent versions, new terminal sessions often start in Auto, so your first press takes you to Manual. Don't memorize the starting point. Just read the status bar.

*Cue: slide "Mode by mode", card list builds one row at a time*
> Here's what each mode lets through without a prompt.
> Manual mode only lets reads through. Claude Code stops and asks before it edits a file, runs a shell command, or reaches the network. Use it for sensitive work, or code you don't know yet.
> Accept edits lets Claude create and edit files in your working directory, and run common file commands like make directory, move, and copy, without asking. Other commands still ask. It's great when you plan to review the result in git diff afterwards.
> Plan mode is research only. Claude reads, explores, and writes a plan, but it doesn't edit your source files until you approve that plan.
> And Auto mode hands the routine approvals to a separate classifier model, which reviews actions in the background and blocks risky ones, like a force push, or downloading and running a script. Anthropic's docs are clear that it reduces prompts, but it doesn't guarantee safety.
> There's also a bypass permissions mode that skips the checks entirely. The docs say to use it only in isolated containers or virtual machines, so we'll leave it there.

*Cue: slide "Plan mode", drawn plan-approval prompt*
> Plan mode deserves a closer look, because it's the one I use most for bigger changes. You can press Shift plus Tab until the status bar says plan mode, or start a single prompt with slash plan, for example: slash plan, fix the auth bug.
> Claude explores the code and presents a plan. Then it asks how to proceed: approve and let it continue in auto mode, approve but review each edit yourself, or say no and keep planning. If you want to change the plan before it starts, Control plus G opens it in your text editor.

*Cue: slide "Which mode, when?"*
> So which mode, when? My rule of thumb: plan first for anything big or unfamiliar. Manual when the work is sensitive and I want to see every action. Accept edits when I'm iterating and I'll read the diff anyway. Auto for longer tasks where I trust the direction. You can switch at any moment, so it's not a big commitment.

**Visual / B-roll:**
- Divider: big "01", "Permission modes".
- Cycle diagram: black key cap "Shift+Tab" → Manual → Accept edits → Plan → Auto (coral), with a return arrow "Press again: back to Manual". Small note: "Auto appears when it's available to you."
- Mode-by-mode slide: white card with four rows (Manual: reads only · Accept edits: reads, file edits, common file commands · Plan: reads and plans, no source edits · Auto: a classifier reviews actions); dark terminal showing the four status-bar labels (`manual mode on`, `accept edits on`, `plan mode on`, `auto mode on`); coral column "Bypass permissions: isolated containers and VMs only."
- Plan-mode slide: drawn plan prompt with the three choices (Yes, and use auto mode · Yes, manually approve edits · No, keep planning), labelled "Illustration".
- "Which mode, when?" slide: two columns plus a card.

---

### 3:45–5:30 · Part 2: Slash commands
**Marker:** [VOICEOVER + SCREEN] (drawn terminal graphics; opens with a [VOICEOVER + SLIDE] divider)

**Say:**

*Cue: divider "02 · Slash commands"*
> Part two. Slash commands.

*Cue: drawn terminal, typing a slash opens the menu, then filters*
> A slash command controls Claude Code itself, instead of asking Claude to do work. Type a slash at the start of your message and a menu opens with every command available to you. Keep typing to filter it. Type slash C O, and you'll see things like compact, context, and config.
> The menu also lists skills, which are custom commands. We'll build our own later in the course.

*Cue: slide "Commands for each stage of a session"*
> Here are the ones I'd learn first, grouped by when you'd use them.
> At the start, in a new repo: slash init generates a starter CLAUDE dot M D for the project, and slash permissions lets you manage your allow, ask, and deny rules.
> During a task: slash plan, which we just saw. Slash model and slash effort, which are part three. And slash context, which shows what's filling the context window.
> After a change: slash diff shows what changed in your working tree. Slash rewind rolls the code and the conversation back to an earlier checkpoint. And slash resume takes you back to a previous conversation.

*Cue: slide "Keep context healthy"*
> Three commands keep your context healthy. Slash context shows you what's using the space. Slash compact summarizes the conversation so far to free space, and you can give it a focus, like: slash compact, focus on the API changes. And slash clear starts a new conversation with empty context when you switch tasks. The old one isn't lost; slash resume can bring it back.
> And if you ever forget all of this, slash help lists what's available.

**Visual / B-roll:**
- Divider: big "02", "Slash commands".
- Drawn terminal on the tablet graphic: a list of commands with a filter popup showing `/co` → `/compact`, `/context`, `/config`. Label "Illustration".
- Three-column slide: 01 Start (`/init`, `/permissions`) · 02 During (`/plan`, `/model`, `/effort`, `/context`) · 03 After (`/diff`, `/rewind`, `/resume`).
- "Keep context healthy": two numbered points plus a terminal strip with `/context`, `/compact focus on the API changes`, `/clear`.

---

### 5:30–7:35 · Part 3: Models and effort levels
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: divider "03 · Models and effort"*
> Part three. Models and effort levels.

*Cue: slide "Pick a model"*
> Claude Code can run on different Claude models, and the easiest way to pick one is by alias, so you don't have to remember version numbers. The docs describe three main ones. Sonnet, for daily coding tasks. Opus, for complex reasoning. And Haiku, the fast and efficient model for simple tasks.
> Aliases point to the recommended version for your provider, and they update over time.

*Cue: slide "Switching models", drawn model picker*
> To switch, type slash model. With no argument, it opens a picker. Press Enter to switch and save it as your default for new sessions, or press S to switch for this session only. You can also type the alias directly, like slash model opus, or start with claude dash dash model and an alias.
> One alias I like: opus plan. It uses Opus while you're in plan mode, then switches to Sonnet to carry out the plan.
> And to check which model you're on, slash status shows it, along with your account details.

*Cue: slide "Effort levels"*
> Then there's effort. Effort controls how much the model reasons. The model decides on each step whether, and how much, to think, and the effort level sets how far it's willing to go. Lower effort is faster and cheaper. Higher effort means deeper reasoning, and more tokens.
> The levels are low, medium, high, extra high, and max, but which ones you get depends on the model, and each model has its own default. The docs say the default suits most coding tasks.

*Cue: slide "When to turn it up"*
> So when do you change it? Go lower for quick exchanges where you review every result: a rename, a first sketch, brainstorming. Go higher when verification matters and edge cases are likely, like fixing a bug in an existing codebase. Max is for hard problems you want Claude to grind through on its own, but the docs warn it can overthink, so test it before making it a habit. Max only applies to the current session.
> To set it, use slash effort, which opens a slider, or slash effort followed by a level, like slash effort high. In the model picker, the left and right arrow keys adjust effort too.
> And if you want deeper reasoning for just one prompt, include the word ultrathink anywhere in it. That asks for more thinking on that turn, without changing your session's effort setting.

**Visual / B-roll:**
- Divider: big "03", "Models and effort".
- Three coral squares: **Sonnet** (daily coding) · **Opus** (complex reasoning) · **Haiku** (fast, simple tasks). Caption under each: `/model sonnet`, `/model opus`, `/model haiku`.
- Drawn model picker on the monitor graphic: rows for Default, Sonnet, Opus, Haiku; footer `← → effort · Enter: save default · s: this session`. Label "Illustration".
- Effort slide: black panel listing low · medium · high · xhigh · max; coral strip "Default suits most coding tasks"; note "Available levels depend on the model."
- "When to turn it up": two points (Lower: quick, reviewed steps · Higher: bugs and edge cases) plus terminal strip `/effort`, `/effort high`, `... ultrathink ...`.

---

### 7:35–8:50 · Part 4: Key shortcuts
**Marker:** [VOICEOVER + SCREEN] (drawn keyboard and terminal graphics)

**Say:**

*Cue: slide "Four keys to learn first"*
> Part four. Keyboard shortcuts. If you only learn four, make it these.
> Shift plus Tab, to cycle permission modes.
> Escape, to stop Claude mid-step. It keeps the work done so far, so you can redirect it. On a permission prompt, Escape means no.
> Escape twice, on an empty prompt, opens the rewind menu, so you can go back to an earlier point.
> And Control plus O, which toggles the transcript viewer, where you can see every tool call in detail.

*Cue: slide "The rest of the cheat sheet"*
> A few more that pay off quickly. Start a message with an exclamation mark to run a shell command directly, and its output lands in the conversation. Type an at sign to mention a file path, with autocomplete. Backslash then Enter adds a new line, in any terminal. Control plus R searches your prompt history. Control plus G opens your prompt in your text editor. Control plus C interrupts, or clears what you've typed, and Control plus D, pressed twice, exits.
> And when you forget, type a question mark on an empty prompt to see the shortcut help.

**Visual / B-roll:**
- Four numbered columns: 01 Shift+Tab (cycle modes) · 02 Esc (stop and redirect) · 03 Esc Esc (rewind menu) · 04 Ctrl+O (transcript viewer).
- Cheat-sheet slide: white card "Control", dark terminal "Input", coral column "Help: ? on an empty prompt". Note: "Shortcuts can vary by platform and terminal."

---

### 8:50–9:30 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

**Say:**

*Cue: quote slide*
> Here's how I think about all of these controls: the mode decides what Claude may do on its own. The model and effort decide how hard it thinks. And you decide both.

*Cue: recap slide*
> Quick recap. Shift plus Tab cycles the permission modes: Manual, Accept edits, Plan, and Auto. A handful of slash commands, like init, plan, context, compact, clear, diff, and rewind, cover most of a session. Slash model and slash effort pick the brain and how hard it works. And four keys, Shift plus Tab, Escape, double Escape, and Control plus O, keep you in charge.

*Cue: next-episode slide*
> Next in the playlist is episode four: a real Claude Code session, where we put all of this together from first prompt to reviewed change. Subscribe and turn on notifications for the playlist so you don't miss it.

**Visual / B-roll:**
- Quote slide, big type: "The mode decides what it may do. Model and effort decide how hard it thinks. You decide both."
- Recap slide with three items appearing as spoken: 01 Modes: Shift+Tab · 02 Commands and models · 03 Keys that keep you in charge.
- End screen: "Next: Ep 4 · A Real Claude Code Session", playlist tile, subscribe element.

---

## Production notes
- Spoken word count is about 1,500 words, roughly 9:30 to 10:00 at a steady TTS pace with slide pauses.
- No live session is recorded for this episode. All terminal views are drawn graphics labelled "Illustration". Do not add footage that implies a recording.
- Permission-mode defaults and the cycle order depend on the Claude Code version, plan, and organization settings. The script deliberately says "on recent versions … often start in Auto" and "read the status bar". Re-check the permission-modes page on publish day.
- Do not put specific model version numbers on screen; use the aliases (sonnet, opus, haiku, opusplan). Available effort levels and defaults differ per model.
- Status-bar labels are shown as plain text (`manual mode on`, etc.); the real UI adds small symbols in front of them.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Claude Code Controls: Permission Modes, Slash Commands, Models and Shortcuts (Agentic Engineering Ep 3)
2. Shift+Tab, /model, /effort: The Claude Code Controls Worth Learning First | Agentic Engineering Ep 3
3. Manual, Accept Edits, Plan or Auto? Claude Code Permission Modes Explained | Ep 3

### Description
```
Episode 3 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode I cover the controls that decide how Claude Code works for you: the permission modes (Manual, Accept edits, Plan, and Auto) and how Shift+Tab cycles them; plan mode and its approval step; the slash commands worth learning first (/init, /permissions, /plan, /context, /compact, /clear, /diff, /rewind, /resume, /help); choosing a model with /model (sonnet, opus, haiku, opusplan) and an effort level with /effort, plus the ultrathink keyword; and the keyboard shortcuts that keep you in charge (Shift+Tab, Esc, Esc Esc, Ctrl+O and more).

"The mode decides what it may do. Model and effort decide how hard it thinks. You decide both."

Chapters:
0:00 One key, one command, a few shortcuts
0:25 Intro and what we'll cover
0:55 Permission modes and Shift+Tab
3:45 Slash commands worth knowing
5:30 Models and effort levels
7:35 Keyboard shortcuts
8:50 Recap and next episode

Official docs:
Permission modes: https://code.claude.com/docs/en/permission-modes
Commands: https://code.claude.com/docs/en/commands
Model configuration: https://code.claude.com/docs/en/model-config
Interactive mode and shortcuts: https://code.claude.com/docs/en/interactive-mode

Next in the playlist: Ep 4 · A Real Claude Code Session

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code, claude code tutorial, claude code permission modes, claude code plan mode, accept edits mode, claude code auto mode, claude code slash commands, claude code model, claude code effort level, ultrathink, claude code shortcuts, shift tab claude code, agentic coding, ai coding agent, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"SHIFT + TAB"**, with a smaller line under it: **"Claude Code controls"**.
Visual: a large keyboard key cap "Shift+Tab" on the left; on the right a dark terminal status bar stacking `manual` · `accept edits` · `plan` · `auto` in coral. Small "EP 3" badge.

---

## Suggested slide list (Episode 3 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Claude Code Controls | Agentic Engineering · Episode 3 |
| 2 | Today | 01 Permission modes · 02 Slash commands · 03 Models and effort · 04 Shortcuts |
| 3 | 01 · Permission modes | What it may do without asking |
| 4 | Shift+Tab cycles the modes | Manual → Accept edits → Plan → Auto (when available) → back |
| 5 | Mode by mode | What each mode lets through; status bar labels; bypass only in isolation |
| 6 | Plan mode | /plan or Shift+Tab; approve, approve with manual edits, or keep planning; Ctrl+G |
| 7 | Which mode, when? | Plan for big changes · Manual for sensitive · Accept edits when reviewing the diff · Auto for long trusted tasks |
| 8 | 02 · Slash commands | Control Claude Code itself |
| 9 | Type a slash | The menu lists every command; type to filter |
| 10 | Commands for each stage | Start: /init, /permissions · During: /plan, /model, /effort, /context · After: /diff, /rewind, /resume |
| 11 | Keep context healthy | /context · /compact [focus] · /clear (and /resume) |
| 12 | 03 · Models and effort | Which brain, and how hard it thinks |
| 13 | Pick a model by alias | Sonnet · Opus · Haiku |
| 14 | Switching models | /model picker: Enter saves default, s this session; --model; opusplan; /status |
| 15 | Effort levels | low · medium · high · xhigh · max; depends on the model; default suits most work |
| 16 | When to turn it up | Lower for quick reviewed steps, higher for bugs and edge cases; /effort; ultrathink |
| 17 | 04 · Four keys to learn first | Shift+Tab · Esc · Esc Esc · Ctrl+O |
| 18 | The rest of the cheat sheet | ! shell mode · @ files · \ + Enter · Ctrl+R · Ctrl+G · Ctrl+C · Ctrl+D · ? |
| 19 | The mental model | "The mode decides what it may do. Model and effort decide how hard it thinks. You decide both." |
| 20 | Recap | Modes: Shift+Tab · Commands and models · Keys that keep you in charge |
| 21 | Next: A Real Claude Code Session | Episode 4 |

## Sources
- Permission modes: https://code.claude.com/docs/en/permission-modes (mode table, Manual = config value `default`, acceptEdits auto-approved commands, plan mode and plan-approval options, `/plan` prefix, Ctrl+G to edit the plan, auto mode classifier and "does not guarantee safety", bypassPermissions only in isolated containers/VMs, Shift+Tab cycle order and status-bar labels, auto as starting mode on recent versions).
- Commands reference: https://code.claude.com/docs/en/commands (`/init`, `/permissions`, `/plan`, `/model`, `/effort`, `/context`, `/compact`, `/clear`, `/diff`, `/rewind`, `/resume`, `/status`, `/help`; typing `/` filters the menu).
- Model configuration: https://code.claude.com/docs/en/model-config (aliases sonnet/opus/haiku/opusplan, aliases update over time, `/model` picker Enter vs `s`, `--model`, `/status`, effort levels low–max depending on model, per-model defaults, "default suits most coding tasks", max session-only and prone to overthinking, `/effort` slider, arrow keys in `/model`, `ultrathink`).
- Interactive mode: https://code.claude.com/docs/en/interactive-mode (Shift+Tab, Esc, Esc Esc rewind menu, Ctrl+O transcript viewer, `!` shell mode, `@` file mention, `\` + Enter, Ctrl+R, Ctrl+G, Ctrl+C, Ctrl+D, `?` help panel; shortcuts may vary by platform and terminal).
- Episode 2 reference: /workspace/agentic-course/day03-ep02-script.md.
