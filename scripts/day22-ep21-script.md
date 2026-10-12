# Day 22 · Episode 21: MCP Explained and Choosing Servers

**Series:** Agentic Engineering (free YouTube course) · Week 3
**Presenter:** Sahinur Islam, full-stack software engineer (first-person narration via AI voiceover)
**Target length:** about 10:00
**Format:** faceless: slides + drawn terminal graphics + AI voiceover, no presenter on screen
**Covers (Module 9 lessons):** Introduction to MCP, Choosing MCP Servers

**Markers:** `[VOICEOVER + SLIDE]` = full-screen slide with voiceover · `[VOICEOVER + SCREEN]` = full-screen terminal or file view with voiceover. Every terminal or file view is a **drawn graphic** with a coral "Illustration" corner tag, not a screen recording. The `.mcp.json` file and the commands below are **written for this course** (full text under "Example files"), based on examples in the Claude Code MCP docs. MCP facts come only from the Claude Code docs (code.claude.com/docs) and modelcontextprotocol.io. The only servers named are ones the official docs use as examples; naming them is not an endorsement. No Claude output is shown.

**Voiceover note:** only the lines inside the `>` quote blocks go to the text-to-speech tool. Lines marked *Cue:* between them are edit instructions and are not spoken.

---

## Run sheet (overview)

| Time | Marker | Segment | Lesson |
|---|---|---|---|
| 0:00–0:30 | [VOICEOVER + SLIDE] | Hook | n/a |
| 0:30–1:00 | [VOICEOVER + SLIDE] | Intro + roadmap (three parts) | n/a |
| 1:00–3:30 | [VOICEOVER + SLIDE] | Part 1 · What MCP is | Introduction to MCP |
| 3:30–6:30 | [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE] | Part 2 · Adding and managing servers | Introduction to MCP |
| 6:30–9:15 | [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN] | Part 3 · Choosing servers | Choosing MCP Servers |
| 9:15–10:00 | [VOICEOVER + SLIDE] | Recap + CTA | n/a |

---

## Script

### 0:00–0:30 · Hook
**Marker:** [VOICEOVER + SLIDE]

**Say:**
> Last episode we wrote hooks: shell commands Claude Code runs every time, so a rule really holds.
> Skills and hooks shape how Claude works inside your project. Today we look outward: how Claude reaches the tools outside it, like your issue tracker, your database, or a browser. That's MCP.

**Visual / B-roll:**
- Episode 20 recap panel, then the title card.

### 0:30–1:00 · Intro + roadmap
**Marker:** [VOICEOVER + SLIDE]

*Cue: title slide*
> I'm Shah-hee-noor, a full-stack software engineer, and this is Agentic Engineering, episode twenty-one: M C P explained, and choosing servers.

*Cue: agenda slide "Three parts"*
> Three parts. First, what M C P is. Second, adding and managing servers in Claude Code: the command, the scopes, and what they cost. Third, how to choose a server you can trust. Everything on screen is an illustration, and every fact comes from the Claude Code docs and the official M C P site.

**Visual / B-roll:**
- Three items: 01 What MCP is · 02 Adding servers · 03 Choosing servers.

### 1:00–3:30 · Part 1: What MCP is
**Marker:** [VOICEOVER + SLIDE]

*Cue: divider "01 · What MCP is"*
> Part one. What M C P is.

*Cue: two columns "Before and after MCP"*
> The official site defines it in one line: M C P, the Model Context Protocol, is an open-source standard for connecting A I applications to external systems. It compares M C P to a U S B C port: one standard way to plug things in.
> The Claude Code docs give the moment you need it. Connect a server when you find yourself copying data into chat from another tool, like an issue tracker or a monitoring dashboard. Once it's connected, Claude can read and act on that system directly, instead of working from what you paste.

*Cue: squares "Host, client, server"*
> The protocol has three roles.
> The host is the A I application, and Claude Code is one. The host creates one client for each server it connects to.
> The client keeps that one connection open.
> And the server is a program that provides context: it might wrap a database, a browser, or a company's A P I.

*Cue: panel "What a server offers"*
> A server can offer three main things, which the protocol calls primitives.
> Tools: functions Claude can call to take an action, like running a query or calling an A P I.
> Resources: data that gives context, like a file or a record. In Claude Code, you can type the at sign to reference them.
> And prompts: reusable templates. Claude Code lists a server's prompts as slash commands.

*Cue: two points "Two transports"*
> And there are two standard ways to connect. Standard input and output, or stdio, is for a local server that Claude Code starts as a process on your machine. Streamable H T T P is for a remote server at a U R L, and it supports standard H T T P authentication.
> The Claude Code docs recommend H T T P for remote servers. There's also an older S S E transport, which the docs mark as deprecated, so use H T T P where you can.

**Visual / B-roll:**
- Two columns: Copy and paste vs Claude reads it directly.
- Squares: Host · Client · Server.
- Panel: Tools · Resources · Prompts.
- Two points + Illustration: stdio and HTTP.

### 3:30–6:30 · Part 2: Adding and managing servers
**Marker:** [VOICEOVER + SCREEN] / [VOICEOVER + SLIDE]

*Cue: divider "02 · Adding servers"*
> Part two. Adding and managing servers.

*Cue: drawn terminal "claude mcp add"*
> You add a server from your terminal, outside a session, with claude M C P add.
> For a remote server, pass transport H T T P, a name you choose, and the U R L. The docs' quickstart uses the Claude Code documentation server, a hosted server with search over the docs that needs no sign-in, so it's a safe first test.
> For a local server, put a double dash after Claude's own options, then the command that starts the server. Everything after the double dash goes to the server untouched. The quickstart's local example is the Playwright server, which gives Claude a browser. That's the next episode.
> Then claude M C P list shows each server with a health status, and get and remove do what they say. Inside a session, slash M C P shows the same.
> On screen are only the commands I'd type. No output is shown.

*Cue: four numbered "Three scopes"*
> Every server has a scope, and it decides who gets it.
> Local is the default. It loads only in the current project, stays private to you, and lives in your home folder's dot claude dot JSON file. The docs suggest it for servers with credentials you don't want in version control.
> Project scope writes to a file called dot M C P dot JSON at the project root, which you commit so the whole team gets the same servers.
> User scope is private to you, but loads in all your projects.
> If the same name is defined in more than one place, local wins over project, and project wins over user.

*Cue: phone ".mcp.json"*
> Here's a project dot M C P dot JSON written for this course. Two servers: the docs server, and GitHub's remote server, the docs' example for code reviews.
> GitHub needs a token, and the token must not go in the repository. So the header uses environment variable expansion: dollar sign, curly brace, and a variable name. Each teammate sets that variable on their own machine. One detail from the docs: Claude Code deliberately reads some credential variable names as empty when they're sent to a remote server, so use a name of your own.
> And when a teammate opens the project, Claude Code asks them to approve project servers before using them, in an interactive session.

*Cue: flow "From add to use"*
> Here's the flow from add to use. Add the server. Open slash M C P. If it needs a sign-in, the docs say to use slash M C P and follow the steps in your browser. Claude Code supports OAuth, stores the tokens, and refreshes them for you. Then check that the tools show up, and just ask, in plain words.

*Cue: card "What servers cost"*
> Servers aren't free. Every tool definition is context.
> The docs say tool search is on by default. It defers tool definitions until Claude needs them, so only tool names and server instructions load at the start of a session. That keeps the cost of adding servers small.
> Tool results are the other cost. Claude Code warns when an M C P tool's output passes ten thousand tokens, and limits it to twenty-five thousand by default. You can raise that with the max M C P output tokens environment variable, but a server that returns huge results will still eat your context.
> And if you don't need a server in this project, toggle it off in slash M C P. It stays configured, but Claude Code stops connecting to it.

**Visual / B-roll:**
- Monitor + Illustration: typed `claude mcp add` commands only.
- Four numbered: Local · Project · User · Precedence.
- Phone + Illustration: .mcp.json.
- Flow: Add → /mcp → Sign in → Tools → Ask.
- Card + Illustration: tool search and output limits.

### 6:30–9:15 · Part 3: Choosing servers
**Marker:** [VOICEOVER + SLIDE] / [VOICEOVER + SCREEN]

*Cue: divider "03 · Choosing servers"*
> Part three. Choosing servers. I won't give you a list of favorite servers. I'll give you four questions to ask about any server.

*Cue: four numbered "Four questions"*
> One, do you need it? The signal is the one from the docs: you keep copying data in from that tool.
> Two, do you trust who wrote it?
> Three, what's the least access it needs?
> And four, what does it cost in context, and in risk? Let's take the middle two in detail.

*Cue: plan "Trust first"*
> Trust. The docs give a direct warning: verify you trust each server before connecting it. And the security page encourages either writing your own M C P servers, or using servers from providers you trust.
> There's a directory of reviewed connectors. But read the fine print: the docs say they're reviewed against listing criteria before being listed, but Anthropic does not security audit or manage any M C P server.
> And servers that fetch external content, like web pages or issue comments, can expose you to prompt injection. Text written by someone else ends up in front of Claude.

*Cue: two points "Least privilege"*
> Least access. The docs' own examples show the habit.
> For a database, their example connects with a read-only database user, so the queries Claude runs can't modify data.
> For GitHub, they use a fine-grained personal access token, limited to the repositories you want Claude to work with.
> Ask the same of every server: read-only if reading is enough, and a token scoped to one project.

*Cue: drawn terminal "Control the tools"*
> You can also control the tools after you connect. M C P tools have names that start with M C P, two underscores, the server name, then the tool. Permission rules use those names, so you can allow, ask, or deny one server's tools, just like Bash commands.
> And hooks match them too, so last episode's pre tool use hooks can guard M C P calls as well.

*Cue: panel "Review every scope"*
> One last caution. The security page notes that reviewing dot M C P dot JSON doesn't show every server a session can load. Servers can also come from your other scopes, from plugins, and from claude dot A I connectors. So check what's actually connected in slash M C P.
> And for project servers in a repository you didn't write, read dot M C P dot JSON before you approve it. In non-interactive runs with the p flag, the docs say Claude Code loads project servers without asking.

**Visual / B-roll:**
- Four numbered: Need · Trust · Least access · Cost.
- Plan + Illustration: trust checklist lines.
- Two points + Illustration: read-only DSN, fine-grained token.
- Monitor + Illustration: permission rule names only.
- Panel: .mcp.json · other scopes · plugins · connectors.

### 9:15–10:00 · Recap + CTA
**Marker:** [VOICEOVER + SLIDE]

*Cue: quote slide*
> The mental model for this episode: every server you connect is a new pair of hands in your project. Check whose hands they are.

*Cue: recap slide*
> Recap. M C P is an open standard that connects A I applications to external systems, through servers that offer tools, resources, and prompts, over stdio or H T T P. You add servers with claude M C P add, at local, project, or user scope, and share project servers through dot M C P dot JSON, with secrets in environment variables. Tool search keeps the context cost low, but big outputs still cost. And before you connect anything, ask four questions: do you need it, do you trust it, what's the least access it needs, and what does it cost.

*Cue: next-episode slide*
> Next in the playlist is episode twenty-two: setting up Playwright M C P. I'm Shah-hee-noor. Subscribe and turn on notifications so you don't miss it.

**Visual / B-roll:**
- Quote card, recap card, next-episode card "Episode 22 · Setting Up Playwright MCP".

---

## Example files (written for the course)

Both blocks are free of `<` and `>` characters, so they can be pasted into the YouTube description as they are. The Claude Code docs write their syntax lines with angle-bracket placeholders (for example a name and a URL in angle brackets); these examples use real values or CAPITALS placeholders instead.

### `.mcp.json` (project root, committed)

```json
{
  "mcpServers": {
    "claude-code-docs": {
      "type": "http",
      "url": "https://code.claude.com/docs/mcp"
    },
    "github": {
      "type": "http",
      "url": "https://api.githubcopilot.com/mcp/",
      "headers": {
        "Authorization": "Bearer ${CART_GITHUB_TOKEN}"
      }
    }
  }
}
```

Each teammate sets `CART_GITHUB_TOKEN` to their own fine-grained GitHub personal access token, limited to this repository. The variable name is our own on purpose: the docs say Claude Code reads some credential variable names as empty in a remote server's URL and headers.

### Commands (typed in your terminal; no output shown)

```text
claude mcp add --transport http claude-code-docs https://code.claude.com/docs/mcp
claude mcp add playwright -- npx -y @playwright/mcp@latest
claude mcp add --transport stdio db -- npx -y @bytebase/dbhub --dsn "postgresql://readonly:PASSWORD@localhost:5432/cart"
claude mcp list
claude mcp get github
claude mcp remove db
```

Inside a session:
```text
/mcp
```

Permission rule names (illustrative):
```text
mcp__github__*
mcp__db__*
```

---

## Production notes
- Spoken word count is about 1,560 words, roughly 10 to 11 minutes at a steady TTS pace with slide pauses.
- No recording: every terminal and file view is a drawn graphic with a coral "Illustration" corner tag. The `.mcp.json`, the `db` server name and the `cart` database are illustrative. No Claude output is shown.
- The agenda says three parts and the script has three parts (three dividers).
- Servers named are only those the official docs use as examples: the Claude Code documentation server and Playwright (MCP quickstart), GitHub and DBHub (MCP page, practical examples). Naming them is not an endorsement. The Anthropic Directory is mentioned without naming any listing.
- MCP facts (modelcontextprotocol.io): open-source standard for connecting AI applications to external systems; USB-C analogy (intro). Host, client (one per server), server; primitives tools, resources, prompts; stdio and Streamable HTTP transports, HTTP supports standard auth (architecture).
- Claude Code facts (code.claude.com/docs/en/mcp and /mcp-quickstart): connect when copying data into chat; `claude mcp add` with `--transport http`, HTTP recommended for remote, SSE deprecated; stdio with `--` separator; quickstart docs server needs no auth; Playwright local example; `claude mcp list` health status, `get`, `remove`, `/mcp`; scopes local (default, `~/.claude.json`, current project, private; for credentials), project (`.mcp.json`, committed), user (`~/.claude.json`, all projects); precedence local, project, user; env var expansion `${VAR}` and `${VAR:-default}` in url and headers; credential variables read as empty toward remote servers, use your own name; interactive approval prompt for project servers; `-p` loads project servers without asking; OAuth 2.0 via `/mcp`, tokens stored and refreshed; tool search on by default, only names and server instructions at start; output warning at 10,000 tokens, default max 25,000, `MAX_MCP_OUTPUT_TOKENS`; disable a server in `/mcp` without removing it; resources via `@`; prompts as slash commands; "Verify you trust each server"; prompt injection risk for servers fetching external content; GitHub fine-grained PAT; DBHub with read-only user. Security page: write your own or use trusted providers; Directory reviewed against listing criteria, not security-audited; reviewing `.mcp.json` doesn't show every server. Permissions page: `mcp__server__*` rule names. Hooks: MCP tools matchable (`mcp__.*`).
- Generate the voiceover from the `>` quote blocks only, then cut the slides to it.

---

## YouTube metadata

### Title options
1. MCP Explained for Claude Code, and How to Choose Servers You Can Trust | Agentic Engineering Ep 21
2. Claude Code MCP: Transports, Scopes, .mcp.json and Context Cost | Ep 21
3. What Is MCP? Connecting Claude Code to Your Tools Safely | Agentic Engineering Ep 21

### Description
```
Episode 21 of Agentic Engineering, a free course on building real software with AI coding agents.

In this episode we explain the Model Context Protocol (MCP): hosts, clients and servers; the tools, resources and prompts a server offers; and the stdio and HTTP transports. Then we add and manage servers in Claude Code with claude mcp add, the local, project and user scopes, a shared .mcp.json with secrets in environment variables, sign-in through /mcp, and what servers cost in context (tool search, output limits). Finally, four questions for choosing any server: do you need it, do you trust it, what is the least access it needs, and what does it cost.

Note: screens are drawn illustrations. The examples are written for the course; facts come from the Claude Code docs and modelcontextprotocol.io. Servers named are examples from the official docs, not endorsements.

Example files:

[paste the .mcp.json and commands from the script here; neither contains angle brackets]

Next in the playlist: Episode 22 · Setting Up Playwright MCP.
```

### Tags
Claude Code, MCP, Model Context Protocol, MCP servers, claude mcp add, .mcp.json, MCP scopes, tool search, AI coding agents, agentic engineering, AI security

### Thumbnail text idea
"MCP: CHOOSE WISELY" in coral, with a small plug icon.

---

## Suggested slide list (Episode 21 deck)

| # | Slide | Content |
|---|---|---|
| 1 | Title | Episode 21 · MCP Explained and Choosing Servers |
| 2 | Agenda | Three parts: What MCP is · Adding servers · Choosing servers |
| 3 | 01 · What MCP is | Divider |
| 4 | Before and after MCP | Copy and paste vs read directly |
| 5 | Host, client, server | Three roles |
| 6 | What a server offers | Tools · Resources · Prompts |
| 7 | Two transports | stdio · HTTP (Illustration) |
| 8 | 02 · Adding servers | Divider |
| 9 | claude mcp add | Typed commands only (Illustration) |
| 10 | Three scopes | Local · Project · User · Precedence |
| 11 | .mcp.json | Course file (Illustration) |
| 12 | From add to use | Add → /mcp → Sign in → Tools → Ask |
| 13 | What servers cost | Tool search · output limits (Illustration) |
| 14 | 03 · Choosing servers | Divider |
| 15 | Four questions | Need · Trust · Least access · Cost |
| 16 | Trust first | Trusted source · Directory · Injection (Illustration) |
| 17 | Least privilege | Read-only user · Fine-grained token (Illustration) |
| 18 | Control the tools | mcp__server__* rule names (Illustration) |
| 19 | Review every scope | .mcp.json · scopes · plugins · connectors |
| 20 | Quote | New pair of hands |
| 21 | Recap | Protocol · scopes · cost · four questions |
| 22 | Next | Episode 22 · Setting Up Playwright MCP |

---

## Sources
- Claude Code MCP: https://code.claude.com/docs/en/mcp · quickstart: https://code.claude.com/docs/en/mcp-quickstart
- Security: https://code.claude.com/docs/en/security (MCP security) · Permissions: https://code.claude.com/docs/en/permissions · Hooks: https://code.claude.com/docs/en/hooks-guide
- MCP: https://modelcontextprotocol.io/docs/getting-started/intro · https://modelcontextprotocol.io/docs/learn/architecture
- Episode 20: /workspace/agentic-course/day21-ep20-script.md.
