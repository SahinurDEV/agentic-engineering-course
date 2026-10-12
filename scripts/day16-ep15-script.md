# Day 16 · Episode 15: Running a Skill

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 13:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 7 lesson):** Running a Skill

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `add-discount` skill is the **example written for this course** in Episode 14, extended here (full text under "Example file" below). No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap | n/a |
| 1:00–5:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Two ways to run a skill: automatic vs /name, where the name goes, who can invoke, what happens after it runs | Running a Skill |
| 5:00–9:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Arguments, bundled scripts, live data with inline commands | Running a Skill |
| 9:00–12:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Testing and iterating on a skill | Running a Skill |
| 12:00–13:00 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we wrote our first skill, add discount, for the cart project. A folder, a SKILL dot M D, a reference file, and a small script.
> But a skill sitting in a folder doesn't do anything yet. Today we run it. We'll let Claude pick it up on its own, call it by name, hand it arguments, and then test it until it behaves.

**Visual / B-roll:**
- Episode 14 add-discount folder tree, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode fifteen: running a skill.

*Cue: agenda slide*
> Four parts. The two ways a skill runs, and how to control which one is allowed. Passing arguments. Supporting files, scripts, and live data. And testing and iterating until the skill does what you meant. As always, everything on screen is an illustration, and add discount is the example skill I wrote for this course.

**Visual / B-roll:**
- Agenda: 01 Run it · 02 Arguments · 03 Files, scripts · 04 Test it.

### 1:00–5:00 · Part 1: Two ways to run a skill
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Two ways to run it"*
> Part one. Two ways to run a skill.

*Cue: flow "Claude picks it up"*
> The first way is automatic. You don't mention the skill at all. You just ask for the work.
> Remember the listing from last episode. In a normal session, every skill's name and description sit in Claude's context, so Claude knows what's available. When you ask something like, add a summer code for ten percent off, Claude compares that request with the descriptions. The add discount description says it's for new codes, expiry dates, and discount rules, so it matches. Claude invokes the skill, the full SKILL dot M D loads into the conversation, and Claude follows the steps.
> This is why the description matters so much. It's the only part of the skill Claude sees before it decides.

*Cue: drawn terminal "Or call it by name"*
> The second way is direct. Type slash, then the skill's name. For our skill, that's slash add dash discount.
> The name comes from the folder, or from the name field in the frontmatter if you set one. The first example in the docs tests a skill exactly these two ways: ask something that matches the description, or invoke it directly by name.
> On screen is what you'd type. Anything after the name is passed to the skill as arguments, and we'll use that in part two.

*Cue: two columns "Where the name goes"*
> There's a detail here that surprises people. Where you write the skill's name changes what happens.
> At the start of your message, like slash add discount, Claude Code runs the skill directly.
> After plain text, as its own word, like, go ahead and slash add discount for the summer sale, nothing runs directly. The docs say the name counts as your permission for that message. Claude can run the skill while it responds, and it judges from your wording whether you asked it to.
> And if you just want to talk about a skill without permitting a run, leave off the slash.

*Cue: squares "Who can invoke it"*
> By default, both of you can invoke any skill. You type the slash command, and Claude loads it when it's relevant. Two frontmatter fields change that.
> Disable model invocation, set to true, makes a skill manual only. You can still run it, but Claude can't run it on its own, and its description is no longer in Claude's context at all.
> User invocable, set to false, is the reverse. Claude can use it, but it's hidden from the slash menu, and typing its name won't run it. That's for background knowledge, not actions.

*Cue: phone "Keep side effects manual"*
> So should add discount be manual only? The docs' rule of thumb is to use disable model invocation for workflows with side effects, or where you want to control the timing, like commit, deploy, or sending a Slack message. You don't want Claude deciding to deploy because your code looks ready.
> Add discount edits code and runs tests, and we review the diff, so I'm leaving it automatic. A deploy skill would get the flag.
> If Claude tries to run a manual-only skill anyway, Claude Code blocks the call, so expect Claude to suggest you run the slash command yourself.
> And if you don't want to edit a shared skill file, the skill overrides setting does the same job from your settings. In the slash skills menu, highlight a skill and press space to cycle its state. User only is the manual-only state. Escape saves it to your local settings file.

*Cue: panel "After it runs"*
> What happens once a skill runs? The rendered SKILL dot M D enters the conversation as a single message, and it stays there across later turns. Claude Code doesn't re-read the file on later turns, so write guidance that should apply to the whole task as standing instructions, not one-time steps.
> If Claude invokes it again and the content is identical, Claude Code just adds a short note that it's already loaded, instead of a second copy.
> And if the conversation gets compacted, Claude Code re-attaches the most recent invocation of each skill, but keeps only the first five thousand tokens of each, inside a shared budget of twenty-five thousand. So put the most important instructions near the top.

**Visual / B-roll:**
- Flow: Your ask → Listing → Match → SKILL.md → Steps.
- Monitor + Illustration: what you type, automatic vs /add-discount.
- Two columns: /name first (runs) vs text, then /name (permission only).
- Squares: Default · Manual · Claude.
- Phone + Illustration: deploy frontmatter with disable-model-invocation; skillOverrides.
- Panel: One message · Stays across turns · Not re-read; 5,000 tokens after compaction.

### 5:00–9:00 · Part 2: Arguments and scripts
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Arguments and scripts"*
> Part two. Arguments, supporting files, and scripts.

*Cue: drawn SKILL.md "Pass it arguments"*
> Both you and Claude can pass arguments when invoking a skill. The simplest way to use them is the dollar arguments placeholder. It's replaced with whatever follows the skill name.
> So if the body of add discount says, add or change code, dollar arguments, then typing slash add discount summer ten gives Claude, add or change code summer ten.
> If you pass arguments but no placeholder receives them, Claude Code appends them to the end of the skill content, labelled arguments, so Claude still sees what you typed.

*Cue: four numbered "Arguments by position"*
> When you need more than one value, there are a few forms.
> Dollar arguments is everything, exactly as typed.
> Dollar zero, dollar one, and so on, pick out single arguments by position, starting from zero. Wrap a multi-word value in quotes so it counts as one argument.
> Or name them. List them in the arguments field of the frontmatter, like code and percent, and then write dollar code and dollar percent in the body. Names map to positions in order.
> And argument hint shows a hint during autocomplete, like code, then percent off, so you remember what to type.
> Two edge cases from the docs. A named argument you don't pass expands to an empty string, while a numbered one with nothing at its position stays as literal text. And because our cart deals in prices: a literal dollar sign before a digit, like dollar one point zero zero, needs a backslash in front, so it isn't treated as an argument.

*Cue: card "Bundle a script"*
> Now the supporting files. Last episode, add discount had a scripts folder with list codes dot S H. The docs describe scripts as executed, not loaded. Claude runs them rather than reading them into context.
> The trick is the path. Use the claude skill dir variable. It expands to the folder that holds SKILL dot M D, wherever the skill is installed, so the path works no matter what the working directory is.
> Pair it with allowed tools. If allowed tools lists a Bash rule for that same script path, Claude can run the script without asking, during the turn that invokes the skill. That's the pattern the docs show. Two limits. The grant clears when you send your next message. And it doesn't restrict any other tool. Your normal permission settings still apply to everything else.

*Cue: plan "Live data, inline"*
> One more trick: dynamic context injection. An exclamation mark followed by a command in backticks runs that command before Claude sees the skill. The output replaces the line, so Claude gets real data, not the command.
> For add discount, I could add a section with the last five commits, so Claude starts with the current history.
> Three things to know. First, a failed command aborts the whole skill invocation. With the default bash shell, any non-zero exit code counts as a failure, apart from a few search commands, so the docs suggest adding or true to a command you expect to exit non-zero. Second, each command is checked against your permission rules first, and outside auto mode, anything that isn't allowed also aborts the invocation, so pre-approve it in allowed tools. Third, the disable skill shell execution setting turns the feature off, and it's most useful in managed settings.

**Visual / B-roll:**
- Two points + Illustration: `Add or change code $ARGUMENTS` → `/add-discount SUMMER10`.
- Four numbered: $ARGUMENTS · $0, $1 · $code · argument-hint.
- Card + Illustration: ${CLAUDE_SKILL_DIR} and allowed-tools for scripts/list-codes.sh.
- Plan + Illustration: `!`git log -5 --oneline`` in the skill body; Fails · Permissions · || true · off switch.

### 9:00–12:00 · Part 3: Test and iterate
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Test and iterate"*
> Part three. Testing a skill, and making it better.

*Cue: two points "Test it both ways"*
> Start with the two-way test. Open a fresh session in the cart project and ask in plain words: add a summer code, ten percent off. Did Claude pick up the skill? Then invoke it directly with slash add discount and arguments, and check that it follows the steps.
> If it doesn't trigger, ask Claude, what skills are available, to confirm it's listed. And you don't need to restart while you fix things. Claude Code watches the skill folders, and picks up edits to SKILL dot M D in the current session.

*Cue: four numbered "Compare to a baseline"*
> But seeing a skill trigger only tells you Claude found it, not that it did what you intended. The docs suggest measuring two things separately: does Claude invoke it on the prompts it should, and is the output what you expect when it does?
> The method is a baseline comparison. One, collect a few realistic prompts. Two, run each one in a fresh session, because leftover context from writing the skill will hide gaps in the instructions. Three, run them again with the skill turned off. For a personal or project skill, set it to off in skill overrides. Four, compare the results.
> If you want this automated, the skill creator plugin runs a similar loop inside Claude Code, with test cases, isolated runs, grading, and a with-skill versus without-skill benchmark.

*Cue: panel "When it misbehaves"*
> When the results are off, the troubleshooting section of the docs maps the symptoms.
> Not triggering? Check that the description uses words people would naturally say, or rephrase your request. If the frontmatter YAML is broken, the slash command still works, but Claude can't match the description. Running with the debug flag shows the parse error.
> Triggers too often? Make the description more specific, or add disable model invocation.
> Stops following it partway through? Word the guidance so it covers the whole task, like, run the tests after every edit, instead of just, run the tests. After compaction, invoke it again. And a rule that must hold every single time belongs in a hook.

*Cue: drawn loop "Iterate on add-discount"*
> Here's how that loop looks for add discount. Write real prompts. Run them in fresh sessions with the skill on, then again with it off in skill overrides. Compare. Tighten the description or one step. Save, and run again.
> Small edits, one at a time. And keep the prompt list. It becomes your check every time the skill changes.

**Visual / B-roll:**
- Two points + Illustration: the two test prompts.
- Four numbered: Collect · Fresh session · Skill off · Compare.
- Panel: Not triggering · Too often · Stops following; "Must hold? use a hook".
- Monitor + Illustration: five-step loop.

### 12:00–13:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: the description decides when a skill runs. The body decides what it does. Test both.

*Cue: recap slide*
> Recap. A skill runs two ways: Claude picks it up when your request matches its description, or you type slash and its name at the start of a message. Disable model invocation makes it manual only, and user invocable false hides it from the slash menu. Arguments arrive through dollar arguments, numbered positions, or named arguments. Bundled scripts run from the claude skill dir path, they can be pre-approved with allowed tools, and inline commands bring in live data. And you test with realistic prompts in fresh sessions, with the skill on and off.

*Cue: next-episode slide*
> Next in the playlist is episode sixteen: the grill me skill. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 16 · The Grill Me Skill".

---

## Example file: `.claude/skills/add-discount/SKILL.md` (written for the course, extended from Episode 14)

```markdown
---
name: add-discount
description: Adds or changes a discount code in the cart project. Use when the user asks for a new code, an expiry date, or a change to a discount rule.
argument-hint: "[code] [percent-off]"
arguments: [code, percent]
allowed-tools: Bash(${CLAUDE_SKILL_DIR}/scripts/list-codes.sh *) Bash(git log *)
---

## Recent changes
!`git log -5 --oneline`

## Your task
Add or change discount code $code at $percent% off. If either value is empty, ask the user.
1. Run `${CLAUDE_SKILL_DIR}/scripts/list-codes.sh --all` to see the current codes.
2. Edit the codes table in src/discounts.js. See reference.md for the format.
3. Keep every amount in integer cents, never floats.
4. Add tests for the expiry edge cases: expired, expires today, timezone.
5. Run `npm test` after every edit and report the result.

## Additional resources
- Codes table format: see [reference.md](reference.md)
```

Example invocations (what you type, no output shown):
```text
add a summer code, 10% off            # automatic: matches the description
/add-discount SUMMER10 10             # direct: $code = SUMMER10, $percent = 10
```

---

## Production notes
- Spoken word count is about 1,900 words, roughly 13 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. The add-discount skill is written for the course; `list-codes.sh --all` is part of that example. No Claude output is shown.
- Invocation: Claude uses skills when relevant, or via `/skill-name`; "Test the skill" in Getting started shows both ways. Command name = directory name or frontmatter `name`.
- "Where you write the skill's name" table: at the start of a message runs directly; after plain text it counts as permission only; leave off the slash to talk about it.
- "Control who invokes a skill": `disable-model-invocation: true` (description not in context; blocked call, Claude suggests running `/name`), `user-invocable: false` (hidden from `/` menu, typing the name doesn't run it). `skillOverrides` via the `/skills` menu: Space cycles states, Esc saves to `.claude/settings.local.json`; `"user-invocable-only"` is labelled `user-only`.
- "Skill content lifecycle": one message, stays across turns, not re-read; identical re-invocation adds a short note; after compaction the most recent invocation of each skill is re-attached, first 5,000 tokens each, 25,000 combined.
- Arguments: `$ARGUMENTS`, `ARGUMENTS: <value>` appended when no placeholder; `$ARGUMENTS[N]` / `$N` 0-based; shell-style quoting; `arguments` named list; `argument-hint`; missing named → empty string, missing indexed → literal; `\$1.00` escape.
- Scripts: "executed, not loaded"; `${CLAUDE_SKILL_DIR}`; `allowed-tools` Bash rule with the same variable runs without a prompt; grant clears on the next message and restricts nothing.
- Dynamic context injection: `!`command``; failure aborts the invocation; non-zero exit fails except exit 1 from search/comparison commands; `|| true`; permission check first, non-allow aborts outside auto mode, pre-approve with `allowed-tools`; `disableSkillShellExecution`.
- Testing: "What skills are available?"; live change detection; "Evaluate and iterate on a skill" baseline comparison with `skillOverrides` "off"; skill-creator plugin; troubleshooting (not triggering, malformed YAML + `--debug`, triggers too often, stops following, hooks).
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. How to Run a Claude Code Skill: /skill-name, Arguments, Scripts and Testing | Agentic Engineering Ep 15
2. Claude Code Skills: Automatic vs /slash Invocation, $ARGUMENTS and Evals | Ep 15
3. Running and Testing Agent Skills in Claude Code | Agentic Engineering Ep 15

### Description
```
Episode 15 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we put the add-discount skill to work: how Claude picks a skill up automatically from its description, how to invoke it yourself with /skill-name (and why it matters where you type the name), how disable-model-invocation and user-invocable control who can run it, what happens to a skill's content after it runs, passing arguments with $ARGUMENTS, $0 and named arguments, bundling scripts with ${CLAUDE_SKILL_DIR} and allowed-tools, live data with inline !`command` injection, and how to test and iterate on a skill with a baseline comparison.

Note: screens are drawn illustrations, and the add-discount skill is an example written for the course.

Next in the playlist: Episode 16 · The "Grill Me" Skill.
```

### Tags
Claude Code, Claude Code skills, SKILL.md, agent skills, slash commands, $ARGUMENTS, disable-model-invocation, skill testing, AI coding agents, agentic engineering

### Thumbnail text idea
"/add-discount" in coral monospace, with "RUN IT" above.

---

## Suggested slide list (Episode 15 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 15 · Running a Skill |
| 2 | Agenda | Run it · Arguments · Files, scripts · Test it |
| 3 | 01 · Two ways to run it | Divider |
| 4 | Claude picks it up | Your ask → Listing → Match → SKILL.md → Steps |
| 5 | Or call it by name | Automatic vs /add-discount (Illustration) |
| 6 | Where the name goes | /name first vs text, then /name |
| 7 | Who can invoke it | Default · Manual · Claude |
| 8 | Keep side effects manual | disable-model-invocation, skillOverrides (Illustration) |
| 9 | After it runs | One message · Stays · Not re-read; 5,000 tokens |
| 10 | 02 · Arguments and scripts | Divider |
| 11 | Pass it arguments | $ARGUMENTS (Illustration) |
| 12 | Arguments by position | $ARGUMENTS · $0, $1 · $code · argument-hint |
| 13 | Bundle a script | ${CLAUDE_SKILL_DIR} + allowed-tools (Illustration) |
| 14 | Live data, inline | !`command` (Illustration) |
| 15 | 03 · Test and iterate | Divider |
| 16 | Test it both ways | Ask naturally · Call it by name (Illustration) |
| 17 | Compare to a baseline | Collect · Fresh session · Skill off · Compare |
| 18 | When it misbehaves | Not triggering · Too often · Stops following |
| 19 | Iterate on add-discount | Five-step loop (Illustration) |
| 20 | Quote | Description decides when; body decides what |
| 21 | Recap | Run it · Feed it · Test it |
| 22 | Next | Episode 16 · The Grill Me Skill |

---

## Sources
- Skills: https://code.claude.com/docs/en/skills (Getting started "Test the skill"; how a skill gets its command name; control who invokes a skill; where you write the skill's name; skill content lifecycle; pre-approve tools for a skill; pass arguments to skills and available string substitutions; add supporting files; inject dynamic context incl. failures and permission checks; override skill visibility from settings; edit a skill during a session; evaluate and iterate on a skill, skill-creator; troubleshooting).
- Episode 14 reference: /workspace/agentic-course/day15-ep14-script.md.
