# Episode 21: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
MCP Explained

Agentic Engineering · Episode 21

And how to choose servers you can trust

### Slide 2
Three

parts

Connect Claude Code to the tools outside your project.

01

What MCP
is

Roles, primitives, transports

02

Adding
servers

Add, scopes, cost

03

Choosing
servers

Four questions

### Slide 3
01

What MCP
is

An open standard.

### Slide 4
Before and
after MCP

Without

You copy data from a tool
Paste it into chat
Claude works from that

Docs: connect when you keep copying data in.

With MCP

A server connects the tool
Claude reads it directly
And can act on it

Paste, or
connect

Like
USB-C
One standard way to plug in.

### Slide 5
The AI app

Claude Code is one

One per server

Keeps the connection

Provides context

A database, browser, API

Host, client, server

Host

Client

Server

### Slide 6
Tools
functions to act
Resources
data, via @
Prompts
as slash commands

What a server
offers

Three primitives in the protocol.

Tools

take action

Resources and prompts give context and templates.

### Slide 7
01

stdio

A local process on your machine.

02

Streamable HTTP

A remote server at a URL, with HTTP auth.

Two transports

Docs: use HTTP for remote servers.

SSE is deprecated.

# two shapes
--transport http
--transport stdio
sse: deprecated

Illustration

### Slide 8
02

Adding
servers

Add, scope, sign in.

### Slide 9
http   ... claude-code-docs URL
local  ... playwright -- npx ...
list   claude mcp list
get    claude mcp get github
in     /mcp

Illustration

>_

claude mcp
add

From your terminal.

Typed commands only, no output. -- passes the rest to the server.

Illustration

### Slide 10
Three

scopes

Same name in two places? Local wins.

01

Local

Default. You, here

04

Order

Local, project, user

02

Project

.mcp.json, committed

03

User

You, all projects

### Slide 11
# .mcp.json
"claude-code-docs"
"github"
${CART_GITHUB_TOKEN}

Shared servers
committed file
secrets in env

written for the course

.mcp.json

Project scope, shared with the team.

Secret?

${VAR}

Use your own variable name. Approve on first use.

Illustration

### Slide 12
From add to use

Add

/mcp

Sign in

Tools?

Ask

OAuth tokens stored and refreshed

### Slide 13
Output limits
warn: 10,000 tokens
max: 25,000 default
MAX_MCP_OUTPUT_TOKENS
big results still cost

Unused?
toggle it off
in /mcp
 
Kept,
not connected

Tool search
On by default
Names load first
Definitions later
Small cost per server

Server
costs

Context
Every tool definition and result uses it.

Illustration

### Slide 14
03

Choosing
servers

Criteria, not favorites.

### Slide 15
Four questions

to ask

Ask them of any server, before you connect.

01

Need

You keep copying data

04

Cost

Context, and risk

02

Trust

Who wrote it?

03

Access

The least it needs

### Slide 16
Trust first

Docs: verify you trust each server before connecting it.

O

Your own

Or a trusted provider.

D

Directory

Reviewed, not audited.

Injection

external content risk

Repo

approve project servers

# before connecting
who wrote it?
what does it fetch?
what can it change?
unsure: skip it

Illustration

### Slide 17
01

Database

A read-only user, so queries can’t modify data.

02

GitHub

A fine-grained token, for chosen repos only.

Least privilege

Both examples come from the docs.

Read-only if reading is enough.

# least access
--dsn ...readonly...
fine-grained token
one repo, one project

Illustration

### Slide 18
name   mcp__server__tool
one    mcp__github__*
all    mcp__* (deny, ask)
hook   matcher mcp__.*
off    toggle in /mcp

Illustration

>_

Control the
tools

Rules use tool names.

Allow, ask or deny, like Bash. Hooks match them too.

Illustration

### Slide 19
Scopes
local and user
Plugins
bring servers
Connectors
from claude.ai

Review every
scope

.mcp.json doesn’t show every server.

Check

/mcp

With -p, project servers load without asking.

### Slide 20
“

“Every server is a new pair of hands.”

Check whose hands they are.

### Slide 21
Episode 21

Recap

An open standard connecting AI apps to external systems.

01

Tools, resources,
prompts

Over stdio or HTTP

02

Three
scopes

Secrets in env vars

03

Four
questions

Need, trust, access, cost

### Slide 22
Setting Up
Playwright MCP

Next in the playlist

Episode 22 gives Claude a browser.

EPISODE 22

Subscribe and turn on notifications for the playlist.

