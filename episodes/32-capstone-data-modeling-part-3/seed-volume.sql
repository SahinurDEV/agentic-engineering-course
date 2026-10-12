-- Fake volume for EXPLAIN, local database only. Never commit or run in production.
insert into users (name, email, password, role, created_at, updated_at)
select 'Customer ' || g, 'c' || g || '@example.test', 'x', 'customer', now(), now()
from generate_series(1, 20000) g;

insert into users (name, email, password, role, created_at, updated_at)
select 'Agent ' || g, 'a' || g || '@example.test', 'x', 'agent', now(), now()
from generate_series(1, 20) g;

insert into categories (name, created_at, updated_at)
select 'Category ' || g, now(), now() from generate_series(1, 10) g;

-- 100,000 tickets: 3% open, mostly closed, 80% assigned; 1 in 2,000 mentions a refund
insert into tickets (subject, description, category_id, status, priority, customer_id, assignee_id, created_at, updated_at)
select
  'w' || (random() * 5000)::int || ' w' || (random() * 5000)::int || ' w' || (random() * 5000)::int
    || case when g % 2000 = 0 then ' refund' else '' end,
  'Fake ticket',
  (select min(id) from categories) + g % 10,
  case when g % 100 < 3 then 'open' when g % 100 < 8 then 'pending'
       when g % 100 < 15 then 'resolved' else 'closed' end,
  case when g % 50 = 0 then 'urgent' when g % 10 < 2 then 'high'
       when g % 10 < 4 then 'low' else 'normal' end,
  (select min(id) from users where role = 'customer') + g % 20000,
  case when g % 5 = 0 then null else (select min(id) from users where role = 'agent') + g % 20 end,
  now(), now()
from generate_series(1, 100000) g;

-- 3 replies per ticket; about 1 in 1,000 tickets has a reply asking about refunds
insert into replies (ticket_id, author_id, body, created_at, updated_at)
select t.id, t.customer_id,
  'w' || (random() * 5000)::int || ' w' || (random() * 5000)::int || ' w' || (random() * 5000)::int
    || case when t.id % 997 = 0 and r = 2 then ' refunds' else '' end,
  now(), now()
from tickets t cross join generate_series(1, 3) r;

insert into internal_notes (ticket_id, author_id, body, created_at, updated_at)
select id, assignee_id, 'Fake note', now(), now() from tickets where id % 3 = 0;

-- A new agent and a new category, each on the two oldest tickets: rare values
insert into users (name, email, password, role, created_at, updated_at)
values ('New Agent', 'new-agent@example.test', 'x', 'agent', now(), now());
insert into categories (name, created_at, updated_at) values ('New category', now(), now());
update tickets
set assignee_id = (select id from users where email = 'new-agent@example.test'),
    category_id = (select id from categories where name = 'New category')
where id in (select id from tickets order by id limit 2);

analyze users, categories, tickets, replies, internal_notes;
