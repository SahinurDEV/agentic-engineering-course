# Day 14 · Episode 13: Building a Subagent (plus a Reviewer)

**Series:** Agentic Engineering (free YouTube course) · Week 2 (last episode of Week 2)
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 16:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 6 lessons):** (1) Creating a Subagent · (2) A Reviewer Subagent

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `code-reviewer` subagent file is an **example written for this course** (full text under "Example file" below). No subagent output is shown as real; the summary on screen is the *format we asked for*, with placeholders.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:00–6:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Create a subagent: ways to create, scope, file format, fields, system prompt | Lesson 1 |
| 6:00–10:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Make it work well: description, tools, invoking, testing | Lesson 1 |
| 10:00–14:45 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · A code-reviewer for the cart project | Lesson 2 |
| 14:45–16:00 | [VOICEOVER + SLIDE] | Week 2 wrap-up, recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we looked at what subagents are: specialized assistants with their own context, their own prompt, and their own tools, that hand back a summary. And we looked at when to use one.
> Today we build one. And then we build the one I'd add to every project first: a code reviewer that checks your work against the plan before you commit.

**Visual / B-roll:**
- Episode 12 "Its own context" card, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode thirteen: building a subagent, plus a reviewer. This is the last episode of week two.

*Cue: agenda slide*
> Four parts. Creating a subagent and the file format. Making it work well: the description, tool limits, and how to invoke and test it. A full code reviewer for the cart project. And a wrap-up of week two. Everything on screen is an illustration, and the reviewer file is an example I wrote for this course.

**Visual / B-roll:**
- Agenda: 01 Create one · 02 Make it work · 03 A reviewer · 04 Week 2 wrap.

### 1:00–6:00 · Part 1: Create a subagent
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Create a subagent"*
> Part one. Creating a subagent.

*Cue: slide "Two ways to create one"*
> A subagent is just a markdown file with a small header on top. The docs give you two ways to make one. Ask Claude to write it for you, or write the file yourself.
> Asking Claude is the quickest start. You describe the subagent and where to save it. Something like: create a project code-reviewer subagent in dot claude slash agents that reviews my changes and suggests fixes. Make it read-only, and have it use Sonnet. Claude writes the file with a name, a description, a tools list, a model, and a system prompt.
> You may also know the slash agents command. In current versions, the docs say it prints a reminder to ask Claude or to edit the agents folders directly. Older versions, up to two point one point one nine seven, opened an interactive wizard. Either way, the file is what matters, so let's look at the file.

*Cue: slide "Project or user scope"*
> First, where it lives. A project subagent goes in the dot claude slash agents folder inside your repository. It's specific to that codebase, and the docs recommend checking it into version control so your team can use it and improve it together.
> A user subagent goes in the same folder name under your home directory: tilde slash dot claude slash agents. That one is personal, and it's available in every project on your machine.
> If both define a subagent with the same name, the project one wins, because it has higher priority. For a reviewer that knows the cart project's rules, project scope is the right choice.
> One more detail: Claude Code scans these folders recursively, so you can group files into subfolders like review or research. The folder doesn't change how a subagent is named. Its identity comes only from the name field, so keep names unique.

*Cue: drawn subagent file skeleton*
> Here's the shape of the file. At the top, between two lines of three dashes, is the frontmatter: a few settings written as YAML. Below the closing dashes is the body, written in plain markdown.
> The frontmatter says what the subagent is and what it can do. The body is its system prompt: the instructions it follows every time it runs.

*Cue: slide "The fields that matter"*
> The docs list a lot of frontmatter fields, but four do most of the work.
> Name is the unique identifier, in lowercase with hyphens, like code dash reviewer. It's required.
> Description is when Claude should delegate to this subagent. It's also required, and it's the most important line in the file. More on that in part two.
> Tools is the list of tools the subagent can use. Leave it out, and the subagent inherits every tool available to subagents.
> And model picks the model: sonnet, opus, haiku, or inherit, to use the main conversation's model.
> There are more, like disallowed tools to remove specific tools, and max turns to cap how long it runs. One warning from the docs: field names must match exactly. Claude Code ignores a field it doesn't recognize, without any error.

*Cue: slide "The body is the system prompt"*
> Now the body. Whatever you write below the frontmatter becomes the subagent's system prompt. And here's the part people miss: the docs say a subagent receives only this system prompt, plus basic details like the working directory. It does not get the full Claude Code system prompt.
> Custom subagents do still load your CLAUDE dot M D files, unless you turn that off. So our reviewer will already know the cart project's rules, like integer cents.
> That means the body has to stand on its own. Say what the subagent is, what to do step by step when it's invoked, and exactly what to send back.

**Visual / B-roll:**
- Two points + Illustration terminal: the "create a subagent" prompt.
- Two columns: Project (.claude/agents/) vs User (~/.claude/agents/); card "Check it in".
- Illustration: file skeleton with frontmatter and body.
- Four numbered fields: name · description · tools · model.
- Black panel: Body = system prompt · Only this prompt · Still loads CLAUDE.md.

### 6:00–10:00 · Part 2: Make it work well
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "02 · Make it work well"*
> Part two. Making it work well.

*Cue: slide "Write a good description"*
> Claude decides when to delegate using the task in your request, the description field, and the current context. So the description isn't a label. It's a trigger.
> A weak description says what the subagent is: reviews code. That's true of almost anything. A strong one says when to use it: reviews the current diff for bugs, missed edge cases, and changes outside PLAN dot M D. Use after a feature is implemented and tests pass, before committing.
> The docs add a tip: if you want Claude to use it proactively, include a phrase like "use proactively" in the description.
> And keep it short. Every description takes up context in the main session. Put the detail in the body, which only loads when the subagent runs.
> You'll know a description is wrong from how it behaves. If the reviewer kicks in while you're still halfway through a feature, the "when" is too loose. If it never runs unless you name it, the description probably doesn't match the way you actually phrase requests. Either way, the fix is in that one line.

*Cue: slide "Restrict the tools"*
> Next, tools. The tools field is an allowlist. A reviewer needs to read and search code, and to run git diff and the tests. So I give it Read, Grep, Glob, and Bash, and leave out Write and Edit.
> If you'd rather start from everything and remove a few, the disallowed tools field does the opposite: it removes tools from the inherited list.
> One honest caveat. Bash can run any command, including ones that change files. Leaving out Write and Edit is a real limit, but "never edit files" in the prompt is an instruction, not an enforced rule. The docs show how to enforce rules like that with hooks, which we'll cover in week three.

*Cue: slide "Ways to invoke it"*
> Now, how do you run it? Three ways, from a hint to a guarantee.
> Automatically: if your request matches the description, Claude may delegate on its own.
> By name, in plain language: have the code-reviewer subagent look at my recent changes. Claude still decides whether to delegate, but it usually will.
> With an at-mention: type the at sign and pick the subagent from the list. That guarantees that specific subagent runs for that task. Your full message still goes to Claude, which writes the subagent's task from what you asked.
> And for a whole session, the dash dash agent flag runs the main session as that subagent, with its tools and model.

*Cue: slide "Test and iterate"*
> Then test it. Ask it to do its job on a real change, and read what comes back. In the transcript, the delegation shows as a row with the subagent's name and a short task description, so you can see it ran.
> If the result isn't right, edit the file. The docs say Claude Code watches the agents folders, so the next delegation uses your updated definition within a few seconds, without a restart. The exception: if the agents folder didn't exist when the session started, restart once after creating it.
> Test both directions. Give it a request that should trigger it, like: I've finished the expiry feature and the tests pass, review it before I commit. Then give it one that shouldn't, like a quick question about the cart code. A good subagent shows up for the first and stays out of the second.
> Iterate on the two things that matter most: the description, if it runs at the wrong time, and the body, if it does the wrong thing.

**Visual / B-roll:**
- Plan layout + Illustration: weak vs strong description.
- Two points + Illustration: tools and disallowedTools lines.
- Five-box flow: Automatic → By name → @-mention → --agent → setting.
- Black panel: Ask it → Read the result → Edit the file.

### 10:00–14:45 · Part 3: A code-reviewer for the cart project
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · A reviewer"*
> Part three. A code reviewer for the cart project.

*Cue: drawn code-reviewer.md file*
> Here's the file, saved as code dash reviewer dot M D in the project's dot claude slash agents folder. I wrote it for this course, so treat it as a starting point, not a standard.
> The frontmatter: name, code dash reviewer. Description: reviews the current diff in the cart project for bugs, missed edge cases, and changes outside PLAN dot M D. Use after a feature is implemented and tests pass, before committing. Tools: Read, Grep, Glob, and Bash. Model: sonnet.
> The body starts with one line of identity: you are a code reviewer for the cart project. You review; you never edit files.

*Cue: slide "What the prompt tells it"*
> Then the steps, in order. One: run git diff to see what changed, and read the changed files in full. Two: if PLAN dot M D exists, compare the diff against it, and flag any changed file the plan doesn't list. Three: check the edge cases the plan names, and whether a test covers each one. For our discount feature, that's the expired code, the expiry day, a code with no expiry, and the timezone rule. Four: check money handling, prices are integer cents, never floats. And five: run N P M test once, and note the result.
> Then the report format. Verdict: ready to commit, or needs changes. Must fix: bugs or missing tests, with file and line. Should fix: smaller issues. Outside the plan: anything not in PLAN dot M D. And one last instruction: keep it short, and don't paste whole files or full test logs.
> That last line matters more than it looks. The summary comes back into my main context, so I want findings, not files.

*Cue: slide "Run it after a feature"*
> So when do I run it? Right where episode nine left a gap: after the feature is implemented and the tests pass, and before the commit.
> For the discount expiry feature, I'd type: have the code-reviewer subagent review my changes against at PLAN dot M D. Or, to guarantee it runs, I'd at-mention it and pick code-reviewer from the list.
> It works in its own context: it runs git diff, reads discounts dot J S and the tests, compares them with the plan, and runs the suite. None of that reading lands in my session.
> The first time, I'd watch it closely: did it actually run git diff, did it read the plan, did it run the tests? If it skipped a step, that's a gap in the body, and I'd make that step more explicit.

*Cue: slide "How the summary comes back"*
> What comes back is the report, in the format the body asked for. On screen is that format with placeholders, not a real review: a verdict, a must-fix list, a should-fix list, and anything outside the plan.
> In the main session, I read the verdict first. If there's a must-fix, I ask Claude to fix it, then run the reviewer again. If it says ready to commit, I still read the diff myself, as we did in episode nine, and then commit.
> If I want to see what the reviewer actually did, the docs say that for about thirty seconds after a subagent finishes, the footer offers slash tasks, which opens its transcript.
> And because this file lives in the repository, the whole team gets the same reviewer, and can improve it in a pull request, just like CLAUDE dot M D.
> Over time, the reviewer gets better the same way CLAUDE dot M D does. When it misses something a human reviewer catches, add a line to its steps. When it keeps flagging something that doesn't matter, tell it to skip that. Small edits, tested on the next real change.

**Visual / B-roll:**
- Plan layout + Illustration: code-reviewer.md frontmatter and first body lines.
- Four numbered items: Read the diff · Check vs PLAN.md · Edge cases and tests · Short report.
- Two points + Illustration: the two invocation prompts.
- Two columns: In the subagent vs In your session; card "Findings, not files".

### 14:45–16:00 · Week 2 wrap-up, recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: slide "Week 2, done"*
> And that's week two. We built a workflow: explore, plan, implement, verify, commit. We wrote plans to a file and executed them step by step. We verified the work instead of trusting green ticks. We gave the project a CLAUDE dot M D and learned to keep it true. And now we have subagents, including a reviewer that checks the work against the plan.

*Cue: quote slide*
> The mental model for this episode: a subagent is only as good as its description and its last line. The description decides when it runs. The report format decides what you get back.

*Cue: recap slide*
> Recap. Create a subagent by asking Claude or writing a markdown file in dot claude slash agents, with name and description required, and tools and model to shape it. Write a description that says when to use it, restrict its tools, and invoke it by name or at-mention when you need a guarantee. And for the cart project, a code reviewer that reads the diff, checks it against the plan, and sends back a short verdict.

*Cue: next-episode slide*
> Next in the playlist is episode fourteen, and the start of week three: an introduction to skills. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Black panel: Week 2 · Plan it · Execute it · Verify it.
- Quote card, recap card, next-episode card "Episode 14 · Introduction to Skills · Week 3".

---

## Example file: `.claude/agents/code-reviewer.md` (written for the course)

```markdown
---
name: code-reviewer
description: Reviews the current diff in the cart project for bugs, missed edge cases, and changes outside PLAN.md. Use after a feature is implemented and tests pass, before committing.
tools: Read, Grep, Glob, Bash
model: sonnet
---

You are a code reviewer for the cart project. You review; you never edit files.

When invoked:
1. Run `git diff` to see what changed. Read the changed files in full.
2. If PLAN.md exists, compare the diff against it. Flag any changed file the plan doesn't list.
3. Check the edge cases the plan names, and whether a test covers each one.
4. Check money handling: prices are integer cents, never floats.
5. Run `npm test` once and note the result.

Report back in this format, and keep it short:
- Verdict: ready to commit, or needs changes
- Must fix: bugs or missing tests, with file and line
- Should fix: smaller issues
- Outside the plan: files or changes not in PLAN.md

Do not paste whole files or full test logs.
```

---

## Production notes
- Spoken word count is about 2,150 words, roughly 15 to 16 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. The reviewer file is written for the course. The "summary" on screen shows the report format with placeholders (for example "Verdict: …"), not a real review.
- `/agents`: per the sub-agents docs, current versions print a reminder to ask Claude or edit `.claude/agents/` and `~/.claude/agents/`; v2.1.197 and earlier opened an interactive wizard.
- Fields named are from the frontmatter reference: `name` and `description` required; `tools`, `disallowedTools`, `model` (`sonnet`, `opus`, `haiku`, `fable`, a full model ID, or `inherit`; the narration names four), `maxTurns`. Unrecognized fields are ignored without an error.
- "Lowercase with hyphens" for `name` follows the docs' examples (`code-reviewer`, `reviewer-v2`); the docs' rules are a unique identifier of at most 256 characters with no `:`.
- Hooks for enforcing rules are covered in Week 3 per youtube-plan.md (hooks config is listed under Week 3 resources).
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Build a Claude Code Subagent (Plus a Code Reviewer You Can Copy) | Agentic Engineering Ep 13
2. Custom Subagents in Claude Code: File Format, Description, Tools, and a Reviewer | Ep 13
3. A Code-Reviewer Subagent That Checks Your Plan | Agentic Engineering Ep 13

### Description
```
Episode 13 of Agentic Engineering, a free course on building real software with AI coding agents. This episode closes Week 2.

In this episode: creating a custom subagent (ask Claude or write the file; what /agents does now); project vs user scope (.claude/agents/ and ~/.claude/agents/); the file format: YAML frontmatter (name, description, tools, model, and more) plus a markdown system prompt; writing a description that triggers delegation at the right time; restricting tools; invoking automatically, by name, by @-mention, or with --agent; testing and iterating. Then a full code-reviewer subagent for a small Node.js cart project: what its prompt tells it to do, how to run it after a feature, and how its short report comes back.

Note: screens are drawn illustrations, and the reviewer file is an example written for the course.

Chapters:
0:00 From what subagents are to building one
0:30 Intro and what we'll cover
1:00 Create a subagent: scope, file format, fields
6:00 Make it work well: description, tools, invoking, testing
10:00 A code-reviewer for the cart project
14:45 Week 2 wrap-up and next episode

Official docs:
Subagents: https://code.claude.com/docs/en/sub-agents

Next in the playlist: Ep 14 · Introduction to Skills (Week 3)

I'm Sahinur Islam, a full-stack software engineer. New episodes in the playlist every day.

#AgenticEngineering #ClaudeCode #AIcoding
```

### Tags
claude code subagents, custom subagent, code reviewer subagent, .claude/agents, subagent frontmatter, ai code review, claude code agents, agentic engineering, free ai coding course, sahinur islam

### Thumbnail text idea
Big text: **"BUILD A REVIEWER"**, small line: **"your first subagent"**.
Visual: a code-reviewer.md card with frontmatter highlighted in coral. "EP 13" badge.

---

## Suggested slide list (Episode 13 deck)

| # | Slide title | One-line point |
|---|---|---|
| 1 | Building a Subagent (plus a Reviewer) | Agentic Engineering · Episode 13 |
| 2 | Four parts | 01 Create one · 02 Make it work · 03 A reviewer · 04 Week 2 wrap |
| 3 | 01 · Create a subagent | A markdown file with a header |
| 4 | Two ways to create one | Ask Claude, or write the file; /agents note |
| 5 | Project or user scope | .claude/agents/ vs ~/.claude/agents/ |
| 6 | The file format | Frontmatter + body (Illustration) |
| 7 | The body is the system prompt | Only this prompt; CLAUDE.md still loads |
| 8 | The fields that matter | name · description · tools · model |
| 9 | 02 · Make it work well | Description, tools, invoking, testing |
| 10 | Write a good description | Weak vs strong (Illustration) |
| 11 | Restrict the tools | tools allowlist, disallowedTools |
| 12 | Ways to invoke it | Automatic → By name → @-mention → --agent → setting |
| 13 | Test and iterate | Ask it · Read the result · Edit the file |
| 14 | 03 · A reviewer | For the cart project |
| 15 | code-reviewer.md | Example file (Illustration) |
| 16 | What the prompt tells it | Diff · Plan · Edge cases · Short report |
| 17 | Run it after a feature | By name or @-mention (Illustration) |
| 18 | How the summary comes back | Findings, not files |
| 19 | Week 2, done | Plan · Execute · Verify · CLAUDE.md · Subagents |
| 20 | Quote | Description and last line |
| 21 | Recap | Create · Make it work · Reviewer |
| 22 | Next | Episode 14 · Introduction to Skills |

---

## Sources
- Subagents: https://code.claude.com/docs/en/sub-agents (subagents are Markdown files with YAML frontmatter; create by asking Claude or writing the file; `/agents` prints a reminder in current versions, wizard on v2.1.197 and earlier; scope table: `.claude/agents/` project, `~/.claude/agents/` user, priority; check project subagents into version control; frontmatter reference: `name`, `description` required, `tools`, `disallowedTools`, `model`, `maxTurns`; unrecognized fields ignored; body becomes the system prompt, subagents receive only it plus basic environment details; custom subagents load CLAUDE.md; Claude delegates based on the request, the description and context; "use proactively"; keep descriptions short; invoking by natural language, @-mention (guarantees the subagent runs; full message still goes to Claude), `--agent`, `agent` setting; transcript shows a tool call row with the subagent's name; file watcher picks up edits within a few seconds, restart if the agents directory didn't exist at session start; `/tasks` shown in the footer for 30 seconds after a subagent finishes to open its transcript; conditional rules with hooks).
- Episode 12 reference: /workspace/agentic-course/day13-ep12-script.md.
