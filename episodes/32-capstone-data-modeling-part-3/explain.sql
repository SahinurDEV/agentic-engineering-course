-- The queries R3 to R6 will run, on the volume copy.
analyze tickets, replies, internal_notes;
select id as customer from users where email = 'c77@example.test' \gset
select id as busy_agent from users where email = 'a3@example.test' \gset
select id as new_agent from users where email = 'new-agent@example.test' \gset
select id as new_category from categories where name = 'New category' \gset
select max(id) as ticket from tickets \gset

-- R4 inbox, newest first
explain analyze select * from tickets order by id desc limit 25;
-- R3 one customer's tickets
explain analyze select * from tickets where customer_id = :customer order by id desc limit 25;
-- R5 filters: a common status, a busy agent, a new agent, a new category
explain analyze select * from tickets where status = 'open' order by id desc limit 25;
explain analyze select * from tickets where assignee_id = :busy_agent order by id desc limit 25;
explain analyze select * from tickets where assignee_id = :new_agent order by id desc limit 25;
explain analyze select * from tickets where category_id = :new_category order by id desc limit 25;
-- A ticket's replies, in order
explain analyze select * from replies where ticket_id = :ticket order by id;
-- R6 search, first with or, then with union
explain analyze select * from tickets where to_tsvector('english', subject) @@ plainto_tsquery('english', 'refund') or exists (select 1 from replies where replies.ticket_id = tickets.id and to_tsvector('english', body) @@ plainto_tsquery('english', 'refund')) order by id desc limit 25;
explain analyze select * from tickets where id in (select id from tickets where to_tsvector('english', subject) @@ plainto_tsquery('english', 'refund') union select ticket_id from replies where to_tsvector('english', body) @@ plainto_tsquery('english', 'refund')) order by id desc limit 25;
