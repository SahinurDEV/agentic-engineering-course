# Capstone: Support Desk

The app built in Episodes 28 to 34 of Agentic Engineering: a customer support ticket desk on **Laravel 13**, the **React** starter kit (Inertia, React 19, TypeScript, shadcn/ui) and **PostgreSQL**, with Pest tests and OpenSpec.

- Source: [`support-desk/`](support-desk)
- Requirements (R1 to R12, decisions D1 to D3): [`support-desk/docs/requirements.md`](support-desk/docs/requirements.md)
- Current specs: [`support-desk/openspec/specs/`](support-desk/openspec/specs)
- Archived OpenSpec changes, one per feature: [`support-desk/openspec/changes/archive/`](support-desk/openspec/changes/archive)
- Project instructions for Claude Code: [`support-desk/CLAUDE.md`](support-desk/CLAUDE.md), plus skills, commands and agents in [`support-desk/.claude/`](support-desk/.claude)

## Episodes

| Ep | What happens |
|---|---|
| [28](../episodes/28-capstone-the-project-and-requirements) | The project and its requirements |
| [29](../episodes/29-capstone-project-setup) | Project setup: starter kit, CLAUDE.md, skills, hooks, reviewer, OpenSpec, CI |
| [30](../episodes/30-capstone-data-modeling-part-1) | Data model part 1: roles, categories, tickets |
| [31](../episodes/31-capstone-data-modeling-part-2) | Data model part 2: public replies and internal notes |
| [32](../episodes/32-capstone-data-modeling-part-3) | Data model part 3: change log and indexes, checked with EXPLAIN |
| [33](../episodes/33-capstone-core-features-part-1) | Core features part 1: open a ticket, my tickets, inbox, replies |
| [34](../episodes/34-capstone-core-features-part-2) | Core features part 2: search, notes, assignment, status rules, activity, admin area |

## Run it locally

Requires PHP 8.3+, Composer, Node 22+ and PostgreSQL.

```bash
cd support-desk
cp .env.example .env            # set DB_DATABASE, DB_USERNAME, DB_PASSWORD
createdb support_desk
createdb support_desk_test      # used by the test suite
composer setup                  # composer install, key:generate, migrate, npm install, build
composer run dev                # app at http://localhost:8000
php artisan test                # Pest test suite
```

`vendor/`, `node_modules/`, `.env`, build output, logs and database dumps are not included in this repo.
