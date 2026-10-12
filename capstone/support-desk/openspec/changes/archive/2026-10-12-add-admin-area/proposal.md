## Why
Requirement R12 asks for an admin area: admins manage categories and user roles. Categories are archived, never deleted, so old tickets keep them. Decision D2 says the last admin keeps the admin role.

## What Changes
- Admins create, rename and archive categories.
- Archived categories cannot be picked for a new ticket. Existing tickets keep them.
- Admins set each user's role. A change that would leave no admin is refused (D2).
- The sidebar shows Categories and Users to admins only.

## Capabilities

### New Capabilities
- `admin-area`: category management and role management for admins.

### Modified Capabilities
- `customer-tickets`: opening a ticket accepts active categories only.

## Impact
New admin controllers, policies, form requests, two pages and routes under /admin. No new tables: archived_at already exists on categories.
