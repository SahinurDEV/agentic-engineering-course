# Episode 27: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts, one per workspace or worktree (written for the course)

```text
Add a short Shipping section to README.md: shipping is 4.99 for carts under 40.00 after discounts, and free from 40.00. Match specs/shipping/spec.md. Change no other file.
```

## Snippet

```text
Change .github/workflows/test.yml to run the tests on Node 22 and Node 24 using a matrix. Change no other file. Then run npm test.
```

## Commands (typed; no output shown)

```text
gh auth status
claude /login

claude
claude --worktree readme-shipping
claude --worktree ci-node-matrix

git worktree add ../cart-readme -b readme-shipping
cd ../cart-readme
npm install
claude
git worktree list
git worktree remove ../cart-readme
```

## Add this line to `.gitignore` when you use `claude --worktree`

```text
.claude/worktrees/
```

