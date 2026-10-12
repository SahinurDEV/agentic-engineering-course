# Episode 29: edits and excerpts

Changes to existing files, and summarised versions of longer files, as shown in this episode (copied from the episode script). The full files are in this folder where available and in [capstone/support-desk](../../capstone/support-desk) for the final app.

## Added to `.github/workflows/tests.yml`, under the `ci` job after `runs-on` (the rest is the kit's file, unchanged)

```yaml
    services:
      postgres:
        image: postgres
        env:
          POSTGRES_PASSWORD: postgres
          POSTGRES_DB: support_desk_test
        options: --health-cmd pg_isready --health-interval 10s --health-timeout 5s --health-retries 5
        ports:
          - 5432:5432
    env:
      DB_CONNECTION: pgsql
      DB_HOST: 127.0.0.1
      DB_PORT: 5432
      DB_DATABASE: support_desk_test
      DB_USERNAME: postgres
      DB_PASSWORD: postgres
```

