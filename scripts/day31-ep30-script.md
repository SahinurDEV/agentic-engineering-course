# Day 31 · Episode 30: Capstone, Data Modeling Part 1

**Series:** Agentic Engineering (free YouTube course) · Module 13
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 30:00 to 32:00
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 13 lesson):** Data Modeling 1 (roles, categories and tickets: plan, migrations, models, tests)

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Claude, OpenSpec, Laravel, git or test output is shown. The OpenSpec change (proposal, two delta specs, design, tasks), the prompts, the migrations, enums, models, factories, seeder and tests are **written for the course**; the plan files are the reviewed versions, not something Claude produced on camera. All of it was built and run once in a throwaway copy of the Episode 29 project on PostgreSQL 17 on 10 October 2026 (migrate --pretend, migrate, rollback and migrate again, the full test suite, Pint, PHPStan, the kit's format and lint checks, openspec validate --strict and archive); none of that output appears in the video.

**Split of the three data-modeling episodes (from youtube-plan.md: Data Modeling 1, then Data Modeling 2 in two halves):** Ep30 = roles, categories, tickets (the core). Ep31 = public replies (R7) and internal notes (R8). Ep32 = the change log (R11) and the indexes for the inbox, filters and search (R4, R5, R6, Q5).

**Counts drawn on slides (checked against the files and the throwaway project):** tables touched: 3 (users gets a role column; categories and tickets are new). Ticket fields: 7. Statuses: 4. Priorities: 4. Roles: 3. Explore questions: 4. Foreign keys on tickets: 3 (cascade, set null, restrict). Migrations: 3. Enums: 3. Capabilities: 2 (user-roles with 3 requirements and 4 scenarios; tickets with 4 requirements and 5 scenarios): 7 requirements, 9 scenarios; archive reported 7 added. Task groups: 4. Tests: RolesTest 4, TicketDataTest 6, AdminSeederTest 2 = 12 new; the kit had 40; the suite has 52, all passing on PostgreSQL. Tickets SQL: 2 check constraints, 3 foreign keys, 2 defaults.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook |
| 0:30–1:30 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:30–12:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 1 · Plan the model |
| 12:00–21:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Migrations, reviewed first |
| 21:00–31:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Models and tests |
| 31:00–32:00 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode, the Support Desk got its foundation: a Laravel app on PostgreSQL, the whole Claude Code layer, and one clean first commit. But it can't hold a single ticket yet.
> Today it gets its first real data: roles, categories, and tickets. And we do it the careful way. Decisions first, then a reviewed spec, then migrations I read before they run.

**Visual / B-roll:**
- Title card.

### 0:30–1:30 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode thirty: capstone, data modeling part one.

*Cue: agenda slide "Three parts"*
> Three parts. First, plan the model: explore the open questions with Claude, decide, and turn the decisions into an OpenSpec change. Second, migrations, reviewed first: three migrations, with the SQL read before anything runs. Third, models and tests: Claude applies the rest of the change, we check it against the spec, and it goes up as a pull request.
> As always, this is an illustrated walkthrough, not a recording. I built and ran all of it once in a throwaway copy of the project, on PostgreSQL, and every test passed there. No output is shown. The plan files and prompts are in the description, and the code is summarised there.

**Visual / B-roll:**
- Three items: 01 Plan the model · 02 Migrations, reviewed first · 03 Models and tests.

### 1:30–12:00 · Part 1: Plan the model
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "01 · Plan the model"*
> Part one. Plan the model.

*Cue: plan "Three parts of data modeling"*
> First, where this episode fits. Data modeling gets three episodes, and each one takes a clean slice.
> Today is the core: a role on every user, categories, and tickets, with their seven fields, four statuses and four priorities. Episode thirty-one is the conversation on a ticket: public replies for R seven, and internal notes for R eight. Episode thirty-two is the change log for R eleven, plus the indexes the inbox, the filters and search will need.
> Slicing it this way means every episode ends in a good state: migrations that run, models that work, and green tests. Nothing is left half built between episodes.
> Why this order? Replies and notes hang off tickets, and the change log records changes to tickets. So tickets must exist first. And indexes come last, because you can only choose good indexes once you know the queries, and the queries come with the inbox and search.

*Cue: squares "Today's three tables"*
> Today's slice touches three tables.
> The users table gets a role column, because the requirements have three roles: customer, agent, and admin. A new categories table, because R two says every ticket has a category, and R twelve says admins rename and archive them. And a new tickets table, holding the seven fields from the requirements: subject, description, category, status, priority, customer, and assignee.
> Remember episode twenty-eight: the requirements say what a ticket holds, not how it's stored. Column types, defaults, and foreign keys are today's decisions.
> Notice what's not on the list: a separate roles table. Three fixed roles, one per user, with no permissions to configure, fit in a single column. If the product ever needs custom roles, that's a new change with its own spec. Version one doesn't, so we don't build it.

*Cue: monitor "Explore first"*
> Some of those decisions aren't obvious, so I don't start with propose. I start with slash O P S X explore. As we saw in module ten, explore is for thinking, not implementing: Claude reads the code and talks it through with me, but it doesn't write code.
> My prompt names the scope, roles, categories and tickets from docs slash requirements dot m d. It asks Claude to read the users migration and the User model first, so the questions are about this codebase. And it asks for one question at a time, about three areas: how to store status, priority and role, what happens on delete, and how the first admin is created.
> The prompt is written for the course and printed in the description. What follows are the questions that matter, and the answers I settled on.
> One habit for explore sessions: answer in plain words, and give the reason, not just the choice. Those reasons are what end up in the design file, and they're what a teammate, or Claude in a fresh session, will need later when someone asks why it was done this way.

*Cue: 4num "Four choices"*
> Four choices to make, as four questions.
> One: how do we store status, priority, and role? Two: should the migrations take their values from the app's enum classes? Three: what happens to tickets when a user or a category is deleted? Four: how do we create the first admin, without a password in the repository?
> None of these is answered by the requirements. All of them are hard to change once real data exists. That's exactly what explore is for: settle them while changing your mind is still free.

*Cue: two columns "Enum column or plain string?"*
> Question one. There are two reasonable options. A plain string column, with the allowed values checked only in PHP. Or Laravel's enum column type. The Laravel docs say the enum method creates an enum equivalent column with the given valid values. On PostgreSQL, when I checked the SQL in my throwaway project, that became a string column, a var-char, with a check constraint that lists the values.
> I chose the enum column. Then the database itself refuses a status like reopened, even if some code path, or a manual query, skips the model. On top of that, PHP backed enums give the code real types: TicketStatus open, not a loose string. The docs call that enum casting.
> The trade-off: adding a fifth status later needs a migration. That's fine here, because R ten fixes the four statuses, and a new status would be a real product change anyway.
> A third option sometimes comes up: PostgreSQL's own enum types, created with create type. Laravel's enum method doesn't use those; on PostgreSQL it uses the check constraint you just heard about, and that keeps the migration in plain Laravel. One less special case to remember.

*Cue: phone "Role is not fillable"*
> Question one had a security side for role. The Laravel docs explain mass assignment with almost exactly our case: a malicious user sends an is admin field in a request, it goes straight into create, and they make themselves an administrator.
> The kit's registration action calls create with a name, an email and a password. If role were fillable, a crafted sign-up form could add role equals admin. So role stays out of the fillable list. New users get the customer default, from the database and from the model, and the only way to change a role is to set it on purpose in code.
> That decision turns into a spec scenario, and later a test: a sign-up that sends role admin still ends up a customer.

*Cue: card "On delete: three answers"*
> Question three: deletes. Tickets have three foreign keys, and each gets a different answer.
> The customer. The starter kit already lets users delete their own account from the settings page. If a customer does, their tickets go with them, so the customer key cascades.
> The assignee. If an agent's account is deleted, their tickets shouldn't vanish. They become unassigned, so that key is set to null.
> The category. Categories are never deleted while tickets use them; R twelve says admins archive them instead. So that key is restricted, and the database refuses the delete.
> Each answer is one method in the Laravel docs: cascade on delete, null on delete, and restrict on delete. Questions two and four come back in parts two and three.
> Why decide this now and not later? Because a foreign key without a decision still has a behaviour. Without an on delete rule, PostgreSQL refuses to delete the referenced row while tickets point at it. That would quietly break the kit's delete account feature for any customer who ever opened a ticket. Choosing on purpose avoids that surprise.

*Cue: monitor "Propose"*
> With the decisions made, a branch first: git switch dash c, add core data model. Every capstone change gets its own branch and its own pull request.
> Then slash O P S X propose, with the change name add core data model. The prompt says: roles, categories and tickets, as we just decided. Data layer only: migrations, enums, models, factories, the first admin seeder, and tests. No screens, no policies, no replies, no indexes.
> And one more line: in the tasks, group one is the three migrations, which I create myself with the new migration skill. You'll see why in part two.
> Propose writes the plan and stops. Nothing is built yet.

*Cue: two-points "Two capabilities"*
> Propose creates four kinds of file: a proposal, delta specs, a design, and tasks. OpenSpec's own instructions say to name capabilities after lasting behaviour, and to avoid catch-all buckets. So instead of one spec called data model, there are two: user roles, and tickets.
> User roles has three requirements: roles, new sign-ups are customers, and the first admin. Tickets has four: ticket fields, allowed values, categories, and deleted users. That's seven requirements, with nine scenarios between them.
> The versions in the description are the reviewed ones, written for the course after my edits. They're not raw output.
> While reviewing, I watch for a few things that often need fixing in a first draft. Class names or framework details in a spec belong in the design, because the spec should survive a rewrite. Vague words like properly or securely get replaced with something testable. And for each requirement, I ask what's missing, especially the refusals. Our config file asks for a scenario for each role that must be refused, and here that's the sign-up that tries to choose admin.

*Cue: flow "Review in order"*
> I review in the order from module ten.
> The proposal first. Does it name its R numbers? It covers the data side of R one, R two and R ten. Does it say what's out of scope? Yes: replies, notes, the change log and indexes wait for the next two episodes, and screens and policies wait for the features.
> Then the specs. Is every scenario something a test can prove? Then the design. Are the decisions written down, each with the alternative I rejected? Then the tasks. Does each task say how to check it?
> Last, openspec validate, with dash dash strict, and I commit the plan before any code exists. If the build goes wrong later, the plan is safe in git.

### 12:00–21:00 · Part 2: Migrations, reviewed first
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Migrations, reviewed first"*
> Part two. Migrations, reviewed first.

*Cue: panel "Why I make the migrations"*
> Why do I create the migrations myself? Because of how we built the new migration skill in module seven. It sets disable model invocation to true, so Claude can't start it on its own. Only I can, by typing slash new migration. It also pre-approves two commands for that turn: make migration, and migrate dash dash pretend. As the docs say, that grant doesn't restrict anything else.
> The stop comes from its instructions. Write the migration, show me the SQL, and stop: don't run the migration, I run it myself after reading the SQL. That's the point. Schema changes are the hardest thing to undo, so a human reads the SQL first. Our CLAUDE dot m d says the same thing: schema changes only through migrations, with the new migration skill.

*Cue: phone "/new-migration: role"*
> First migration. I type slash new migration, add a role column to users: customer, agent or admin, default customer, and list the values literally.
> The skill reads the users migration, makes a migration called add role to users table, and writes an up method that adds the column, and a down method that drops it. Then it runs migrate dash dash pretend.
> Notice that it changes the users table with a new migration. It doesn't touch the kit's original users migration. The database conventions skill says never edit a migration that has already run anywhere except your own machine, and the kit's migrations have run on every clone of this repository, and in CI.
> The down method matters too. Drop column role is the exact reverse of adding it. If the rollback ever runs, the users table goes back to exactly how the kit made it.

*Cue: plan "Read the SQL"*
> Now I read the SQL. The Laravel docs say the pretend flag shows the statements the migrations would run, without running them.
> For the role column, I check three things. The type: a string column with a check constraint for exactly customer, agent and admin. Not null. And a default of customer.
> That default matters more than it looks. The users table already has rows, like the test user from the kit's seeder. On PostgreSQL, adding a not null column with no default to a table that has rows fails. With the default, every existing user simply becomes a customer. That's the kind of detail you only catch by reading the SQL.

*Cue: squares "Categories"*
> Second: slash new migration, create categories, with a unique name, a nullable archived at, and timestamps.
> The name is unique, because two categories both called billing would confuse every filter and every report. Archived at is a nullable timestamp: empty means active, and a date means archived, and when. That one column covers R twelve's archive, with no separate flag to keep in sync. And the usual created and updated timestamps.
> In the SQL, I look for the unique constraint on the name. It's there.
> Why not soft deletes? Laravel's soft deletes add a deleted at column, and deleted rows disappear from normal queries. But an archived category is not deleted. Old tickets still show it by name, and admins can still see and rename it. It just can't be picked for new tickets. Archived at says exactly that.

*Cue: card "Tickets table"*
> Third, the big one: tickets. The prompt lists all seven fields, with their rules.
> Subject is a string, and description is text. Category, customer and assignee are foreign keys, made with foreign id and constrained, as the Laravel docs show. Customer and assignee both point at the users table, so the migration names that table. Assignee is nullable, because a new ticket has nobody yet. Status and priority are enum columns, with defaults of open and normal, straight from the requirements.
> In the SQL, I count. Two check constraints. Three foreign keys: cascade, set null, and restrict. Two defaults. And all seven fields present.
> Two smaller choices are worth saying out loud. The subject is a string, which on PostgreSQL means up to two hundred and fifty-five characters, plenty for a subject line. And the description is text, with no practical limit, because a customer explaining a problem shouldn't hit a wall. The form validation in the features episodes will set friendly limits on top.

*Cue: two columns "Literal values, not enums"*
> Remember question two? Here's why the prompts said: list the values literally. The migration says open, pending, resolved and closed, as plain text, not the TicketStatus enum.
> The Laravel docs do show passing an enum's cases to the enum method. But a migration is a snapshot of one moment. If it imports the app's enum, and that enum changes a year from now, this old migration quietly means something different when a new developer runs every migration from scratch.
> So the rule is: migrations never import app code. The enum class belongs to the app, and the migration keeps its own copy of the values.

*Cue: monitor "Then I run it"*
> Three migrations, three SQL reviews. Now I run them myself: php artisan migrate.
> Then one more check, on my own machine only. I roll back those three steps with migrate rollback, step three, and then migrate again. That proves every down method really reverses its up. The database conventions skill asks for a down method on every migration; this is how you know they work.
> The same skill says to ask before migrate fresh, refresh, reset or wiping the database. This is different: a rollback of my own three new migrations, on my own database, before anything is shared.
> Last, I tick the three migration tasks in tasks dot m d, so the build knows group one is done.
> And if a migration had a mistake? Before it's pushed, I roll it back, fix it, and run it again. After it's pushed and has run anywhere else, I never edit it. I add a new migration that changes the table. That's the rule from the database conventions skill, and it's what keeps every copy of the database in step.

*Cue: two-points "Missing on purpose"*
> Before moving on, look at what's not in these tables, on purpose.
> No indexes beyond the keys. The PostgreSQL docs point out that a foreign key doesn't automatically create an index on the referencing column. So the inbox will need some. But our skill says add an index only where a query needs it, and those queries arrive with the inbox. That's episode thirty-two.
> And no replies or notes. They need a table of their own, with their own decisions about who can see what. That's episode thirty-one.

### 21:00–31:00 · Part 3: Models and tests
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Models and tests"*
> Part three. Models and tests.

*Cue: flow "Clear, then apply"*
> The schema is in. Now the rest of the change. First, slash clear. The OpenSpec readme suggests clearing your context before implementation, so the build starts from the plan files, not from our long planning conversation.
> Then slash O P S X apply, add core data model. Apply reads tasks dot m d, skips group one because it's ticked, and works through the rest in order: enums and models, factories, the seeder, then the tests.
> While it works, our hooks from module eight run. Pint formats every PHP file Claude edits, and the Stop hook runs the tests before Claude finishes.
> Apply also marks each task done in tasks dot m d as it finishes it. So if the session stops halfway, a fresh session can run apply again, and it picks up from the first unticked task.

*Cue: phone "Enums and casts"*
> Group two, the models. First, three small enums in app slash Enums: Role, TicketStatus, and TicketPriority. Each one is a string backed enum, with one case per value.
> The models cast their columns to them. So a ticket's status is a TicketStatus, and the code compares it with TicketStatus closed, not with a typed string that might be misspelled.
> The defaults appear twice, on purpose. The database has them, for any insert. And the models list them in their attributes property, which the docs call default attribute values. So a new ticket in memory already says open and normal, before it's ever saved.

*Cue: squares "Relationships"*
> Then the relationships, following the docs. A ticket belongs to a category, a customer, and an assignee. Customer and assignee aren't named after their model, so both point at the User model with their own column: customer id, and assignee id.
> A user has many tickets, as the customer, and has many assigned tickets, as the agent. And a category has many tickets.
> Plus two helpers on User. Is agent is true for agents and for admins, because the requirements say an admin is an agent who also manages categories and roles. Is admin is true only for admins. The policies in the feature episodes will lean on these two.
> Is agent compares the role with the enum cases, strictly. So there's no chance of a string like Agent with a capital letter sneaking through. The cast guarantees role is always one of the three enum cases.

*Cue: panel "The first admin"*
> Group three: the first admin. The requirements say it comes from a seeder. But a seeder with a hard-coded email and password would put a real admin password into git.
> So the admin seeder asks. It uses the console's ask and secret prompts, for a name, an email, and the password twice. The Laravel docs say a seeder's run method can type-hint what it needs, so it receives the kit's own create new user action, and passes the answers to it. That way the first admin gets exactly the same validation as any sign-up. Then the seeder sets the role to admin, and marks the email as verified.
> If an admin already exists, it says so and does nothing. You run it with php artisan d b seed, dash dash class equals AdminSeeder.
> And the main database seeder calls it, after the kit's test user. So a plain php artisan d b seed on a fresh machine also asks for the first admin. If you type an email that's already taken, or a password the kit's rules reject, the validation stops it, just like the sign-up form would.

*Cue: 4num "Twelve new tests"*
> Group four: tests, at least one for every scenario, in tests slash Feature slash DataModel. Three files.
> The roles test has four: a new sign-up is a customer, a sign-up can't choose its own role, agents and admins count as agents, and only admins are admins.
> The ticket data test has six: the defaults, a refused status, a refused priority, deleting an agent, deleting a customer, and deleting a category that's in use.
> The admin seeder test has two: it creates the first admin, and it does nothing when one exists.
> Four, six, and two: twelve new tests. With the kit's forty, the suite now has fifty-two. In my throwaway project, all fifty-two passed on PostgreSQL.
> The factories make these tests short. The ticket factory creates its own category and customer when you don't pass them, and the user factory has agent and admin states. So a test can say: a ticket assigned to an agent, in one line, and every row it needs exists.

*Cue: card "Tests that ask the database"*
> A few of these tests deserve a closer look, because they test the database, not just PHP.
> The refused status test skips the model on purpose. It writes reopened straight into the table with the query builder, and expects a query exception. Only the check constraint can stop that write. If someone later turns the column into a plain string, this test fails and tells them why.
> The delete tests work the same way. Deleting a customer must remove their tickets. Deleting an agent must leave the ticket unassigned. And deleting a category that's in use must throw. Together they prove the three answers from part one.
> And the seeder test answers the prompts with expects question, from the Laravel console testing docs.
> One PostgreSQL detail for tests like these. The kit's tests run inside a transaction, which Laravel rolls back after each test. When a statement fails, PostgreSQL marks the whole transaction as failed, and later queries in that same test would fail too. So in these tests, the failing statement is always the last line, and the test only expects the exception.

*Cue: plan "Review, then archive"*
> Before archiving, two checks. First, I ask the code reviewer subagent from last episode to review the change. It compares the diff with the OpenSpec change, checks that a test covers each scenario, and runs php artisan test. It reports; it never edits.
> Then slash O P S X archive. OpenSpec moves the change into the archive folder and merges its deltas into the main specs. After that, openspec slash specs holds two capabilities, user roles and tickets, with seven requirements between them. That's the record the next episodes build on.

*Cue: flow "Done means"*
> Then the definition of done from episode twenty-eight. Commit on the branch. Push it. Open a pull request with g h pr create, dash dash fill, which takes the title and body from the commits. CI runs the tests on PostgreSQL, using the service we added last episode. Then review, and merge.
> In episode twenty-eight, the plan was one requirement, one pull request, for the features. For data modeling it's one change per episode, and the same finish line: a reviewed spec, green tests, and a merged pull request.
> One more thing CI gives us here. It builds the database from every migration, from scratch, on a clean PostgreSQL. So if any migration only worked on my machine, the pull request goes red before anyone merges it.

*Cue: two-points "Your turn"*
> Your turn, before the next episode.
> One: run the explore step on your own project's main table, and write down your four answers: storage, values in migrations, deletes, and the first admin.
> Two: write one test that skips the model and writes a bad value straight into a table. If that write succeeds, your database isn't guarding that column, and now you know.

*Cue: two columns "Ready for replies"*
> Where does that leave us? Today: roles, with customer as the default and the first admin from a seeder. Categories that archive instead of disappearing. Tickets with seven fields, guarded values, and clear delete rules. Twelve new tests, and two archived specs.
> Next comes the conversation on a ticket. Public replies for R seven, internal notes for R eight, and the big question: one table or two? And how do we make sure a customer never sees a note, even by accident?

### 31:00–32:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> Decide in plain words first. Then let the database hold the line.

*Cue: recap slide*
> Quick recap.
> Explore first: four decisions before any code. Then propose, review in order, validate, and commit the plan.
> Three migrations through the new migration skill, every line of SQL read before it ran, and the rollback checked.
> Enums, models, relationships, and an admin seeder with no password in git. Twelve new tests, a review, an archived change, and a pull request.

*Cue: closer slide "Next in the playlist"*
> Next in the playlist: episode thirty-one, capstone, data modeling part two. Replies and internal notes, and keeping customers out of the notes for good. See you there.

---

## Example files (written for the course)

All files were run in the throwaway project. The plan files, prompts and commands are free of `<` and `>` and go into the description as they are. The PHP files contain `<?php`, `->` and `=>`, so the description summarises them; the full code is here. Migration file names start with the timestamp from `make:migration`; yours will differ.

### Prompts (typed into Claude Code)

```text
/opsx:explore Data model for roles, categories and tickets in docs/requirements.md. Read the users migration and the User model first. Ask me one question at a time about storing status, priority and role, deletes, and the first admin.

/opsx:propose add-core-data-model: roles, categories and tickets as decided. Data layer only: migrations, enums, models, factories, admin seeder, tests. No screens, policies, replies or indexes. Task group 1 is the three migrations; I create them with /new-migration.

/new-migration add role to users: customer, agent or admin, default customer. List values literally.

/new-migration create categories: unique name, nullable archived_at, timestamps

/new-migration create tickets: subject, description, category (restrict on delete), status open, pending, resolved or closed (default open), priority low, normal, high or urgent (default normal), customer (cascade), nullable assignee (null on delete), timestamps. List values literally.

/clear, then /opsx:apply add-core-data-model
Use the code-reviewer subagent to review this change.
/opsx:archive add-core-data-model
```

### Commands (typed in the terminal)

```text
git switch -c add-core-data-model
openspec validate add-core-data-model --strict
git add openspec && git commit -m "Plan: add-core-data-model"
php artisan migrate
php artisan migrate:rollback --step=3
php artisan migrate
php artisan test
php artisan db:seed --class=AdminSeeder
git add -A && git commit -m "Add roles, categories and tickets"
git push -u origin add-core-data-model
gh pr create --fill
```

### `openspec/changes/add-core-data-model/proposal.md`

```markdown
## Why
Every feature reads or writes tickets, so roles, categories and tickets need tables first. Covers the data side of R1 (sign-ups are customers), R2 (ticket fields) and R10 (status and priority values).

## What Changes
- Users get a role: customer, agent or admin. New sign-ups are customers.
- A seeder creates the first admin.
- New categories table, with archiving.
- New tickets table with the seven fields, four statuses and four priorities.

## Capabilities
### New Capabilities
- `user-roles`: who is a customer, an agent or an admin.
- `tickets`: what a ticket holds and its allowed values.

## Out of scope
Replies, internal notes, the change log, indexes and search (Episodes 31 and 32). Screens, policies and status rules (Episodes 33 and 34).

## Impact
Three migrations, three enums, two new models, factories, a seeder, tests.
```

### `openspec/changes/add-core-data-model/specs/user-roles/spec.md`

```markdown
## ADDED Requirements

### Requirement: Roles
Every user SHALL have one role: customer, agent or admin. An admin SHALL count as an agent.

#### Scenario: Admin
- **WHEN** a user is an admin
- **THEN** they count as an agent and as an admin

#### Scenario: Customer
- **WHEN** a user is a customer
- **THEN** they do not count as an agent

### Requirement: New sign-ups are customers
A new sign-up SHALL be a customer, whatever the request sends.

#### Scenario: Sign-up sends a role
- **WHEN** someone registers with role admin
- **THEN** the new user is a customer

### Requirement: First admin
A seeder SHALL create the first admin from details it asks for, and SHALL do nothing if an admin exists.

#### Scenario: Admin exists
- **WHEN** the seeder runs and an admin exists
- **THEN** no user is created
```

### `openspec/changes/add-core-data-model/specs/tickets/spec.md`

```markdown
## ADDED Requirements

### Requirement: Ticket fields
A ticket SHALL have a subject, description, category, status, priority and customer, and MAY have an assignee.

#### Scenario: Defaults
- **WHEN** a customer opens a ticket
- **THEN** it is open, normal priority and unassigned

### Requirement: Allowed values
The database SHALL refuse a status other than open, pending, resolved or closed, and a priority other than low, normal, high or urgent.

#### Scenario: Unknown status
- **WHEN** a ticket is saved with status reopened
- **THEN** the database refuses it

### Requirement: Categories
Category names SHALL be unique. A category in use SHALL be archived, never deleted.

#### Scenario: Delete a used category
- **WHEN** a category with tickets is deleted
- **THEN** the database refuses it

### Requirement: Deleted users
A deleted customer's tickets SHALL be deleted. A deleted assignee's tickets SHALL become unassigned.

#### Scenario: Agent deleted
- **WHEN** an assigned agent is deleted
- **THEN** their tickets have no assignee

#### Scenario: Customer deleted
- **WHEN** a customer deletes their account
- **THEN** their tickets are deleted
```

### `openspec/changes/add-core-data-model/design.md`

```markdown
## Decisions
- Status, priority and role are enum columns, so PostgreSQL checks the values, plus PHP backed enums cast on the models. Alternative: plain strings, checked only in PHP.
- Migrations list the values literally and never import app enums, so an old migration means the same thing forever.
- Role is not fillable, so a request can never set it. Defaults live in the database and in the model.
- Foreign keys: customer cascades (the kit lets users delete their account), assignee becomes null, category restricts (categories are archived).
- The first admin comes from an interactive seeder that reuses the kit's sign-up validation. No password in the repo.

## Risks / Trade-offs
- Adding a status later needs a migration → acceptable, the values are fixed by R10.
- No indexes yet → added with the inbox queries in Episode 32.
```

### `openspec/changes/add-core-data-model/tasks.md`

```markdown
## 1. Migrations (I run these with /new-migration)
- [ ] 1.1 Role column on users, default customer; check the SQL with migrate --pretend
- [ ] 1.2 Categories table; check the SQL
- [ ] 1.3 Tickets table with foreign keys; check the SQL, then I run migrate

## 2. Models
- [ ] 2.1 Role, TicketStatus and TicketPriority enums, cast on the models
- [ ] 2.2 Category and Ticket models with relationships; User gets role helpers and ticket relationships
- [ ] 2.3 Factories: agent and admin states, CategoryFactory, TicketFactory

## 3. First admin
- [ ] 3.1 AdminSeeder, called from DatabaseSeeder

## 4. Tests
- [ ] 4.1 A Pest test for every scenario, in tests/Feature/DataModel
- [ ] 4.2 Run php artisan test, all green
```

### `database/migrations/2026_10_10_024840_add_role_to_users_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['customer', 'agent', 'admin'])->default('customer');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
```

### `database/migrations/2026_10_10_024841_create_categories_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
```

### `database/migrations/2026_10_10_024842_create_tickets_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('description');
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->enum('status', ['open', 'pending', 'resolved', 'closed'])->default('open');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('assignee_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
```

### `app/Enums/Role.php`

```php
<?php

namespace App\Enums;

enum Role: string
{
    case Customer = 'customer';
    case Agent = 'agent';
    case Admin = 'admin';
}
```

### `app/Enums/TicketStatus.php`

```php
<?php

namespace App\Enums;

enum TicketStatus: string
{
    case Open = 'open';
    case Pending = 'pending';
    case Resolved = 'resolved';
    case Closed = 'closed';
}
```

### `app/Enums/TicketPriority.php`

```php
<?php

namespace App\Enums;

enum TicketPriority: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
    case Urgent = 'urgent';
}
```

### `app/Models/Category.php`

```php
<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $archived_at
 */
#[Fillable(['name'])]
class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'archived_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<Ticket, $this>
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
```

### `app/Models/Ticket.php`

```php
<?php

namespace App\Models;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $subject
 * @property string $description
 * @property TicketStatus $status
 * @property TicketPriority $priority
 * @property int|null $assignee_id
 */
#[Fillable(['subject', 'description', 'category_id'])]
class Ticket extends Model
{
    /** @use HasFactory<TicketFactory> */
    use HasFactory;

    /**
     * New tickets are open, with normal priority.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'open',
        'priority' => 'normal',
    ];

    protected function casts(): array
    {
        return [
            'status' => TicketStatus::class,
            'priority' => TicketPriority::class,
        ];
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
```

### Edits to kit files (`app/Models/User.php`, `database/factories/UserFactory.php`, `database/seeders/DatabaseSeeder.php`)

```diff
diff --git a/app/Models/User.php b/app/Models/User.php
index 08f45b4..86f173c 100644
--- a/app/Models/User.php
+++ b/app/Models/User.php
@@ -2,11 +2,13 @@
 
 namespace App\Models;
 
+use App\Enums\Role;
 use Database\Factories\UserFactory;
 use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Illuminate\Database\Eloquent\Attributes\Fillable;
 use Illuminate\Database\Eloquent\Attributes\Hidden;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
+use Illuminate\Database\Eloquent\Relations\HasMany;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;
 use Illuminate\Support\Carbon;
@@ -20,6 +22,7 @@
  * @property string $email
  * @property Carbon|null $email_verified_at
  * @property string $password
+ * @property Role $role
  * @property string|null $two_factor_secret
  * @property string|null $two_factor_recovery_codes
  * @property Carbon|null $two_factor_confirmed_at
@@ -34,6 +37,15 @@ class User extends Authenticatable implements MustVerifyEmail, PasskeyUser
     /** @use HasFactory<UserFactory> */
     use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;
 
+    /**
+     * New sign-ups are customers. Role is not fillable, so a request can't set it.
+     *
+     * @var array<string, mixed>
+     */
+    protected $attributes = [
+        'role' => 'customer',
+    ];
+
     /**
      * Get the attributes that should be cast.
      *
@@ -45,6 +57,36 @@ protected function casts(): array
             'email_verified_at' => 'datetime',
             'password' => 'hashed',
             'two_factor_confirmed_at' => 'datetime',
+            'role' => Role::class,
         ];
     }
+
+    /**
+     * Agents and admins work on tickets. An admin is an agent with extra rights.
+     */
+    public function isAgent(): bool
+    {
+        return in_array($this->role, [Role::Agent, Role::Admin], true);
+    }
+
+    public function isAdmin(): bool
+    {
+        return $this->role === Role::Admin;
+    }
+
+    /**
+     * @return HasMany<Ticket, $this>
+     */
+    public function tickets(): HasMany
+    {
+        return $this->hasMany(Ticket::class, 'customer_id');
+    }
+
+    /**
+     * @return HasMany<Ticket, $this>
+     */
+    public function assignedTickets(): HasMany
+    {
+        return $this->hasMany(Ticket::class, 'assignee_id');
+    }
 }
diff --git a/database/factories/UserFactory.php b/database/factories/UserFactory.php
index 98825c8..43ffc3f 100644
--- a/database/factories/UserFactory.php
+++ b/database/factories/UserFactory.php
@@ -46,6 +46,20 @@ public function unverified(): static
         ]);
     }
 
+    public function agent(): static
+    {
+        return $this->state(fn (array $attributes) => [
+            'role' => 'agent',
+        ]);
+    }
+
+    public function admin(): static
+    {
+        return $this->state(fn (array $attributes) => [
+            'role' => 'admin',
+        ]);
+    }
+
     /**
      * Indicate that the model has two-factor authentication configured.
      */
diff --git a/database/seeders/DatabaseSeeder.php b/database/seeders/DatabaseSeeder.php
index 6b901f8..85c93e3 100644
--- a/database/seeders/DatabaseSeeder.php
+++ b/database/seeders/DatabaseSeeder.php
@@ -21,5 +21,7 @@ public function run(): void
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);
+
+        $this->call(AdminSeeder::class);
     }
 }
```

### `database/factories/CategoryFactory.php`

```php
<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
        ];
    }
}
```

### `database/factories/TicketFactory.php`

```php
<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subject' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'category_id' => Category::factory(),
            'customer_id' => User::factory(),
        ];
    }

    public function assignedTo(User $agent): static
    {
        return $this->state(fn (array $attributes) => [
            'assignee_id' => $agent->id,
        ]);
    }
}
```

### `database/seeders/AdminSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Create the first admin. Asks for the details, so no password lives in the repo.
     */
    public function run(CreateNewUser $creator): void
    {
        if (User::where('role', Role::Admin)->exists()) {
            $this->command->info('An admin already exists. Nothing to do.');

            return;
        }

        $admin = $creator->create([
            'name' => $this->command->ask('Admin name', 'Admin'),
            'email' => $this->command->ask('Admin email'),
            'password' => $this->command->secret('Admin password'),
            'password_confirmation' => $this->command->secret('Confirm the password'),
        ]);

        $admin->role = Role::Admin;
        $admin->save();
        $admin->markEmailAsVerified();

        $this->command->info("Admin created: {$admin->email}");
    }
}
```

### `tests/Feature/DataModel/RolesTest.php`

```php
<?php

use App\Enums\Role;
use App\Models\User;

test('a new sign-up is a customer', function () {
    $this->post(route('register.store'), [
        'name' => 'Ana',
        'email' => 'ana@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    expect(User::where('email', 'ana@example.com')->first()->role)->toBe(Role::Customer);
});

test('a sign-up cannot choose its own role', function () {
    $this->post(route('register.store'), [
        'name' => 'Ben',
        'email' => 'ben@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'admin',
    ]);

    expect(User::where('email', 'ben@example.com')->first()->role)->toBe(Role::Customer);
});

test('agents and admins count as agents, customers do not', function () {
    expect(User::factory()->agent()->create()->isAgent())->toBeTrue()
        ->and(User::factory()->admin()->create()->isAgent())->toBeTrue()
        ->and(User::factory()->create()->isAgent())->toBeFalse();
});

test('only admins are admins', function () {
    expect(User::factory()->admin()->create()->isAdmin())->toBeTrue()
        ->and(User::factory()->agent()->create()->isAdmin())->toBeFalse()
        ->and(User::factory()->create()->isAdmin())->toBeFalse();
});
```

### `tests/Feature/DataModel/TicketDataTest.php`

```php
<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

test('a new ticket is open, normal priority and unassigned', function () {
    $customer = User::factory()->create();

    $ticket = $customer->tickets()->create([
        'subject' => 'Cannot sign in',
        'description' => 'The reset link expired.',
        'category_id' => Category::factory()->create()->id,
    ])->fresh();

    expect($ticket->status)->toBe(TicketStatus::Open)
        ->and($ticket->priority)->toBe(TicketPriority::Normal)
        ->and($ticket->assignee)->toBeNull()
        ->and($ticket->customer->is($customer))->toBeTrue();
});

test('the database refuses a status outside the four', function () {
    $ticket = Ticket::factory()->create();

    DB::table('tickets')->where('id', $ticket->id)->update(['status' => 'reopened']);
})->throws(QueryException::class);

test('the database refuses a priority outside the four', function () {
    $ticket = Ticket::factory()->create();

    DB::table('tickets')->where('id', $ticket->id)->update(['priority' => 'critical']);
})->throws(QueryException::class);

test('deleting an agent unassigns their tickets', function () {
    $agent = User::factory()->agent()->create();
    $ticket = Ticket::factory()->assignedTo($agent)->create();

    $agent->delete();

    expect($ticket->fresh()->assignee_id)->toBeNull();
});

test('deleting a customer deletes their tickets', function () {
    $ticket = Ticket::factory()->create();

    $ticket->customer->delete();

    expect(Ticket::find($ticket->id))->toBeNull();
});

test('a category with tickets cannot be deleted', function () {
    $ticket = Ticket::factory()->create();

    $ticket->category->delete();
})->throws(QueryException::class);
```

### `tests/Feature/DataModel/AdminSeederTest.php`

```php
<?php

use App\Enums\Role;
use App\Models\User;
use Database\Seeders\AdminSeeder;

test('the seeder creates the first admin', function () {
    $this->artisan('db:seed', ['--class' => AdminSeeder::class])
        ->expectsQuestion('Admin name', 'Sam')
        ->expectsQuestion('Admin email', 'sam@example.com')
        ->expectsQuestion('Admin password', 'a-long-Passw0rd')
        ->expectsQuestion('Confirm the password', 'a-long-Passw0rd')
        ->assertSuccessful();

    expect(User::where('email', 'sam@example.com')->first()->role)->toBe(Role::Admin);
});

test('the seeder does nothing when an admin exists', function () {
    User::factory()->admin()->create();

    $this->artisan('db:seed', ['--class' => AdminSeeder::class])->assertSuccessful();

    expect(User::where('role', Role::Admin)->count())->toBe(1);
});
```

---

## Production notes
- Spoken word count: about 4,140 words, roughly 28.5 minutes at a steady TTS pace, plus slide pauses (plan target about 35).
- Illustrated walkthrough, not a recording. No output is shown. Verified in /tmp/throwaway2/support-desk on branch add-core-data-model (Laravel 13, PHP 8.5, PostgreSQL 17, OpenSpec 1.14.1): migrate --pretend SQL (role: varchar with check ("role" in ('customer', 'agent', 'admin')) not null default 'customer'; categories: unique name; tickets: 2 check constraints, 3 foreign keys on delete cascade, set null, restrict, defaults 'open' and 'normal'); migrate; migrate:rollback --step=3 and migrate again; php artisan test 52 passed (40 kit + 12 new); Pint and PHPStan (with a 1G memory limit, as in Episode 29) pass; vp check format and lint pass; openspec validate --strict valid; openspec archive reported 7 requirements added and created openspec/specs/user-roles and openspec/specs/tickets.
- Claude was not run for this episode: the explore questions, the propose result and the apply result are described as the course's reviewed plan and code, not as Claude output. The code-reviewer step, git push, gh pr create and CI were not run.
- Laravel facts (laravel.com/docs/13.x): migrations (enum method "creates a ENUM equivalent column with the given valid values"; passing Enum::cases(); foreignId()->constrained(); constrained(table); cascadeOnDelete, restrictOnDelete, nullOnDelete; migrate --pretend; rollback --step); eloquent (mass assignment and the is_admin example; #[Fillable] attribute; default attribute values with $attributes); eloquent-mutators (enum casting); eloquent-relationships (belongsTo, hasMany, custom foreign key); seeding (db:seed --class, $this-call, type-hinted dependencies in run); console-tests (expectsQuestion).
- PostgreSQL fact: a foreign key constraint does not automatically create an index on the referencing columns (postgresql.org/docs/current/ddl-constraints.html).
- OpenSpec facts (1.14.1, from the generated instructions in the project): capabilities named for durable behaviour, avoid catch-all; specs avoid class names and framework choices; design only when needed (significant data model change applies); tasks state how to verify; explore does not implement; archive merges deltas into openspec/specs. README: clear context before implementation (as in Episode 24).
- Course assets: database-conventions and new-migration skills (Ep19, unchanged; new-migration has disable-model-invocation, pre-approves make:migration and migrate --pretend for the invoking turn (does not restrict other tools), and its step 5 says stop and do not run the migration); hooks (Ep20); code-reviewer (Ep29 version); CLAUDE.md rule on migrations (Ep29); the kit's account deletion (tests/Feature/Settings/ProfileUpdateTest.php).
- Logic checks: 3 tables; 7 fields; 3 roles, 4 statuses, 4 priorities; 4 questions; 3 foreign keys with 3 different delete rules; 2 capabilities, 3 + 4 = 7 requirements, 4 + 5 = 9 scenarios; 4 + 6 + 2 = 12 tests; 40 + 12 = 52; every spec scenario has a test (admin counts as agent and customer is not an agent: RolesTest 3; sign-up role: RolesTest 2; admin exists: AdminSeederTest 2; defaults, unknown status, used category, agent deleted, customer deleted: TicketDataTest). R10 is referenced only for its four statuses; its six reply cases are features (Episode 34).
- YouTube description: 4,459 characters, under the 4,500 target, no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Data Modeling with Claude Code: Roles, Categories and Tickets in Laravel 13 | Agentic Engineering Ep 30
2. Spec First, Migrations Reviewed: Laravel + PostgreSQL Data Model with OpenSpec | Ep 30
3. Capstone, Data Modeling Part 1 | Agentic Engineering Ep 30

### Description (ready to paste, 4,459 characters)

```
Episode 30 of Agentic Engineering, a free course on agentic coding.
Support Desk data modeling, part 1: roles, categories and tickets. Spec first, SQL read before it runs, 12 tests on PostgreSQL.
Screens are drawn illustrations; no output is shown. Files are written for the course.

Prompts:
/opsx:explore Data model for roles, categories and tickets in docs/requirements.md. Read the users migration and the User model first. Ask me one question at a time about storing status, priority and role, deletes, and the first admin.

/opsx:propose add-core-data-model: roles, categories and tickets as decided. Data layer only: migrations, enums, models, factories, admin seeder, tests. No screens, policies, replies or indexes. Task group 1 is the three migrations; I create them with /new-migration.

/new-migration add role to users: customer, agent or admin, default customer. List values literally.

/new-migration create categories: unique name, nullable archived_at, timestamps

/new-migration create tickets: subject, description, category (restrict on delete), status open, pending, resolved or closed (default open), priority low, normal, high or urgent (default normal), customer (cascade), nullable assignee (null on delete), timestamps. List values literally.

/clear, then /opsx:apply add-core-data-model
Use the code-reviewer subagent to review this change.
/opsx:archive add-core-data-model

specs/user-roles/spec.md:
## ADDED Requirements

### Requirement: Roles
Every user SHALL have one role: customer, agent or admin. An admin SHALL count as an agent.

#### Scenario: Admin
- **WHEN** a user is an admin
- **THEN** they count as an agent and as an admin

#### Scenario: Customer
- **WHEN** a user is a customer
- **THEN** they do not count as an agent

### Requirement: New sign-ups are customers
A new sign-up SHALL be a customer, whatever the request sends.

#### Scenario: Sign-up sends a role
- **WHEN** someone registers with role admin
- **THEN** the new user is a customer

### Requirement: First admin
A seeder SHALL create the first admin from details it asks for, and SHALL do nothing if an admin exists.

#### Scenario: Admin exists
- **WHEN** the seeder runs and an admin exists
- **THEN** no user is created

specs/tickets/spec.md:
## ADDED Requirements

### Requirement: Ticket fields
A ticket SHALL have a subject, description, category, status, priority and customer, and MAY have an assignee.

#### Scenario: Defaults
- **WHEN** a customer opens a ticket
- **THEN** it is open, normal priority and unassigned

### Requirement: Allowed values
The database SHALL refuse a status other than open, pending, resolved or closed, and a priority other than low, normal, high or urgent.

#### Scenario: Unknown status
- **WHEN** a ticket is saved with status reopened
- **THEN** the database refuses it

### Requirement: Categories
Category names SHALL be unique. A category in use SHALL be archived, never deleted.

#### Scenario: Delete a used category
- **WHEN** a category with tickets is deleted
- **THEN** the database refuses it

### Requirement: Deleted users
A deleted customer's tickets SHALL be deleted. A deleted assignee's tickets SHALL become unassigned.

#### Scenario: Agent deleted
- **WHEN** an assigned agent is deleted
- **THEN** their tickets have no assignee

#### Scenario: Customer deleted
- **WHEN** a customer deletes their account
- **THEN** their tickets are deleted

Proposal: R1, R2, R10 data side. Design: the decisions in the video. Tasks: migrations (me), models, seeder, tests.

Commands:
git switch -c add-core-data-model
openspec validate add-core-data-model --strict
git add openspec && git commit -m "Plan: add-core-data-model"
php artisan migrate
php artisan migrate:rollback --step=3
php artisan migrate
php artisan test
php artisan db:seed --class=AdminSeeder
git add -A && git commit -m "Add roles, categories and tickets"
git push -u origin add-core-data-model
gh pr create --fill

Code, summarised (PHP arrows can't go in a description): 3 migrations, values listed literally; enums Role, TicketStatus, TicketPriority, cast on the models; User gets isAgent, isAdmin and ticket relationships, role not fillable; Ticket belongs to category, customer and assignee; agent and admin factory states; AdminSeeder asks for the details and reuses the kit's sign-up validation. Tests: RolesTest 4, TicketDataTest 6, AdminSeederTest 2.

Next in the playlist: Episode 31, Capstone, Data Modeling Part 2.
```

---

## Slide list

| # | Slide | Notes |
|---|---|---|
| 1 | title slide | title |
| 2 | Three parts | agenda |
| 3 | 01 · Plan the model | divider |
| 4 | Three parts of data modeling | plan (Illustration) |
| 5 | Today's three tables | squares |
| 6 | Explore first | monitor (Illustration) |
| 7 | Four choices | 4num |
| 8 | Enum column or plain string? | two |
| 9 | Role is not fillable | phone (Illustration) |
| 10 | On delete: three answers | card (Illustration) |
| 11 | Propose | monitor (Illustration) |
| 12 | Two capabilities | two-points (Illustration) |
| 13 | Review in order | flow |
| 14 | 02 · Migrations, reviewed first | divider |
| 15 | Why I make the migrations | panel |
| 16 | /new-migration: role | phone (Illustration) |
| 17 | Read the SQL | plan (Illustration) |
| 18 | Categories | squares |
| 19 | Tickets table | card (Illustration) |
| 20 | Literal values, not enums | two |
| 21 | Then I run it | monitor (Illustration) |
| 22 | Missing on purpose | two-points (Illustration) |
| 23 | 03 · Models and tests | divider |
| 24 | Clear, then apply | flow |
| 25 | Enums and casts | phone (Illustration) |
| 26 | Relationships | squares |
| 27 | The first admin | panel |
| 28 | Twelve new tests | 4num |
| 29 | Tests that ask the database | card (Illustration) |
| 30 | Review, then archive | plan (Illustration) |
| 31 | Done means | flow |
| 32 | Your turn | two-points (Illustration) |
| 33 | Ready for replies | two |
| 34 | quote slide | quote |
| 35 | recap slide | recap |
| 36 | Next in the playlist | closer |

---

## Sources
- Laravel: https://laravel.com/docs/13.x/migrations, /eloquent, /eloquent-mutators, /eloquent-relationships, /eloquent-factories, /seeding, /console-tests, /database-testing
- PostgreSQL: https://www.postgresql.org/docs/current/ddl-constraints.html (foreign keys and indexes)
- OpenSpec 1.14.1: generated instructions (openspec instructions), README
- Claude Code: https://code.claude.com/docs/en/skills (disable-model-invocation, allowed-tools), /sub-agents, /hooks
- Course: Episode 28 (requirements), Episode 29 (project setup), Episodes 19, 20, 23 to 25 (skills, hooks, OpenSpec)
