# Day 27 · Episode 26: GitHub Integration

**Series:** Agentic Engineering (free YouTube course) · Module 11
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 22:00
**Format:** faceless: slides + drawn terminal, issue and file graphics + AI voiceover, no presenter on screen
**Covers (Module 11 lessons):** Introduction and use cases · Setting up · Example usages

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal, issue or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal, issue, comment or file view is a **drawn graphic** with a coral "Illustration" corner tag. The two workflow files `claude.yml` and `test.yml`, the issue, the comment and the prompts are **written for the course** and printed in full below. The review workflow is **copied from the official Claude Code GitHub Actions docs** and marked as such. No Claude, GitHub, `gh` or CI output is shown.

**Counts drawn on slides (checked against the files and docs):** `claude.yml`: 2 trigger events, 5 job permissions, 2 steps, 2 limits (15 minutes, 10 turns). `test.yml`: 2 trigger events, 1 job, 4 steps. Review workflow (docs): 4 pull request activity types, 4 permissions (3 read, 1 write), 1 allowed tool. Claude GitHub App: 13 permissions in the full set, 3 used by the action. Action checks on who triggers a run: 2. Ways to review: 4. `/install-github-app` steps: 4 done by the command, the merge done by you (5 on the flow slide).

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook |
| 0:25–1:15 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:15–6:45 | [VOICEOVER + SLIDE] | Part 1 · Introduction and use cases |
| 6:45–12:45 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 2 · Setting up |
| 12:45–21:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Example usages |
| 21:00–22:00 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we changed free shipping from fifty to forty with a spec, and archived the record.
> So far, all of that has lived on one laptop. But real teams work in GitHub: issues, pull requests, reviews, and checks. Today, Claude joins them there.

**Visual / B-roll:**
- Episode 25 recap panel, then the title card.

### 0:25–1:15 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-six: GitHub integration.

*Cue: agenda slide "Three parts"*
> Three parts. First, introduction and use cases: the ways Claude Code works with GitHub, and who is allowed to start it. Second, setting up: the G H command line tool, the Claude GitHub app, a secret, and a workflow file. Third, example usages in our cart project: an issue turned into a pull request from the terminal, an at Claude mention inside GitHub, and code review.
> It's an illustrated walkthrough, not a recording. Every file and prompt is printed in full in the description. The ones I wrote for this course are marked, and so is the one copied from the docs.

**Visual / B-roll:**
- Three items: 01 Use cases · 02 Setting up · 03 Example usages.

### 1:15–6:45 · Part 1: Introduction and use cases
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "01 · Use cases"*
> Part one. Introduction and use cases.

*Cue: two columns "Two places"*
> Claude Code meets GitHub in two places.
> The first is your own machine. You run Claude in the terminal, as we have all course, and it talks to GitHub through the G H command line tool. The docs recommend this. Command line tools are the most context-efficient way to reach outside services, and Claude already knows how to use G H to create issues, open pull requests, and read comments. Without it, Claude can still use the GitHub API, but requests without a login often hit rate limits.
> The second place is GitHub itself. Claude Code GitHub Actions runs Claude Code inside your repository's workflows, on GitHub's machines. You mention at Claude in an issue or a pull request, and Claude reads the code, makes changes, and pushes commits, while your laptop stays closed.
> Same Claude, a different machine, and a different person at the keyboard: whoever wrote the comment.

*Cue: squares "Three products, one name"*
> The docs warn that several products share the Claude Code name, so let's keep three of them apart.
> One: G H on your machine. Nothing to install in the repository. You watch every step, as usual.
> Two: the Claude Code GitHub Action, from the claude code action repository. You add workflow files to your repository, and you control the triggers, the prompt, and the tools.
> Three: Code Review. A managed service that reviews pull requests without a workflow file. It's in research preview, for Team and Enterprise plans.
> This episode builds the first two, and points at the third.

*Cue: four numbered "What it's for"*
> What is it for? The docs list a set of cases, and they fit into four.
> Turn an issue into a pull request. Claude reads the issue, writes the change, and pushes a branch.
> Fix a bug from a comment. The docs' own example is, at Claude, fix the type error in the user dashboard component.
> Answer a question about the code, right in the thread, like how should I add authentication to this endpoint.
> And automate. With a prompt in the workflow, Claude can run on any GitHub event, even a schedule, like a daily summary of yesterday's commits and open issues.

*Cue: panel "Two modes"*
> The action has two modes, and it picks one from your workflow file. You don't set a mode yourself.
> Interactive mode is when the workflow gives no prompt. Claude waits for the trigger phrase, at Claude by default. It can be in a comment, in a pull request review, or in the title or body of a new issue. Then it answers that request in a comment on the same issue or pull request.
> Automation mode is when the workflow does give a prompt. Claude runs as soon as the event fires, with no mention needed. By default, its results go to the workflow run log, not to a comment. It posts on the issue or pull request only when the prompt tells it to, and it has a tool that can post.

*Cue: card "Who can start it"*
> Before Claude starts, the action runs two checks on whoever triggered the run. If either check rejects them, the run fails.
> First, write access. On issue and pull request events, the person who triggered it must have write access to the repository. So a stranger who comments at Claude on your public repository doesn't start a run. There's a setting to allow specific users without write access, but the action's security guide calls it a significant risk, for workflows with very limited permissions only.
> Second, a human actor. A bot is rejected unless you list it by name. That stops bots from triggering Claude in a loop.
> Scheduled runs skip the write access check, because no user wrote the event. The bot check still applies to them.

**Visual / B-roll:**
- Two columns: your machine (gh) vs GitHub Actions.
- Squares: gh · the action · Code Review.
- Four numbered: issue to branch · fix · answer · automate.
- Panel: interactive vs automation.
- Card: write access · human actor.

### 6:45–12:45 · Part 2: Setting up
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Setting up"*
> Part two. Setting up.

*Cue: drawn terminal "G H first"*
> Setup starts on your own machine, with the G H command line tool. Install it from cli dot github dot com. Then sign in with G H auth login. G H auth status shows which account is active.
> Two more things before you start. The quick setup works only with repositories on github dot com, not GitLab or Bitbucket. And you need admin access to the repository.
> Then open Claude in the repository, and type slash install GitHub app. Claude Code checks that G H is there, and warns you if it's missing.
> These are typed commands only. No output is shown.

*Cue: flow "What the command does"*
> Then follow the prompts. The command works through the setup in order.
> One. It installs the Claude GitHub app on the repository.
> Two. It saves an authentication secret in the repository.
> Three. It pushes a branch with the workflow files you picked, already set up to use that secret.
> Four. It opens GitHub in your browser, with a pull request ready to create.
> Five is yours. Create that pull request, read it, and merge it. Only then does at Claude work in the repository.
> Press Escape to stop partway. A step already running finishes, no later step starts, and the closing message lists what already happened, like a pushed branch or a saved secret.
> If you don't run Claude locally, or the command fails, the manual path does the same by hand: install the app from github dot com slash apps slash claude, add the secret, and copy the example workflow from the action's repository.

*Cue: two columns "Which secret?"*
> Step two needs a choice: how the runs are paid for.
> Option one, an API key from the Claude Console. It's saved as a repository secret named Anthropic API key, in capitals with underscores, and usage is billed to the API.
> Option two, a long-lived token from your Claude subscription, on Pro, Max, Team or Enterprise. You make one locally with claude setup token, and it's saved as Claude Code O Auth token. Runs then use your subscription.
> The docs add one rule for teams. For a secret shared across a whole organization, use an API key, because a subscription token is tied to the person who made it.
> Whichever you pick, never commit it. It lives in GitHub's secrets. In the repository settings, that's Secrets and variables, then Actions. The workflow only refers to it by name.

*Cue: phone "Permissions"*
> Installing the app means granting permissions, so read them before you click.
> The action itself relies on three, each with read and write access. Contents, to change files. Issues, to answer issues. And pull requests, to work on pull requests and push changes.
> But the app is shared by every Claude feature that touches GitHub, so its full set is thirteen permissions, and GitHub doesn't let you accept only some of them.
> If your organization wants the smallest set, the docs explain how to make your own GitHub app with just those three. That custom app covers the action only. Code Review still needs the official app.

*Cue: plan "When it runs"*
> Now the workflow file. This one is written for the course and printed in full in the description. It's the docs' at Claude example, plus two limits. It lives in the dot github slash workflows folder, in a file called claude dot yml.
> First, when it runs. It listens for two events. A new comment on an issue or a pull request, which GitHub calls issue comment, and fires for pull request comments too. And a new comment on a line of a pull request's code.
> Then an if line. Only start the job when the comment contains at Claude. That keeps a runner from starting on every comment. The action also checks the trigger phrase itself.
> Notice what's missing. This file doesn't listen for new issues. So at Claude in the body of a brand new issue does nothing here. Mention it in a comment instead.
> And if an older guide shows the action at beta, the docs say move to version one.

*Cue: two points "What it does"*
> Second, what it does. The job's token gets five permissions. Write access to contents, pull requests, and issues. I D token write, which the action needs for its default sign-in as the GitHub app. And read access to actions, so Claude can read C I results on pull requests.
> Then two steps. Check out the code, so Claude has a copy to work in. Then run the Claude Code action, version one, with the API key taken from secrets.
> And the two limits I added. Timeout minutes, fifteen, is a GitHub setting that stops a runaway job. And max turns, ten, passed through claude args, caps how many turns Claude takes. Both come straight from the docs' advice on managing cost.

*Cue: squares "Two costs, two caps"*
> Because every run costs two things.
> GitHub Actions minutes, since it runs on GitHub's machines. And tokens, billed to your API key, or drawn from your subscription if you used a subscription token.
> The docs' advice to keep both down: write specific at Claude requests, so Claude needs fewer turns. Use issue templates to give context up front. Keep CLAUDE dot md short, because Claude reads it on every run. And cap the work, with max turns and a job timeout, as we just did.
> CLAUDE dot md matters here for another reason. Claude follows it when it creates pull requests and answers requests, so the project rules from earlier episodes apply in GitHub too.

**Visual / B-roll:**
- Monitor + Illustration: typed commands only.
- Flow: App · Secret · Branch · PR · Merge.
- Two columns: API key vs subscription token.
- Phone + Illustration: 3 used, 13 in the full set.
- Plan + Illustration: claude.yml part 1 (events, if line).
- Two points + Illustration: claude.yml part 2 (permissions, steps, limits).
- Squares: Minutes · Tokens · Caps.

### 12:45–21:00 · Part 3: Example usages
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Example usages"*
> Part three. Example usages, in the cart project.

*Cue: phone "Issue twelve"*
> First example, all from your terminal. The cart has tests, but nothing runs them on GitHub. So here's issue twelve, written for the course: run the tests on every pull request.
> Its body says what done looks like. A workflow that runs N P M test for every pull request and every push to main, so a failing test shows up before anyone merges.

*Cue: drawn terminal "The prompt"*
> Here's the prompt, typed in Claude Code. It's written for the course, and it's in full in the description.
> Read issue twelve with G H issue view. Add a workflow at dot github slash workflows slash test dot yml that runs N P M install and N P M test on Node twenty-two, for every pull request and every push to main. Work on a new branch called C I tests. Commit, push, and open a pull request with G H P R create, and put closes, number twelve, in the body.
> That last part matters. The GitHub docs say a keyword like closes, followed by the issue number, closes the issue when the pull request is merged into the default branch.
> Claude's reply isn't shown. Read the commands it wants to run before you approve them, as in any session.

*Cue: plan "The test workflow"*
> And here's the file we expect, written for the course and checked against the GitHub docs. Its name is Tests.
> It runs on pull requests, and on pushes to the main branch. With no activity types listed, GitHub runs a pull request workflow when the pull request is opened, reopened, or gets a new push.
> One job, on Ubuntu, with four steps. Check out the code. Set up Node twenty-two. N P M install. And N P M test.
> The install step works whether or not the cart has dependencies, so the file doesn't depend on details I haven't shown you.

*Cue: card "What a green check proves"*
> Now be careful about what this check proves, because it's easy to claim too much.
> A green check means one thing. N P M test finished with success, for that commit, on a fresh GitHub machine. That's useful. It catches a test that only passes on your laptop.
> It doesn't prove the tests are good. If no test covers a case, the check stays green while that case is broken. It doesn't look at the page in a browser. That's still our Playwright step from episode twenty-two. And it can't tell you whether the change is the right change. That's what review is for.
> One more subtle point. The pull request that adds this file changes no cart code at all. So a green check on that pull request shows the workflow runs and today's tests pass. It doesn't show that anything got better.

*Cue: flow "The local loop"*
> With the pull request open, the rest of the loop runs through G H too.
> G H P R checks shows the C I status for the pull request of the current branch. Ask Claude to check it and read the result.
> Then review. Slash code review, which we'll look at in a minute.
> If something needs work, Claude fixes it on the same branch and pushes again, and that new push runs the tests again.
> And the merge is yours.
> Claude Code also links the session to the pull request it created with G H P R create. So later, claude dash dash from P R, with the pull request number, finds that session again.

*Cue: two points "At Claude on an issue"*
> Second example, this time inside GitHub, after the claude dot yml pull request is merged. Issue thirteen asks for a shipping section in the README.
> You comment on the issue, starting with at Claude. The comment event fires, the if line sees at Claude, and the job starts. Then the action checks that you have write access, and that you're not a bot.
> Claude replies in a comment and updates it as it works. On an issue, it creates a new branch and commits there. By default it does not open the pull request itself. It posts a link to a pre-filled pull request page, and you create the pull request from that link. That keeps a person in control, and your branch protection rules still apply.

*Cue: phone "The comment"*
> Here's the comment, written for the course.
> At Claude, add a short Shipping section to the README. Shipping is four ninety-nine for carts under forty after discounts, and free from forty. Match specs slash shipping slash spec dot md, and don't change any code.
> Notice it points at the shipping spec from episodes twenty-four and twenty-five, so Claude has one source of truth. And a specific request needs fewer turns, which saves both kinds of cost.

*Cue: panel "Will the tests run?"*
> Now a classic trap. When you create that pull request, the tests run, because you opened it.
> But what about Claude's later pushes? Say you comment on the pull request and ask for a fix. On an open pull request, Claude pushes to that pull request's branch, and that push should run the tests again.
> With the default setup, it does, because the action signs in as the Claude GitHub app. But if you pass GitHub's built-in token, the one called GitHub token, to the action, there's a catch. GitHub doesn't start new workflow runs from events that token causes. That's a GitHub rule to prevent loops. Claude's pushes would then never be tested.
> The docs' fix: remove that token line from the action step, or pass your own app token instead.

*Cue: four numbered "Four ways to review"*
> Now reviews. There are four ways, from lightest to most managed.
> One. Slash code review in your terminal, with no GitHub app at all.
> Two. The same command with dash dash comment, which posts the findings on a GitHub pull request as inline comments.
> Three. A review workflow in GitHub Actions. The quick setup offers one, and the docs print one you can copy.
> Four. Code Review, the managed service, in research preview for Team and Enterprise. Its findings don't approve or block a pull request, so your existing review rules stay in charge.

*Cue: drawn terminal "Review commands"*
> Here are the review commands, typed in Claude Code. Again, no output is shown.
> Slash code review, with nothing after it, reviews your branch's commits ahead of its upstream, plus any uncommitted changes. So it needs work on the branch to have anything to report. It reports correctness bugs, and it runs as a background agent with its own context, so it doesn't fill your conversation.
> Pass a pull request number to review that pull request instead. Say our first pull request is number fourteen. Slash code review fourteen reviews it. Add dash dash comment to post the findings on it. Or use dash dash fix to apply the findings to your working tree.
> Slash review is an alias of the same command. And slash security review checks your branch's changes against the default branch on origin, for risks like injection, auth problems, and data exposure.

*Cue: squares "The review workflow"*
> The review workflow from the docs is worth reading line by line. It's in the description, marked as copied from the docs.
> It runs on four pull request activity types: opened, synchronize, which means a new push, ready for review, and reopened. Its permissions are read only, plus I D token write.
> It installs the code review plugin and runs its skill with dash dash comment, so the review lands on the pull request, as inline comments, or one summary comment when it finds nothing. Without that flag, Claude posts nothing, and the findings stay in the run log.
> The claude args line allows one tool, the one that posts inline comments. Keep it, because the action only starts that tool's server when claude args names it.
> Claude skips drafts, closed pull requests, ones it judges don't need a review, and ones it has already commented on. And on public repositories, GitHub withholds secrets from pull requests opened from forks, so this review runs only on branches in the same repository.

*Cue: two columns "Stay safe"*
> Last, safety. Claude now acts on text that other people write, so treat issues and comments as untrusted input.
> The action's security guide warns about hidden instructions in markdown: comments, invisible characters, hidden attributes. The action strips the known tricks, but new ones may appear. So read an issue before you tag Claude on it, especially on a public repository.
> On the do side. Keep keys in GitHub secrets. Give each workflow only the permissions it needs. And review Claude's changes before you merge.
> On the don't side. Don't commit keys. Don't open triggering to everyone. And don't tag Claude on content you haven't read.
> Claude in the action pushes commits, but it doesn't merge, rebase, or force push. That's by design.

*Cue: quote slide*
> The line to remember: Claude pushes the branch. A human merges.

*Cue: recap slide*
> Recap. Claude Code works with GitHub in two places: on your machine through G H, and in GitHub Actions through the Claude Code action. Slash install GitHub app sets up the app, the secret, and a workflow pull request, and nothing runs until you merge it. Only people with write access can trigger a run. Cap the cost with max turns and a timeout. A green check means the tests passed, not that the change is right. And a human reviews and merges every pull request.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-seven: parallel development with Conductor. It starts module twelve. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Phone + Illustration: issue #12 (written for the course).
- Monitor + Illustration: the local prompt as typed.
- Plan + Illustration: test.yml.
- Card: what a green check proves, and what it doesn't.
- Flow: Open · Checks · Review · Fix · Merge.
- Two points + Illustration: @claude on issue #13.
- Phone + Illustration: the comment (written for the course).
- Panel: will the tests run?
- Four numbered: Local · Posted · Workflow · Managed.
- Monitor + Illustration: review commands as typed.
- Squares: 4 events · --comment · 1 tool.
- Two columns: do vs don't.
- Quote card, recap card, next-episode card "Episode 27 · Parallel Development with Conductor".

---

## Example files

All blocks are free of `<` and `>` characters. Prices, issue and pull request numbers are illustrative. Action versions are the ones the Claude Code docs use at the time of writing (`actions/checkout@v6`, `anthropics/claude-code-action@v1`); newer major versions of `actions/checkout` and `actions/setup-node` may exist.

### Issue #12 (written for the course)

```text
Title: Run the tests on every pull request
Body: Add a GitHub Actions workflow that runs npm test for every pull request and every push to main, so a failing test shows up before anyone merges.
```

### Prompt, typed in Claude Code (written for the course)

```text
Read issue 12 with gh issue view 12. Add a workflow at .github/workflows/test.yml that runs npm install and npm test on Node 22, for every pull request and every push to main. Work on a new branch called ci-tests. Commit, push, and open a pull request with gh pr create, with Closes #12 in the body.
```

### Comment on issue #13 (written for the course)

```text
@claude add a short Shipping section to the README. Shipping is 4.99 for carts under 40.00 after discounts, and free from 40.00. Match specs/shipping/spec.md and don't change any code.
```

### Commands (typed; no output shown)

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

### `.github/workflows/claude.yml` (written for the course, based on the docs' @claude example)

```yaml
name: Claude Code
on:
  issue_comment:
    types: [created]
  pull_request_review_comment:
    types: [created]
jobs:
  claude:
    if: contains(github.event.comment.body, '@claude')
    runs-on: ubuntu-latest
    timeout-minutes: 15
    permissions:
      contents: write
      pull-requests: write
      issues: write
      id-token: write
      actions: read
    steps:
      - uses: actions/checkout@v6
        with:
          fetch-depth: 1
      - uses: anthropics/claude-code-action@v1
        with:
          anthropic_api_key: ${{ secrets.ANTHROPIC_API_KEY }}
          claude_args: "--max-turns 10"
```

If you authenticate with a subscription token, replace the `anthropic_api_key` line with `claude_code_oauth_token: ${{ secrets.CLAUDE_CODE_OAUTH_TOKEN }}` (from the docs).

### `.github/workflows/test.yml` (written for the course)

```yaml
name: Tests
on:
  pull_request:
  push:
    branches: [main]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v6
      - uses: actions/setup-node@v6
        with:
          node-version: 22
      - run: npm install
      - run: npm test
```

### `.github/workflows/claude-code-review.yml` (copied from the official Claude Code GitHub Actions docs, "Run a skill")

```yaml
name: Code Review
on:
  pull_request:
    types: [opened, synchronize, ready_for_review, reopened]
jobs:
  review:
    runs-on: ubuntu-latest
    permissions:
      contents: read
      pull-requests: read
      issues: read
      id-token: write
    steps:
      - uses: actions/checkout@v6
        with:
          fetch-depth: 1
      - uses: anthropics/claude-code-action@v1
        with:
          anthropic_api_key: ${{ secrets.ANTHROPIC_API_KEY }}
          plugin_marketplaces: "https://github.com/anthropics/claude-code.git"
          plugins: "code-review@claude-code-plugins"
          prompt: "/code-review:code-review --comment ${{ github.repository }}/pull/${{ github.event.pull_request.number }}"
          claude_args: '--allowedTools "mcp__github_inline_comment__create_inline_comment"'
```

---

## Production notes
- Spoken word count: see report (about 3,251 words, roughly 22.4 minutes at a steady TTS pace, plus slide pauses; plan target about 22).
- Illustrated walkthrough, not a recording. No Claude, GitHub, `gh`, CI or review output is shown. Issue and comment views are drawn graphics of course-written text.
- The agenda says three parts and the script has three parts (three dividers), matching the plan's three Module 11 lessons.
- Spoken episode numbers: "episode twenty-six" (this one), "episode twenty-two", "episodes twenty-four and twenty-five", "episode twenty-seven" (next), "module twelve".
- Counts (verified by counting the files above and the docs): `claude.yml` 2 events (`issue_comment`, `pull_request_review_comment`), 5 permissions, 2 steps, 2 limits; `test.yml` 2 events (`pull_request`, `push` to main), 1 job, 4 steps (checkout, setup-node, npm install, npm test); review workflow 4 activity types, 4 permissions (contents, pull-requests and issues read; id-token write), 1 tool in `--allowedTools`; GitHub App permission table has 13 rows, the action relies on 3 (Contents, Issues, Pull requests, read and write).
- Logic of the checks (stated carefully in the narration): a green `test.yml` check means `npm test` exited successfully for that commit on a GitHub-hosted runner; it says nothing about cases no test covers, the page in a browser, or whether the change is right. The pull request that adds `test.yml` changes no cart code, so its green check only shows the workflow runs and the existing tests pass. `test.yml` does not run on the push of the `ci-tests` branch (push trigger is main only); it runs when the pull request is opened, reopened, or gets a new push (GitHub's default `pull_request` types: opened, synchronize, reopened). `claude.yml` does not react to `@claude` in a new issue's body because it has no `issues` trigger. If `github_token: ${{ secrets.GITHUB_TOKEN }}` were passed to the action, Claude's pushes would not start new workflow runs (GitHub rule; Claude Code docs troubleshooting); with the default GitHub App sign-in they do. The pull request you create from Claude's link runs the tests because you opened it.
- Claude Code GitHub Actions facts (code.claude.com/docs/en/github-actions): quick setup with `/install-github-app` (github.com only, admin access, gh CLI checked, installs the app, saves `ANTHROPIC_API_KEY` or `CLAUDE_CODE_OAUTH_TOKEN`, pushes a branch with the selected workflows, opens a ready pull request; Esc behaviour); manual setup; org secret advice; 13-permission table, 3 used, no subset, custom app option; interactive vs automation mode; write-access and human-actor checks (`allowed_non_write_users`, `allowed_bots`, schedule exceptions); `@claude` examples; review workflow and `--comment`/`claude_args` notes and skip list; fork secret note; CLAUDE.md; credentials; costs (minutes, tokens, specific requests, issue templates, concise CLAUDE.md, `--max-turns`, timeouts, concurrency); `GITHUB_TOKEN` troubleshooting; upgrade from beta to v1.
- claude-code-action repo docs: security.md (write access, risky non-write users, default no automatic PR creation with a pre-filled PR link, prompt-injection sanitising), faq.md (open PR: pushes to the PR branch; issues: always a new branch; never merges, rebases or force pushes; no PR by default so branch protection still applies).
- Claude Code docs: best-practices (use CLI tools, gh for issues, PRs and comments; rate limits without gh), common-workflows (create pull requests, `claude --from-pr`, session linked when created with `gh pr create`), code-review (`/code-review` local, target, `--fix`, `--comment`, background subagent, `/review` alias; Code Review research preview for Team and Enterprise, findings don't approve or block), commands (`/install-github-app`, `/security-review`).
- docs.github.com: secrets location (Settings, Secrets and variables, Actions, New repository secret); `issue_comment` covers issue and pull request comments; default `pull_request` types; `GITHUB_TOKEN` events don't create new workflow runs (except workflow_dispatch and repository_dispatch); `gh pr create` (GitHub docs, creating a pull request); closing keywords link and close the issue when merged into the default branch. cli.github.com manual: `gh auth login`, `gh auth status`, `gh issue view`, `gh pr checks` (CI status of the current branch's PR).
- YouTube description: the ready-to-paste description below includes the issue, comment, prompt, commands and all three workflow files, is 3,650 characters, under the 5,000 limit, and contains no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Claude Code + GitHub: @claude, Actions and PR Review | Agentic Engineering Ep 26
2. GitHub Integration for Claude Code: Setup, Workflows, Reviews | Ep 26
3. From Issue to Pull Request with Claude Code and GitHub Actions | Agentic Engineering Ep 26

### Description (ready to paste, 3,650 characters)
```
Episode 26 of Agentic Engineering, a free course on building real software with AI coding agents.

Claude Code meets GitHub: the gh CLI on your machine, and Claude Code GitHub Actions in your repository. We cover use cases, the two modes, who can trigger a run, /install-github-app, secrets and permissions, then three examples in the cart project: an issue turned into a pull request, an @claude comment, and code review.

Screens are drawn illustrations; no Claude, GitHub or CI output is shown. Issue and PR numbers are illustrative.

Issue #12 (written for the course):
Title: Run the tests on every pull request
Body: Add a GitHub Actions workflow that runs npm test for every pull request and every push to main, so a failing test shows up before anyone merges.

Prompt in Claude Code (written for the course):
Read issue 12 with gh issue view 12. Add a workflow at .github/workflows/test.yml that runs npm install and npm test on Node 22, for every pull request and every push to main. Work on a new branch called ci-tests. Commit, push, and open a pull request with gh pr create, with Closes #12 in the body.

Comment on issue #13 (written for the course):
@claude add a short Shipping section to the README. Shipping is 4.99 for carts under 40.00 after discounts, and free from 40.00. Match specs/shipping/spec.md and don't change any code.

Commands:
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

.github/workflows/claude.yml (written for the course, based on the docs):
name: Claude Code
on:
  issue_comment:
    types: [created]
  pull_request_review_comment:
    types: [created]
jobs:
  claude:
    if: contains(github.event.comment.body, '@claude')
    runs-on: ubuntu-latest
    timeout-minutes: 15
    permissions:
      contents: write
      pull-requests: write
      issues: write
      id-token: write
      actions: read
    steps:
      - uses: actions/checkout@v6
        with:
          fetch-depth: 1
      - uses: anthropics/claude-code-action@v1
        with:
          anthropic_api_key: ${{ secrets.ANTHROPIC_API_KEY }}
          claude_args: "--max-turns 10"

.github/workflows/test.yml (written for the course):
name: Tests
on:
  pull_request:
  push:
    branches: [main]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v6
      - uses: actions/setup-node@v6
        with:
          node-version: 22
      - run: npm install
      - run: npm test

.github/workflows/claude-code-review.yml (copied from the official Claude Code GitHub Actions docs):
name: Code Review
on:
  pull_request:
    types: [opened, synchronize, ready_for_review, reopened]
jobs:
  review:
    runs-on: ubuntu-latest
    permissions:
      contents: read
      pull-requests: read
      issues: read
      id-token: write
    steps:
      - uses: actions/checkout@v6
        with:
          fetch-depth: 1
      - uses: anthropics/claude-code-action@v1
        with:
          anthropic_api_key: ${{ secrets.ANTHROPIC_API_KEY }}
          plugin_marketplaces: "https://github.com/anthropics/claude-code.git"
          plugins: "code-review@claude-code-plugins"
          prompt: "/code-review:code-review --comment ${{ github.repository }}/pull/${{ github.event.pull_request.number }}"
          claude_args: '--allowedTools "mcp__github_inline_comment__create_inline_comment"'

Docs: code.claude.com/docs/en/github-actions
Action: github.com/anthropics/claude-code-action
GitHub docs: docs.github.com

Next in the playlist: Episode 27, Parallel Development with Conductor.
```

### Tags
Claude Code, GitHub, GitHub Actions, claude-code-action, install-github-app, @claude, gh CLI, pull requests, code review, CI, AI coding agents, agentic engineering

### Thumbnail text idea
"@claude IN YOUR REPO" in coral, with a drawn pull request icon.

---

## Suggested slide list (Episode 26 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 26 · GitHub Integration |
| 2 | Agenda | Three parts: Use cases · Setting up · Example usages |
| 3 | 01 · Use cases | Divider |
| 4 | Two places | Your machine (gh) vs GitHub Actions |
| 5 | Three products, one name | gh · the action · Code Review |
| 6 | What it's for | Issue to branch · Fix · Answer · Automate |
| 7 | Two modes | Interactive vs automation |
| 8 | Who can start it | Write access · human actor |
| 9 | 02 · Setting up | Divider |
| 10 | gh first | Typed commands (Illustration) |
| 11 | What the command does | App · Secret · Branch · PR · Merge |
| 12 | Which secret? | API key vs subscription token |
| 13 | Permissions | 3 used, 13 in the set (Illustration) |
| 14 | When it runs | claude.yml part 1 (Illustration) |
| 15 | What it does | claude.yml part 2 (Illustration) |
| 16 | Two costs, two caps | Minutes · Tokens · Caps |
| 17 | 03 · Example usages | Divider |
| 18 | Issue twelve | Drawn issue (Illustration) |
| 19 | The prompt | Typed prompt (Illustration) |
| 20 | The test workflow | test.yml (Illustration) |
| 21 | What a green check proves | Proves vs doesn't |
| 22 | The local loop | Open · Checks · Review · Fix · Merge |
| 23 | @claude on an issue | Comment, branch, link (Illustration) |
| 24 | The comment | Drawn comment (Illustration) |
| 25 | Will the tests run? | App sign-in vs GITHUB_TOKEN |
| 26 | Four ways to review | Local · Posted · Workflow · Managed |
| 27 | Review commands | Typed commands (Illustration) |
| 28 | The review workflow | 4 events · --comment · 1 tool |
| 29 | Stay safe | Do vs don't |
| 30 | Quote | Claude pushes the branch. A human merges. |
| 31 | Recap | |
| 32 | Next | Episode 27 · Parallel Development with Conductor |

---

## Sources
- Claude Code GitHub Actions: https://code.claude.com/docs/en/github-actions
- Claude Code docs: https://code.claude.com/docs/en/best-practices (Use CLI tools), https://code.claude.com/docs/en/common-workflows (Create pull requests), https://code.claude.com/docs/en/code-review, https://code.claude.com/docs/en/commands
- claude-code-action: https://github.com/anthropics/claude-code-action (examples/claude.yml, docs/security.md, docs/faq.md)
- GitHub docs: https://docs.github.com (using secrets in GitHub Actions; events that trigger workflows; GITHUB_TOKEN; creating a pull request; linking a pull request to an issue)
- GitHub CLI manual: https://cli.github.com/manual (gh auth login, gh auth status, gh issue view, gh pr checks, gh pr create)
- Course: Episode 22 (Playwright MCP), Episodes 24 and 25 (shipping spec).
