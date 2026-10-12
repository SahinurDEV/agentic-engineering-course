# Episode 9: on-screen text

Text from the slides and drawn terminal illustrations in this episode's deck (no images). Illustrations were written for the course; they are not recordings of real Claude output.

### Slide 1
Verifying
the Work

Agentic Engineering · Episode 9

A free course on building software with AI agents

### Slide 2
Four

parts

Prove the expiry feature works before it ships.

01

Why verify

Looks done is not done

04

Review, commit

Second opinion, checklist

02

Checks it runs

Tests, lint, build, UI

03

Read the diff

Diff and tests vs the plan

### Slide 3
01

Why
verify

Looks done is not done.

### Slide 4
Looks
done
Is it
done?
Prove
it

The step
people skip

Claude stops when the work looks done.

No check?

you are the loop

Old tests never saw an expired code.

### Slide 5
Give Claude a check

Tests

Types

Lint

Build

Screenshot

Run, read, fix, until it passes

### Slide 6
01

Check in the prompt

Name the commands Claude must run and pass.

02

Evidence, not a claim

The command it ran and what it returned.

Ask for evidence

Fix the root cause. Don't suppress the error.

Whole session? A /goal condition or a Stop hook.

# illustration
> run npm test and the linter.
> fix failures at the root cause.
> show the command and its output.

### Slide 7
02

Read the
diff

Against the plan, line by line.

### Slide 8
~ src/discounts.js
+ if (code.expiresOn &&
+     isPast(code.expiresOn, today)) {
+   return reject("expired")
+ }
~ test/discounts.test.js

Illustration

>_

/diff or
git diff

Read it yourself.

Inside the plan? Nothing extra? No deleted tests or weaker assertions?

### Slide 9
Test the right thing

Passing tests can still test the wrong thing. Check each edge case from the plan.

1

Expired code

Is rejected.

2

Expiry day

Still applies, through the end of the day.

No expiry

Works as before

Timezone?

Missed. Add it to PLAN.md

# illustration: test names
future expiry applies
expired code is rejected
expiry day still applies
no expiry works as before
store timezone decides today

### Slide 10
03

Review
and commit

A second opinion, then commit.

### Slide 11
Illustration
> /code-review
  # then, in a new session:
> review the diff against
  @PLAN.md. look for bugs
  and missed edge cases.

Same session
/code-review

Fresh eyes
new session

Fresh context
New session: no bias
Writer / Reviewer pattern
Or a verification subagent
The worker isn't the grader

Second
opinion

/code-review
Checks the current diff for correctness bugs.

### Slide 12
Manual checks
when it counts

Automated

Tests and type checks
Linter and build
Screenshot for UI

Covers most of it.

By hand

Money
Logins
User data

Apply an expired
code in the app

Money?
By hand
/verify confirms the change against the running app.

### Slide 13
Verify

checklist

Run it before every commit. All four, every time.

01

Green

Checks pass, evidence seen

04

Reviewed

Risky parts by hand

02

Diff read

Against PLAN.md

03

Edge cases

Tests that would fail

### Slide 14
01

Commit with a message

Ask Claude for a descriptive commit message.

02

Tick the plan

Mark the step done in PLAN.md.

Then commit

Only after the checklist is complete.

Done means checked, not just written.

# illustration
> commit with a descriptive message
- [x] 5 review the diff, commit
# feature done

### Slide 15
“

“Green tests are evidence, not proof. Done means you checked.”

The mental model for verifying

### Slide 16
Episode 9

Recap

Give Claude a check, read the work yourself, then commit.

01

Checks
it runs

Tests, lint, build, evidence

02

Read
the diff

Diff and tests vs the plan

03

Review
and commit

Second opinion, checklist

### Slide 17
CLAUDE.md Explained

Next in the playlist

The file that tells Claude how your project works.

EPISODE 10

Subscribe and turn on notifications for the playlist.

