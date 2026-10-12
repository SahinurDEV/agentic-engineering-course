# Day 23 · Episode 22: Setting Up Playwright MCP

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 8:00 (plan: about 7)
**Format:** faceless: slides + drawn terminal and file graphics + AI voiceover, no presenter on screen
**Covers (Module 9 lesson):** Setting up Playwright MCP

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `.mcp.json`, the local override command, the `settings.json` deny rule and the verification prompt are **written for this course** (full text under "Example files"). Playwright MCP facts come only from the Claude Code MCP docs (code.claude.com/docs) and the official Playwright MCP README (github.com/microsoft/playwright-mcp). No Claude output and no browser output is shown: tool names appear only as names.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment |
|---|---|---|
| 0:00–0:20 | [VOICEOVER + SLIDE] | Hook |
| 0:20–0:45 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) |
| 0:45–2:30 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 1 · Installing |
| 2:30–4:45 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Configuring |
| 4:45–7:00 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Verifying the cart |
| 7:00–7:45 | [VOICEOVER + SLIDE] | Recap + CTA |

---

## Script

### 0:00–0:20 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode was M C P: what it is, how scopes work, and four questions to ask before you connect any server.
> Today we connect one: the Playwright server, which gives Claude a browser. Then we use it to check a real change in the cart project.

**Visual / B-roll:**
- Episode 21 recap panel, then the title card.

### 0:20–0:45 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-two: setting up Playwright M C P.

*Cue: agenda slide "Three parts"*
> Three parts. First, installing the server. Second, configuring it: headed or headless, profiles, and snapshots versus screenshots. Third, using it to verify a U I change in the cart. Everything on screen is an illustration, and the facts come from the Claude Code docs and the official Playwright M C P readme.

**Visual / B-roll:**
- Three items: 01 Installing · 02 Configuring · 03 Verifying the cart.

### 0:45–2:30 · Part 1: Installing
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "01 · Installing"*
> Part one. Installing.

*Cue: two columns "Before and after"*
> Without a browser, Claude can change your front end, but it can't see the result. You open the page, you look, and you describe what's wrong.
> The Claude Code docs describe Playwright M C P as a server that gives Claude a browser it can navigate, click, and read. It needs no account. It runs through n p x, so you need Node version eighteen or later.

*Cue: squares "Add, check, use"*
> Setup is three steps. Add it, with claude M C P add, the name playwright, a double dash, then n p x, dash y, and the package name, at playwright slash M C P, at latest. There's no transport flag, because local servers use stdio by default.
> Check it, with claude M C P list. The docs warn the first check can say failed to connect while n p x downloads the package. Wait a moment and run it again.
> Then use it: ask for a task that needs the browser.

*Cue: panel "MCP or CLI?"*
> One honest note from the readme. The Playwright team also offers a command line tool with skills, and says it can be more token efficient for coding agents. M C P suits loops that need a persistent browser and rich page structure. We cover the M C P server, but the choice exists.

*Cue: two points "Share it with the team"*
> The command adds the server at local scope, just for you. To share it, put it in the project's dot M C P dot JSON instead. The docs' own example shows the entry: type stdio, command n p x, and the same arguments.
> Each teammate approves it the first time they open the project.

**Visual / B-roll:**
- Two columns: You look and describe vs Claude opens the page.
- Squares: Add · Check · Use.
- Panel: CLI vs MCP, from the readme.
- Two points + Illustration: command vs .mcp.json entry.

### 2:30–4:45 · Part 2: Configuring
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Configuring"*
> Part two. Configuring.

*Cue: drawn terminal "Options go in args"*
> You configure the server with options added after the package name in args. A few from the readme. Headless runs with no window. Browser picks chrome, firefox, webkit, or edge. Viewport size sets the size in pixels. Device emulates a phone. Isolated keeps the profile in memory. Output dir sets where screenshots are saved. And config points to a J SON file when the list gets long.

*Cue: four numbered "Headed or headless"*
> Headed or headless. The readme says the browser is headed by default, and the Claude Code docs say a browser window opens so you can watch it work.
> Headless runs with no window. That suits machines with no display.
> A headless browser also closes after an idle hour. A headed one doesn't.
> And the Docker image only supports headless chromium for now.

*Cue: phone ".mcp.json for the cart"*
> Here's the cart's dot M C P dot JSON, written for this course. Playwright, with isolated, a viewport of twelve eighty by seven twenty, so every teammate sees the same layout, and an output folder for screenshots.
> Why isolated? By default the server uses a persistent profile, and the readme says all the logged in information is stored there. For testing, a fresh profile each session is cleaner.
> And if you want headless just for yourself, add a local-scope server with the same name. Local wins over project, so only your setup changes.

*Cue: flow "Core tools"*
> The server exposes tools whose names start with browser. The core loop looks like this. Navigate to a U R L. Take a snapshot of the page. Click or type, using a reference from that snapshot. Wait for text to appear. And take a screenshot when you want a picture.
> There are more, like console messages, plus extra groups you opt into with the caps option.

*Cue: card "Snapshots vs screenshots"*
> This is the most important idea in the episode. Snapshots versus screenshots.
> A snapshot is the page's accessibility tree: roles, names, and text, with a reference for each element. The readme says the server works from that structure, not pixels, so it needs no vision model. Its own description says a snapshot is better than a screenshot.
> A screenshot is an image. The tool description is blunt: you can't perform actions based on the screenshot. Use it as evidence for you, and save it to a file.
> So, act on snapshots, and keep screenshots as proof.

**Visual / B-roll:**
- Monitor + Illustration: option names only.
- Four numbered: Headed · Headless · Idle · Docker.
- Phone + Illustration: .mcp.json.
- Flow: Navigate → Snapshot → Click → Wait → Screenshot.
- Card + Illustration: snapshot vs screenshot.

### 4:45–7:00 · Part 3: Verifying the cart
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Verifying the cart"*
> Part three. Verifying a U I change in the cart. The Claude Code docs suggest exactly this: point it at your local dev server to check that a page still renders after a change.

*Cue: four numbered "Four steps"*
> Four steps.
> One, run the cart's dev server yourself. In this example, it's at localhost, port three thousand.
> Two, ask Claude to check one specific change.
> Three, Claude reads the page through snapshots, and the console for errors.
> Four, keep a screenshot as evidence, and keep your tests. A browser check adds to tests. It doesn't replace them.

*Cue: plan "The prompt"*
> Here's the prompt, written for this course. The change is the save ten discount code from earlier in the series. It says: use playwright to open the cart, add one item, apply the code save ten, and check that the total drops by ten percent. Use snapshots to read the page. Save a screenshot as save ten check dot P N G, and report any console errors.
> It names the server, the page, the steps, the result, and the evidence.

*Cue: two points "Read the page, check the console"*
> Two checks matter most. The total, read from a snapshot as text. And the console, because a page can look right and still log errors. On screen are only tool names. No real output is shown.

*Cue: drawn terminal "Guardrails"*
> Now, guardrails. The core tools include one called browser run code unsafe. The readme says it runs arbitrary JavaScript in the server process, and calls it remote code execution equivalent.
> You don't need it to check a cart. So the project settings, written for this course, add a deny rule for that one tool name, using the M C P naming from last episode.

*Cue: panel "Not a security boundary"*
> And the readme says it plainly: Playwright M C P is not a security boundary. Even the allowed origins option, it says, does not serve as one.
> So keep it on your own dev server, use isolated profiles for testing, and remember last episode: pages are external content, and external content can carry prompt injection.

**Visual / B-roll:**
- Four numbered: Run · Ask · Read · Keep.
- Plan + Illustration: the prompt.
- Two points + Illustration: tool names only.
- Monitor + Illustration: deny rule.
- Panel: not a security boundary.

### 7:00–7:45 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The line to remember: act on snapshots, keep screenshots as proof.

*Cue: recap slide*
> Recap. Add Playwright with claude M C P add, check it with claude M C P list, and share it through dot M C P dot JSON. Configure it with options in args: headed by default, headless when there's no display, isolated for clean test sessions. Claude acts through snapshots of the accessibility tree, and screenshots are for you. And to verify a change, run your dev server, ask for one specific check, read the console, and deny the unsafe code tool.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-three: spec-driven development and Open Spec. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 23 · Spec-Driven Development and OpenSpec".

---

## Example files (written for the course)

All blocks are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. The dev server address (`http://localhost:3000`) and the cart steps are illustrative.

### Command: add the server (from the Claude Code MCP quickstart)

```text
claude mcp add playwright -- npx -y @playwright/mcp@latest
claude mcp list
```

### `.mcp.json` (cart project root, committed)

```json
{
  "mcpServers": {
    "playwright": {
      "type": "stdio",
      "command": "npx",
      "args": [
        "-y",
        "@playwright/mcp@latest",
        "--isolated",
        "--viewport-size",
        "1280x720",
        "--output-dir",
        "playwright-output"
      ]
    }
  }
}
```

Add `playwright-output/` to `.gitignore` so screenshots aren't committed.

### Command: personal headless override (local scope, same name, so it wins over the project entry for you only)

```text
claude mcp add playwright -- npx -y @playwright/mcp@latest --headless --isolated --viewport-size 1280x720 --output-dir playwright-output
```

### `.claude/settings.json` (cart project, committed)

```json
{
  "permissions": {
    "deny": [
      "mcp__playwright__browser_run_code_unsafe"
    ]
  }
}
```

### Verification prompt (typed in a Claude Code session)

```text
Use playwright to open http://localhost:3000, add one item to the cart, apply the code SAVE10, and check that the total drops by 10 percent. Use snapshots to read the page. Save a screenshot as save10-check.png and report any console errors.
```

---

## Production notes
- Spoken word count is about 1,220 words, roughly 8 to 8.5 minutes (plan target about 7) at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. No Claude output and no browser output is shown; only tool names appear (the Claude Code docs say tool calls are labeled with the server name and the action, like `browser_navigate`).
- The agenda says three parts and the script has three parts (three dividers).
- Claude Code docs facts (mcp-quickstart): Playwright gives Claude a browser it can navigate, click and read, needs no account, runs through npx, Node.js 18 or later; `claude mcp add playwright -- npx -y @playwright/mcp@latest`; no `--transport` because local servers default to stdio; `-y` installs without prompting; first `claude mcp list` can show Failed to connect while npx downloads; `--browser firefox` example; a browser window opens so you can watch it work; point it at your local dev server to check that a page still renders after a change; `.mcp.json` entry with type stdio, command npx, args. MCP page: local scope default, project approval, local wins over project, `mcp__server__tool` names.
- Playwright MCP README facts: accessibility snapshots, no vision models, not pixel-based; CLI+SKILLS note (more token-efficient for coding agents; MCP for persistent state and rich introspection); options `--headless` (headed by default), `--browser` (chrome, firefox, webkit, msedge), `--viewport-size`, `--device` (example "iPhone 15"), `--isolated`, `--output-dir`, `--config`, `--caps` (vision, pdf, devtools), `--idle-timeout` (one hour for headless, never for headed), `--allowed-origins` (does not serve as a security boundary); persistent profile by default stores logged-in information; Docker supports headless chromium only; tools `browser_navigate`, `browser_snapshot` ("better than screenshot"), `browser_click`, `browser_type`, `browser_wait_for`, `browser_take_screenshot` ("You can't perform actions based on the screenshot"), `browser_console_messages`, `browser_network_requests`, `browser_run_code_unsafe` ("RCE-equivalent"); "Playwright MCP is not a security boundary."
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. Setting Up Playwright MCP in Claude Code: Give Claude a Browser | Agentic Engineering Ep 22
2. Playwright MCP: Headless vs Headed, Snapshots vs Screenshots | Ep 22
3. Verify UI Changes with Claude Code and Playwright MCP | Agentic Engineering Ep 22

### Description
```
Episode 22 of Agentic Engineering, a free course on building real software with AI coding agents.

We install the Playwright MCP server in Claude Code with claude mcp add, check it with claude mcp list, and share it through .mcp.json. Then we configure it: options in args, headed vs headless, isolated profiles, and the key idea of snapshots vs screenshots. Finally, we use it to verify a UI change in the cart project, read the console, and add a deny rule for the unsafe code tool.

Note: screens are drawn illustrations; no Claude or browser output is shown. The examples are written for the course; facts come from the Claude Code docs and the official Playwright MCP README.

Example files:

[paste the commands, .mcp.json, settings.json and prompt from the script here; none contain angle brackets]

Next in the playlist: Episode 23 · Spec-Driven Development and OpenSpec.
```

### Tags
Claude Code, Playwright MCP, Playwright, MCP, Model Context Protocol, claude mcp add, headless browser, accessibility snapshot, UI testing, AI coding agents, agentic engineering

### Thumbnail text idea
"GIVE CLAUDE A BROWSER" in coral, with a drawn browser window icon.

---

## Suggested slide list (Episode 22 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 22 · Setting Up Playwright MCP |
| 2 | Agenda | Three parts: Installing · Configuring · Verifying the cart |
| 3 | 01 · Installing | Divider |
| 4 | Before and after | You describe vs Claude opens the page |
| 5 | Add, check, use | Three steps |
| 6 | MCP or CLI? | README note |
| 7 | Share it with the team | Command vs .mcp.json (Illustration) |
| 8 | 02 · Configuring | Divider |
| 9 | Options go in args | Option names (Illustration) |
| 10 | Headed or headless | Headed · Headless · Idle · Docker |
| 11 | .mcp.json for the cart | Course file (Illustration) |
| 12 | Core tools | Navigate → Snapshot → Click → Wait → Screenshot |
| 13 | Snapshots vs screenshots | (Illustration) |
| 14 | 03 · Verifying the cart | Divider |
| 15 | Four steps | Run · Ask · Read · Keep |
| 16 | The prompt | Course prompt (Illustration) |
| 17 | Read the page, check the console | Tool names only (Illustration) |
| 18 | Guardrails | Deny rule (Illustration) |
| 19 | Not a security boundary | README cautions |
| 20 | Quote | Act on snapshots |
| 21 | Recap | Install · configure · snapshots · verify |
| 22 | Next | Episode 23 · Spec-Driven Development and OpenSpec |

---

## Sources
- Claude Code MCP quickstart: https://code.claude.com/docs/en/mcp-quickstart (Add a local server; Edit .mcp.json) · MCP: https://code.claude.com/docs/en/mcp · Permissions: https://code.claude.com/docs/en/permissions
- Playwright MCP README: https://github.com/microsoft/playwright-mcp (Configuration, User profile, Security, Tools) · Playwright: https://playwright.dev
- Episode 21: /workspace/agentic-course/day22-ep21-script.md.
