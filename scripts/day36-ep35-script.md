# Day 36 · Episode 35: Field Notes and Wrap-Up (Course Finale)

**Series:** Agentic Engineering (free YouTube course) · Module 14 · the last episode
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 10:00 in the plan; estimated 9:06 from the word count (times below are estimates; replace with real slide times after the voiceover)
**Format:** faceless: slides + one drawn terminal graphic + AI voiceover, no presenter on screen
**Covers (Module 14):** Field Notes and Wrap-Up

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated episode, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No tool output and no screenshot is shown. The field notes come from the capstone builds in Episodes 29 to 34, as written in those episodes' production notes; the checklist file is **written for the course** and printed in full below. Nothing new was built for this episode.

**Counts drawn on slides (checked against the course files and the throwaway project):** field notes: 4. Rule layers: 4 (policy on the route, form request rule, model method, database constraint). Traps on the terminal slide: 5. Capstone results (Episode 34 run, 12 October 2026): 12 of 12 requirements, 5 quality requirements, 3 decisions, 8 archived OpenSpec changes, 11 capabilities in openspec/specs, 133 tests passing on PostgreSQL 17. Phone-check findings fixed: 2 (Episode 33 ticket header, Episode 34 users page order). Deliberate breaks: in every build episode from 31 to 34. Course: 35 episodes plus a trailer, 14 modules, 5 weeks. Habits: 3. Places to go next: 4 sets of official docs.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:18 | [VOICEOVER + SLIDE] | Hook |
| 0:18–0:41 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 0:41–4:20 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 1 · Field notes |
| 4:20–6:17 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Honest notes |
| 6:17–8:27 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Wrap-up |
| 8:27–9:06 | [VOICEOVER + SLIDE] | Recap + goodbye |

---

## Script

### 0:00–0:18 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> In the trailer, I asked one question. Not "can AI write code?", but "can you steer it well?" Thirty-five episodes later, this is my answer, in field notes: what actually happened when the plans met real code. And then, the end of the course.

**Visual / B-roll:**
- Title card.

### 0:18–0:41 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode thirty-five: field notes and wrap-up. The course finale.

*Cue: agenda slide "Three parts"*
> Three parts. First, four field notes from the capstone. Second, honest notes: what I ran myself, and what I only described. Third, the wrap-up: the whole course on one slide, three habits to keep, and where to go next.

**Visual / B-roll:**
- Three items: 01 Field notes · 02 Honest notes · 03 Wrap-up.

### 0:41–4:20 · Part 1: Field notes
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "01 · Field notes"*
> Part one. Field notes.

*Cue: panel "Where we left off"*
> Where we left off. Episode thirty-four finished the Support Desk. All twelve requirements are done: specs archived, tests passing, and merged locally. Eleven capabilities, one hundred and thirty-three tests, and three decisions written down next to the requirements.
> Seven capstone episodes, from the requirements file to the last merge. Those builds left notes behind, in the production notes of every episode. Here are the four I'd keep.

*Cue: 4num "Four field notes"*
> One: decide first. Two: put rules in layers. Three: make every test fail once. And four: check the real thing.

*Cue: two columns "Decide first"*
> Field note one. In episode twenty-eight, we left three questions open: does search include notes, can the last admin step down, and can a customer change a category. That was fine on day one. But by episode thirty-four, each question blocked code.
> An agent will happily pick an answer for you. It might even pick a good one. But then the decision lives in a diff, not in your requirements, and the next session doesn't know it was ever a choice.
> So decide, and write it next to the requirements, on main, before any branch. Three short lines, D one to D three, and every later change could point to them.

*Cue: plan "Rules in layers"*
> Field note two. Put each rule where it can't be skipped, and often in more than one place.
> In the Support Desk, the policy sits on the route, so a page can't forget to check. The form request refuses an archived category, even if the form never shows one. The Ticket model owns the reply rules, so every caller gets them. And the database has a check constraint on the status column, from episode thirty.
> The page can hide a button. That's a convenience. The layers underneath are the rules.

*Cue: squares "Make it fail once"*
> Field note three. A test that has never failed proves nothing.
> From episode thirty-one on, every build had a deliberate break. Remove the owner check, remove the reopen rule, switch off the last admin check. Watch the right tests fail, and only those. Then put the code back.
> It takes a minute, and it's the only way to know a test is watching what you think it's watching. That matters even more when an agent wrote the test. A test that passes before the code exists, or passes whatever the code does, looks exactly like a good test until you break something.

*Cue: card "Check the real thing"*
> Field note four. Check the real thing, in a real browser.
> Every test passed in episode thirty-three, and the ticket header still wrapped badly on a phone. Every test passed in episode thirty-four, and the users page still hid the admin on a late page, behind twenty thousand customers. A phone-width browser check found both. Tests prove the rules. Only looking proves the page.

*Cue: monitor "Traps worth knowing"*
> And a few smaller traps, each of which cost me time once.
> New pages need a build, or the Vite manifest can't find them in tests. Environment variables you set win over the ones in the PHPUnit file, which is exactly how each worktree got its own test database. Generated route files are never edited by hand; generate them again. Lazy loading should fail loudly outside production. And on a shared machine, run one heavy job at a time, and stop every server you start.

### 4:20–6:17 · Part 2: Honest notes
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Honest notes"*
> Part two. Honest notes.

*Cue: two-points "Run, or described"*
> This course is illustrated: drawn screens, not screen captures. The walkthrough episodes said so as they went. Here's the whole picture in one place.
> What I ran myself: the capstone code, in a throwaway copy of the project. The setup, the migrations, every policy, controller and page, all the tests, the format, lint, type and static checks, the phone-width checks with a Playwright script, the OpenSpec validate and archive steps, the worktrees and the merge.
> What I only described: the Claude Code sessions themselves. The explore, propose and apply results you saw are the reviewed course versions, not Claude's output. Also GitHub: no pull requests and no Actions runs, because the throwaway copy has no remote. And Conductor, which is a Mac app, came from its docs.
> In the earlier modules, the example files were written for the course and explained from the official docs. A few I checked myself, like the hook scripts, run against sample input, and an OpenSpec change, run in a throwaway project.

*Cue: phone "The capstone, built"*
> So when I say the capstone works, here's exactly what that means. In my throwaway copy, on PostgreSQL seventeen, one hundred and thirty-three tests passed, and eight OpenSpec changes were archived into eleven capabilities.
> "Merged" means merged locally, with the CI check script run by hand as a stand-in. On your own repository, with a remote, the pull requests and CI are the real thing.

*Cue: flow "Requirement to done"*
> And that's the path every requirement took. Decide what's open. Write the spec. Build it. Test it, including one deliberate break and a look in the browser. Then archive, review and merge.
> None of those steps needs an agent. The agent makes each one faster. You still decide when each one is done.

### 6:17–8:27 · Part 3: Wrap-up
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Wrap-up"*
> Part three. Wrap-up.

*Cue: flow "Five weeks"*
> The whole course, on one slide. Week one, foundations: from autocomplete to agent, Claude Code from zero, context and prompts. Week two, the workflow: plan, execute, verify, then CLAUDE dot M D and subagents. Week three, extending the agent: skills, hooks and MCP. Week four: specs with OpenSpec, GitHub, and parallel work. And week five, the capstone, from requirements to twelve of twelve.
> Thirty-five episodes and a trailer, fourteen modules. And one project that grew from a single requirements file into a working help desk, with customers, agents and admins.

*Cue: squares "Three habits"*
> If you keep only three habits, keep these.
> Plan before you build: explore, then a written plan you've actually reviewed.
> Verify before you trust: tests that failed once, the real browser, the same checks CI runs.
> And write it down: requirements, decisions, specs, and a CLAUDE dot M D file, so the next session starts where the last one ended.

*Cue: card "Where to go next"*
> Where to go next. The tools in this course change fast, so go to the source. The Claude Code docs, for skills, hooks, subagents, MCP and worktrees. The OpenSpec repository, for the spec workflow. The Laravel docs and the Inertia docs, if you're building on the same stack.
> I took every fact in this course from those official pages. When something changes, they'll be right before any video is, including mine. If a command in an older episode stops working, check the docs first, then adjust the step.

*Cue: two columns "Your turn"*
> Your turn, one last time. Pick a small project of your own. Write five numbered requirements and a line that says what done means. List the open questions and decide them. Then build one requirement with the full loop: explore, propose, apply, a deliberate break, a browser check, archive.
> The checklist from this episode is in the description. It's short on purpose. Print it, stick it next to your screen, and tick it off the first few times. After that, you won't need it.

### 8:27–9:06 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The agent writes the code. You own the result.

*Cue: recap slide*
> Quick recap.
> Four field notes: decide first, rules in layers, make every test fail once, and check the real thing.
> Honest notes: the capstone code ran in a throwaway copy; the Claude sessions, GitHub and Conductor were described.
> And three habits: plan, verify, and write it down.

*Cue: closer slide "Thank you"*
> That's the end of Agentic Engineering. Thank you for watching, and for building along. Every episode stays in the playlist, from the trailer to this one, so go back to any part whenever you need it. Take care, and happy building.

---

## Example files (written for the course)

One file, printed in full. It contains no `<` or `>`, so it goes into the description as it is (without its title line). Nothing else was built for this episode.

### `field-notes.md`

```markdown
# Field notes checklist (Agentic Engineering)

## Before you build
- Write the requirements down, numbered, with a line that says what done means.
- List the open questions. Decide each one before the code that depends on it, and write the decision next to the requirements.
- Explore first, then propose. Review the plan in order: proposal, spec, design, tasks.

## While you build
- Put each rule where it cannot be skipped: a policy on the route, a rule in the form request, a method on the model, a constraint in the database.
- Never edit generated files. Generate them again.
- One heavy job at a time. Stop every dev server when you are done.
- One worktree per separate task, each with its own dependencies, env file and test database.

## Before you call it done
- Make every new test fail once on purpose, then put the code back.
- Check the real thing: open it in a browser at phone width and look.
- Run the same checks CI runs: format, lint, types, tests.
- Archive the spec, get the pull request reviewed, merge.
- Say plainly what you ran and what you only described.
```

---

## Production notes
- Spoken word count: about 1,360 words, roughly 9:06 at the Episode 31 pace (2,682 words ran 18:01), plus slide pauses (plan target about 10).
- Illustrated episode, not a recording. One drawn terminal graphic (slide 10) with the Illustration tag; the other drawn views (plan, card, phone, two-points) also carry it. No output and no screenshot. Nothing new was built for this episode.
- Sources of the field notes, all in earlier production notes: decisions D1 to D3 (Episode 34, docs/requirements.md commit dbf1a7a); rule layers (Episode 33 policy on routes; Episode 34 archived-category rule in StoreTicketRequest and Ticket::respond; Episode 30 Laravel enum columns, which on PostgreSQL are a string column with a check constraint); deliberate breaks (Episodes 31, 32, 33, 34); phone-check findings (Episode 33 ticket header separators wrapping; Episode 34 users page sorted by name only, admin not on page 1 of 20,000+ users); traps (Episode 33 Vite manifest; Episode 34 PHPUnit env values not overriding variables already set, one test database per worktree; Episodes 29 and 33 generated Wayfinder files; Episode 32 lazy loading throws outside production; Episodes 33 and 34 one heavy job at a time).
- Capstone numbers come from the Episode 34 run on 12 October 2026 in /workspace/capstone-throwaway/support-desk (main at 7c07f6c): 133 tests passed (composer ci:check, then tests/Feature/Auth again after the spec-only commit), openspec/changes/archive holds 8 changes, openspec/specs 11 capabilities (validate --specs --strict passed again today), docs/requirements.md has 12 R lines, 5 Q lines, 3 D lines. A fresh test run for this episode was not possible: after a restart of the shared machine PostgreSQL is no longer installed on it, and I did not reinstall it, to keep the machine's load light. The narration only quotes the Episode 34 results.
- Honest notes, checked against every episode's header and production notes: modules 1 to 12 are illustrated with files written for the course (Episode 20 hook scripts were run against sample JSON with a stub php, not inside a Claude Code session; Episode 25's OpenSpec change was run in a throwaway copy). Capstone (Episodes 29 to 34): setup and code were run in the throwaway copy (the project was rebuilt once from the course files, commit 958c22d); gh repo create, /install-github-app, git push, pull requests, GitHub Actions and the code-reviewer subagent were not run; Claude was not run in the capstone builds (explore, propose and apply are the reviewed course versions); Playwright MCP was not connected, so a Playwright script ran the phone checks; Conductor was described from its docs (no screenshots; it is a Mac app).
- Trailer mismatches worth knowing (not narrated): the trailer says the demo code goes in a public GitHub repo, one folder or branch per episode, and that everything is recorded. No public repo exists from these builds (the throwaway project has no remote), and the episodes are illustrated walkthroughs. The finale points viewers to the descriptions for prompts, commands and the checklist, not to a repo.
- Course facts: youtube-plan.md lists a trailer and Episodes 1 to 35 over 36 days, modules M1 to M14, five weeks; the week summaries follow the trailer's own week list.
- Where to go next: code.claude.com/docs, github.com/Fission-AI/OpenSpec, laravel.com/docs, inertiajs.com (the official sources used throughout the course).
- Logic checks: 4 field notes (the agenda and the 4num slide say 4; the traps slide is extra and called traps, not a note); 4 rule layers; 5 traps on slide 10; 3 decisions; 12 requirements, 5 quality requirements; 8 changes, 11 capabilities; 133 tests; 2 phone-check findings; 7 capstone episodes (28 to 34); 35 episodes plus a trailer; 14 modules; 5 weeks; 3 habits; 4 sets of docs. The agenda's three parts match the three dividers.
- YouTube description: 3,817 characters, under the 4,500 target, no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Field Notes from Building a Real App with Claude Code: What Actually Mattered | Agentic Engineering Ep 35 (Finale)
2. Plan, Verify, Write It Down: Wrapping Up a Free Agentic Coding Course | Ep 35
3. Field Notes and Wrap-Up (Course Finale) | Agentic Engineering Ep 35

### Description (ready to paste, 3,817 characters)

```
Episode 35 of Agentic Engineering, a free course on agentic coding. The course finale.
Four field notes from the capstone, an honest account of what was run and what was only described, the whole course on one page, and three habits to keep.
Screens are drawn illustrations; no output is shown. The checklist below is written for the course.

Previous: Episode 34, Capstone, Core Features Part 2: https://youtu.be/lN4gnV8FdVs

Field notes:
1. Decide first. Open questions block code later; decide them and write the decisions next to the requirements, on main, before any branch.
2. Rules in layers. A policy on the route, a rule in the form request, a method on the model, a constraint in the database. The page only hides buttons.
3. Make every test fail once. Break the code on purpose, watch the right tests fail, put it back.
4. Check the real thing. A phone-width browser check found two layout problems that every test missed.

Traps worth knowing: new pages need a build before tests (Vite manifest); environment variables you set win over phpunit.xml, so each worktree can get its own test database; never edit generated route files; make lazy loading fail outside production; one heavy job at a time, and stop every server you start.

Honest notes:
Run myself, in a throwaway copy of the project: the capstone setup, migrations, policies, controllers, pages, all tests (133 passing on PostgreSQL 17 in the Episode 34 run), Pint, PHPStan, lint and type checks, phone-width checks with a Playwright script, OpenSpec validate and archive (8 changes, 11 capabilities), two git worktrees and the merge, and the CI check script run by hand.
Only described: the Claude Code sessions themselves (plans and code shown are the reviewed course versions), GitHub pull requests and Actions runs (the throwaway copy has no remote, so "merged" means merged locally), and Conductor (a Mac app, from its docs). Earlier modules use example files written for the course; a few were checked locally, such as the hook scripts against sample input.

The course in five weeks:
Week 1, foundations: autocomplete to agent, Claude Code, context and prompts.
Week 2, workflow: plan, execute, verify; CLAUDE.md; subagents.
Week 3, extending: skills, hooks, MCP.
Week 4: OpenSpec, GitHub, parallel work.
Week 5: the capstone, from requirements to 12 of 12.
35 episodes and a trailer, 14 modules.

Three habits: plan before you build, verify before you trust, write it down.

Field notes checklist:
## Before you build
- Write the requirements down, numbered, with a line that says what done means.
- List the open questions. Decide each one before the code that depends on it, and write the decision next to the requirements.
- Explore first, then propose. Review the plan in order: proposal, spec, design, tasks.

## While you build
- Put each rule where it cannot be skipped: a policy on the route, a rule in the form request, a method on the model, a constraint in the database.
- Never edit generated files. Generate them again.
- One heavy job at a time. Stop every dev server when you are done.
- One worktree per separate task, each with its own dependencies, env file and test database.

## Before you call it done
- Make every new test fail once on purpose, then put the code back.
- Check the real thing: open it in a browser at phone width and look.
- Run the same checks CI runs: format, lint, types, tests.
- Archive the spec, get the pull request reviewed, merge.
- Say plainly what you ran and what you only described.

Where to go next (official docs):
Claude Code: https://code.claude.com/docs
OpenSpec: https://github.com/Fission-AI/OpenSpec
Laravel: https://laravel.com/docs
Inertia: https://inertiajs.com

Thank you for watching the whole course. Every episode stays in the playlist, from the trailer to this finale.
```

---

## Slide list

| # | Slide | Notes |
|---|---|---|
| 1 | title slide | title |
| 2 | Three parts | agenda |
| 3 | 01 · Field notes | divider |
| 4 | Where we left off | panel |
| 5 | Four field notes | 4num |
| 6 | Decide first | two |
| 7 | Rules in layers | plan (Illustration) |
| 8 | Make it fail once | squares |
| 9 | Check the real thing | card (Illustration) |
| 10 | Traps worth knowing | monitor (Illustration) |
| 11 | 02 · Honest notes | divider |
| 12 | Run, or described | two-points (Illustration) |
| 13 | The capstone, built | phone (Illustration) |
| 14 | Requirement to done | flow |
| 15 | 03 · Wrap-up | divider |
| 16 | Five weeks | flow |
| 17 | Three habits | squares |
| 18 | Where to go next | card (Illustration) |
| 19 | Your turn | two |
| 20 | quote slide | quote |
| 21 | recap slide | recap |
| 22 | Thank you | closer |

Layouts: title 1, agenda 1, divider 3, panel 1, 4num 1, two 2, plan 1, squares 2, card 2, monitor 1, two-points 1, phone 1, flow 2, quote 1, recap 1, closer 1; none twice in a row.

---

## Sources
- Course: youtube-plan.md; the trailer; Episodes 20, 25, 27, 28 to 34 (headers and production notes)
- Claude Code: https://code.claude.com/docs
- OpenSpec 1.14.1: https://github.com/Fission-AI/OpenSpec
- Laravel: https://laravel.com/docs/13.x (migrations: enum columns; authorization; validation)
- Inertia: https://inertiajs.com
