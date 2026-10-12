# Day 13 · Episode 12: What Subagents Are and When to Use Them

**Series:** Agentic Engineering (free YouTube course) · Week 2
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 6:30
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 6 lessons):** (1) Introduction to Subagents · (2) When to Use a Subagent

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal view with voiceover. Every terminal view in this episode is a **drawn graphic** with a coral "Illustration" tag, not a screen recording. Prompts are written for the course; no subagent output is shown as real.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:20 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:20–0:45 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 0:45–2:45 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · What a subagent is, and the built-in ones | Lesson 1 |
| 2:45–4:00 | [VOICEOVER + SLIDE] | Part 2 · Why it helps | Lesson 1 |
| 4:00–6:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · When to use one, and when not | Lesson 2 |
| 6:00–6:30 | [VOICEOVER + SLIDE] | Mental model, recap + CTA | n/a |

---

## Script

### 0:00–0:20 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we set up CLAUDE dot M D and learned to keep it true over time. That's how you keep the main session well informed.
> Today is about keeping it clean. Because some work, like reading dozens of files or wading through test logs, would bury your conversation in output you'll never look at again.

**Visual / B-roll:**
- Episode 11 checklist card, then a main-session panel filling up with logs. Cut to the title card.

### 0:20–0:45 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twelve: what subagents are, and when to use them.

*Cue: agenda slide*
> Four parts. What a subagent is. The built-in ones. Why they help. And when to use one, and when not to. The screens are illustrations, as always.

**Visual / B-roll:**
- Agenda: 01 What it is · 02 Built-ins · 03 Why it helps · 04 When to use.

### 0:45–2:45 · Part 1: What a subagent is
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · What is a subagent"*
> Part one. What is a subagent?

*Cue: slide "Its own context"*
> A subagent is a specialized assistant that Claude can hand a task to. The docs describe three things that make it separate. It runs in its own context window. It has its own system prompt. And it has its own tool access and permissions.
> It does the work there, in its own space, and sends back only the result, usually a summary. All the files it read and the output it saw stay in its context, not yours.

*Cue: slide "How delegation works"*
> Here's the flow. You ask for something. Claude sees a task that matches a subagent's description and delegates it. The subagent works independently. A summary comes back. And you carry on in the main conversation.
> That description matters: Claude uses it to decide when to delegate. You can also ask for a subagent directly, by naming it in your prompt.

*Cue: slide "The built-in ones"*
> Claude Code ships with built-in subagents that it uses automatically when they fit. Three are worth knowing.
> Explore is a fast, read-only agent for searching and understanding a codebase. It can't write or edit files.
> When Claude calls it, it picks how thorough to be: quick for a targeted lookup, medium for balanced exploration, or very thorough for a full analysis.
> Plan is a read-only research agent used in plan mode, so research output stays out of the main conversation while you plan.
> And general-purpose handles complex, multi-step tasks that need both exploration and changes.
> One detail from the docs: Explore and Plan skip your CLAUDE dot M D files to keep research fast. Other built-in and custom subagents load them.

**Visual / B-roll:**
- Black panel: Own context · Own prompt and tools · Returns a summary.
- Five-box flow: You ask → Claude delegates → Subagent works → Summary → You continue.
- Built-ins card: Explore · Plan · General-purpose, with an Illustration terminal.

### 2:45–4:00 · Part 2: Why it helps
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "02 · Why it helps"*
> Part two. Why it helps.

*Cue: slide "Main context, with and without"*
> Picture the cart project. I want to know every place a discount gets applied. Without a subagent, Claude reads cart dot J S, discounts dot J S, checkout, and the tests, all in my main conversation. All of that content sits in my context for the rest of the session.
> With a subagent, that reading happens in a separate context. What comes back is a short list: these three places, in these files. My main conversation stays clean for the actual work.

*Cue: slide "Why subagents help"*
> The docs list the benefits. One: preserve context, by keeping exploration out of your main conversation. Two: enforce constraints, by limiting which tools a subagent can use. Three: specialize behaviour, with a focused system prompt for one kind of job. And four: run research in parallel, with several subagents each exploring an independent area.

**Visual / B-roll:**
- Two columns: Without (files fill the main context) vs With (only the summary returns).
- Four numbered benefits.

### 4:00–6:00 · Part 3: When to use one, and when not
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · When to use one"*
> Part three. When to use one.

*Cue: slide "Use a subagent when"*
> The docs give clear signals. Use a subagent when the task produces verbose output you don't need in your main context. When you want specific tool restrictions. And when the work is self-contained and can come back as a summary.
> In practice, that's research across many files, reviews, and focused, repetitive jobs.

*Cue: slide "Cart examples"*
> Two cart examples. First, test logs: use a subagent to run the test suite and report only the failing tests with their error messages. The full log stays in the subagent. I get the two lines that matter.
> Second, parallel research: research cart dot J S, discounts dot J S, and the checkout code in parallel using separate subagents. Each one explores its own area, and Claude combines the findings. That works best when the paths don't depend on each other.
> You don't always have to wait for Claude to decide. Naming it in the prompt works too: use the Explore subagent to find where discount codes are validated. Claude still decides whether to delegate, but you've made the intent clear.
> One caution from the docs: every result comes back into your main conversation, so many subagents each returning a long report can still fill your context. Ask for short summaries.

*Cue: slide "Keep it in the main conversation"*
> And when not to. Stay in the main conversation when the task needs frequent back-and-forth. When several phases share a lot of context, like planning, implementing, and testing the same feature. When it's a quick, targeted change, like renaming a variable. And when latency matters, because a fresh subagent starts from scratch and needs time to gather context.
> On the cart project, fixing a typo in an error message is a main-conversation job. Sending it to a subagent would just add a round trip.
> And if you just have a question about something already in the conversation, slash B T W is the lighter tool.

**Visual / B-roll:**
- Black panel: Verbose output · Self-contained · Parallel research.
- Two points + Illustration terminal with the two cart prompts.
- Four numbered items: Back-and-forth · Shared context · Quick change · Latency.

### 6:00–6:30 · Mental model, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model: send out the work you don't need to watch. Keep the work you need to steer.

*Cue: recap slide*
> Recap. A subagent has its own context, prompt, and tools, and returns a summary. It helps by keeping your main context clean, enforcing constraints, specializing, and running research in parallel. Use it for verbose, self-contained work. Keep tight back-and-forth and quick changes in the main conversation.

*Cue: next-episode slide*
> Next in the playlist is episode thirteen: building a subagent, plus a reviewer. We'll write our own for the cart project. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 13 · Building a Subagent (plus a Reviewer)".

---

## Production notes
- Spoken word count is about 920 words, roughly 6 to 7 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal is a drawn graphic with a coral "Illustration" corner tag. The two cart prompts follow the docs' example prompts, adapted to the cart project; no subagent output is shown.
- Built-ins named: Explore (read-only; Write and Edit denied), Plan (read-only research in plan mode), general-purpose (all tools available to subagents). The docs also list helper agents (claude, statusline-setup, claude-code-guide); the narration leaves those out.
- The quote line is my own mental model, not a docs quote.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. What Are Claude Code Subagents (and When Should You Use One)? | Agentic Engineering Ep 12
2. Subagents Explained: Keep Your Main Context Clean | Agentic Engineering Ep 12
3. Claude Code Subagents: Explore, Plan, General-Purpose and When to Delegate | Ep 12

### Description
```
Episode 12 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode: what a subagent is in Claude Code (a specialized assistant with its own context window, system prompt and tool access that returns a summary); the built-in Explore, Plan and general-purpose subagents; why subagents help (preserve context, enforce constraints, specialize, parallel research); and when to use one versus staying in the main conversation, with examples from a small Node.js cart project.

Note: screens are drawn illustrations, not recordings.

Chapters:
0:00 Keeping the main session clean
0:20 Intro and what we'll cover
0:45 What a subagent is, and the built-ins
2:45 Why it helps
4:00 When to use one, and when not
6:00 Recap and next episode

Official docs:
Subagents: https://code.claude.com/docs/en/sub-agents

Next in the playlist: Ep 13 · Building a Subagent (plus a Reviewer)

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code subagents, subagents, explore subagent, general-purpose agent, context window, ai coding agent, parallel research, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"DELEGATE IT"**, small line: **"subagents, explained"**.
Visual: a main-session card with one short summary line, next to a busy subagent card full of file names. "EP 12" badge.

---

## Suggested slide list (Episode 12 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | What Subagents Are and When to Use Them | Agentic Engineering · Episode 12 |
| 2 | Four parts | 01 What it is · 02 Built-ins · 03 Why it helps · 04 When to use |
| 3 | 01 · What is a subagent | Its own context |
| 4 | Its own context | Own context · Own prompt and tools · Returns a summary |
| 5 | How delegation works | You ask → Delegates → Works → Summary → Continue |
| 6 | The built-in ones | Explore · Plan · General-purpose |
| 7 | 02 · Why it helps | Clean main context |
| 8 | With and without | Files fill the main context vs only the summary returns |
| 9 | Why subagents help | Context · Constraints · Specialize · Parallel |
| 10 | 03 · When to use one | And when not |
| 11 | Use a subagent when | Verbose · Self-contained · Parallel |
| 12 | Cart examples | Test log summary; parallel research |
| 13 | Keep it in the main chat | Back-and-forth · Shared context · Quick change · Latency |
| 14 | Quote | Send out what you don't need to watch |
| 15 | Recap | What it is · Why · When |
| 16 | Next | Episode 13 · Building a Subagent (plus a Reviewer) |

---

## Sources
- Subagents: https://code.claude.com/docs/en/sub-agents (own context window, custom system prompt, specific tool access, independent permissions; returns results/summary; Claude delegates using each subagent's description; built-in Explore (fast, read-only, Write and Edit denied; thoroughness quick, medium, very thorough), Plan (read-only research in plan mode), general-purpose (exploration and modification); Explore and Plan skip CLAUDE.md files; benefits: preserve context, enforce constraints, reuse configurations, specialize behavior, control costs; patterns: isolate high-volume operations ("run the test suite and report only the failing tests"), run parallel research; warning that returned results consume context; choose main conversation for back-and-forth, shared context across phases, quick targeted changes, latency; choose subagents for verbose output, tool restrictions, self-contained work; `/btw` for questions about the current conversation; invoke by naming the subagent in your prompt).
- Episode 11 reference: /workspace/agentic-course/day12-ep11-script.md.
