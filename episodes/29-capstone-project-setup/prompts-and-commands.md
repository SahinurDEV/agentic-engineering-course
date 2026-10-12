# Episode 29: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Edits to kit files

```text
.gitignore: remove /.claude, /CLAUDE.md, /.mcp.json; add /.claude/settings.local.json, /CLAUDE.local.md, /playwright-output
.env (never committed): DB_USERNAME=support_desk, DB_PASSWORD=your local password
.env.example: DB_USERNAME=support_desk
phpunit.xml: DB_CONNECTION pgsql (was sqlite), DB_DATABASE support_desk_test (was :memory:)
vite.config.ts fmt ignorePatterns, add: '.claude/**', '.mcp.json', 'CLAUDE.md', 'docs/**', 'openspec/**'
React skill: paths "resources/js/**/*.tsx" and "resources/js/**/*.ts"; checks run npm run check and php artisan test
format.sh: the Prettier line becomes  *.js|*.jsx|*.ts|*.tsx|*.css) npx vp fmt "$FILE_PATH" ;;
```

## Exact lines in `.claude/skills/react-best-practices/SKILL.md` after the edit

```text
paths:
  - "resources/js/**/*.tsx"
  - "resources/js/**/*.ts"
- Run npm run check and php artisan test after every change, and report the result.
```

## Commands

```text
laravel new support-desk --react --database=pgsql --pest --npm --no-boost
cd support-desk
psql -U postgres
CREATE ROLE support_desk LOGIN PASSWORD 'your-local-password';
CREATE DATABASE support_desk OWNER support_desk;
CREATE DATABASE support_desk_test OWNER support_desk;
rm database/database.sqlite
php artisan migrate
php artisan test
php artisan test tests/Feature/Auth
composer run dev
claude mcp add --scope project playwright -- npx -y @playwright/mcp@latest --isolated --viewport-size 1280x720 --output-dir playwright-output
openspec init --tools claude
composer ci:check
git init -b main
git add -A
git status
git commit -m "Set up Support Desk"
gh repo create support-desk --private --source=. --push
claude, then /install-github-app
```

## R1 browser check prompt

```text
Use playwright to open http://localhost:8000/register. Register a test customer, sign out, and sign in again. Then open the forgot password page and request a reset link. Use snapshots to read the page, and report any console errors.
```

