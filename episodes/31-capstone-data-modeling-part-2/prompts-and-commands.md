# Episode 31: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts (typed into Claude Code)

```text
/opsx:explore Replies and internal notes (R7, R8) in docs/requirements.md. Read the tickets migration and the Ticket model first. Ask me one question at a time about one table or two, authors, deletes, and order.

/opsx:propose add-ticket-conversation: replies and internal notes as decided. Data layer only: migrations, models, factories, Ticket helpers, tests. No policies, screens, R10 rules or indexes. Task group 1 is the two migrations; I create them with /new-migration.

/new-migration create replies: ticket (cascade on delete), nullable author on users (null on delete), body text, timestamps

/new-migration create internal_notes: the same columns as replies

/clear, then /opsx:apply add-ticket-conversation
Use the code-reviewer subagent to review this change.
/opsx:archive add-ticket-conversation
```

## Commands (typed in the terminal)

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

