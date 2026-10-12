# Day 15 · Episode 14: Introduction to Skills

**Series:** Agentic Engineering (free YouTube course) · Week 3 (first episode of Week 3)
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 12:30
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 7 lesson):** Introduction to Skills

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `add-discount` skill is an **example written for this course** (full text under "Example file" below). No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:00–4:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · What a skill is: a folder with a SKILL.md, progressive disclosure | Lesson 1 |
| 4:30–8:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Where skills live, and how they compare to CLAUDE.md, commands and subagents | Lesson 1 |
| 8:30–11:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · The SKILL.md format, and when a skill is the right tool | Lesson 1 |
| 11:30–12:30 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we built a subagent, a code reviewer for the cart project, and that wrapped up week two.
> Week three starts today, with skills. If you've ever pasted the same checklist into a chat for the tenth time, or watched your CLAUDE dot M D grow into a manual, skills are the fix.

**Visual / B-roll:**
- Episode 13 "Week 2, done" panel, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode fourteen: an introduction to skills. This is the first episode of week three.

*Cue: agenda slide*
> Four parts. What a skill actually is, and how it loads. Where skills live on disk. How a skill compares to CLAUDE dot M D, slash commands, and subagents. And the SKILL dot M D format, with a few rules for when a skill is the right tool. Everything on screen is an illustration, and the example skill is one I wrote for this course.

**Visual / B-roll:**
- Agenda: 01 What it is · 02 Where it lives · 03 How it compares · 04 Format and fit.

### 1:00–4:30 · Part 1: What a skill is
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · What is a skill"*
> Part one. What is a skill?

*Cue: panel "A folder with a SKILL.md"*
> The docs put it simply: skills extend what Claude can do. You create a file called SKILL dot M D with instructions, and Claude adds it to its toolkit.
> Each skill is a folder. Inside the folder, SKILL dot M D is the only file you need. It holds the instructions. Next to it you can add extra files: longer reference docs, examples, or scripts that Claude can run.
> And there are two ways a skill gets used. Claude can use it on its own when it's relevant to what you asked. Or you can invoke it directly by typing slash and the skill's name. We'll run skills properly in the next episode. Today is about what they are.

*Cue: flow "Loads in layers"*
> The key idea behind skills is that they load in layers. The docs call the general idea progressive disclosure: Claude sees a little first, and more only when it needs it.
> At the start, Claude only sees a listing: each skill's name and its description. When your request matches a description, the full SKILL dot M D loads into the conversation. If the instructions point to a reference file, Claude reads that file only when it needs it. And scripts are run, not read into context.

*Cue: squares "Three layers"*
> So think of three layers. The listing is always there, so Claude knows what's available. The body loads when the skill is invoked. And the supporting files load only when needed.
> The docs make the payoff clear: unlike CLAUDE dot M D content, a skill's body loads only when it's used, so long reference material costs almost nothing until you need it.
> One honest caveat. Once a skill's body loads, it stays in the conversation across later turns. So loading on demand isn't free forever. It just means you only pay when the skill is actually in use.

*Cue: drawn skill folder tree*
> Here's what one looks like for our cart project. I wrote this example for the course. It's a skill called add discount, for the job we keep doing: adding or changing a discount code.
> The folder is dot claude slash skills slash add dash discount. Inside is SKILL dot M D with the steps. Next to it is a reference file describing the format of the discount codes table. And a scripts folder with a small helper that lists the current codes.
> SKILL dot M D stays short and points to the other two. The reference file only gets read when Claude actually needs the table format.

**Visual / B-roll:**
- Panel: Folder (one per skill) · SKILL.md (the instructions) · Extras (refs, scripts).
- Flow: Listing → Match → SKILL.md → Ref file → Script runs.
- Squares: Listing · Body · Files.
- Monitor + Illustration: the add-discount folder tree.

### 4:30–8:30 · Part 2: Where skills live, and how they compare
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "02 · Where it fits"*
> Part two. Where skills live, and how they fit with the tools we already know.

*Cue: two columns "Personal or project"*
> Where you save a skill decides which sessions load it. The two you'll use most are personal and project.
> A personal skill lives in your home folder: tilde slash dot claude slash skills, then the skill's name, then SKILL dot M D. It's available in all your projects on that machine.
> A project skill lives in the repository: dot claude slash skills, then the skill name, then SKILL dot M D. It loads in sessions in that repository, and the docs suggest committing it so your team gets it too.
> For add discount, project is right. It's about the cart codebase, and everyone on the team adds discount codes.

*Cue: plan slide "More places"*
> There are a few more places, and you'll meet them later. Plugins can ship skills in their own skills folder, and those show up with the plugin's name in front, like plugin name colon skill name. Organizations can deploy enterprise skills through managed settings. A skill can also come from a directory you add with the add dir flag.
> And in a monorepo, a subfolder can have its own dot claude slash skills. Claude Code also loads project skills from parent folders up to the repository root, and a nested folder's skills load once Claude starts working on files in that folder.

*Cue: four numbered "Four tools compared"*
> Now the comparison. This is the part that confuses people, so let's lay four tools side by side.
> CLAUDE dot M D holds facts. It loads at the start of every session, so it should stay short: commands, conventions, gotchas.
> A skill holds procedures and reference material. Only its description sits in context until it's used.
> A slash command is now a skill. More on that in a second.
> And a subagent is a separate worker with its own context window, its own tools, and its own prompt. It does the job somewhere else and sends back a summary.
> The docs give a neat test for CLAUDE dot M D: when a section has grown into a procedure rather than a fact, that section probably wants to be a skill.

*Cue: phone slide "Commands became skills"*
> About slash commands. The docs say custom commands have been merged into skills. A file at dot claude slash commands slash deploy dot M D, and a skill at dot claude slash skills slash deploy slash SKILL dot M D, both create slash deploy, and they work the same way.
> Your old command files keep working. But skills add things commands don't have: a folder for supporting files, settings for who can invoke them, and the option for Claude to load them automatically. So for new work, the docs say to prefer a skill.

*Cue: card "Skill or subagent?"*
> The last comparison is skills against subagents, because they can sound alike.
> A skill is instructions. By default it runs inline, inside your conversation, so Claude applies it with everything you've already discussed.
> A subagent is a worker. It runs in its own context and only hands back a summary, which is great for noisy work like research or reviews.
> They also combine. A skill can set context to fork, and then it runs in a subagent, with the skill as that subagent's task. That subagent doesn't see your conversation history, so the skill has to stand on its own. And going the other way, a subagent can preload skills. Short version: a skill is how to do something. A subagent is who does it, and where.

**Visual / B-roll:**
- Two columns: Personal (~/.claude/skills/) vs Project (.claude/skills/); card "Commit it".
- Plan layout: Plugin · Nested · Enterprise · --add-dir; Illustration path list.
- Four numbered items: CLAUDE.md · Skill · Command · Subagent.
- Phone + Illustration: commands/deploy.md and skills/deploy/SKILL.md, both "/deploy".
- Card + Illustration: inline skill vs subagent; context: fork.

### 8:30–11:30 · Part 3: The SKILL.md format, and when to use a skill
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · The SKILL.md format"*
> Part three. The SKILL dot M D format.

*Cue: drawn SKILL.md for add-discount*
> Every SKILL dot M D has two parts. At the top, between two lines of three dashes, is the frontmatter: a few settings in YAML that tell Claude when to use the skill. Below it is plain markdown: the instructions Claude follows when the skill runs.
> Here's the top of add discount. The name is add dash discount. The description says what it does and when to use it: adds or changes a discount code in the cart project; use when the user asks for a new code, an expiry date, or a change to a discount rule.
> Then the body: numbered steps. Add the code to the codes table, keep prices in integer cents, add a test for the expiry edge cases, and run the tests.
> One detail from the docs: the frontmatter only counts if the opening dashes are on the very first line of the file.

*Cue: four numbered "Fields worth knowing"*
> The docs list a lot of frontmatter fields, and every one of them is optional. Only description is recommended. Here are the ones worth knowing first.
> Name sets the command name. Leave it out, and the folder name is used.
> Description is what Claude reads to decide when to use the skill. Put the main use case first. There's also a when to use field for extra trigger phrases, and the combined text is cut off at one thousand five hundred thirty six characters in the listing.
> Disable model invocation, set to true, means only you can run it, by typing the slash command. The docs suggest it for anything with side effects, like a deploy. You don't want Claude deciding to deploy because your code looks ready. The opposite is user invocable, set to false, which hides it from the slash menu so only Claude uses it, for background knowledge.
> And allowed tools pre-approves tools while the skill runs. There are more, like model, context, and paths to limit a skill to certain files. Field names must match exactly. Claude Code ignores a field it doesn't recognize, without an error.

*Cue: two points "Keep it lean"*
> Two rules keep a skill healthy. First, keep SKILL dot M D under five hundred lines. The docs suggest moving detailed reference material into separate files.
> Second, link to those files from SKILL dot M D, and say what each one contains, so Claude knows when to open it. On screen is the kind of short "additional resources" section the docs show.
> And keep the body itself concise. Once it loads, every line stays in context, so state what to do rather than explaining why at length. It's the same test we used for CLAUDE dot M D.

*Cue: panel "When a skill is right"*
> So when is a skill the right tool? The docs give three clear signals.
> One, you keep pasting the same instructions, checklist, or multi-step procedure into chat.
> Two, a section of CLAUDE dot M D has turned into a procedure instead of a fact.
> Three, you have long reference material that Claude only needs sometimes.
> And when is it not? Facts every session needs belong in CLAUDE dot M D. Big, noisy jobs where you only want the result belong in a subagent. And a rule that must hold every single time, the docs say, belongs in a hook, because a skill is guidance Claude follows, not something that runs automatically. We'll get to hooks later in week three.

**Visual / B-roll:**
- Two points + Illustration: add-discount SKILL.md frontmatter and first steps.
- Four numbered fields: name · description · disable-model-invocation · allowed-tools.
- Two points + Illustration: "Additional resources" section linking reference.md.
- Panel: Repeated · Procedure · Reference.

### 11:30–12:30 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: CLAUDE dot M D is what Claude always knows. A skill is what Claude knows how to do, loaded only when it's needed.

*Cue: recap slide*
> Recap. A skill is a folder with a SKILL dot M D and optional supporting files, and it loads in layers: the description first, the body when used, the extra files only when needed. Skills live in dot claude slash skills in a project, or in the same folder under your home directory, plus plugins and a few other places. Compared to the rest: CLAUDE dot M D holds facts, a skill holds procedures, slash commands are now skills, and subagents are separate workers. And SKILL dot M D is frontmatter plus instructions, with description as the field that matters most.

*Cue: next-episode slide*
> Next in the playlist is episode fifteen: running a skill. We'll put add discount to work, both ways: letting Claude pick it up and invoking it ourselves. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 15 · Running a Skill".

---

## Example file: `.claude/skills/add-discount/SKILL.md` (written for the course)

```markdown
---
name: add-discount
description: Adds or changes a discount code in the cart project. Use when the user asks for a new code, an expiry date, or a change to a discount rule.
---

Add or change a discount code:
1. Edit the codes table in src/discounts.js. See reference.md for the format.
2. Keep every amount in integer cents, never floats.
3. Add tests for the expiry edge cases: expired, expires today, timezone.
4. Run `npm test` and report the result.

## Additional resources
- Codes table format: see [reference.md](reference.md)
- List current codes: run scripts/list-codes.sh
```

Folder (example):
```text
.claude/skills/add-discount/
├── SKILL.md
├── reference.md
└── scripts/
    └── list-codes.sh
```

---

## Production notes
- Spoken word count is about 1,850 words, roughly 12 to 13 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. The add-discount skill is written for the course. No Claude output is shown.
- Locations per the skills docs' "Choose where skills load" table: Enterprise (managed settings directory), Personal `~/.claude/skills/<skill-name>/SKILL.md`, Project `.claude/skills/<skill-name>/SKILL.md`, Nested `<subdir>/.claude/skills/...`, Additional directory (`--add-dir`), Plugin `<plugin>/skills/<skill-name>/SKILL.md` (invoked as `/plugin-name:skill-name`), claude.ai account. The claude.ai synced skills row is left out of the narration for time.
- Loading: descriptions are in context, full content loads when invoked; supporting files load when needed; scripts are "executed, not loaded"; invoked skill content stays in the conversation across turns ("Skill content lifecycle"). "Progressive disclosure" is used as a general description of this layered loading.
- Frontmatter: all fields optional, `description` recommended; `name`, `description`, `when_to_use` (combined text truncated at 1,536 characters in the listing), `disable-model-invocation`, `user-invocable`, `allowed-tools`, plus `model`, `context`, `paths` named; unrecognized fields ignored without error; frontmatter read only when `---` is the first line.
- `context: fork` runs the skill in a subagent that doesn't see conversation history; subagents can preload skills (`skills` field). Rules that must always hold → hooks ("Claude stops following a skill" troubleshooting). Hooks come later in Week 3 per youtube-plan.md.
- Invocation is only introduced here; Episode 15 covers running skills.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Claude Code Skills Explained: SKILL.md, Where Skills Live, and When to Use One | Agentic Engineering Ep 14
2. Skills vs CLAUDE.md vs Subagents in Claude Code | Ep 14
3. Introduction to Agent Skills in Claude Code | Agentic Engineering Ep 14

### Description
```
Episode 14 of Agentic Engineering, a free course on building real software with AI coding agents. Week 3 starts here.

In this episode: what a skill is (a folder with a SKILL.md and optional supporting files), how skills load in layers (description first, full content when used, extra files only when needed), where skills live (.claude/skills/ in a project, ~/.claude/skills/ for personal, plugins and more), how skills compare to CLAUDE.md, slash commands and subagents, the SKILL.md format and its frontmatter fields, and when a skill is the right tool.

Note: screens are drawn illustrations, and the add-discount skill is an example written for the course.

Next in the playlist: Episode 15 · Running a Skill.
```

### Tags
Claude Code, Claude Code skills, SKILL.md, agent skills, CLAUDE.md, subagents, slash commands, AI coding agents, agentic engineering

### Thumbnail text idea
"SKILLS" in coral with a small folder icon and "SKILL.md".

---

## Suggested slide list (Episode 14 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 14 · Introduction to Skills |
| 2 | Agenda | What it is · Where it lives · How it compares · Format and fit |
| 3 | 01 · What is a skill | Divider |
| 4 | A folder with a SKILL.md | Folder · SKILL.md · Extras |
| 5 | Loads in layers | Listing → Match → SKILL.md → Ref file → Script |
| 6 | Three layers | Listing · Body · Files |
| 7 | add-discount folder | Illustration |
| 8 | 02 · Where it fits | Divider |
| 9 | Personal or project | ~/.claude/skills/ vs .claude/skills/ |
| 10 | More places | Plugin · Nested · Enterprise · --add-dir (Illustration) |
| 11 | Four tools compared | CLAUDE.md · Skill · Command · Subagent |
| 12 | Commands became skills | Illustration |
| 13 | Skill or subagent? | Inline vs own context; context: fork (Illustration) |
| 14 | 03 · The SKILL.md format | Divider |
| 15 | Frontmatter + body | add-discount SKILL.md (Illustration) |
| 16 | Fields worth knowing | name · description · disable-model-invocation · allowed-tools |
| 17 | Keep it lean | Under 500 lines; link supporting files (Illustration) |
| 18 | When a skill is right | Repeated · Procedure · Reference |
| 19 | Quote | Always knows vs knows how to do |
| 20 | Recap | What it is · Where · Compared · Format |
| 21 | Next | Episode 15 · Running a Skill |

---

## Sources
- Skills: https://code.claude.com/docs/en/skills (SKILL.md with instructions; Claude uses skills when relevant or via `/skill-name`; when to create a skill; a skill's body loads only when used, unlike CLAUDE.md; custom commands merged into skills, `.claude/commands/` still works, prefer skills for new work; "Choose where skills load" table; monorepo/nested loading; types of skill content; frontmatter reference; supporting files and the 500-line tip; control who invokes a skill and the context-loading table; skill content lifecycle; run skills in a subagent with `context: fork`; troubleshooting incl. hooks for rules that must always hold).
- Episode 13 reference: /workspace/agentic-course/day14-ep13-script.md.
