# Day 21 · Episode 20: Hooks

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 14:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 8 lessons):** Introduction, Hooks Worth Shipping, Setting up Hooks

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The hook scripts and settings files are **written for this course** (full text under "Example files" below), following patterns from the official hooks guide. Every hooks fact comes from the Claude Code hooks guide and hooks reference. No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) | n/a |
| 1:00–5:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · What hooks are: events, matchers, input, exit codes, JSON | Introduction |
| 5:00–9:30 | [VOICEOVER + SCREEN] | Part 2 · Four hooks worth shipping | Hooks Worth Shipping |
| 9:30–13:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Setting up hooks: steps, testing, locations, security | Setting up Hooks |
| 13:00–14:00 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we finished the skills module with two database skills and a recipe for writing your own. And for four episodes in a row, I've said the same thing: a skill is guidance. If a rule must hold every time, put it in a hook.
> Today we do exactly that.

**Visual / B-roll:**
- Episode 19 recap panel, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty: hooks.

*Cue: agenda slide "Three parts"*
> Three parts. First, what hooks are: events, matchers, and how a hook talks back to Claude Code. Second, four hooks worth shipping. Third, setting them up safely: the steps, testing, where they live, and the security cautions. Everything on screen is an illustration. The hook files are written for this course, and every fact about hooks comes from the official hooks guide and reference.

**Visual / B-roll:**
- Three items: 01 What hooks are · 02 Worth shipping · 03 Setting up.

### 1:00–5:00 · Part 1: What hooks are
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · What hooks are"*
> Part one. What hooks are.

*Cue: two columns "Skill or hook"*
> The hooks guide defines them in one line: hooks are user-defined shell commands that Claude Code runs at specific points in its lifecycle.
> The important word is deterministic. The guide says hooks give you deterministic control, so certain actions always happen, rather than relying on the model to choose to run them.
> That's the difference from a skill. A skill is instructions Claude reads and follows with judgment. A hook is code Claude Code runs, every time its event fires. Claude doesn't decide.
> So use a skill to teach, and a hook to enforce.

*Cue: four numbered "Events worth knowing"*
> Hooks attach to events. There are many, and the reference lists them all. Four cover most of what you'll want.
> Session start fires when a session begins or resumes.
> Pre tool use fires before a tool call runs, and it can block it.
> Post tool use fires after a tool call succeeds. It can't undo anything, because the tool already ran.
> And stop fires when Claude finishes responding.
> One more you'll use early: notification, which fires when Claude Code sends a notification, like when it's waiting for your permission.

*Cue: drawn file "Anatomy of a hook"*
> Hooks live in a settings file, under a key called hooks. Inside it, each event name is a key. Under the event, you add a matcher group: a matcher, and a list of hooks.
> The matcher filters when it fires. For the tool events, it matches the tool name. Edit, pipe, Write means only the Edit or Write tool. The guide notes matchers are case sensitive, and with no matcher, the hook fires on every occurrence of its event.
> Each hook has a type. Most use command, which runs a shell command. There are also H T T P, prompt, agent, and M C P tool hooks, but command hooks are the ones to start with.
> And when more than one hook matches the same event, Claude Code runs them all in parallel. For pre tool use decisions, the most restrictive answer wins, so a deny from one hook beats an allow from another.

*Cue: two points "Input and output"*
> How does a hook know what's happening? When the event fires, Claude Code passes event data as JSON on the script's standard input. Every event includes fields like the session I D and the working directory. A pre tool use hook also gets the tool name, and tool input, the arguments Claude passed. For a file edit, that includes the file path.
> And how does the hook answer? Through its exit code, and what it prints.

*Cue: squares "Three ways to answer"*
> Three answers.
> Exit zero means no objection. For pre tool use, the guide is careful here: that doesn't approve the call. The normal permission flow still applies.
> Exit two means block. Write the reason to standard error. For pre tool use, Claude gets that reason as feedback so it can adjust. Some events can't be blocked at all. Session start, for example, just shows the message to you and carries on.
> Or exit zero and print a JSON object, for structured control. A pre tool use hook can return a permission decision of deny, with a reason that goes back to Claude. The guide says pick one approach per hook: exit two, or JSON.

**Visual / B-roll:**
- Two columns: Skill (guidance) vs Hook (deterministic).
- Four numbered: SessionStart · PreToolUse · PostToolUse · Stop.
- Monitor + Illustration: settings.json shape (event, matcher, type, command).
- Two points + Illustration: stdin JSON fields.
- Squares: exit 0 · exit 2 · JSON.

### 5:00–9:30 · Part 2: Four hooks worth shipping
**Marker:** [VOICEOVER + SCREEN]

*Cue: divider "02 · Hooks worth shipping"*
> Part two. Four hooks worth shipping. Each one is written for this course, and each one follows a pattern from the hooks guide.

*Cue: card "Protect files"*
> Hook one: protect files. This is the rule from episode eighteen, never touch dot env, made real.
> It's a pre tool use hook with an Edit, pipe, Write matcher, so it runs before every file edit. The script reads the file path from the input JSON, and checks it against a list: dot env, the dot git folder, and the two lock files. It also refuses any path containing dot dot, because the reference's security advice says to block path traversal.
> On a match, it prints a JSON deny with a reason, like: this file is protected, ask the user to change it. Claude Code cancels the edit, and Claude reads the reason.
> The guide's own version uses exit two with a message on standard error. Mine uses JSON instead, which has a nice side effect I'll come back to.

*Cue: plan "Format after edits"*
> Hook two: format after edits. A post tool use hook with the same Edit, pipe, Write matcher, so it runs after each file edit.
> The script reads the file path and picks a formatter by extension. P H P files go through Laravel Pint, which the Laravel docs describe as an opinionated P H P code style fixer. J S and T S files go through Prettier, the formatter in the hooks guide's own example.
> When it works, you see nothing. The reference says a successful hook's standard output goes to the debug log, not the transcript. You'll just notice the file is formatted.
> One limit from the guide: Claude can also change files by running shell commands, which an Edit and Write matcher won't see. For formatting, that's fine.

*Cue: two points "Tests before stopping"*
> Hook three: tests before stopping. This is the one I promised in the React episode.
> A stop hook runs when Claude finishes responding. Mine runs the test suite. If it passes, the script exits quietly and Claude stops. If it fails, the script prints a JSON decision of block, with a reason: the test suite is failing, fix it before you finish. The reference says block prevents Claude from stopping, and the reason tells Claude why it should continue.
> But there's a trap. If the tests can never pass, Claude would loop. So the script first checks a field called stop hook active, which is true when Claude is already continuing because of a stop hook. If it's true, the script lets Claude stop. That gives Claude one more pass to fix things, then hands back to you.
> Two honest costs. Stop fires every time Claude finishes responding, not only when a task is done, so this runs even after a quick question. Keep the suite fast, or scope it.

*Cue: phone "Notify me"*
> Hook four: notify me. This one goes in your personal settings, not the project, because it's about your desktop.
> It's a notification hook with the matcher permission prompt, which the guide says fires when Claude needs you to approve a tool use. The command shows a desktop notification. On Linux, the guide uses notify send. On a Mac, osascript.
> Now you can switch away while Claude works, and you'll know when it needs you.

**Visual / B-roll:**
- Card + Illustration: protect-files.sh lines.
- Plan + Illustration: format.sh lines.
- Two points + Illustration: stop-tests.sh lines.
- Phone + Illustration: Notification config in ~/.claude/settings.json.

### 9:30–13:00 · Part 3: Setting up hooks
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Setting up hooks"*
> Part three. Setting up hooks.

*Cue: flow "Five setup steps"*
> Five steps, the same for every command hook.
> One, write the script in dot claude slash hooks.
> Two, make it executable with chmod plus x. The guide says hook scripts must be executable for Claude Code to run them.
> Three, register it in dot claude slash settings dot JSON, under the event and matcher. Point to the script through the project directory variable, in double quotes, so the path works wherever the session starts.
> Four, type slash hooks. It opens a read-only browser of every configured hook, labelled with where it came from.
> If you edit a settings file while Claude Code is running, the guide says the file watcher normally picks up the change, so you rarely need a restart. And if you'd rather not write the JSON by hand, the guide says you can describe the hook you want and ask Claude to write it. Just read what it wrote before you trust it.
> And five, test it.

*Cue: drawn terminal "Test it by hand"*
> The guide's tip for testing: pipe a sample of the input JSON into your script, then check its exit code. For the protect files hook, that's a small JSON object with a tool input whose file path is dot env.
> Then try it for real. Ask Claude to add a comment to the dot env file, and the edit should be blocked.
> To see what a hook did, press control O for the transcript view, or start Claude Code with the debug flag and read the log.
> On screen are only the commands I'd type. No output is shown.

*Cue: panel "Hooks can't be talked around"*
> Here's why hooks are the right home for must-hold rules. The guide says a pre tool use hook fires before any permission mode check, in every mode. A hook that denies a call blocks it even in bypass permissions mode.
> It doesn't work the other way. A hook that returns allow doesn't override deny rules in your settings. Hooks can tighten restrictions, not loosen them.
> And if you need to switch them off, the disable all hooks setting turns hooks off without deleting them.

*Cue: four numbered "Where hooks live"*
> Where you put a hook decides who gets it.
> Your user settings in your home folder apply to all your projects, just on your machine. That's where notify me goes.
> The project's dot claude slash settings dot JSON can be committed, so the team gets it. That's where protect files, format, and tests go.
> Settings dot local dot JSON is for you only, in one project.
> And a skill can carry hooks in its frontmatter. The reference says they register when the skill is invoked and keep running for the rest of the session.

*Cue: panel "Security cautions"*
> Last, the warning the reference puts in a box. Command hooks run shell commands with your full user permissions. They can change, delete, or read any file your account can. Review and test every hook command before you add it.
> That includes hooks that arrive with a repository. In an interactive session, Claude Code holds back settings file hooks until you accept the workspace trust dialog. But in a non-interactive run with the p flag, there's no dialog, and a repository's committed hooks run. So before you script Claude over a repo you didn't write, read its dot claude settings first.
> And the reference's best practices: validate inputs, always quote shell variables, block path traversal, use absolute paths, and skip sensitive files.
> One last note on the files. Hook scripts usually write errors with a redirect, which needs an angle bracket. I wrote all four with JSON output instead, so every file pastes cleanly into a YouTube description.

**Visual / B-roll:**
- Flow: Write → chmod +x → Register → /hooks → Test.
- Monitor + Illustration: typed test command and prompt only.
- Panel: Deny wins · Allow can't loosen · disableAllHooks.
- Four numbered: User · Project · Local · Skill.
- Panel: Full permissions · Trust dialog · -p runs repo hooks.

### 13:00–14:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: skills ask, hooks insist.

*Cue: recap slide*
> Recap. Hooks are shell commands Claude Code runs at lifecycle events, deterministically. You configure them in settings under an event and a matcher. They read JSON on standard input and answer with exit zero, exit two, or JSON output. Four worth shipping: protect files before edits, format after edits, run tests before stopping, and notify me when Claude needs approval. Set them up in five steps, test them by hand, and remember they run with your full permissions, so review every one.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-one: M C P explained, and choosing servers. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 21 · MCP Explained and Choosing Servers".

---

## Example files (written for the course)

All five files below are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. Typical hook scripts write to stderr with `>&2` or append logs with `>>`, and the hooks guide's own examples do; these scripts avoid that by returning JSON on stdout (the guide's "exit 0 and print JSON" approach) and by capturing test output in a variable. If you adapt them to the exit-2 approach, the redirect makes the script unsafe for the description: paste a link to the repository instead.

They need `jq` (as the hooks guide's examples do), Laravel Pint for PHP files, and Prettier for JS and TS files.

### `.claude/settings.json` (project, committed)

```json
{
  "hooks": {
    "PreToolUse": [
      {
        "matcher": "Edit|Write",
        "hooks": [
          { "type": "command", "command": "\"$CLAUDE_PROJECT_DIR\"/.claude/hooks/protect-files.sh" }
        ]
      }
    ],
    "PostToolUse": [
      {
        "matcher": "Edit|Write",
        "hooks": [
          { "type": "command", "command": "\"$CLAUDE_PROJECT_DIR\"/.claude/hooks/format.sh" }
        ]
      }
    ],
    "Stop": [
      {
        "hooks": [
          { "type": "command", "command": "\"$CLAUDE_PROJECT_DIR\"/.claude/hooks/stop-tests.sh" }
        ]
      }
    ]
  }
}
```

### `.claude/hooks/protect-files.sh`

```bash
#!/bin/bash
# PreToolUse hook for Edit and Write: deny edits to protected files.
INPUT=$(cat)
FILE_PATH=$(echo "$INPUT" | jq -r '.tool_input.file_path // empty')

deny() {
  jq -n --arg reason "$1" '{hookSpecificOutput: {hookEventName: "PreToolUse", permissionDecision: "deny", permissionDecisionReason: $reason}}'
  exit 0
}

if [[ "$FILE_PATH" == *".."* ]]; then
  deny "Blocked: paths containing .. are not allowed."
fi

PROTECTED=(".env" ".git/" "composer.lock" "package-lock.json")
for pattern in "${PROTECTED[@]}"; do
  if [[ "$FILE_PATH" == *"$pattern"* ]]; then
    deny "Blocked: $FILE_PATH is protected ($pattern). Ask the user to change it."
  fi
done

exit 0
```

### `.claude/hooks/format.sh`

```bash
#!/bin/bash
# PostToolUse hook for Edit and Write: format the edited file.
FILE_PATH=$(jq -r '.tool_input.file_path // empty')
cd "$CLAUDE_PROJECT_DIR" || exit 0

case "$FILE_PATH" in
  *.php) ./vendor/bin/pint "$FILE_PATH" ;;
  *.js|*.jsx|*.ts|*.tsx) npx prettier --write "$FILE_PATH" ;;
esac

exit 0
```

### `.claude/hooks/stop-tests.sh`

```bash
#!/bin/bash
# Stop hook: keep Claude working while the test suite fails, once.
INPUT=$(cat)
if [ "$(echo "$INPUT" | jq -r '.stop_hook_active')" = "true" ]; then
  exit 0
fi

cd "$CLAUDE_PROJECT_DIR" || exit 0
if OUTPUT=$(php artisan test); then
  exit 0
fi

LAST_LINES=$(echo "$OUTPUT" | tail -n 20)
jq -n --arg reason "The test suite is failing. Fix the failures before you finish. Last lines: $LAST_LINES" '{decision: "block", reason: $reason}'
exit 0
```

### `~/.claude/settings.json` (personal, Linux)

```json
{
  "hooks": {
    "Notification": [
      {
        "matcher": "permission_prompt",
        "hooks": [
          { "type": "command", "command": "notify-send 'Claude Code' 'Claude Code needs your approval'" }
        ]
      }
    ]
  }
}
```

On macOS, use the hooks guide's `osascript -e 'display notification ...'` command instead.

Make the scripts executable:
```text
chmod +x .claude/hooks/protect-files.sh .claude/hooks/format.sh .claude/hooks/stop-tests.sh
```

What you type to test (no output shown):
```text
echo '{"tool_name":"Edit","tool_input":{"file_path":".env"}}' | .claude/hooks/protect-files.sh
echo $?
add a comment to the .env file
```

---

## Production notes
- Spoken word count is about 1,920 words, roughly 13 to 14 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. All hook files are written for the course. No Claude output is shown; the test slide shows only typed commands.
- The agenda says three parts and the script has three parts (three dividers).
- The three scripts were syntax-checked with bash -n, and protect-files.sh and stop-tests.sh were run against sample JSON (with a stub php) to confirm their JSON output; they were not run inside a Claude Code session.
- The `.env` pattern in protect-files.sh also matches `.env.example`; that is deliberate (ask first), and easy to narrow.
- The Stop hook allows one extra pass (stop_hook_active check, as in the guide's "Stop hook hits the block cap" section); the reference's 8-consecutive-continuation cap is a further backstop.
- Hooks facts (hooks guide, code.claude.com/docs/en/hooks-guide): definition and deterministic control; event table (SessionStart, PreToolUse can block, PostToolUse after success, Notification, Stop); hook types (command, http, mcp_tool, prompt, agent); matchers (Edit|Write, case-sensitive, no matcher fires on every occurrence); stdin JSON with session_id, cwd, hook_event_name, tool_name, tool_input; exit 0 (PreToolUse doesn't approve; normal permission flow), exit 2 (block, stderr reason; some events can't be blocked), JSON output with permissionDecision deny and reason; choose one approach per hook; protect-files example; Prettier PostToolUse example; Notification permission_prompt matcher; notify-send and osascript; Claude can change files via Bash, which Edit|Write doesn't see; scripts must be executable; `$CLAUDE_PROJECT_DIR` in double quotes; `/hooks`; test by piping sample JSON and checking `$?`; Ctrl+O transcript and debug log; PreToolUse fires before permission-mode checks, deny holds in bypassPermissions; allow doesn't bypass deny rules, hooks tighten not loosen; `disableAllHooks`; hook locations table; Stop fires whenever Claude finishes responding.
- Hooks reference (code.claude.com/docs/en/hooks): exit code 2 per event (PostToolUse can't block; SessionStart shows stderr to user); Stop decision control (`decision: "block"`, `reason`); `stop_hook_active`; successful hook stdout goes to the debug log for most events; hooks in skills register on invocation and run for the rest of the session; security disclaimer (full user permissions; review and test); workspace trust (interactive holds back hooks until trust; `-p` runs committed hooks); security best practices (validate inputs, quote variables, block path traversal, absolute paths, skip sensitive files).
- Laravel Pint (laravel.com/docs/pint): "an opinionated PHP code style fixer"; runs on specific files.
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Claude Code Hooks: Make Rules Hold Every Time | Agentic Engineering Ep 20
2. Four Claude Code Hooks Worth Shipping (Protect Files, Format, Tests, Notify) | Ep 20
3. Claude Code Hooks Explained: Events, Matchers, Exit Codes and JSON | Agentic Engineering Ep 20

### Description
```
Episode 20 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we cover Claude Code hooks: shell commands Claude Code runs at lifecycle events, so a rule holds every time instead of relying on the model. We cover events (SessionStart, PreToolUse, PostToolUse, Stop, Notification), matchers, the JSON input on stdin, and the three ways a hook answers: exit 0, exit 2, or JSON output. Then four hooks worth shipping: protect files before edits, format after edits with Pint and Prettier, run tests before Claude stops, and a desktop notification when Claude needs approval. Finally, setting hooks up safely: five setup steps, testing a hook by hand, where hooks live, why a deny can't be bypassed, and the security cautions from the docs.

Note: screens are drawn illustrations. The hook files are written for the course; every hooks fact comes from the official Claude Code hooks guide and reference.

Full text of the hook files:

[paste the two settings.json files and the three scripts from the script here; none contains angle brackets]

Next in the playlist: Episode 21 · MCP Explained and Choosing Servers.
```

### Tags
Claude Code, Claude Code hooks, PreToolUse, PostToolUse, Stop hook, settings.json, Laravel Pint, Prettier, AI coding agents, agentic engineering, developer automation

### Thumbnail text idea
"HOOKS INSIST" in coral, with a small hook icon and "settings.json".

---

## Suggested slide list (Episode 20 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 20 · Hooks |
| 2 | Agenda | Three parts: What hooks are · Worth shipping · Setting up |
| 3 | 01 · What hooks are | Divider |
| 4 | Skill or hook | Guidance vs deterministic |
| 5 | Events worth knowing | SessionStart · PreToolUse · PostToolUse · Stop |
| 6 | Anatomy of a hook | settings.json shape (Illustration) |
| 7 | Input and output | stdin JSON fields (Illustration) |
| 8 | Three ways to answer | exit 0 · exit 2 · JSON |
| 9 | 02 · Hooks worth shipping | Divider |
| 10 | Protect files | protect-files.sh (Illustration) |
| 11 | Format after edits | format.sh (Illustration) |
| 12 | Tests before stopping | stop-tests.sh (Illustration) |
| 13 | Notify me | Notification config (Illustration) |
| 14 | 03 · Setting up hooks | Divider |
| 15 | Five setup steps | Write → chmod +x → Register → /hooks → Test |
| 16 | Test it by hand | Typed commands only (Illustration) |
| 17 | Hooks can't be talked around | Deny wins · Allow can't loosen · disableAllHooks |
| 18 | Where hooks live | User · Project · Local · Skill |
| 19 | Security cautions | Full permissions · Trust · -p |
| 20 | Quote | Skills ask, hooks insist |
| 21 | Recap | Events · answers · four hooks · safe setup |
| 22 | Next | Episode 21 · MCP Explained and Choosing Servers |

---

## Sources
- Hooks guide: https://code.claude.com/docs/en/hooks-guide
- Hooks reference: https://code.claude.com/docs/en/hooks (exit code 2 behavior per event; Stop; hooks in skills and agents; the /hooks menu; disable or remove hooks; security considerations)
- Laravel Pint: https://laravel.com/docs/pint
- Episode 19: /workspace/agentic-course/day20-ep19-script.md.
