# Day 34 · Episode 33: Capstone, Core Features Part 1

**Series:** Agentic Engineering (free YouTube course) · Module 13
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 40:00 in the plan; estimated 19:08 from the word count (times below are estimates; replace with real slide times after the voiceover)
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 13 lesson):** Core Features 1 (R2, R3, R4, R5, R7)

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Claude, OpenSpec, Laravel, git, test, browser or Playwright output is shown, and no screenshot of the app appears. The OpenSpec change (proposal, three delta specs, design, tasks), the prompts, the policy, controllers, form requests, routes, React pages and the tests are **written for the course**; the plan files are the reviewed versions, not something Claude produced on camera. All of it was built and run once in the throwaway copy of the project on PostgreSQL 17 on 12 October 2026 (npm run build, the full test suite, one deliberate break, Pint, PHPStan, the kit's format and lint check, a Playwright check at 390 by 844 against a local server that was stopped afterwards, openspec validate --strict and archive); none of that output appears in the video.

**Split of the two core-feature episodes (from Episode 28):** Ep33 (this one) = R2, R3, R4, R5, R7. Ep34 = R6, R8, R9, R10 (including the six reply cases), R11, R12. R1 came with the starter kit in Ep29. 1 + 5 + 6 = 12.

**Counts drawn on slides (checked against the files and the throwaway project):** requirements today: 5 (R2, R3, R4, R5, R7) in 3 groups (customers R2 R3, agents R4 R5, both R7), plus Q1, Q4, Q5. Explore questions: 4. Policy abilities: 4 (viewAny, view, create, reply). New routes: 6 (tickets.index, tickets.create, tickets.store, tickets.show, tickets.replies.store, inbox), 5 of them with the can middleware. Controllers: 3 (TicketController with 4 methods, InboxController invokable, ReplyController with 1). Form requests: 2. Pages: 4 (tickets/index, tickets/create, tickets/show, inbox). New components: 3 (ticket-list, ticket-badges, pagination-links). Shared abilities: 2 (openTicket, viewInbox). Inbox filters: 4 (status, priority, category, assignee), 25 per page, 3 eager-loaded relationships. Capabilities: 3 new (customer-tickets 2 requirements, 8 scenarios; agent-inbox 2 requirements, 8 scenarios; ticket-replies 1 requirement, 5 scenarios): 5 requirements, 21 scenarios; archive reported + 5; openspec/specs now holds 8 capabilities. Task groups: 5. Tests: OpenTicketTest 5 + CustomerTicketsTest 4 + InboxTest 7 + RepliesTest 5 = 21 new; suite 73 + 21 = 94, all passing on PostgreSQL. Deliberate break: owner check removed, 2 tests failed. Browser check: 390 by 844. Quality checks before the PR: 3 (Pint, PHPStan, vp check).

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:23 | [VOICEOVER + SLIDE] | Hook |
| 0:23–1:11 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:11–7:48 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 1 · Plan the screens |
| 7:48–14:26 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Build the pages |
| 14:26–18:32 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Test and check |
| 18:32–19:08 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:23 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> A customer's card was charged twice. They sign in to the Support Desk, and there's nowhere to say so. Every table exists, but there isn't a single page for tickets yet.
> Today that changes. Customers open tickets and reply, and agents get an inbox with filters. And every one of those actions goes through a policy first.

**Visual / B-roll:**
- Title card.

### 0:23–1:11 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode thirty-three: capstone, core features part one. The first screens people actually use.

*Cue: agenda slide "Three parts"*
> Three parts. First, plan the screens: four questions in explore, then an OpenSpec change. Second, build the pages: a policy, the routes and controllers, and four Inertia React pages. Third, test and check: twenty-one feature tests, a browser check at phone width, and a review.
> As always, this is an illustrated walkthrough, not a recording. I built and ran all of it once in a throwaway copy of the project, and every test passed there. No output is shown. The prompts and commands are in the description, and the plan and the code are summarised there.

**Visual / B-roll:**
- Three items: 01 Plan the screens · 02 Build the pages · 03 Test and check.

### 1:11–7:48 · Part 1: Plan the screens
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "01 · Plan the screens"*
> Part one. Plan the screens.

*Cue: panel "Where we left off"*
> Where we left off. Episode thirty-two finished the data layer: a change log, eight new indexes chosen with EXPLAIN, and lazy loading that fails loudly outside production. Five capabilities are archived in openspec slash specs, and seventy-three tests pass.
> In episode twenty-eight, we split the features over two episodes. This one takes five requirements: R two, three, four, five and seven. After today, the app is usable end to end.

*Cue: squares "Who gets what"*
> The five fall into three groups.
> Customers: R two, open a ticket with a subject, a description and a category. And R three, see only their own tickets, and never internal notes.
> Agents: R four, an inbox of all tickets, newest first, twenty-five per page. And R five, filters by status, priority, category and assignee.
> And both sides: R seven, public replies on a ticket.
> Three quality rules apply to every page. Q one: a policy checks every ticket action. Q four: every page works at phone width. Q five: the inbox loads without N plus one queries.

*Cue: monitor "Explore first"*
> As in the data modeling episodes, I start with slash O P S X explore. Explore is for thinking: Claude reads the code and talks it through, but writes no code.
> The prompt names the five requirements and the three quality rules. It asks Claude to read the routes file, the Ticket model, the specs, and one settings page from the starter kit, so it sees how the kit builds a page. Then one question at a time, about four areas. The prompt is written for the course and printed in the description.

*Cue: 4num "Four questions"*
> Four questions.
> One: where do the permission checks live? Two: what happens when a customer opens someone else's ticket? Three: what does the inbox do with a filter value it doesn't know? Four: which pages, and how does each person find theirs?

*Cue: two columns "Where do checks live?"*
> Question one. Option one: check in each controller method, with a Gate call at the top. It works, but the checks are spread over many methods, and one missed call is a data leak.
> Option two: one Ticket Policy, and the check on the route itself, with Laravel's can middleware. The Laravel docs show both forms. For an action on a ticket, you name the route parameter. For create, where there's no ticket yet, you pass the class name. Every rule then sits in one policy, and every route shows its check in one file.
> I chose the routes. That's Q one, and it's what our laravel security skill from episode eighteen asks for.

*Cue: card "403 or 404?"*
> Question two. Option one: answer four oh three, forbidden. That's honest, but it tells the visitor the ticket exists, so anyone can try numbers and learn which ones are real.
> Option two: answer four oh four, as if the ticket didn't exist. The Laravel docs call hiding a resource behind a four oh four a common pattern, and policies have a method just for it: deny as not found.
> I chose four oh four. A customer who types another ticket number sees the same page as for a ticket that never existed. Agents can see every ticket, and admins count as agents.

*Cue: phone "What a customer sees"*
> A few smaller answers came out of the same conversation.
> The ticket page loads the category, the customer, the assignee, and the public replies with their authors. Internal notes are never loaded there at all. If they're never loaded, they can't reach a customer's browser by mistake.
> Each page gets only the fields it shows, picked in the controller, not whole models.
> And agents don't open tickets. Customers do. So the new ticket form is for customers only, and the inbox is for agents only.

*Cue: plan "Safe filters"*
> Question three. Filters come from the address bar, so anyone can type anything there. Status and priority must match one of their four values. Category and assignee must be numbers, and the assignee can also be none, for unassigned tickets.
> Anything else is ignored, not an error. An error on a page you reach by a link can trap you on that link. And the filters stay in the page links, so page two of the open tickets is still open tickets.

*Cue: two-points "Four pages, one sidebar"*
> Question four. Four pages: my tickets, the new ticket form, the ticket itself with its replies, and the inbox. Customers and agents share the ticket page.
> The sidebar shows each person their own links. But React shouldn't decide who's an agent. The server shares two answers from the policy: can this user open a ticket, and can they view the inbox. The sidebar just reads them.
> And worktrees, from module twelve? Not today. These features share one policy, one routes file and the sidebar, so parallel sessions would keep editing the same files. Episode thirty-four's features are more separate, and that's where worktrees fit.

*Cue: monitor "Propose the change"*
> Back on main, pull the merged episode thirty-two work, and make a branch: add core ticket features.
> Then slash O P S X propose add core ticket features: a ticket policy, controllers, form requests, routes with the can middleware, four Inertia React pages, sidebar links by role, and a Pest test for every scenario. No search, notes, assignment, status changes or R ten rules. Those are episode thirty-four.

*Cue: flow "Review in order"*
> Review in the usual order. The proposal names the five requirements, plus Q one, four and five, and keeps episode thirty-four's work out of scope. It also says plainly that archived categories still show in the new ticket form until R twelve.
> The spec has three new capabilities. Customer tickets: open a ticket, and own tickets only. Agent inbox: the inbox, and its filters. Ticket replies: reply on a ticket. Five requirements, twenty-one scenarios. Many of them are about what must not happen: an agent opening a ticket, a customer reading someone else's, a request that tries to choose its own author.
> The design records the four answers. The tasks have five groups. Then openspec validate, strict, and I commit the plan.

### 7:48–14:26 · Part 2: Build the pages
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Build the pages"*
> Part two. Build the pages.

*Cue: phone "TicketPolicy"*
> Slash clear, then slash O P S X apply. The hooks run as it works: Pint on each PHP file, and the tests on Stop.
> Group one starts with the policy. Laravel discovers it by name: a Ticket model, and a Ticket Policy in the Policies folder. Four abilities. View any, which is the inbox: agents only. View: an agent, or the customer who owns the ticket, and for anyone else, deny as not found. Create: anyone who isn't an agent. And reply: for now, exactly the same as view. Closed tickets taking no replies is R ten, in episode thirty-four.

*Cue: plan "Checks on routes"*
> Then the routes, all inside the starter kit's group for signed-in, verified users, so a guest is sent to the login page first.
> The ticket page uses can, view, ticket. The second word is the name of the route parameter, so the policy gets the ticket that route model binding found. The reply route uses can, reply, ticket. The new ticket form and its submit use can, create, with the Ticket class. And the inbox uses can, view any, with the class.
> The two form requests only validate: subject, description and category, or the reply body. Their authorize method returns true, because the route has already asked the policy.

*Cue: monitor "Customer side"*
> Group two, the customer side. The ticket controller has four methods.
> Index lists the user's own tickets, through the tickets relationship, newest first, twenty-five per page. Create sends the categories to the form. Store creates the ticket through that same relationship, so the customer always comes from the session, never from the form. Status and priority come from the defaults we set in episode thirty: open, and normal.
> Then store flashes a toast, ticket opened, and redirects to the ticket. The Inertia docs describe flash data as one-time data that won't reappear when you navigate through browser history. And show loads the ticket with its replies, never its notes.

*Cue: card "The inbox query"*
> Group three, the inbox: one invokable controller. First it reads the four filters through the allow list from question three. Then one query. With category, customer and assignee, so they're eager loaded. When a filter has a value, add its where clause, and for none, where the assignee is null. Order by id, descending, twenty-five per page.
> With query string adds the current filters to every page link; that's from the Laravel pagination docs. And through maps each ticket to just the fields the page shows.
> Last episode's indexes serve exactly these queries, and eager loading runs one query per relationship, however many rows. That's Q five.

*Cue: two columns "Form and filters"*
> On the React side, there are two ways a page sends data.
> The new ticket form uses Inertia's Form component. The Inertia docs say it behaves much like a classic HTML form, but avoids full page reloads. It gets its URL and method from Wayfinder, which the starter kit generates from our routes. Validation errors come back per field, and appear under each input.
> The inbox filters aren't a form. Each select calls router get with the new filters, and three options from the Inertia docs. Preserve state keeps the page's local state, instead of starting a fresh page component. Preserve scroll keeps the scroll position. And replace swaps the current history entry, so the back button doesn't step through every filter click.
> Either way, the filters end up in the address, so a filtered inbox can be bookmarked or shared.

*Cue: phone "Replies"*
> Group four, replies. The reply controller has one method: add a reply with the signed-in user as the author, using the add reply method from episode thirty-one. If the request sends an author, it's ignored.
> On the ticket page, the reply form has reset on success, which the Inertia docs describe as resetting the form after a successful submission. And preserve scroll, so the page doesn't jump back to the top. Replies from agents get a small Support label. And if an author deleted their account, the reply says: deleted user.

*Cue: two-points "Sidebar by role"*
> Then the sidebar. The Laravel docs have a section on authorization and Inertia. Authorization must always be handled on the server, but it's convenient to share some of it with the front end, and the starter kit's Handle Inertia Requests middleware is the place for it.
> So it shares auth dot can, with two answers from the policy: open ticket, and view inbox. The sidebar reads them with use page, and shows my tickets to customers and the inbox to agents. If someone types the inbox address anyway, the route still checks.

*Cue: plan "Phone width first"*
> Q four shaped the markup. Each row of the ticket list stacks its parts in a column, and only sits side by side from the small breakpoint up. Long subjects are truncated instead of pushing the page wider. And on a phone, the filters sit two per row.
> Each list item also has a key: the ticket's id. The React docs explain that keys tell React which array item each component corresponds to, and that data from a database should use its I Ds, which are unique by nature.

*Cue: card "One trap: Vite"*
> Then I ran the tests in the throwaway project, and the new page tests failed. Not a bug in the code. The Laravel docs explain it: Laravel's Vite integration resolves your assets while the tests run, which needs the Vite dev server running, or the assets built. The new pages weren't built yet.
> So, npm run build once, as the only heavy job on the machine, and the tests went green. CI already does this: the composer setup script it runs ends with npm run build.

*Cue: flow "Apply in order"*
> Here's the apply, group by group: access, the customer side, the inbox, replies, and the checks. A tick in tasks dot md after each one.
> And one rule held throughout: Wayfinder's generated files are never edited by hand. Change a route or a controller, and they're generated again; the starter kit's Vite plugin does it on every build.

### 14:26–18:32 · Part 3: Test and check
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Test and check"*
> Part three. Test and check.

*Cue: squares "What the tests prove"*
> Group five starts with the tests, in a new folder: tests, feature, tickets. They prove three kinds of thing.
> Allowed: the right person gets the right page. A customer opens a ticket, and an agent replies on any ticket.
> Refused: the wrong person gets a four oh three, a four oh four, or the login page.
> Ignored: input that must not count. A customer, status or priority sent with a new ticket, an author sent with a reply, an unknown filter value.

*Cue: panel "Break it on purpose"*
> A test that has never failed proves nothing. So in the throwaway project, I removed the owner check from the policy's view method, and let every user through. Two tests failed: a customer opening someone else's ticket, and a customer replying on it. I put the check back, and everything was green again.
> Q five has its own test: the inbox with three tickets, then with twenty-five, counting the queries with Laravel's query log. The two counts must be equal. Lazy loading would add queries for every row; eager loading doesn't.

*Cue: two-points "Phone check"*
> Q four says: check in a browser. The prompt uses Playwright MCP from episode twenty-two, with a phone-sized window, three hundred and ninety by eight hundred and forty-four. Sign in as the customer, open a ticket, reply. Then as the agent, try the inbox filters and the next page, and report any page that scrolls sideways or logs a console error.
> In the throwaway project, I ran the same kind of check with a small Playwright script, against a local server and two test accounts: the customer's three pages, then the inbox with the status filter, the unassigned filter, the next page, and a ticket. No page scrolled sideways, and the only console error was the expected four oh three when the customer tried the inbox. Then I stopped the server.

*Cue: 4num "21 new tests"*
> Twenty-one new tests, in four files.
> Open ticket, five. Customer tickets, four, including customers being refused the inbox. Inbox, seven, including the query count. Replies, five.
> Twenty-one scenarios, twenty-one tests. With the seventy-three from before, that's ninety-four, and in my throwaway project all ninety-four passed on PostgreSQL.

*Cue: squares "Three more checks"*
> Before the pull request, three more checks.
> Pint, for PHP style. PHP Stan, the static analysis the starter kit sets up. And the kit's front end check: format, and lint with type-aware rules. All three passed.
> The kit's separate TypeScript check still trips on the same generated route file as in episode twenty-nine. That's an upstream issue in a generated file, and none of today's files has a type error.

*Cue: flow "Review, archive, merge"*
> Then the code reviewer subagent reviews the diff against the change, with the laravel security and react best practices skills as its checklist. It reports; it doesn't edit. My own pass in the throwaway project found one small thing: the inbox's list of agents now uses the Role enum, instead of typing the role names as strings.
> Then slash O P S X archive: five requirements merge in, and openspec slash specs now holds eight capabilities. Commit, push, g h pr create, dash dash fill, CI runs, then review and merge.

*Cue: two columns "Usable end to end"*
> Your turn, before the next episode. One: find a page in your own app that answers four oh three for someone else's record, and decide whether it should be a four oh four. Two: share one ability with your front end, and hide a link with it, while the route still checks.
> And where are we? A customer can open a ticket, see their own, and reply. An agent can work through the inbox, filter it, and reply. Ninety-four tests, eight capabilities. The app is usable end to end. Next, the other six requirements.

### 18:32–19:08 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The server decides. The page only follows.

*Cue: recap slide*
> Quick recap.
> One policy, checked on the routes, with a four oh four for other people's tickets.
> Four pages: my tickets, a new ticket, the ticket with its replies, and the inbox, with filters that stay in the links.
> Eager loading and a query count for Q five, and a browser check at phone width for Q four.
> Twenty-one new tests, one archived change, and a pull request.

*Cue: closer slide "Next in the playlist"*
> Next in the playlist: episode thirty-four, capstone, core features part two. See you there.

---

## Example files (written for the course)

All files were run in the throwaway project. The prompts and commands are free of `<` and `>` and go into the description as they are. The PHP and TypeScript files contain `<?php`, `->`, `=>` and JSX tags, so the description summarises them; the files are here. Three long React pages (`tickets/create.tsx`, `tickets/show.tsx`, `inbox.tsx`, 87 to 149 lines each) are **summarised below, not printed in full**; their complete versions are in the build folder (`ep33-build/files/`). Everything else is printed in full. The Playwright script lives outside the repository and only ran against a local server.

### Prompts (typed into Claude Code)

```text
/opsx:explore R2, R3, R4, R5 and R7 in docs/requirements.md, plus Q1, Q4 and Q5. Read routes/web.php, the Ticket model, openspec/specs and one settings page of the starter kit first. Ask me one question at a time about who may do what, what a customer may see, the inbox filters, and how the pages are laid out.

/opsx:propose add-core-ticket-features: the screens as decided. A TicketPolicy, controllers, form requests, routes with the can middleware, four Inertia React pages, sidebar links by role, Pest tests for every scenario. No search, notes, assignment, status changes or R10 rules; those are Episode 34.

/clear, then /opsx:apply add-core-ticket-features

Use Playwright MCP at 390 by 844. Sign in as the customer, open a ticket, reply to it. Then sign in as the agent and try each inbox filter and the next page. Tell me any page that scrolls sideways or shows a console error.

Use the code-reviewer subagent to review this change against the laravel-security and react-best-practices skills.

/opsx:archive add-core-ticket-features
```

### Commands (typed in the terminal)

```text
git switch main && git pull
git switch -c add-core-ticket-features
openspec validate add-core-ticket-features --strict
git add openspec && git commit -m "Plan: add-core-ticket-features"
npm run build
php artisan test
vendor/bin/pint
vendor/bin/phpstan analyse
npx vp check
composer run dev
git add -A && git commit -m "Add core ticket features"
git push -u origin add-core-ticket-features
gh pr create --fill
```

### `openspec/changes/add-core-ticket-features/proposal.md`

```markdown
## Why
The data model is done, but nobody can use it yet. This change adds the first screens, so a customer can open a ticket and talk to support, and agents can work through the inbox. Covers R2, R3, R4, R5 and R7, plus Q1, Q4 and Q5 for these pages.

## What Changes
- A TicketPolicy for every ticket action.
- Pages: my tickets, new ticket, ticket, inbox.
- Inbox filters by status, priority, category and assignee, kept in the page links.
- A reply form on the ticket page.
- Sidebar links that follow the user's role.

## Capabilities
### New Capabilities
- `customer-tickets`: opening and seeing your own tickets.
- `agent-inbox`: the inbox and its filters.
- `ticket-replies`: the reply form.

## Out of scope
Search, internal notes, assignment, status changes, the R10 reply rules, the change log on screen and the admin area (Episode 34). Archived categories still show in the new ticket form until R12.

## Impact
One policy, three controllers, two form requests, routes, shared props, four pages, three components, tests.
```

### `openspec/changes/add-core-ticket-features/specs/customer-tickets/spec.md`

```markdown
## ADDED Requirements

### Requirement: Open a ticket
A customer SHALL open a ticket with a subject, a description and a category. The app SHALL set the customer, the status and the priority, never the request.

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

### Requirement: Own tickets only
A customer SHALL see only their own tickets, newest first, and never internal notes.

#### Scenario: My tickets
- **WHEN** a customer opens my tickets
- **THEN** only their tickets are listed, newest first

#### Scenario: Another customer's ticket
- **WHEN** a customer opens a ticket that is not theirs
- **THEN** the answer is 404

#### Scenario: Ticket with a note
- **WHEN** a customer opens their ticket that has an internal note
- **THEN** the page does not include the note
```

### `openspec/changes/add-core-ticket-features/specs/agent-inbox/spec.md`

```markdown
## ADDED Requirements

### Requirement: Inbox
Agents SHALL see an inbox of all tickets, newest first, 25 per page. Customers SHALL NOT see the inbox.

#### Scenario: Agent opens the inbox
- **WHEN** an agent opens the inbox with 26 tickets
- **THEN** the first page lists the newest 25, and there are 2 pages

#### Scenario: Customer opens the inbox
- **WHEN** a customer opens the inbox
- **THEN** the answer is 403

#### Scenario: No N + 1
- **WHEN** the inbox lists 3 tickets, and then 25
- **THEN** both pages run the same number of queries

### Requirement: Filters
Agents SHALL filter the inbox by status, priority, category and assignee. Filters SHALL combine, and SHALL stay in the page links.

#### Scenario: Status and priority
- **WHEN** an agent filters by pending and urgent
- **THEN** only pending, urgent tickets are listed

#### Scenario: Category
- **WHEN** an agent filters by a category
- **THEN** only that category's tickets are listed

#### Scenario: Assignee
- **WHEN** an agent filters by an agent, or by unassigned
- **THEN** only tickets assigned to that agent, or to nobody, are listed

#### Scenario: Unknown value
- **WHEN** a filter has a value that does not exist
- **THEN** that filter is ignored

#### Scenario: Next page
- **WHEN** a filtered inbox has a next page
- **THEN** the next page link keeps the filters
```

### `openspec/changes/add-core-ticket-features/specs/ticket-replies/spec.md`

```markdown
## ADDED Requirements

### Requirement: Reply on a ticket
Whoever can see a ticket SHALL add a public reply to it: the customer who owns it, and any agent. The app SHALL set the author.

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
```

### `openspec/changes/add-core-ticket-features/design.md`

```markdown
## Decisions
- Authorization sits on the routes with the can middleware, backed by TicketPolicy. Form requests only validate. Alternative: Gate calls in each controller.
- Another customer's ticket answers 404, not 403, with denyAsNotFound, so ticket ids reveal nothing.
- Agents (admins count as agents) do not open tickets; customers do not see the inbox.
- The ticket page loads replies only, never internal notes, so a customer cannot receive a note by mistake.
- Inbox filters come from the query string. Unknown values are ignored, not errors. Filters stay in the page links with withQueryString.
- Inbox order is id descending, 25 per page, with category, customer and assignee eager loaded (Q5). A test counts the queries.
- Pages get only the fields they show, mapped in the controller.
- The sidebar reads auth.can, shared from the policy, instead of checking roles in React.

## Risks / Trade-offs
- Filter values that are ignored give no feedback → the filter controls only offer valid values.
- The new ticket form lists archived categories → fixed with R12 in Episode 34.
```

### `openspec/changes/add-core-ticket-features/tasks.md` (after apply)

```markdown
## 1. Access
- [x] 1.1 TicketPolicy: viewAny, view, create, reply
- [x] 1.2 Routes with the can middleware; auth.can shared with the pages

## 2. Customer side (R2, R3)
- [x] 2.1 Form request and controller for opening a ticket
- [x] 2.2 My tickets, new ticket and ticket pages

## 3. Agent side (R4, R5)
- [x] 3.1 Inbox controller with filters and eager loading
- [x] 3.2 Inbox page with filter controls and paging

## 4. Replies (R7)
- [x] 4.1 Form request and controller for replies; reply form on the ticket page

## 5. Checks
- [x] 5.1 A Pest test for every scenario, in tests/Feature/Tickets
- [x] 5.2 Pint, PHPStan, lint and types, all tests green
- [x] 5.3 Playwright check at phone width
```

### `app/Policies/TicketPolicy.php`

```php
<?php

namespace App\Policies;

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
     * Whoever can see a ticket can reply to it (R7).
     * Closed tickets come with R10 in Episode 34.
     */
    public function reply(User $user, Ticket $ticket): Response
    {
        return $this->view($user, $ticket);
    }
}
```

### `routes/web.php` (edits)

```diff
diff --git a/routes/web.php b/routes/web.php
index 2085b21..da7ee87 100644
--- a/routes/web.php
+++ b/routes/web.php
@@ -1,11 +1,28 @@
 <?php
 
+use App\Http\Controllers\InboxController;
+use App\Http\Controllers\ReplyController;
+use App\Http\Controllers\TicketController;
+use App\Models\Ticket;
 use Illuminate\Support\Facades\Route;
 
 Route::inertia('/', 'welcome')->name('home');
 
 Route::middleware(['auth', 'verified'])->group(function () {
     Route::inertia('dashboard', 'dashboard')->name('dashboard');
+
+    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
+    Route::get('tickets/create', [TicketController::class, 'create'])
+        ->can('create', Ticket::class)->name('tickets.create');
+    Route::post('tickets', [TicketController::class, 'store'])
+        ->can('create', Ticket::class)->name('tickets.store');
+    Route::get('tickets/{ticket}', [TicketController::class, 'show'])
+        ->can('view', 'ticket')->name('tickets.show');
+    Route::post('tickets/{ticket}/replies', [ReplyController::class, 'store'])
+        ->can('reply', 'ticket')->name('tickets.replies.store');
+
+    Route::get('inbox', InboxController::class)
+        ->can('viewAny', Ticket::class)->name('inbox');
 });
 
 require __DIR__.'/settings.php';
```

### `app/Http/Requests/StoreTicketRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
```

### `app/Http/Requests/StoreReplyRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
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

### `app/Http/Controllers/TicketController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Ticket;
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
     * The form to open a ticket (R2).
     */
    public function create(): Response
    {
        return Inertia::render('tickets/create', [
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
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
     * One ticket with its public replies. Internal notes are never loaded here (R3).
     */
    public function show(Ticket $ticket): Response
    {
        $ticket->load(['category', 'customer', 'assignee', 'replies.author']);

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
                'created_at' => $ticket->created_at,
            ],
            'replies' => $ticket->replies->map(fn (Reply $reply) => [
                'id' => $reply->id,
                'body' => $reply->body,
                'author' => $reply->author?->name,
                'from_agent' => (bool) $reply->author?->isAgent(),
                'created_at' => $reply->created_at,
            ]),
        ]);
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
     * Every ticket, newest first, 25 per page (R4), with filters (R5).
     * Unknown filter values are ignored, never passed to the query.
     */
    public function __invoke(Request $request): Response
    {
        $filters = [
            'status' => TicketStatus::tryFrom($request->string('status')->value())?->value,
            'priority' => TicketPriority::tryFrom($request->string('priority')->value())?->value,
            'category' => $request->integer('category') ?: null,
            'assignee' => $request->input('assignee') === 'none'
                ? 'none'
                : ($request->integer('assignee') ?: null),
        ];

        $tickets = Ticket::query()
            ->with(['category', 'customer', 'assignee'])
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
     * Add a public reply (R7). The author is always the signed-in user.
     */
    public function store(StoreReplyRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticket->addReply($request->user(), $request->validated('body'));

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Reply sent.')]);

        return to_route('tickets.show', $ticket);
    }
}
```

### `app/Http/Middleware/HandleInertiaRequests.php` and `app/Models/Ticket.php` (edits)

```diff
diff --git a/app/Http/Middleware/HandleInertiaRequests.php b/app/Http/Middleware/HandleInertiaRequests.php
index f4cc770..8a53d36 100644
--- a/app/Http/Middleware/HandleInertiaRequests.php
+++ b/app/Http/Middleware/HandleInertiaRequests.php
@@ -2,6 +2,7 @@
 
 namespace App\Http\Middleware;
 
+use App\Models\Ticket;
 use Illuminate\Http\Request;
 use Inertia\Middleware;
 
@@ -40,6 +41,10 @@ public function share(Request $request): array
             'name' => config('app.name'),
             'auth' => [
                 'user' => $request->user(),
+                'can' => [
+                    'openTicket' => (bool) $request->user()?->can('create', Ticket::class),
+                    'viewInbox' => (bool) $request->user()?->can('viewAny', Ticket::class),
+                ],
             ],
             'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
         ];
diff --git a/app/Models/Ticket.php b/app/Models/Ticket.php
index 2605e24..01e50b6 100644
--- a/app/Models/Ticket.php
+++ b/app/Models/Ticket.php
@@ -21,6 +21,7 @@
  * @property string $description
  * @property TicketStatus $status
  * @property TicketPriority $priority
+ * @property int $customer_id
  * @property int|null $assignee_id
  */
 #[Fillable(['subject', 'description', 'category_id'])]
```

### `resources/js/types/tickets.ts`

```ts
export type TicketStatus = 'open' | 'pending' | 'resolved' | 'closed';
export type TicketPriority = 'low' | 'normal' | 'high' | 'urgent';

export type TicketListItem = {
    id: number;
    subject: string;
    status: TicketStatus;
    priority: TicketPriority;
    category: string;
    created_at: string;
    customer?: string;
    assignee?: string | null;
};

export type Paginated<T> = {
    data: T[];
    current_page: number;
    last_page: number;
    total: number;
    prev_page_url: string | null;
    next_page_url: string | null;
};

export type Option = {
    id: number;
    name: string;
};
```

### `resources/js/components/app-sidebar.tsx`, `resources/js/types/auth.ts`, `resources/js/types/index.ts` (edits)

```diff
diff --git a/resources/js/components/app-sidebar.tsx b/resources/js/components/app-sidebar.tsx
index a38aa1d..2d4d06f 100644
--- a/resources/js/components/app-sidebar.tsx
+++ b/resources/js/components/app-sidebar.tsx
@@ -1,5 +1,5 @@
-import { Link } from '@inertiajs/react';
-import { BookOpen, FolderGit2, LayoutGrid } from 'lucide-react';
+import { Link, usePage } from '@inertiajs/react';
+import { BookOpen, FolderGit2, Inbox, LayoutGrid, Ticket } from 'lucide-react';
 import AppLogo from '@/components/app-logo';
 import { NavFooter } from '@/components/nav-footer';
 import { NavMain } from '@/components/nav-main';
@@ -13,16 +13,15 @@ import {
     SidebarMenuButton,
     SidebarMenuItem,
 } from '@/components/ui/sidebar';
-import { dashboard } from '@/routes';
+import { dashboard, inbox } from '@/routes';
+import { index as tickets } from '@/routes/tickets';
 import type { NavItem } from '@/types';
 
-const mainNavItems: NavItem[] = [
-    {
-        title: 'Dashboard',
-        href: dashboard(),
-        icon: LayoutGrid,
-    },
-];
+const dashboardItem: NavItem = {
+    title: 'Dashboard',
+    href: dashboard(),
+    icon: LayoutGrid,
+};
 
 const footerNavItems: NavItem[] = [
     {
@@ -38,6 +37,17 @@ const footerNavItems: NavItem[] = [
 ];
 
 export function AppSidebar() {
+    const { auth } = usePage().props;
+    const mainNavItems: NavItem[] = [
+        dashboardItem,
+        ...(auth.can.openTicket
+            ? [{ title: 'My tickets', href: tickets(), icon: Ticket }]
+            : []),
+        ...(auth.can.viewInbox
+            ? [{ title: 'Inbox', href: inbox(), icon: Inbox }]
+            : []),
+    ];
+
     return (
         <Sidebar collapsible="icon" variant="inset">
             <SidebarHeader>
diff --git a/resources/js/types/auth.ts b/resources/js/types/auth.ts
index 0a17aec..1913494 100644
--- a/resources/js/types/auth.ts
+++ b/resources/js/types/auth.ts
@@ -12,6 +12,10 @@ export type User = {
 
 export type Auth = {
     user: User;
+    can: {
+        openTicket: boolean;
+        viewInbox: boolean;
+    };
 };
 
 export type Passkey = {
diff --git a/resources/js/types/index.ts b/resources/js/types/index.ts
index b1f0ee6..ff7d2dc 100644
--- a/resources/js/types/index.ts
+++ b/resources/js/types/index.ts
@@ -1,3 +1,4 @@
 export type * from './auth';
 export type * from './navigation';
+export type * from './tickets';
 export type * from './ui';
```

### `resources/js/components/ticket-badges.tsx`

```tsx
import { Badge } from '@/components/ui/badge';
import type { TicketPriority, TicketStatus } from '@/types';

export function StatusBadge({ status }: { status: TicketStatus }) {
    return (
        <Badge variant={status === 'open' ? 'default' : 'secondary'}>
            {status}
        </Badge>
    );
}

export function PriorityBadge({ priority }: { priority: TicketPriority }) {
    return (
        <Badge variant={priority === 'urgent' ? 'destructive' : 'outline'}>
            {priority}
        </Badge>
    );
}
```

### `resources/js/components/pagination-links.tsx`

```tsx
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import type { Paginated } from '@/types';

export function PaginationLinks({ page }: { page: Paginated<unknown> }) {
    if (page.last_page <= 1) {
        return null;
    }

    return (
        <nav
            aria-label="Pagination"
            className="flex items-center justify-between gap-2 text-sm"
        >
            {page.prev_page_url ? (
                <Button variant="outline" size="sm" asChild>
                    <Link href={page.prev_page_url}>Previous</Link>
                </Button>
            ) : (
                <Button variant="outline" size="sm" disabled>
                    Previous
                </Button>
            )}
            <span className="text-muted-foreground">
                Page {page.current_page} of {page.last_page}
            </span>
            {page.next_page_url ? (
                <Button variant="outline" size="sm" asChild>
                    <Link href={page.next_page_url}>Next</Link>
                </Button>
            ) : (
                <Button variant="outline" size="sm" disabled>
                    Next
                </Button>
            )}
        </nav>
    );
}
```

### `resources/js/components/ticket-list.tsx`

```tsx
import { Link } from '@inertiajs/react';
import { PriorityBadge, StatusBadge } from '@/components/ticket-badges';
import { show } from '@/routes/tickets';
import type { TicketListItem } from '@/types';

function details(ticket: TicketListItem): string {
    const parts = [ticket.category];

    if (ticket.customer !== undefined) {
        parts.push(ticket.customer);
    }

    if (ticket.assignee !== undefined) {
        parts.push(ticket.assignee ?? 'Unassigned');
    }

    parts.push(new Date(ticket.created_at).toLocaleDateString());

    return parts.join(' · ');
}

export function TicketList({
    tickets,
    empty,
}: {
    tickets: TicketListItem[];
    empty: string;
}) {
    if (tickets.length === 0) {
        return (
            <p className="rounded-xl border p-6 text-sm text-muted-foreground">
                {empty}
            </p>
        );
    }

    return (
        <ul className="divide-y rounded-xl border">
            {tickets.map((ticket) => (
                <li key={ticket.id}>
                    <Link
                        href={show(ticket.id)}
                        className="flex flex-col gap-2 p-4 hover:bg-muted/50 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div className="min-w-0">
                            <p className="truncate font-medium">
                                #{ticket.id} {ticket.subject}
                            </p>
                            <p className="text-sm text-muted-foreground">
                                {details(ticket)}
                            </p>
                        </div>
                        <div className="flex shrink-0 gap-2">
                            <StatusBadge status={ticket.status} />
                            <PriorityBadge priority={ticket.priority} />
                        </div>
                    </Link>
                </li>
            ))}
        </ul>
    );
}
```

### `resources/js/pages/tickets/index.tsx`

```tsx
import { Head, Link, usePage } from '@inertiajs/react';
import Heading from '@/components/heading';
import { PaginationLinks } from '@/components/pagination-links';
import { TicketList } from '@/components/ticket-list';
import { Button } from '@/components/ui/button';
import { create, index } from '@/routes/tickets';
import type { Paginated, TicketListItem } from '@/types';

export default function TicketsIndex({
    tickets,
}: {
    tickets: Paginated<TicketListItem>;
}) {
    const { auth } = usePage().props;

    return (
        <>
            <Head title="My tickets" />
            <div className="flex flex-1 flex-col gap-4 p-4">
                <div className="flex flex-wrap items-start justify-between gap-4">
                    <Heading
                        title="My tickets"
                        description="Every ticket you have opened, newest first."
                    />
                    {auth.can.openTicket && (
                        <Button asChild>
                            <Link href={create()}>New ticket</Link>
                        </Button>
                    )}
                </div>
                <TicketList
                    tickets={tickets.data}
                    empty="You have not opened a ticket yet."
                />
                <PaginationLinks page={tickets} />
            </div>
        </>
    );
}

TicketsIndex.layout = {
    breadcrumbs: [{ title: 'My tickets', href: index() }],
};
```

### `resources/js/pages/tickets/create.tsx` (87 lines, summarised)

- Imports `Form` and `Head` from `@inertiajs/react`, the Wayfinder action `TicketController` from `@/actions/App/Http/Controllers/TicketController`, the kit's `Heading`, `InputError`, `Button`, `Input`, `Label` and `Select` components, and the `create` and `index` routes.
- Props: `categories` (id and name).
- Renders a `Head` titled "New ticket", a heading ("Tell us what went wrong. An agent will reply here.") and `<Form {...TicketController.store.form()}>`, whose render function receives `processing` and `errors`.
- Three fields, each with a `Label` and an `InputError`: `subject` (Input, required, maxLength 255); `category_id` (a Select named `category_id` with one item per category, value = the id as a string, placeholder "Choose a category"); `description` (a textarea, required, 6 rows).
- A submit `Button` "Open ticket", disabled while `processing`.
- Layout breadcrumbs: My tickets, then New ticket.

### `resources/js/pages/tickets/show.tsx` (127 lines, summarised)

- Props: `ticket` (id, subject, description, status, priority, category, customer, assignee or null, created_at) and `replies` (id, body, author or null, from_agent, created_at). No notes prop exists.
- Reads `auth.can` with `usePage().props`: the back link goes to the inbox for agents ("Back to the inbox") and to my tickets for customers ("Back to my tickets").
- Header: `#id subject`, then StatusBadge, PriorityBadge, the category, "From" the customer, and "Assigned to" the assignee or "Unassigned", in a wrapping row.
- The description in a bordered box (`whitespace-pre-line`).
- "Replies": "No replies yet." when empty; otherwise one `article` per reply with `key={reply.id}`, agent replies on a muted background, a line with the author (or "Deleted user"), " · Support" for agents and the local date and time, then the body.
- The reply form: `<Form {...ReplyController.store.form(ticket.id)} options={{ preserveScroll: true }} resetOnSuccess>` with a labelled textarea `body` (required, 4 rows), its `InputError`, and a "Send reply" button disabled while processing.

### `resources/js/pages/inbox.tsx` (149 lines, summarised)

- Props: `tickets` (paginated list items with customer and assignee), `filters` (status, priority, category, assignee; null when unset), `categories` and `agents` (id and name).
- A small `FilterSelect` component: a shadcn `Select` with an `aria-label`, an "Any …" item with the value `all`, then the options; full width on phones, 10rem from the `sm` breakpoint.
- `apply(key, value)`: copies the filters, sets that key (or null for `all`), drops the nulls, and calls `router.get(inbox().url, query, { preserveState: true, preserveScroll: true, replace: true })`.
- Renders a heading "Inbox" with "N tickets, newest first.", a grid of four FilterSelects (two columns on phones, a wrapping row from `sm`): Status (open, pending, resolved, closed), Priority (low, normal, high, urgent), Category (the categories) and Assignee ("Unassigned" with the value `none`, then the agents). A "Clear filters" link to the inbox appears when any filter is set.
- Then `<TicketList tickets={tickets.data} empty="No tickets match these filters." />` and `<PaginationLinks page={tickets} />`.
- Layout breadcrumbs: Inbox.

### `tests/Feature/Tickets/OpenTicketTest.php`

```php
<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;

test('a customer opens a ticket', function () {
    $customer = User::factory()->create();
    $category = Category::factory()->create();

    $response = $this->actingAs($customer)->post(route('tickets.store'), [
        'subject' => 'Printer offline',
        'description' => 'It stopped after the update.',
        'category_id' => $category->id,
    ]);

    $ticket = Ticket::sole();
    $response->assertRedirect(route('tickets.show', $ticket));
    expect($ticket->customer_id)->toBe($customer->id)
        ->and($ticket->status)->toBe(TicketStatus::Open)
        ->and($ticket->priority)->toBe(TicketPriority::Normal);
});

test('subject, description and category are required', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('tickets.store'), [])
        ->assertSessionHasErrors(['subject', 'description', 'category_id']);

    expect(Ticket::count())->toBe(0);
});

test('the form cannot choose the customer, status or priority', function () {
    $customer = User::factory()->create();
    $other = User::factory()->create();

    $this->actingAs($customer)->post(route('tickets.store'), [
        'subject' => 'Refund',
        'description' => 'Charged twice.',
        'category_id' => Category::factory()->create()->id,
        'customer_id' => $other->id,
        'status' => 'closed',
        'priority' => 'urgent',
    ]);

    $ticket = Ticket::sole();
    expect($ticket->customer_id)->toBe($customer->id)
        ->and($ticket->status)->toBe(TicketStatus::Open)
        ->and($ticket->priority)->toBe(TicketPriority::Normal);
});

test('agents cannot open tickets', function () {
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)->get(route('tickets.create'))->assertForbidden();
    $this->actingAs($agent)->post(route('tickets.store'), [
        'subject' => 'Test',
        'description' => 'Test',
        'category_id' => Category::factory()->create()->id,
    ])->assertForbidden();
});

test('guests are sent to the login page', function () {
    $this->get(route('tickets.create'))->assertRedirect(route('login'));
});
```

### `tests/Feature/Tickets/CustomerTicketsTest.php`

```php
<?php

use App\Models\Ticket;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('a customer sees only their own tickets, newest first', function () {
    $customer = User::factory()->create();
    $older = Ticket::factory()->for($customer, 'customer')->create();
    $newer = Ticket::factory()->for($customer, 'customer')->create();
    Ticket::factory()->create();

    $this->actingAs($customer)->get(route('tickets.index'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('tickets/index')
            ->has('tickets.data', 2)
            ->where('tickets.data.0.id', $newer->id)
            ->where('tickets.data.1.id', $older->id));
});

test('a customer cannot open another customer\'s ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('tickets.show', $ticket))
        ->assertNotFound();
});

test('the ticket page never includes internal notes', function () {
    $ticket = Ticket::factory()->create();
    $ticket->addReply($ticket->customer, 'Any news?');
    $ticket->addNote(User::factory()->agent()->create(), 'Customer is on the refund watch list.');

    $this->actingAs($ticket->customer)->get(route('tickets.show', $ticket))
        ->assertOk()
        ->assertSee('Any news?')
        ->assertDontSee('refund watch list');
});

test('customers cannot open the inbox', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('inbox'))
        ->assertForbidden();
});
```

### `tests/Feature/Tickets/InboxTest.php`

```php
<?php

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Testing\AssertableInertia as Assert;

test('agents see every ticket, newest first, 25 per page', function () {
    $tickets = Ticket::factory()->count(26)->create();

    $this->actingAs(User::factory()->agent()->create())->get(route('inbox'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('inbox')
            ->has('tickets.data', 25)
            ->where('tickets.data.0.id', $tickets->last()->id)
            ->where('tickets.last_page', 2));
});

test('the inbox filters by status and priority', function () {
    $match = Ticket::factory()->create(['status' => 'pending', 'priority' => 'urgent']);
    Ticket::factory()->create(['status' => 'pending', 'priority' => 'low']);
    Ticket::factory()->create(['status' => 'open', 'priority' => 'urgent']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['status' => 'pending', 'priority' => 'urgent']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id));
});

test('the inbox filters by category', function () {
    $category = Category::factory()->create();
    $match = Ticket::factory()->for($category)->create();
    Ticket::factory()->create();

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['category' => $category->id]))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $match->id));
});

test('the inbox filters by assignee, or by no assignee', function () {
    $agent = User::factory()->agent()->create();
    $assigned = Ticket::factory()->assignedTo($agent)->create();
    $unassigned = Ticket::factory()->create();

    $this->actingAs($agent)->get(route('inbox', ['assignee' => $agent->id]))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $assigned->id));

    $this->actingAs($agent)->get(route('inbox', ['assignee' => 'none']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 1)
            ->where('tickets.data.0.id', $unassigned->id));
});

test('unknown filter values are ignored', function () {
    Ticket::factory()->count(2)->create();

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['status' => 'deleted', 'priority' => 'x', 'category' => 'abc']))
        ->assertInertia(fn (Assert $page) => $page
            ->has('tickets.data', 2)
            ->where('filters.status', null)
            ->where('filters.priority', null));
});

test('page links keep the filters', function () {
    Ticket::factory()->count(26)->create(['status' => 'open']);

    $this->actingAs(User::factory()->agent()->create())
        ->get(route('inbox', ['status' => 'open']))
        ->assertInertia(fn (Assert $page) => $page
            ->where('tickets.next_page_url', fn (string $url) => str_contains($url, 'status=open')));
});

test('the inbox runs the same number of queries for 3 tickets or 25', function () {
    $agent = User::factory()->agent()->create();
    $countQueries = function () use ($agent) {
        DB::flushQueryLog();
        DB::enableQueryLog();
        $this->actingAs($agent)->get(route('inbox'))->assertOk();

        return count(DB::getQueryLog());
    };

    Ticket::factory()->count(3)->assignedTo($agent)->create();
    $few = $countQueries();
    Ticket::factory()->count(22)->assignedTo($agent)->create();

    expect($countQueries())->toBe($few);
});
```

### `tests/Feature/Tickets/RepliesTest.php`

```php
<?php

use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;

test('a customer replies on their own ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Still broken.'])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->replies()->sole()->author_id)->toBe($ticket->customer_id);
});

test('an agent replies on any ticket', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($agent)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Try the new driver.'])
        ->assertRedirect(route('tickets.show', $ticket));

    expect($ticket->replies()->sole()->author_id)->toBe($agent->id);
});

test('a customer cannot reply on another customer\'s ticket', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs(User::factory()->create())
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Hello'])
        ->assertNotFound();

    expect(Reply::count())->toBe(0);
});

test('a reply needs a body', function () {
    $ticket = Ticket::factory()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => ''])
        ->assertSessionHasErrors('body');

    expect(Reply::count())->toBe(0);
});

test('the request cannot choose the author', function () {
    $ticket = Ticket::factory()->create();
    $agent = User::factory()->agent()->create();

    $this->actingAs($ticket->customer)
        ->post(route('tickets.replies.store', $ticket), ['body' => 'Hi', 'author_id' => $agent->id]);

    expect($ticket->replies()->sole()->author_id)->toBe($ticket->customer_id);
});
```

### `check.mjs` (Playwright phone-width check, local copy only, never committed)

```js
import { chromium } from 'playwright-core';
const base = 'http://127.0.0.1:8123';
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
  await page.screenshot({ path: `/workspace/capstone-throwaway/pw/${name}.png`, fullPage: true });
  results.push({ name, url: page.url(), overflow });
}
await session('demo-customer@example.test', async (page) => {
  await page.goto(base + '/tickets'); await check(page, 'c-my-tickets');
  await page.goto(base + '/tickets/create'); await check(page, 'c-new-ticket');
  await page.fill('#subject', 'Cannot download invoice');
  await page.click('#category_id'); await page.getByRole('option', { name: 'Billing' }).click();
  await page.fill('#description', 'The download button does nothing.');
  await page.getByRole('button', { name: 'Open ticket' }).click();
  await page.waitForURL(/\/tickets\/\d+$/); await check(page, 'c-ticket');
  await page.fill('#body', 'Tried again in another browser.');
  await page.getByRole('button', { name: 'Send reply' }).click();
  await page.getByText('Tried again in another browser.').waitFor();
  results.push({ replyShown: true, bodyCleared: (await page.inputValue('#body')) === '' });
  const inbox = await page.goto(base + '/inbox'); results.push({ customerInboxStatus: inbox.status() });
});
await session('demo-agent@example.test', async (page) => {
  await page.goto(base + '/inbox'); await check(page, 'a-inbox');
  await page.getByLabel('Status').click(); await page.getByRole('option', { name: 'pending' }).click();
  await page.waitForURL(/status=pending/); await check(page, 'a-inbox-pending');
  await page.goto(base + '/inbox?assignee=none'); await check(page, 'a-inbox-unassigned');
  await page.getByRole('link', { name: 'Next' }).click(); await page.waitForURL(/page=2/); results.push({ page2: page.url() });
  await page.goto(base + '/inbox'); await page.locator('ul a').first().click();
  await page.waitForURL(/\/tickets\/\d+$/); await check(page, 'a-ticket');
});
console.log(JSON.stringify(results, null, 1));
await browser.close();
```

---

## Production notes
- Spoken word count: about 2,850 words, roughly 19:08 at the Episode 31 pace (2,682 words ran 18:01), plus slide pauses (plan target about 40).
- Illustrated walkthrough, not a recording. No output is shown, and no screenshot of the app is used (the Playwright screenshots stay in ep33-build/screens for checking only). Built in /workspace/capstone-throwaway/support-desk (Laravel 13, PHP 8.5, PostgreSQL 17, Inertia 3, React 19, OpenSpec 1.14.1) on branch add-core-ticket-features from main (which already held Episode 32), then fast-forwarded into main to stand in for the merged pull request.
- First test run: 94 tests, 9 failed with "Unable to locate file in Vite manifest" for the new pages (tickets/show.tsx, inbox.tsx), because public/build predated them. npm run build (run alone) fixed it; then php artisan test: 94 passed (73 + 21). CI's composer setup script ends with npm run build, so CI builds before testing. The Laravel docs (vite, "Disabling Vite in Tests") say tests need the dev server or built assets; withoutVite was not used.
- Deliberate break: with the owner check in TicketPolicy::view replaced by true, 2 tests failed (another customer's ticket, replying on it); restored, all green.
- Pint, PHPStan (1G memory limit) and vp check (format, lint, type-aware) pass. npm run types:check (tsc) still fails only in the generated resources/js/actions/Illuminate/Routing/RedirectController.ts ('query' method), the same upstream Wayfinder issue noted in Episode 29 (laravel/wayfinder v0.1.21 and @laravel/vite-plugin-wayfinder 0.1.10 still the latest on 12 October 2026). No error in any Episode 33 file.
- Playwright check: playwright-core with the system Chrome, headless, viewport 390 by 844, against php artisan serve on port 8123 using the built assets, run three times (before and after a small layout fix on the ticket page header, and once more with the final check.mjs); the server was stopped each time. Results: document scrollWidth equal to the window width on all 7 checked pages (my tickets, new ticket, the new ticket, inbox, inbox status=pending, inbox assignee=none, an inbox ticket); the reply appeared and the textarea was cleared; the customer got 403 on the inbox (the only console error); the next page link kept assignee=none. Playwright MCP itself was not connected in the rebuilt throwaway project, so the narration says a script ran the same kind of check.
- Test accounts for the browser check were created in the local dev database only (demo-customer@example.test, demo-agent@example.test, a Billing category and one ticket with an agent reply), with php artisan tinker; they are not part of the code. The dev database also still holds the Episode 32 volume rows, so the inbox had about 100,000 tickets.
- Layout fix found by looking at the Playwright screenshots: the ticket header used leading " · " separators that wrapped onto a new line at phone width; it now says "From customer" and "Assigned to agent" or "Unassigned".
- Review: the code-reviewer subagent was not run (Claude was not run in this build). My own review produced one change (agents query uses Role::Agent and Role::Admin instead of strings; checked that whereIn with enum cases binds their values). Kept as decided: tickets.index has no can middleware because it only lists the signed-in user's own tickets through the relationship.
- openspec validate add-core-ticket-features --strict: valid. openspec archive -y reported + 5 (customer-tickets 2, agent-inbox 2, ticket-replies 1); openspec/specs holds agent-inbox, customer-tickets, ticket-conversation, ticket-history, ticket-queries, ticket-replies, tickets, user-roles (8). openspec validate --specs --strict still warns that each main spec's Purpose is the placeholder written by archive (all 8); not narrated, as in Episode 32.
- Hooks and course skills are not present in the rebuilt throwaway project (only the OpenSpec skills); Pint was run by hand instead of by the hook. Claude was not run: explore, propose and apply are described as the course's reviewed plan and code, not Claude output. git pull and push, gh pr create and CI were not run.
- Scope limits stated in the narration and the proposal: reply = view until R10 (Episode 34); archived categories still listed in the new ticket form until R12 (Episode 34); worktrees not used because the five features share the policy, routes file and sidebar (Episode 28 promised them for Episode 34).
- Laravel facts (laravel.com/docs/13.x): authorization (policy discovery by naming in a Policies directory; Response::denyAsNotFound and the 404 pattern; the can middleware with a route parameter name and with a class name for actions without models such as create; "Authorization & Inertia": always authorize on the server, share data in HandleInertiaRequests); pagination (withQueryString appends the current query string to page links; through transforms each item); eloquent-relationships (eager loading runs one query per relationship); vite (tests need the dev server or built assets; withoutVite); starter-kits (composer run dev).
- Inertia facts (inertiajs.com, v3 docs): forms (Form component behaves like a classic HTML form without full page reloads; a Wayfinder object supplies the URL and method; resetOnSuccess resets the form after a successful submission); manual visits (router.get; preserveState keeps the component's local state instead of a fresh instance; preserveScroll; replace replaces the current history entry); flash data (one-time data that won't reappear on history navigation, Inertia::flash); testing (assertInertia with AssertableInertia).
- React facts (react.dev/learn/rendering-lists): keys tell React which array item each component corresponds to; data from a database should use its IDs.
- Logic checks: 1 + 5 + 6 = 12 requirements over Episodes 29, 33, 34; 3 groups (2 + 2 + 1 = 5 requirements); 4 abilities; 6 routes, 5 with can (tickets.index has none); 5 requirements, 21 scenarios (8 + 8 + 5) = 21 tests (5 + 4 + 7 + 5; the "customers cannot open the inbox" test sits in CustomerTicketsTest but covers the agent-inbox scenario); 73 + 21 = 94; 5 + 3 = 8 capabilities; 5 task groups. The agenda's three parts match the three dividers.
- YouTube description: 3,835 characters, under the 4,500 target, no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Policies First, Pages Second: Tickets, Inbox and Replies in Laravel 13 + React | Agentic Engineering Ep 33
2. Building Real Features with Claude Code and OpenSpec: Inertia, Policies, Playwright | Ep 33
3. Capstone, Core Features Part 1 | Agentic Engineering Ep 33

### Description (ready to paste, 3,835 characters)

```
Episode 33 of Agentic Engineering, a free course on agentic coding.
Support Desk core features, part 1: open a ticket (R2), own tickets only (R3), the agent inbox (R4) with filters (R5), and public replies (R7). One policy behind the ticket routes, four Inertia React pages, 21 new tests, a phone-width browser check.
Screens are drawn illustrations; no output is shown. Files are written for the course.

Prompts:
/opsx:explore R2, R3, R4, R5 and R7 in docs/requirements.md, plus Q1, Q4 and Q5. Read routes/web.php, the Ticket model, openspec/specs and one settings page of the starter kit first. Ask me one question at a time about who may do what, what a customer may see, the inbox filters, and how the pages are laid out.

/opsx:propose add-core-ticket-features: the screens as decided. A TicketPolicy, controllers, form requests, routes with the can middleware, four Inertia React pages, sidebar links by role, Pest tests for every scenario. No search, notes, assignment, status changes or R10 rules; those are Episode 34.

/clear, then /opsx:apply add-core-ticket-features

Use Playwright MCP at 390 by 844. Sign in as the customer, open a ticket, reply to it. Then sign in as the agent and try each inbox filter and the next page. Tell me any page that scrolls sideways or shows a console error.

Use the code-reviewer subagent to review this change against the laravel-security and react-best-practices skills.

/opsx:archive add-core-ticket-features

Commands:
git switch main && git pull
git switch -c add-core-ticket-features
openspec validate add-core-ticket-features --strict
git add openspec && git commit -m "Plan: add-core-ticket-features"
npm run build
php artisan test
vendor/bin/pint
vendor/bin/phpstan analyse
npx vp check
composer run dev
git add -A && git commit -m "Add core ticket features"
git push -u origin add-core-ticket-features
gh pr create --fill

Spec: customer-tickets (open a ticket; own tickets only), agent-inbox (inbox; filters), ticket-replies (reply on a ticket). 5 requirements, 21 scenarios.

Plan: proposal covers R2, R3, R4, R5, R7 plus Q1, Q4, Q5; not search, notes, assignment, status changes, R10 or admin (Episode 34). Design: can middleware on routes backed by TicketPolicy; 404 for other customers' tickets (denyAsNotFound); replies loaded, notes never; unknown filter values ignored; filters kept in page links; eager loading plus a query-count test; sidebar from shared abilities. Tasks: access, customer side, inbox, replies, checks.

Code, summarised (PHP arrows can't go in a description):
TicketPolicy: viewAny = agents; view = agent or owner, else denyAsNotFound; create = not an agent; reply = view (closed tickets come with R10).
Routes (auth, verified): tickets.index; tickets.create and tickets.store with can create Ticket; tickets.show with can view ticket; tickets.replies.store with can reply ticket; inbox with can viewAny Ticket.
Form requests validate only: subject, description, category_id (exists); reply body.
TicketController: index (own tickets, newest first, 25 per page), create, store (through the user's tickets relationship, flash toast, redirect), show (replies with authors, never notes).
InboxController: status and priority through enum tryFrom, category and assignee as integers or none; with category, customer, assignee; order by id desc; paginate 25, withQueryString, through.
ReplyController: addReply with the signed-in user.
HandleInertiaRequests shares auth.can: openTicket, viewInbox.
React: pages tickets/index, tickets/create (Inertia Form with Wayfinder), tickets/show (reply form, resetOnSuccess), inbox (4 selects, router.get with preserveState, preserveScroll, replace); TicketList, badges, pagination; sidebar links by role.
Tests: 5 + 4 + 7 + 5 = 21; 94 in the suite.

Next in the playlist: Episode 34, Capstone, Core Features Part 2.
```

---

## Slide list

| # | Slide | Notes |
|---|---|---|
| 1 | title slide | title |
| 2 | Three parts | agenda |
| 3 | 01 · Plan the screens | divider |
| 4 | Where we left off | panel |
| 5 | Who gets what | squares |
| 6 | Explore first | monitor (Illustration) |
| 7 | Four questions | 4num |
| 8 | Where do checks live? | two |
| 9 | 403 or 404? | card (Illustration) |
| 10 | What a customer sees | phone (Illustration) |
| 11 | Safe filters | plan (Illustration) |
| 12 | Four pages, one sidebar | two-points (Illustration) |
| 13 | Propose the change | monitor (Illustration) |
| 14 | Review in order | flow |
| 15 | 02 · Build the pages | divider |
| 16 | TicketPolicy | phone (Illustration) |
| 17 | Checks on routes | plan (Illustration) |
| 18 | Customer side | monitor (Illustration) |
| 19 | The inbox query | card (Illustration) |
| 20 | Form and filters | two |
| 21 | Replies | phone (Illustration) |
| 22 | Sidebar by role | two-points (Illustration) |
| 23 | Phone width first | plan (Illustration) |
| 24 | One trap: Vite | card (Illustration) |
| 25 | Apply in order | flow |
| 26 | 03 · Test and check | divider |
| 27 | What the tests prove | squares |
| 28 | Break it on purpose | panel |
| 29 | Phone check | two-points (Illustration) |
| 30 | 21 new tests | 4num |
| 31 | Three more checks | squares |
| 32 | Review, archive, merge | flow |
| 33 | Usable end to end | two |
| 34 | quote slide | quote |
| 35 | recap slide | recap |
| 36 | Next in the playlist | closer |

---

## Sources
- Laravel: https://laravel.com/docs/13.x/authorization, /pagination, /eloquent-relationships, /vite, /starter-kits, /routing
- Inertia: https://inertiajs.com/docs/v3/the-basics/forms, /the-basics/manual-visits, /data-props/flash-data, /advanced/testing
- React: https://react.dev/learn/rendering-lists
- OpenSpec 1.14.1: generated instructions (openspec instructions), README
- Claude Code: https://code.claude.com/docs/en/skills, /sub-agents, /hooks
- Course: Episode 28 (requirements and build split), Episodes 29 to 32 (setup, data model, conversation, change log and indexes), Episode 18 (laravel-security skill), Episode 22 (Playwright MCP), Episodes 23 to 25 (OpenSpec), Episode 27 (worktrees)
