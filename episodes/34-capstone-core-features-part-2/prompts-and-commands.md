# Episode 34: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts (typed into Claude Code)

```text
/opsx:explore R6, R8, R9, R10, R11 and R12 in docs/requirements.md, and the three open gaps from Episode 28: does search include internal notes, can the last admin remove their own admin role, can a customer change a ticket's category. Can the work split into two parts that run side by side? Read the requirements, openspec/specs, TicketPolicy and the routes first. Ask me one question at a time.

/opsx:propose add-ticket-work: search (subjects and public replies, never notes), internal notes for agents, assignment, status and priority on one PATCH route, the R10 reply rules with exactly six cases, and the activity list on the ticket page. Pest tests for every scenario, one per R10 case. No admin area.

/opsx:propose add-admin-area: admins create, rename and archive categories, and set user roles. Archived categories cannot be picked for new tickets. The last admin keeps the admin role (D2), checked in a locked transaction. Pest tests for every scenario.

/clear, then /opsx:apply add-ticket-work (in the main checkout) and /opsx:apply add-admin-area (in ../support-desk-admin)

Use Playwright MCP at 390 by 844. As the agent: search the inbox, open a ticket, add a note, close it. As the customer: open that ticket. As the admin: create and archive a category, then try to remove your own admin role. Tell me any page that scrolls sideways or shows a console error.

Use the code-reviewer subagent to review each change against the laravel-security and react-best-practices skills.

/opsx:archive add-ticket-work, then /opsx:archive add-admin-area
```

## Commands (typed in the terminal)

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

