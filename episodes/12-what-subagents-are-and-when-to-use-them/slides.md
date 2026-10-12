# Episode 12: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
What Subagents Are
and When to Use Them

Agentic Engineering · Episode 12

A free course on building software with AI agents

### Slide 2
Four

parts

Hand off the noisy work, and keep your main session clean.

01

What it is

Its own context and tools

04

When to use

And when not to

02

Built-ins

Explore, Plan, general-purpose

03

Why it helps

Clean context, focus, parallel

### Slide 3
01

What is a
subagent

Its own context, its own tools.

### Slide 4
Own
context window
Own
prompt and tools
Returns
a summary

Its own
context

A specialized assistant Claude can hand a task to.

Its reading

stays in its context

Files it read and output it saw never reach your session.

### Slide 5
How delegation works

You ask

Delegates

It works

Summary

Continue

Picked by its description

### Slide 6
The built-in ones

Claude Code ships with subagents it uses automatically when they fit.

E

Explore

Fast, read-only search. No Write or Edit.

P

Plan

Read-only research in plan mode.

General

general-purpose: explores and edits

Note

Explore, Plan skip CLAUDE.md

# ask for one by name
> use the Explore subagent
  to find where discount
  codes are validated
# Explore: quick, medium,
  or very thorough

Illustration

### Slide 7
02

Why it
helps

A clean main context.

### Slide 8
With and
without

Without

Reads cart.js, discounts.js
Reads checkout and tests
All of it stays in context

Your session carries it all, every turn.

With a subagent

Reading happens elsewhere
A short list comes back
Main context stays clean

"Discounts apply in
these three places"

Only the
summary
The subagent keeps the noise. You get the answer.

### Slide 9
Why subagents

help

Four benefits the docs call out.

01

Context

Exploration stays out of main

04

Parallel

Independent research at once

02

Constraints

Limit which tools it can use

03

Specialize

A focused system prompt

### Slide 10
03

When to
use one

And when to stay in the main chat.

### Slide 11
Verbose
output
Self-
contained
Parallel
research

Use a
subagent when

You want the result, not the noise.

Also:

tool restrictions

Research across many files, reviews, focused repeat jobs.

### Slide 12
01

Test logs

Run the suite in a subagent. Get only the failures back.

02

Parallel research

Separate areas, explored at once. Best when paths don't depend.

Cart examples

Every result returns to your main context.

Many long reports still fill it. Ask for short summaries.

> use a subagent to run npm test
  and report only failing tests
> research cart, discounts and
  checkout in parallel subagents

Illustration

### Slide 13
Keep it in the main

chat

A question about this conversation? /btw is lighter.

01

Back-and-forth

Frequent refinement

04

Latency

A fresh subagent starts cold

02

Shared context

Plan, build, test together

03

Quick change

A typo, a rename

### Slide 14
“

“Send out the work you don’t need to watch. Keep the work you need to steer.”

The mental model for subagents

### Slide 15
Episode 12

Recap

Delegate the noisy, self-contained work. Steer the rest yourself.

01

What
it is

Own context, prompt, tools

02

Why it
helps

Clean context, focus, parallel

03

When to
use one

Verbose, self-contained work

### Slide 16
Building a Subagent
(plus a Reviewer)

Next in the playlist

We write our own for the cart project.

EPISODE 13

Subscribe and turn on notifications for the playlist.

