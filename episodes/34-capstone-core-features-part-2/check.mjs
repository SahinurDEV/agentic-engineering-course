import { chromium } from 'playwright-core';
const base = 'http://127.0.0.1:8123';
const shots = '/workspace/capstone-throwaway/pw/ep34';
const browser = await chromium.launch({ executablePath: '/usr/bin/google-chrome', headless: true });
const results = [];
async function session(email, steps) {
  const ctx = await browser.newContext({ viewport: { width: 390, height: 844 } });
  const page = await ctx.newPage();
  const errors = [];
  page.on('pageerror', e => errors.push(String(e)));
  page.on('console', m => { if (m.type() === 'error') errors.push(m.text()); });
  await page.goto(base + '/login');
  await page.fill('#email', email);
  await page.fill('#password', 'demo-password-123');
  await page.click('button[type=submit]');
  await page.waitForURL(u => !u.pathname.startsWith('/login'));
  await steps(page);
  results.push({ email, errors });
  await ctx.close();
}
async function check(page, name) {
  await page.waitForLoadState('networkidle');
  const overflow = await page.evaluate(() => document.documentElement.scrollWidth - window.innerWidth);
  await page.screenshot({ path: `${shots}/${name}.png`, fullPage: true });
  results.push({ name, url: page.url(), overflow });
}
let ticketUrl;
await session('demo-agent@example.test', async (page) => {
  await page.goto(base + '/inbox');
  await page.getByLabel('Search tickets').fill('invoice');
  await page.getByRole('button', { name: 'Search' }).click();
  await page.waitForURL(/q=invoice/); await check(page, 'a-search');
  results.push({ searchRows: await page.locator('ul a').count() });
  await page.locator('ul a').first().click();
  await page.waitForURL(/\/tickets\/\d+$/); ticketUrl = page.url();
  await page.fill('#note', 'Checked the logs. Download link expired.');
  await page.getByRole('button', { name: /note/i }).click();
  await page.getByText('Checked the logs. Download link expired.').first().waitFor();
  await page.click('#status'); await page.getByRole('option', { name: 'closed' }).click();
  await page.getByRole('button', { name: 'Save changes' }).click();
  await page.getByText(/changed status/).first().waitFor();
  await check(page, 'a-ticket-managed');
  results.push({ agentSeesNotes: await page.getByRole('region', { name: 'Internal notes' }).count() });
});
await session('demo-customer@example.test', async (page) => {
  await page.goto(ticketUrl); await check(page, 'c-closed-ticket');
  results.push({
    closedMessage: await page.getByText('Closed tickets take no replies.').count(),
    customerSeesNote: await page.getByText('Checked the logs. Download link expired.').count(),
    replyBox: await page.locator('#body').count(),
    manageForm: await page.getByRole('form', { name: 'Manage ticket' }).count(),
  });
  const admin = await page.goto(base + '/admin/categories'); results.push({ customerAdminStatus: admin.status() });
});
await session('demo-admin@example.test', async (page) => {
  await page.goto(base + '/admin/categories'); await check(page, 'ad-categories');
  const name = 'Returns ' + Date.now().toString().slice(-4);
  await page.fill('#new-category', name);
  await page.getByRole('button', { name: 'Create' }).click();
  await page.getByText(name, { exact: true }).waitFor();
  const row = page.locator('li', { hasText: name });
  await row.getByRole('button', { name: 'Archive' }).click();
  await row.getByText('archived').waitFor();
  await check(page, 'ad-categories-archived');
  await page.goto(base + '/admin/users'); await check(page, 'ad-users');
  const me = page.locator('li', { hasText: 'demo-admin@example.test' });
  await me.getByRole('combobox').click(); await page.getByRole('option', { name: 'agent' }).click();
  await me.getByRole('button', { name: 'Save' }).click();
  await me.getByText('There must always be at least one admin.').waitFor();
  await check(page, 'ad-users-last-admin');
  results.push({ lastAdminRefused: true });
  await page.locator('[data-sidebar=trigger]').first().click();
  await page.getByRole('link', { name: 'Users' }).first().waitFor();
  results.push({ sidebarLinks: { categories: await page.getByRole('link', { name: 'Categories' }).count(), users: await page.getByRole('link', { name: 'Users' }).count() } });
  await check(page, 'ad-sidebar');
});
console.log(JSON.stringify(results, null, 1));
await browser.close();
