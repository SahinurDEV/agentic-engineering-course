# Day 32 · Episode 31: Capstone, Data Modeling Part 2

**Series:** Agentic Engineering (free YouTube course) · Module 13
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 26:00 in the plan; final video 18:01 (1081.0 s), times below are the real slide times
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 13 lesson):** Data Modeling 2, first half (public replies and internal notes)

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Claude, OpenSpec, Laravel, git or test output is shown. The OpenSpec change (proposal, delta spec, design, tasks), the prompts, the migrations, models, factories, Ticket edits and tests are **written for the course**; the plan files are the reviewed versions, not something Claude produced on camera. All of it was built and run once in a throwaway copy of the project on PostgreSQL 17 on 10 October 2026 (migrate --pretend, migrate, rollback and migrate again, the full test suite, a deliberate break of the order test, Pint, PHPStan, the kit's format and lint checks, openspec validate --strict and archive); none of that output appears in the video.

**Split of the three data-modeling episodes (unchanged from Episode 30):** Ep30 = roles, categories, tickets. Ep31 (this one) = public replies (R7) and internal notes (R8). Ep32 = the change log (R11) and the indexes for the inbox, filters and search (R4, R5, R6, Q5).

**Counts drawn on slides (checked against the files and the throwaway project):** new tables: 2 (replies, internal_notes), same 5 columns each (id, ticket_id, author_id, body, timestamps counted as one). Explore questions: 4. Foreign keys per table: 2 (ticket cascade, author set null), 4 in total. Migrations: 2. Models: 2. Ticket additions: 2 relationships, 2 helpers. Capability: 1 (ticket-conversation) with 5 requirements and 7 scenarios; archive reported 5 added; openspec/specs now holds 3 capabilities. Task groups: 3. Tests: ConversationTest 8 new; suite 52 + 8 = 60, all passing on PostgreSQL. Task 1 migrations rollback: 2 steps.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:32 | [VOICEOVER + SLIDE] | Hook |
| 0:32–1:13 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:13–8:28 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 1 · Plan the conversation |
| 8:28–11:33 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Two migrations, reviewed |
| 11:33–17:19 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Models and tests |
| 17:19–18:01 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:32 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode, the Support Desk got roles, categories, and tickets. But a ticket nobody can answer is just a complaint in a database.
> Today we add the conversation: public replies, and internal notes that customers must never see. Not by remembering a rule every time, but because of how the data is shaped.

**Visual / B-roll:**
- Title card.

### 0:32–1:13 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode thirty-one: capstone, data modeling part two.

*Cue: agenda slide "Three parts"*
> Three parts. First, plan the conversation: explore four questions, the biggest being one table or two, and turn the answers into an OpenSpec change. Second, two migrations, reviewed: SQL read before it runs, and the rollback checked. Third, models and tests, including a test I deliberately broke to prove it can fail.
> As always, this is an illustrated walkthrough, not a recording. I built and ran all of it once in a throwaway copy of the project, on PostgreSQL, and every test passed there. No output is shown. The plan files and prompts are in the description, and the code is summarised there.

**Visual / B-roll:**
- Three items: 01 Plan the conversation · 02 Two migrations · 03 Models and tests.

### 1:13–8:28 · Part 1: Plan the conversation
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "01 · Plan the conversation"*
> Part one. Plan the conversation.

*Cue: panel "Where we left off"*
> Where we left off. Episode thirty gave us three tables: a role on users, categories, and tickets with their seven fields. Status, priority and role are string columns, var-chars, with check constraints, so PostgreSQL refuses any value outside the list. Two capabilities are archived in openspec slash specs: user roles, and tickets. And fifty-two tests pass.
> Today's slice is R seven and R eight. R seven: customers and agents add public replies to a ticket. R eight: agents add internal notes that customers never see. And R three adds the hard edge: a customer sees only their own tickets, and never internal notes.

*Cue: squares "Two kinds of message"*
> So a ticket gets two kinds of message.
> A reply is public. The customer writes one, an agent answers, and both sides read the whole thread.
> A note is internal. Only agents write them, and only agents read them. Things like: refund approved by finance, or this customer has reported the same bug before.
> They look almost the same: some text, an author, a time. That similarity is exactly what makes the next decision dangerous.

*Cue: monitor "Explore first"*
> As in episode thirty, I start with slash O P S X explore, because the choices aren't obvious yet. Explore is for thinking: Claude reads the code and talks it through, but writes no code.
> The prompt names R seven and R eight from docs slash requirements dot m d, asks Claude to read the tickets migration and the Ticket model first, and asks for one question at a time about four areas: one table or two, authors, deletes, and order.
> The prompt is written for the course and printed in the description. What follows are the four questions, and the answers I settled on.

*Cue: 4num "Four questions"*
> Four questions.
> One: do replies and notes share one table, or get one each? Two: who sets the author, and can a request change it? Three: what survives a delete, of a ticket, or of a user? Four: in what order do messages come back?
> The first one decides how safe R three is for the rest of the project. So let's take it slowly.

*Cue: two columns "One table or two?"*
> Option one: a single messages table, with a flag, say is internal, true or false. It's compact. One model, one list per ticket, and the agent's timeline comes out in one query.
> Option two: two tables. Replies in one, internal notes in the other, with the same columns.
> The cost of option one is a rule you must remember forever. Every query that shows messages to a customer needs where is internal is false. Forget it once, in one controller, one export, one email in a later version, and a private note reaches a customer.
> The cost of option two is a little duplication, and the agent's timeline merges two lists.

*Cue: card "Why two tables wins here"*
> I chose two tables. The reason is how Laravel serialises models. The docs say that when a model becomes JSON, its loaded relationships come along automatically. With two tables, a customer page loads the replies relationship, and there is no path from replies to a note. The safe query is the only query.
> With one table, the same page would load a relationship that contains notes, unless someone remembered the filter. Laravel's global scopes could add that filter automatically, but then agent code has to switch it off again, and the rule just moves.
> Two tables don't replace policies. Episodes thirty-three and thirty-four still add policies, and a test that a customer's page never shows a note. But the data shape makes the mistake much harder to make.

*Cue: phone "The author, set in code"*
> Question two: the author. Each reply and note has an author id, pointing at users. Should it be fillable?
> No, for the same reason role wasn't, last episode. The Laravel docs say that attributes that aren't fillable are silently discarded during mass assignment. So if a crafted form sends author id equals some agent, it's simply dropped, and nobody can post as someone else.
> Instead, the app sets the author in code. Two helpers on Ticket, add reply and add note, take the author as a User, and attach it with the associate method from the docs. Controllers in the features episodes will call those helpers with the signed-in user.

*Cue: plan "Deletes: two answers"*
> Question three: deletes. Each table has two foreign keys, and each gets an answer.
> The ticket. If a ticket is deleted, its replies and notes mean nothing without it, so that key cascades. That also covers a customer deleting their account: last episode, their tickets cascade, and now their tickets' messages go with them.
> The author. If an agent's account is deleted, the customer's conversation shouldn't lose half its messages. So the author key is nullable, and set to null. The messages stay, and the screens in later episodes can show them as from a deleted user.

*Cue: two-points "Order: id, not time"*
> Question four sounds trivial: messages come back oldest first, right?
> Two details make it less trivial. First, Laravel's timestamps on PostgreSQL are whole seconds; we'll see it in the SQL in part two. Two quick replies can share the same created at, so ordering by time alone can tie. Second, the PostgreSQL docs say that without an order by, rows come back in an unspecified order, and it must not be relied on.
> So the relationships order by id. Ids only grow, so id order is the order the messages were written.

*Cue: monitor "Propose"*
> With the decisions made, back on main, pull the merged episode thirty work, and make a branch: add ticket conversation.
> Then slash O P S X propose add ticket conversation. Replies and internal notes, as decided. Data layer only: migrations, models, factories, Ticket helpers, and tests. No policies, no screens, no R ten rules, and no indexes. And task group one is the two migrations, which I create myself with the new migration skill.
> Propose writes the plan and stops.

*Cue: flow "Review in order"*
> I review in the same order as last time. The proposal: it names R seven, R eight and R three, and its out of scope line keeps policies, the closed ticket rule from R ten, screens, the change log and indexes out.
> The spec: one new capability, ticket conversation, with five requirements: public replies, notes apart from replies, note authors, order, and authors and deletes. Seven scenarios in total, and our config's rule asks for a refusal, so there's one: a customer as the author of a note is refused.
> The design records the four decisions with their alternatives. The tasks have three groups. Then openspec validate, strict, and I commit the plan.

### 8:28–11:33 · Part 2: Two migrations, reviewed
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Two migrations"*
> Part two. Two migrations, reviewed.

*Cue: phone "/new-migration: replies"*
> First, slash new migration, create replies: a ticket that cascades on delete, a nullable author on users that's set to null on delete, a body as text, and timestamps.
> As in episode thirty, the skill is started only by me, writes the migration with an up and a down, runs migrate dash dash pretend, and stops. Its down method drops the table, which fully reverses the up.
> The ticket key uses foreign id and constrained, so Laravel works out the tickets table from the column name. The author key names users, because author isn't a table.

*Cue: plan "Read the SQL"*
> Now the SQL, line by line. A create table for replies with an id, a ticket id that's not null, an author id that is null, a body as text, and two timestamp columns with a precision of zero, so whole seconds.
> Then two foreign key statements. Replies to tickets, on delete cascade. Replies to users, on delete set null.
> That's what I asked for. And that zero precision is the detail behind ordering by id. It's in the SQL, so I'm not guessing.

*Cue: squares "Same shape, twice"*
> Second: slash new migration, create internal notes, with the same columns as replies.
> The SQL matches column for column: ticket, author, body, timestamps. And two foreign keys again, cascade and set null.
> Why not reuse one migration for both? Because each table should be created, changed and dropped on its own. If notes need a new column next year, only one table changes.

*Cue: card "What the SQL shows"*
> So across both migrations, here's the count. Two tables. Each with five parts: id, ticket, author, body, and timestamps. Four foreign keys: two that cascade, two that set null.
> And what's deliberately not there: no flag column for internal. The separation is the table itself.

*Cue: monitor "Run, roll back, run"*
> I run them myself: php artisan migrate. Then, on my machine only, migrate rollback with step two, and migrate again. Both down methods work, and both tables come back exactly the same.
> Then I tick group one in tasks dot m d. And the full test suite still passes, because nothing existing changed: these are two new tables beside the old ones.

*Cue: two columns "Still not here"*
> And what's still missing, on purpose?
> Indexes. Loading a ticket's replies filters by ticket id, and as we saw last time, PostgreSQL doesn't create an index for a foreign key on its own. Those indexes come in episode thirty-two, with the inbox and search queries.
> And rules about who may do what. A customer replying on someone else's ticket, an agent replying on a closed ticket from R ten: those are policies and feature rules, in episodes thirty-three and thirty-four. The data layer gives them the right shape to stand on.

### 11:33–17:19 · Part 3: Models and tests
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Models and tests"*
> Part three. Models and tests.

*Cue: flow "Clear, then apply"*
> Slash clear, then slash O P S X apply add ticket conversation. Apply skips group one, which I ticked, and works through the models, the factories, and then the tests. The hooks from module eight run as it works: Pint formats each PHP file, and the Stop hook runs the tests before Claude finishes.

*Cue: phone "Two small models"*
> Group two. Reply and InternalNote are two small models. Each has body as its only fillable field, and two relationships: it belongs to a ticket, and it belongs to an author, which is the User model with the author id column.
> The factories make them easy to use in tests. A reply factory creates its own ticket and author, and the internal note factory's author is an agent, because only agents write notes.

*Cue: squares "Ticket gets four methods"*
> Ticket gets four methods.
> Two relationships: replies, and internal notes. Both are has many, ordered by id. The Laravel docs say relationships also serve as query builders, so the order by is part of the relationship, and every caller gets the right order for free.
> And two helpers: add reply and add note. Each creates the message with its body, associates the author and the ticket, saves it, and returns it.

*Cue: panel "Notes: agents only"*
> Add note has one more line. If the author isn't an agent, it throws an invalid argument exception, and nothing is saved. Remember is agent from last episode: true for agents and for admins, so admins can write notes too.
> Is this a policy? Not quite. Policies answer whether this user may do this, right now, in a request. This is a fact about the data: a note written by a customer makes no sense, whoever calls the code. The policies in the features episodes will check first, and this line is the backstop.

*Cue: 4num "Eight new tests"*
> Group three: tests, in one new file, the conversation test in tests slash Feature slash DataModel. Eight tests.
> Customers and agents both add public replies. Replies never include internal notes. Agents and admins can write notes. Customers can't. Replies stay in the order they were written, even after an edit. A request can't choose the author. Deleting a ticket deletes its replies and notes. And deleting an author keeps their messages, without an author.
> Seven scenarios in the spec, eight tests, because agents and admins writing notes gets its own test. With the fifty-two from before, the suite has sixty, and in my throwaway project all sixty passed on PostgreSQL.

*Cue: card "A test that can fail"*
> One of these deserves a closer look: the order test. A naive version creates two replies and checks they come back in order. On a fresh table, PostgreSQL usually returns them in insert order anyway, so that test would pass even without the order by. It proves nothing.
> So the real test edits the first reply after the second exists. In PostgreSQL, an update writes a new version of the row, and the old order on disk is no longer the order they were written.
> I checked it the honest way. In the throwaway project, I removed the order by, ran the test, and it failed: the edited reply came back last. I put the order by back, and it passed. A test you've never seen fail is a test you're trusting blindly.

*Cue: two-points "The leak test"*
> The other key test is the leak test. It gives a ticket one reply and one note, then loads the replies and turns the ticket into JSON, the way a page would receive it.
> Two checks. The replies hold exactly one message. And the JSON doesn't contain the note's text anywhere.
> It's a small test, but it pins the decision from part one. If someone later merges the tables to save a few lines, this test is where they find out why we didn't.

*Cue: plan "Review, then archive"*
> Then the code reviewer subagent reviews the diff against the change: a test for every scenario, nothing outside the change, and php artisan test. It reports; it never edits.
> Then slash O P S X archive. The change moves into the archive folder, and its five requirements merge into the main specs. openspec slash specs now holds three capabilities: user roles, tickets, and ticket conversation.

*Cue: flow "Done means"*
> And the same finish line as last time. Commit on the branch, push, open the pull request with g h pr create, dash dash fill, let CI run all the migrations from scratch and the tests on PostgreSQL, then review and merge.

*Cue: two-points "Your turn"*
> Your turn, before the next episode.
> One: find a place in your own project where public and private data share a table, and list every query that has to remember the filter. That list is your risk.
> Two: pick one test of yours that checks an order, remove the order by it depends on, and run it. If it still passes, it isn't testing what you think.

*Cue: two columns "Ready for the log"*
> Where does that leave us? Two new tables, replies and internal notes, with authors set in code and history that survives a deleted account. Messages in the order they were written. Eight new tests, including one I've seen fail. And three capabilities in the specs.
> Next: the last data modeling slice. The change log for R eleven, so every status, priority and assignee change is recorded with who and when. And the indexes the inbox, the filters and search need, chosen from the actual queries.

### 17:19–18:01 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> Make the safe query the only query.

*Cue: recap slide*
> Quick recap.
> Two tables, not one with a flag, so loading replies can never pick up a note.
> Authors set in code, never by a request, and messages that survive a deleted author but not a deleted ticket.
> Order by id, because timestamps tie and PostgreSQL promises no order without one.
> Two reviewed migrations, eight new tests, one archived change, and a pull request.

*Cue: closer slide "Next in the playlist"*
> Next in the playlist: episode thirty-two, capstone, data modeling part three. The change log, and the indexes, chosen from real queries. See you there.

---

## Example files (written for the course)

All files were run in the throwaway project. The plan files, prompts and commands are free of `<` and `>` and go into the description as they are. The PHP files contain `<?php`, `->` and `=>`, so the description summarises them; the full code is here. Migration file names start with the timestamp from `make:migration`; yours will differ.

### Prompts (typed into Claude Code)

```text
/opsx:explore Replies and internal notes (R7, R8) in docs/requirements.md. Read the tickets migration and the Ticket model first. Ask me one question at a time about one table or two, authors, deletes, and order.

/opsx:propose add-ticket-conversation: replies and internal notes as decided. Data layer only: migrations, models, factories, Ticket helpers, tests. No policies, screens, R10 rules or indexes. Task group 1 is the two migrations; I create them with /new-migration.

/new-migration create replies: ticket (cascade on delete), nullable author on users (null on delete), body text, timestamps

/new-migration create internal_notes: the same columns as replies

/clear, then /opsx:apply add-ticket-conversation
Use the code-reviewer subagent to review this change.
/opsx:archive add-ticket-conversation
```

### Commands (typed in the terminal)

```text
git switch main && git pull
git switch -c add-ticket-conversation
openspec validate add-ticket-conversation --strict
git add openspec && git commit -m "Plan: add-ticket-conversation"
php artisan migrate
php artisan migrate:rollback --step=2
php artisan migrate
php artisan test
git add -A && git commit -m "Add replies and internal notes"
git push -u origin add-ticket-conversation
gh pr create --fill
```

### `openspec/changes/add-ticket-conversation/proposal.md`

```markdown
## Why
Customers and agents talk on a ticket, and agents need private notes. Covers the data side of R7 (public replies), R8 (internal notes) and R3 (customers never see notes).

## What Changes
- New replies table: public messages on a ticket.
- New internal_notes table, kept apart from replies.
- Ticket helpers that set the author in code.

## Capabilities
### New Capabilities
- `ticket-conversation`: replies and internal notes on a ticket.

## Out of scope
Who may reply or read notes (policies), closed tickets taking no replies and status changes on reply (R10), screens, the change log and indexes.

## Impact
Two migrations, two models, factories, Ticket helpers, tests.
```

### `openspec/changes/add-ticket-conversation/specs/ticket-conversation/spec.md`

```markdown
## ADDED Requirements

### Requirement: Public replies
A ticket SHALL have public replies, each with a body and an author.

#### Scenario: Both sides reply
- **WHEN** the customer and an agent each reply
- **THEN** the ticket has two replies, with those authors

### Requirement: Notes apart from replies
Internal notes SHALL be stored apart from replies, so a ticket's replies never include a note.

#### Scenario: Ticket with both
- **WHEN** a ticket has a reply and a note
- **THEN** its replies hold only the reply

### Requirement: Note authors
Only an agent SHALL write an internal note. An admin counts as an agent.

#### Scenario: Customer writes a note
- **WHEN** a customer is the author of a note
- **THEN** the note is refused

### Requirement: Order
Replies and notes SHALL be listed in the order they were written.

#### Scenario: Edited reply
- **WHEN** an older reply is edited
- **THEN** it keeps its place

### Requirement: Authors and deletes
The author SHALL be set by the app, never by request input. A deleted ticket's replies and notes SHALL be deleted. A deleted author's replies and notes SHALL stay, with no author.

#### Scenario: Input sends an author
- **WHEN** reply input includes an author
- **THEN** it is ignored

#### Scenario: Author deleted
- **WHEN** an agent who replied is deleted
- **THEN** the reply stays, with no author

#### Scenario: Ticket deleted
- **WHEN** a ticket is deleted
- **THEN** its replies and notes are deleted
```

### `openspec/changes/add-ticket-conversation/design.md`

```markdown
## Decisions
- Two tables, replies and internal_notes, not one table with an is_internal flag. A customer page that loads replies cannot pick up a note by mistake. Alternative: one table, and a where clause everywhere it's read.
- Same columns in both: ticket, nullable author, body, timestamps.
- Ticket cascades; author becomes null, so history survives a deleted account.
- author_id is not fillable. addReply and addNote set it, and addNote refuses customers.
- Order by id: timestamps are whole seconds, and Postgres doesn't promise row order without an order by.

## Risks / Trade-offs
- The agent timeline merges two lists → done in the view in Episode 34.
- No index on ticket_id yet → Episode 32.
```

### `openspec/changes/add-ticket-conversation/tasks.md`

```markdown
## 1. Migrations (I run these with /new-migration)
- [ ] 1.1 Replies table; check the SQL with migrate --pretend
- [ ] 1.2 Internal notes table; check the SQL, then I run migrate

## 2. Models
- [ ] 2.1 Reply and InternalNote models with ticket and author
- [ ] 2.2 Ticket: replies and internalNotes ordered by id; addReply and addNote
- [ ] 2.3 ReplyFactory and InternalNoteFactory

## 3. Tests
- [ ] 3.1 A Pest test for every scenario, in tests/Feature/DataModel
- [ ] 3.2 Run php artisan test, all green
```

### `database/migrations/2026_10_10_042336_create_replies_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
```

### `database/migrations/2026_10_10_042337_create_internal_notes_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internal_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internal_notes');
    }
};
```

### `app/Models/Reply.php`

```php
<?php

namespace App\Models;

use Database\Factories\ReplyFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $body
 * @property int|null $author_id
 */
#[Fillable(['body'])]
class Reply extends Model
{
    /** @use HasFactory<ReplyFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<Ticket, $this>
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Null when the author's account was deleted.
     *
     * @return BelongsTo<User, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
```

### `app/Models/InternalNote.php`

```php
<?php

namespace App\Models;

use Database\Factories\InternalNoteFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $body
 * @property int|null $author_id
 */
#[Fillable(['body'])]
class InternalNote extends Model
{
    /** @use HasFactory<InternalNoteFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<Ticket, $this>
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Null when the author's account was deleted.
     *
     * @return BelongsTo<User, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
```

### `database/factories/ReplyFactory.php`

```php
<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reply>
 */
class ReplyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'body' => fake()->paragraph(),
            'ticket_id' => Ticket::factory(),
            'author_id' => User::factory(),
        ];
    }
}
```

### `database/factories/InternalNoteFactory.php`

```php
<?php

namespace Database\Factories;

use App\Models\InternalNote;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InternalNote>
 */
class InternalNoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'body' => fake()->paragraph(),
            'ticket_id' => Ticket::factory(),
            'author_id' => User::factory()->agent(),
        ];
    }
}
```

### `app/Models/Ticket.php` (edits)

```diff
diff --git a/app/Models/Ticket.php b/app/Models/Ticket.php
index 4f00382..5958135 100644
--- a/app/Models/Ticket.php
+++ b/app/Models/Ticket.php
@@ -9,6 +9,8 @@
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
+use Illuminate\Database\Eloquent\Relations\HasMany;
+use InvalidArgumentException;
 
 /**
  * @property int $id
@@ -65,4 +67,48 @@ public function assignee(): BelongsTo
     {
         return $this->belongsTo(User::class, 'assignee_id');
     }
+
+    /**
+     * Public replies, oldest first. Never includes internal notes.
+     *
+     * @return HasMany<Reply, $this>
+     */
+    public function replies(): HasMany
+    {
+        return $this->hasMany(Reply::class)->orderBy('id');
+    }
+
+    /**
+     * Internal notes, oldest first. Kept apart from replies.
+     *
+     * @return HasMany<InternalNote, $this>
+     */
+    public function internalNotes(): HasMany
+    {
+        return $this->hasMany(InternalNote::class)->orderBy('id');
+    }
+
+    public function addReply(User $author, string $body): Reply
+    {
+        $reply = new Reply(['body' => $body]);
+        $reply->author()->associate($author);
+        $reply->ticket()->associate($this);
+        $reply->save();
+
+        return $reply;
+    }
+
+    public function addNote(User $author, string $body): InternalNote
+    {
+        if (! $author->isAgent()) {
+            throw new InvalidArgumentException('Only agents can write internal notes.');
+        }
+
+        $note = new InternalNote(['body' => $body]);
+        $note->author()->associate($author);
+        $note->ticket()->associate($this);
+        $note->save();
+
+        return $note;
+    }
 }
```

### `tests/Feature/DataModel/ConversationTest.php`

```php
<?php

use App\Models\InternalNote;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;

test('customers and agents both add public replies', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $ticket->addReply($ticket->customer, 'It still fails.');
    $ticket->addReply($agent, 'Try the new link.');

    expect($ticket->replies->pluck('author_id')->all())->toBe([$ticket->customer->id, $agent->id]);
});

test('replies never include internal notes', function () {
    $ticket = Ticket::factory()->create();
    $ticket->addReply($ticket->customer, 'Any news?');
    $ticket->addNote(User::factory()->agent()->create(), 'Refund approved by finance.');

    $json = $ticket->load('replies')->toJson();

    expect($ticket->replies)->toHaveCount(1)
        ->and($json)->not->toContain('Refund approved by finance.');
});

test('agents and admins can write internal notes', function () {
    $ticket = Ticket::factory()->create();

    $ticket->addNote(User::factory()->agent()->create(), 'Checked the logs.');
    $ticket->addNote(User::factory()->admin()->create(), 'Escalated.');

    expect($ticket->internalNotes)->toHaveCount(2);
});

test('customers cannot write internal notes', function () {
    $ticket = Ticket::factory()->create();

    expect(fn () => $ticket->addNote($ticket->customer, 'Let me in.'))
        ->toThrow(InvalidArgumentException::class);
    expect(InternalNote::count())->toBe(0);
});

test('replies stay in the order they were written, even after an edit', function () {
    $ticket = Ticket::factory()->create();
    $first = $ticket->addReply($ticket->customer, 'first');
    $ticket->addReply($ticket->customer, 'second');

    $first->update(['body' => 'first, edited']);

    expect($ticket->replies()->pluck('body')->all())->toBe(['first, edited', 'second']);
});

test('a request cannot choose the author', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $reply = $ticket->replies()->create(['body' => 'Hello', 'author_id' => $agent->id]);

    expect($reply->author_id)->toBeNull();
});

test('deleting a ticket deletes its replies and notes', function () {
    $ticket = Ticket::factory()->create();
    $ticket->addReply($ticket->customer, 'Hello');
    $ticket->addNote(User::factory()->agent()->create(), 'Internal');

    $ticket->delete();

    expect(Reply::count())->toBe(0)
        ->and(InternalNote::count())->toBe(0);
});

test('deleting an author keeps their replies and notes, without an author', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $reply = $ticket->addReply($agent, 'On it.');
    $note = $ticket->addNote($agent, 'Customer is a VIP.');

    $agent->delete();

    expect($reply->fresh()->author_id)->toBeNull()
        ->and($note->fresh()->author_id)->toBeNull();
});
```

---

## Production notes
- Spoken word count: about 2,682 words, roughly 17.9 minutes at a steady TTS pace, plus slide pauses (plan target about 26).
- Illustrated walkthrough, not a recording. No output is shown. The throwaway project from Episodes 29 and 30 was lost when the box restarted (it lived in /tmp), so it was rebuilt first: same installer flags, the Episode 29 edits, the Episode 30 course files and specs; the 52 tests passed again before this episode's work. Rebuilt in /workspace/capstone-throwaway/support-desk, branch add-ticket-conversation (Laravel 13, PHP 8.5, PostgreSQL 17, OpenSpec 1.14.1).
- Verified SQL (migrate --pretend): create table "replies" ("id" bigserial not null primary key, "ticket_id" bigint not null, "author_id" bigint null, "body" text not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null); foreign key ("ticket_id") references "tickets" ("id") on delete cascade; foreign key ("author_id") references "users" ("id") on delete set null. internal_notes: identical. Then migrate; migrate:rollback --step=2 and migrate again; php artisan test 60 passed (52 + 8); with orderBy('id') removed from replies(), the order test failed (second came back before "first, edited"), then passed again with it restored; Pint, PHPStan (1G memory limit) and vp check pass; openspec validate --strict valid; archive reported 5 added; openspec/specs holds ticket-conversation, tickets, user-roles.
- Consistency with Episode 30: enum columns are described as string (varchar) columns with check constraints.
- Claude was not run: explore, propose and apply are described as the course's reviewed plan and code, not Claude output. The code-reviewer step, git pull and push, gh pr create and CI were not run.
- Laravel facts (laravel.com/docs/13.x): eloquent (non-fillable attributes are silently discarded during mass assignment); eloquent-relationships (hasMany, belongsTo with a custom key, associate, relationships also serve as query builders); eloquent-serialization (loaded relationships are included automatically when a model is converted to JSON; toArray is recursive); eloquent (global scopes); migrations (foreignId()->constrained(), constrained('users'), cascadeOnDelete, nullOnDelete, migrate --pretend, rollback --step).
- PostgreSQL facts: "If sorting is not chosen, the rows will be returned in an unspecified order... it must not be relied on" (docs/current/queries-order.html); foreign keys don't create an index on the referencing columns (ddl-constraints, as in Episode 30). The claim that an update writes a new row version is standard PostgreSQL MVCC, and was observed in the deliberate break above.
- Logic checks: 2 tables × 2 foreign keys = 4 (2 cascade, 2 set null); 5 requirements, 7 scenarios (1 + 1 + 1 + 1 + 3); 8 tests (each scenario covered, plus agents and admins writing notes); 52 + 8 = 60; 3 task groups; rollback --step=2 matches 2 migrations; 3 capabilities after archive. R10 is referenced only to say its reply rules are features (Episode 34).
- YouTube description: 4,026 characters, under the 4,500 target, no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Public Replies vs Internal Notes: One Table or Two? Laravel 13 + PostgreSQL | Agentic Engineering Ep 31
2. Make the Safe Query the Only Query: Data Modeling with Claude Code and OpenSpec | Ep 31
3. Capstone, Data Modeling Part 2 | Agentic Engineering Ep 31

### Description (ready to paste, 4,026 characters)

```
Episode 31 of Agentic Engineering, a free course on agentic coding.
Support Desk data modeling, part 2: public replies and internal notes. One table or two, authors set in code, order by id, 8 new tests on PostgreSQL.
Screens are drawn illustrations; no output is shown. Files are written for the course.

Prompts:
/opsx:explore Replies and internal notes (R7, R8) in docs/requirements.md. Read the tickets migration and the Ticket model first. Ask me one question at a time about one table or two, authors, deletes, and order.

/opsx:propose add-ticket-conversation: replies and internal notes as decided. Data layer only: migrations, models, factories, Ticket helpers, tests. No policies, screens, R10 rules or indexes. Task group 1 is the two migrations; I create them with /new-migration.

/new-migration create replies: ticket (cascade on delete), nullable author on users (null on delete), body text, timestamps

/new-migration create internal_notes: the same columns as replies

/clear, then /opsx:apply add-ticket-conversation
Use the code-reviewer subagent to review this change.
/opsx:archive add-ticket-conversation

specs/ticket-conversation/spec.md:
## ADDED Requirements

### Requirement: Public replies
A ticket SHALL have public replies, each with a body and an author.

#### Scenario: Both sides reply
- **WHEN** the customer and an agent each reply
- **THEN** the ticket has two replies, with those authors

### Requirement: Notes apart from replies
Internal notes SHALL be stored apart from replies, so a ticket's replies never include a note.

#### Scenario: Ticket with both
- **WHEN** a ticket has a reply and a note
- **THEN** its replies hold only the reply

### Requirement: Note authors
Only an agent SHALL write an internal note. An admin counts as an agent.

#### Scenario: Customer writes a note
- **WHEN** a customer is the author of a note
- **THEN** the note is refused

### Requirement: Order
Replies and notes SHALL be listed in the order they were written.

#### Scenario: Edited reply
- **WHEN** an older reply is edited
- **THEN** it keeps its place

### Requirement: Authors and deletes
The author SHALL be set by the app, never by request input. A deleted ticket's replies and notes SHALL be deleted. A deleted author's replies and notes SHALL stay, with no author.

#### Scenario: Input sends an author
- **WHEN** reply input includes an author
- **THEN** it is ignored

#### Scenario: Author deleted
- **WHEN** an agent who replied is deleted
- **THEN** the reply stays, with no author

#### Scenario: Ticket deleted
- **WHEN** a ticket is deleted
- **THEN** its replies and notes are deleted

Proposal: the data side of R7, R8 and R3; out of scope: policies, R10 rules, screens, the change log and indexes. Design: two tables, same columns, ticket cascades, author set null, author not fillable, order by id. Tasks: migrations (me), models and factories, tests.

Commands:
git switch main && git pull
git switch -c add-ticket-conversation
openspec validate add-ticket-conversation --strict
git add openspec && git commit -m "Plan: add-ticket-conversation"
php artisan migrate
php artisan migrate:rollback --step=2
php artisan migrate
php artisan test
git add -A && git commit -m "Add replies and internal notes"
git push -u origin add-ticket-conversation
gh pr create --fill

Code, summarised (PHP arrows can't go in a description): 2 migrations, replies and internal_notes, each with a ticket (cascade on delete), a nullable author on users (set null), a text body and timestamps. Reply and InternalNote models: body is the only fillable field; each belongs to a ticket and an author. Ticket gets replies and internalNotes (has many, ordered by id), plus addReply and addNote, which set the author in code; addNote throws for anyone who isn't an agent. ReplyFactory, and InternalNoteFactory with an agent as author. Tests: ConversationTest 8, including the leak test and the edited-reply order test; 60 in the suite.

Next in the playlist: Episode 32, Capstone, Data Modeling Part 3.
```

---

## Slide list

| # | Slide | Notes |
|---|---|---|
| 1 | title slide | title |
| 2 | Three parts | agenda |
| 3 | 01 · Plan the conversation | divider |
| 4 | Where we left off | panel |
| 5 | Two kinds of message | squares |
| 6 | Explore first | monitor (Illustration) |
| 7 | Four questions | 4num |
| 8 | One table or two? | two |
| 9 | Why two tables win | card (Illustration) |
| 10 | Author, in code | phone (Illustration) |
| 11 | Two delete rules | plan (Illustration) |
| 12 | Order: id, not time | two-points (Illustration) |
| 13 | Propose the change | monitor (Illustration) |
| 14 | Review in order | flow |
| 15 | 02 · Two migrations | divider |
| 16 | /new-migration: replies table | phone (Illustration) |
| 17 | Read the SQL | plan (Illustration) |
| 18 | Same shape, twice | squares |
| 19 | What the SQL shows | card (Illustration) |
| 20 | Then I run them | monitor (Illustration) |
| 21 | Still not here | two |
| 22 | 03 · Models and tests | divider |
| 23 | Clear, then apply | flow |
| 24 | Two small models | phone (Illustration) |
| 25 | Ticket gets four methods | squares |
| 26 | Notes: agents only | panel |
| 27 | Eight new tests | 4num |
| 28 | A test that can fail | card (Illustration) |
| 29 | The leak test | two-points (Illustration) |
| 30 | Then archive | plan (Illustration) |
| 31 | Done means | flow |
| 32 | Your turn | two-points (Illustration) |
| 33 | Ready for the log | two |
| 34 | quote slide | quote |
| 35 | recap slide | recap |
| 36 | Next in the playlist | closer |

---

## Sources
- Laravel: https://laravel.com/docs/13.x/eloquent, /eloquent-relationships, /eloquent-serialization, /migrations, /eloquent-factories, /database-testing
- PostgreSQL: https://www.postgresql.org/docs/current/queries-order.html, /ddl-constraints.html
- OpenSpec 1.14.1: generated instructions (openspec instructions), README
- Claude Code: https://code.claude.com/docs/en/skills, /sub-agents, /hooks
- Course: Episode 28 (requirements), Episodes 29 and 30 (setup, core data model), Episodes 19, 20, 23 to 25 (skills, hooks, OpenSpec)
