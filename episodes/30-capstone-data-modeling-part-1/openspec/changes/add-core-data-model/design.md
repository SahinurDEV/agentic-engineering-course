## Decisions
- Status, priority and role are enum columns, so PostgreSQL checks the values, plus PHP backed enums cast on the models. Alternative: plain strings, checked only in PHP.
- Migrations list the values literally and never import app enums, so an old migration means the same thing forever.
- Role is not fillable, so a request can never set it. Defaults live in the database and in the model.
- Foreign keys: customer cascades (the kit lets users delete their account), assignee becomes null, category restricts (categories are archived).
- The first admin comes from an interactive seeder that reuses the kit's sign-up validation. No password in the repo.

## Risks / Trade-offs
- Adding a status later needs a migration → acceptable, the values are fixed by R10.
- No indexes yet → added with the inbox queries in Episode 32.
