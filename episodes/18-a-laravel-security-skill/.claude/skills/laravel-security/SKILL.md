---
name: laravel-security
description: Security rules for Laravel code in this project, from the official Laravel docs. Use when writing, editing, or reviewing controllers, routes, models, form requests, queries, or Blade views.
when_to_use: Adding a route or form, handling user input, writing a database query, rendering user content, adding a login flow, or reviewing a pull request that touches Laravel code.
paths:
  - "app/**/*.php"
  - "routes/**/*.php"
  - "resources/views/**/*.php"
---

Apply these rules to all Laravel code in this task. Treat every request field, header, and uploaded file as untrusted.

## Input and queries
- Validate every request with validation rules or a form request before using its data.
- Pass only validated data to create, update, and fill. Never pass all request input.
- Declare mass assignable attributes with Fillable. Never make a model Unguarded.
- Use the query builder or Eloquent with bindings. Never put user input into raw expressions such as DB::raw, whereRaw, or orderByRaw. If raw SQL is needed, use ? bindings.
- Never let user input choose a column name, including order by columns. Map it against an allow list.

## Output
- Echo data in Blade with {{ }}, which escapes it.
- Never use {!! !!} for content a user supplied.

## Access
- Authorize every action that reads or changes a resource with a policy or gate, for example Gate::authorize('update', $order). Being logged in is not authorization.
- Include @csrf in every POST, PUT, PATCH, or DELETE form. Do not exclude routes from CSRF protection without asking.
- Rate limit login, password reset, and other sensitive routes with the throttle middleware.

## Secrets and configuration
- Never commit .env. Never hard-code keys, passwords, or tokens.
- Keep APP_DEBUG false in production.
- Hash passwords with the Hash facade. Never store or log passwords or tokens in plain text.

## Checks
- Run the test suite after every change, and report the result.
- In your summary, list every security-relevant change: new routes, new queries, changed authorization.

For a review checklist mapped to the OWASP Top 10, see [checklist.md](checklist.md).
