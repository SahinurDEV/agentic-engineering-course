# Day 30 · Episode 29: Capstone, Project Setup

**Series:** Agentic Engineering (free YouTube course) · Module 13
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 22:00
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 13 lessons):** Project Setup 1 (the app, PostgreSQL, checking R1) · Project Setup 2 (the Claude Code layer, GitHub, first commit)

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Claude, Laravel, Composer, npm, git, GitHub or test output is shown. The course files, prompt and commands are **written for the course** and printed below. Every command was run once in a throwaway folder on Linux on 10 October 2026 to confirm it works; none of that output appears in the video.

**Counts drawn on slides (checked against the files and the throwaway install):** prerequisites: 4 groups (PHP 8.3+ with Composer and the installer; Node 22+ with npm; PostgreSQL; git, gh, jq, Claude Code). Installer prompts left after the flags: 3 (authentication provider, teams, authentication features). PostgreSQL: 1 role, 2 databases. phpunit.xml: 2 values changed. R1: 3 kit test files (registration, authentication, password reset), run via the tests/Feature/Auth folder (7 files, 26 tests, all passing on PostgreSQL). .gitignore: 3 lines removed, 3 added. CLAUDE.md: 4 sections plus the import, 7 rules. Skills: 4 from module seven, 1 edited; OpenSpec adds 6 skills and 6 commands. Hooks: 3, plus 1 deny rule, in 1 settings file. Formatter ignore: 5 patterns. CI: 1 PostgreSQL service, 6 DB settings. First commit: 1.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook |
| 0:25–1:10 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:10–8:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 1 · The app and the database |
| 8:30–15:40 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · The Claude Code layer |
| 15:40–21:10 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · GitHub and the first commit |
| 21:10–22:00 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode, we wrote down what the Support Desk must do: twelve requirements, five quality rules, and what done means.
> Today we build the ground it stands on. An empty folder becomes a Laravel app on PostgreSQL, with every Claude Code tool from this course wired in, and one clean first commit on GitHub.

**Visual / B-roll:**
- Episode 28 recap panel, then the title card.

### 0:25–1:10 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-nine: capstone, project setup.

*Cue: agenda slide "Three parts"*
> Three parts. First, the app and the database: installing Laravel with the React starter kit, switching it to PostgreSQL, and checking requirement R one. Second, the Claude Code layer: CLAUDE dot m d, the skills, the hooks, the reviewer, Playwright, and OpenSpec. Third, GitHub and the first commit.
> It's an illustrated walkthrough, not a recording. I ran the setup commands once in a throwaway folder to make sure they work; the GitHub steps follow the docs. No output is shown. The files are printed in the description.

**Visual / B-roll:**
- Three items: 01 App and database · 02 Claude Code layer · 03 GitHub and first commit.

### 1:10–8:30 · Part 1: The app and the database
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "01 · App and database"*
> Part one. The app and the database.

*Cue: panel "What to install"*
> First, the tools. The Laravel docs ask for PHP, Composer, and the Laravel installer, plus Node and npm, or Bun, for the front end. Laravel thirteen needs PHP eight point three or newer.
> One more detail from my throwaway install: several of the starter kit's front end packages require Node twenty-two or newer, and the kit's own test workflow uses Node twenty-two. So use twenty-two or later.
> You also need PostgreSQL running locally, plus git, the GitHub command line tool g h, Claude Code, and a small JSON tool called j q, because our hooks from module eight use it.

*Cue: monitor "Install PHP and the installer"*
> If you don't have PHP yet, the Laravel docs give one command per system. On a Mac or on Linux, it's a short script from php dot new. On Windows, it's a PowerShell command run as administrator. Each installs PHP, Composer, and the Laravel installer together. Restart your terminal afterwards.
> If you already have PHP and Composer, install just the Laravel installer with composer global require laravel slash installer.
> And on a Mac or on Windows, the docs also offer Laravel Herd, a graphical app that does the same job.

*Cue: phone "Create the app"*
> Now create the app. The docs show laravel new, followed by the app's name, and the installer asks you questions.
> I pass the main answers as flags, so the setup is repeatable: laravel new support dash desk, dash dash react for the React starter kit, dash dash database equals p g s q l for PostgreSQL, dash dash pest for the test framework, dash dash n p m to install and build the front end, and dash dash no boost. These flags come from the installer's own help.
> Remember from last episode: a new Laravel app uses SQLite by default. The database flag is how we switch to PostgreSQL from the first minute.

*Cue: 4num "The prompts that are left"*
> With those flags, the installer still asks three questions. Here's what I answer.
> Which authentication provider? Laravel's built-in authentication. The other option, WorkOS, needs a WorkOS account.
> Teams support? No. Our roles are customer, agent, and admin, not teams.
> Which authentication features? I keep the defaults. Registration and password reset cover R one, and the extras, like email verification and two-factor authentication, come with their own tests.
> And Boost. The Laravel docs describe Laravel Boost as a tool that gives AI agents Laravel-specific context, tools, and guidelines. It's a good tool. We skip it here only because this course brings its own CLAUDE dot m d, skills and M C P setup, and I want you to see each piece. You can add Boost later with composer require.

*Cue: two columns "What the kit gives you"*
> Here's what you get. From the docs: the React starter kit is built with Inertia, React nineteen, TypeScript, Tailwind, and shad c n slash u i. Pages live in resources slash j s slash pages. And authentication runs on Laravel Fortify, with routes for login, registration, password reset, and email verification.
> From the install itself: Pest tests for all of that, and a GitHub workflow that runs the checks on every push to main and every pull request.
> What it can't give you is our part: a PostgreSQL user, our requirements, and the whole Claude Code layer. That's the rest of this episode.

*Cue: plan "PostgreSQL: one role, two databases"*
> The installer wrote PostgreSQL settings into dot env, but the database user it guessed doesn't exist yet. So we create one.
> Connect with p s q l as a superuser. How you do that depends on how you installed PostgreSQL. Then run three statements.
> Create role support underscore desk, with login and a password. Create database support underscore desk, owned by that role. And create a second database, support underscore desk underscore test, for the tests.
> One role, two databases. The app's data and the test data never touch. That matters, because the kit's feature tests use Laravel's refresh database trait, which migrates the test database and rolls back each test's changes.

*Cue: two-points ".env and .env.example"*
> Now point Laravel at them. In dot env, set D B username to support underscore desk, and D B password to your local password. The database name is already support underscore desk, because the installer used the app's name.
> The Laravel docs are clear that dot env should not be committed: each developer has their own, and committed credentials are a security risk. Dot env dot example is the shared template, so set the username there too, and leave the password empty.
> One clean-up: the installer also created an empty SQLite file in the database folder. We don't use it, so delete it.

*Cue: card "Tests on PostgreSQL too"*
> Next, a choice that matters for the whole capstone. The kit's phpunit dot x m l runs the tests on SQLite, in memory. Fast, but it's not the database we ship.
> Data modeling will use PostgreSQL features. For example, the Laravel docs say full text where clauses work on MariaDB, MySQL, and PostgreSQL, so not on SQLite. A test suite on SQLite could pass while production breaks, or fail on code that's fine.
> So we change two values in phpunit dot x m l: D B connection from sqlite to p g s q l, and D B database from memory to support underscore desk underscore test. Same engine as production, separate database.

*Cue: flow "First run"*
> Now the first run. php artisan migrate creates the kit's tables in support underscore desk.
> php artisan test runs the kit's whole test suite, now against PostgreSQL.
> Then composer run dev, which the docs say starts the local server, the queue worker, and Vite. Open localhost port eight thousand, and you see the welcome page, with log in and register links.

*Cue: squares "R1, checked by the kit"*
> That brings us to R one: customers register, sign in, and reset their password. The kit already ships tests for each part, in three files: the registration test, the authentication test, and the password reset test.
> To run them, pass the auth test folder to php artisan test. It holds those three files, plus the kit's other authentication tests, like email verification and two-factor.
> R one is mostly done, but not completely. The requirements also say new sign-ups are customers, and roles don't exist yet. That arrives in data modeling, next in the playlist. For now, passing these tests tells us the kit's sign-up, login and reset flows work on our database.

### 8:30–15:40 · Part 2: The Claude Code layer
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Claude Code layer"*
> Part two. The Claude Code layer.

*Cue: two columns "The .gitignore surprise"*
> Start with a surprise I found in the throwaway install. The kit's dot gitignore ignores the dot claude folder, CLAUDE dot m d, and dot m c p dot json.
> That's a fine default for personal setups. But we want the team to share this layer, so those three lines come out.
> Three lines go in instead, for the files that really are personal: dot claude slash settings dot local dot json, CLAUDE dot local dot m d, and the playwright output folder. The Claude Code docs say it keeps settings dot local dot json out of git when it creates that file, but an explicit line doesn't hurt.
> Then copy docs slash requirements dot m d from last episode into the project. Everything else builds on it.

*Cue: monitor "CLAUDE.md"*
> Now CLAUDE dot m d, written for the course and printed in full in the description. It's short on purpose; the docs warn that long files use more context and may reduce adherence.
> The third line imports the requirements with at docs slash requirements dot m d. The docs say imported files are expanded and loaded into context at launch, so every session starts knowing all twelve requirements.
> Then four sections: the stack, the commands, where things live, and seven rules. Build only what the requirements ask for. Every feature starts as an OpenSpec change that names its R numbers. Schema changes only through migrations. A policy on every ticket action. A Pest test for every requirement you touch. Never edit dot env or generated files. And run the tests before saying a task is done.
> If you'd rather start from slash init, the docs say that when a CLAUDE dot m d already exists, it suggests improvements instead of overwriting it.

*Cue: 4num "Four skills from module seven"*
> Next, the four skills from module seven, copied into dot claude slash skills: React best practices, Laravel security, database conventions, and new migration.
> Three fit as they are. The React skill needs one edit. Its paths pointed at a source folder, but in this kit the React code lives in resources slash j s. So its paths become resources slash j s, for t s x and t s files. Its check line now names the kit's commands: npm run check, and php artisan test.
> That's the general lesson: a skill is written for a codebase. When the codebase changes, read the skill again.

*Cue: phone "Three hooks, one settings file"*
> Then the three hooks from module eight. One blocks edits to protected files like dot env and the lock files. One formats every edited file. And a Stop hook runs the tests before Claude finishes.
> One script changes. The kit doesn't use Prettier. Its package file formats with Vite plus, through a command called v p. So the format hook now runs v p format for JavaScript, TypeScript and CSS files, and Pint for PHP, as before.
> All three hooks, plus the Playwright deny rule from module nine, go into one file: dot claude slash settings dot json, printed in the description.

*Cue: card "The reviewer, adapted"*
> The code reviewer subagent from module six comes along too, in dot claude slash agents. But it was written for the cart: it checked a plan file, prices in cents, and npm test.
> The Support Desk version checks the diff against the active OpenSpec change, checks that a Pest test covers each scenario, checks that a policy authorizes every ticket action and that customers never see internal notes, and runs php artisan test.
> Same shape as before. It reviews and reports; it never edits.

*Cue: plan "Playwright MCP"*
> Now M C P. We add the Playwright server with claude m c p add, dash dash scope project. The docs say project scope writes it to dot m c p dot json at the root, so it's shared with the team. The arguments are the ones from module nine: isolated, a twelve eighty by seven twenty viewport, and the playwright output folder.
> The first time you start Claude in the project, it asks you to approve that project server. That's deliberate: a cloned repository shouldn't be able to switch on its own tools.
> And here's its first real job: checking R one in a real browser. The prompt, written for the course, asks Claude to open the register page, register a test customer, sign out, sign in again, open the forgot password page, and report any console errors. The kit's dot env sends mail to the log, so the reset link lands in the Laravel log file, not in an inbox.

*Cue: squares "OpenSpec"*
> Then OpenSpec, from module ten. Run openspec init, dash dash tools claude. In the version I installed, that added six skills and six slash commands, the same set we used for the cart, and an openspec folder with specs, changes, and a config file.
> We edit that config. The comments in it say to add only what an agent can't work out from the code. So the context says one thing: requirements live in docs slash requirements dot m d, numbered R one to R twelve and Q one to Q five, and every change traces back to them.
> And three rule groups: proposals name their R numbers and say what's out of scope; every requirement gets a scenario, including one for each role that must be refused; and tasks include running php artisan test.

*Cue: two-points "The formatter and the tools"*
> One last clash, found by running the kit's own checks. The kit's check command formats every file it finds, including Markdown and JSON. So our new files failed its formatting check.
> But many of them are written by tools. Claude Code writes dot m c p dot json, and OpenSpec writes its own skills and commands. If the formatter reshapes them, the tools rewrite them, and the two fight forever.
> The kit's vite config already has a formatter ignore list. We add five patterns: dot claude, dot m c p dot json, CLAUDE dot m d, docs, and openspec. Code stays formatted; tool files stay as their tools wrote them.

### 15:40–21:10 · Part 3: GitHub and the first commit
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · GitHub and first commit"*
> Part three. GitHub and the first commit.

*Cue: monitor "CI on PostgreSQL"*
> The kit's workflow runs on GitHub's machines, and they have no PostgreSQL. Our tests now need one. GitHub's docs show how: a service container.
> We add a postgres service to the job. Its environment sets a password and a database named support underscore desk underscore test. A health check with p g is ready makes the job wait until PostgreSQL is up. And port five four three two is mapped to the runner, so the job reaches it on the local address.
> Then six D B settings at job level: connection, host, port, database, username, and password. The Laravel docs say real environment variables override dot env, so these win in CI. And because they match phpunit dot x m l's test database, the tests run on PostgreSQL there too.

*Cue: flow "Before the first commit"*
> Before committing, run the same checks CI will run: composer c i colon check. In this kit, that runs the front end checks, the TypeScript check, then composer test, which runs Pint, static analysis, and the test suite.
> Then git status, and read the list. Dot env must not be there. Neither should vendor or node modules. CLAUDE dot m d, dot claude, dot m c p dot json, docs, and openspec should.
> Then commit, then push.

*Cue: panel "A fresh kit, a red check?"*
> A real-world note. When I ran those checks in my throwaway install, one of the kit's own checks failed: the TypeScript check, inside route files the kit generates. Nothing we wrote was involved.
> If that happens to you, don't start by changing code. Check the starter kit's repository for a known issue, or update the packages. And don't ask Claude to hand-edit generated files; they're rebuilt on every build, which is why our CLAUDE dot m d forbids it.
> By the time you watch this, it may already be fixed. The habit is what matters: know whether a red check is yours before you fix it.

*Cue: phone "First commit, first push"*
> Now the commit. git init, dash b main, so the branch is named main from the start. git add everything. Then one commit for the whole setup, with a clear message.
> Then g h repo create support dash desk, dash dash private, dash dash source equals dot, dash dash push. The g h manual says source points at the local repository, and push sends its commits to the new one.
> One commit, one push. The kit's workflow starts on that push, because it runs on pushes to main.

*Cue: 4num "Connect Claude to GitHub"*
> Last, the Claude GitHub app from module eleven. Open Claude in the project and run slash install github app.
> The docs say it installs the Claude GitHub App, adds your authentication secret, and prepares the workflow pull request for you. It only works with repositories on github dot com.
> That pull request is our first review. Read the workflow files, merge it, and from then on, at Claude in an issue or a pull request gets an answer.

*Cue: card "What's in the repo"*
> So what's committed? The app, CLAUDE dot m d, docs slash requirements, the dot claude folder with skills, hooks, the reviewer and settings, dot m c p dot json, the openspec folder, and the updated workflow.
> What's not? Dot env, vendor, node modules, your settings dot local dot json, and the playwright output folder.
> If a teammate clones it, they get every rule and every tool. They only need their own dot env, their own database, and to approve the Playwright server once.

*Cue: two columns "Ready for data modeling"*
> That's the ground laid. Today we got a working app on PostgreSQL, R one checked by tests and in a browser, the full Claude Code layer, and CI on every push and pull request.
> Next comes data modeling. Roles come first, because R one isn't finished until new sign-ups are customers. Then tickets and categories. Each one starts as an OpenSpec change, and each migration goes through the new migration skill.

### 21:10–22:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> Set up once, carefully, and every session after starts on solid ground.

*Cue: recap slide*
> Quick recap.
> Laravel thirteen with the React kit, created with flags, on PostgreSQL, with tests on PostgreSQL too.
> R one checked by the kit's tests and by Playwright in a browser.
> CLAUDE dot m d importing the requirements, four skills, three hooks, the reviewer, and OpenSpec, all committed.
> CI with a PostgreSQL service, one first commit, and Claude connected to GitHub.

*Cue: closer slide "Next in the playlist"*
> Next in the playlist: episode thirty, capstone, data modeling part one. We start the schema with roles, the right way: specs first, migrations reviewed before they run. See you there.

---

## Example files (written for the course)

All are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. `docs/requirements.md` is unchanged from Episode 28. The four skills and the protect-files and stop-tests hooks are unchanged from Episodes 17 to 20, except the two React skill lines shown below.

### `CLAUDE.md`

```markdown
# Support Desk
Customer support ticket app, the Agentic Engineering capstone.
Requirements: @docs/requirements.md

## Stack
- Laravel 13, React starter kit (Inertia, React 19, TypeScript, shadcn/ui)
- PostgreSQL for the app and the tests (support_desk_test)
- Pest tests, Fortify auth

## Commands
- Dev: composer run dev
- Tests: php artisan test
- PHP style: vendor/bin/pint
- All CI checks: composer ci:check

## Where things live
- Pages: resources/js/pages
- Components: resources/js/components
- Routes: routes/web.php, routes/settings.php
- Specs: openspec/specs, changes in openspec/changes

## Rules
- Build only what docs/requirements.md asks for.
- Every feature starts as an OpenSpec change naming its R numbers.
- Schema changes only through migrations, with the new-migration skill.
- Authorize every ticket action with a policy.
- Write a Pest feature test for every requirement you touch.
- Never edit .env or generated files (resources/js/actions, routes, wayfinder).
- Run php artisan test before saying a task is done.
```

### `.claude/settings.json`

```json
{
  "permissions": { "deny": ["mcp__playwright__browser_run_code_unsafe"] },
  "hooks": {
    "PreToolUse": [{ "matcher": "Edit|Write", "hooks": [{ "type": "command", "command": "\"$CLAUDE_PROJECT_DIR\"/.claude/hooks/protect-files.sh" }] }],
    "PostToolUse": [{ "matcher": "Edit|Write", "hooks": [{ "type": "command", "command": "\"$CLAUDE_PROJECT_DIR\"/.claude/hooks/format.sh" }] }],
    "Stop": [{ "hooks": [{ "type": "command", "command": "\"$CLAUDE_PROJECT_DIR\"/.claude/hooks/stop-tests.sh" }] }]
  }
}
```

### `.claude/hooks/format.sh` (Support Desk version)

```bash
#!/bin/bash
# PostToolUse hook for Edit and Write: format the edited file.
# Support Desk version: the React kit formats with Vite+ (vp fmt), not Prettier.
FILE_PATH=$(jq -r '.tool_input.file_path // empty')
cd "$CLAUDE_PROJECT_DIR" || exit 0

case "$FILE_PATH" in
  *.php) ./vendor/bin/pint "$FILE_PATH" ;;
  *.js|*.jsx|*.ts|*.tsx|*.css) npx vp fmt "$FILE_PATH" ;;
esac

exit 0
```

### `.claude/agents/code-reviewer.md` (Support Desk version)

```markdown
---
name: code-reviewer
description: Reviews the Support Desk diff against its OpenSpec change. Use before committing.
tools: Read, Grep, Glob, Bash
model: sonnet
---

You review; you never edit files.
1. Run git diff and read the changed files in full.
2. Flag changed files the active change in openspec/changes doesn't cover.
3. Check that a Pest test covers each scenario.
4. Check that a policy authorizes every ticket action, and that customers never see internal notes.
5. Run php artisan test once.
Report briefly: verdict (ready, or needs changes), must fix with file and line, should fix, outside the change.
```

### `openspec/config.yaml` (after `openspec init --tools claude`)

```yaml
schema: spec-driven

context: |
  Requirements live in docs/requirements.md, numbered R1 to R12 and Q1 to Q5.
  Every change traces back to those numbers.

rules:
  proposal:
    - Name the R numbers this change covers
    - Always state what is out of scope
  specs:
    - Every requirement needs at least one scenario
    - Add a scenario for each role that must be refused
  tasks:
    - Include a task to run php artisan test
```

### Edits to kit files

```text
.gitignore: remove /.claude, /CLAUDE.md, /.mcp.json; add /.claude/settings.local.json, /CLAUDE.local.md, /playwright-output
.env (never committed): DB_USERNAME=support_desk, DB_PASSWORD=your local password
.env.example: DB_USERNAME=support_desk
phpunit.xml: DB_CONNECTION pgsql (was sqlite), DB_DATABASE support_desk_test (was :memory:)
vite.config.ts fmt ignorePatterns, add: '.claude/**', '.mcp.json', 'CLAUDE.md', 'docs/**', 'openspec/**'
React skill: paths "resources/js/**/*.tsx" and "resources/js/**/*.ts"; checks run npm run check and php artisan test
format.sh: the Prettier line becomes  *.js|*.jsx|*.ts|*.tsx|*.css) npx vp fmt "$FILE_PATH" ;;
```

Exact lines in `.claude/skills/react-best-practices/SKILL.md` after the edit:

```text
paths:
  - "resources/js/**/*.tsx"
  - "resources/js/**/*.ts"
- Run npm run check and php artisan test after every change, and report the result.
```

### Added to `.github/workflows/tests.yml`, under the `ci` job after `runs-on` (the rest is the kit's file, unchanged)

```yaml
    services:
      postgres:
        image: postgres
        env:
          POSTGRES_PASSWORD: postgres
          POSTGRES_DB: support_desk_test
        options: --health-cmd pg_isready --health-interval 10s --health-timeout 5s --health-retries 5
        ports:
          - 5432:5432
    env:
      DB_CONNECTION: pgsql
      DB_HOST: 127.0.0.1
      DB_PORT: 5432
      DB_DATABASE: support_desk_test
      DB_USERNAME: postgres
      DB_PASSWORD: postgres
```

### Commands

```text
laravel new support-desk --react --database=pgsql --pest --npm --no-boost
cd support-desk
psql -U postgres
CREATE ROLE support_desk LOGIN PASSWORD 'your-local-password';
CREATE DATABASE support_desk OWNER support_desk;
CREATE DATABASE support_desk_test OWNER support_desk;
rm database/database.sqlite
php artisan migrate
php artisan test
php artisan test tests/Feature/Auth
composer run dev
claude mcp add --scope project playwright -- npx -y @playwright/mcp@latest --isolated --viewport-size 1280x720 --output-dir playwright-output
openspec init --tools claude
composer ci:check
git init -b main
git add -A
git status
git commit -m "Set up Support Desk"
gh repo create support-desk --private --source=. --push
claude, then /install-github-app
```

If PHP isn't installed, the Laravel docs give one install command per system (php.new for macOS and Linux, a PowerShell command for Windows), or `composer global require laravel/installer` when PHP and Composer are already there. OpenSpec was installed in Episode 23 with `npm install -g @fission-ai/openspec@latest`.

### R1 browser check prompt

```text
Use playwright to open http://localhost:8000/register. Register a test customer, sign out, and sign in again. Then open the forgot password page and request a reset link. Use snapshots to read the page, and report any console errors.
```

---

## Production notes
- Spoken word count: about 2,940 words, roughly 20.2 minutes at a steady TTS pace, plus slide pauses (plan target about 22).
- Illustrated walkthrough, not a recording. No command output is shown. The narration says the setup commands were run once in a throwaway folder, which is true for everything except the two GitHub steps (gh repo create and /install-github-app were not run; the narration says the GitHub steps follow the docs) (10 Oct 2026, Debian Linux, PHP 8.5.0 from php.new, Laravel installer 5.32.0, laravel/framework v13.35.0, PostgreSQL 17, Claude Code 2.1.296, OpenSpec 1.14.1).
- The agenda says three parts and the script has three parts (three dividers). The plan lists Project Setup 1 and 2; Part 1 is setup 1, Parts 2 and 3 are setup 2.
- Spoken episode numbers: "episode twenty-nine" (this one), "episode thirty" (next), module numbers four to eleven for earlier tools.
- Laravel facts (laravel.com/docs/13.x): installation (PHP, Composer, Laravel installer, Node and NPM or Bun; php.new commands for macOS, Linux, Windows PowerShell as administrator; restart the terminal; composer global require laravel/installer; Herd for macOS and Windows; laravel new; composer run dev starts the server, queue worker and Vite at localhost:8000; .env should not be committed; SQLite by default; DB_* variables; php artisan migrate; Boost description and composer require laravel/boost --dev); releases (Laravel 13 requires PHP 8.3); starter-kits (installer prompts for a kit; React kit built with Inertia 3, React 19, Tailwind 4, shadcn/ui, TypeScript; resources/js/pages; Fortify routes for login, registration, password reset, email verification); configuration (environment variables override .env); testing (Pest and PHPUnit out of the box, phpunit.xml sets the testing environment, php artisan test); queries (whereFullText on MariaDB, MySQL, PostgreSQL).
- Verified only by running (stated as such in the narration): installer flags from `laravel new --help`; with the flags, 3 prompts remain (authentication provider, teams, authentication features); the kit's .gitignore lists /.claude, /CLAUDE.md, /.mcp.json; the kit ships .github/workflows/tests.yml (push to main and pull_request, Node 22, composer setup, composer ci:check); phpunit.xml uses sqlite :memory:; the installer writes DB_DATABASE=support_desk and DB_USERNAME=root and creates database/database.sqlite; several front end packages require Node 22 or newer; MAIL_MAILER=log; the kit formats with Vite+ (vp fmt, oxfmt), and vite.config.ts has fmt.ignorePatterns; composer ci:check runs npm run check, the TypeScript check, then composer test (Pint test mode, PHPStan, php artisan test). R1 test files: RegistrationTest (2 tests), AuthenticationTest (6), PasswordResetTest (5), 13 passing on PostgreSQL; full suite 40 passing on PostgreSQL. Hooks tested: protect-files denies .env; format.sh runs Pint and vp fmt.
- Known upstream issue at verification time: `npm run types:check` (tsc) failed in generated Wayfinder files (resources/js/actions/Illuminate/Routing/RedirectController.ts: the 'query' HTTP method is not in the generated Method type). laravel/wayfinder v0.1.21 and @laravel/vite-plugin-wayfinder 0.1.10 were the latest. The narration says only that a kit check failed in generated route files, and gives general advice.
- CI simulation: a fresh clone with the job's DB variables ran composer setup and the test suite on PostgreSQL successfully; formatting and lint passed after the ignore patterns; only the upstream tsc check failed. GitHub Actions itself was not run.
- Claude Code facts (code.claude.com/docs): memory (@path imports load at launch; long files use more context and may reduce adherence; /init suggests improvements when CLAUDE.md exists; CLAUDE.local.md for private notes, add it to .gitignore); settings (settings.local.json kept out of git when Claude Code creates it); mcp (`--scope project` writes .mcp.json; project servers need approval in an interactive session; a cloned repository can't approve its own servers); github-actions (/install-github-app installs the app, adds the secret, prepares the workflow pull request; github.com only).
- GitHub facts (docs.github.com, PostgreSQL service containers, running jobs directly on the runner): postgres service, POSTGRES_PASSWORD, health options with pg_isready, ports 5432:5432, localhost. The docs write options as a folded block; the course file writes the same options on one line to keep it free of angle brackets. Docker official image docs: POSTGRES_DB names the default database; the default superuser is postgres.
- gh manual (gh repo create): --private, --source, --push. git-scm.com/docs/git-init: -b sets the initial branch.
- Logic checks: 1 role and 2 databases; phpunit.xml changes 2 values; the CI env sets the same connection and database name as phpunit.xml, so local and CI both test on support_desk_test; .gitignore 3 out, 3 in; CLAUDE.md has 7 rules; 4 course skills plus 6 OpenSpec skills; 3 hooks plus 1 deny rule; 5 ignore patterns; R1 is described as mostly done, because roles arrive in data modeling.
- YouTube description: the ready-to-paste description below is 4,974 characters, under the 5,000 limit, and contains no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Set Up a Laravel 13 + React + PostgreSQL Project for Claude Code | Agentic Engineering Ep 29
2. Capstone Project Setup: CLAUDE.md, Skills, Hooks, MCP, OpenSpec and CI | Ep 29
3. Capstone, Project Setup | Agentic Engineering Ep 29

### Description (ready to paste, 4,974 characters)

```
Episode 29 of Agentic Engineering, a free course on building real software with AI coding agents.
We set up the capstone Support Desk: Laravel 13, React starter kit, PostgreSQL, R1 checked, CLAUDE.md, skills, hooks, reviewer, Playwright MCP, OpenSpec, CI and the first commit.
Screens are drawn illustrations; no output is shown. Files are written for the course; docs/requirements.md is in the Episode 28 description.
CLAUDE.md:
# Support Desk
Customer support ticket app, the Agentic Engineering capstone.
Requirements: @docs/requirements.md

## Stack
- Laravel 13, React starter kit (Inertia, React 19, TypeScript, shadcn/ui)
- PostgreSQL for the app and the tests (support_desk_test)
- Pest tests, Fortify auth

## Commands
- Dev: composer run dev
- Tests: php artisan test
- PHP style: vendor/bin/pint
- All CI checks: composer ci:check

## Where things live
- Pages: resources/js/pages
- Components: resources/js/components
- Routes: routes/web.php, routes/settings.php
- Specs: openspec/specs, changes in openspec/changes

## Rules
- Build only what docs/requirements.md asks for.
- Every feature starts as an OpenSpec change naming its R numbers.
- Schema changes only through migrations, with the new-migration skill.
- Authorize every ticket action with a policy.
- Write a Pest feature test for every requirement you touch.
- Never edit .env or generated files (resources/js/actions, routes, wayfinder).
- Run php artisan test before saying a task is done.
.claude/agents/code-reviewer.md:
---
name: code-reviewer
description: Reviews the Support Desk diff against its OpenSpec change. Use before committing.
tools: Read, Grep, Glob, Bash
model: sonnet
---

You review; you never edit files.
1. Run git diff and read the changed files in full.
2. Flag changed files the active change in openspec/changes doesn't cover.
3. Check that a Pest test covers each scenario.
4. Check that a policy authorizes every ticket action, and that customers never see internal notes.
5. Run php artisan test once.
Report briefly: verdict (ready, or needs changes), must fix with file and line, should fix, outside the change.
openspec/config.yaml:
schema: spec-driven

context: |
  Requirements live in docs/requirements.md, numbered R1 to R12 and Q1 to Q5.
  Every change traces back to those numbers.

rules:
  proposal:
    - Name the R numbers this change covers
    - Always state what is out of scope
  specs:
    - Every requirement needs at least one scenario
    - Add a scenario for each role that must be refused
  tasks:
    - Include a task to run php artisan test
Edits:
.gitignore: remove /.claude, /CLAUDE.md, /.mcp.json; add /.claude/settings.local.json, /CLAUDE.local.md, /playwright-output
.env (never committed): DB_USERNAME=support_desk, DB_PASSWORD=your local password
.env.example: DB_USERNAME=support_desk
phpunit.xml: DB_CONNECTION pgsql (was sqlite), DB_DATABASE support_desk_test (was :memory:)
vite.config.ts fmt ignorePatterns, add: '.claude/**', '.mcp.json', 'CLAUDE.md', 'docs/**', 'openspec/**'
React skill: paths "resources/js/**/*.tsx" and "resources/js/**/*.ts"; checks run npm run check and php artisan test
format.sh: the Prettier line becomes  *.js|*.jsx|*.ts|*.tsx|*.css) npx vp fmt "$FILE_PATH" ;;
.claude/settings.json: the hooks block from Episode 20 plus the deny rule from Episode 22
.github/workflows/tests.yml, add under the ci job after runs-on:
    services:
      postgres:
        image: postgres
        env:
          POSTGRES_PASSWORD: postgres
          POSTGRES_DB: support_desk_test
        options: --health-cmd pg_isready --health-interval 10s --health-timeout 5s --health-retries 5
        ports:
          - 5432:5432
    env:
      DB_CONNECTION: pgsql
      DB_HOST: 127.0.0.1
      DB_PORT: 5432
      DB_DATABASE: support_desk_test
      DB_USERNAME: postgres
      DB_PASSWORD: postgres
Commands:
laravel new support-desk --react --database=pgsql --pest --npm --no-boost
cd support-desk
psql -U postgres
CREATE ROLE support_desk LOGIN PASSWORD 'your-local-password';
CREATE DATABASE support_desk OWNER support_desk;
CREATE DATABASE support_desk_test OWNER support_desk;
rm database/database.sqlite
php artisan migrate
php artisan test
php artisan test tests/Feature/Auth
composer run dev
claude mcp add --scope project playwright -- npx -y @playwright/mcp@latest --isolated --viewport-size 1280x720 --output-dir playwright-output
openspec init --tools claude
composer ci:check
git init -b main
git add -A
git status
git commit -m "Set up Support Desk"
gh repo create support-desk --private --source=. --push
claude, then /install-github-app
R1 browser check prompt:
Use playwright to open http://localhost:8000/register. Register a test customer, sign out, and sign in again. Then open the forgot password page and request a reset link. Use snapshots to read the page, and report any console errors.
Docs: laravel.com/docs/13.x, code.claude.com/docs
Next in the playlist: Episode 30, Capstone, Data Modeling Part 1.
```

### Tags
Claude Code, Laravel 13, React starter kit, PostgreSQL, CLAUDE.md, Claude Code hooks, Claude Code skills, Playwright MCP, OpenSpec, GitHub Actions

### Thumbnail text idea
"SET UP ONCE" in coral, over a drawn folder tree with .claude, docs and openspec highlighted.

---

## Suggested slide list (Episode 29 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 29 · Capstone, Project Setup |
| 2 | Agenda | Three parts: App and database · Claude Code layer · GitHub and first commit |
| 3 | 01 · App and database | Divider |
| 4 | What to install | PHP 8.3+ · Node 22+ · PostgreSQL |
| 5 | Install PHP and the installer | php.new, Herd (Illustration) |
| 6 | Create the app | laravel new with flags (Illustration) |
| 7 | The prompts that are left | Auth · Teams · Features · Boost |
| 8 | What the kit gives you | From the kit vs ours to add |
| 9 | PostgreSQL | 1 role, 2 databases (Illustration) |
| 10 | .env and .env.example | Local vs shared (Illustration) |
| 11 | Tests on PostgreSQL too | phpunit.xml (Illustration) |
| 12 | First run | Migrate · Test · Dev · Browser · R1 |
| 13 | R1, checked by the kit | 3 test files |
| 14 | 02 · Claude Code layer | Divider |
| 15 | The .gitignore surprise | 3 out, 3 in |
| 16 | CLAUDE.md | Import + 4 sections (Illustration) |
| 17 | Four skills | 1 edited |
| 18 | Three hooks | settings.json (Illustration) |
| 19 | The reviewer, adapted | Cart vs Support Desk (Illustration) |
| 20 | Playwright MCP | Project scope, R1 prompt (Illustration) |
| 21 | OpenSpec | Init · Adds · Config |
| 22 | The formatter and the tools | 5 ignore patterns (Illustration) |
| 23 | 03 · GitHub and first commit | Divider |
| 24 | CI on PostgreSQL | Service container (Illustration) |
| 25 | Before the first commit | Check · Status · No .env · Commit · Push |
| 26 | A fresh kit, a red check? | Upstream first |
| 27 | First commit, first push | git and gh (Illustration) |
| 28 | Connect Claude to GitHub | /install-github-app |
| 29 | What's in the repo | Committed vs not (Illustration) |
| 30 | Ready for data modeling | Done today vs next |
| 31 | Quote | Set up once |
| 32 | Recap | |
| 33 | Next | Episode 30 · Capstone, Data Modeling Part 1 |

---

## Sources
- Laravel: https://laravel.com/docs/13.x/installation, /releases, /starter-kits, /configuration, /database, /testing, /queries
- Claude Code: https://code.claude.com/docs/en/memory, /settings, /mcp, /skills, /hooks, /github-actions
- GitHub: https://docs.github.com (Creating PostgreSQL service containers)
- Docker official postgres image docs (POSTGRES_PASSWORD, POSTGRES_DB)
- PostgreSQL: CREATE ROLE, CREATE DATABASE (postgresql.org/docs/current)
- GitHub CLI manual: gh repo create. Git: git-scm.com/docs/git-init
- Course: Episode 28 (requirements), Episodes 13, 17 to 20, 22, 23, 26 (reviewer, skills, hooks, Playwright MCP, OpenSpec, GitHub app)
