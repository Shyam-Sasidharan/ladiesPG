import { chromium } from '@playwright/test';
import fs from 'node:fs/promises';
import assert from 'node:assert/strict';

const env = await fs.readFile('.env', 'utf8');
const value = name => env.match(new RegExp(`^${name}=(.*)$`, 'm'))?.[1].trim().replace(/^"|"$/g, '');
const browser = await chromium.launch({ headless: true, executablePath: process.env.CHROME_PATH || 'C:/Program Files/Google/Chrome/Application/chrome.exe' });
const page = await browser.newPage({ viewport: { width: 1440, height: 1000 } });
const errors = [];
page.on('pageerror', error => errors.push(error.message));
await fs.mkdir('storage/app/qa', { recursive: true });

try {
  await page.goto('http://127.0.0.1:8000/login');
  await page.locator('input[name="email"]').fill(value('ADMIN_EMAIL'));
  await page.locator('input[name="password"]').fill(value('ADMIN_PASSWORD'));
  await page.getByRole('button', { name: 'Sign in to Haven' }).click();
  await page.waitForURL('http://127.0.0.1:8000/');
  for (const path of ['/accounting', '/partners', '/accounting/transactions', '/accounting/transactions/create?kind=expense']) {
    await page.goto(`http://127.0.0.1:8000${path}`);
    assert.equal((await page.locator('body').textContent()).includes('Server Error'), false);
  }
  await page.goto('http://127.0.0.1:8000/accounting');
  await page.screenshot({ path: 'storage/app/qa/accounting-desktop.png', fullPage: true });
  await page.setViewportSize({ width: 390, height: 844 });
  await page.goto('http://127.0.0.1:8000/accounting/transactions/create?kind=expense');
  assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth));
  await page.screenshot({ path: 'storage/app/qa/accounting-mobile.png', fullPage: true });
  assert.deepEqual(errors, []);
  console.log('PASS: accounting summary, partners, history, expense form, desktop rendering, mobile overflow, and JavaScript checks.');
} finally {
  await browser.close();
}
