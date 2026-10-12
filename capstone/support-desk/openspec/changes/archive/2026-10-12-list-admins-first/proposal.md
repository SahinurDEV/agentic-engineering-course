## Why
The phone-width browser check found the users page sorted by name only. With a thousand demo customers, the admins sat on a late page, so the last-admin rule was hard to reach.

## What Changes
- The users page lists admins first, then agents, then customers, each by name.

## Capabilities

### New Capabilities
None.

### Modified Capabilities
- `admin-area`: the users page order.

## Impact
One order clause in the admin user controller and one feature test.
