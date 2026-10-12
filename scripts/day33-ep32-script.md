# Day 33 · Episode 32: Capstone, Data Modeling Part 3

**Series:** Agentic Engineering (free YouTube course) · Module 13
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 26:00 in the plan; estimated 20:00 from the word count (times below are estimates; replace with real slide times after the voiceover)
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 13 lesson):** Data Modeling 2, second half (change log and query indexes)

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Claude, OpenSpec, Laravel, git, psql, EXPLAIN or test output is shown. The OpenSpec change (proposal, two delta specs, design, tasks), the prompts, the SQL scripts, the migrations, the model, the Ticket and AppServiceProvider edits and the tests are **written for the course**; the plan files are the reviewed versions, not something Claude produced on camera. All of it was built and run once in the throwaway copy of the project on PostgreSQL 17 on 12 October 2026 (migrate --pretend, migrate, rollback --step=4 and migrate again, a separate volume database with EXPLAIN ANALYZE before and after the indexes, the full test suite, two deliberate breaks, Pint, PHPStan, the kit's format and lint checks, openspec validate --strict and archive); none of that output appears in the video.

**Split of the three data-modeling episodes (unchanged from Episode 30):** Ep30 = roles, categories, tickets. Ep31 = public replies (R7) and internal notes (R8). Ep32 (this one) = the change log (R11) and the indexes for the inbox, filters and search (R4, R5, R6, Q5).

**Counts drawn on slides (checked against the files and the throwaway project):** new table: 1 (ticket_changes, 7 columns: id, ticket_id, user_id, field, old_value, new_value, created_at). Logged fields: 3. Explore questions: 4. Migrations: 4 (1 create, 3 index), rollback --step=4. New indexes: 8 (ticket_changes 1; tickets 3 + 1 full text; replies 1 + 1 full text; internal_notes 1); 6 b-tree, 2 GIN. Volume copy: 20,000 customers, 20 agents (+1 new), 10 categories (+1 new), 100,000 tickets, 300,000 replies, 33,333 notes. Capabilities: 2 new (ticket-history 4 requirements, 7 scenarios; ticket-queries 3 requirements, 6 scenarios): 7 requirements, 13 scenarios; archive reported 7 added; openspec/specs now holds 5 capabilities. Task groups: 3. Tests: ChangeLogTest 7 + TicketQueriesTest 6 = 13 new; suite 60 + 13 = 73, all passing on PostgreSQL. Lazy loading example: 1 + 25 × 3 = up to 76 queries; eager: at most 4.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:20 | [VOICEOVER + SLIDE] | Hook |
| 0:20–1:15 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:15–8:10 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 1 · Plan the log and the queries |
| 8:10–14:10 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Migrations and EXPLAIN |
| 14:10–19:25 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Code and tests |
| 19:25–20:00 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:20 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> An agent changes a ticket from urgent to low, and a week later the customer asks why nobody answered. Who changed it, and when? Without a log, nobody knows.
> Today the Support Desk gets that log. And then the indexes its busiest screens need, chosen by asking PostgreSQL, not by guessing.

**Visual / B-roll:**
- Title card.

### 0:20–1:15 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode thirty-two: capstone, data modeling part three. The last data modeling slice.

*Cue: agenda slide "Three parts"*
> Three parts. First, plan the log and the queries: explore four questions and turn the answers into an OpenSpec change. Second, migrations and EXPLAIN: one new table, eight new indexes, and PostgreSQL's own report before and after. Third, code and tests: the methods that write the log, a search scope, and lazy loading switched off outside production.
> As always, this is an illustrated walkthrough, not a recording. I built and ran all of it once in a throwaway copy of the project, on PostgreSQL, and every test passed there. No output is shown. The prompts and commands are in the description, and the plan, the SQL scripts and the code are summarised there.

**Visual / B-roll:**
- Three items: 01 Plan the log and the queries · 02 Migrations and EXPLAIN · 03 Code and tests.

### 1:15–8:10 · Part 1: Plan the log and the queries
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "01 · Plan the log and the queries"*
> Part one. Plan the log and the queries.

*Cue: panel "Where we left off"*
> Where we left off. Episode thirty-one added public replies and internal notes, in two separate tables. Three capabilities are archived in openspec slash specs: user roles, tickets, and ticket conversation. And sixty tests pass.
> Today's slice has two halves. R eleven: every status, priority and assignee change is logged with who and when, and shown on the ticket. And the queries behind R four, R five and R six: the inbox, newest first, twenty-five per page, its filters, and search. Plus Q five: the inbox loads without N plus one queries.

*Cue: squares "Three things to log"*
> R eleven names exactly three things.
> Status: open, pending, resolved or closed.
> Priority: low, normal, high or urgent.
> And the assignee: which agent, or nobody.
> For each change we need four facts: the old value, the new value, who made the change, and when.

*Cue: monitor "Explore first"*
> As in the last two episodes, I start with slash O P S X explore. Explore is for thinking: Claude reads the code and talks it through, but writes no code.
> The prompt names R eleven, and the queries behind R three to R six and Q five, asks Claude to read the Ticket model and the migrations first, and asks for one question at a time about four areas: the log's shape, who records a change, which queries need indexes, and search.
> The prompt is written for the course and printed in the description. What follows are the four questions, and the answers I settled on.

*Cue: 4num "Four questions"*
> Four questions.
> One: one log table, or a column per field? Two: who writes an entry, and how do we know who made the change? Three: which queries need an index? Four: how does search find words in subjects and replies?

*Cue: two columns "One log or three?"*
> Question one. Option one: separate columns or tables for each field, like status from and status to, priority from and priority to. Every value keeps its real type. But the screen in a later episode wants one timeline, so it would merge three sources, and every new logged field means a new table or columns.
> Option two: one table, ticket changes. Each row has a field, status, priority or assignee, an old value, a new value, who, and when.
> I chose one table. The values become text, which is fine for a log that people read. Status and priority values are already strings. The assignee is stored as the user's id, as text.

*Cue: card "Who writes the entry?"*
> Question two decides whether the log can be trusted. Option one: a model event. Laravel can run code every time a ticket is saved, and it would log whatever changed. But an event doesn't know who made the change. It would have to read the signed-in user, and a seeder, a queued job or a test has none.
> Option two: explicit methods on Ticket. Change status, change priority, and assign to. Each takes the user who's making the change, just like add reply took the author last episode.
> I chose the methods. And each saves the ticket and its log entry in one database transaction. The Laravel docs say that if an exception is thrown inside the transaction closure, it's rolled back automatically. So a change is never saved without its entry, or the other way round. That's also a rule in our database conventions skill from episode nineteen.

*Cue: phone "Rules for an entry"*
> A few smaller answers came out of the same conversation.
> Setting a value the ticket already has logs nothing. Open to open isn't a change.
> Only agents can be assigned, and admins count as agents. Assigning a customer throws, like add note does for a customer.
> And an entry is never edited, so the table has a created at column, but no updated at. The Laravel docs show that the timestamp column names are constants on the model. Setting updated at to null, which I checked in the throwaway project, makes Eloquent fill only created at.

*Cue: plan "Deletes, again"*
> Deletes follow last episode's pattern. A ticket's history means nothing without the ticket, so that key cascades. If the person who made a change deletes their account, the entry stays, and its user is set to null. The ticket's history keeps its shape, and the screen can say: a deleted user.

*Cue: two-points "Ask, don't guess"*
> Question three, indexes. Our database conventions skill says: add an index only where a query needs it, because indexes add overhead to every write. So which queries need one?
> Step one: write down the queries the features will run. The inbox, newest first. A customer's own tickets. The four filters. A ticket's replies, notes and history. And search.
> Step two: ask PostgreSQL. Its EXPLAIN command shows the plan it picks for a query, and EXPLAIN ANALYZE runs it and reports what actually happened. On an empty table, every plan looks fast. So I run them on a copy with a hundred thousand fake tickets. That's part two.
> Question four, search, I'll come back to in part two, because EXPLAIN changed my first answer.

*Cue: monitor "Propose the change"*
> Back on main, pull the merged episode thirty-one work, and make a branch: add change log and indexes.
> Then slash O P S X propose add change log and indexes. Data layer only: migrations, the ticket change model, the Ticket methods, a search scope, lazy loading off outside production, and tests. No policies, no screens, no R ten rules. And task group one is the migrations and EXPLAIN, which I do myself.

*Cue: flow "Review in order"*
> Review in the usual order. The proposal names R eleven, R four, R five, R six and Q five, and keeps policies, the R ten reply rules, screens and the inbox page itself out of scope.
> The spec has two new capabilities. Ticket history, with four requirements: logged changes, unchanged values, assignees, and history and deletes. Ticket queries, with three: query indexes, search, and no lazy loading. Seven requirements, thirteen scenarios. Our config asks for a refusal, so there's one: a customer as assignee is refused.
> The design records the decisions, including the indexes I expected, and task one point three checks them with EXPLAIN before any code is written. If EXPLAIN disagrees, the design changes. The tasks have three groups. Then openspec validate, strict, and I commit the plan.

### 8:10–14:10 · Part 2: Migrations and EXPLAIN
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Migrations and EXPLAIN"*
> Part two. Migrations, and EXPLAIN.

*Cue: phone "ticket_changes"*
> First, slash new migration, create ticket changes: a ticket that cascades on delete, a nullable user that's set to null on delete, a field that's status, priority or assignee, old value and new value as nullable strings, created at only, and an index on ticket id and id.
> As before, the skill writes the migration with an up and a down, runs migrate dash dash pretend, and stops. The down drops the table.

*Cue: plan "Read the SQL"*
> The SQL, line by line. A create table with an id, a ticket id that's not null, a user id that is null, and the field as a var-char with a check constraint listing the three names, the same pattern as status in episode thirty. Old and new value, both nullable var-chars. And created at, not null, with a precision of zero.
> Then two foreign keys: ticket, on delete cascade; user, on delete set null. And a create index on ticket id, then id. That's what I asked for.

*Cue: monitor "A copy with volume"*
> Now the indexes, and for those, I need data. I don't touch my development database. I create a separate one, support desk explain, migrate it with the D B underscore DATABASE variable set to that name, and fill it with a short SQL script.
> The script uses PostgreSQL's generate series to make twenty thousand customers, twenty agents, ten categories and a hundred thousand tickets, mostly closed, with three replies each. Then it adds a new agent and a new category, each on just the two oldest tickets. They matter in a minute.
> Then a second script runs EXPLAIN ANALYZE on each query. Both scripts are summarised in the description. Their output isn't shown; I'll describe what it said.

*Cue: card "Before: EXPLAIN said"*
> Before any new index. The inbox, newest first, was already fast: PostgreSQL walked the primary key backwards and stopped after the page it needed. The open filter was fast the same way: open tickets are common enough that twenty-five turn up near the top.
> But a customer's own tickets: a sequential scan, reading all hundred thousand rows to find five. A ticket's replies: a scan of all three hundred thousand replies. And search scanned whole tables.

*Cue: two columns "Busy agent, new agent"*
> The filters taught the most interesting lesson. Filtering by a busy agent, with thousands of tickets, was fast: the primary key found twenty-five of theirs within about five hundred rows.
> Filtering by the new agent, with only two old tickets, was the slow case: PostgreSQL read through almost the whole table, ninety-nine thousand nine hundred and ninety-eight rows thrown away, to find those two. The new category, the same.
> Same query, different value, very different cost. Test with the rare values, not just the common ones.

*Cue: phone "Index migrations"*
> So, three more migrations, one per table. On tickets: customer id and id, assignee id and id, category id and id, and a full text index on the subject, in English. On replies: ticket id and id, and full text on the body. On internal notes: ticket id and id.
> With the one in ticket changes, that's eight new indexes. No index on status or priority: four values each, and EXPLAIN showed the primary key already serves those filters.

*Cue: two-points "Why the id at the end?"*
> Why ticket id and id, and not just ticket id? The PostgreSQL docs explain that a multicolumn index works best with equality on its leading columns. So for one customer, the entries are already sorted by id, and the docs also say an index can be scanned backwards for a descending order. One index serves where customer id equals this, order by id descending.
> And the foreign key column comes first for a second reason. The PostgreSQL docs point out that deleting a referenced row needs a scan of the referencing table, so it's often a good idea to index the referencing columns. So deleting an account can find that customer's tickets through the same index.

*Cue: plan "Same expression"*
> The full text index is different. Laravel's full text method builds a GIN index, which the PostgreSQL docs call the preferred text search index type, on to tsvector, English, subject.
> The docs add a detail that's easy to miss: only the form of to tsvector that names a configuration can be used in an index. And the query has to use that same expression for the index to apply. So I set English explicitly in both places, the migration and the query. To check, I ran the same search with the simple configuration instead, and PostgreSQL went back to scanning the table.

*Cue: card "After: EXPLAIN"*
> Then the copy gets the new migrations, and EXPLAIN runs again. The customer's tickets: now through its index. The new agent and the new category: through theirs, a couple of rows read instead of a hundred thousand. A ticket's replies: through the ticket id index.
> The busy agent and the open filter still use the primary key. That's PostgreSQL choosing the cheaper plan for those values, not a missing index.
> And search? My first version had a surprise in it.

*Cue: flow "Run, roll back, run"*
> Here's group one's routine in order. On my own machine first: php artisan migrate. Then migrate rollback with step four, because there are four migrations today, and migrate again. All four down methods work: the indexes drop, the table drops, and everything comes back the same.
> Then the copy is migrated and EXPLAIN runs again, which is what we just saw. I tick group one, and run the full test suite: still sixty, all passing.

### 14:10–19:25 · Part 3: Code and tests
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Code and tests"*
> Part three. Code and tests.

*Cue: squares "Ticket gets new methods"*
> Slash clear, then slash O P S X apply. The hooks run as it works: Pint on each PHP file, and the tests on Stop.
> A small Ticket Change model, with field, old value and new value fillable, and two relationships: the ticket, and the user. And Ticket gets three kinds of addition.
> History: a has many relationship, ordered by id, like replies.
> Change status, change priority and assign to.
> And a search scope.

*Cue: panel "Saved together"*
> The three change methods share one private helper: save and log. It looks at the three logged columns. For each one Eloquent marks as changed, it prepares an entry with the old and the new value. If nothing changed, it returns, and nothing is written. Otherwise, inside one transaction, it saves the ticket, attaches the user to each entry, and saves them.
> Assign to checks one more thing first: if the new assignee isn't an agent, it throws an invalid argument exception, before anything is saved.
> And this pays off in a features episode: when a customer's reply reopens a resolved ticket under R ten, the feature calls change status with the customer as the user. The log will say exactly that.

*Cue: two-points "Search: union, not or"*
> Now search, and the surprise from the copy. My first idea was: subject matches, or there exists a reply that matches. Correct results. But EXPLAIN showed that the or kept PostgreSQL from using the subject index: it walked the tickets and checked about sixteen thousand subjects one by one.
> The fix went into the design before apply: ask two questions and combine the answers. Ticket ids whose subject matches, union ticket ids from replies whose body matches, and then the tickets with those ids. EXPLAIN on that version showed both full text indexes in use. To see the SQL Laravel builds, the dump raw SQL method from the docs prints it with the values filled in.
> Internal notes aren't searched: R six says subjects and replies. And because the search uses plain to tsquery, the PostgreSQL docs explain that the words are normalised and joined with and. So refunds finds a ticket about a refund, and printer jam needs both words.

*Cue: 4num "13 new tests"*
> Group three: thirteen tests, in two new files.
> The change log test, seven: status, priority, assign and unassign, an unchanged value logs nothing, only agents can be assigned, and the two delete rules.
> The ticket queries test, six: the eight indexes exist, using the schema has index method from the docs; search by subject words; by a reply; not by a note; by another form of a word; and lazy loading.
> Thirteen scenarios, thirteen tests. With the sixty from before, seventy-three, and in my throwaway project all seventy-three passed on PostgreSQL.

*Cue: squares "Q5: no N plus one"*
> That last test is Q five's guard. The inbox lists twenty-five tickets, each with a category, a customer and an assignee. Load those lazily, one ticket at a time, and twenty-five rows become up to seventy-six queries: the N plus one problem.
> Eager loading with the with method fixes it. The Laravel docs show that eager loading runs one query for the main models, and one per relationship. So the inbox needs at most four queries, however many rows. And EXPLAIN showed the customer and assignee lookups use the users primary key, so they need no new index.
> But a fix you have to remember is a fix you'll forget. So in the app service provider, one line: prevent lazy loading, unless the app is in production. The Laravel docs say Eloquent then throws a lazy loading violation exception. In tests and on my machine, a missing eager load fails loudly, while production keeps working. The test proves it: read the customer of a ticket from a list without eager loading, and it throws. In the throwaway project, I removed that line, and the test failed.

*Cue: flow "Review, archive, merge"*
> The code reviewer subagent reviews the diff against the change. Then slash O P S X archive: seven requirements merge in, and openspec slash specs now holds five capabilities. Commit, push, g h pr create, dash dash fill, CI runs the migrations from scratch and the tests on PostgreSQL, then review and merge.

*Cue: two columns "Data layer done"*
> Your turn, before the next episode. One: pick the busiest list in your own app, run EXPLAIN ANALYZE on it with your rarest filter value, and see what it reads. Two: switch on prevent lazy loading in development, run your tests, and count what breaks.
> And where are we? Every table the Support Desk needs exists. Changes are logged with who and when. The inbox, filters and search have indexes that EXPLAIN approved. Seventy-three tests, five capabilities. Next, we finally build what people see: the core features.

### 19:25–20:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> Don't guess where the index goes. Ask the database.

*Cue: recap slide*
> Quick recap.
> One change log table, written by methods that know who made the change, in one transaction.
> Indexes chosen with EXPLAIN on a volume copy, tested with rare values, foreign key first and id second.
> Search as a union, so both full text indexes are used, and lazy loading that fails loudly outside production.
> Four migrations, thirteen new tests, one archived change, and a pull request.

*Cue: closer slide "Next in the playlist"*
> Next in the playlist: episode thirty-three, capstone, core features part one. See you there.

---

## Example files (written for the course)

All files were run in the throwaway project. The prompts and commands are free of `<` and `>` and go into the description as they are. `seed-volume.sql` uses `<` in its case expressions, and the PHP files contain `<?php`, `->` and `=>`, so the description summarises them; the full files are here. `explain.sql` has no angle brackets but is summarised for length. Migration file names start with the timestamp from `make:migration`; yours will differ. The two SQL scripts live outside the repository and run only against the separate `support_desk_explain` database.

### Prompts (typed into Claude Code)

```text
/opsx:explore The change log (R11) and the queries behind R3 to R6 and Q5 in docs/requirements.md. Read the Ticket model and the migrations first. Ask me one question at a time about the log's shape, who records a change, which queries need indexes, and search.

/opsx:propose add-change-log-and-indexes: the change log and indexes as decided. Data layer only: migrations, TicketChange model, Ticket methods, search scope, lazy loading off outside production, tests. No policies, screens or R10 rules. Task group 1 is the migrations and EXPLAIN; I do those myself.

/new-migration create ticket_changes: ticket (cascade on delete), nullable user (null on delete), field (status, priority or assignee), nullable old_value and new_value strings, created_at only, index on ticket_id and id

/new-migration add indexes to tickets: customer_id and id, assignee_id and id, category_id and id, full text on subject in english

/new-migration add indexes to replies: ticket_id and id, full text on body in english

/new-migration add indexes to internal_notes: ticket_id and id

/clear, then /opsx:apply add-change-log-and-indexes
Use the code-reviewer subagent to review this change.
/opsx:archive add-change-log-and-indexes
```

### Commands (typed in the terminal)

```text
git switch main && git pull
git switch -c add-change-log-and-indexes
openspec validate add-change-log-and-indexes --strict
git add openspec && git commit -m "Plan: add-change-log-and-indexes"
psql -U postgres -c "CREATE DATABASE support_desk_explain OWNER support_desk;"
DB_DATABASE=support_desk_explain php artisan migrate
psql -U support_desk support_desk_explain -f seed-volume.sql
psql -U support_desk support_desk_explain -f explain.sql
php artisan migrate
php artisan migrate:rollback --step=4
php artisan migrate
DB_DATABASE=support_desk_explain php artisan migrate
psql -U support_desk support_desk_explain -f explain.sql
php artisan test
git add -A && git commit -m "Add change log, indexes and search"
git push -u origin add-change-log-and-indexes
gh pr create --fill
```

### `seed-volume.sql` (local copy only, never committed)

```sql
-- Fake volume for EXPLAIN, local database only. Never commit or run in production.
insert into users (name, email, password, role, created_at, updated_at)
select 'Customer ' || g, 'c' || g || '@example.test', 'x', 'customer', now(), now()
from generate_series(1, 20000) g;

insert into users (name, email, password, role, created_at, updated_at)
select 'Agent ' || g, 'a' || g || '@example.test', 'x', 'agent', now(), now()
from generate_series(1, 20) g;

insert into categories (name, created_at, updated_at)
select 'Category ' || g, now(), now() from generate_series(1, 10) g;

-- 100,000 tickets: 3% open, mostly closed, 80% assigned; 1 in 2,000 mentions a refund
insert into tickets (subject, description, category_id, status, priority, customer_id, assignee_id, created_at, updated_at)
select
  'w' || (random() * 5000)::int || ' w' || (random() * 5000)::int || ' w' || (random() * 5000)::int
    || case when g % 2000 = 0 then ' refund' else '' end,
  'Fake ticket',
  (select min(id) from categories) + g % 10,
  case when g % 100 < 3 then 'open' when g % 100 < 8 then 'pending'
       when g % 100 < 15 then 'resolved' else 'closed' end,
  case when g % 50 = 0 then 'urgent' when g % 10 < 2 then 'high'
       when g % 10 < 4 then 'low' else 'normal' end,
  (select min(id) from users where role = 'customer') + g % 20000,
  case when g % 5 = 0 then null else (select min(id) from users where role = 'agent') + g % 20 end,
  now(), now()
from generate_series(1, 100000) g;

-- 3 replies per ticket; about 1 in 1,000 tickets has a reply asking about refunds
insert into replies (ticket_id, author_id, body, created_at, updated_at)
select t.id, t.customer_id,
  'w' || (random() * 5000)::int || ' w' || (random() * 5000)::int || ' w' || (random() * 5000)::int
    || case when t.id % 997 = 0 and r = 2 then ' refunds' else '' end,
  now(), now()
from tickets t cross join generate_series(1, 3) r;

insert into internal_notes (ticket_id, author_id, body, created_at, updated_at)
select id, assignee_id, 'Fake note', now(), now() from tickets where id % 3 = 0;

-- A new agent and a new category, each on the two oldest tickets: rare values
insert into users (name, email, password, role, created_at, updated_at)
values ('New Agent', 'new-agent@example.test', 'x', 'agent', now(), now());
insert into categories (name, created_at, updated_at) values ('New category', now(), now());
update tickets
set assignee_id = (select id from users where email = 'new-agent@example.test'),
    category_id = (select id from categories where name = 'New category')
where id in (select id from tickets order by id limit 2);

analyze users, categories, tickets, replies, internal_notes;
```

### `explain.sql` (local copy only, never committed)

```sql
-- The queries R3 to R6 will run, on the volume copy.
analyze tickets, replies, internal_notes;
select id as customer from users where email = 'c77@example.test' \gset
select id as busy_agent from users where email = 'a3@example.test' \gset
select id as new_agent from users where email = 'new-agent@example.test' \gset
select id as new_category from categories where name = 'New category' \gset
select max(id) as ticket from tickets \gset

-- R4 inbox, newest first
explain analyze select * from tickets order by id desc limit 25;
-- R3 one customer's tickets
explain analyze select * from tickets where customer_id = :customer order by id desc limit 25;
-- R5 filters: a common status, a busy agent, a new agent, a new category
explain analyze select * from tickets where status = 'open' order by id desc limit 25;
explain analyze select * from tickets where assignee_id = :busy_agent order by id desc limit 25;
explain analyze select * from tickets where assignee_id = :new_agent order by id desc limit 25;
explain analyze select * from tickets where category_id = :new_category order by id desc limit 25;
-- A ticket's replies, in order
explain analyze select * from replies where ticket_id = :ticket order by id;
-- R6 search, first with or, then with union
explain analyze select * from tickets where to_tsvector('english', subject) @@ plainto_tsquery('english', 'refund') or exists (select 1 from replies where replies.ticket_id = tickets.id and to_tsvector('english', body) @@ plainto_tsquery('english', 'refund')) order by id desc limit 25;
explain analyze select * from tickets where id in (select id from tickets where to_tsvector('english', subject) @@ plainto_tsquery('english', 'refund') union select ticket_id from replies where to_tsvector('english', body) @@ plainto_tsquery('english', 'refund')) order by id desc limit 25;
```

### `openspec/changes/add-change-log-and-indexes/proposal.md`

```markdown
## Why
Agents need to see who changed a ticket and when, and the inbox, filters and search must stay fast as tickets pile up. Covers the data side of R11 (change log), R4, R5 and R6 (inbox, filters, search) and Q5 (no N + 1).

## What Changes
- New ticket_changes table, written by Ticket methods.
- Indexes chosen from the real queries, checked with EXPLAIN.
- A search scope over subjects and replies.
- Lazy loading throws outside production.

## Capabilities
### New Capabilities
- `ticket-history`: the change log.
- `ticket-queries`: indexes, search, no lazy loading.

## Out of scope
Who may change a ticket (policies), the R10 reply rules, screens, and the inbox page itself.

## Impact
Four migrations, one model, Ticket methods, AppServiceProvider, tests.
```

### `openspec/changes/add-change-log-and-indexes/specs/ticket-history/spec.md`

```markdown
## ADDED Requirements

### Requirement: Logged changes
Each change to a ticket's status, priority or assignee SHALL be logged with the old value, the new value, who made it and when.

#### Scenario: Status changed
- **WHEN** an agent sets an open ticket to pending
- **THEN** one entry records status, open, pending, that agent and the time

#### Scenario: Priority changed
- **WHEN** an agent sets the priority to urgent
- **THEN** one entry records priority, normal, urgent

#### Scenario: Assigned, then unassigned
- **WHEN** an agent assigns a ticket and then unassigns it
- **THEN** two assignee entries are recorded, in that order

### Requirement: Unchanged values
Setting a value the ticket already has SHALL NOT be logged.

#### Scenario: Same status
- **WHEN** an open ticket is set to open
- **THEN** no entry is recorded

### Requirement: Assignees
Only an agent SHALL be assigned. An admin counts as an agent.

#### Scenario: Customer assigned
- **WHEN** a customer is assigned to a ticket
- **THEN** it is refused, and nothing is saved or logged

### Requirement: History and deletes
A deleted ticket's history SHALL be deleted. A deleted user's entries SHALL stay, with no user.

#### Scenario: User deleted
- **WHEN** an agent who changed a ticket is deleted
- **THEN** the entry stays, with no user

#### Scenario: Ticket deleted
- **WHEN** a ticket is deleted
- **THEN** its history is deleted
```

### `openspec/changes/add-change-log-and-indexes/specs/ticket-queries/spec.md`

```markdown
## ADDED Requirements

### Requirement: Query indexes
The schema SHALL have indexes for a customer's tickets, the category and assignee filters, a ticket's replies, notes and history, and search.

#### Scenario: Migrated schema
- **WHEN** the migrations have run
- **THEN** the eight indexes exist

### Requirement: Search
Search SHALL find tickets with every given word, in any form, in the subject or in a public reply. Internal notes SHALL NOT be searched.

#### Scenario: Words in the subject
- **WHEN** an agent searches for printer jam
- **THEN** only tickets with both words are found

#### Scenario: Word in a reply
- **WHEN** a word appears only in a reply
- **THEN** the ticket is found

#### Scenario: Word in a note
- **WHEN** a word appears only in an internal note
- **THEN** the ticket is not found

#### Scenario: Other form
- **WHEN** an agent searches for refunds
- **THEN** a ticket about a refund is found

### Requirement: No lazy loading
Outside production, reading a relationship that was not eager loaded on tickets loaded as a list SHALL throw.

#### Scenario: Missing eager load
- **WHEN** code reads the customer of a ticket from a list without eager loading
- **THEN** Laravel throws a lazy loading error
```

### `openspec/changes/add-change-log-and-indexes/design.md`

```markdown
## Decisions
- One ticket_changes table: field (status, priority or assignee), old and new value as text, user, created_at only. Entries are never edited. Alternative: a column per field.
- changeStatus, changePriority and assignTo save the ticket and its entries in one transaction, and skip values that didn't change. Alternative: a model event, which would have to read the signed-in user.
- Assignee values are user ids as text; the screen shows a deleted user when the id is gone.
- Inbox order is id descending: a unique order for paging, served by the primary key.
- Indexes, from EXPLAIN on 100,000 tickets: (customer_id, id), (assignee_id, id), (category_id, id); (ticket_id, id) on replies, internal_notes and ticket_changes; full text on subject and reply body, language english. No index on status or priority: four values each, and the primary key scan was enough.
- Search unions subject and reply matches, so each full text index is used. Notes are not searched (R6).
- Model::preventLazyLoading outside production, for Q5.

## Risks / Trade-offs
- A direct status update skips the log → features call these methods; tests in Episodes 33 and 34.
- Each index slows writes a little → only the indexes above.
```

### `openspec/changes/add-change-log-and-indexes/tasks.md`

```markdown
## 1. Migrations (I run these with /new-migration)
- [x] 1.1 ticket_changes table; check the SQL with migrate --pretend
- [x] 1.2 Indexes on tickets, replies and internal_notes; check the SQL, then I run migrate
- [x] 1.3 EXPLAIN the inbox, filter and search queries before and after, on volume data

## 2. Code
- [x] 2.1 TicketChange model; Ticket history, changeStatus, changePriority, assignTo
- [x] 2.2 Ticket search scope
- [x] 2.3 Model::preventLazyLoading outside production

## 3. Tests
- [x] 3.1 A Pest test for every scenario, in tests/Feature/DataModel
- [x] 3.2 Run php artisan test, all green
```

### `database/migrations/2026_10_11_190635_create_ticket_changes_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('field', ['status', 'priority', 'assignee']);
            $table->string('old_value')->nullable();
            $table->string('new_value')->nullable();
            $table->timestamp('created_at');
            $table->index(['ticket_id', 'id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_changes');
    }
};
```

### `database/migrations/2026_10_11_190636_add_indexes_to_tickets_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->index(['customer_id', 'id']);
            $table->index(['assignee_id', 'id']);
            $table->index(['category_id', 'id']);
            $table->fullText('subject')->language('english');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex(['customer_id', 'id']);
            $table->dropIndex(['assignee_id', 'id']);
            $table->dropIndex(['category_id', 'id']);
            $table->dropFullText(['subject']);
        });
    }
};
```

### `database/migrations/2026_10_11_190637_add_indexes_to_replies_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->index(['ticket_id', 'id']);
            $table->fullText('body')->language('english');
        });
    }

    public function down(): void
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->dropIndex(['ticket_id', 'id']);
            $table->dropFullText(['body']);
        });
    }
};
```

### `database/migrations/2026_10_11_190638_add_indexes_to_internal_notes_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->index(['ticket_id', 'id']);
        });
    }

    public function down(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->dropIndex(['ticket_id', 'id']);
        });
    }
};
```

### `app/Models/TicketChange.php`

```php
<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One logged change to a ticket's status, priority or assignee (R11).
 *
 * @property int $id
 * @property string $field
 * @property string|null $old_value
 * @property string|null $new_value
 * @property int|null $user_id
 * @property CarbonImmutable $created_at
 */
#[Fillable(['field', 'old_value', 'new_value'])]
class TicketChange extends Model
{
    /**
     * Log entries are never edited, so there is no updated_at.
     */
    public const UPDATED_AT = null;

    /**
     * @return BelongsTo<Ticket, $this>
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Who made the change. Null when that account was deleted.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```

### `app/Models/Ticket.php` (edits)

```diff
diff --git a/app/Models/Ticket.php b/app/Models/Ticket.php
index 5958135..2605e24 100644
--- a/app/Models/Ticket.php
+++ b/app/Models/Ticket.php
@@ -6,10 +6,13 @@
 use App\Enums\TicketStatus;
 use Database\Factories\TicketFactory;
 use Illuminate\Database\Eloquent\Attributes\Fillable;
+use Illuminate\Database\Eloquent\Attributes\Scope;
+use Illuminate\Database\Eloquent\Builder;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use Illuminate\Database\Eloquent\Relations\HasMany;
+use Illuminate\Support\Facades\DB;
 use InvalidArgumentException;
 
 /**
@@ -36,6 +39,15 @@ class Ticket extends Model
         'priority' => 'normal',
     ];
 
+    /**
+     * Columns whose changes are logged (R11), and their name in the log.
+     */
+    private const LOGGED = [
+        'status' => 'status',
+        'priority' => 'priority',
+        'assignee_id' => 'assignee',
+    ];
+
     protected function casts(): array
     {
         return [
@@ -111,4 +123,89 @@ public function addNote(User $author, string $body): InternalNote
 
         return $note;
     }
+
+    /**
+     * The change log, oldest first.
+     *
+     * @return HasMany<TicketChange, $this>
+     */
+    public function history(): HasMany
+    {
+        return $this->hasMany(TicketChange::class)->orderBy('id');
+    }
+
+    public function changeStatus(User $by, TicketStatus $status): void
+    {
+        $this->status = $status;
+        $this->saveAndLog($by);
+    }
+
+    public function changePriority(User $by, TicketPriority $priority): void
+    {
+        $this->priority = $priority;
+        $this->saveAndLog($by);
+    }
+
+    public function assignTo(User $by, ?User $agent): void
+    {
+        if ($agent !== null && ! $agent->isAgent()) {
+            throw new InvalidArgumentException('Only agents can be assigned.');
+        }
+
+        $this->assignee()->associate($agent);
+        $this->saveAndLog($by);
+    }
+
+    /**
+     * Tickets with all these words in the subject or in a reply (R6).
+     * Internal notes are not searched.
+     *
+     * @param  Builder<Ticket>  $query
+     */
+    #[Scope]
+    protected function search(Builder $query, string $words): void
+    {
+        $query->whereIn('id', Ticket::query()
+            ->select('id')
+            ->whereFullText('subject', $words, ['language' => 'english'])
+            ->union(Reply::query()
+                ->select('ticket_id')
+                ->whereFullText('body', $words, ['language' => 'english'])));
+    }
+
+    /**
+     * Save the ticket and log each changed column, together or not at all.
+     */
+    private function saveAndLog(User $by): void
+    {
+        $changes = [];
+
+        foreach (self::LOGGED as $column => $field) {
+            if ($this->isDirty($column)) {
+                $changes[] = new TicketChange([
+                    'field' => $field,
+                    'old_value' => self::asText($this->getRawOriginal($column)),
+                    'new_value' => self::asText($this->getAttributes()[$column]),
+                ]);
+            }
+        }
+
+        if ($changes === []) {
+            return;
+        }
+
+        DB::transaction(function () use ($by, $changes) {
+            $this->save();
+
+            foreach ($changes as $change) {
+                $change->user()->associate($by);
+                $this->history()->save($change);
+            }
+        });
+    }
+
+    private static function asText(mixed $value): ?string
+    {
+        return $value === null ? null : (string) $value;
+    }
 }
```

### `app/Providers/AppServiceProvider.php` (edit)

```diff
diff --git a/app/Providers/AppServiceProvider.php b/app/Providers/AppServiceProvider.php
index f1525e9..d492fc8 100644
--- a/app/Providers/AppServiceProvider.php
+++ b/app/Providers/AppServiceProvider.php
@@ -3,6 +3,7 @@
 namespace App\Providers;
 
 use Carbon\CarbonImmutable;
+use Illuminate\Database\Eloquent\Model;
 use Illuminate\Support\Facades\Date;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\ServiceProvider;
@@ -33,6 +34,8 @@ protected function configureDefaults(): void
     {
         Date::use(CarbonImmutable::class);
 
+        Model::preventLazyLoading(! app()->isProduction());
+
         DB::prohibitDestructiveCommands(
             app()->isProduction(),
         );
```

### `tests/Feature/DataModel/ChangeLogTest.php`

```php
<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketChange;
use App\Models\User;

test('changing the status logs the old and new value, who and when', function () {
    $this->freezeSecond();
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->changeStatus($agent, TicketStatus::Pending);

    $change = $ticket->history->sole();
    expect($ticket->fresh()->status)->toBe(TicketStatus::Pending)
        ->and($change->only(['field', 'old_value', 'new_value', 'user_id']))
        ->toBe(['field' => 'status', 'old_value' => 'open', 'new_value' => 'pending', 'user_id' => $agent->id])
        ->and($change->created_at->equalTo(now()))->toBeTrue();
});

test('changing the priority is logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->changePriority($agent, TicketPriority::Urgent);

    expect($ticket->history->sole()->only(['field', 'old_value', 'new_value']))
        ->toBe(['field' => 'priority', 'old_value' => 'normal', 'new_value' => 'urgent']);
});

test('assigning and unassigning are both logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->assignTo($agent, $agent);
    $ticket->assignTo($agent, null);

    expect($ticket->history->map->only(['field', 'old_value', 'new_value'])->all())->toBe([
        ['field' => 'assignee', 'old_value' => null, 'new_value' => (string) $agent->id],
        ['field' => 'assignee', 'old_value' => (string) $agent->id, 'new_value' => null],
    ]);
});

test('setting a value the ticket already has logs nothing', function () {
    $ticket = Ticket::factory()->create();

    $ticket->changeStatus(User::factory()->agent()->create(), TicketStatus::Open);

    expect($ticket->history)->toHaveCount(0);
});

test('only agents can be assigned', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    expect(fn () => $ticket->assignTo($agent, $ticket->customer))
        ->toThrow(InvalidArgumentException::class);

    expect($ticket->fresh()->assignee_id)->toBeNull()
        ->and(TicketChange::count())->toBe(0);
});

test('deleting the person who made a change keeps the entry, without them', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $ticket->changePriority($agent, TicketPriority::High);

    $agent->delete();

    $change = TicketChange::sole();
    expect($change->user_id)->toBeNull()
        ->and($change->new_value)->toBe('high');
});

test('deleting a ticket deletes its history', function () {
    $ticket = Ticket::factory()->create();
    $ticket->changeStatus(User::factory()->agent()->create(), TicketStatus::Resolved);

    $ticket->delete();

    expect(TicketChange::count())->toBe(0);
});
```

### `tests/Feature/DataModel/TicketQueriesTest.php`

```php
<?php

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\LazyLoadingViolationException;
use Illuminate\Support\Facades\Schema;

test('the inbox, filter and search indexes exist', function () {
    expect(Schema::hasIndex('tickets', ['customer_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('tickets', ['assignee_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('tickets', ['category_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('tickets', 'tickets_subject_fulltext'))->toBeTrue()
        ->and(Schema::hasIndex('replies', ['ticket_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('replies', 'replies_body_fulltext'))->toBeTrue()
        ->and(Schema::hasIndex('internal_notes', ['ticket_id', 'id']))->toBeTrue()
        ->and(Schema::hasIndex('ticket_changes', ['ticket_id', 'id']))->toBeTrue();
});

test('search finds tickets with every word in the subject', function () {
    Ticket::factory()->create(['subject' => 'Printer offline']);
    $jam = Ticket::factory()->create(['subject' => 'Printer jam on floor two']);

    expect(Ticket::search('printer jam')->pluck('id')->all())->toBe([$jam->id]);
});

test('search finds a word in a reply', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $ticket->addReply($ticket->customer, 'The invoice shows the wrong address.');

    expect(Ticket::search('invoice')->pluck('id')->all())->toBe([$ticket->id]);
});

test('search ignores words that are only in an internal note', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $ticket->addNote(User::factory()->agent()->create(), 'Finance approved a chargeback.');

    expect(Ticket::search('chargeback')->count())->toBe(0);
});

test('search matches other forms of a word', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Refund for order 1042']);

    expect(Ticket::search('refunds')->pluck('id')->all())->toBe([$ticket->id]);
});

test('lazy loading a relationship on a list of tickets throws', function () {
    Ticket::factory()->count(2)->create();

    $tickets = Ticket::all();
    expect(fn () => $tickets->first()->customer)
        ->toThrow(LazyLoadingViolationException::class);

    $tickets = Ticket::with('customer')->get();
    expect($tickets->first()->customer)->toBeInstanceOf(User::class);
});
```

---

## Production notes
- Spoken word count: about 2,980 words, roughly 20 minutes at the Episode 31 pace (2,682 words ran 18:01), plus slide pauses (plan target about 26).
- Illustrated walkthrough, not a recording. No output is shown. Built in /workspace/capstone-throwaway/support-desk (Laravel 13, PHP 8.5, PostgreSQL 17, OpenSpec 1.14.1): the Episode 31 branch was fast-forwarded into main to stand in for the merged pull request, then branch add-change-log-and-indexes.
- Verified SQL (migrate --pretend): create table "ticket_changes" ("id" bigserial not null primary key, "ticket_id" bigint not null, "user_id" bigint null, "field" varchar(255) check ("field" in ('status', 'priority', 'assignee')) not null, "old_value" varchar(255) null, "new_value" varchar(255) null, "created_at" timestamp(0) without time zone not null); foreign keys ticket_id on delete cascade, user_id on delete set null; create index "ticket_changes_ticket_id_id_index". Index migrations: "tickets_customer_id_id_index", "tickets_assignee_id_id_index", "tickets_category_id_id_index", "tickets_subject_fulltext" using gin ((to_tsvector('english', "subject"))), "replies_ticket_id_id_index", "replies_body_fulltext" using gin ((to_tsvector('english', "body"))), "internal_notes_ticket_id_id_index". Then migrate; migrate:rollback --step=4 (all 8 indexes and the table gone) and migrate again.
- EXPLAIN ANALYZE on a fresh support_desk_explain database (seed-volume.sql, explain.sql), before the four migrations: inbox = Index Scan Backward on tickets_pkey; customer = Seq Scan, 99,995 rows removed for 5; status open = tickets_pkey backward, 776 removed; busy agent = tickets_pkey backward, 474 removed; new agent and new category = Seq Scan, 99,998 removed for 2; replies of a ticket = Parallel Seq Scan; search (or) = tickets_pkey walk plus Seq Scan of replies; search (union) = Seq Scans of both tables. After: customer = tickets_customer_id_id_index; new agent and new category = their indexes; replies = replies_ticket_id_id_index; status and busy agent still tickets_pkey; search (or) = tickets_pkey walk with 15,976 rows removed, only replies_body_fulltext used; search (union) = tickets_subject_fulltext and replies_body_fulltext. The same search with the 'simple' configuration fell back to a Seq Scan. Eager-load lookup (users where id in ...) used users_pkey. Timings are not quoted in the script.
- The Laravel search scope's SQL (toRawSql) is: select * from "tickets" where "id" in ((select "id" from "tickets" where (to_tsvector('english', "subject")) @@ plainto_tsquery('english', ?)) union (select "ticket_id" from "replies" where (to_tsvector('english', "body")) @@ plainto_tsquery('english', ?))); the explain.sql union query is the same shape.
- php artisan test: 73 passed (60 + 13). Deliberate breaks: with the isDirty check removed, the change log tests failed; with Model::preventLazyLoading removed, the lazy loading test failed; both restored, 73 passed. Pint, PHPStan (1G memory limit) and vp check pass. openspec validate --strict: valid; archive reported + 7 (ticket-history 4, ticket-queries 3); openspec/specs holds ticket-conversation, ticket-history, ticket-queries, tickets, user-roles. (openspec validate --specs --strict warns that every main spec's Purpose is still the placeholder archive writes; that applies to all five capabilities from Episodes 30 to 32 and is not narrated.)
- Lazy loading: Laravel sets the prevent flag only on models from a query that returned more than one row (Eloquent Builder::hydrate), so the single-ticket lazy loads in the existing tests still pass; the narration says "from a list", which matches.
- Claude was not run: explore, propose and apply are described as the course's reviewed plan and code, not Claude output. The code-reviewer step, git pull and push, gh pr create and CI were not run.
- Laravel facts (laravel.com/docs/13.x): migrations (index with an array of columns makes a compound index, fullText and ->language for PostgreSQL, dropIndex with an array, dropFullText, Schema::hasIndex, migrate --pretend, rollback --step); queries (whereFullText for columns with full text indexes, dumpRawSql); eloquent (CREATED_AT and UPDATED_AT constants, typed string|null; the #[Scope] attribute for local scopes; model events); eloquent-relationships (eager loading runs one query for the parent models and one per relationship; preventLazyLoading with ! isProduction; LazyLoadingViolationException); database (DB::transaction rolls back automatically when the closure throws). Setting UPDATED_AT to null was checked in the throwaway project, as the narration says.
- PostgreSQL facts (postgresql.org/docs/17): ddl-constraints (a foreign key doesn't index the referencing columns; deleting a referenced row scans the referencing table, so indexing them is often a good idea); indexes-multicolumn (most efficient with constraints on the leading columns); indexes-ordering (a B-tree can be scanned backward for ORDER BY DESC); textsearch-tables (only to_tsvector with a configuration name can be used in an expression index); textsearch-indexes (GIN is the preferred text search index type); textsearch-controls (plainto_tsquery normalises words and joins them with AND); queries-limit (use an ORDER BY with a unique order when using LIMIT); using-explain and sql-analyze (EXPLAIN, EXPLAIN ANALYZE, statistics for the planner).
- Logic checks: 4 migrations = rollback --step=4; 8 indexes = 1 + 4 + 2 + 1; 7 requirements (4 + 3), 13 scenarios (3+1+1+2 and 1+4+1), 13 tests; 60 + 13 = 73; 3 + 2 = 5 capabilities; 1 + 25 × 3 = 76 lazy queries at most, 1 + 3 = 4 eager queries at most. R10 is referenced only to say a features episode will call changeStatus.
- YouTube description: 4,114 characters, under the 4,500 target, no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Change Logs and Indexes PostgreSQL Approves: EXPLAIN Before You Index | Laravel 13 | Agentic Engineering Ep 32
2. Don't Guess Where the Index Goes: Data Modeling with Claude Code and OpenSpec | Ep 32
3. Capstone, Data Modeling Part 3 | Agentic Engineering Ep 32

### Description (ready to paste, 4,114 characters)

```
Episode 32 of Agentic Engineering, a free course on agentic coding.
Support Desk data modeling, part 3: a change log (R11) and indexes for the inbox, filters and search (R4 to R6, Q5), chosen with EXPLAIN on 100,000 fake tickets. 13 new tests on PostgreSQL.
Screens are drawn illustrations; no output is shown. Files are written for the course.

Prompts:
/opsx:explore The change log (R11) and the queries behind R3 to R6 and Q5 in docs/requirements.md. Read the Ticket model and the migrations first. Ask me one question at a time about the log's shape, who records a change, which queries need indexes, and search.

/opsx:propose add-change-log-and-indexes: the change log and indexes as decided. Data layer only: migrations, TicketChange model, Ticket methods, search scope, lazy loading off outside production, tests. No policies, screens or R10 rules. Task group 1 is the migrations and EXPLAIN; I do those myself.

/new-migration create ticket_changes: ticket (cascade on delete), nullable user (null on delete), field (status, priority or assignee), nullable old_value and new_value strings, created_at only, index on ticket_id and id

/new-migration add indexes to tickets: customer_id and id, assignee_id and id, category_id and id, full text on subject in english

/new-migration add indexes to replies: ticket_id and id, full text on body in english

/new-migration add indexes to internal_notes: ticket_id and id

/clear, then /opsx:apply add-change-log-and-indexes
Use the code-reviewer subagent to review this change.
/opsx:archive add-change-log-and-indexes

Commands:
git switch main && git pull
git switch -c add-change-log-and-indexes
openspec validate add-change-log-and-indexes --strict
git add openspec && git commit -m "Plan: add-change-log-and-indexes"
psql -U postgres -c "CREATE DATABASE support_desk_explain OWNER support_desk;"
DB_DATABASE=support_desk_explain php artisan migrate
psql -U support_desk support_desk_explain -f seed-volume.sql
psql -U support_desk support_desk_explain -f explain.sql
php artisan migrate
php artisan migrate:rollback --step=4
php artisan migrate
DB_DATABASE=support_desk_explain php artisan migrate
psql -U support_desk support_desk_explain -f explain.sql
php artisan test
git add -A && git commit -m "Add change log, indexes and search"
git push -u origin add-change-log-and-indexes
gh pr create --fill

SQL scripts, summarised (one uses a less-than sign). seed-volume.sql, local copy only: generate_series makes 20,000 customers, 20 agents, 10 categories, 100,000 tickets (mostly closed) with 3 replies each, plus a new agent and a new category on the 2 oldest tickets. explain.sql runs EXPLAIN ANALYZE on: the inbox (order by id desc limit 25), one customer's tickets, status open, a busy agent, the new agent, the new category, a ticket's replies, and search written with or, then with union.

Spec: ticket-history (logged changes, unchanged values, assignees, history and deletes) and ticket-queries (query indexes, search, no lazy loading). 7 requirements, 13 scenarios; a customer as assignee is refused.

Plan: proposal covers R11, R4, R5, R6, Q5, not policies, R10 or screens. Design: one ticket_changes table; Ticket methods log in one transaction, skip unchanged values; inbox by id desc; no status or priority index; search as a union. Tasks: migrations and EXPLAIN (me), code, tests.

Code, summarised (PHP arrows can't go in a description): ticket_changes has a ticket (cascade), a nullable user (set null), field (status, priority or assignee, with a check), nullable old_value and new_value, created_at only, and an index on ticket_id, id. New indexes: tickets (customer_id, id), (assignee_id, id), (category_id, id), full text on subject; replies (ticket_id, id), full text on body; internal_notes (ticket_id, id). TicketChange: UPDATED_AT null. Ticket: history, changeStatus, changePriority, assignTo (agents only), each in a DB::transaction; search scope = subject matches union reply matches. Model::preventLazyLoading outside production. Tests: 7 + 6; 73 in the suite.

Next in the playlist: Episode 33, Capstone, Core Features Part 1.
```

---

## Slide list

| # | Slide | Notes |
|---|---|---|
| 1 | title slide | title |
| 2 | Three parts | agenda |
| 3 | 01 · Plan the log and the queries | divider |
| 4 | Where we left off | panel |
| 5 | Three things to log | squares |
| 6 | Explore first | monitor (Illustration) |
| 7 | Four questions | 4num |
| 8 | One log or three? | two |
| 9 | Who writes the entry? | card (Illustration) |
| 10 | Rules for an entry | phone (Illustration) |
| 11 | Deletes, again | plan (Illustration) |
| 12 | Ask, don't guess | two-points (Illustration) |
| 13 | Propose the change | monitor (Illustration) |
| 14 | Review in order | flow |
| 15 | 02 · Migrations and EXPLAIN | divider |
| 16 | ticket_changes | phone (Illustration) |
| 17 | Read the SQL | plan (Illustration) |
| 18 | A copy with volume | monitor (Illustration) |
| 19 | Before: EXPLAIN said | card (Illustration) |
| 20 | Busy agent, new agent | two |
| 21 | Index migrations | phone (Illustration) |
| 22 | Why the id at the end? | two-points (Illustration) |
| 23 | Same expression | plan (Illustration) |
| 24 | After: EXPLAIN | card (Illustration) |
| 25 | Run, roll back, run | flow |
| 26 | 03 · Code and tests | divider |
| 27 | Ticket gets new methods | squares |
| 28 | Saved together | panel |
| 29 | Search: union, not or | two-points (Illustration) |
| 30 | 13 new tests | 4num |
| 31 | Q5: no N + 1 | squares |
| 32 | Review, archive, merge | flow |
| 33 | Data layer done | two |
| 34 | quote slide | quote |
| 35 | recap slide | recap |
| 36 | Next in the playlist | closer |

---

## Sources
- Laravel: https://laravel.com/docs/13.x/migrations, /queries, /eloquent, /eloquent-relationships, /database
- PostgreSQL: https://www.postgresql.org/docs/17/ddl-constraints.html, /indexes-multicolumn.html, /indexes-ordering.html, /textsearch-tables.html, /textsearch-indexes.html, /textsearch-controls.html, /queries-limit.html, /using-explain.html, /sql-analyze.html
- OpenSpec 1.14.1: generated instructions (openspec instructions), README
- Claude Code: https://code.claude.com/docs/en/skills, /sub-agents, /hooks
- Course: Episode 28 (requirements), Episodes 29 to 31 (setup, core data model, conversation), Episode 19 (database-conventions and new-migration skills), Episodes 23 to 25 (OpenSpec)
