# Episode 33: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts (typed into Claude Code)

```text
/opsx:explore R2, R3, R4, R5 and R7 in docs/requirements.md, plus Q1, Q4 and Q5. Read routes/web.php, the Ticket model, openspec/specs and one settings page of the starter kit first. Ask me one question at a time about who may do what, what a customer may see, the inbox filters, and how the pages are laid out.

/opsx:propose add-core-ticket-features: the screens as decided. A TicketPolicy, controllers, form requests, routes with the can middleware, four Inertia React pages, sidebar links by role, Pest tests for every scenario. No search, notes, assignment, status changes or R10 rules; those are Episode 34.

/clear, then /opsx:apply add-core-ticket-features

Use Playwright MCP at 390 by 844. Sign in as the customer, open a ticket, reply to it. Then sign in as the agent and try each inbox filter and the next page. Tell me any page that scrolls sideways or shows a console error.

Use the code-reviewer subagent to review this change against the laravel-security and react-best-practices skills.

/opsx:archive add-core-ticket-features
```

## Commands (typed in the terminal)

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

