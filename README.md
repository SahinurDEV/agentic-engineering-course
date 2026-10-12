# Agentic Engineering: a free course on building real software with AI coding agents

Course files for **Agentic Engineering**, a free YouTube course by Sahinur Islam on building real software with AI coding agents, mainly Claude Code, while keeping solid engineering habits: clear specs, careful review and real verification.

**Watch the full playlist:** https://www.youtube.com/playlist?list=PLM2JVG76fh54

## What's in this repo

| Folder | What it holds |
|---|---|
| [`episodes/`](episodes) | One folder per episode: a README with the YouTube link, plus the files that episode shows (prompts, commands, CLAUDE.md files, skills, subagents, hooks, MCP and OpenSpec files, workflows, code) and the on-screen slide text. |
| [`capstone/support-desk/`](capstone/support-desk) | The final source of the capstone app built in Episodes 28 to 34: a Support Desk on Laravel 13, React (Inertia) and PostgreSQL, with its OpenSpec specs and archived changes. |
| [`scripts/`](scripts) | The narration script for every episode, plus the course plan. |

Most terminal views in the course are drawn illustrations written for the course, not recordings of real Claude output. Example files such as the cart project's skills and specs were written for the course.

## Episodes

| # | Episode | Week | Folder | Video |
|---|---|---|---|---|
| Trailer | What this free course is | 1 | [`00-trailer`](episodes/00-trailer) | [Watch](https://youtu.be/1lkAm6ZspcA) |
| 1 | From Autocomplete to Agent | 1 | [`01-from-autocomplete-to-agent`](episodes/01-from-autocomplete-to-agent) | [Watch](https://youtu.be/w3Ro1zJjPYo) |
| 2 | Claude Code 101 | 1 | [`02-claude-code-101`](episodes/02-claude-code-101) | [Watch](https://youtu.be/x61uhVLDFnc) |
| 3 | Claude Code Controls | 1 | [`03-claude-code-controls`](episodes/03-claude-code-controls) | [Watch](https://youtu.be/X4NmRgLPyII) |
| 4 | A Real Claude Code Session | 1 | [`04-a-real-claude-code-session`](episodes/04-a-real-claude-code-session) | [Watch](https://youtu.be/2EjT0-BteGI) |
| 5 | Context Management Basics | 1 | [`05-context-management-basics`](episodes/05-context-management-basics) | [Watch](https://youtu.be/-Z0QUvC4k3A) |
| 6 | Controlling Context and Writing Good Prompts | 1 | [`06-controlling-context-and-writing-good-prompts`](episodes/06-controlling-context-and-writing-good-prompts) | [Watch](https://youtu.be/mfKn2AdcpNc) |
| 7 | The Core Workflow and Planning | 2 | [`07-the-core-workflow-and-planning`](episodes/07-the-core-workflow-and-planning) | [Watch](https://youtu.be/JCVFpqgKEB0) |
| 8 | Executing the Plan | 2 | [`08-executing-the-plan`](episodes/08-executing-the-plan) | [Watch](https://youtu.be/PVAREvbcsTw) |
| 9 | Verifying the Work | 2 | [`09-verifying-the-work`](episodes/09-verifying-the-work) | [Watch](https://youtu.be/CXUeae6XEds) |
| 10 | CLAUDE.md Explained | 2 | [`10-claude-md-explained`](episodes/10-claude-md-explained) | [Watch](https://youtu.be/vfwujH96JMk) |
| 11 | Generating and Maintaining CLAUDE.md | 2 | [`11-generating-and-maintaining-claude-md`](episodes/11-generating-and-maintaining-claude-md) | [Watch](https://youtu.be/91ayHXfDvQE) |
| 12 | What Subagents Are and When to Use Them | 2 | [`12-what-subagents-are-and-when-to-use-them`](episodes/12-what-subagents-are-and-when-to-use-them) | [Watch](https://youtu.be/xaaBu89_d68) |
| 13 | Building a Subagent (plus a Reviewer) | 2 | [`13-building-a-subagent-plus-a-reviewer`](episodes/13-building-a-subagent-plus-a-reviewer) | [Watch](https://youtu.be/OpVRnecyUCY) |
| 14 | Introduction to Skills | 3 | [`14-introduction-to-skills`](episodes/14-introduction-to-skills) | [Watch](https://youtu.be/rjdjxHxK6yk) |
| 15 | Running a Skill | 3 | [`15-running-a-skill`](episodes/15-running-a-skill) | [Watch](https://youtu.be/sXb2s2MfRoo) |
| 16 | The "Grill Me" Skill | 3 | [`16-the-grill-me-skill`](episodes/16-the-grill-me-skill) | [Watch](https://youtu.be/BG_hwGaok1g) |
| 17 | A React Best Practices Skill | 3 | [`17-a-react-best-practices-skill`](episodes/17-a-react-best-practices-skill) | [Watch](https://youtu.be/yS6tCtExXFk) |
| 18 | A Laravel Security Skill | 3 | [`18-a-laravel-security-skill`](episodes/18-a-laravel-security-skill) | [Watch](https://youtu.be/5FtQcIkYoX0) |
| 19 | Database Skills and Writing Your Own | 3 | [`19-database-skills-and-writing-your-own`](episodes/19-database-skills-and-writing-your-own) | [Watch](https://youtu.be/ms_sgaG5jxw) |
| 20 | Hooks | 3 | [`20-hooks`](episodes/20-hooks) | [Watch](https://youtu.be/hu01cRMJ_0U) |
| 21 | MCP Explained and Choosing Servers | 3 | [`21-mcp-explained-and-choosing-servers`](episodes/21-mcp-explained-and-choosing-servers) | [Watch](https://youtu.be/LsesoYD5lXg) |
| 22 | Setting Up Playwright MCP | 3 | [`22-setting-up-playwright-mcp`](episodes/22-setting-up-playwright-mcp) | [Watch](https://youtu.be/t9TorbIF3gc) |
| 23 | Spec-Driven Development and OpenSpec | 4 | [`23-spec-driven-development-and-openspec`](episodes/23-spec-driven-development-and-openspec) | [Watch](https://youtu.be/wrB6eCUfNCM) |
| 24 | Building a New Feature from a Spec | 4 | [`24-building-a-new-feature-from-a-spec`](episodes/24-building-a-new-feature-from-a-spec) | [Watch](https://youtu.be/GCgcpqNzErU) |
| 25 | Changing a Feature with a Spec | 4 | [`25-changing-a-feature-with-a-spec`](episodes/25-changing-a-feature-with-a-spec) | [Watch](https://youtu.be/bT6COQmUq5M) |
| 26 | GitHub Integration | 4 | [`26-github-integration`](episodes/26-github-integration) | [Watch](https://youtu.be/Uf0Cd4yLU8o) |
| 27 | Parallel Development with Conductor | 4 | [`27-parallel-development-with-conductor`](episodes/27-parallel-development-with-conductor) | [Watch](https://youtu.be/P_lRFov85xM) |
| 28 | Capstone, the Project and Requirements | 5 | [`28-capstone-the-project-and-requirements`](episodes/28-capstone-the-project-and-requirements) | [Watch](https://youtu.be/8-ZL9ZS7B4Q) |
| 29 | Capstone, Project Setup | 5 | [`29-capstone-project-setup`](episodes/29-capstone-project-setup) | [Watch](https://youtu.be/5ObriNv95Dk) |
| 30 | Capstone, Data Modeling Part 1 | 5 | [`30-capstone-data-modeling-part-1`](episodes/30-capstone-data-modeling-part-1) | [Watch](https://youtu.be/4bHT3o-6k4U) |
| 31 | Capstone, Data Modeling Part 2 | 5 | [`31-capstone-data-modeling-part-2`](episodes/31-capstone-data-modeling-part-2) | [Watch](https://youtu.be/BaxrtXVKT7k) |
| 32 | Capstone, Data Modeling Part 3 | 5 | [`32-capstone-data-modeling-part-3`](episodes/32-capstone-data-modeling-part-3) | [Watch](https://youtu.be/v5Em3SsfmNI) |
| 33 | Capstone, Core Features Part 1 | 5 | [`33-capstone-core-features-part-1`](episodes/33-capstone-core-features-part-1) | [Watch](https://youtu.be/xxufoTeH3ro) |
| 34 | Capstone, Core Features Part 2 | 5 | [`34-capstone-core-features-part-2`](episodes/34-capstone-core-features-part-2) | [Watch](https://youtu.be/lN4gnV8FdVs) |
| 35 | Field Notes and Wrap-Up (Course Finale) | 5 | [`35-field-notes-and-wrap-up-course-finale`](episodes/35-field-notes-and-wrap-up-course-finale) | [Watch](https://youtu.be/Ogh-VqvSFNw) |

## Using the files

- Files inside an episode folder keep their project paths (for example `.claude/skills/laravel-security/SKILL.md`), so you can copy them into your own project in place.
- Files under `user-level/` go in your home folder (`~/.claude/...`).
- The capstone app has its own [README](capstone/README.md) with setup steps.

## License

Code and config files are released under the [MIT License](LICENSE). The narration scripts and slide text are shared so you can follow along; please link back to the course if you reuse them.
