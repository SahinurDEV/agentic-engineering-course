## Why
"Done" needs an archived spec for every requirement. R1 (register, sign in, reset a password) came with the starter kit in Episode 29 and its tests already pass, but openspec/specs has no spec for it.

## What Changes
- Write down R1 as it already works. No code changes.
- Each scenario is covered by a starter kit test in tests/Feature/Auth.

## Capabilities

### New Capabilities
- `accounts`: register, sign in, sign out and reset a password.

### Modified Capabilities
None.

## Impact
Specs only. Roles for new sign-ups stay in user-roles.
