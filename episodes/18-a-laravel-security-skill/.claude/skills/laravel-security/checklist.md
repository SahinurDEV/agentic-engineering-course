# Laravel security review checklist

Use this when asked to review code. For each finding, give the file, the line, the rule it breaks, and a suggested fix.

## Broken access control (OWASP A01:2025)
- Does every route that reads or changes a record authorize the current user with a policy or gate?
- Can a user change an id in the URL and reach someone else's order?
- Does every POST, PUT, PATCH, or DELETE form include @csrf?

## Security misconfiguration (OWASP A02:2025)
- Is APP_DEBUG false for production?
- Is .env in .gitignore and absent from the commit?

## Injection (OWASP A05:2025)
- Is any raw expression built from request input?
- Is any column or sort field taken from the request without an allow list?
- Does any view echo user content with {!! !!}?

## Authentication failures (OWASP A07:2025)
- Are login and password reset routes rate limited?
- Are passwords hashed with the Hash facade, and never stored, logged, or returned in plain text?

## Mass assignment
- Does every create, update, or fill call receive validated data only?
- Is any model marked Unguarded?
