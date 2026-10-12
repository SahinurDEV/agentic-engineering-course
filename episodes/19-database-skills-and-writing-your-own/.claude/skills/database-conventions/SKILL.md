---
name: database-conventions
description: Database conventions for this Laravel project, from the Laravel and PostgreSQL docs. Use when writing or reviewing migrations, models, relationships, or database queries.
when_to_use: Adding or changing a table, column, index, or foreign key, writing a migration, adding a relationship, or fixing a slow query.
paths:
  - "database/migrations/**/*.php"
  - "app/Models/**/*.php"
---

Apply these rules to all database work in this task.

## Schema changes
- Change the schema only through migrations made with php artisan make:migration. Never change a table by hand.
- Give every up method a down method that reverses it.
- Never edit a migration that has run anywhere except your own machine. Add a new migration instead.
- Add foreign key constraints for relationships.

## Queries
- Eager load relationships used in a loop, to avoid N + 1 queries.
- Wrap writes that must succeed or fail together in DB::transaction.
- Add an index only where a query needs it. Indexes add overhead to every write.
- On PostgreSQL, ask me before adding an index to a large production table. A standard index build locks out writes; CREATE INDEX CONCURRENTLY does not.
- Use bindings for every value. Follow the laravel-security skill for raw SQL.

## Safety
- Never run migrate:fresh, migrate:refresh, migrate:reset, or db:wipe, and never add --force, without asking me first.
- Before running new migrations, show the SQL with php artisan migrate --pretend.

## Checks
- Run the test suite after every schema change, and report the result.
