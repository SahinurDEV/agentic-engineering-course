---
name: new-migration
description: Create a Laravel migration for a schema change and show its SQL without running it.
disable-model-invocation: true
argument-hint: "[change]"
allowed-tools: Bash(php artisan make:migration *) Bash(php artisan migrate --pretend)
---

Create a migration for this change: $ARGUMENTS

1. Read the related models and the latest migrations for the table.
2. Run php artisan make:migration with a descriptive snake_case name.
3. Write the up method, and a down method that reverses it. Follow the database-conventions skill.
4. Run php artisan migrate --pretend and show me the SQL.
5. Stop. Do not run the migration. I run it myself after reading the SQL.
