---
name: react-best-practices
description: React conventions for this codebase, from the official react.dev guidance. Use when writing, editing, or reviewing React components or Hooks.
when_to_use: Creating a component, adding state or an Effect, rendering a list, or reviewing a pull request that touches React code.
paths:
  - "src/**/*.jsx"
  - "src/**/*.tsx"
---

Apply these rules to all React code in this task.

## Purity and Hooks
- Keep components and Hooks pure: same inputs, same result, no side effects during render.
- Call Hooks only at the top level of a component or custom Hook: never in loops, conditions, or nested functions, and always before an early return.
- Never define a component inside another component.

## State
- Do not store what you can calculate from props or state. Calculate it during render.
- Do not copy props into state.
- Treat state as read-only. Replace objects and arrays instead of mutating them.

## Effects
- Use an Effect only to synchronize with an external system, such as the network or a browser API.
- Handle user actions in event handlers, not in Effects.
- Do not use an Effect to transform data for rendering.

## Lists
- Give every list item a stable key from the data, such as an id.
- Do not use the array index as a key when items can be added, removed, or reordered. Never generate keys during render.

## Checks
- Run the lint and test scripts after every change, and report the result.

For before and after examples of each rule, see [examples.md](examples.md).
