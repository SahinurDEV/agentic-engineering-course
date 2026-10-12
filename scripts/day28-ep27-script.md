# Day 28 · Episode 27: Parallel Development with Conductor

**Series:** Agentic Engineering (free YouTube course) · Module 12
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 21:00
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 12 lessons):** Introduction to Conductor · Running parallel sessions (plus the plain git worktree route for Windows and Linux)

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen drawn terminal or file view with voiceover. This is an **illustrated walkthrough, not a recording**. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag. No Conductor screenshots are used, and no Claude, Conductor, git or CI output is shown. The settings file, `.worktreeinclude`, the updated `test.yml`, the two prompts and the commands are **written for the course** and printed in full below.

**Platform, stated plainly:** Conductor is a Mac app. Its install page says it is not available for Windows or Linux yet. Part 3 shows the same idea with plain git worktrees and Claude Code's own `--worktree` flag.

**Counts drawn on slides (checked against the files and docs):** 3 platforms named (macOS yes; Windows, Linux not yet). Conductor model: 1 project holds 1 repository; 1 workspace maps to 1 branch; 1 branch has 1 working tree. `settings.toml`: 1 setup script, 2 run scripts, 1 run mode. Ports: 10 per local workspace (`CONDUCTOR_PORT` to `CONDUCTOR_PORT+9`). Example: 2 tasks, 2 workspaces, 0 files in common. Updated `test.yml`: 2 Node versions, so 2 test jobs per run. `git worktree list` with 2 linked worktrees: 3 entries, main first. Claude Code isolation checks: 4.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:25 | [VOICEOVER + SLIDE] | Hook |
| 0:25–1:10 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 1:10–6:00 | [VOICEOVER + SLIDE] | Part 1 · Introduction to Conductor |
| 6:00–13:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Running parallel sessions |
| 13:30–20:15 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 3 · Without Conductor: git worktrees |
| 20:15–21:00 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:25 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode, Claude joined our GitHub workflow: issues, pull requests, reviews, and checks.
> But every task still waited for the one before it. One folder, one agent, one job at a time. Today we run several at once, without them stepping on each other.

**Visual / B-roll:**
- Episode 26 recap panel, then the title card.

### 0:25–1:10 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-seven: parallel development with Conductor. It starts module twelve.

*Cue: agenda slide "Three parts"*
> Three parts. First, an introduction to Conductor: what it is, which computers it runs on, and the git feature underneath it. Second, running parallel sessions in Conductor, with two tasks from our cart project. Third, the same idea without Conductor, using git worktrees and Claude Code's own worktree flag, which works on Windows and Linux too.
> It's an illustrated walkthrough, not a recording. The files and prompts are written for this course and printed in full in the description.

**Visual / B-roll:**
- Three items: 01 Conductor · 02 Parallel sessions · 03 Plain worktrees.

### 1:10–6:00 · Part 1: Introduction to Conductor
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "01 · Conductor"*
> Part one. An introduction to Conductor.

*Cue: two columns "One folder, or one each?"*
> Here's the problem. Your project lives in one folder, checked out on one branch. Start two Claude sessions in that same folder, and they edit the same files on disk. One changes the README while the other runs the tests halfway through that change. Neither knows the other exists.
> The fix is simple to say. Give each task its own folder, with its own branch. Then each agent has a quiet place to work, and each task becomes its own branch to review.
> That's what this whole episode is about. Conductor is one way to get it. Plain git is another.

*Cue: squares "What Conductor is"*
> Conductor's docs describe it in one line: it lets you run Claude Code, Codex, Cursor, and OpenCode in parallel.
> Each task gets its own workspace, with its own branch, files, terminal, diff, and review path.
> And when the work is ready, Conductor helps you review the diff, open a pull request, merge, and archive the workspace.
> It ships with its own copy of Claude Code, and by default it uses the login already on your machine, an API key or your Claude plan.
> One more thing the docs are upfront about: Conductor adds its own system prompts, to tell the agent it's running inside Conductor and what a workspace is. You can see and customize those prompts in the repository's settings.

*Cue: panel "Mac only, for now"*
> Before you get excited, the platform question, plainly.
> Conductor is a Mac app. Its install page says it is not available for Windows or Linux yet, with a sign-up form to hear when it is.
> Conductor also has cloud workspaces, which run on Linux sandboxes. But you use those from the same Mac app, so they don't change the answer for a Windows or Linux desktop.
> If you're not on a Mac, stay with me. Part one explains the idea, and part three gives you the same idea with tools you already have.

*Cue: four numbered "The model"*
> Conductor's docs build its model from four ideas.
> A project is Conductor's entry for a codebase. One project holds one repository.
> A workspace is an isolated copy of that repository for one task, issue, experiment, or pull request. One workspace maps to one branch.
> The branch is checked out inside the workspace, and it's usually the unit you review and turn into a pull request. One branch has one working tree.
> And the working tree is the files on disk. Around it runs the workspace's environment: the app, server, tests, and terminal commands. Each workspace can run many processes.
> The docs sum it up in two lines. The workspace is the unit of delegation. The branch and pull request are the unit of integration.

*Cue: plan "Git worktrees underneath"*
> Under the hood, Conductor uses a git feature called worktrees.
> The git docs put it this way: a repository can support multiple working trees, so you can check out more than one branch at a time. Your normal checkout is the main worktree. Each extra one is a linked worktree.
> What's separate: the files on disk, the branch, and whatever runs there. What's shared: the history, refs, remotes, and objects. That's why a new workspace is fast. Nothing is cloned again.
> And one rule from git matters a lot. A branch can be checked out in only one worktree at a time. So two workspaces can't sit on the same branch.
> Conductor usually puts workspaces under a conductor folder in your home directory, and names each one after a city.

*Cue: card "Isolation is not security"*
> One more thing before we use it, because the docs are very clear about it.
> Workspace isolation is development isolation, not a security boundary. Separate folders keep agents from editing each other's files. They don't keep an agent away from the rest of your Mac.
> Agents in Conductor run with your user account's permissions. They can read and write files, run shell commands, and reach anything you can. The docs say they run directly on your system, without sandboxing. If you want extra safety, the docs suggest a separate machine or a virtual machine for development.
> So everything from earlier episodes still applies: permissions, hooks, and reading what an agent wants to run.

**Visual / B-roll:**
- Two columns: one shared folder vs one folder per task.
- Squares: Agents · Workspaces · Review.
- Panel: macOS yes · Windows not yet · Linux not yet.
- Four numbered: Project · Workspace · Branch · Working tree.
- Plan + Illustration: what is separate and what is shared.
- Card: isolated vs not isolated.

### 6:00–13:30 · Part 2: Running parallel sessions
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Parallel sessions"*
> Part two. Running parallel sessions.

*Cue: drawn terminal "Before you start"*
> Install Conductor by dragging the app into your Applications folder. When it opens, it checks for what it needs, and walks you through anything missing.
> You need GitHub and at least one agent. For GitHub, Conductor uses the login from your terminal, so G H auth status, from last episode, is the check. For Claude Code, claude slash login signs you in.
> These are typed commands only. No output is shown.

*Cue: flow "Your first workspace"*
> Then the first loop, in the order the docs give it.
> Add a repository: a local folder, a project from GitHub, or a new one.
> Conductor creates a workspace, with a new branch and working tree. It fetches from origin first and bases the branch on your base branch, so the workspace starts from the latest remote commit. When you start the first chat, Conductor tells the agent to rename the branch to match the task.
> The setup script prepares the workspace. Then you chat with Claude Code inside it. And at the end, you review.
> One catch to know early. A new workspace starts with the files git tracks. Ignored files, like dot env files and installed packages, aren't there until your setup script or Conductor's file copy puts them there.

*Cue: phone "The settings file"*
> So let's tell Conductor how to prepare the cart project. This settings file is written for the course, and it lives at dot conductor slash settings dot toml. Commit it, and teammates get the same setup once it's merged.
> It has one setup script: N P M install. That runs after Conductor creates each workspace.
> Two run scripts, which appear on the Run button. One starts the dev server. The other runs N P M test.
> And one run mode: concurrent, so run scripts in different workspaces can run at the same time.
> One assumption to flag. The dev command passes a port flag through to the server, the way the Conductor docs' own example does. If your server reads its port differently, change that one line.
> And for settings that are only yours, there's a second file, settings dot local dot toml, in the same folder. Add it to your git ignore file. Where both set the same thing, your local value wins. And never put secrets in the shared file.

*Cue: two points "Ports and files"*
> Two details make parallel work actually run.
> Ports. Every local workspace gets its own range of ten ports, starting at Conductor port. So two dev servers can run at once without fighting over port three thousand. That's why the run script uses it.
> Files. To bring ignored files into new workspaces, Conductor reads a dot worktree include file at the repository root. It copies a file only when it's ignored by git and matches a pattern. Tracked files are already there, so they're never copied. Without this file or a setting, the default pattern is dot env star.
> File copy runs for local workspaces on your Mac. Cloud workspaces need those steps in the setup script instead.
> The same dot worktree include file works for Claude Code's own worktrees too. We'll see that in part three.

*Cue: two columns "One workspace or many?"*
> Now the real decision: how to split the work. The docs give a simple test.
> Use separate workspaces when tasks should land on their own: independent features, bug fixes that ship separately, one workspace per issue, and experiments you may throw away.
> Use several agents in one workspace when they need the same branch and the latest files: one agent implementing while another reviews the diff, or one fixing tests after another changes the code.
> The trade-off is honest. Agents in one workspace can edit the same files. So ask one question: should these ship apart? If yes, split them.

*Cue: squares "Two tasks, two workspaces"*
> Here are our two tasks, both small and both real follow-ups from last episode.
> Task A: the README shipping section from issue thirteen. It only touches README dot md.
> Task B: run the tests on two Node versions, twenty-two and twenty-four. It only touches the test workflow file.
> Zero files in common. That's the point. Two tasks that touch different files can move in parallel and merge in any order.

*Cue: drawn terminal "Two prompts"*
> One prompt per workspace, typed in each Claude Code chat. Both are written for the course and printed in full in the description.
> In the first workspace: add a short Shipping section to README dot md, matching the shipping spec, and change no other file.
> In the second: change the test workflow to run on Node twenty-two and twenty-four, using a matrix, change no other file, then run N P M test.
> The docs' advice for parallel prompts: name the task, the expected outcome, the constraints, and the command that checks it. Narrow prompts finish on their own.

*Cue: four numbered "Review, one at a time"*
> While both agents work, the sidebar shows each workspace. When one is done, review it on its own.
> One. The diff viewer. Read every changed file, leave comments on lines, and send them back to the agent. You can also revert a file you don't want to keep.
> Two. The Review action, for an agent review of the diff, with your own priorities in the prompt.
> Three. The Checks tab: git status, the pull request, C I, comments, and todos. Treat failing checks and open todos as blockers.
> Four. Create the pull request, and merge it when it's approved and green.

*Cue: card "What the checks prove"*
> Let's be precise about what the green checks mean here.
> Task B's workflow lists two Node versions, so each run has two test jobs, one per version. Two green jobs mean N P M test passed on Node twenty-two and on twenty-four, for that commit.
> They don't prove the README is right. Task A changes no code, so its checks only show the tests still pass. Reading the README is your job.
> And a clean merge only means the two branches didn't edit the same lines. It doesn't prove the combined code works. So after the first pull request merges, update the second branch and let its checks run again before you merge it.

*Cue: panel "Merge, then archive"*
> When a workspace is merged, archive it, so your sidebar shows only live work. If the project has an archive script, it runs before the workspace is archived, to clean up anything outside the workspace folder.
> Changed your mind? Archived workspaces can be restored from the History pane, with their chat history.
> And the workspace that wasn't worth shipping? Archive it too. That's the beauty of experiments in their own workspace. Throwing one away costs nothing.

*Cue: phone "When the app can't run twice"*
> Some projects can't run two copies at once: one fixed port, one local database, one Docker stack. Conductor has two answers.
> Set the run mode to non concurrent. Then starting a run script stops any other run script first.
> Or use Spotlight testing. Conductor syncs one workspace's tracked changes back to the repository root, and you test from there, one workspace at a time.
> Our cart can run twice, thanks to the port range, so we keep concurrent.

**Visual / B-roll:**
- Monitor + Illustration: typed commands only.
- Flow: Add repo · Workspace · Setup · Chat · Review.
- Phone + Illustration: settings.toml summary (written for the course).
- Two points + Illustration: ports and .worktreeinclude.
- Two columns: many workspaces vs one workspace.
- Squares: Task A · Task B · 0 shared files.
- Monitor + Illustration: the two prompts as typed.
- Four numbered: Diff · Review · Checks · Merge.
- Card: what the checks prove.
- Panel: merge, archive, restore.
- Phone + Illustration: nonconcurrent and Spotlight.

### 13:30–20:15 · Part 3: Without Conductor: git worktrees
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "03 · Plain worktrees"*
> Part three. The same idea without Conductor.

*Cue: two columns "Conductor or plain worktrees?"*
> Conductor's own docs say it: raw git worktrees give you separate checkouts, and Conductor builds the agent workflow around them. The sidebar, the setup and run scripts, the diff, checks, and pull request flow.
> Plain worktrees give you the core of it anywhere git runs: Mac, Windows, or Linux. Claude Code has worktree support built in. You handle setup and review yourself, with the tools from earlier episodes.
> Same idea underneath. One task, one worktree, one branch.

*Cue: drawn terminal "Claude Code's worktree flag"*
> Claude Code's docs have a page on running parallel sessions with worktrees. The quickest way: pass dash dash worktree with a name.
> Claude worktree readme shipping, in one terminal. Claude worktree C I node matrix, in another. Two isolated sessions.
> Run claude once in the repository first, to accept the trust dialog. Otherwise the worktree flag exits with an error.
> Typed commands only, no output.

*Cue: plan "What the flag does"*
> Here's what that flag does, by default.
> It creates the worktree under dot claude slash worktrees, with the name you gave, at the repository root. It creates a new branch called worktree dash, then that name. And it branches from your repository's default branch, so each session starts from a clean tree that matches the remote.
> A worktree is a fresh checkout, so set it up: install dependencies there, or ask Claude to. The dot worktree include file from part two copies your ignored files, like dot env, into each new worktree.
> And add dot claude slash worktrees to your git ignore file, so the worktrees don't show up as untracked files in your main checkout.
> Two options are worth knowing. To review a pull request in its own worktree, pass the number with a hash sign in quotes, like hash twelve thirty-four, and Claude Code fetches that pull request's head commit from origin. And if you want new worktrees to start from your current work instead of the default branch, set worktree base ref to head in your settings.

*Cue: two points "How Claude Code keeps it isolated"*
> Claude Code also enforces the isolation. Its docs list four checks while a session is in a worktree.
> It blocks file edits that target the main checkout. It blocks commands whose working directory is the main checkout. It blocks commands that redirect git into the main checkout. And it blocks commands when it can't tell from the text that git stays inside the worktree.
> The same isolation can apply inside one session. Ask Claude to use worktrees for its agents, or add isolation colon worktree to a custom subagent's front matter, and each subagent gets a temporary worktree of its own. Claude removes it when the subagent finishes without changes.
> Now the honest limit, also from the docs. These checks read paths and command text. They don't track which files a shell command writes. So a copy or a shell redirect into the main checkout isn't stopped by them. That's still up to your permissions and sandbox settings.

*Cue: phone "By hand, with git"*
> You can also make worktrees with git directly, for example to start from a branch that already exists, or to put the worktree beside your project. These commands are written for the course.
> Git worktree add, dot dot slash cart readme, dash b readme shipping. That makes a new folder next to the project, on a new branch. Go into it, run N P M install, and start claude there.
> Do the same for the second task. Then git worktree list shows three entries: the main worktree first, then the two linked ones.
> If you try to add a worktree for a branch another worktree already has checked out, git refuses by default. That's the one branch, one worktree rule again.

*Cue: flow "Cleaning up"*
> When you exit a worktree session, Claude Code checks for work you'd lose: changed or untracked files, and new commits.
> If the worktree is clean and the session is unnamed, Claude removes the worktree and its branch for you. A named session asks first.
> If there's work in it, Claude asks whether to keep or remove it. Keep it, and the exit message gives you a command to resume later. Remove it, and the folder, the branch, and the work in them are deleted. So push or merge first.
> For worktrees you made by hand, git worktree remove cleans up. Git only removes clean worktrees unless you force it, and it never removes the main one.

*Cue: squares "Keep sessions coordinated"*
> Whichever tool you use, the same habits keep parallel work calm. They come straight from Conductor's guide for Claude Code.
> Narrow tasks. Give each session a task it can finish on its own.
> Different files. Don't hand two sessions the same file-heavy refactor, unless you expect merge conflicts.
> Shared context in the repository. Keep what every session needs in committed docs and instruction files, like CLAUDE dot md and our specs, not in one chat.
> For notes and handoffs that shouldn't be committed, Conductor gives each workspace a dot context folder, which git ignores.
> And remember your own limits. Every session uses your account, your machine, and your attention for review.

*Cue: quote slide*
> The line to remember: one task, one worktree, one review.

*Cue: recap slide*
> Recap. Conductor runs several coding agents at once, each in its own workspace, built on git worktrees. It's a Mac app; it isn't available for Windows or Linux yet. A settings file gives every workspace the same setup and run scripts, and its own ports. Split work into separate workspaces when tasks ship apart. Review and merge one at a time, then update the next branch. Isolation is for development, not security. And on any platform, Claude Code's worktree flag and plain git worktrees give you the same idea.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-eight: the capstone, the project and its requirements. It starts module thirteen, where we build a full project with everything from this course. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Two columns: Conductor vs plain worktrees.
- Monitor + Illustration: claude --worktree commands as typed.
- Plan + Illustration: what --worktree creates.
- Two points + Illustration: the four isolation checks and the limit.
- Phone + Illustration: git worktree commands (written for the course).
- Flow: Exit · Check · Clean · Has work · Resume.
- Squares: Narrow · Separate · Shared context.
- Quote card, recap card, next-episode card "Episode 28 · Capstone, the Project and Requirements".

---

## Example files

All blocks are free of `<` and `>` characters. They are written for the course. The cart project details (dev server, port flag, env files) are illustrative; adjust the dev command if your server reads its port another way.

### `.conductor/settings.toml` (written for the course; keys from Conductor's settings reference)

```toml
"$schema" = "https://conductor.build/schemas/settings.repo.schema.json"

[scripts]
setup = "npm install"
run_mode = "concurrent"

[scripts.run.dev]
command = "npm run dev -- --port $CONDUCTOR_PORT"
default = true
icon = "play"

[scripts.run.test]
command = "npm test"
icon = "test-tube"
```

### `.worktreeinclude` (written for the course; read by Conductor and by Claude Code)

```text
.env
.env.local
```

### Prompts, one per workspace or worktree (written for the course)

```text
Add a short Shipping section to README.md: shipping is 4.99 for carts under 40.00 after discounts, and free from 40.00. Match specs/shipping/spec.md. Change no other file.
```

```text
Change .github/workflows/test.yml to run the tests on Node 22 and Node 24 using a matrix. Change no other file. Then run npm test.
```

### `.github/workflows/test.yml` after task B (written for the course)

```yaml
name: Tests
on:
  pull_request:
  push:
    branches: [main]
jobs:
  test:
    runs-on: ubuntu-latest
    strategy:
      matrix:
        node: [22, 24]
    steps:
      - uses: actions/checkout@v6
      - uses: actions/setup-node@v6
        with:
          node-version: ${{ matrix.node }}
      - run: npm install
      - run: npm test
```

### Commands (typed; no output shown)

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

Add this line to `.gitignore` when you use `claude --worktree`:

```text
.claude/worktrees/
```

---

## Production notes
- Spoken word count: about 2,960 words, roughly 20.4 minutes at a steady TTS pace, plus slide pauses (plan target about 21).
- Illustrated walkthrough, not a recording. No Conductor screenshots; Conductor's UI is described in words only. No Claude, Conductor, git, CI or test output is shown.
- The agenda says three parts and the script has three parts (three dividers). The plan lists two Module 12 lessons (Introduction to Conductor, Running parallel sessions); Part 3 adds the worktree route for Windows and Linux as requested.
- Spoken episode numbers: "episode twenty-seven" (this one), "module twelve", "episode twenty-eight" (next), "module thirteen".
- Platform (conductor.build/docs/installation, site metadata): "Conductor is available for macOS"; "Conductor is not available for Windows or Linux yet" with a sign-up form. Cloud workspaces run in Linux sandboxes but are used "from the Conductor Mac app" (docs/cloud).
- Conductor facts (conductor.build/docs and llms-full.txt, fetched 10 Oct 2026): introduction (Claude Code, Codex, Cursor, OpenCode in parallel; workspace, branch, files, terminal, diff, review path; review, PR, merge, archive); install and setup checks (gh auth status, claude /login; GitHub plus at least one agent); FAQ (bundled Claude Code and Codex; uses existing login, API key or Pro/Max; agents run with user permissions without sandboxing; separate machine or VM suggestion); first workspace (add repo options; tracked files only; setup script; split work); isolated workspaces (project, repository, workspace, branch, working tree, running environment; branch from base branch after fetching origin; agent renames branch on first chat; one workspace per branch); git worktrees concept (worktree per workspace; shared history, refs, remotes, objects; usually under ~/conductor/workspaces; isolation is not a security boundary; raw worktrees vs Conductor); scripts reference (setup after creation, run on the Run button, archive before archiving, run_mode concurrent and nonconcurrent; 10 ports per workspace); files to copy (gitignored and matching; .worktreeinclude wins; default .env*; local Mac workspaces); parallel agents decision guide; run multiple Claude Code sessions (narrow prompts naming task, outcome, constraints, validation command; coordination tips; native claude --worktree alternative); review and merge (diff viewer, Review action, Checks tab blockers, Create PR, merge, archive, restore from History); Spotlight testing (syncs tracked changes to the repo root, one workspace at a time); cities FAQ.
- Claude Code facts (code.claude.com/docs/en/worktrees): `--worktree`/`-w` name, default location `.claude/worktrees/NAME`, branch `worktree-NAME`, default base is the repository's default branch (`worktree.baseRef` "fresh"); trust dialog requirement; fresh checkout needs setup; `.worktreeinclude` copies gitignored matching files; `.gitignore` tip; four isolation checks and their limit (no tracking of files written by shell commands such as cp or redirects); exit cleanup rules (clean unnamed removed with branch, named prompts, work prompts keep or remove, resume command printed); manual `git worktree add/list/remove`.
- git-scm.com/docs/git-worktree: multiple working trees, one main and zero or more linked; `add` refuses a branch already checked out by another worktree by default; `remove` only clean worktrees unless `--force`, main worktree cannot be removed; `list` shows the main worktree first.
- Logic checks: the two tasks touch README.md and .github/workflows/test.yml only, so 0 files in common; a matrix of 2 Node versions produces 2 jobs per run; Task A changes no code, so its green check only shows the existing tests still pass; a clean git merge means no overlapping edits, not that the combined result works, hence update the second branch and re-run checks; `git worktree list` after two `add` commands shows 3 entries.
- YouTube description: the ready-to-paste description below includes all course files, prompts and commands, is 2,306 characters, under the 5,000 limit, and contains no angle brackets.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Parallel Coding Agents with Conductor and Git Worktrees | Agentic Engineering Ep 27
2. Run Several Claude Code Sessions at Once: Conductor, Worktrees, claude --worktree | Ep 27
3. Parallel Development with Conductor (and Worktrees on Windows and Linux) | Agentic Engineering Ep 27

### Description (ready to paste, 2,306 characters)
```
Episode 27 of Agentic Engineering, a free course on building real software with AI coding agents.

Run several Claude Code sessions at once without them colliding. We cover Conductor (what it is, workspaces, git worktrees underneath, setup and run scripts, ports, files to copy, review and merge), then the same idea on any platform with git worktrees and claude --worktree.

Platform: Conductor is a Mac app. Its docs say it is not available for Windows or Linux yet. Part 3 shows plain worktrees, which work wherever git runs.

Screens are drawn illustrations; no Claude, Conductor, git or CI output is shown. All files below are written for the course.

.conductor/settings.toml:
"$schema" = "https://conductor.build/schemas/settings.repo.schema.json"

[scripts]
setup = "npm install"
run_mode = "concurrent"

[scripts.run.dev]
command = "npm run dev -- --port $CONDUCTOR_PORT"
default = true
icon = "play"

[scripts.run.test]
command = "npm test"
icon = "test-tube"

.worktreeinclude (read by Conductor and Claude Code):
.env
.env.local

Prompt, workspace A:
Add a short Shipping section to README.md: shipping is 4.99 for carts under 40.00 after discounts, and free from 40.00. Match specs/shipping/spec.md. Change no other file.

Prompt, workspace B:
Change .github/workflows/test.yml to run the tests on Node 22 and Node 24 using a matrix. Change no other file. Then run npm test.

.github/workflows/test.yml after task B:
name: Tests
on:
  pull_request:
  push:
    branches: [main]
jobs:
  test:
    runs-on: ubuntu-latest
    strategy:
      matrix:
        node: [22, 24]
    steps:
      - uses: actions/checkout@v6
      - uses: actions/setup-node@v6
        with:
          node-version: ${{ matrix.node }}
      - run: npm install
      - run: npm test

Commands:
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

Add to .gitignore when using claude --worktree:
.claude/worktrees/

Conductor docs: conductor.build/docs
Claude Code worktrees: code.claude.com/docs/en/worktrees
Git worktree: git-scm.com/docs/git-worktree

Next in the playlist: Episode 28, Capstone, the Project and Requirements.
```

### Tags
Claude Code, Conductor, git worktree, parallel agents, claude --worktree, worktreeinclude, coding agents, agentic engineering, macOS, parallel development

### Thumbnail text idea
"ONE TASK, ONE WORKTREE" in coral, with two drawn branch lines running side by side.

---

## Suggested slide list (Episode 27 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 27 · Parallel Development with Conductor |
| 2 | Agenda | Three parts: Conductor · Parallel sessions · Plain worktrees |
| 3 | 01 · Conductor | Divider |
| 4 | One folder, or one each? | Shared folder vs folder per task |
| 5 | What Conductor is | Agents · Workspaces · Review |
| 6 | Mac only, for now | macOS · Windows not yet · Linux not yet |
| 7 | The model | Project · Workspace · Branch · Working tree |
| 8 | Git worktrees underneath | Separate vs shared (Illustration) |
| 9 | Isolation is not security | Isolated vs not (Illustration) |
| 10 | 02 · Parallel sessions | Divider |
| 11 | Before you start | Typed commands (Illustration) |
| 12 | Your first workspace | Add repo · Workspace · Setup · Chat · Review |
| 13 | The settings file | settings.toml summary (Illustration) |
| 14 | Ports and files | 10 ports · .worktreeinclude (Illustration) |
| 15 | One workspace or many? | Decision guide |
| 16 | Two tasks, two workspaces | A · B · 0 shared files |
| 17 | Two prompts | Typed prompts (Illustration) |
| 18 | Review, one at a time | Diff · Review · Checks · Merge |
| 19 | What the checks prove | Proves vs doesn't (Illustration) |
| 20 | Merge, then archive | Archive · restore |
| 21 | When the app can't run twice | nonconcurrent · Spotlight (Illustration) |
| 22 | 03 · Plain worktrees | Divider |
| 23 | Conductor or plain worktrees? | Comparison |
| 24 | Claude Code's worktree flag | Typed commands (Illustration) |
| 25 | What the flag does | Location, branch, base (Illustration) |
| 26 | How Claude Code keeps it isolated | 4 checks and the limit (Illustration) |
| 27 | By hand, with git | git worktree commands (Illustration) |
| 28 | Cleaning up | Exit · Check · Clean · Has work · Resume |
| 29 | Keep sessions coordinated | Narrow · Separate · Shared context |
| 30 | Quote | One task, one worktree, one review |
| 31 | Recap | |
| 32 | Next | Episode 28 · Capstone, the Project and Requirements |

---

## Sources
- Conductor: https://www.conductor.build/docs (Introduction, Install, Your first workspace, Configure your project, Isolated workspaces, Git worktrees, Parallel agents, Workflow, Testing, Scripts, Files to copy, .worktreeinclude, Environment variables, Settings reference, Run multiple Claude Code sessions in parallel, Run Claude Code with Git worktrees, Review and merge, Checks, Spotlight testing, Cloud, FAQ); full text at https://www.conductor.build/llms-full.txt
- Claude Code: https://code.claude.com/docs/en/worktrees
- Git: https://git-scm.com/docs/git-worktree
- GitHub Actions matrix: https://docs.github.com (using a matrix for your jobs)
- Course: Episode 26 (test.yml, issue thirteen), Episodes 24 and 25 (shipping spec).
