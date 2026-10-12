# Episode 32: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts (typed into Claude Code)

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

## Commands (typed in the terminal)

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

