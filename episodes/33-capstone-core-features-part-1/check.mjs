import { chromium } from 'playwright-core';
const base = 'http://127.0.0.1:8123';
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
  await page.screenshot({ path: `/workspace/capstone-throwaway/pw/${name}.png`, fullPage: true });
  results.push({ name, url: page.url(), overflow });
}
await session('demo-customer@example.test', async (page) => {
  await page.goto(base + '/tickets'); await check(page, 'c-my-tickets');
  await page.goto(base + '/tickets/create'); await check(page, 'c-new-ticket');
  await page.fill('#subject', 'Cannot download invoice');
  await page.click('#category_id'); await page.getByRole('option', { name: 'Billing' }).click();
  await page.fill('#description', 'The download button does nothing.');
  await page.getByRole('button', { name: 'Open ticket' }).click();
  await page.waitForURL(/\/tickets\/\d+$/); await check(page, 'c-ticket');
  await page.fill('#body', 'Tried again in another browser.');
  await page.getByRole('button', { name: 'Send reply' }).click();
  await page.getByText('Tried again in another browser.').waitFor();
  results.push({ replyShown: true, bodyCleared: (await page.inputValue('#body')) === '' });
  const inbox = await page.goto(base + '/inbox'); results.push({ customerInboxStatus: inbox.status() });
});
await session('demo-agent@example.test', async (page) => {
  await page.goto(base + '/inbox'); await check(page, 'a-inbox');
  await page.getByLabel('Status').click(); await page.getByRole('option', { name: 'pending' }).click();
  await page.waitForURL(/status=pending/); await check(page, 'a-inbox-pending');
  await page.goto(base + '/inbox?assignee=none'); await check(page, 'a-inbox-unassigned');
  await page.getByRole('link', { name: 'Next' }).click(); await page.waitForURL(/page=2/); results.push({ page2: page.url() });
  await page.goto(base + '/inbox'); await page.locator('ul a').first().click();
  await page.waitForURL(/\/tickets\/\d+$/); await check(page, 'a-ticket');
});
console.log(JSON.stringify(results, null, 1));
await browser.close();
