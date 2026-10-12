# Day 35 · Episode 34: Capstone, Core Features Part 2

**Series:** Agentic Engineering (free YouTube course) · Module 13
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 40:00 in the plan; estimated 17:59 from the word count (times below are estimates; replace with real slide times after the voiceover)
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 13 lesson):** Core Features 2 (R6, R8, R9, R10, R11, R12), the three open decisions from Episode 28, worktrees from module twelve, and the three conditions for done

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Claude, OpenSpec, Laravel, git, test, browser or Playwright output is shown, and no screenshot of the app appears. The decisions, the four OpenSpec changes, the prompts, the policies, controllers, form requests, routes, React pages and tests are **written for the course**; the plan files are the reviewed versions, not something Claude produced on camera. All of it was built and run once in the throwaway copy of the project on PostgreSQL 17 on 12 October 2026 (two git worktrees, one merge conflict, npm run build, the full test suite, two deliberate breaks, Pint, PHPStan, the kit's format and lint check, tsc, a Playwright check at 390 by 844 against a local server that was stopped afterwards, openspec validate --strict and archive, and composer ci:check as a local stand-in for CI); none of that output appears in the video.

**Split of the two core-feature episodes (from Episode 28):** Ep33 = R2, R3, R4, R5, R7. Ep34 (this one) = R6, R8, R9, R10, R11, R12. R1 came with the starter kit in Ep29. 1 + 5 + 6 = 12.

**The three open decisions from Episode 28, settled here and written into docs/requirements.md:** D1 search covers subjects and public replies only; internal notes are not searched (as built in Episode 32's search scope). D2 the last admin keeps the admin role; a role change that would leave no admin is refused. D3 customers do not edit a ticket after opening it, including its category; they can say so in a reply.

**R10 reply cases (as corrected in Episode 28): exactly 6.** Customer reply on open: stays open. Customer on pending: becomes open. Customer on resolved: becomes open. Customer on closed: refused. Agent on open, pending or resolved: status unchanged. Agent on closed: refused. 4 customer + 2 agent = 6, one test each.

**Counts drawn on slides (checked against the files and the throwaway project):** requirements today: 6 in 3 groups (find R6; work the ticket R8 R9 R10 R11; admin R12). Explore questions: 4 (3 decisions + how to split the work). Worktrees: 2 (main checkout: add-ticket-work; linked worktree ../support-desk-admin: add-admin-area), each with its own dependencies, .env and test database. TicketPolicy: 6 abilities (2 new: update, addNote; reply now refuses closed tickets). New policies: 2 (CategoryPolicy 3 abilities, UserPolicy 2). New routes: 8 (2 ticket routes, 6 admin routes), all with the can middleware. Merge conflicts: 1 (the import lines of routes/web.php). Changes archived today: 4 (add-ticket-work: + 6 requirements, ~ 1; add-admin-area: + 2, ~ 1; list-admins-first: ~ 1; add-accounts-spec: + 3). openspec/specs: 8 + 3 = 11 capabilities. Tests: ticket work 25 (search 5, notes 4, assignment 4, status and priority 3, reply rules 6, history 3) + admin 14 (categories 5, archived categories 3, users 6) = 39 new; suite 94 + 39 = 133, all passing on PostgreSQL. Deliberate breaks: 2 (reopen rule removed: tests 2 and 3 failed; last-admin check off: 1 failed). Browser check: 390 by 844, 3 accounts. Conditions for done: 3.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook |
| 0:25–1:14 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:14–7:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 1 · Decide and plan |
| 7:30–13:25 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Build in two worktrees |
| 13:25–17:24 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Test and finish |
| 17:24–17:59 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> A customer writes back on a ticket that was marked resolved. It broke again. Should the ticket open again? And what if the ticket was closed? Today, the app gets an answer for every case, and a test for each one.
> And by the end, all twelve requirements are done. Not almost done. Done, by the rule we wrote in episode twenty-eight.

**Visual / B-roll:**
- Title card.

### 0:25–1:14 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode thirty-four: capstone, core features part two. The last six requirements.

*Cue: agenda slide "Three parts"*
> Three parts. First, decide and plan: three open questions get an answer, and the work splits into two plans. Second, build in two worktrees: two branches side by side, then one merge. Third, test and finish: thirty-nine new tests, a phone check, and the three conditions for done.
> As always, this is an illustrated walkthrough, not a recording. I built and ran all of it once in a throwaway copy of the project, and every test passed there. No output is shown. The prompts and commands are in the description, and the plans and the code are summarised there.

**Visual / B-roll:**
- Three items: 01 Decide and plan · 02 Build in two worktrees · 03 Test and finish.

### 1:14–7:30 · Part 1: Decide and plan
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "01 · Decide and plan"*
> Part one. Decide and plan.

*Cue: panel "Where we left off"*
> Where we left off. Episode thirty-three built the first screens. Customers open tickets and reply, and agents work through an inbox with filters. One policy checks every ticket route. Ninety-four tests pass, and eight capabilities sit in openspec slash specs.
> That's six of twelve requirements: R one from the starter kit, and R two, three, four, five and seven. Six are left, and they're all today.

*Cue: squares "Six to go"*
> The six fall into three groups.
> Find: R six, search tickets by words in the subject or the replies.
> Work the ticket: R eight, internal notes. R nine, assign a ticket to an agent, or unassign it. R ten, status and priority, and the reply rules. And R eleven, the change log, shown on the ticket.
> And admin: R twelve, categories that can be archived, and user roles.

*Cue: monitor "Explore the gaps"*
> In episode twenty-eight, we left three questions open on purpose. They were product decisions, not code. Now they block code, so they come first.
> Slash O P S X explore, with the six requirements, the three open gaps, and one more question: can this work be split, so two sessions run side by side? The prompt asks Claude to read the requirements, the specs, the policy and the routes first, then ask one question at a time. It's written for the course and printed in the description.

*Cue: 4num "Four questions"*
> Four questions.
> One: does search include internal notes? Two: can the last admin remove their own admin role? Three: can a customer change a ticket's category? Four: how do we split the work?

*Cue: two columns "Search the notes?"*
> Question one. Option one: agents search the notes too. Notes often hold the useful words, like an error code an agent found in the logs.
> Option two: search covers subjects and public replies only. And this one was already settled in code. In episode thirty-two, we built the search scope on the subject and the replies, with a full text index on each, and the notes were left out.
> So decision one: notes are not searched. It keeps one rule simple: the inbox only shows what a ticket says in public. And there's no second search path to keep in step.

*Cue: card "The last admin"*
> Question two. Option one: allow it. Then one click can leave the app with no admin at all, and nobody can manage roles or categories until someone edits the database by hand.
> Option two: refuse it. Decision two: the last admin keeps the admin role. A role change that would leave no admin is refused, with a clear message: there must always be at least one admin.
> With two admins, either one can step down. It's only ever the last one who can't.

*Cue: phone "Wrong category?"*
> Question three. A customer picks the wrong category. Can they change it?
> Changing a category isn't in the twelve requirements for anyone. And letting a customer edit a ticket after opening it raises more questions: what about the subject, or the description an agent already answered?
> So decision three: customers don't edit a ticket after opening it, including its category. If something's wrong, they say so in a reply. All three decisions go into the requirements file, under a new heading: decisions. On main, so every branch has them.

*Cue: plan "Two worktrees"*
> Question four. In episode thirty-three, worktrees didn't fit: every feature touched the same policy and the same pages. Today, the work has two separate halves.
> The ticket work: search, notes, assignment, status and the change log. It lives in the ticket policy, the ticket page and the inbox. And the admin area: new controllers, new policies, new pages. It barely touches the ticket code.
> So two branches, in two worktrees, from module twelve. A few shared files will need a merge, at least the routes file. That's expected, and small.

*Cue: two-points "R10 in six cases"*
> Before any code, R ten gets written out case by case, as we corrected it in episode twenty-eight. Exactly six cases.
> A customer replies. On an open ticket: it stays open. On a pending ticket: it becomes open. On a resolved ticket: it becomes open. On a closed ticket: refused.
> An agent replies. On an open, pending or resolved ticket: the status doesn't change. Agents set pending on purpose, with the status field. On a closed ticket: refused. Four customer cases, two agent cases. Six tests.

*Cue: monitor "Two worktrees, two plans"*
> On main, pull, then commit the decisions. Then the plain git route from episode twenty-seven: git worktree add, dot dot slash support desk admin, dash b, add admin area. That's a second folder, with its own branch, sharing one repository.
> A worktree is a fresh checkout, so it needs its own setup: composer install, npm c i, and a copy of the env file. Claude Code's own worktree option can copy files like that for you, with a dot worktree include file. With plain git, I copy it myself. And one thing that's easy to miss: its own test database. Two test runs on one database would wipe each other's tables.
> Then one Claude session per folder. The main checkout proposes add ticket work. The new worktree proposes add admin area.

*Cue: flow "Two plans, reviewed"*
> Review each plan in the usual order. Add ticket work: one new capability, ticket management, with status and priority, assignment, internal notes, and the change log. It adds search to the agent inbox, and changes ticket replies: closed tickets take no replies, plus the six cases.
> Add admin area: one new capability, the admin area, with categories and roles. And it changes customer tickets: open a ticket now accepts active categories only. Changing a requirement means writing out the whole requirement again, with every scenario. Then openspec validate, strict, for each, and I commit both plans.

### 7:30–13:25 · Part 2: Build in two worktrees
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Build in two worktrees"*
> Part two. Build in two worktrees.

*Cue: phone "TicketPolicy, extended"*
> The main checkout first. Slash clear, slash O P S X apply. Group one is the rules, starting with the policy.
> Reply now refuses closed tickets, for customers and agents alike, with a message: closed tickets take no replies. Two new abilities, update and add note, are for agents only. The ticket's own customer gets a four oh three: they can see the ticket, so hiding it makes no sense. Anyone else still gets the four oh four from episode thirty-three.

*Cue: plan "One change route"*
> Group two, the server. One patch route changes status, priority and assignee, checked with can, update, ticket.
> The form request validates each field only if it's sent. Status and priority must be one of their enum values. The assignee must be an agent or an admin, and the form sends the word none for unassigned, which the request turns into null before validating.
> The controller calls the model methods from episode thirty-two, change status, change priority and assign to, all in one transaction. Each of them writes the change log, so R eleven gets every change for free.

*Cue: monitor "Reply rules in the model"*
> R ten's reply rules live in the Ticket model, in one method: respond. If the ticket is closed, it refuses. Otherwise, in one transaction, it adds the reply. Then, if the author isn't an agent and the ticket was pending or resolved, it sets the status to open, through change status, so the log shows the customer reopened it.
> Why the model, and not the controller? Because the rule is about tickets, not about one page. The policy refuses closed tickets too, so the page can hide the reply form. Two layers, one rule.

*Cue: card "Search, not notes"*
> Then search, R six. The inbox reads one more value from the address bar: q, trimmed and cut to a hundred characters. When it's there, the query adds the search scope from episode thirty-two.
> That scope matches the subject and the public replies, never the notes. That's decision one, already in the code. It combines with the four filters, and the page links keep it, like the filters do.
> One test proves the decision: a word that appears only in an internal note finds nothing.

*Cue: two columns "Notes and activity"*
> The ticket page gets two new sections, with two different audiences.
> Internal notes, R eight: the controller loads them only for agents. For a customer, the notes prop is simply null, the same idea as last episode. If they're never loaded, they can't leak.
> Activity, R eleven: everyone who can see the ticket sees it. It reads the change log, oldest first, so it reads like a story. Assignee changes are stored as ids, so the page turns them into names with one query. And a user who deleted their account shows as deleted user.

*Cue: phone "The ticket page"*
> Group three, the pages. For an agent, the ticket page has a manage form with three selects, status, priority and assignee, and one save button. Below the replies come the notes, with a form to add one, and then the activity.
> For a closed ticket, the reply form is replaced by one line: this ticket is closed, closed tickets take no replies. The page reads that from the policy, through a can flag in the props. And the inbox gets a search box above the filters.

*Cue: two-points "Archive, don't delete"*
> Now the other worktree, add admin area. Slash clear, slash O P S X apply in that folder.
> Categories are archived, never deleted, because old tickets still point to them. Two places enforce it. The new ticket form lists active categories only, with a small scope on the Category model. And the store request checks it again: the category must exist and must not be archived. The form is a convenience; the request is the rule.
> Admins create, rename and archive categories, each with a policy check on the route.

*Cue: plan "Last admin, locked"*
> Then roles, and decision two. Checking the admin count and then saving sounds simple. But two admins could step down at the same moment, each one seeing two admins, and both would succeed.
> So the controller opens a transaction and locks the admin rows with lock for update. The Laravel docs describe it: the selected rows can't be modified until the transaction commits. If this user is the only admin and the new role isn't admin, it refuses, with a validation error under the role select. Otherwise it saves.

*Cue: card "One merge conflict"*
> Both branches are ready, and here's the merge. Add ticket work goes into main first, a fast forward. Then main goes into add admin area, in the worktree.
> Git merged everything else by itself, including the ticket controller, which both branches changed. One conflict: the import lines at the top of the routes file. One side added the ticket update controller, the other added the Category model. The right answer is both. Then the whole suite runs in the worktree, on its own database.

*Cue: flow "Merge in order"*
> The order, once more. Merge the ticket work into main. Merge main into the admin branch, and fix the conflict there, where the admin tests can check it. Run every test. Then the admin branch goes into main, and git worktree remove deletes the second folder. Its test database goes too.
> In your real repository, each of those merges is a pull request, with CI and a review. More on that in part three.

### 13:25–17:24 · Part 3: Test and finish
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Test and finish"*
> Part three. Test and finish.

*Cue: squares "What the tests prove"*
> The new tests prove three kinds of thing.
> Allowed: an agent changes a status, assigns a ticket, adds a note. An admin archives a category.
> Refused: a customer changing a status or adding a note, anyone replying on a closed ticket, the last admin stepping down.
> And logged: every status, priority and assignee change appears in the activity, with who made it.

*Cue: panel "Break it twice"*
> Two deliberate breaks this time. First, I removed the reopen rule from respond. Two tests failed: case two and case three, the customer replying on a pending ticket and on a resolved one. Put it back, green.
> Then, in the worktree, I switched off the last admin check. One test failed: the last admin removing their own role. Put it back, green again.

*Cue: two-points "Phone check"*
> Q four: a browser check at three hundred and ninety by eight hundred and forty-four, with Playwright, against a local server. Three accounts this time. The agent searches, opens a ticket, adds a note and closes it. The customer opens that ticket and sees the closed message, and no note. The admin creates and archives a category, then tries to remove their own admin role, and sees the error.
> No page scrolled sideways. The only console error was the expected four oh three, when the customer tried the admin page. And the check found one real problem: the users page sorted by name only, so with twenty thousand test customers in my local database, the admins sat on a late page. A small follow-up change lists admins first, then agents, with its own test. Then I stopped the server.

*Cue: 4num "39 new tests"*
> Thirty-nine new tests.
> Search and notes, nine. Assignment, status and priority, seven. The six reply cases and the history, nine. And the admin area with archived categories, fourteen.
> With the ninety-four from before, that's one hundred and thirty-three, and in my throwaway project all of them passed on PostgreSQL. Pint, PHP Stan, the format and lint check, and the TypeScript check all passed too. The generated route file that tripped the TypeScript check since episode twenty-nine is now excluded from it, because it's generated, not ours.

*Cue: squares "Three conditions for done"*
> Now the rule from episode twenty-eight. A requirement is done when three things are true.
> One: its spec is archived into openspec slash specs. Two: its tests pass in CI. Three: its pull request is reviewed and merged.
> So I checked all twelve, one by one, against those three.

*Cue: flow "Audit for done"*
> Requirements two to twelve each map to an archived capability. R one didn't. The starter kit built it, and its tests passed since episode twenty-nine, but it never had a spec. So one more small change: add accounts spec. No code, just the spec, with each scenario matched to a test the kit already has. Validate, archive, and openspec slash specs holds eleven capabilities.
> CI runs composer setup, then the CI check script: format, lint, types, and the tests. In the throwaway copy there's no remote, so I ran the same check script locally, and it passed. In your repository, that's the pull request, CI, the code reviewer subagent, and the merge.

*Cue: two columns "Twelve of twelve"*
> Your turn, before the next episode. One: find an open question in your own project, decide it, and write the decision down where the code can follow it. Two: try two worktrees on two separate pieces of work, each with its own test database.
> And where are we? Twelve of twelve requirements. Eleven capabilities. One hundred and thirty-three tests. Customers, agents and admins, each with their own screens, and every rule written down, tested and merged.

### 17:24–17:59 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> Decide it, write it down, then build it.

*Cue: recap slide*
> Quick recap.
> Three decisions: notes aren't searched, the last admin stays, and customers don't edit tickets.
> Two worktrees: the ticket work and the admin area, one merge conflict, fixed where the tests could check it.
> R ten in six cases, thirty-nine new tests, two deliberate breaks, and a phone check that found a real problem.
> And all twelve requirements done: archived, tested and merged locally.

*Cue: closer slide "Next in the playlist"*
> Next in the playlist: episode thirty-five, field notes and wrap-up, the course finale. See you there.

---

## Example files (written for the course)

All files were run in the throwaway project. The prompts and commands are free of `<` and `>` and go into the description as they are. The PHP and TypeScript files contain `<?php`, `->`, `=>` and JSX tags, so the description summarises them; the files are here. Five long React files (`tickets/show.tsx`, `inbox.tsx`, `ticket-manage-form.tsx`, `admin/categories.tsx`, `admin/users.tsx`, 102 to 178 lines each) are **summarised below, not printed in full**; their complete versions are in the build folder (`ep34-build/files/`). Everything else is printed in full. Diffs show edits to files printed in earlier episodes. The Playwright script lives outside the repository and only ran against a local server.

### Prompts (typed into Claude Code)

```text
/opsx:explore R6, R8, R9, R10, R11 and R12 in docs/requirements.md, and the three open gaps from Episode 28: does search include internal notes, can the last admin remove their own admin role, can a customer change a ticket's category. Can the work split into two parts that run side by side? Read the requirements, openspec/specs, TicketPolicy and the routes first. Ask me one question at a time.

/opsx:propose add-ticket-work: search (subjects and public replies, never notes), internal notes for agents, assignment, status and priority on one PATCH route, the R10 reply rules with exactly six cases, and the activity list on the ticket page. Pest tests for every scenario, one per R10 case. No admin area.

/opsx:propose add-admin-area: admins create, rename and archive categories, and set user roles. Archived categories cannot be picked for new tickets. The last admin keeps the admin role (D2), checked in a locked transaction. Pest tests for every scenario.

/clear, then /opsx:apply add-ticket-work (in the main checkout) and /opsx:apply add-admin-area (in ../support-desk-admin)

Use Playwright MCP at 390 by 844. As the agent: search the inbox, open a ticket, add a note, close it. As the customer: open that ticket. As the admin: create and archive a category, then try to remove your own admin role. Tell me any page that scrolls sideways or shows a console error.

Use the code-reviewer subagent to review each change against the laravel-security and react-best-practices skills.

/opsx:archive add-ticket-work, then /opsx:archive add-admin-area
```

### Commands (typed in the terminal)

```text
git switch main && git pull
git add docs/requirements.md && git commit -m "Decide the three open questions"
git worktree add ../support-desk-admin -b add-admin-area
cd ../support-desk-admin && cp ../support-desk/.env .env
composer install && npm ci
sudo -u postgres psql -c "CREATE DATABASE support_desk_test_admin OWNER support_desk;"
DB_DATABASE=support_desk_test_admin php artisan test
cd ../support-desk && git switch -c add-ticket-work
openspec validate add-ticket-work --strict
openspec validate add-admin-area --strict
npm run build
php artisan test
vendor/bin/pint
vendor/bin/phpstan analyse
git switch main && git merge add-ticket-work
cd ../support-desk-admin && git merge main
cd ../support-desk && git merge add-admin-area
git worktree remove ../support-desk-admin
composer ci:check
```

### `docs/requirements.md` and `tsconfig.json` (edits on main, before both branches)

```diff
diff --git a/docs/requirements.md b/docs/requirements.md
index 3b8eed3..5626bbd 100644
--- a/docs/requirements.md
+++ b/docs/requirements.md
@@ -45,3 +45,8 @@ ## Out of scope for v1
 
 ## Done means
 A requirement is done when its spec is archived into openspec/specs, its tests pass in CI, and its pull request is reviewed and merged.
+
+## Decisions
+D1 Search covers subjects and public replies only. Internal notes are not searched (R6).
+D2 The last admin keeps the admin role. A role change that would leave no admin is refused (R12).
+D3 Customers do not edit a ticket after opening it, including its category. They can say so in a reply.
diff --git a/tsconfig.json b/tsconfig.json
index ca07426..7de4937 100644
--- a/tsconfig.json
+++ b/tsconfig.json
@@ -116,5 +116,7 @@
         "resources/js/**/*.ts",
         "resources/js/**/*.d.ts",
         "resources/js/**/*.tsx"
-    ]
+    ],
+    // Wayfinder generates these for Route::redirect; their "query" method is not in its Method type yet.
+    "exclude": ["resources/js/actions/Illuminate"]
 }
```

#### Change 1: add-ticket-work (main checkout)

### `openspec/changes/add-ticket-work/proposal.md`

```markdown
## Why
Agents can read and answer tickets, but they can't work them yet. This change adds search, internal notes, assignment, status and priority with the reopen rule, and the change log on the ticket. Covers R6, R8, R9, R10 and R11, plus decision D1 (notes are not searched).

## What Changes
- A search box in the inbox that combines with the filters.
- A manage form on the ticket for status, priority and assignee, for agents.
- The R10 reply rules: closed tickets take no replies; a customer reply on a pending or resolved ticket sets it to open.
- Internal notes on the ticket page, for agents only.
- An activity list on the ticket page from the change log.

## Capabilities
### New Capabilities
- `ticket-management`: status and priority, assignment, internal notes, and the change log on the ticket.

### Modified Capabilities
- `agent-inbox`: adds search.
- `ticket-replies`: closed tickets take no replies, and the reopen rule.

## Out of scope
The admin area, archived categories and roles (R12, in the add-admin-area change).

## Impact
TicketPolicy, Ticket::respond, two controllers, two form requests, routes, the ticket and inbox pages, three components, tests.
```

### `openspec/changes/add-ticket-work/specs/agent-inbox/spec.md`

```markdown
## ADDED Requirements

### Requirement: Search
Agents SHALL search tickets by words in the subject or the public replies. Internal notes SHALL NOT be searched. Search SHALL combine with the filters and stay in the page links.

#### Scenario: Words in the subject
- **WHEN** an agent searches for printer jam
- **THEN** only tickets with both words are listed

#### Scenario: Word in a reply
- **WHEN** a word appears only in a reply
- **THEN** the ticket is listed

#### Scenario: Word in a note
- **WHEN** a word appears only in an internal note
- **THEN** the ticket is not listed

#### Scenario: Search and a filter
- **WHEN** an agent searches for refund and filters by pending
- **THEN** only pending tickets about a refund are listed

#### Scenario: Next page
- **WHEN** a search has a next page
- **THEN** the next page link keeps the search
```

### `openspec/changes/add-ticket-work/specs/ticket-replies/spec.md`

```markdown
## MODIFIED Requirements

### Requirement: Reply on a ticket
Whoever can see a ticket SHALL add a public reply to it, unless the ticket is closed: the customer who owns it, and any agent. The app SHALL set the author.

#### Scenario: Customer replies
- **WHEN** a customer replies on their own ticket
- **THEN** the reply is saved with the customer as author

#### Scenario: Agent replies
- **WHEN** an agent replies on any ticket
- **THEN** the reply is saved with the agent as author

#### Scenario: Another customer's ticket
- **WHEN** a customer replies on a ticket that is not theirs
- **THEN** the answer is 404 and nothing is saved

#### Scenario: Empty reply
- **WHEN** the reply body is empty
- **THEN** nothing is saved and the form shows an error

#### Scenario: Request sends an author
- **WHEN** the request also sends an author
- **THEN** it is ignored

## ADDED Requirements

### Requirement: Status rule on reply
A customer reply on a pending or resolved ticket SHALL set it to open, logged with the customer as the user. An agent reply SHALL NOT change the status. Closed tickets SHALL take no replies.

#### Scenario: Customer, open ticket
- **WHEN** a customer replies on an open ticket
- **THEN** it stays open and nothing is logged

#### Scenario: Customer, pending ticket
- **WHEN** a customer replies on a pending ticket
- **THEN** it becomes open, logged with the customer as the user

#### Scenario: Customer, resolved ticket
- **WHEN** a customer replies on a resolved ticket
- **THEN** it becomes open

#### Scenario: Customer, closed ticket
- **WHEN** a customer replies on a closed ticket
- **THEN** the answer is 403 and nothing is saved

#### Scenario: Agent, open, pending or resolved ticket
- **WHEN** an agent replies on an open, pending or resolved ticket
- **THEN** the status does not change

#### Scenario: Agent, closed ticket
- **WHEN** an agent replies on a closed ticket
- **THEN** the answer is 403 and nothing is saved
```

### `openspec/changes/add-ticket-work/specs/ticket-management/spec.md`

```markdown
## ADDED Requirements

### Requirement: Status and priority
Agents SHALL change a ticket's status and priority. Each change SHALL be logged with who made it.

#### Scenario: Agent changes both
- **WHEN** an agent sets an open, normal ticket to pending and urgent
- **THEN** both are saved, and two entries are logged with that agent

#### Scenario: Customer tries
- **WHEN** a customer changes the status of their own ticket
- **THEN** the answer is 403 and nothing changes

#### Scenario: Unknown status
- **WHEN** the request sends a status that does not exist
- **THEN** it is refused and nothing changes

### Requirement: Assignment
Agents SHALL assign a ticket to any agent, or unassign it. An admin counts as an agent. Each change SHALL be logged.

#### Scenario: Assign
- **WHEN** an agent assigns a ticket to another agent
- **THEN** the ticket has that assignee, and the change is logged with the agent who made it

#### Scenario: Unassign
- **WHEN** an agent chooses unassigned
- **THEN** the ticket has no assignee

#### Scenario: Customer as assignee
- **WHEN** an agent tries to assign a customer
- **THEN** it is refused and nothing is logged

#### Scenario: Customer assigns
- **WHEN** a customer tries to assign their own ticket
- **THEN** the answer is 403

### Requirement: Internal notes
Agents SHALL add internal notes and see them on the ticket page. Customers SHALL NOT add or receive notes.

#### Scenario: Agent adds a note
- **WHEN** an agent adds a note
- **THEN** it is saved with the agent as author

#### Scenario: Agent reads notes
- **WHEN** an agent opens a ticket with a note
- **THEN** the page includes the note and its author

#### Scenario: Customer tries
- **WHEN** a customer adds a note on their own ticket
- **THEN** the answer is 403, nothing is saved, and their page has no notes

#### Scenario: Empty note
- **WHEN** the note body is empty
- **THEN** nothing is saved and the form shows an error

### Requirement: Change log on the ticket
The ticket page SHALL show every logged change with the field, the old and new value, who made it and when, to everyone who can see the ticket.

#### Scenario: Status change
- **WHEN** an agent has set a ticket to pending
- **THEN** the page shows status, open, pending and the agent's name

#### Scenario: Assignee names
- **WHEN** the customer opens a ticket that was assigned
- **THEN** the page shows the assignee's name, not an id

#### Scenario: Deleted assignee
- **WHEN** an assigned agent's account was deleted
- **THEN** the page shows a deleted user
```

### `openspec/changes/add-ticket-work/design.md`

```markdown
## Decisions
- D1: search uses the existing search scope, so it covers subjects and public replies only, never notes.
- One PATCH route changes status, priority and assignee, through changeStatus, changePriority and assignTo in one transaction, so every change is logged (R11). Alternative: one route per field.
- The form sends "none" for unassigned; the request turns it into null. The assignee must be an agent or admin.
- The reply rules live in Ticket::respond: it refuses a closed ticket and reopens on a customer reply, in one transaction. The policy also refuses replies on closed tickets, so the page can hide the form.
- An agent reply never changes the status. Agents set pending on purpose.
- update and addNote are agents only: the ticket's customer gets 403, anyone else 404.
- Notes are loaded only for agents. The history is shown to everyone who can see the ticket; assignee ids become names in one query, or "Deleted user".

## Risks / Trade-offs
- Customers see agent names in the activity list → they already see them on replies.
- A search with common words matches many tickets → paged, 25 per page, newest first.
```

### `openspec/changes/add-ticket-work/tasks.md` (after apply)

```markdown
## 1. Rules
- [x] 1.1 TicketPolicy: reply refuses closed tickets; update and addNote for agents
- [x] 1.2 Ticket::respond with the reopen rule

## 2. Server
- [x] 2.1 TicketUpdateController and UpdateTicketRequest; NoteController and StoreNoteRequest; routes
- [x] 2.2 Ticket page props: history with names, notes and agents for agents, can flags
- [x] 2.3 Inbox search, combined with the filters

## 3. Pages
- [x] 3.1 Manage form, internal notes and activity on the ticket page; closed message instead of the reply form
- [x] 3.2 Search box in the inbox

## 4. Checks
- [x] 4.1 A Pest test for every scenario, including the six R10 cases
- [x] 4.2 Pint, PHPStan, lint, types, all tests green
- [x] 4.3 Playwright check at phone width
```

#### Change 2: add-admin-area (worktree ../support-desk-admin)

### `openspec/changes/add-admin-area/proposal.md`

```markdown
## Why
Requirement R12 asks for an admin area: admins manage categories and user roles. Categories are archived, never deleted, so old tickets keep them. Decision D2 says the last admin keeps the admin role.

## What Changes
- Admins create, rename and archive categories.
- Archived categories cannot be picked for a new ticket. Existing tickets keep them.
- Admins set each user's role. A change that would leave no admin is refused (D2).
- The sidebar shows Categories and Users to admins only.

## Capabilities

### New Capabilities
- `admin-area`: category management and role management for admins.

### Modified Capabilities
- `customer-tickets`: opening a ticket accepts active categories only.

## Impact
New admin controllers, policies, form requests, two pages and routes under /admin. No new tables: archived_at already exists on categories.
```

### `openspec/changes/add-admin-area/specs/admin-area/spec.md`

```markdown
## ADDED Requirements

### Requirement: Manage categories
An admin SHALL create, rename and archive categories. A category name SHALL be required and unique. Categories SHALL be archived, never deleted.

#### Scenario: Create a category
- **WHEN** an admin sends a new name
- **THEN** the category is saved

#### Scenario: Missing or taken name
- **WHEN** the name is empty or already used
- **THEN** nothing is saved and the form shows an error

#### Scenario: Rename a category
- **WHEN** an admin sends a new name for a category
- **THEN** the category has the new name

#### Scenario: Archive a category
- **WHEN** an admin archives a category
- **THEN** the category is marked archived and still exists

#### Scenario: Not an admin
- **WHEN** an agent or a customer opens the categories page or sends a change
- **THEN** the answer is 403 and nothing changes

### Requirement: Manage roles
An admin SHALL set each user's role to customer, agent or admin. A change that would leave no admin SHALL be refused.

#### Scenario: Set a role
- **WHEN** an admin sets a user's role to agent
- **THEN** the user is an agent

#### Scenario: Not an admin
- **WHEN** an agent or a customer opens the users page or sends a role
- **THEN** the answer is 403 and nothing changes

#### Scenario: Unknown role
- **WHEN** the role is not customer, agent or admin
- **THEN** nothing changes and the form shows an error

#### Scenario: Last admin steps down
- **WHEN** the only admin sets their own role to agent
- **THEN** the change is refused with "There must always be at least one admin."

#### Scenario: Two admins
- **WHEN** there are two admins and one sets their own role to agent
- **THEN** the change is saved
```

### `openspec/changes/add-admin-area/specs/customer-tickets/spec.md`

```markdown
## MODIFIED Requirements

### Requirement: Open a ticket
A customer SHALL open a ticket with a subject, a description and an active category. The app SHALL set the customer, the status and the priority, never the request. Archived categories SHALL NOT be offered or accepted for a new ticket, and existing tickets SHALL keep their category.

#### Scenario: Customer opens a ticket
- **WHEN** a customer sends a subject, a description and a category
- **THEN** a ticket is saved for that customer, open, with normal priority

#### Scenario: Missing fields
- **WHEN** the subject, description or category is missing
- **THEN** no ticket is saved and the form shows errors

#### Scenario: Request sends other fields
- **WHEN** the request also sends a customer, a status or a priority
- **THEN** they are ignored

#### Scenario: Agent tries to open a ticket
- **WHEN** an agent opens the new ticket form or sends it
- **THEN** the answer is 403

#### Scenario: Guest
- **WHEN** a guest opens the new ticket form
- **THEN** they are sent to the login page

#### Scenario: Form lists active categories
- **WHEN** a customer opens the new ticket form
- **THEN** only categories that are not archived are listed

#### Scenario: Archived category sent
- **WHEN** a customer sends an archived category
- **THEN** no ticket is saved and the form shows an error

#### Scenario: Existing ticket keeps its category
- **WHEN** an admin archives a category that tickets use
- **THEN** those tickets keep the category
```

### `openspec/changes/add-admin-area/design.md`

```markdown
## Context
Categories already have an archived_at column from the data model. Roles live in the users.role column (customer, agent, admin).

## Decisions
- Archive, never delete. Archiving sets archived_at once. Tickets keep their category_id.
- The active() scope lists categories with no archived_at. The new ticket form and the store rule both use it.
- D2, last admin: inside a transaction, lock the admin rows, then refuse when the change would remove the only admin. The lock stops two admins demoting each other at the same moment.
- Authorization lives in CategoryPolicy and UserPolicy, admin only, applied on the routes with can.

## Risks / Trade-offs
- Renaming a category renames it on old tickets too. That is wanted: the category is one record.
```

### `openspec/changes/add-admin-area/tasks.md` (after apply)

```markdown
## 1. Categories
- [x] 1.1 CategoryPolicy, admin only
- [x] 1.2 Create, rename and archive with form requests and a unique name
- [x] 1.3 active() scope on the new ticket form and the store rule

## 2. Roles
- [x] 2.1 UserPolicy, admin only
- [x] 2.2 Role change with the last-admin check in a locked transaction (D2)

## 3. Pages
- [x] 3.1 admin/categories and admin/users pages
- [x] 3.2 Sidebar links for admins only

## 4. Tests
- [x] 4.1 Categories: five tests
- [x] 4.2 Archived categories on tickets: three tests
- [x] 4.3 Roles: five tests
```

#### Changes 3 and 4: list-admins-first and add-accounts-spec

### `openspec/changes/list-admins-first/proposal.md`

```markdown
## Why
The phone-width browser check found the users page sorted by name only. With a thousand demo customers, the admins sat on a late page, so the last-admin rule was hard to reach.

## What Changes
- The users page lists admins first, then agents, then customers, each by name.

## Capabilities

### New Capabilities
None.

### Modified Capabilities
- `admin-area`: the users page order.

## Impact
One order clause in the admin user controller and one feature test.
```

### `openspec/changes/list-admins-first/specs/admin-area/spec.md`

```markdown
## MODIFIED Requirements

### Requirement: Manage roles
An admin SHALL set each user's role to customer, agent or admin. A change that would leave no admin SHALL be refused. The users page SHALL list admins first, then agents, then customers.

#### Scenario: Set a role
- **WHEN** an admin sets a user's role to agent
- **THEN** the user is an agent

#### Scenario: Not an admin
- **WHEN** an agent or a customer opens the users page or sends a role
- **THEN** the answer is 403 and nothing changes

#### Scenario: Unknown role
- **WHEN** the role is not customer, agent or admin
- **THEN** nothing changes and the form shows an error

#### Scenario: Last admin steps down
- **WHEN** the only admin sets their own role to agent
- **THEN** the change is refused with "There must always be at least one admin."

#### Scenario: Two admins
- **WHEN** there are two admins and one sets their own role to agent
- **THEN** the change is saved

#### Scenario: Users page order
- **WHEN** an admin opens the users page
- **THEN** admins are listed first, then agents, then customers, each by name
```

### `openspec/changes/list-admins-first/tasks.md`

```markdown
## 1. Order
- [x] 1.1 Order the users page by role (admin, agent, customer), then by name
- [x] 1.2 Feature test for the order
```

### `openspec/changes/add-accounts-spec/proposal.md`

```markdown
## Why
"Done" needs an archived spec for every requirement. R1 (register, sign in, reset a password) came with the starter kit in Episode 29 and its tests already pass, but openspec/specs has no spec for it.

## What Changes
- Write down R1 as it already works. No code changes.
- Each scenario is covered by a starter kit test in tests/Feature/Auth.

## Capabilities

### New Capabilities
- `accounts`: register, sign in, sign out and reset a password.

### Modified Capabilities
None.

## Impact
Specs only. Roles for new sign-ups stay in user-roles.
```

### `openspec/changes/add-accounts-spec/specs/accounts/spec.md`

```markdown
## Purpose
How people get an account and get back into it (R1). Built by the starter kit with Laravel Fortify.

## ADDED Requirements

### Requirement: Register
A visitor SHALL register with a name, an email and a password, and is then signed in.

#### Scenario: New user registers
- **WHEN** a visitor sends a name, an email and a confirmed password
- **THEN** they are signed in and sent to the dashboard

### Requirement: Sign in and out
A user SHALL sign in with their email and password, and sign out. Repeated failed attempts SHALL be rate limited.

#### Scenario: Right password
- **WHEN** a user sends their email and the right password
- **THEN** they are signed in

#### Scenario: Wrong password
- **WHEN** a user sends a wrong password
- **THEN** they are not signed in

#### Scenario: Sign out
- **WHEN** a signed-in user signs out
- **THEN** they are a guest again

#### Scenario: Too many attempts
- **WHEN** a sign-in is tried again after five failed attempts
- **THEN** the answer is 429, too many requests

### Requirement: Reset a password
A user SHALL reset a forgotten password through a link sent by email.

#### Scenario: Ask for a link
- **WHEN** a user asks for a reset link with their email
- **THEN** a reset notification is sent to them

#### Scenario: Valid token
- **WHEN** a user sends a new password with a valid token
- **THEN** the password is changed

#### Scenario: Invalid token
- **WHEN** the token is not valid
- **THEN** the reset is refused with an error
```

### `openspec/changes/add-accounts-spec/tasks.md`

```markdown
## 1. Spec
- [x] 1.1 Write the accounts spec from the starter kit's behaviour
- [x] 1.2 Match each scenario to a test in tests/Feature/Auth
```

#### Code

### `app/Policies/TicketPolicy.php`

```php
<?php

namespace App\Policies;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * The inbox of every ticket is for agents (R4).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAgent();
    }

    /**
     * Agents see every ticket; a customer sees only their own (R3).
     * Anyone else gets a 404, so ticket ids reveal nothing.
     */
    public function view(User $user, Ticket $ticket): Response
    {
        return $user->isAgent() || $ticket->customer_id === $user->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Customers open tickets (R2).
     */
    public function create(User $user): bool
    {
        return ! $user->isAgent();
    }

    /**
     * Whoever can see a ticket can reply to it, unless it is closed (R7, R10).
     */
    public function reply(User $user, Ticket $ticket): Response
    {
        $view = $this->view($user, $ticket);

        if ($view->denied()) {
            return $view;
        }

        return $ticket->status === TicketStatus::Closed
            ? Response::deny(__('Closed tickets take no replies.'))
            : Response::allow();
    }

    /**
     * Agents change status, priority and assignee (R9, R10).
     */
    public function update(User $user, Ticket $ticket): Response
    {
        return $this->agentOnly($user, $ticket);
    }

    /**
     * Agents add internal notes and read them (R8).
     */
    public function addNote(User $user, Ticket $ticket): Response
    {
        return $this->agentOnly($user, $ticket);
    }

    /**
     * The ticket's owner gets a 403; anyone else who can't see it, a 404.
     */
    private function agentOnly(User $user, Ticket $ticket): Response
    {
        $view = $this->view($user, $ticket);

        if ($view->denied()) {
            return $view;
        }

        return $user->isAgent() ? Response::allow() : Response::deny();
    }
}
```

### `routes/web.php` (edits, both branches, after the merge)

```diff
diff --git a/routes/web.php b/routes/web.php
index da7ee87..e3dcb3a 100644
--- a/routes/web.php
+++ b/routes/web.php
@@ -1,9 +1,15 @@
 <?php
 
+use App\Http\Controllers\Admin\CategoryController;
+use App\Http\Controllers\Admin\UserController;
 use App\Http\Controllers\InboxController;
+use App\Http\Controllers\NoteController;
 use App\Http\Controllers\ReplyController;
 use App\Http\Controllers\TicketController;
+use App\Http\Controllers\TicketUpdateController;
+use App\Models\Category;
 use App\Models\Ticket;
+use App\Models\User;
 use Illuminate\Support\Facades\Route;
 
 Route::inertia('/', 'welcome')->name('home');
@@ -18,11 +24,31 @@
         ->can('create', Ticket::class)->name('tickets.store');
     Route::get('tickets/{ticket}', [TicketController::class, 'show'])
         ->can('view', 'ticket')->name('tickets.show');
+    Route::patch('tickets/{ticket}', TicketUpdateController::class)
+        ->can('update', 'ticket')->name('tickets.update');
     Route::post('tickets/{ticket}/replies', [ReplyController::class, 'store'])
         ->can('reply', 'ticket')->name('tickets.replies.store');
+    Route::post('tickets/{ticket}/notes', [NoteController::class, 'store'])
+        ->can('addNote', 'ticket')->name('tickets.notes.store');
 
     Route::get('inbox', InboxController::class)
         ->can('viewAny', Ticket::class)->name('inbox');
+
+    Route::prefix('admin')->name('admin.')->group(function () {
+        Route::get('categories', [CategoryController::class, 'index'])
+            ->can('viewAny', Category::class)->name('categories.index');
+        Route::post('categories', [CategoryController::class, 'store'])
+            ->can('create', Category::class)->name('categories.store');
+        Route::patch('categories/{category}', [CategoryController::class, 'update'])
+            ->can('update', 'category')->name('categories.update');
+        Route::post('categories/{category}/archive', [CategoryController::class, 'archive'])
+            ->can('update', 'category')->name('categories.archive');
+
+        Route::get('users', [UserController::class, 'index'])
+            ->can('viewAny', User::class)->name('users.index');
+        Route::patch('users/{user}/role', [UserController::class, 'updateRole'])
+            ->can('updateRole', 'user')->name('users.role');
+    });
 });
 
 require __DIR__.'/settings.php';
```

### `app/Models/Ticket.php`, `app/Models/Category.php`, `app/Http/Middleware/HandleInertiaRequests.php`, `app/Http/Requests/StoreTicketRequest.php` (edits)

```diff
diff --git a/app/Http/Middleware/HandleInertiaRequests.php b/app/Http/Middleware/HandleInertiaRequests.php
index 8a53d36..a8f1faf 100644
--- a/app/Http/Middleware/HandleInertiaRequests.php
+++ b/app/Http/Middleware/HandleInertiaRequests.php
@@ -2,7 +2,9 @@
 
 namespace App\Http\Middleware;
 
+use App\Models\Category;
 use App\Models\Ticket;
+use App\Models\User;
 use Illuminate\Http\Request;
 use Inertia\Middleware;
 
@@ -44,6 +46,8 @@ public function share(Request $request): array
                 'can' => [
                     'openTicket' => (bool) $request->user()?->can('create', Ticket::class),
                     'viewInbox' => (bool) $request->user()?->can('viewAny', Ticket::class),
+                    'manageCategories' => (bool) $request->user()?->can('viewAny', Category::class),
+                    'manageUsers' => (bool) $request->user()?->can('viewAny', User::class),
                 ],
             ],
             'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
diff --git a/app/Http/Requests/StoreTicketRequest.php b/app/Http/Requests/StoreTicketRequest.php
index 9a271c1..e3d7fa9 100644
--- a/app/Http/Requests/StoreTicketRequest.php
+++ b/app/Http/Requests/StoreTicketRequest.php
@@ -4,6 +4,7 @@
 
 use Illuminate\Contracts\Validation\ValidationRule;
 use Illuminate\Foundation\Http\FormRequest;
+use Illuminate\Validation\Rule;
 
 class StoreTicketRequest extends FormRequest
 {
@@ -23,7 +24,11 @@ public function rules(): array
         return [
             'subject' => ['required', 'string', 'max:255'],
             'description' => ['required', 'string', 'max:10000'],
-            'category_id' => ['required', 'integer', 'exists:categories,id'],
+            'category_id' => [
+                'required',
+                'integer',
+                Rule::exists('categories', 'id')->whereNull('archived_at'),
+            ],
         ];
     }
 }
diff --git a/app/Models/Category.php b/app/Models/Category.php
index f18ae12..f02837e 100644
--- a/app/Models/Category.php
+++ b/app/Models/Category.php
@@ -2,17 +2,20 @@
 
 namespace App\Models;
 
+use Carbon\CarbonImmutable;
 use Database\Factories\CategoryFactory;
 use Illuminate\Database\Eloquent\Attributes\Fillable;
+use Illuminate\Database\Eloquent\Attributes\Scope;
+use Illuminate\Database\Eloquent\Builder;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\HasMany;
-use Illuminate\Support\Carbon;
 
 /**
  * @property int $id
  * @property string $name
- * @property Carbon|null $archived_at
+ * @property CarbonImmutable|null $archived_at
+ * @property int|null $tickets_count
  */
 #[Fillable(['name'])]
 class Category extends Model
@@ -27,6 +30,26 @@ protected function casts(): array
         ];
     }
 
+    /**
+     * Categories that new tickets can pick (R12).
+     *
+     * @param  Builder<Category>  $query
+     */
+    #[Scope]
+    protected function active(Builder $query): void
+    {
+        $query->whereNull('archived_at');
+    }
+
+    /**
+     * Archived categories can't be picked for new tickets; existing tickets keep them.
+     */
+    public function archive(): void
+    {
+        $this->archived_at ??= now();
+        $this->save();
+    }
+
     /**
      * @return HasMany<Ticket, $this>
      */
diff --git a/app/Models/Ticket.php b/app/Models/Ticket.php
index 01e50b6..5d2ff9f 100644
--- a/app/Models/Ticket.php
+++ b/app/Models/Ticket.php
@@ -5,6 +5,7 @@
 use App\Enums\TicketPriority;
 use App\Enums\TicketStatus;
 use Database\Factories\TicketFactory;
+use DomainException;
 use Illuminate\Database\Eloquent\Attributes\Fillable;
 use Illuminate\Database\Eloquent\Attributes\Scope;
 use Illuminate\Database\Eloquent\Builder;
@@ -111,6 +112,27 @@ public function addReply(User $author, string $body): Reply
         return $reply;
     }
 
+    /**
+     * A public reply with the R10 rules: closed tickets take no replies, and a
+     * customer reply on a pending or resolved ticket sets it to open (logged).
+     */
+    public function respond(User $author, string $body): Reply
+    {
+        if ($this->status === TicketStatus::Closed) {
+            throw new DomainException('Closed tickets take no replies.');
+        }
+
+        return DB::transaction(function () use ($author, $body) {
+            $reply = $this->addReply($author, $body);
+
+            if (! $author->isAgent() && in_array($this->status, [TicketStatus::Pending, TicketStatus::Resolved], true)) {
+                $this->changeStatus($author, TicketStatus::Open);
+            }
+
+            return $reply;
+        });
+    }
+
     public function addNote(User $author, string $body): InternalNote
     {
         if (! $author->isAgent()) {
```

### `app/Http/Requests/UpdateTicketRequest.php`

```php
<?php

namespace App\Http\Requests;

use App\Enums\Role;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends FormRequest
{
    /**
     * The route's can middleware has already checked the policy.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The form sends "none" for unassigned.
     */
    protected function prepareForValidation(): void
    {
        if ($this->input('assignee_id') === 'none') {
            $this->merge(['assignee_id' => null]);
        }
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['sometimes', Rule::enum(TicketStatus::class)],
            'priority' => ['sometimes', Rule::enum(TicketPriority::class)],
            'assignee_id' => [
                'sometimes',
                'nullable',
                'integer',
                Rule::exists('users', 'id')->whereIn('role', [Role::Agent->value, Role::Admin->value]),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'assignee_id.exists' => __('Only agents can be assigned.'),
        ];
    }
}
```

### `app/Http/Controllers/TicketUpdateController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TicketUpdateController extends Controller
{
    /**
     * Change status and priority (R10) and the assignee (R9).
     * Each Ticket method logs what changed (R11); all of it is saved together.
     */
    public function __invoke(UpdateTicketRequest $request, Ticket $ticket): RedirectResponse
    {
        $by = $request->user();
        $data = $request->validated();

        DB::transaction(function () use ($ticket, $by, $data) {
            if (array_key_exists('status', $data)) {
                $ticket->changeStatus($by, TicketStatus::from($data['status']));
            }

            if (array_key_exists('priority', $data)) {
                $ticket->changePriority($by, TicketPriority::from($data['priority']));
            }

            if (array_key_exists('assignee_id', $data)) {
                $ticket->assignTo($by, $data['assignee_id'] === null ? null : User::query()->whereKey($data['assignee_id'])->firstOrFail());
            }
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Ticket updated.')]);

        return to_route('tickets.show', $ticket);
    }
}
```

### `app/Http/Requests/StoreNoteRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    /**
     * The route's can middleware has already checked the policy.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'max:10000'],
        ];
    }
}
```

### `app/Http/Controllers/NoteController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class NoteController extends Controller
{
    /**
     * Add an internal note (R8). Customers never see it.
     */
    public function store(StoreNoteRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticket->addNote($request->user(), $request->validated('body'));

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Note added.')]);

        return to_route('tickets.show', $ticket);
    }
}
```

### `app/Http/Controllers/ReplyController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class ReplyController extends Controller
{
    /**
     * Add a public reply (R7) with the R10 rules. The author is always the signed-in user.
     */
    public function store(StoreReplyRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticket->respond($request->user(), $request->validated('body'));

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Reply sent.')]);

        return to_route('tickets.show', $ticket);
    }
}
```

### `app/Http/Controllers/TicketController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Category;
use App\Models\InternalNote;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\TicketChange;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    /**
     * The signed-in user's own tickets, newest first (R3).
     */
    public function index(Request $request): Response
    {
        $tickets = $request->user()->tickets()
            ->with('category')
            ->orderByDesc('id')
            ->paginate(25)
            ->through(fn (Ticket $ticket) => [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'category' => $ticket->category->name,
                'created_at' => $ticket->created_at,
            ]);

        return Inertia::render('tickets/index', ['tickets' => $tickets]);
    }

    /**
     * The form to open a ticket (R2), with active categories only (R12).
     */
    public function create(): Response
    {
        return Inertia::render('tickets/create', [
            'categories' => Category::query()->active()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Open a ticket. The customer comes from the session, never from the form.
     */
    public function store(StoreTicketRequest $request): RedirectResponse
    {
        $ticket = $request->user()->tickets()->create($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Ticket opened.')]);

        return to_route('tickets.show', $ticket);
    }

    /**
     * One ticket with its public replies and its change log (R11).
     * Internal notes are loaded only for agents (R3, R8).
     */
    public function show(Request $request, Ticket $ticket): Response
    {
        $user = $request->user();
        $isAgent = $user->isAgent();

        $ticket->load(['category', 'customer', 'assignee', 'replies.author', 'history.user']);

        if ($isAgent) {
            $ticket->load('internalNotes.author');
        }

        return Inertia::render('tickets/show', [
            'ticket' => [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'description' => $ticket->description,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'category' => $ticket->category->name,
                'customer' => $ticket->customer->name,
                'assignee' => $ticket->assignee?->name,
                'assignee_id' => $ticket->assignee_id,
                'created_at' => $ticket->created_at,
            ],
            'replies' => $ticket->replies->map(fn (Reply $reply) => [
                'id' => $reply->id,
                'body' => $reply->body,
                'author' => $reply->author?->name,
                'from_agent' => (bool) $reply->author?->isAgent(),
                'created_at' => $reply->created_at,
            ]),
            'history' => $this->history($ticket),
            'notes' => $isAgent
                ? $ticket->internalNotes->map(fn (InternalNote $note) => [
                    'id' => $note->id,
                    'body' => $note->body,
                    'author' => $note->author?->name,
                    'created_at' => $note->created_at,
                ])
                : null,
            'agents' => $isAgent
                ? User::query()->whereIn('role', [Role::Agent, Role::Admin])->orderBy('name')->get(['id', 'name'])
                : null,
            'can' => [
                'reply' => $user->can('reply', $ticket),
                'update' => $user->can('update', $ticket),
                'addNote' => $user->can('addNote', $ticket),
            ],
        ]);
    }

    /**
     * The change log with names. Assignee values are user ids, looked up in one query.
     *
     * @return array<int, array<string, mixed>>
     */
    private function history(Ticket $ticket): array
    {
        $ids = $ticket->history
            ->where('field', 'assignee')
            ->flatMap(fn (TicketChange $change) => [$change->old_value, $change->new_value])
            ->filter()
            ->unique();

        $names = User::query()->whereIn('id', $ids)->pluck('name', 'id');

        $value = fn (TicketChange $change, ?string $raw) => $change->field === 'assignee' && $raw !== null
            ? ($names[(int) $raw] ?? __('Deleted user'))
            : $raw;

        return $ticket->history->map(fn (TicketChange $change) => [
            'id' => $change->id,
            'field' => $change->field,
            'old' => $value($change, $change->old_value),
            'new' => $value($change, $change->new_value),
            'user' => $change->user?->name,
            'created_at' => $change->created_at,
        ])->values()->all();
    }
}
```

### `app/Http/Controllers/InboxController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InboxController extends Controller
{
    /**
     * Every ticket, newest first, 25 per page (R4), with filters (R5) and search (R6).
     * Unknown filter values are ignored, never passed to the query.
     */
    public function __invoke(Request $request): Response
    {
        $filters = [
            'q' => trim($request->string('q')->limit(100, '')->value()) ?: null,
            'status' => TicketStatus::tryFrom($request->string('status')->value())?->value,
            'priority' => TicketPriority::tryFrom($request->string('priority')->value())?->value,
            'category' => $request->integer('category') ?: null,
            'assignee' => $request->input('assignee') === 'none'
                ? 'none'
                : ($request->integer('assignee') ?: null),
        ];

        $tickets = Ticket::query()
            ->with(['category', 'customer', 'assignee'])
            ->when($filters['q'], fn (Builder $query, string $words) => $query->search($words))
            ->when($filters['status'], fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['priority'], fn (Builder $query, string $priority) => $query->where('priority', $priority))
            ->when($filters['category'], fn (Builder $query, int $category) => $query->where('category_id', $category))
            ->when($filters['assignee'], fn (Builder $query, int|string $assignee) => $assignee === 'none'
                ? $query->whereNull('assignee_id')
                : $query->where('assignee_id', $assignee))
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString()
            ->through(fn (Ticket $ticket) => [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'category' => $ticket->category->name,
                'customer' => $ticket->customer->name,
                'assignee' => $ticket->assignee?->name,
                'created_at' => $ticket->created_at,
            ]);

        return Inertia::render('inbox', [
            'tickets' => $tickets,
            'filters' => $filters,
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
            'agents' => User::query()->whereIn('role', [Role::Agent, Role::Admin])->orderBy('name')->get(['id', 'name']),
        ]);
    }
}
```

### `app/Policies/CategoryPolicy.php`

```php
<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Admins manage categories (R12).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Renaming and archiving.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->isAdmin();
    }
}
```

### `app/Policies/UserPolicy.php`

```php
<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Admins see the user list and set roles (R12).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function updateRole(User $user, User $model): bool
    {
        return $user->isAdmin();
    }
}
```

### `app/Http/Requests/Admin/StoreCategoryRequest.php`

```php
<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * The route's can middleware has already checked the policy.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
        ];
    }
}
```

### `app/Http/Requests/Admin/UpdateCategoryRequest.php`

```php
<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * The route's can middleware has already checked the policy.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Category $category */
        $category = $this->route('category');

        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('categories', 'name')->ignore($category)],
        ];
    }
}
```

### `app/Http/Requests/Admin/UpdateUserRoleRequest.php`

```php
<?php

namespace App\Http\Requests\Admin;

use App\Enums\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRoleRequest extends FormRequest
{
    /**
     * The route's can middleware has already checked the policy.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', Rule::enum(Role::class)],
        ];
    }
}
```

### `app/Http/Controllers/Admin/CategoryController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Every category, archived ones included, with its ticket count (R12).
     */
    public function index(): Response
    {
        return Inertia::render('admin/categories', [
            'categories' => Category::query()
                ->withCount('tickets')
                ->orderBy('name')
                ->get()
                ->map(fn (Category $category) => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'archived' => $category->archived_at !== null,
                    'tickets_count' => $category->tickets_count,
                ]),
        ]);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Category created.')]);

        return to_route('admin.categories.index');
    }

    /**
     * Rename. Tickets keep their category; only the name changes.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Category renamed.')]);

        return to_route('admin.categories.index');
    }

    /**
     * Archive: no new tickets can pick it; existing tickets keep it.
     */
    public function archive(Category $category): RedirectResponse
    {
        $category->archive();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Category archived.')]);

        return to_route('admin.categories.index');
    }
}
```

### `app/Http/Controllers/Admin/UserController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Every user and their role, 25 per page, admins first, then agents (R12).
     */
    public function index(): Response
    {
        return Inertia::render('admin/users', [
            'users' => User::query()
                ->orderByRaw("case role when 'admin' then 0 when 'agent' then 1 else 2 end")
                ->orderBy('name')
                ->paginate(25)
                ->through(fn (User $user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ]),
        ]);
    }

    /**
     * Set a role. The last admin keeps the admin role (decision D2).
     */
    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        $role = Role::from($request->validated('role'));

        DB::transaction(function () use ($user, $role) {
            $admins = User::query()->where('role', Role::Admin)->lockForUpdate()->pluck('id');

            if ($admins->count() === 1 && $admins->contains($user->id) && $role !== Role::Admin) {
                throw ValidationException::withMessages([
                    'role' => __('There must always be at least one admin.'),
                ]);
            }

            $user->role = $role;
            $user->save();
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Role updated.')]);

        return back();
    }
}
```

### `resources/js/components/app-sidebar.tsx` and `resources/js/types` (edits)

```diff
diff --git a/resources/js/components/app-sidebar.tsx b/resources/js/components/app-sidebar.tsx
index 2d4d06f..ed8a566 100644
--- a/resources/js/components/app-sidebar.tsx
+++ b/resources/js/components/app-sidebar.tsx
@@ -1,5 +1,13 @@
 import { Link, usePage } from '@inertiajs/react';
-import { BookOpen, FolderGit2, Inbox, LayoutGrid, Ticket } from 'lucide-react';
+import {
+    BookOpen,
+    FolderGit2,
+    Inbox,
+    LayoutGrid,
+    Tags,
+    Ticket,
+    Users,
+} from 'lucide-react';
 import AppLogo from '@/components/app-logo';
 import { NavFooter } from '@/components/nav-footer';
 import { NavMain } from '@/components/nav-main';
@@ -14,6 +22,8 @@ import {
     SidebarMenuItem,
 } from '@/components/ui/sidebar';
 import { dashboard, inbox } from '@/routes';
+import { index as categories } from '@/routes/admin/categories';
+import { index as users } from '@/routes/admin/users';
 import { index as tickets } from '@/routes/tickets';
 import type { NavItem } from '@/types';
 
@@ -46,6 +56,12 @@ export function AppSidebar() {
         ...(auth.can.viewInbox
             ? [{ title: 'Inbox', href: inbox(), icon: Inbox }]
             : []),
+        ...(auth.can.manageCategories
+            ? [{ title: 'Categories', href: categories(), icon: Tags }]
+            : []),
+        ...(auth.can.manageUsers
+            ? [{ title: 'Users', href: users(), icon: Users }]
+            : []),
     ];
 
     return (
diff --git a/resources/js/types/auth.ts b/resources/js/types/auth.ts
index 1913494..b305c99 100644
--- a/resources/js/types/auth.ts
+++ b/resources/js/types/auth.ts
@@ -15,6 +15,8 @@ export type Auth = {
     can: {
         openTicket: boolean;
         viewInbox: boolean;
+        manageCategories: boolean;
+        manageUsers: boolean;
     };
 };
```

### `resources/js/components/ticket-history.tsx`

```tsx
export type HistoryEntry = {
    id: number;
    field: 'status' | 'priority' | 'assignee';
    old: string | null;
    new: string | null;
    user: string | null;
    created_at: string;
};

export function TicketHistory({ history }: { history: HistoryEntry[] }) {
    return (
        <section className="space-y-3" aria-label="Activity">
            <h2 className="font-medium">Activity</h2>
            {history.length === 0 ? (
                <p className="text-sm text-muted-foreground">No changes yet.</p>
            ) : (
                <ol className="space-y-2 border-l pl-4 text-sm">
                    {history.map((entry) => (
                        <li key={entry.id}>
                            <span className="font-medium">
                                {entry.user ?? 'Deleted user'}
                            </span>{' '}
                            changed {entry.field} from{' '}
                            <span className="font-medium">
                                {entry.old ?? 'nobody'}
                            </span>{' '}
                            to{' '}
                            <span className="font-medium">
                                {entry.new ?? 'nobody'}
                            </span>
                            <span className="block text-xs text-muted-foreground">
                                {new Date(entry.created_at).toLocaleString()}
                            </span>
                        </li>
                    ))}
                </ol>
            )}
        </section>
    );
}
```

### `resources/js/components/ticket-notes.tsx`

```tsx
import { Form } from '@inertiajs/react';
import NoteController from '@/actions/App/Http/Controllers/NoteController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';

export type Note = {
    id: number;
    body: string;
    author: string | null;
    created_at: string;
};

export function TicketNotes({
    ticketId,
    notes,
}: {
    ticketId: number;
    notes: Note[];
}) {
    return (
        <section
            className="space-y-3 rounded-xl border border-dashed p-4"
            aria-label="Internal notes"
        >
            <div>
                <h2 className="font-medium">Internal notes</h2>
                <p className="text-xs text-muted-foreground">
                    Only agents see these. Customers never do.
                </p>
            </div>
            {notes.map((note) => (
                <article key={note.id} className="text-sm">
                    <p className="mb-1 text-xs text-muted-foreground">
                        {note.author ?? 'Deleted user'} ·{' '}
                        {new Date(note.created_at).toLocaleString()}
                    </p>
                    <p className="whitespace-pre-line">{note.body}</p>
                </article>
            ))}
            <Form
                {...NoteController.store.form(ticketId)}
                options={{ preserveScroll: true }}
                resetOnSuccess
                className="space-y-2"
            >
                {({ processing, errors }) => (
                    <>
                        <Label htmlFor="note">New note</Label>
                        <textarea
                            id="note"
                            name="body"
                            required
                            rows={3}
                            className="w-full rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-xs md:text-sm"
                        />
                        <InputError message={errors.body} />
                        <Button variant="secondary" disabled={processing}>
                            Add note
                        </Button>
                    </>
                )}
            </Form>
        </section>
    );
}
```

### `resources/js/components/ticket-manage-form.tsx` (116 lines, summarised)

- Imports `Form` from `@inertiajs/react`, the Wayfinder action `TicketUpdateController`, and the kit's `InputError`, `Button`, `Label` and `Select` components.
- Fixed lists: statuses (open, pending, resolved, closed) and priorities (low, normal, high, urgent).
- A small `Field` component: a `Label`, a shadcn `Select` with a `name` (so the form sends it), a trigger with the same id, one item per option, and an `InputError`.
- `TicketManageForm({ ticket, agents })` renders `<Form {...TicketUpdateController.form(ticket.id)} options={{ preserveScroll: true }} aria-label="Manage ticket">`, a bordered grid (one column on phones, three from `sm`), with three fields: Status, Priority, and Assignee (first item "Unassigned" with the value `none`, then one item per agent, value = the id as a string). Each shows its own error.
- A "Save changes" button, disabled while processing.

### `resources/js/pages/tickets/show.tsx` (159 lines, summarised)

- Props: `ticket` (now with `assignee_id`), `replies`, `history`, `notes` (null for customers), `agents` (null for customers) and `can` (reply, update, addNote).
- Back link, header, description and the replies list as in Episode 33.
- The manage form appears only when `can.update` and `agents` are set.
- When `can.reply` is true: the reply form from Episode 33. Otherwise one bordered line: "This ticket is closed. Closed tickets take no replies."
- Then `TicketNotes` when `can.addNote` and `notes` are set, and `TicketHistory` for everyone.

### `resources/js/pages/inbox.tsx` (178 lines, summarised)

- As in Episode 33, plus `q` in the filters.
- `apply(key, value)` now trims the value and treats an empty value or `all` as null.
- A search form above the filters: `role="search"`, an `Input` named `q` (type search, `aria-label` "Search tickets", placeholder "Search subjects and replies", `maxLength` 100, the current `q` as its default value) and a "Search" button. On submit it prevents the full page post, reads `q` from `FormData` (checking it is a string) and calls `apply('q', ...)`, so the search goes into the address like the filters.

### `resources/js/pages/admin/categories.tsx` (126 lines, summarised)

- Props: `categories` (id, name, archived, tickets_count).
- Heading "Categories" with the line "Archived categories can't be picked for new tickets. Existing tickets keep them."
- A create form (`CategoryController.store.form()`, `resetOnSuccess`): a labelled "New category" input (`name`, required, max 100), its error, and a "Create" button.
- One list item per category: the name, an "archived" badge when archived, and "1 ticket" or "N tickets". Under it, a rename form (`CategoryController.update.form(id)`, the name as default value, a "Rename" button, its error) and, for active categories only, an archive form (`CategoryController.archive.form(id)`) with an "Archive" button. Both keep the scroll position. Rows stack on phones and sit side by side from `sm`.
- Layout breadcrumbs: Categories.

### `resources/js/pages/admin/users.tsx` (102 lines, summarised)

- Props: `users`, paginated (id, name, email, role).
- Heading "Users" with the line "Set each person's role. There is always at least one admin."
- One list item per user: name and email (truncated), then a form (`UserController.updateRole.form(id)`, preserveScroll) with a shadcn `Select` named `role` (customer, agent, admin; the trigger's `aria-label` is "Role of" and the name), a "Save" button, and the role error under it, which is where "There must always be at least one admin." appears.
- `PaginationLinks` from Episode 33 under the list. Layout breadcrumbs: Users.

### `tests/Feature/Tickets/SearchTest.php`

```php
<?php

use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('agents search by words in the subject', function () {
    $match = Ticket::factory()->create(['subject' => 'Printer jam on floor two']);
    Ticket::factory()->create(['subject' => 'Printer offline']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'printer jam']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id)
            ->where('filters.q', 'printer jam'));
});

test('agents search by words in a reply', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $ticket->addReply($ticket->customer, 'The invoice shows the wrong address.');
    Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'invoice']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $ticket->id));
});

test('search does not look in internal notes', function () {
    $ticket = Ticket::factory()->create(['subject' => 'Order question']);
    $agent = User::factory()->agent()->create();
    $ticket->addNote($agent, 'Finance approved a chargeback.');

    $this->actingAs($agent)
        ->get(route('inbox', ['q' => 'chargeback']))
        ->assertInertia(fn (Assert $page) => $page->has('tickets.data', 0));
});

test('search combines with the filters', function () {
    $match = Ticket::factory()->create(['subject' => 'Refund request', 'status' => 'pending']);
    Ticket::factory()->create(['subject' => 'Refund request', 'status' => 'open']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'refund', 'status' => 'pending']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id));
});

test('page links keep the search', function () {
    Ticket::factory()->count(26)->create(['subject' => 'Refund request']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['q' => 'refund']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 25)
            ->where('tickets.next_page_url', fn (string $url) => str_contains($url, 'q=refund')));
});
```

### `tests/Feature/Tickets/NotesTest.php`

```php
<?php

use App\Models\InternalNote;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('an agent adds an internal note', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->post(route('tickets.notes.store', $ticket), ['body' => 'Customer is on the refund watch list.'])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->internalNotes()->sole()->author_id)->toBe($agent->id);
});

test('agents see internal notes on the ticket page', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $ticket->addNote($agent, 'Check the billing system first.');

    $this->actingAs($agent)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page
            ->has('notes', 1)
            ->where('notes.0.body', 'Check the billing system first.')
            ->where('notes.0.author', $agent->name));
});

test('a customer cannot add a note, even on their own ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.notes.store', $ticket), ['body' => 'Hello'])
        ->assertForbidden();

    $this->actingAs($ticket->customer)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page->where('notes', null));

    expect(InternalNote::count())->toBe(0);
});

test('a note needs a body', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->post(route('tickets.notes.store', $ticket), ['body' => ''])
        ->assertSessionHasErrors('body');

    expect(InternalNote::count())->toBe(0);
});
```

### `tests/Feature/Tickets/AssignmentTest.php`

```php
<?php

use App\Models\Ticket;
use App\Models\User;

test('an agent assigns a ticket to any agent, and it is logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $other = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->patch(route('tickets.update', $ticket), ['assignee_id' => $other->id])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->fresh()->assignee_id)->toBe($other->id)
        ->and($ticket->history()->sole()->only(['field', 'new_value', 'user_id']))
        ->toBe(['field' => 'assignee', 'new_value' => (string) $other->id, 'user_id' => $agent->id]);
});

test('an agent unassigns a ticket', function () {
    $agent = User::factory()->agent()->create();
    $ticket = Ticket::factory()->assignedTo($agent)->create();

    $this->actingAs($agent)->patch(route('tickets.update', $ticket), ['assignee_id' => 'none']);

    expect($ticket->fresh()->assignee_id)->toBeNull();
});

test('a customer cannot be assigned', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->patch(route('tickets.update', $ticket), ['assignee_id' => $ticket->customer_id])
        ->assertSessionHasErrors('assignee_id');

    expect($ticket->fresh()->assignee_id)->toBeNull()
        ->and($ticket->history()->count())->toBe(0);
});

test('a customer cannot assign their own ticket', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($ticket->customer)
        ->patch(route('tickets.update', $ticket), ['assignee_id' => $agent->id])
        ->assertForbidden();

    expect($ticket->fresh()->assignee_id)->toBeNull();
});
```

### `tests/Feature/Tickets/StatusAndPriorityTest.php`

```php
<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;

test('an agent changes status and priority, and both are logged', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->patch(route('tickets.update', $ticket), ['status' => 'pending', 'priority' => 'urgent'])
        ->assertRedirect(route('tickets.show', $ticket));

    $ticket->refresh();
    expect($ticket->status)->toBe(TicketStatus::Pending)
        ->and($ticket->priority)->toBe(TicketPriority::Urgent)
        ->and($ticket->history->map->only(['field', 'old_value', 'new_value', 'user_id'])->all())->toBe([
            ['field' => 'status', 'old_value' => 'open', 'new_value' => 'pending', 'user_id' => $agent->id],
            ['field' => 'priority', 'old_value' => 'normal', 'new_value' => 'urgent', 'user_id' => $agent->id],
        ]);
});

test('a customer cannot change status or priority', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->patch(route('tickets.update', $ticket), ['status' => 'closed'])
        ->assertForbidden();

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open);
});

test('an unknown status is refused', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->patch(route('tickets.update', $ticket), ['status' => 'deleted'])
        ->assertSessionHasErrors('status');

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open);
});
```

### `tests/Feature/Tickets/ReplyStatusRulesTest.php`

```php
<?php

use App\Enums\TicketStatus;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;

// R10: four customer reply cases and two agent reply cases.

test('1. a customer reply on an open ticket keeps it open', function () {
    $ticket = Ticket::factory()->create(['status' => 'open']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Any news?']);

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open)
        ->and($ticket->replies()->count())->toBe(1)
        ->and($ticket->history()->count())->toBe(0);
});

test('2. a customer reply on a pending ticket sets it to open, logged as the customer', function () {
    $ticket = Ticket::factory()->create(['status' => 'pending']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Here is the screenshot.']);

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open)
        ->and($ticket->history()->sole()->only(['field', 'old_value', 'new_value', 'user_id']))
        ->toBe(['field' => 'status', 'old_value' => 'pending', 'new_value' => 'open', 'user_id' => $ticket->customer_id]);
});

test('3. a customer reply on a resolved ticket sets it to open', function () {
    $ticket = Ticket::factory()->create(['status' => 'resolved']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'It broke again.']);

    expect($ticket->fresh()->status)->toBe(TicketStatus::Open);
});

test('4. a customer reply on a closed ticket is refused', function () {
    $ticket = Ticket::factory()->create(['status' => 'closed']);

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Hello?'])
        ->assertForbidden();

    expect(Reply::count())->toBe(0)
        ->and($ticket->fresh()->status)->toBe(TicketStatus::Closed);
});

test('5. an agent reply leaves an open, pending or resolved ticket unchanged', function () {
    $agent = User::factory()->agent()->create();

    foreach (['open', 'pending', 'resolved'] as $status) {
        $ticket = Ticket::factory()->create(['status' => $status]);

        $this->actingAs($agent)
            ->post(route('tickets.replies.store', $ticket), ['body' => 'Looking into it.']);

        expect($ticket->fresh()->status->value)->toBe($status)
            ->and($ticket->replies()->count())->toBe(1);
    }
});

test('6. an agent reply on a closed ticket is refused', function () {
    $ticket = Ticket::factory()->create(['status' => 'closed']);

    $this->actingAs(User::factory()->agent()->create())
        ->post(route('tickets.replies.store', $ticket), ['body' => 'One more thing.'])
        ->assertForbidden();

    expect(Reply::count())->toBe(0);
});
```

### `tests/Feature/Tickets/HistoryTest.php`

```php
<?php

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('the ticket page shows each change with who made it', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create(['name' => 'Alex Agent']);
    $ticket->changeStatus($agent, TicketStatus::Pending);

    $this->actingAs($agent)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page
            ->has('history', 1)
            ->where('history.0.field', 'status')
            ->where('history.0.old', 'open')
            ->where('history.0.new', 'pending')
            ->where('history.0.user', 'Alex Agent'));
});

test('assignee changes show names, and the customer sees the history too', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create(['name' => 'Alex Agent']);
    $ticket->assignTo($agent, $agent);

    $this->actingAs($ticket->customer)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page
            ->where('history.0.field', 'assignee')
            ->where('history.0.old', null)
            ->where('history.0.new', 'Alex Agent'));
});

test('a deleted assignee shows as a deleted user', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();
    $gone = User::factory()->agent()->create();
    $ticket->assignTo($agent, $gone);
    $gone->delete();

    $this->actingAs($agent)->get(route('tickets.show', $ticket))
        ->assertInertia(fn (Assert $page) => $page->where('history.0.new', 'Deleted user'));
});
```

### `tests/Feature/Tickets/ArchivedCategoriesTest.php`

```php
<?php

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('the new ticket form lists active categories only', function () {
    Category::factory()->create(['name' => 'Billing']);
    Category::factory()->create(['name' => 'Legacy', 'archived_at' => now()]);

    $this->actingAs(User::factory()->create())
        ->get(route('tickets.create'))
        ->assertInertia(fn (Assert $page) => $page
            ->has('categories', 1)
            ->where('categories.0.name', 'Billing'));
});

test('a ticket cannot be opened in an archived category', function () {
    $archived = Category::factory()->create(['archived_at' => now()]);

    $this->actingAs(User::factory()->create())
        ->post(route('tickets.store'), [
            'subject' => 'Old thing',
            'description' => 'Still broken.',
            'category_id' => $archived->id,
        ])
        ->assertSessionHasErrors('category_id');

    expect(Ticket::count())->toBe(0);
});

test('existing tickets keep an archived category', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create(['category_id' => $category->id]);

    $this->actingAs(User::factory()->admin()->create())
        ->post(route('admin.categories.archive', $category));

    expect($ticket->fresh()->category_id)->toBe($category->id);
});
```

### `tests/Feature/Admin/CategoriesTest.php`

```php
<?php

use App\Models\Category;
use App\Models\User;

test('an admin creates a category', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->post(route('admin.categories.store'), ['name' => 'Shipping'])
        ->assertRedirect();

    expect(Category::sole()->name)->toBe('Shipping');
});

test('a category name is required and unique', function () {
    $admin = User::factory()->admin()->create();
    Category::factory()->create(['name' => 'Billing']);

    $this->actingAs($admin)
        ->post(route('admin.categories.store'), ['name' => ''])
        ->assertSessionHasErrors('name');
    $this->actingAs($admin)
        ->post(route('admin.categories.store'), ['name' => 'Billing'])
        ->assertSessionHasErrors('name');

    expect(Category::count())->toBe(1);
});

test('an admin renames a category', function () {
    $category = Category::factory()->create(['name' => 'Billing']);

    $this->actingAs(User::factory()->admin()->create())
        ->patch(route('admin.categories.update', $category), ['name' => 'Payments'])
        ->assertRedirect();

    expect($category->fresh()->name)->toBe('Payments');
});

test('an admin archives a category instead of deleting it', function () {
    $category = Category::factory()->create();

    $this->actingAs(User::factory()->admin()->create())
        ->post(route('admin.categories.archive', $category))
        ->assertRedirect();

    expect($category->fresh()->archived_at)->not->toBeNull()
        ->and(Category::count())->toBe(1);
});

test('agents and customers cannot manage categories', function () {
    $category = Category::factory()->create(['name' => 'Billing']);

    foreach ([User::factory()->agent()->create(), User::factory()->create()] as $user) {
        $this->actingAs($user)->get(route('admin.categories.index'))->assertForbidden();
        $this->actingAs($user)->post(route('admin.categories.store'), ['name' => 'New'])->assertForbidden();
        $this->actingAs($user)->post(route('admin.categories.archive', $category))->assertForbidden();
    }

    expect(Category::count())->toBe(1)
        ->and($category->fresh()->archived_at)->toBeNull();
});
```

### `tests/Feature/Admin/UsersTest.php`

```php
<?php

use App\Enums\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('an admin sets a user role', function () {
    $user = User::factory()->create();

    $this->actingAs(User::factory()->admin()->create())
        ->patch(route('admin.users.role', $user), ['role' => 'agent'])
        ->assertRedirect();

    expect($user->fresh()->role)->toBe(Role::Agent);
});

test('agents and customers cannot change roles', function () {
    $user = User::factory()->create();

    foreach ([User::factory()->agent()->create(), $user] as $actor) {
        $this->actingAs($actor)->get(route('admin.users.index'))->assertForbidden();
        $this->actingAs($actor)
            ->patch(route('admin.users.role', $user), ['role' => 'admin'])
            ->assertForbidden();
    }

    expect($user->fresh()->role)->toBe(Role::Customer);
});

test('an unknown role is refused', function () {
    $user = User::factory()->create();

    $this->actingAs(User::factory()->admin()->create())
        ->patch(route('admin.users.role', $user), ['role' => 'owner'])
        ->assertSessionHasErrors('role');

    expect($user->fresh()->role)->toBe(Role::Customer);
});

test('the last admin cannot remove their own admin role', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.role', $admin), ['role' => 'agent'])
        ->assertSessionHasErrors(['role' => 'There must always be at least one admin.']);

    expect($admin->fresh()->role)->toBe(Role::Admin);
});

test('with two admins, one can step down', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.role', $admin), ['role' => 'agent'])
        ->assertSessionHasNoErrors();

    expect($admin->fresh()->role)->toBe(Role::Agent);
});

test('the users page lists admins first, then agents', function () {
    User::factory()->create(['name' => 'Aaron Customer']);
    User::factory()->agent()->create(['name' => 'Bea Agent']);
    $admin = User::factory()->admin()->create(['name' => 'Zed Admin']);

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertInertia(fn (Assert $page) => $page
            ->where('users.data.0.name', 'Zed Admin')
            ->where('users.data.1.name', 'Bea Agent')
            ->where('users.data.2.name', 'Aaron Customer'));
});
```

### `check.mjs` (Playwright phone-width check, local copy only, never committed)

```js
import { chromium } from 'playwright-core';
const base = 'http://127.0.0.1:8123';
const shots = '/workspace/capstone-throwaway/pw/ep34';
const browser = await chromium.launch({ executablePath: '/usr/bin/google-chrome', headless: true });
const results = [];
async function session(email, steps) {
  const ctx = await browser.newContext({ viewport: { width: 390, height: 844 } });
  const page = await ctx.newPage();
  const errors = [];
  page.on('pageerror', e => errors.push(String(e)));
  page.on('console', m => { if (m.type() === 'error') errors.push(m.text()); });
  await page.goto(base + '/login');
  await page.fill('#email', email);
  await page.fill('#password', 'demo-password-123');
  await page.click('button[type=submit]');
  await page.waitForURL(u => !u.pathname.startsWith('/login'));
  await steps(page);
  results.push({ email, errors });
  await ctx.close();
}
async function check(page, name) {
  await page.waitForLoadState('networkidle');
  const overflow = await page.evaluate(() => document.documentElement.scrollWidth - window.innerWidth);
  await page.screenshot({ path: `${shots}/${name}.png`, fullPage: true });
  results.push({ name, url: page.url(), overflow });
}
let ticketUrl;
await session('demo-agent@example.test', async (page) => {
  await page.goto(base + '/inbox');
  await page.getByLabel('Search tickets').fill('invoice');
  await page.getByRole('button', { name: 'Search' }).click();
  await page.waitForURL(/q=invoice/); await check(page, 'a-search');
  results.push({ searchRows: await page.locator('ul a').count() });
  await page.locator('ul a').first().click();
  await page.waitForURL(/\/tickets\/\d+$/); ticketUrl = page.url();
  await page.fill('#note', 'Checked the logs. Download link expired.');
  await page.getByRole('button', { name: /note/i }).click();
  await page.getByText('Checked the logs. Download link expired.').first().waitFor();
  await page.click('#status'); await page.getByRole('option', { name: 'closed' }).click();
  await page.getByRole('button', { name: 'Save changes' }).click();
  await page.getByText(/changed status/).first().waitFor();
  await check(page, 'a-ticket-managed');
  results.push({ agentSeesNotes: await page.getByRole('region', { name: 'Internal notes' }).count() });
});
await session('demo-customer@example.test', async (page) => {
  await page.goto(ticketUrl); await check(page, 'c-closed-ticket');
  results.push({
    closedMessage: await page.getByText('Closed tickets take no replies.').count(),
    customerSeesNote: await page.getByText('Checked the logs. Download link expired.').count(),
    replyBox: await page.locator('#body').count(),
    manageForm: await page.getByRole('form', { name: 'Manage ticket' }).count(),
  });
  const admin = await page.goto(base + '/admin/categories'); results.push({ customerAdminStatus: admin.status() });
});
await session('demo-admin@example.test', async (page) => {
  await page.goto(base + '/admin/categories'); await check(page, 'ad-categories');
  const name = 'Returns ' + Date.now().toString().slice(-4);
  await page.fill('#new-category', name);
  await page.getByRole('button', { name: 'Create' }).click();
  await page.getByText(name, { exact: true }).waitFor();
  const row = page.locator('li', { hasText: name });
  await row.getByRole('button', { name: 'Archive' }).click();
  await row.getByText('archived').waitFor();
  await check(page, 'ad-categories-archived');
  await page.goto(base + '/admin/users'); await check(page, 'ad-users');
  const me = page.locator('li', { hasText: 'demo-admin@example.test' });
  await me.getByRole('combobox').click(); await page.getByRole('option', { name: 'agent' }).click();
  await me.getByRole('button', { name: 'Save' }).click();
  await me.getByText('There must always be at least one admin.').waitFor();
  await check(page, 'ad-users-last-admin');
  results.push({ lastAdminRefused: true });
  await page.locator('[data-sidebar=trigger]').first().click();
  await page.getByRole('link', { name: 'Users' }).first().waitFor();
  results.push({ sidebarLinks: { categories: await page.getByRole('link', { name: 'Categories' }).count(), users: await page.getByRole('link', { name: 'Users' }).count() } });
  await check(page, 'ad-sidebar');
});
console.log(JSON.stringify(results, null, 1));
await browser.close();
```

---

## Production notes
- Spoken word count: about 2,680 words, roughly 17:59 at the Episode 31 pace (2,682 words ran 18:01), plus slide pauses (plan target about 40).
- Illustrated walkthrough, not a recording. No output is shown, and no screenshot of the app is used (the Playwright screenshots stay in ep34-build/screens for checking only). Built in /workspace/capstone-throwaway/support-desk (Laravel 13, PHP 8.5, PostgreSQL 17, Inertia 3, React 19, OpenSpec 1.14.1) from main holding Episode 33.
- Decisions: commit dbf1a7a on main added the Decisions section (D1, D2, D3) to docs/requirements.md, before either branch, so both worktrees had it. The same commit excludes the generated resources/js/actions/Illuminate folder from tsconfig.json (Wayfinder's RedirectController 'query' method, the upstream issue noted since Episode 29); npm run types:check passes since.
- Worktrees, for real: the main checkout ran add-ticket-work; git worktree add ../support-desk-admin -b add-admin-area made the second folder. In it: .env copied by hand (plain git, no .worktreeinclude), composer install, npm ci, and its own database support_desk_test_admin, created as the postgres user because the app's database user cannot create databases; tests ran with DB_DATABASE=support_desk_test_admin (PHPUnit's env values do not override variables that are already set). The machine was shared and at times heavily loaded, so the two halves were built one after the other rather than with two sessions at once, and heavy jobs (build, tests, tsc) never ran in parallel.
- Merge: add-ticket-work fast-forwarded into main; main merged into add-admin-area with one conflict (the use lines of routes/web.php: TicketUpdateController against Category; both kept); TicketController auto-merged. After the merge, in the worktree: Pint, PHPStan, tsc and vp check passed, npm run build, 132 tests passed. add-admin-area fast-forwarded into main; git worktree remove ../support-desk-admin; the extra test database was dropped.
- Deliberate breaks: (1) reopen rule removed from Ticket::respond: tests 2 and 3 of ReplyStatusRulesTest failed; restored. (2) the last-admin check in UserController::updateRole switched off: "the last admin cannot remove their own admin role" failed; restored. While reviewing, the check was changed to read the locked admin ids (admins count is 1 and contains this user) instead of the user model loaded before the lock.
- Playwright check: playwright-core with the system Chrome, headless, 390 by 844, against php artisan serve on port 8123 with built assets; three local accounts (customer, agent, admin; the admin was created with tinker in the dev database only). First run stopped at the users page: sorted by name, the admin was not on page 1 of 20,000+ users. Follow-up change list-admins-first (orders admin, agent, customer, then name; 1 test; MODIFIED Manage roles, all 6 scenarios). Also fixed "1 tickets" wording on the categories page. Final run: scrollWidth equal to the window width on all 8 checked pages; search for "invoice" returned rows; note added; ticket closed and logged; the customer saw the closed message, no note, no reply box and no manage form, and got 403 on /admin/categories (the only console error); category created and archived; the last-admin error shown; the mobile sidebar showed Categories and Users for the admin. The server was stopped after each run, and nothing heavy was left running.
- R1 audit for "done": no spec in openspec/specs covered R1. add-accounts-spec added the accounts capability (3 requirements, 8 scenarios: register; right password, wrong password, sign out, too many attempts; reset link, valid token, invalid token), each matched to an existing starter kit test in tests/Feature/Auth (26 tests there, passing). No code changed. The main specs' placeholder Purpose lines (written by archive) were replaced with one-line purposes in the main specs directly, as OpenSpec's validator suggests; openspec validate --specs --strict: 11 passed.
- CI stand-in: the throwaway project has no git remote, so push, gh pr create, the pull requests, the code-reviewer subagent and GitHub CI were not run, and the push and PR commands are left out of the description's command list. composer ci:check (npm run check, npm run types:check, then the test script with Pint, PHPStan and Pest) passed on main after the merges: 133 tests. The later add-accounts-spec commit changed specs only; tests/Feature/Auth was run again (26 passed). Claude was not run: explore, propose and apply are described as the course's reviewed plan and code.
- openspec archive results: add-ticket-work + 6, ~ 1 (ticket-management 4 requirements, 14 scenarios; agent-inbox Search 5; ticket-replies MODIFIED Reply on a ticket 5, ADDED Status rule on reply 6). add-admin-area + 2, ~ 1 (admin-area 2 requirements, 10 scenarios; customer-tickets MODIFIED Open a ticket, 8 scenarios, 3 new). list-admins-first ~ 1. add-accounts-spec + 3. Capabilities: accounts, admin-area, agent-inbox, customer-tickets, ticket-conversation, ticket-history, ticket-management, ticket-queries, ticket-replies, tickets, user-roles (11).
- Requirement map: R1 accounts; R2, R3 customer-tickets; R4, R5, R6 agent-inbox; R7 ticket-replies; R8, R9 ticket-management; R10 ticket-management and ticket-replies; R11 ticket-history and ticket-management; R12 admin-area and customer-tickets.
- Laravel facts (laravel.com/docs/13.x): authorization (Response::deny with a message, denyAsNotFound, the can middleware with a parameter name or a class); queries ("Pessimistic Locking": lockForUpdate prevents the selected records from being modified until the transaction commits, wrapped in a transaction); validation (sometimes, Rule::enum, Rule::exists with whereNull, unique with ignore, prepareForValidation); database transactions; eloquent (local scopes with the Scope attribute); full text where clauses (whereFullText, PostgreSQL).
- Claude Code facts (code.claude.com/docs/en/worktrees): a worktree is a fresh checkout and needs its own setup; .worktreeinclude copies gitignored files such as .env into worktrees Claude Code creates.
- git facts (git-scm.com/docs/git-worktree): git worktree add with -b, git worktree remove.
- Logic checks: 1 + 5 + 6 = 12 requirements; 3 groups (1 + 4 + 1 = 6); 4 explore questions (3 decisions + the split); R10: 4 customer + 2 agent = 6 cases, 6 tests; tests 5 + 4 + 4 + 3 + 6 + 3 = 25 and 5 + 3 + 6 = 14, 25 + 14 = 39, slide groups 9 + 7 + 9 + 14 = 39; 94 + 39 = 133; capabilities 8 + 3 = 11; new routes 2 + 6 = 8. The agenda's three parts match the three dividers.
- YouTube description: 4,441 characters, under the 4,500 target, no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Three Decisions, Two Worktrees, Twelve Requirements Done | Laravel 13 + React with Claude Code | Agentic Engineering Ep 34
2. Search, Notes, Status Rules and an Admin Area, Planned with OpenSpec | Ep 34
3. Capstone, Core Features Part 2 | Agentic Engineering Ep 34

### Description (ready to paste, 4,441 characters)

```
Episode 34 of Agentic Engineering, a free course on agentic coding.
Support Desk core features, part 2: search (R6), internal notes (R8), assignment (R9), status and reply rules (R10), activity (R11), and the admin area (R12). Three decisions, two git worktrees, 39 new tests, a phone check, and all 12 requirements done.
Screens are drawn illustrations; no output is shown. Files are written for the course.

Decisions (added to docs/requirements.md):
D1 Search covers subjects and public replies only. Internal notes are not searched.
D2 The last admin keeps the admin role. A role change that would leave no admin is refused.
D3 Customers do not edit a ticket after opening it, including its category. They can say so in a reply.

R10 in six cases. Customer reply: open stays open; pending and resolved become open; closed is refused. Agent reply: open, pending or resolved stay as they are; closed is refused.

Prompts:
/opsx:explore R6, R8, R9, R10, R11 and R12 in docs/requirements.md, and the three open gaps from Episode 28: does search include internal notes, can the last admin remove their own admin role, can a customer change a ticket's category. Can the work split into two parts that run side by side? Read the requirements, openspec/specs, TicketPolicy and the routes first. Ask me one question at a time.

/opsx:propose add-ticket-work: search (subjects and public replies, never notes), internal notes for agents, assignment, status and priority on one PATCH route, the R10 reply rules with exactly six cases, and the activity list on the ticket page. Pest tests for every scenario, one per R10 case. No admin area.

/opsx:propose add-admin-area: admins create, rename and archive categories, and set user roles. Archived categories cannot be picked for new tickets. The last admin keeps the admin role (D2), checked in a locked transaction. Pest tests for every scenario.

/clear, then /opsx:apply add-ticket-work (in the main checkout) and /opsx:apply add-admin-area (in ../support-desk-admin)

Use Playwright MCP at 390 by 844. As the agent: search the inbox, open a ticket, add a note, close it. As the customer: open that ticket. As the admin: create and archive a category, then try to remove your own admin role. Tell me any page that scrolls sideways or shows a console error.

Use the code-reviewer subagent to review each change against the laravel-security and react-best-practices skills.

/opsx:archive add-ticket-work, then /opsx:archive add-admin-area

Commands:
git switch main && git pull
git add docs/requirements.md && git commit -m "Decide the three open questions"
git worktree add ../support-desk-admin -b add-admin-area
cd ../support-desk-admin && cp ../support-desk/.env .env
composer install && npm ci
sudo -u postgres psql -c "CREATE DATABASE support_desk_test_admin OWNER support_desk;"
DB_DATABASE=support_desk_test_admin php artisan test
cd ../support-desk && git switch -c add-ticket-work
openspec validate add-ticket-work --strict
openspec validate add-admin-area --strict
npm run build
php artisan test
vendor/bin/pint
vendor/bin/phpstan analyse
git switch main && git merge add-ticket-work
cd ../support-desk-admin && git merge main
cd ../support-desk && git merge add-admin-area
git worktree remove ../support-desk-admin
composer ci:check

Plans: add-ticket-work (new capability ticket-management; search added to agent-inbox; ticket-replies gets the closed rule and the six cases). add-admin-area (new capability admin-area; customer-tickets accepts active categories only). Follow-ups: list-admins-first (found by the phone check) and add-accounts-spec (R1 as the starter kit built it). 11 capabilities.

Code, summarised (PHP arrows can't go in a description):
TicketPolicy: reply refuses closed tickets; update and addNote for agents (owner 403, others 404).
Ticket::respond: refuses closed; in one transaction adds the reply and reopens a pending or resolved ticket on a customer reply (logged).
One PATCH route for status, priority and assignee, in one transaction. Notes loaded for agents only; activity for everyone who sees the ticket.
Search: the Episode 32 scope, subjects and replies, combined with the filters.
Admin: 6 routes, CategoryPolicy, UserPolicy; archived categories filtered on the form and refused by the request; last-admin check with lockForUpdate.
Tests: 25 + 14 = 39; 133 in the suite.

Next in the playlist: Episode 35, Field Notes and Wrap-Up (Course Finale).
```

---

## Slide list

| # | Slide | Notes |
|---|---|---|
| 1 | title slide | title |
| 2 | Three parts | agenda |
| 3 | 01 · Decide and plan | divider |
| 4 | Where we left off | panel |
| 5 | Six to go | squares |
| 6 | Explore the gaps | monitor (Illustration) |
| 7 | Four questions | 4num |
| 8 | Search the notes? | two |
| 9 | The last admin | card (Illustration) |
| 10 | Wrong category? | phone (Illustration) |
| 11 | Two worktrees | plan (Illustration) |
| 12 | R10 in six cases | two-points (Illustration) |
| 13 | Two worktrees, two plans | monitor (Illustration) |
| 14 | Two plans, reviewed | flow |
| 15 | 02 · Build in two worktrees | divider |
| 16 | TicketPolicy, extended | phone (Illustration) |
| 17 | One change route | plan (Illustration) |
| 18 | Reply rules in the model | monitor (Illustration) |
| 19 | Search, not notes | card (Illustration) |
| 20 | Notes and activity | two |
| 21 | The ticket page | phone (Illustration) |
| 22 | Archive, don't delete | two-points (Illustration) |
| 23 | Last admin, locked | plan (Illustration) |
| 24 | One merge conflict | card (Illustration) |
| 25 | Merge in order | flow |
| 26 | 03 · Test and finish | divider |
| 27 | What the tests prove | squares |
| 28 | Break it twice | panel |
| 29 | Phone check | two-points (Illustration) |
| 30 | 39 new tests | 4num |
| 31 | Three conditions for done | squares |
| 32 | Audit for done | flow |
| 33 | Twelve of twelve | two |
| 34 | quote slide | quote |
| 35 | recap slide | recap |
| 36 | Next in the playlist | closer |

---

## Sources
- Laravel: https://laravel.com/docs/13.x/authorization, /queries (pessimistic locking, full text where clauses), /validation, /database (transactions), /eloquent (local scopes)
- Claude Code: https://code.claude.com/docs/en/worktrees, /sub-agents
- git: https://git-scm.com/docs/git-worktree
- Inertia: https://inertiajs.com/docs/v3/the-basics/forms, /the-basics/manual-visits
- OpenSpec 1.14.1: generated instructions (openspec instructions), README, openspec validate messages
- Course: Episode 28 (requirements, decisions left open, the six R10 cases, done means), Episodes 32 and 33 (search scope, change log, policy and pages), Episode 27 (worktrees), Episode 13 (code-reviewer subagent), Episode 18 (laravel-security), Episode 22 (Playwright MCP)
