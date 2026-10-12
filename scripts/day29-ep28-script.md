# Day 29 · Episode 28: Capstone, the Project and Requirements

**Series:** Agentic Engineering (free YouTube course) · Module 13
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 30:00
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 13 lessons):** Project Introduction · Project Requirements (plus how the course's tools map onto the capstone episodes)

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Claude, Laravel, git or CI output is shown. The requirements file and the kick-off prompt are **written for the course** and printed in full below. No code is written in this episode.

**Counts drawn on slides (checked against the file):** 3 roles (customer, agent, admin). 7 ticket fields. 4 statuses, 4 priorities. 12 functional requirements (R1 to R12) in 4 groups: R1 to R3, R4 to R6, R7 to R10, R11 and R12. 5 quality requirements (Q1 to Q5). 6 out-of-scope items. 3 conditions for done. Status rule: a customer reply on 4 possible statuses gives 3 outcomes (open stays open; pending and resolved become open; closed is refused). Build split: R1 in Episode 29 (starter kit), 5 in Episode 33 (R2, R3, R4, R5, R7), 6 in Episode 34 (R6, R8, R9, R10, R11, R12): 1 + 5 + 6 = 12. R10 tests: at least 6 (4 customer reply cases + 2 agent reply cases: an agent reply on an open, pending or resolved ticket leaves the status unchanged, and an agent reply on a closed ticket is refused). Open gaps named: 3 (search and notes, last admin, editing category). Roadmap: 6 build episodes, 29 to 34. Toolkit: 9 course topics (3 plan side, 4 guardrails, 2 shipping: GitHub and worktrees).

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook |
| 0:25–1:15 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:15–7:05 | [VOICEOVER + SLIDE] | Part 1 · The project |
| 7:05–19:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · The requirements |
| 19:00–28:50 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · How we'll build it |
| 28:50–30:00 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode, we ran several Claude sessions at once, each in its own worktree, without them stepping on each other.
> That was the last new tool. From here on, we stop learning pieces and start building one real app, from an empty folder to merged features. And it starts the way real projects should: with requirements, before any code.

**Visual / B-roll:**
- Episode 27 recap panel, then the title card.

### 0:25–1:15 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-eight: the capstone project and its requirements. It starts module thirteen, the capstone.

*Cue: agenda slide "Three parts"*
> Three parts. First, the project: what we're building, who it's for, and the stack. Second, the requirements: the one file that says exactly what version one must do, line by line. Third, how we'll build it: which tool from this course does which job, and what each of the next episodes covers.
> It's an illustrated walkthrough, not a recording. The requirements file and the prompt are written for this course and printed in full in the description. No code today. That's on purpose.

**Visual / B-roll:**
- Three items: 01 The project · 02 The requirements · 03 How we'll build it.

### 1:15–7:05 · Part 1: The project
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "01 · The project"*
> Part one. The project.

*Cue: two columns "From cart to capstone"*
> Until now, most of our examples used a small shopping cart. That was the right choice for learning. One feature at a time, a few files, and you could see every change.
> But a cart that size hides the hard parts of real work. There's no login, no roles, no data that grows, no rules that depend on who is asking. So the capstone is a whole app. We take it from an empty folder to a set of reviewed, merged features, and we use everything from the course along the way.
> Same habits, bigger stage. One app, start to finish.
> And the order matters. Back in module four, the core loop was explore, plan, build, verify. A capstone is the same loop at product size. Before any session writes code, we need to know what the product is, who uses it, and what counts as finished. That's today's whole job.

*Cue: phone "The pitch"*
> Here's the pitch. We're building a Support Desk.
> A small company sells software. Its customers have questions and problems. Right now those arrive in scattered emails, and nobody knows who's answering what.
> The Support Desk gives them one place. Customers open tickets. Agents, the support staff, reply, assign, and resolve them. And admins set up the categories and decide who is an agent.
> It's a familiar kind of app, and that helps. You already know roughly how it should feel, so we can spend our attention on building it well, not on explaining the idea.
> It's also the kind of app many teams actually run, or pay for. Building a small one yourself teaches the parts every business app shares: accounts, permissions, records that change over time, and screens that list and filter them.

*Cue: flow "A ticket's life"*
> Let's follow one ticket through its life.
> A customer opens it. It lands in the agents' inbox. An agent assigns it, often to themselves. Then there's a conversation: the agent replies, the customer answers. When the problem is fixed, the agent marks it resolved. And later, an agent closes it.
> One detail matters already. If the customer writes back after it's resolved, maybe the fix didn't work, the ticket opens again. That small rule will show up in the requirements, in the data model, and in the tests. We'll keep coming back to it.
> Notice who acts at each step. The customer opens and replies. Agents assign, reply, resolve and close. Nobody else touches the ticket. Writing a flow like this down, with a name on every arrow, is the fastest way to find the roles your app needs.

*Cue: panel "The stack"*
> The stack. Laravel thirteen on the back end. The Laravel docs say version thirteen needs PHP eight point three or newer.
> On the front end, Laravel's official React starter kit. Its docs describe it as Inertia, React nineteen, Tailwind four, and shad c n slash u i. Inertia lets us write React pages while keeping normal Laravel routes and controllers.
> The starter kit also brings authentication. The docs say the kits use Laravel Fortify for that, so sign-up, login and password reset come built in.
> And the database is PostgreSQL. A new Laravel app uses SQLite by default, so switching to PostgreSQL is one of the setup steps next in the playlist.
> This isn't a random pick. It's the stack our React, Laravel security, and database skills were written for, back in module seven.

*Cue: 4num "Why this project"*
> Why a support desk, and not a to-do list? Four reasons.
> Real roles. A customer must never see another customer's tickets. That's a security requirement, and it's exactly what the Laravel security skill is for.
> Real data. Tickets, replies, notes, categories, and a change log, with relationships between them. That's enough to fill three data modeling episodes honestly.
> Real rules. The reopen rule, closed tickets that refuse replies, archived categories. Rules like these are where bugs hide, so they're where tests and specs earn their keep.
> And a real interface. An inbox with filters, a ticket page, an admin screen. Enough React to use the React skill, and enough pages to check in a browser with Playwright.

*Cue: card "How big is version one?"*
> One more decision before the requirements: how big is version one?
> In: customers and tickets, replies and internal notes, assignment and status, search, filters, and a small admin area.
> Out, for now: email notifications, file attachments, service level timers, live chat, translations, and AI replies. Each of those is a fine feature. None of them is needed to prove the app works.
> Deciding what's out is as important as deciding what's in. It's the line you point to when a session drifts. If Claude starts adding email notifications, the file already says no.
> It also keeps the capstone finishable. Six build episodes is a fixed budget. A version one that does fewer things completely beats one that does everything halfway, and it's far easier to test.

### 7:05–19:00 · Part 2: The requirements
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · The requirements"*
> Part two. The requirements.

*Cue: two columns "Requirements or specs?"*
> First, how this file relates to the specs from module ten. They're different things, and we'll use both.
> The requirements file is about the whole product. It's short, it fits on one page, and it answers what the app must do and what it must not do. It changes rarely.
> Specs are about one feature at a time. In OpenSpec, a change has a proposal, tasks, and spec deltas with scenarios, and when it's archived, those land in the openspec specs folder.
> So the requirements file is the map, and each spec is a street. When we build a feature, its spec should trace back to a line in this file.
> How did I write it? I started from the ticket's life you just saw. For every step, I asked three questions. Who is allowed to do this? What does the app store when they do? And what happens at the edges, like a reply on a closed ticket? Each answer became a line. Anything I couldn't answer yet went on a list of open questions, and we'll look at a few of those in part three.

*Cue: monitor "requirements.md, the top"*
> Here's the top of the file. It lives at docs slash requirements dot m d in the repository, so Claude and every teammate read the same thing.
> It opens with the goal, in two lines: one place where a small company answers customer questions. Customers open tickets; agents reply, assign and resolve them.
> Then the stack, in one line. Then the roles. Then what a ticket is.
> Notice how short each section is. A requirements file isn't a novel. Every line should be something you can check later.
> And because it's a file in the repository, it changes the same way code does. If we change a requirement later, that change goes through a pull request and gets reviewed, so the history shows when and why the product changed.

*Cue: squares "Three roles"*
> Three roles.
> A customer opens tickets and sees only their own.
> An agent works on every ticket.
> An admin is an agent who can also manage categories and roles.
> Two sentences under the roles answer questions people forget to ask. New sign-ups are customers, so nobody can make themselves an agent by registering. And the first admin comes from a seeder, because someone has to be able to promote the first agent.
> That second rule looks tiny. Without it, you'd ship an app where nobody can ever become an admin.
> One more consequence. Because an admin is also an agent, admins appear in the inbox and can be assigned tickets. The roles are layered: everything an agent can do, an admin can do too.

*Cue: phone "The ticket"*
> Now the ticket itself. Seven fields: subject, description, category, status, priority, the customer who opened it, and the assignee.
> The requirements say what a ticket holds. They don't say how it's stored. Column names, types, and foreign keys are decisions for the data modeling episodes, where the database conventions skill helps us make them.
> Keep that split in mind. Requirements describe behaviour and facts. The design comes later, and it has to satisfy them.
> One field has a twist. The assignee can be empty. R nine says agents can unassign a ticket, and a brand new ticket has nobody yet. The customer, on the other hand, is always set. Small facts like these decide whether a column may be empty, so it's good to spot them now.

*Cue: plan "Status and priority"*
> Each ticket has one status and one priority.
> Four statuses. Open: an agent needs to act. Pending: we're waiting on the customer. Resolved: the agent believes it's fixed. Closed: it's finished for good.
> Four priorities: low, normal, high, and urgent.
> And the file sets the defaults, because tests need them: a new ticket is open, with normal priority. Whenever you see a list of states, ask what the first state is. If the file doesn't say, Claude will guess.
> Notice too that priority has no rules attached. Any agent can set any priority at any time. Status is where the rules live, and we'll read that rule two slides from now.

*Cue: 4num "The twelve R lines"*
> Then the heart of the file: twelve functional requirements, numbered R one to R twelve. They fall into four groups.
> R one to R three are the customer's side. Register, sign in, and reset a password. Open a ticket with a subject, a description and a category. And see only your own tickets, never internal notes.
> R four to R six are the inbox. Agents see every ticket, newest first, twenty-five per page. They filter by status, priority, category and assignee. And they search by words in the subject or the replies.
> R seven to R ten are working a ticket. Public replies from both sides. Internal notes that customers never see. Assigning to any agent, or unassigning. And changing status and priority, with the reopen rule.
> R eleven and R twelve are records and admin. Every status, priority and assignee change is logged with who and when, and shown on the ticket. And admins manage categories and user roles.
> Numbering matters more than it looks. When a test, a spec, or a pull request says R ten, everyone knows exactly which promise it's about.

*Cue: card "R ten, the status rule"*
> Let's read R ten closely, because it's the trickiest line.
> It says a customer reply on a pending or resolved ticket sets it to open. And closed tickets take no replies.
> So take the four statuses one at a time. A customer replies on an open ticket: it stays open. On a pending ticket: it becomes open, because we were waiting on them and now it's our turn. On a resolved ticket: it becomes open, because the fix may not have worked. On a closed ticket: the reply is refused.
> Four starting statuses, three outcomes. And notice what the rule doesn't say. An agent's reply doesn't change the status by itself. If an agent wants to wait on the customer, they set pending on purpose. And an agent's reply on a closed ticket is refused too, because closed tickets take no replies.
> Each of those cases becomes a test later. That's the point of writing the rule this precisely.
> Count them: four customer reply cases, plus two agent reply cases. That's at least six tests for one line of requirements. When a line produces that many tests, it's a sign the line is doing real work.

*Cue: two-points "Quality requirements"*
> The file also has five quality requirements. These aren't features. They're how every feature must be built.
> Q one, security: every ticket action is checked by a Laravel policy. The Laravel docs describe policies as classes that organize authorization logic around a model. And the file points to our Laravel security skill.
> Q two, data: schema changes only through migrations, with foreign keys, following the database conventions skill.
> Q three, tests: every R has at least one feature test, and CI runs the tests on every pull request.
> Q four, the interface: every page works at phone width, checked in a browser with Playwright M C P.
> And Q five, speed: the inbox loads without N plus one queries.
> See how each one names its check. A policy, a migration, a test, a browser check, a query count. None of them says "make it secure" or "make it fast".
> Two notes from the Laravel docs. On tests, they say feature tests can cover a larger part of your code, even a full HTTP request, and that most of your tests should generally be feature tests. That's why Q three asks for feature tests.
> And on speed, the docs say eager loading alleviates the N plus one query problem, and Laravel can be told to prevent lazy loading of relationships with a method called prevent lazy loading. That gives Q five a check that fails loudly in development.

*Cue: phone "Make each line testable"*
> That's the skill to practise in this part: turning a wish into something testable.
> "The inbox should be fast" is a wish. You can't fail it. "The inbox shows twenty-five tickets per page, without N plus one queries" can fail, so it can pass.
> "Customers have privacy" is a wish. "A customer sees only their own tickets, and never internal notes" is a test you can write today.
> When you write your own requirements, read each line and ask one question: how would I prove this is broken? If you can't answer, rewrite the line.
> This matters even more with an agent. Claude is good at making a test pass. If the requirement is vague, the test can be vague too, and a vague test passes for the wrong reasons. A sharp line gives the agent a sharp target, and gives you a way to check its work.

*Cue: panel "Out of scope"*
> Next, the out of scope list, written down in the file: email notifications, file attachments, service level timers, live chat, translations, and AI replies. Six items.
> Writing them down does two jobs. It stops scope creep in you, and it stops scope creep in Claude. An agent that sees "out of scope: email notifications" won't helpfully add a mail class while building replies.
> And it keeps the door open. Version two can pick any of these up later, with its own requirements and specs.
> One small test of a good out of scope list: every item should be something a reasonable person might expect. Nobody expects a support desk to have a game in it, so that doesn't need listing. But email notifications? Almost everyone expects them. That's exactly why they're written down.

*Cue: flow "Done means"*
> The file ends with what done means. A requirement is done when three things are true.
> Its spec is archived into the openspec specs folder. Its tests pass in CI. And its pull request is reviewed and merged.
> Not "the code is written". Not "it worked on my machine". Spec, green checks, reviewed merge.
> The archived spec matters for later. As we saw in module ten, the specs folder describes how the app behaves right now. So when episode thirty-four changes something built in episode thirty-three, Claude reads the current behaviour from the specs, not from memory.
> That's the full file. It's about two thousand four hundred characters, and every line is something we'll build, test, or point to.

### 19:00–28:50 · Part 3: How we'll build it
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · How we'll build it"*
> Part three. How we'll build it.

*Cue: squares "The plan side"*
> The capstone uses nine topics from this course. Let's place each one, starting with the three that shape the work before code.
> Memory. A CLAUDE dot m d at the repository root, from module five, tells every session the stack, the commands, and the rules, and points to docs slash requirements dot m d.
> Planning. Plan mode and the core loop from module four, plus the grill me skill from module seven, so questions get asked before code gets written.
> And specs. OpenSpec from module ten turns each group of requirements into a change with a proposal, tasks, and scenarios that we review before Claude implements it.
> These three connect. CLAUDE dot m d points to the requirements. Planning turns a requirement into questions and decisions. And the spec writes those decisions down in a form Claude can implement and we can verify.

*Cue: 4num "Four guards"*
> Then four that guard the work while it happens.
> Skills. The React, Laravel security, database conventions, and new migration skills from module seven, each one loaded when its kind of work comes up.
> Here's how they meet the requirements. The inbox filters in R five take input from the browser, and our Laravel security skill says never let user input choose a column name; map it against an allow list. The same skill says being logged in is not authorization, which is R three and Q one in one sentence. Requirements say what; skills say how to do it safely.
> Hooks. Our three from module eight: one blocks edits to protected files like dot env and the lock files, one formats edited PHP and JavaScript files with Pint or Prettier, and one runs the test suite before Claude finishes.
> M C P. The Playwright server from module nine, so Claude can open the app in a browser and check pages at phone width, for Q four.
> And review. The code reviewer subagent from module six checks a change against its spec before we commit.
> The last two, GitHub and worktrees, are about how work ships, and we'll get to them in a moment.

*Cue: monitor "Check the requirements first"*
> Before any setup, there's one cheap step that catches the most expensive mistakes: let Claude question the requirements.
> Start Claude in plan mode with claude dash dash permission mode plan. The docs say plan mode blocks edits until you approve a plan, so nothing changes while you talk.
> Then a short prompt, written for the course: read docs slash requirements dot m d. Ask me about anything vague, missing, or contradictory, one question at a time. Write no code. When we finish, list the edits to make to the file.
> The answers aren't shown here, because this isn't a recording. But typical questions are exactly the ones we just answered: who creates the first admin, what happens to a reply on a closed ticket, can a customer pick an archived category. If Claude finds a gap, fix the file before the code exists.

*Cue: squares "Gaps still open"*
> And there are gaps. Here are three questions this file doesn't answer yet.
> Search. R six says agents search by words in the subject or the replies. Does that include internal notes? Agents can see notes, so maybe. But the line doesn't say.
> Roles. R twelve says admins set user roles. Can an admin remove their own admin role, if they're the last admin? If yes, we're back to an app with no admin.
> Tickets. Can a customer change a ticket's category after opening it? R two covers opening, and nothing covers editing.
> None of these is a disaster. But each one is a decision, and if we don't make it, a session will make it silently. We'll settle each one before the feature that needs it, and update the file through a pull request when we do.

*Cue: plan "The road to Episode 34"*
> Here's the road ahead, six build episodes.
> Episode twenty-nine, next in the playlist, is project setup. A new Laravel app with the React starter kit, switched to PostgreSQL, with CLAUDE dot m d, the skills, the hooks, OpenSpec, and a GitHub repository with tests running on every pull request.
> Episodes thirty, thirty-one and thirty-two are data modeling, in three parts. That's where the roles, tickets, replies, notes, categories, and the change log become migrations and models, plus the indexes the inbox and search need.
> Episodes thirty-three and thirty-four are core features, in two parts. And episode thirty-five closes the course with field notes.
> Notice the order. Setup before data, and data before features. Every feature reads or writes tickets, so the tables come first. And the data modeling episodes are where most of the hard decisions live, which is why the plan gives them three parts.

*Cue: two columns "Core features, two halves"*
> The twelve requirements are split across the build like this.
> R one mostly comes with the starter kit's authentication, so we check it during setup in episode twenty-nine.
> Episode thirty-three takes five: opening a ticket, the customer's own list, the inbox, the filters, and public replies. That's R two, three, four, five and seven. After it, the app is usable end to end.
> Episode thirty-four takes the other six: search, internal notes, assignment, the status rules, the change log, and the admin area. R six, eight, nine, ten, eleven and twelve.
> One, plus five, plus six. All twelve, each one exactly once.
> The order inside the split follows dependencies too. You can't add an internal note to a ticket that can't be opened, and you can't filter an inbox that doesn't exist. So the first half builds the path a ticket takes, and the second half builds the tools agents use on it.

*Cue: flow "One requirement, one pull request"*
> Every feature follows the same path, and it runs through GitHub, from module eleven.
> An issue names the requirements it covers. We propose an OpenSpec change and review it. Claude applies it, with the skills and hooks doing their part. We open a pull request, where CI runs the tests and Claude can review it. And after the merge, we archive the change so the spec lands in the specs folder.
> That's exactly the "done means" line from the file, turned into a routine.
> The requirement numbers tie it together. The issue says R seven. The spec's scenarios cover R seven. The tests are named for it. And the pull request links the issue. Months later, anyone can follow one promise from the file to the code that keeps it.

*Cue: card "Parallel, safely"*
> And worktrees, from module twelve. In episode thirty-four, some features can run side by side, each in its own worktree with its own branch.
> Search and the admin area, for example, touch different pages and different controllers. They can be built at the same time and reviewed one by one.
> But schema changes are different. Two parallel sessions that both add migrations to the same tables can each pass their own tests and still clash when merged. So our rule: migrations land one at a time, on the main line, and parallel work builds on top of them.
> Parallel where the files are separate. One at a time where they're shared.
> That rule comes straight from the last episode: a clean merge only means the edits didn't overlap. It doesn't prove the result works. Keeping shared files on one track avoids most of those surprises.

*Cue: two-points "Your turn"*
> Before the next episode, two small jobs for you.
> One: read the requirements file in the description, slowly, and write down every question it doesn't answer, beyond the three gaps we just saw. There are always more. Compare them with the plan mode questions when you try that prompt.
> Two: pick one line, and write how you'd prove it's broken. R three and R ten are good ones to start with.
> If you'd rather build your own app instead of the Support Desk, that works too. Keep the same shape: goal, roles, numbered requirements, quality requirements, out of scope, and done means.

*Cue: panel "What to have ready"*
> And here's what to have ready for setup. The Laravel docs ask for PHP, Composer, and the Laravel installer, plus Node and npm, or Bun, to build the front end. For Laravel thirteen, PHP must be eight point three or newer.
> You'll also want PostgreSQL running on your machine, and git, a GitHub account, and Claude Code, which you already have from this course.
> If something's missing, install it before episode twenty-nine. Setup goes much faster when the tools are already there and the requirements are already settled.

### 28:50–30:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> Requirements first. Code second. Every line something you can test.

*Cue: recap slide*
> Quick recap.
> We're building a Support Desk with Laravel, the React starter kit, and PostgreSQL. Three roles, one ticket with four statuses and four priorities.
> The requirements file holds twelve numbered requirements, five quality requirements, an out of scope list, and a definition of done.
> R ten's reopen rule turns into six test cases.
> Each tool from the course has a job, and the twelve requirements are split across the build, each exactly once.

*Cue: closer slide "Next in the playlist"*
> Next in the playlist: episode twenty-nine, capstone, project setup. We create the app, connect PostgreSQL, and set up CLAUDE dot m d, the skills, the hooks, OpenSpec, and GitHub, so the first feature lands on solid ground. See you there.

---

## Example files (written for the course)

Both are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are.

### `docs/requirements.md`

```markdown
# Support Desk: requirements, v1
Written for the Agentic Engineering course capstone.

## Goal
One place where a small company answers customer questions.
Customers open tickets. Agents reply, assign and resolve them.

## Stack
Laravel 13 with the React starter kit, and PostgreSQL.

## Roles
- Customer: opens tickets, sees only their own.
- Agent: works on every ticket.
- Admin: an agent who also manages categories and roles.
New sign-ups are customers. The first admin comes from a seeder.

## Tickets
- Fields: subject, description, category, status, priority, customer, assignee.
- Status: open, pending, resolved or closed. New tickets are open.
- Priority: low, normal, high or urgent. New tickets are normal.

## Functional requirements
R1 Customers register, sign in and reset their password.
R2 A customer opens a ticket with a subject, a description and a category.
R3 A customer sees only their own tickets, and never internal notes.
R4 Agents see an inbox of all tickets, newest first, 25 per page.
R5 Agents filter the inbox by status, priority, category and assignee.
R6 Agents search tickets by words in the subject or the replies.
R7 Customers and agents add public replies to a ticket.
R8 Agents add internal notes that customers never see.
R9 Agents assign a ticket to any agent, or unassign it.
R10 Agents change status and priority. A customer reply on a pending or resolved ticket sets it to open. Closed tickets take no replies.
R11 Every status, priority and assignee change is logged with who and when, and shown on the ticket.
R12 Admins create, rename and archive categories, and set user roles. Archived categories cannot be picked for new tickets.

## Quality requirements
Q1 Security: every ticket action is checked by a policy. Follow the laravel-security skill.
Q2 Data: schema changes only through migrations, with foreign keys. Follow the database-conventions skill.
Q3 Tests: every R has at least one feature test. CI runs the tests on every pull request.
Q4 UI: every page works at phone width, checked in a browser with Playwright MCP.
Q5 Speed: the inbox loads without N + 1 queries.

## Out of scope for v1
Email notifications, file attachments, SLA timers, live chat, translations, AI replies.

## Done means
A requirement is done when its spec is archived into openspec/specs, its tests pass in CI, and its pull request is reviewed and merged.
```

### Kick-off prompt (in plan mode)

```text
claude --permission-mode plan

Read docs/requirements.md. Ask me about anything vague, missing or contradictory, one question at a time. Write no code. When we finish, list the edits to make to the file.
```

---

## Production notes
- Spoken word count: about 4,180 words, roughly 28.8 minutes at a steady TTS pace, plus slide pauses (plan target about 30).
- Illustrated walkthrough, not a recording. No Claude, Laravel, git, CI or test output is shown. The plan-mode questions are described as typical questions, not as Claude's answers.
- The agenda says three parts and the script has three parts (three dividers). The plan lists two Module 13 lessons (Project Introduction, Project Requirements); Part 3 maps the course's tools onto the remaining capstone episodes so they are set up consistently.
- Spoken episode numbers: "episode twenty-eight" (this one), "module thirteen", and the roadmap "twenty-nine" (setup), "thirty, thirty-one, thirty-two" (data modeling 1 to 3), "thirty-three, thirty-four" (core features 1 and 2), "thirty-five" (finale), matching youtube-plan.md.
- Consistency with later episodes: Ep29 setup (new app, React starter kit, PostgreSQL, CLAUDE.md, skills, hooks, OpenSpec, GitHub with CI); Ep30 to Ep32 data modeling (roles, tickets, replies, notes, categories, change log, indexes for inbox and search); Ep33 R2, R3, R4, R5, R7; Ep34 R6, R8, R9, R10, R11, R12; R1 checked in Ep29.
- Laravel facts (laravel.com/docs/13.x, fetched 10 Oct 2026): Laravel 13.x requires PHP 8.3 minimum (release notes); React starter kit "built with Inertia 3, React 19, Tailwind 4, and shadcn/ui"; Inertia lets you build React pages with server-side routing and controllers; "The starter kits use Laravel Fortify to provide authentication"; a new app's .env uses SQLite by default; prerequisites PHP, Composer, the Laravel installer, plus Node and NPM or Bun; policies "organize authorization logic around a particular model or resource"; PostgreSQL is a first-party database; whereFullText works on PostgreSQL (an option for R6 in Ep32, not promised here).
- Claude Code facts (code.claude.com/docs/en/permission-modes): `claude --permission-mode plan`; plan mode blocks edits until you approve a plan.
- Course assets referenced (from earlier scripts): react-best-practices (Ep17), laravel-security (Ep18), database-conventions and new-migration (Ep19), grill-me (Ep16), code-reviewer subagent (Ep13), hooks protect-files, format (Pint, Prettier) and stop-tests (Ep20), Playwright MCP (Ep22), OpenSpec propose, apply, archive (Ep23 to Ep25), GitHub Actions and review (Ep26), worktrees (Ep27).
- Logic checks: 12 R lines and 5 Q lines counted in the file; groups R1 to R3 (3), R4 to R6 (3), R7 to R10 (4), R11 and R12 (2): 3 + 3 + 4 + 2 = 12. Status rule over 4 starting statuses: open stays open, pending and resolved become open, closed refuses, so 3 outcomes; an agent reply doesn't change status, and on a closed ticket it is refused, so 4 + 2 = 6 cases. Build split 1 + 5 + 6 = 12, no requirement twice. The parallel-work claim is limited to features touching different files; migrations are kept sequential because parallel migrations on the same tables can each pass alone and still conflict after merge. The "done means" line has 3 conditions. The 3 open gaps are real omissions in the file (R6 says subject or replies, silent on notes; R12 doesn't protect the last admin; no requirement covers editing a ticket), presented as decisions to make, not as defects hidden from viewers. Laravel testing docs: feature tests can cover a full HTTP request and most tests should generally be feature tests; Eloquent docs: eager loading alleviates N + 1, preventLazyLoading prevents lazy loading. laravel-security skill (Ep18) lines quoted: column names from user input mapped against an allow list; being logged in is not authorization.
- YouTube description: the ready-to-paste description below includes the requirements file and the prompt in full, is 3,592 characters, under the 5,000 limit, and contains no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Capstone Project: Writing Requirements Before Code with Claude Code | Agentic Engineering Ep 28
2. Plan a Real Laravel + React App with AI: The Support Desk Requirements | Ep 28
3. Capstone, the Project and Requirements | Agentic Engineering Ep 28

### Description (ready to paste, 3,592 characters)

```
Episode 28 of Agentic Engineering, a free course on building real software with AI coding agents. This starts the capstone.
We define the project we build for the rest of the course: a Support Desk where customers open tickets and agents reply, assign and resolve them. Then we write its requirements, line by line, and map every tool from the course onto the build: CLAUDE.md, planning, skills, hooks, MCP, specs, GitHub and worktrees.
Stack: Laravel 13 with the React starter kit, and PostgreSQL. No code in this episode, on purpose.
Screens are drawn illustrations; no Claude output is shown. The file and prompt below are written for the course.
docs/requirements.md:
# Support Desk: requirements, v1
Written for the Agentic Engineering course capstone.

## Goal
One place where a small company answers customer questions.
Customers open tickets. Agents reply, assign and resolve them.

## Stack
Laravel 13 with the React starter kit, and PostgreSQL.

## Roles
- Customer: opens tickets, sees only their own.
- Agent: works on every ticket.
- Admin: an agent who also manages categories and roles.
New sign-ups are customers. The first admin comes from a seeder.

## Tickets
- Fields: subject, description, category, status, priority, customer, assignee.
- Status: open, pending, resolved or closed. New tickets are open.
- Priority: low, normal, high or urgent. New tickets are normal.

## Functional requirements
R1 Customers register, sign in and reset their password.
R2 A customer opens a ticket with a subject, a description and a category.
R3 A customer sees only their own tickets, and never internal notes.
R4 Agents see an inbox of all tickets, newest first, 25 per page.
R5 Agents filter the inbox by status, priority, category and assignee.
R6 Agents search tickets by words in the subject or the replies.
R7 Customers and agents add public replies to a ticket.
R8 Agents add internal notes that customers never see.
R9 Agents assign a ticket to any agent, or unassign it.
R10 Agents change status and priority. A customer reply on a pending or resolved ticket sets it to open. Closed tickets take no replies.
R11 Every status, priority and assignee change is logged with who and when, and shown on the ticket.
R12 Admins create, rename and archive categories, and set user roles. Archived categories cannot be picked for new tickets.

## Quality requirements
Q1 Security: every ticket action is checked by a policy. Follow the laravel-security skill.
Q2 Data: schema changes only through migrations, with foreign keys. Follow the database-conventions skill.
Q3 Tests: every R has at least one feature test. CI runs the tests on every pull request.
Q4 UI: every page works at phone width, checked in a browser with Playwright MCP.
Q5 Speed: the inbox loads without N + 1 queries.

## Out of scope for v1
Email notifications, file attachments, SLA timers, live chat, translations, AI replies.

## Done means
A requirement is done when its spec is archived into openspec/specs, its tests pass in CI, and its pull request is reviewed and merged.
Kick-off prompt, in plan mode (claude --permission-mode plan):
Read docs/requirements.md. Ask me about anything vague, missing or contradictory, one question at a time. Write no code. When we finish, list the edits to make to the file.
Build plan: Ep 29 setup (R1 from the starter kit). Ep 30 to 32 data modeling. Ep 33: R2, R3, R4, R5, R7. Ep 34: R6, R8, R9, R10, R11, R12.
Laravel docs: laravel.com/docs/13.x
Claude Code plan mode: code.claude.com/docs/en/permission-modes
Next in the playlist: Episode 29, Capstone, Project Setup.
```

### Tags
Claude Code, capstone project, software requirements, Laravel 13, React starter kit, PostgreSQL, OpenSpec, agentic engineering, AI coding agents, help desk app

### Thumbnail text idea
"REQUIREMENTS FIRST" in coral, over a drawn ticket card with a status tag.

---

## Suggested slide list (Episode 28 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 28 · Capstone, the Project and Requirements |
| 2 | Agenda | Three parts: The project · The requirements · How we'll build it |
| 3 | 01 · The project | Divider |
| 4 | From cart to capstone | Small examples vs one whole app |
| 5 | The pitch | Support Desk in four lines (Illustration) |
| 6 | A ticket's life | Opened · Assigned · Replies · Resolved · Closed |
| 7 | The stack | Laravel 13 · React kit · PostgreSQL |
| 8 | Why this project | Roles · Data · Rules · Interface |
| 9 | How big is version one? | In vs out (Illustration) |
| 10 | 02 · The requirements | Divider |
| 11 | Requirements or specs? | Whole product vs one feature |
| 12 | requirements.md, the top | Goal · Stack · Roles · Tickets (Illustration) |
| 13 | Three roles | Customer · Agent · Admin |
| 14 | The ticket | 7 fields (Illustration) |
| 15 | Status and priority | 4 and 4, defaults (Illustration) |
| 16 | The twelve R lines | 4 groups |
| 17 | R10, the status rule | 4 statuses, 3 outcomes (Illustration) |
| 18 | Quality requirements | Q1 to Q5 (Illustration) |
| 19 | Make each line testable | Wish vs testable (Illustration) |
| 20 | Out of scope | 6 items |
| 21 | Done means | Spec · Tests · CI · Review · Merge |
| 22 | 03 · How we'll build it | Divider |
| 23 | The plan side | Memory · Planning · Specs |
| 24 | Four guards | Skills · Hooks · MCP · Review |
| 25 | Check the requirements first | Plan-mode prompt (Illustration) |
| 26 | Gaps still open | Search · Roles · Tickets |
| 27 | The road to Episode 34 | Episodes 29 to 34 (Illustration) |
| 28 | Core features, two halves | Ep33: 5 · Ep34: 6 |
| 29 | One requirement, one PR | Issue · Propose · Apply · PR · Archive |
| 30 | Parallel, safely | Parallel vs one at a time (Illustration) |
| 31 | Your turn | Two jobs (Illustration) |
| 32 | What to have ready | PHP 8.3+ · Node · PostgreSQL |
| 33 | Quote | Requirements first |
| 34 | Recap | |
| 35 | Next | Episode 29 · Capstone, Project Setup |

---

## Sources
- Laravel: https://laravel.com/docs/13.x/releases, /installation, /starter-kits, /authorization, /database, /queries, /testing, /eloquent-relationships
- Claude Code: https://code.claude.com/docs/en/permission-modes
- Course: youtube-plan.md (capstone episodes 28 to 35); Episodes 13, 16 to 20, 22 to 27 for the skills, hooks, subagent, MCP, OpenSpec, GitHub and worktree material.
