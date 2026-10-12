# Day 18 · Episode 17: A React Best Practices Skill

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 12:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 7 lesson):** React Best Practice Skill

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `react-best-practices` skill and its `examples.md` are **written for this course** (full text under "Example files" below). The React rules in it come from react.dev. No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) | n/a |
| 1:00–3:30 | [VOICEOVER + SLIDE] | Part 1 · A reference skill, and why React | React Best Practice Skill |
| 3:30–8:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Writing the skill: folder, frontmatter, paths, the four rule groups, examples.md | React Best Practice Skill |
| 8:00–10:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Using and testing it | React Best Practice Skill |
| 10:30–11:30 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we wrote grill me, a skill that makes Claude interview you before any code exists. It was a task: you start it, it runs, it ends with a spec.
> Today's skill is a different kind. It never runs as a task. It just sits there, and whenever Claude touches React code, it brings your team's rules with it.

**Visual / B-roll:**
- Episode 16 recap panel, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode seventeen: a React best practices skill.

*Cue: agenda slide "Three parts"*
> Three parts. First, what a reference skill is, and why React is a good fit. Second, writing the skill: the frontmatter, a field that limits it to React files, and the rules themselves. Third, using it and testing it. Everything on screen is an illustration. The skill is written for this course, and every React rule in it comes from the official React docs at react dot dev.

**Visual / B-roll:**
- Three items: 01 Reference skills · 02 Write it · 03 Use and test it.

### 1:00–3:30 · Part 1: A reference skill, and why React
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "01 · A different kind of skill"*
> Part one. A different kind of skill.

*Cue: two columns "Task or reference"*
> The skills docs describe two types of skill content.
> Task content gives Claude step-by-step instructions for a specific action, like a deployment or a commit. Add discount and grill me are both task skills. They have a beginning and an end.
> Reference content adds knowledge Claude applies to your current work: conventions, patterns, style guides, domain knowledge. The docs say this content runs inline, so Claude can use it alongside your conversation.
> A React best practices skill is reference content. It doesn't do a job. It shapes how Claude does every job that touches React.

*Cue: panel "Why React"*
> Why React? Because it's a perfect fit for the signals from episode fourteen.
> The rules repeat. Every review, I end up writing the same comments: don't put that in state, you don't need that Effect, that key will break.
> They're easy to forget, for people and for agents, especially halfway through a long task.
> And they're well documented. I don't have to invent anything. React's own docs spell these rules out, so the skill can just point Claude at the established ones.
> Could this go in CLAUDE dot M D instead? It could, but it would load in every session, including the ones that never touch a component. As a skill, it only loads when it's needed.

*Cue: four numbered "Four rule groups"*
> The skill covers four groups of rules, all from react dot dev.
> Purity and Hooks: components stay pure, and Hooks follow the rules of Hooks.
> State: keep it minimal, and never mutate it.
> Effects: only for synchronizing with something outside React.
> And lists: stable keys.
> I kept it to these on purpose. They're the uncontroversial basics, the ones nobody on a React team argues about. Your own team's style choices can go on top.

**Visual / B-roll:**
- Two columns: Task content vs Reference content.
- Panel: Repeated · Forgotten · Documented.
- Four numbered: Purity and Hooks · State · Effects · Lists.

### 3:30–8:00 · Part 2: Writing the skill
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Writing the skill"*
> Part two. Writing the skill.

*Cue: drawn folder tree "A project skill"*
> This one is a project skill. It's about how this team writes React, so it lives in the repository, in dot claude slash skills slash react dash best dash practices, and it gets committed so the whole team gets it.
> Two files. SKILL dot M D, with the rules. And examples dot M D, with a short before and after for each rule. Both are written for this course, and the full text is in the description.

*Cue: two points "The frontmatter"*
> The frontmatter has three fields that matter here.
> The description says what it is: React conventions for this codebase, from the official react dot dev guidance, for writing, editing, or reviewing React components or Hooks. Remember, Claude reads the description to decide when to use a skill, so the main use case goes first.
> Then when to use. This field adds extra trigger phrases, like creating a component, adding state or an Effect, rendering a list, or reviewing a pull request that touches React code. The docs say it's appended to the description in the listing, and the combined text is capped at one thousand five hundred thirty six characters.
> And notice what's not there. No disable model invocation. For a reference skill, we want Claude to pick it up on its own. That's the whole point.

*Cue: squares "Three ways it's matched"*
> The third field is paths, and it's the one I want you to remember from this episode.
> Paths takes glob patterns, as a comma-separated string or a YAML list. The docs say when it's set, Claude loads the skill automatically only when working with files that match those patterns.
> For us, the patterns are the J S X and T S X files under source. So editing a React component can bring the skill in, and a change to a database script won't load it automatically.
> That keeps the skill out of the way until React files are involved, which matters, because once a skill's content loads, it stays in context across later turns.

*Cue: card "Purity and Hooks"*
> Now the body. It opens with one line: apply these rules to all React code in this task. That's a standing instruction, the habit from last episode, because the file isn't re-read on later turns.
> The first group is purity and Hooks. React's rules say components and Hooks must be pure: given the same inputs, they return the same result, and they have no side effects during render. Side effects belong in event handlers or Effects.
> Then the rules of Hooks. Only call Hooks at the top level of a component or a custom Hook. Not inside loops, conditions, or nested functions, and before any early return.
> And one from the React docs on components: never define a component inside another component.

*Cue: plan "State and Effects"*
> The second and third groups go together.
> State first. React's guide on choosing the state structure says to avoid redundant state. If you can calculate something from props or existing state during render, don't put it in state. Its classic example is a full name built from a first and last name. And a common case of redundant state is copying props into state, so the skill says, don't.
> Also, treat state as read-only. The docs on updating objects in state say that instead of mutating objects, you should always replace them.
> Then Effects. The React docs have a whole page called, you might not need an Effect. Effects are an escape hatch for synchronizing with an external system, like the network or a browser A P I. You don't need an Effect to transform data for rendering, and you don't need one to handle user events. Those go in the event handler, where you know exactly what the user did.

*Cue: two points "Lists and checks"*
> The fourth group is lists. React's docs on rendering lists say keys must be unique among siblings, and must not change. Using the array index as a key often leads to subtle bugs when items are inserted, removed, or reordered. And generating keys on the fly, during render, recreates the items every time. So the rule: a stable key from the data, like an I D.
> Then one last line, a check: run the lint and test scripts after every change, and report the result. The rules of Hooks page points to the e s lint plugin for React Hooks to catch those mistakes, so a lint step backs up the skill.

*Cue: phone "examples.md"*
> Last, the supporting file. SKILL dot M D ends with one line: for before and after examples of each rule, see examples dot M D.
> Examples dot M D has a short avoid and prefer for each rule, in plain text. For example: avoid, a key set to the array index on a cart list where items can be removed. Prefer, a key set to the item's I D.
> It's only read when Claude wants an example, so SKILL dot M D stays short. And I wrote both files without any angle brackets, no J S X tags, so they paste cleanly into a YouTube description.

**Visual / B-roll:**
- Monitor + Illustration: .claude/skills/react-best-practices/ with SKILL.md, examples.md.
- Two points + Illustration: frontmatter (description, when_to_use, paths).
- Squares: description · when_to_use · paths.
- Card + Illustration: Purity and Hooks section.
- Plan + Illustration: State and Effects sections.
- Two points + Illustration: Lists and Checks sections.
- Phone + Illustration: examples.md "Stable keys" entry.

### 8:00–10:30 · Part 3: Using and testing it
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Using and testing it"*
> Part three. Using it, and testing it.

*Cue: flow "How it gets used"*
> Here's the normal flow. You ask for React work, like adding a remove button to a cart list component. Claude is working with a J S X file, so it matches the paths. The skill loads, Claude applies the rules while it writes the change, and the check line runs the lint and tests.
> You didn't type anything special. That's what a reference skill feels like when it works.

*Cue: drawn terminal "Or ask for a review"*
> You can also invoke it directly, because it's user invocable by default. Type slash react dash best dash practices, then a file path.
> The skill has no arguments placeholder. The docs cover that case: if you pass arguments and no placeholder receives them, Claude Code appends them to the end of the skill content, labelled arguments, so Claude still sees which file you meant. It's a quick way to ask for a review against the rules.
> On screen are only the two prompts I'd type. No output is shown.

*Cue: four numbered "Test it"*
> Testing is the same baseline method as episode fifteen.
> One, write a few realistic React prompts, including some that tempt the bad patterns: show the cart total, or reset the form when the user changes.
> Two, run each one in a fresh session with the skill on.
> Three, run them again with the skill off, using skill overrides.
> Four, compare. Did the version with the skill skip the unnecessary Effect? Did it use stable keys?
> And check the trigger, too. Ask, what skills are available, and try a prompt about a non-React file, to make sure paths keeps it out.

*Cue: panel "Guidance, not a guarantee"*
> One honest limit. A skill is guidance. Claude follows it, but it isn't enforced.
> The docs are clear about this: if a rule must hold every time, move it into a hook, because Claude Code runs a hook every time its event occurs, whether or not Claude is following the skill.
> So for React, the skill teaches the patterns, and the lint step catches what slips through. Running that lint automatically after every edit is a job for a hook, and hooks are coming up later in week three.

**Visual / B-roll:**
- Flow: React task → paths match → SKILL.md → Rules → Lint and tests.
- Monitor + Illustration: two typed prompts only.
- Four numbered: Prompts · Skill on · Skill off · Compare.
- Panel: Guidance · Lint · Hook later.

### 10:30–11:30 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: a task skill does a job. A reference skill changes how every job gets done.

*Cue: recap slide*
> Recap. A React best practices skill is reference content: knowledge Claude applies inline while it works. It's a project skill, so the team shares it. Its description and when to use field say when it applies, and paths limits automatic loading to React files. The rules come from react dot dev: pure components and the rules of Hooks, minimal state that's never mutated, Effects only for external systems, and stable keys. Examples live in a supporting file. And you test it with a baseline, skill on and skill off, knowing that anything that must always hold belongs in a hook.

*Cue: next-episode slide*
> Next in the playlist is episode eighteen: a Laravel security skill. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 18 · A Laravel Security Skill".

---

## Example files (written for the course)

Both files are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are.

### `.claude/skills/react-best-practices/SKILL.md`

```markdown
---
name: react-best-practices
description: React conventions for this codebase, from the official react.dev guidance. Use when writing, editing, or reviewing React components or Hooks.
when_to_use: Creating a component, adding state or an Effect, rendering a list, or reviewing a pull request that touches React code.
paths:
  - "src/**/*.jsx"
  - "src/**/*.tsx"
---

Apply these rules to all React code in this task.

## Purity and Hooks
- Keep components and Hooks pure: same inputs, same result, no side effects during render.
- Call Hooks only at the top level of a component or custom Hook: never in loops, conditions, or nested functions, and always before an early return.
- Never define a component inside another component.

## State
- Do not store what you can calculate from props or state. Calculate it during render.
- Do not copy props into state.
- Treat state as read-only. Replace objects and arrays instead of mutating them.

## Effects
- Use an Effect only to synchronize with an external system, such as the network or a browser API.
- Handle user actions in event handlers, not in Effects.
- Do not use an Effect to transform data for rendering.

## Lists
- Give every list item a stable key from the data, such as an id.
- Do not use the array index as a key when items can be added, removed, or reordered. Never generate keys during render.

## Checks
- Run the lint and test scripts after every change, and report the result.

For before and after examples of each rule, see [examples.md](examples.md).
```

### `.claude/skills/react-best-practices/examples.md`

```markdown
# Examples

## Calculate, don't store
Avoid: a fullName state variable kept in sync by an Effect.
Prefer: const fullName = firstName + ' ' + lastName; during render.

## Event handler, not Effect
Avoid: setting a "submitted" flag, then sending the order from an Effect.
Prefer: send the order inside the Submit button's click handler.

## Stable keys
Avoid: key={index} on a cart list where items can be removed.
Prefer: key={item.id}.

## Replace, don't mutate
Avoid: cart.items.push(item); then setCart(cart);
Prefer: setCart({ ...cart, items: [...cart.items, item] });

## No nested component definitions
Avoid: defining a CartRow function inside the CartList function.
Prefer: define CartRow at the top level of the module and render it from CartList.
```

Folder:
```text
.claude/skills/react-best-practices/
├── SKILL.md
└── examples.md
```

What you type (no output shown):
```text
add a remove button to the cart list
/react-best-practices src/CartList.jsx
```

---

## Production notes
- Spoken word count is about 1,770 words, roughly 12 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. The skill and examples.md are written for the course; the cart's React list component (`src/CartList.jsx`) is an illustrative example. No Claude output is shown.
- The agenda says three parts and the script has three parts (three dividers).
- Claude Code facts (skills page): types of skill content (task vs reference, reference runs inline); `description`, `when_to_use` (appended, 1,536-character combined cap); `paths` (glob patterns, comma-separated string or YAML list, automatic loading only when working with matching files); content stays in context across turns and isn't re-read; supporting files; arguments with no placeholder are appended as `ARGUMENTS: <value>`; skills are user-invocable by default; baseline testing with `skillOverrides` "off"; "What skills are available?"; rules that must always hold go in a hook. CLAUDE.md loads every session (Ep 10, Ep 14).
- React facts (react.dev): Components and Hooks must be pure (idempotent, no side effects in render; side effects in event handlers or Effects) — /reference/rules/components-and-hooks-must-be-pure; Rules of Hooks (top level, not in loops, conditions, nested functions, before early returns; eslint-plugin-react-hooks) — /reference/rules/rules-of-hooks; never nest component definitions — /learn/your-first-component; avoid redundant state, don't mirror props in state (fullName example) — /learn/choosing-the-state-structure; treat state objects as immutable, replace them — /learn/updating-objects-in-state; Effects are an escape hatch for external systems, not needed to transform data or handle user events — /learn/you-might-not-need-an-effect; keys unique among siblings, must not change, index keys cause bugs on reorder, don't generate keys on the fly — /learn/rendering-lists.
- Hooks come later in Week 3 per youtube-plan.md.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. A React Best Practices Skill for Claude Code (from react.dev) | Agentic Engineering Ep 17
2. Teach Claude Code Your React Rules: a Reference Skill with paths | Ep 17
3. Claude Code Skills for React: Purity, State, Effects and Keys | Agentic Engineering Ep 17

### Description
```
Episode 17 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we write a React best practices skill: a reference skill that Claude applies whenever it works on React code. We cover the difference between task and reference skills, why React rules fit a skill better than CLAUDE.md, the description and when_to_use fields, limiting automatic loading to React files with paths, the four rule groups from react.dev (pure components and the Rules of Hooks, minimal and immutable state, Effects only for external systems, stable keys), a supporting examples.md file, invoking it for a review, testing it with a baseline, and why must-hold rules belong in a hook.

Note: screens are drawn illustrations. The skill is written for the course; the React rules come from react.dev.

Full text of the skill:

[paste SKILL.md and examples.md from the script here; neither contains angle brackets]

Next in the playlist: Episode 18 · A Laravel Security Skill.
```

### Tags
Claude Code, Claude Code skills, SKILL.md, React, React best practices, Rules of Hooks, useEffect, React keys, agent skills, AI coding agents, agentic engineering

### Thumbnail text idea
"REACT RULES" in coral, with a small atom-style ring icon and "SKILL.md".

---

## Suggested slide list (Episode 17 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 17 · A React Best Practices Skill |
| 2 | Agenda | Three parts: Reference skills · Write it · Use and test it |
| 3 | 01 · A different kind of skill | Divider |
| 4 | Task or reference | Task content vs Reference content |
| 5 | Why React | Repeated · Forgotten · Documented |
| 6 | Four rule groups | Purity and Hooks · State · Effects · Lists |
| 7 | 02 · Writing the skill | Divider |
| 8 | A project skill | Folder tree (Illustration) |
| 9 | The frontmatter | description · when_to_use · paths (Illustration) |
| 10 | Three ways it's matched | description · when_to_use · paths |
| 11 | Purity and Hooks | Skill section (Illustration) |
| 12 | State and Effects | Skill sections (Illustration) |
| 13 | Lists and checks | Skill sections (Illustration) |
| 14 | examples.md | Stable keys example (Illustration) |
| 15 | 03 · Using and testing it | Divider |
| 16 | How it gets used | React task → paths match → SKILL.md → Rules → Lint and tests |
| 17 | Or ask for a review | Typed prompts only (Illustration) |
| 18 | Test it | Prompts · Skill on · Skill off · Compare |
| 19 | Guidance, not a guarantee | Guidance · Lint · Hook |
| 20 | Quote | Task skill does a job; reference skill changes every job |
| 21 | Recap | Reference · paths · react.dev rules |
| 22 | Next | Episode 18 · A Laravel Security Skill |

---

## Sources
- Skills: https://code.claude.com/docs/en/skills (types of skill content; frontmatter reference: description, when_to_use, paths, disable-model-invocation, user-invocable; add supporting files; pass arguments; skill content lifecycle; evaluate and iterate; troubleshooting).
- React: https://react.dev/reference/rules/components-and-hooks-must-be-pure · https://react.dev/reference/rules/rules-of-hooks · https://react.dev/learn/your-first-component · https://react.dev/learn/choosing-the-state-structure · https://react.dev/learn/updating-objects-in-state · https://react.dev/learn/you-might-not-need-an-effect · https://react.dev/learn/rendering-lists
- Episode 16: /workspace/agentic-course/day17-ep16-script.md.
