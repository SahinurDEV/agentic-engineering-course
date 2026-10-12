# Field notes checklist (Agentic Engineering)

## Before you build
- Write the requirements down, numbered, with a line that says what done means.
- List the open questions. Decide each one before the code that depends on it, and write the decision next to the requirements.
- Explore first, then propose. Review the plan in order: proposal, spec, design, tasks.

## While you build
- Put each rule where it cannot be skipped: a policy on the route, a rule in the form request, a method on the model, a constraint in the database.
- Never edit generated files. Generate them again.
- One heavy job at a time. Stop every dev server when you are done.
- One worktree per separate task, each with its own dependencies, env file and test database.

## Before you call it done
- Make every new test fail once on purpose, then put the code back.
- Check the real thing: open it in a browser at phone width and look.
- Run the same checks CI runs: format, lint, types, tests.
- Archive the spec, get the pull request reviewed, merge.
- Say plainly what you ran and what you only described.
