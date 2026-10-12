# Day 19 · Episode 18: A Laravel Security Skill

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 13:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 7 lesson):** Laravel Security Skill

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `laravel-security` skill and its `checklist.md` are **written for this course** (full text under "Example files" below). The security rules in it come from the official Laravel docs (laravel.com/docs), and the checklist headings use OWASP Top 10:2025 categories. No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) | n/a |
| 1:00–4:00 | [VOICEOVER + SLIDE] | Part 1 · Why security needs a skill | Laravel Security Skill |
| 4:00–9:00 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Writing the skill: folder, frontmatter, paths, four rule groups, checklist.md | Laravel Security Skill |
| 9:00–12:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Using and testing it, and its limits | Laravel Security Skill |
| 12:00–13:00 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we wrote a reference skill: React rules that load whenever Claude touches a component. Those rules keep your code clean.
> Today's rules keep your users safe. Same kind of skill, higher stakes. A React mistake gives you a bug. A security mistake gives someone else your data.

**Visual / B-roll:**
- Episode 17 recap panel, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode eighteen: a Laravel security skill.

*Cue: agenda slide "Three parts"*
> Three parts. First, why security needs a skill, even in a framework that's secure by default. Second, writing the skill: the frontmatter, the paths, four groups of rules, and a review checklist. Third, using it, testing it, and being honest about its limits. Everything on screen is an illustration. The skill is written for this course, and every rule in it comes from the official Laravel docs at laravel dot com.

**Visual / B-roll:**
- Three items: 01 Why a skill · 02 Write it · 03 Use and test it.

### 1:00–4:00 · Part 1: Why security needs a skill
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "01 · Why security needs a skill"*
> Part one. Why security needs a skill.

*Cue: panel "Secure by default"*
> Laravel does a lot for you out of the box.
> Blade's double curly brace echo runs your data through P H P's H T M L special chars function, to prevent cross-site scripting.
> The query builder uses P D O parameter binding, which the docs say protects your application against S Q L injection.
> Eloquent models are protected against mass assignment by default. And Laravel generates a C S R F token for each user session, so it can check that the signed-in user is the one actually making the request.
> So why write a skill at all? Because every one of those defaults has a way around it.

*Cue: squares "Three escape hatches"*
> Here are three.
> Raw expressions. The docs say raw statements are injected into the query as strings, and Laravel can't guarantee that a query using raw expressions is protected against S Q L injection.
> Unescaped Blade. The curly brace, double exclamation mark syntax skips escaping. The docs say be very careful when echoing content supplied by your users, and typically use the escaped syntax.
> And unguarded models. You can make every attribute mass assignable, but then you have to hand-craft every array you pass in.
> These shortcuts exist for good reasons. The problem is that an agent in a hurry, or a developer in a hurry, can reach for one when it isn't needed. A skill puts the rule in front of Claude at the moment it's writing that code.

*Cue: two columns "Skill or review?"*
> You might ask: doesn't Claude Code already have something for this? It does. The built-in slash security review command analyzes the changes on your branch for security vulnerabilities, like injection, auth issues, and data exposure. That's a review after the fact.
> Our skill is reference content. It works while the code is being written, so there's less to find later. You want both.
> One naming tip from the skills docs. If a project skill has the same name as a built-in command, in a local terminal session your skill replaces it. So don't call yours security review. I call mine laravel security.

*Cue: four numbered "Four rule groups"*
> The skill has four groups of rules.
> Input and queries: validate everything, and never build S Q L from user input.
> Output: escape what you echo.
> Access: authorize every action, and protect forms and logins.
> Secrets and configuration: keep keys out of the code and debug mode out of production.
> These line up with the top of the O W A S P Top Ten for twenty twenty-five, the standard awareness list for web application risks. Broken access control is number one, security misconfiguration is number two, and injection is number five.

**Visual / B-roll:**
- Panel: Blade escapes · Bindings · Guarded models.
- Squares: Raw SQL · Unescaped Blade · Unguarded.
- Two columns: /security-review vs laravel-security.
- Four numbered: Input and queries · Output · Access · Secrets.

### 4:00–9:00 · Part 2: Writing the skill
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Writing the skill"*
> Part two. Writing the skill.

*Cue: drawn folder tree "A project skill"*
> It's a project skill, in dot claude slash skills slash laravel dash security, committed so the whole team gets it.
> Two files. SKILL dot M D, with the rules. And checklist dot M D, a review checklist for when you ask Claude to audit code. Both are written for this course, and the full text is in the description.
> And notice one thing it doesn't have: an allowed tools field. The skills docs warn that a skill can grant itself broad tool access, so review the allowed tools of any skill checked into a repository before you run Claude Code there. A security skill should be the last place you hand out extra permissions.

*Cue: two points "The frontmatter"*
> The frontmatter works like last episode.
> The description puts the main use first: security rules for Laravel code in this project, for writing, editing, or reviewing controllers, routes, models, form requests, queries, or Blade views.
> When to use adds trigger phrases: adding a route or a form, handling user input, writing a query, rendering user content, adding a login flow, or reviewing a pull request.
> And paths limits automatic loading to the P H P files under app, routes, and resources slash views. Blade templates end in dot blade dot P H P, so the views pattern covers them too. Change your frontend, and this skill stays out of the way.

*Cue: card "Input and queries"*
> The body opens with a standing instruction: apply these rules to all Laravel code in this task, and treat every request field, header, and uploaded file as untrusted.
> Group one is input and queries.
> Validate every request before you use it, with validation rules or a form request. Then pass only the validated data to create, update, or fill. Never pass all the request input. The Eloquent docs give the classic example: a user sends an is admin field you never expected, and it lands in your database.
> Declare which attributes are mass assignable, and never mark a model unguarded.
> Then queries. Use the query builder or Eloquent, with bindings. Never put user input into raw expressions, like D B raw or where raw. And one the docs call out directly: P D O can't bind column names, so never let user input choose a column, including an order by column. Map it against an allow list instead.

*Cue: plan "Output and access"*
> Group two is output, and it's short. Echo data in Blade with double curly braces, which escapes it. Never use the unescaped syntax for content a user supplied.
> Group three is access, and it's the one agents forget most, because the code works without it.
> Authorize every action that reads or changes a resource, with a policy or a gate. The Laravel docs describe gates and policies as the two primary ways of authorizing actions. Being logged in is not the same as being allowed. If changing an order number in the U R L shows you someone else's order, that's broken access control.
> Include the C S R F directive in every post, put, patch, or delete form, and don't exclude routes from C S R F protection without asking.
> And put a rate limiter on login, password reset, and other sensitive routes, using Laravel's throttle middleware.

*Cue: two points "Secrets and checks"*
> Group four is secrets and configuration. Never commit the dot env file, and never hard-code keys, passwords, or tokens. The Laravel docs say committing dot env would be a security risk if an intruder got into your repository.
> Keep app debug false in production. The docs say if it's true in production, you risk exposing sensitive configuration values to your users.
> And hash passwords with Laravel's Hash facade, which provides bcrypt and argon two hashing. Never store or log a password in plain text.
> Then the checks: run the test suite after every change and report the result, and list any security-relevant change in the summary, like a new route, a new query, or changed authorization. That list is what you read first in review.

*Cue: phone "checklist.md"*
> Last, the supporting file. SKILL dot M D ends with one line: for a review checklist mapped to the O W A S P Top Ten, see checklist dot M D.
> The checklist is a set of questions, grouped by risk. Under broken access control: can a user change an I D in the U R L and reach someone else's order? Under injection: is any column or sort field taken from the request without an allow list?
> It's only read when Claude needs it, so SKILL dot M D stays short.
> One note on the text. Laravel code is full of arrows, and Blade views are H T M L tags. I wrote both files without any angle brackets, using plain words and Blade's curly braces instead, so they paste cleanly into a YouTube description.

**Visual / B-roll:**
- Monitor + Illustration: .claude/skills/laravel-security/ with SKILL.md, checklist.md.
- Two points + Illustration: frontmatter (description, when_to_use, paths).
- Card + Illustration: Input and queries section.
- Plan + Illustration: Output and Access sections.
- Two points + Illustration: Secrets and Checks sections.
- Phone + Illustration: checklist.md "Broken access control" entry.

### 9:00–12:00 · Part 3: Using and testing it
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Using and testing it"*
> Part three. Using it, testing it, and its limits.

*Cue: flow "How it gets used"*
> The normal flow looks like last episode. You ask for Laravel work, like an endpoint that updates an order's shipping address. Claude works with a controller under app, so the paths match. The skill loads, and Claude applies the rules as it writes: validate the address, authorize the update with the order policy, pass only validated data. Then it runs the tests and lists the security-relevant changes.
> You didn't type anything special.

*Cue: drawn terminal "Or ask for a review"*
> You can also invoke it directly with a file path. Type slash laravel dash security, then the path to the order controller.
> There's no arguments placeholder, so Claude Code appends the path to the end of the skill content, labelled arguments. Claude sees the file you meant and can work through the checklist.
> And before you merge, run the built-in security review on the branch as a second pass.
> On screen are only the prompts I'd type. No output is shown.

*Cue: four numbered "Test it"*
> Testing is the same baseline method as episode fifteen, with prompts that tempt the shortcuts.
> One, write a few of them. Let an admin sort orders by any column from the query string. Show a customer's note with its formatting. Add a quick endpoint to update any field on an order.
> Two, run each in a fresh session with the skill on.
> Three, run them again with the skill off, using skill overrides.
> Four, compare. Did it use an allow list for the sort column? Did it keep the escaped echo? Did it authorize the update and use validated data?
> Then check the trigger with a prompt about a frontend file, to make sure paths keeps it out.

*Cue: panel "Guidance, not a guarantee"*
> Now the honest part. A skill is guidance. Claude follows it, but nothing enforces it, and a security rule you follow most of the time is not a security rule.
> The docs say that if a rule must hold every time, move it into a hook, because Claude Code runs a hook every time its event occurs. The hooks guide even has an example that blocks edits to protected files like dot env. Hooks are coming up later in week three.
> And no skill replaces review. The skill lowers the number of mistakes. The built-in security review, your tests, and a human reviewer catch the rest.

**Visual / B-roll:**
- Flow: Laravel task → paths match → SKILL.md → Rules → Tests and summary.
- Monitor + Illustration: typed prompts only.
- Four numbered: Prompts · Skill on · Skill off · Compare.
- Panel: Skill · Hook · Review.

### 12:00–13:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: Laravel's defaults are safe. The skill keeps Claude from stepping around them.

*Cue: recap slide*
> Recap. A Laravel security skill is reference content, shared as a project skill, and paths loads it only for P H P files under app, routes, and views. Its rules come from the Laravel docs: validate input and pass only validated data, bind every query and never let users pick columns, escape output, authorize every action, protect forms and logins, and keep secrets and debug mode out of reach. A checklist mapped to the O W A S P Top Ten supports reviews. Test it with tempting prompts and a baseline, put must-hold rules in a hook, and keep the built-in security review in your process.

*Cue: next-episode slide*
> Next in the playlist is episode nineteen: database skills, and writing your own. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 19 · Database Skills and Writing Your Own".

---

## Example files (written for the course)

Both files are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. Real Laravel code uses `->` and `=>`, and Blade views contain HTML tags; the files avoid them by naming methods in plain words (for example "create, update, and fill"), using `Facade::method` forms such as `Gate::authorize('update', $order)`, and using Blade's `{{ }}`, `{!! !!}` and `@csrf`, none of which contain angle brackets. If you add code examples later, keep a description-safe copy in plain words, or link to the repository instead of pasting.

### `.claude/skills/laravel-security/SKILL.md`

```markdown
---
name: laravel-security
description: Security rules for Laravel code in this project, from the official Laravel docs. Use when writing, editing, or reviewing controllers, routes, models, form requests, queries, or Blade views.
when_to_use: Adding a route or form, handling user input, writing a database query, rendering user content, adding a login flow, or reviewing a pull request that touches Laravel code.
paths:
  - "app/**/*.php"
  - "routes/**/*.php"
  - "resources/views/**/*.php"
---

Apply these rules to all Laravel code in this task. Treat every request field, header, and uploaded file as untrusted.

## Input and queries
- Validate every request with validation rules or a form request before using its data.
- Pass only validated data to create, update, and fill. Never pass all request input.
- Declare mass assignable attributes with Fillable. Never make a model Unguarded.
- Use the query builder or Eloquent with bindings. Never put user input into raw expressions such as DB::raw, whereRaw, or orderByRaw. If raw SQL is needed, use ? bindings.
- Never let user input choose a column name, including order by columns. Map it against an allow list.

## Output
- Echo data in Blade with {{ }}, which escapes it.
- Never use {!! !!} for content a user supplied.

## Access
- Authorize every action that reads or changes a resource with a policy or gate, for example Gate::authorize('update', $order). Being logged in is not authorization.
- Include @csrf in every POST, PUT, PATCH, or DELETE form. Do not exclude routes from CSRF protection without asking.
- Rate limit login, password reset, and other sensitive routes with the throttle middleware.

## Secrets and configuration
- Never commit .env. Never hard-code keys, passwords, or tokens.
- Keep APP_DEBUG false in production.
- Hash passwords with the Hash facade. Never store or log passwords or tokens in plain text.

## Checks
- Run the test suite after every change, and report the result.
- In your summary, list every security-relevant change: new routes, new queries, changed authorization.

For a review checklist mapped to the OWASP Top 10, see [checklist.md](checklist.md).
```

### `.claude/skills/laravel-security/checklist.md`

```markdown
# Laravel security review checklist

Use this when asked to review code. For each finding, give the file, the line, the rule it breaks, and a suggested fix.

## Broken access control (OWASP A01:2025)
- Does every route that reads or changes a record authorize the current user with a policy or gate?
- Can a user change an id in the URL and reach someone else's order?
- Does every POST, PUT, PATCH, or DELETE form include @csrf?

## Security misconfiguration (OWASP A02:2025)
- Is APP_DEBUG false for production?
- Is .env in .gitignore and absent from the commit?

## Injection (OWASP A05:2025)
- Is any raw expression built from request input?
- Is any column or sort field taken from the request without an allow list?
- Does any view echo user content with {!! !!}?

## Authentication failures (OWASP A07:2025)
- Are login and password reset routes rate limited?
- Are passwords hashed with the Hash facade, and never stored, logged, or returned in plain text?

## Mass assignment
- Does every create, update, or fill call receive validated data only?
- Is any model marked Unguarded?
```

Folder:
```text
.claude/skills/laravel-security/
├── SKILL.md
└── checklist.md
```

What you type (no output shown):
```text
add an endpoint that updates an order's shipping address
/laravel-security app/Http/Controllers/OrderController.php
/security-review
```

---

## Production notes
- Spoken word count is about 1,900 words, roughly 13 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. The skill and checklist.md are written for the course; the order controller (`app/Http/Controllers/OrderController.php`) is an illustrative example. No Claude output is shown.
- The agenda says three parts and the script has three parts (three dividers).
- Laravel version: facts checked against the Laravel 13.x docs. `Fillable` and `Unguarded` are the attribute names those docs use; older versions use the `$fillable` and `$guarded` properties, so the skill's wording still reads correctly for them.
- Claude Code facts: skills page (reference content runs inline; `description`, `when_to_use`, `paths`; standing instructions because the file isn't re-read; supporting files; arguments with no placeholder appended as `ARGUMENTS: <value>`; a project skill with the same name as a built-in command replaces it in a local terminal session; review `allowed-tools` of repository skills before running Claude Code there; baseline testing with `skillOverrides` "off"; must-hold rules go in a hook). Commands reference: `/security-review` analyzes the changes on your branch for security vulnerabilities (injection, auth issues, data exposure). Hooks guide: "Block edits to protected files" example (`.env`).
- Laravel facts (laravel.com/docs): Blade `{{ }}` uses htmlspecialchars to prevent XSS; `{!! !!}` is unescaped, "Be very careful when echoing content that is supplied by users" (/blade). Query builder uses PDO parameter binding against SQL injection; raw statements are injected as strings and Laravel can't guarantee raw-expression queries are protected; PDO doesn't bind column names, so never let user input dictate column names including order by (/queries). Mass assignment vulnerability, `is_admin` example, Fillable/Guarded required for create, Unguarded means hand-crafting arrays (/eloquent). Validated data via `validated()` / `safe()` (/validation). Gates and policies are the two primary ways to authorize actions; `Gate::authorize` (/authorization). CSRF token per session, `@csrf` on POST/PUT/PATCH/DELETE forms (/csrf). Throttle middleware for route rate limiting (/routing). `.env` should not be committed (security risk); APP_DEBUG always false in production (/configuration). Hash facade provides Bcrypt and Argon2 (/hashing).
- OWASP Top 10:2025 (owasp.org/Top10/2025): A01 Broken Access Control, A02 Security Misconfiguration, A05 Injection (includes XSS), A07 Authentication Failures.
- Hooks come later in Week 3 per youtube-plan.md.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. A Laravel Security Skill for Claude Code (from the Laravel docs) | Agentic Engineering Ep 18
2. Stop Claude Code Skipping Laravel's Security Defaults: a Reference Skill | Ep 18
3. Claude Code Skills for Laravel: Validation, Bindings, Policies and CSRF | Agentic Engineering Ep 18

### Description
```
Episode 18 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we write a Laravel security skill: a reference skill that Claude applies whenever it works on Laravel code. We cover why a secure-by-default framework still needs one (raw expressions, unescaped Blade, unguarded models), how it differs from the built-in /security-review command, limiting it to PHP files with paths, four rule groups from the Laravel docs (validated input and bound queries, escaped output, authorization, CSRF and rate limiting, secrets and APP_DEBUG), a review checklist mapped to the OWASP Top 10:2025, testing it with tempting prompts and a baseline, and why must-hold rules belong in a hook.

Note: screens are drawn illustrations. The skill is written for the course; the rules come from laravel.com/docs and the checklist headings from the OWASP Top 10:2025.

Full text of the skill:

[paste SKILL.md and checklist.md from the script here; neither contains angle brackets]

Next in the playlist: Episode 19 · Database Skills and Writing Your Own.
```

### Tags
Claude Code, Claude Code skills, SKILL.md, Laravel, Laravel security, OWASP Top 10, SQL injection, CSRF, mass assignment, Laravel policies, AI coding agents, agentic engineering

### Thumbnail text idea
"SECURE LARAVEL" in coral, with a small shield icon and "SKILL.md".

---

## Suggested slide list (Episode 18 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 18 · A Laravel Security Skill |
| 2 | Agenda | Three parts: Why a skill · Write it · Use and test it |
| 3 | 01 · Why security needs a skill | Divider |
| 4 | Secure by default | Blade escapes · Bindings · Guarded models |
| 5 | Three escape hatches | Raw SQL · Unescaped Blade · Unguarded |
| 6 | Skill or review? | /security-review vs laravel-security |
| 7 | Four rule groups | Input and queries · Output · Access · Secrets |
| 8 | 02 · Writing the skill | Divider |
| 9 | A project skill | Folder tree (Illustration) |
| 10 | The frontmatter | description · when_to_use · paths (Illustration) |
| 11 | Input and queries | Skill section (Illustration) |
| 12 | Output and access | Skill sections (Illustration) |
| 13 | Secrets and checks | Skill sections (Illustration) |
| 14 | checklist.md | Broken access control entry (Illustration) |
| 15 | 03 · Using and testing it | Divider |
| 16 | How it gets used | Laravel task → paths match → SKILL.md → Rules → Tests |
| 17 | Or ask for a review | Typed prompts only (Illustration) |
| 18 | Test it | Prompts · Skill on · Skill off · Compare |
| 19 | Guidance, not a guarantee | Skill · Hook · Review |
| 20 | Quote | Defaults are safe; the skill keeps Claude from stepping around them |
| 21 | Recap | Reference · paths · Laravel rules |
| 22 | Next | Episode 19 · Database Skills and Writing Your Own |

---

## Sources
- Skills: https://code.claude.com/docs/en/skills (types of skill content; frontmatter reference; add supporting files; pass arguments; skill content lifecycle; pre-approve tools for a skill; resolve skills that share a name; evaluate and iterate; troubleshooting).
- Commands: https://code.claude.com/docs/en/commands (`/security-review`). Hooks guide: https://code.claude.com/docs/en/hooks-guide (block edits to protected files).
- Laravel: https://laravel.com/docs/blade · /queries · /eloquent · /validation · /authorization · /csrf · /routing · /configuration · /hashing
- OWASP Top 10:2025: https://owasp.org/Top10/2025/
- Episode 17: /workspace/agentic-course/day18-ep17-script.md.
