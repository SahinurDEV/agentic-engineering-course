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
