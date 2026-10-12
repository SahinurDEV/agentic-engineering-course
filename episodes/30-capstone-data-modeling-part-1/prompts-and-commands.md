# Episode 30: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts (typed into Claude Code)

```text
/opsx:explore Data model for roles, categories and tickets in docs/requirements.md. Read the users migration and the User model first. Ask me one question at a time about storing status, priority and role, deletes, and the first admin.

/opsx:propose add-core-data-model: roles, categories and tickets as decided. Data layer only: migrations, enums, models, factories, admin seeder, tests. No screens, policies, replies or indexes. Task group 1 is the three migrations; I create them with /new-migration.

/new-migration add role to users: customer, agent or admin, default customer. List values literally.

/new-migration create categories: unique name, nullable archived_at, timestamps

/new-migration create tickets: subject, description, category (restrict on delete), status open, pending, resolved or closed (default open), priority low, normal, high or urgent (default normal), customer (cascade), nullable assignee (null on delete), timestamps. List values literally.

/clear, then /opsx:apply add-core-data-model
Use the code-reviewer subagent to review this change.
/opsx:archive add-core-data-model
```

## Commands (typed in the terminal)

```text
git switch -c add-core-data-model
openspec validate add-core-data-model --strict
git add openspec && git commit -m "Plan: add-core-data-model"
php artisan migrate
php artisan migrate:rollback --step=3
php artisan migrate
php artisan test
php artisan db:seed --class=AdminSeeder
git add -A && git commit -m "Add roles, categories and tickets"
git push -u origin add-core-data-model
gh pr create --fill
```

