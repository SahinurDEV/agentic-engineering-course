# Episode 26: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Issue #12 (written for the course)

```text
Title: Run the tests on every pull request
Body: Add a GitHub Actions workflow that runs npm test for every pull request and every push to main, so a failing test shows up before anyone merges.
```

## Prompt, typed in Claude Code (written for the course)

```text
Read issue 12 with gh issue view 12. Add a workflow at .github/workflows/test.yml that runs npm install and npm test on Node 22, for every pull request and every push to main. Work on a new branch called ci-tests. Commit, push, and open a pull request with gh pr create, with Closes #12 in the body.
```

## Comment on issue #13 (written for the course)

```text
@claude add a short Shipping section to the README. Shipping is 4.99 for carts under 40.00 after discounts, and free from 40.00. Match specs/shipping/spec.md and don't change any code.
```

## Commands (typed; no output shown)

```text
gh auth login
gh auth status
claude
/install-github-app
gh pr checks
/code-review
/code-review 14
/code-review --comment 14
/code-review --fix
/security-review
claude --from-pr 14
```

