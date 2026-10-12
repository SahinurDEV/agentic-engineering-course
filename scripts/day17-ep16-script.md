# Day 17 · Episode 16: The "Grill Me" Skill

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 19:30
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 7 lesson):** Grill Me Skill

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `grill-me` skill, its two supporting files, and the example SPEC.md are **written for this course** (full text under "Example files" below). No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:40 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:40–1:20 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:20–5:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Why grill me: hidden decisions, the interview pattern from the docs, why make it a skill | Grill Me Skill |
| 5:30–12:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Writing the grill-me skill: folder, frontmatter, inline vs fork, body rules, supporting files, AskUserQuestion | Grill Me Skill |
| 12:30–18:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Running it on the cart project, the spec, the hand-off, tuning the skill | Grill Me Skill |
| 18:30–19:30 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:40 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we ran our first skill, add discount. We let Claude pick it up from its description, called it by name, passed it arguments, bundled a script, and tested it with and without the skill.
> Today we write a very different kind of skill. It doesn't write code at all. Its whole job is to make Claude ask you hard questions before any code exists. I call it grill me.

**Visual / B-roll:**
- Episode 15 "Run it, feed it, test it" recap panel, then the title card.

### 0:40–1:20 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode sixteen: the grill me skill.

*Cue: agenda slide*
> Four parts. Why an interview before coding pays off. Writing the grill me skill, line by line, and the settings that matter. Running it on our cart project, all the way to a spec. And tuning it once you see how it behaves. Everything on screen is an illustration. The grill me skill and its files are written for this course, and you'll get the full text in the description.

**Visual / B-roll:**
- Agenda: 01 Why · 02 Write it · 03 Run it · 04 Tune it.

### 1:20–5:30 · Part 1: Why grill me
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Why grill me"*
> Part one. Why get grilled at all?

*Cue: panel "Hidden decisions"*
> Think back to episode seven. I typed, add expiry dates to discount codes, and pointed out how many decisions hide inside that one line. What date format? Is a code still valid on its expiry day? Whose clock decides?
> If nobody asks those questions, they still get answered. Claude answers them, quietly, while it writes the code. Every choice might be reasonable, but I didn't make any of them, and I only find out when I read the diff.
> A plan helps, and we covered planning in week two. But a plan is Claude's proposal. An interview goes one step earlier. It pulls the decisions out of my head before anyone proposes anything.

*Cue: two points "The docs' interview prompt"*
> This isn't my invention. Anthropic's best practices guide has a section called, let Claude interview you. For larger features, it says, have Claude interview you first. Start with a minimal prompt, and ask Claude to interview you using the ask user question tool.
> The prompt they show is on screen. I want to build, and then a brief description. Interview me in detail using the ask user question tool. Ask about technical implementation, UI and UX, edge cases, concerns, and tradeoffs. Don't ask obvious questions, dig into the hard parts I might not have considered. Keep interviewing until we've covered everything, then write a complete spec to SPEC dot M D.
> The guide says Claude asks about things you might not have considered yet. That's the point. The questions you didn't think of are the expensive ones.

*Cue: flow "The interview loop"*
> Here's the whole pattern as a loop. A short ask. Claude reads enough to ask good questions. It asks, you answer, and that repeats until the hard parts are covered. Then it writes the spec to a file.
> And the last step matters. The guide says once the spec is complete, start a fresh session to execute it. The new session has clean context focused entirely on implementation, and you have a written spec to reference.

*Cue: squares "Why make it a skill"*
> So why turn that prompt into a skill, instead of pasting it? Three reasons, and they're the same signals from episode fourteen.
> Repeated. If I paste the same interview prompt before every bigger feature, that's exactly what the skills docs describe as a reason to create a skill.
> Consistent. A skill can carry a checklist of question areas and a spec template, so every interview covers the same ground and every spec has the same shape.
> And easy to run. Slash grill me, plus a sentence about the feature. That's all I have to type.
> There's a bonus on cost, too. A skill's body only loads when it's used, so those long interview rules cost nothing in the sessions where I don't need them. And as we'll see in a minute, this skill won't even put its description in Claude's context.

**Visual / B-roll:**
- Panel: Open decisions · Made silently · Found at review.
- Two points + Illustration: the best practices interview prompt.
- Flow: Short ask → Read → Ask → Answer → SPEC.md.
- Squares: Repeated · Consistent · One line.

### 5:30–12:30 · Part 2: Writing the skill
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Writing grill-me"*
> Part two. Writing the skill.

*Cue: drawn folder tree "The grill-me folder"*
> First, where it lives. Add discount was a project skill, because it was about the cart code. Grill me isn't about any one codebase. It's about how I work. So I make it a personal skill, in my home folder: tilde slash dot claude slash skills slash grill dash me. Personal skills are available in all your projects on that machine. If your team wants it too, the same folder can go in a repository's dot claude slash skills and get committed. And if both exist with the same name, the docs say personal wins over project, so slash grill me runs my personal copy.
> Inside, three files. SKILL dot M D, with the instructions. Question areas dot M D, a checklist of what to ask about. And spec template dot M D, the shape of the final spec. All three are written for this course, and the full text is in the description.

*Cue: phone "Frontmatter: manual only"*
> Here's the frontmatter. The name is grill dash me. The description says it interviews you about a feature, plan, or requirements before any code is written, then writes a spec to SPEC dot M D.
> There's an argument hint, feature in square brackets, so autocomplete reminds me to say what I'm building. Quote it in the YAML, so the square brackets are read as text.
> And the important line: disable model invocation, set to true. Remember the docs' advice. Use it for workflows where you want to control the timing. An interview is exactly that. I don't want Claude starting to question me because my request happened to sound like a feature. I decide when I want to be grilled.
> One side effect, straight from the docs: with that flag, the description isn't in Claude's context at all. So the description here is for me and my team, not for matching.

*Cue: four numbered "Frontmatter choices"*
> Let me lay out the four choices, because each one is deliberate.
> One, manual only, which we just covered.
> Two, arguments. The body uses dollar arguments, so whatever I type after slash grill me becomes the feature to interview me about. If I type nothing after the name, there's no feature in that line, so the skill's first rule handles that case: if no feature was given, ask what we're building.
> Three, no allowed tools. I left it out on purpose. The tools reference lists the ask user question tool and the read tool as needing no permission, so the interview itself doesn't prompt. Writing SPEC dot M D does need permission in the default mode, and I want that prompt. It's my last chance to check the spec before it lands on disk.
> And four, no context fork. It stays inline. That one deserves its own slide.

*Cue: card "Inline, not forked"*
> In episode fourteen we saw that a skill can set context to fork, and then it runs in a subagent. For a lot of skills that's great. For this one it's wrong, and the docs explain why.
> A forked skill's subagent doesn't see your conversation history. It gets the skill content as its prompt, and that's it. The docs also say a forked subagent runs in the background by default, and its result arrives in your conversation when it completes.
> An interview is the opposite of background work. It's a conversation with you, turn after turn, and the spec has to reflect what you said. So grill me runs inline, in the main conversation, where every answer stays in context.
> Short version: fork is for work you hand off. An interview is work you take part in.

*Cue: drawn SKILL.md body "Standing rules"*
> Now the body. It opens with one line: interview me about this feature before anything is built, and then dollar arguments.
> Then a block of rules for the whole interview. Ask with the ask user question tool, one question at a time. Skip obvious questions, and dig into the hard parts: technical implementation, UI and UX, edge cases, concerns, and tradeoffs. Read the relevant code first, so the questions are about this codebase, not software in general. If an answer is vague, ask a follow-up before moving on. And do not edit any code during the interview.
> Why one question at a time? Because a wall of ten questions gets ten rushed answers. One at a time, each answer can shape the next question, and that's where the follow-ups come from.
> Notice how those are written. Each one applies to the whole interview, not to a single step. That's from the docs too. Claude Code adds a skill's content to the conversation once and doesn't re-read the file on later turns, so guidance that should hold for the whole task should be written as a standing instruction.
> Then the ending. Keep interviewing until we've covered everything. Summarize the decisions and ask me to confirm. Write a complete spec to SPEC dot M D, following the template. And stop, and tell me to start a fresh session to implement it.

*Cue: plan "Supporting files"*
> The two supporting files keep SKILL dot M D short. The docs suggest exactly this: link each file from SKILL dot M D and say what it contains, so Claude knows when to load it. So the body ends with an additional resources section: areas to cover, see question areas dot M D. Spec structure, see spec template dot M D. Claude reads those files only when it needs them, and SKILL dot M D stays well under the five hundred line limit the docs suggest.
> Question areas is my checklist. Goal: what's true when this is done? Scope: what are we deliberately not doing? Data, rules and edge cases, errors, UI, tradeoffs, and verification. For the cart I also added a reminder about money in integer cents and about time zones, because those bit us before.
> Spec template is the shape from the best practices guide. The guide says the most useful specs are self-contained: they name the files and interfaces involved, state what's out of scope, and end with an end-to-end verification step that proves the feature works. So the template has exactly those sections, plus one for the decisions from the interview.

*Cue: two columns "Answering questions"*
> Now, what does being grilled actually feel like? The ask user question tool is how Claude asks you multiple-choice questions when it needs a decision or a clarification.
> You can answer by picking an option. Or you can type your own text, through the other row or the notes field. The docs say when you type your own answer, Claude Code relays it with neutral wording, so Claude follows what you wrote, including a request to wait or explain first.
> And by default, a question stays open until you answer it. There's a setting, ask user question timeout, that lets an unanswered question close on its own after sixty seconds, five minutes, or ten minutes, so Claude can continue on its own judgment. For an interview I leave that off. The whole point is that I make the decisions.

**Visual / B-roll:**
- Monitor + Illustration: ~/.claude/skills/grill-me/ with SKILL.md, question-areas.md, spec-template.md.
- Phone + Illustration: grill-me frontmatter; /grill-me popup "manual only".
- Four numbered: Manual only · $ARGUMENTS · No allowed-tools · Inline.
- Card + Illustration: context: fork vs inline.
- Two points + Illustration: the body's standing rules.
- Plan + Illustration: Additional resources section; Q question-areas.md, S spec-template.md.
- Two columns: Pick an option vs Type your own; card "Stays open".

### 12:30–18:30 · Part 3: Running and tuning it
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Running and tuning it"*
> Part three. Running grill me on the cart, and tuning it.

*Cue: drawn terminal "Grill me on the cart"*
> Here's the feature: let a customer use two discount codes on one order. It sounds small. It isn't.
> In the cart project I type, at the start of the message, slash grill me, let a customer use two discount codes on one order. Because the skill name comes first, Claude Code runs the skill directly, and dollar arguments becomes that sentence.
> On screen is only what I type. I'm not showing you Claude's questions, because they'll differ from run to run. What I can show you is what my question areas file pushes it toward, and the answers I'd want to have ready.

*Cue: panel "Your side of the interview"*
> Because your side of the interview matters just as much. Three habits.
> Decide, don't defer. If the question is, which code applies first, a percent code or a fixed one, answer it. Saying, whatever you think, hands the decision right back.
> Name the out of scope. When a question drifts toward a bigger feature, like showing both codes in a redesigned checkout, say it's out of scope, and make sure the spec says so.
> And type your own answer when none of the options fit. That's what the other row is for.

*Cue: two points "The spec shape"*
> When the interview is done, the skill asks me to confirm a summary, then asks permission to write SPEC dot M D. On screen is the shape I'd expect, as an example I wrote for this course, using the decisions I'd make for the cart.
> Goal: a customer can apply up to two discount codes to one order. Out of scope: any checkout redesign, and gift cards. Decisions: percent codes apply before fixed codes, the same code can't be used twice, and the discount never takes the total below zero. Files: src slash discounts dot J S and its tests. Edge cases: one code expired, both codes the same, amounts in integer cents. And verification: tests for each of those cases, then the full test suite.
> Look at the decisions block in particular. Percent before fixed changes the final price, so it's a product decision, not a coding detail. Same code twice is the kind of edge case that slips through review. And never below zero protects us from a refund bug. Without the interview, each of those would be a guess inside a function.
> Every one of those lines is a decision I made in the interview, not one Claude made in the code.

*Cue: flow "The hand-off"*
> Then the hand-off, the same loop we built in week two. The spec is in a file, so it survives. Start a fresh session, or clear this one, so the implementation gets clean context. In the new session, start in plan mode and point Claude at SPEC dot M D, review the plan, then implement and verify against the spec's own verification section.
> And because the spec is a file, not a message, clearing the conversation doesn't lose it. That was the same reason we saved plans to a file back in episode seven.
> That's the real payoff. The interview session is full of questions and back and forth. The implementation session only sees the result.

*Cue: four numbered "Tune it"*
> Now tuning. Same method as last episode, adapted for a manual skill.
> One, the baseline. Since grill me only runs when I invoke it, the fair comparison is the plain prompt with no skill, versus slash grill me with the same feature sentence.
> Two, fresh sessions for both, so leftover context doesn't hide gaps.
> Three, check the output against what you wanted. Did it ask about the hard parts? Did it ask one question at a time? Does the spec have every section of the template?
> And four, change one thing, then run again. And remember from last episode: Claude Code picks up edits to SKILL dot M D in the current session, so you can tweak and rerun quickly.
> If you want help comparing two versions of the skill, the skill creator plugin from last episode can run a blind A B comparison between two versions, so you can confirm an edit is actually an improvement before you commit it.

*Cue: card "When it misbehaves"*
> And here's how I'd handle the usual problems.
> If the questions are too obvious, the fix is usually in question areas dot M D. Add the hard, specific areas for your domain.
> If it asks too many questions, add a rule for when to stop, for example, when every section of the spec template can be filled in.
> And if it starts editing code mid-interview, that rule is in the body already. The docs say Claude can skip a rule that must hold every time, and that kind of rule belongs in a hook, which we'll get to later in week three.
> One more from the docs: after compaction, Claude Code keeps only the start of an invoked skill, so the rules sit at the top of SKILL dot M D. If a long interview gets compacted, invoke the skill again.

**Visual / B-roll:**
- Monitor + Illustration: `/grill-me let a customer use two discount codes on one order` (typed input only).
- Panel: Decide · Out of scope · Your own text.
- Two points + Illustration: example SPEC.md shape (written for the course).
- Flow: SPEC.md → Fresh session → Plan mode → Implement → Verify.
- Four numbered: Baseline · Fresh · Check · One edit.
- Card + Illustration: three fixes; rules near the top.

### 18:30–19:30 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: every question Claude asks before the code is a decision you get to make, instead of one you discover in the diff.

*Cue: recap slide*
> Recap. Grill me turns the interview prompt from the best practices guide into a skill. It lives in my personal skills folder, with a question areas checklist and a spec template next to it. It's manual only, with disable model invocation, it takes the feature as dollar arguments, and it runs inline, because an interview needs your conversation. Its rules are standing instructions: ask with the ask user question tool, one question at a time, hard parts only, no code edits. It ends with a spec in SPEC dot M D, and the build happens in a fresh session. And you tune it like any skill: fresh sessions, a baseline, one change at a time.

*Cue: next-episode slide*
> Next in the playlist is episode seventeen: a React best practices skill. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 17 · A React Best Practices Skill".

---

## Example files (written for the course)

### `~/.claude/skills/grill-me/SKILL.md`

```markdown
---
name: grill-me
description: Interviews you about a feature, plan, or requirements before any code is written, then writes a spec to SPEC.md.
argument-hint: "[feature]"
disable-model-invocation: true
---

Interview me about this feature before anything is built: $ARGUMENTS

Rules for the whole interview:
- If no feature was given above, first ask what we are building.
- Ask with the AskUserQuestion tool, one question at a time.
- Skip obvious questions. Dig into the hard parts I might not have considered: technical implementation, UI/UX, edge cases, concerns, and tradeoffs.
- Read the relevant code first, so questions are about this codebase, not software in general.
- If an answer is vague, ask a follow-up before moving on.
- Do not edit any code during the interview.

Keep interviewing until we've covered everything. Then:
1. Summarize the decisions as a short list and ask me to confirm.
2. Write a complete spec to SPEC.md, following spec-template.md.
3. Stop, and tell me to start a fresh session to implement it.

## Additional resources
- Areas to cover: see [question-areas.md](question-areas.md)
- Spec structure: see [spec-template.md](spec-template.md)
```

### `~/.claude/skills/grill-me/question-areas.md`

```markdown
# Question areas

- Goal: what is true when this is done? Who notices?
- Scope: what are we deliberately not doing?
- Data: what changes in stored data or formats? (Cart: money stays in integer cents.)
- Rules and edge cases: limits, empty values, conflicts between rules, expiry day, time zones.
- Errors: what does the user see when something is rejected?
- UI/UX: where does this show up, if anywhere?
- Tradeoffs: the simplest version versus the complete version.
- Verification: which tests prove it works end to end?
```

### `~/.claude/skills/grill-me/spec-template.md`

```markdown
# SPEC: <feature>

## Goal
## Out of scope
## Decisions (from the interview)
## Files and interfaces
## Edge cases
## Verification (end to end)
```

Folder:
```text
~/.claude/skills/grill-me/
├── SKILL.md
├── question-areas.md
└── spec-template.md
```

### Example `SPEC.md` shape for the cart (written by hand for the course, not Claude output)

```markdown
# SPEC: Two discount codes on one order

## Goal
A customer can apply up to two discount codes to one order.

## Out of scope
Checkout redesign. Gift cards.

## Decisions (from the interview)
- Percent codes apply before fixed codes.
- The same code can't be used twice on one order.
- The discount never takes the total below zero.

## Files and interfaces
- src/discounts.js and its tests

## Edge cases
- One of the two codes is expired.
- Both codes are the same.
- All amounts stay in integer cents.

## Verification (end to end)
- A test for each edge case above, then `npm test` for the full suite.
```

What you type (no output shown):
```text
/grill-me let a customer use two discount codes on one order
```

---

## Production notes
- Spoken word count is about 2,800 words, roughly 19 to 20 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. grill-me, question-areas.md, spec-template.md and the example SPEC.md are written for the course. No Claude output and no Claude questions are shown.
- Interview pattern quoted from the best practices guide, "Let Claude interview you" (prompt text, "asks about things you might not have considered", start a fresh session to execute, self-contained specs naming files and interfaces, out of scope, end-to-end verification).
- Skills facts (skills page): reasons to create a skill; personal vs project locations; `argument-hint`; `disable-model-invocation` ("workflows ... that you want to control timing"; description not in context); `$ARGUMENTS` (`$ARGUMENTS` expands to the argument string as typed; the skill's first rule covers the no-feature case); `context: fork` (no conversation history, skill content as the prompt, background by default, result arrives on completion); skill content added once and not re-read, so write standing instructions; supporting files linked from SKILL.md; live edit detection; troubleshooting: rules that must always hold go in a hook; after compaction only the start of a skill is kept, invoke it again; baseline comparison in fresh sessions.
- Tools reference: `AskUserQuestion` asks multiple-choice questions, needs no permission; `Read` needs no permission inside the working directory; `Write` needs permission in Manual mode; answers by option, `Other` row or notes field, typed answers relayed neutrally; questions stay open by default; `askUserQuestionTimeout` 60s/5m/10m.
- Plan mode and the plan-to-file workflow are from Episode 7 (day08-ep07-script.md). Hooks come later in Week 3 per youtube-plan.md.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. The "Grill Me" Skill: Make Claude Code Interview You Before It Codes | Agentic Engineering Ep 16
2. Stop Claude Guessing: A Claude Code Skill That Interviews You and Writes the Spec | Ep 16
3. Build an Interview Skill with AskUserQuestion and SPEC.md | Agentic Engineering Ep 16

### Description
```
Episode 16 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we write a "grill me" skill: a skill that makes Claude interview you about a feature before any code is written, then write a spec to SPEC.md. It's built on the "let Claude interview you" pattern from Anthropic's Claude Code best practices.

We cover: why hidden decisions cost you at review time, where the skill lives (a personal skill in ~/.claude/skills/), why it's manual only with disable-model-invocation, taking the feature as $ARGUMENTS, why it runs inline instead of with context: fork, writing standing rules, supporting files for question areas and a spec template, answering AskUserQuestion questions, running it on the cart project, handing the spec to a fresh session, and tuning the skill.

Note: screens are drawn illustrations. The grill-me skill, its supporting files and the example spec are written for the course. Full text of the skill:

[paste the three example files from the script here]

Next in the playlist: Episode 17 · A React Best Practices Skill.
```

### Tags
Claude Code, Claude Code skills, SKILL.md, grill me skill, AskUserQuestion, spec driven, SPEC.md, requirements interview, AI coding agents, agentic engineering

### Thumbnail text idea
"GRILL ME" in coral, with a small question-mark speech bubble and "/grill-me".

---

## Suggested slide list (Episode 16 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 16 · The "Grill Me" Skill |
| 2 | Agenda | Why · Write it · Run it · Tune it |
| 3 | 01 · Why grill me | Divider |
| 4 | Hidden decisions | Open · Made silently · Found at review |
| 5 | The docs' interview prompt | Best practices prompt (Illustration) |
| 6 | The interview loop | Short ask → Read → Ask → Answer → SPEC.md |
| 7 | Why make it a skill | Repeated · Consistent · One line |
| 8 | 02 · Writing grill-me | Divider |
| 9 | The grill-me folder | Folder tree (Illustration) |
| 10 | Frontmatter: manual only | Frontmatter (Illustration) |
| 11 | Frontmatter choices | Manual · $ARGUMENTS · No allowed-tools · Inline |
| 12 | Inline, not forked | context: fork vs inline (Illustration) |
| 13 | Standing rules | Body rules (Illustration) |
| 14 | Supporting files | Additional resources (Illustration) |
| 15 | Answering questions | Pick an option vs type your own |
| 16 | 03 · Running and tuning it | Divider |
| 17 | Grill me on the cart | Typed command only (Illustration) |
| 18 | Your side of the interview | Decide · Out of scope · Your own text |
| 19 | The spec shape | Example SPEC.md (Illustration) |
| 20 | The hand-off | SPEC.md → Fresh session → Plan mode → Implement → Verify |
| 21 | Tune it | Baseline · Fresh · Check · One edit |
| 22 | When it misbehaves | Three fixes (Illustration) |
| 23 | Quote | Questions before code are decisions you make |
| 24 | Recap | Write · Run · Tune |
| 25 | Next | Episode 17 · A React Best Practices Skill |

---

## Sources
- Skills: https://code.claude.com/docs/en/skills (when to create a skill; choose where skills load; frontmatter reference incl. argument-hint and disable-model-invocation; control who invokes a skill; pass arguments; add supporting files; skill content lifecycle; run skills in a subagent with context: fork; edit a skill during a session; evaluate and iterate; troubleshooting).
- Best practices: https://code.claude.com/docs/en/best-practices ("Let Claude interview you").
- Tools reference: https://code.claude.com/docs/en/tools-reference (AskUserQuestion, Read, Write permissions; AskUserQuestion tool behavior and askUserQuestionTimeout).
- Episode 7 (planning, plan mode, plan to a file): /workspace/agentic-course/day08-ep07-script.md. Episode 15: /workspace/agentic-course/day16-ep15-script.md.
