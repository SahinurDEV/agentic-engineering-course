---
name: grill-me
description: Interviews you about a feature, plan, or requirements before any code is written, then writes a spec to SPEC.md.
argument-hint: "[feature]"
disable-model-invocation: true
---

Interview me about this feature before anything is built: $ARGUMENTS

Rules for the whole interview:
- If no feature was given above, first ask what we are building.
- Ask with the AskUserQuestion tool, one question at a time.
- Skip obvious questions. Dig into the hard parts I might not have considered: technical implementation, UI/UX, edge cases, concerns, and tradeoffs.
- Read the relevant code first, so questions are about this codebase, not software in general.
- If an answer is vague, ask a follow-up before moving on.
- Do not edit any code during the interview.

Keep interviewing until we've covered everything. Then:
1. Summarize the decisions as a short list and ask me to confirm.
2. Write a complete spec to SPEC.md, following spec-template.md.
3. Stop, and tell me to start a fresh session to implement it.

## Additional resources
- Areas to cover: see [question-areas.md](question-areas.md)
- Spec structure: see [spec-template.md](spec-template.md)
