import { chromium } from '@playwright/test';
import fs from 'node:fs/promises';
import assert from 'node:assert/strict';

const env = await fs.readFile('.env', 'utf8');
const value = name => env.match(new RegExp(`^${name}=(.*)$`, 'm'))?.[1].trim().replace(/^"|"$/g, '');
const browser = await chromium.launch({ headless: true, executablePath: process.env.CHROME_PATH || 'C:/Program Files/Google/Chrome/Application/chrome.exe' });
const page = await browser.newPage({ viewport: { width: 1280, height: 900 } });
const errors = [];
page.on('pageerror', error => errors.push(error.message));

try {
  await page.goto('http://127.0.0.1:8000/login');
  await page.locator('input[name="email"]').fill(value('ADMIN_EMAIL'));
  await page.locator('input[name="password"]').fill(value('ADMIN_PASSWORD'));
  await page.getByRole('button', { name: 'Sign in to Haven' }).click();
  await page.waitForURL('http://127.0.0.1:8000/');
  await page.goto('http://127.0.0.1:8000/residents');
  const vacateLink = page.getByRole('link', { name: 'Vacate' }).first();
  if (await vacateLink.count()) {
    await vacateLink.click();
    const dialog = page.locator('#vacate-dialog');
    if (!await dialog.isVisible()) await page.getByRole('button', { name: 'Vacate / Checkout' }).click();
    await dialog.waitFor({ state: 'visible', timeout: 5000 });
    assert.ok((await dialog.textContent()).includes('Security deposit held'));
    const refund = dialog.locator('[name="refund_security_deposit"][type="checkbox"]');
    assert.ok(await refund.count());
    assert.equal(await refund.isChecked(), false);
    assert.equal(await dialog.locator('[name="refund_amount"]').isVisible(), false);
    await refund.check();
    assert.equal(await dialog.locator('[name="refund_amount"]').isVisible(), true);
  }
  assert.deepEqual(errors, []);
  console.log('PASS: resident list and checkout modal render without JavaScript errors.');
} finally {
  await browser.close();
}
