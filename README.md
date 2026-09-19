# Haven · Ladies PG Management

Laravel 12 / PHP 8.2+ application for MySQL 8 or MariaDB 10.4+, with a responsive Blade interface and visual room/bed allocation. CSS and browser JavaScript are served directly from `public`; no frontend build is required to use the app.

## Local installation

1. Install PHP extensions `pdo_mysql`, `mbstring`, `xml`, `zip`, `gd`, `fileinfo`, `curl`, and `openssl`.
2. Run `composer install`.
3. Copy `.env.example` to `.env`, configure MySQL, and set a unique `ADMIN_PASSWORD` of at least 12 characters. Run `php artisan key:generate`.
4. Create the database: `CREATE DATABASE ladies_pg CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`.
5. Run `php artisan migrate --seed`.
6. Optionally run `php artisan db:seed --class=DemoSeeder` in a local environment. This adds 3 floors, 9 rooms, 30 beds, and 22 fictional residents only if the property is empty. Re-running does not overwrite data.
7. Run `php artisan serve` and open <http://127.0.0.1:8000>.

Sign in with `ADMIN_EMAIL` and `ADMIN_PASSWORD` from `.env`. Seeding never resets an existing account password. Change your password under **Settings** after initial setup. The local workspace has been configured with the `ladies_pg` database; the database user and password are separate from the admin web login.

For XAMPP/Apache, set the virtual host document root to this project's **public** directory. Do not expose the repository root, `.env`, or `storage` as a web root.

## Working with the application

- **Floors / Rooms & Beds:** create dynamic floors and rooms. Capacity generates B1, B2, etc. Individual bed names, positions, reservations, and maintenance status are editable. Capacity can increase; existing beds cannot be removed by reducing capacity, which protects historical records. Archive only empty rooms.
- **Residents:** register personal, emergency, guardian, identity, and stay details. Upload photos and documents to private storage. Search residents by name, phone, room, bed, floor, status, and dates. Profiles show payments, invoices, documents, stays, transfers, and checkout settlements.
- **Room Allocation / PG Floor Plan:** select a floor and click individual beds. Green is available, rose occupied, amber reserved, blue selected, gray maintenance. An occupied bed displays its resident. Confirm a free bed to check in a resident; initial payment is recorded as a security deposit.
- **Transfer:** use the resident profile's Transfer Room action. The prior stay closes and a new one opens atomically; joining date and historical invoices are preserved.
- **Checkout:** enter date, reason, and deductions. Remaining collected deposit is applied to outstanding invoices in chronological order, creating explicit `deposit_adjustment` payment records. The rest becomes the refund due. Any uncovered rent remains pending. The checkout record records the refund obligation; actual cash/bank refund disbursement must be handled operationally. Deductions cannot exceed the remaining deposit.
- **Billing:** generate a month's rent and record partial or full rent payments. Deposits are separate. Payments cannot exceed an invoice's outstanding balance. Fees are editable. Checked-out residents retain all financial history.
- **Documents:** private PDF/image uploads with admin-only preview/download and permanent file deletion. Maximum 10 MB per document, 4 MB per profile photo. Storage is never publicly linked.
- **Notifications:** persistent admin-wide alerts for rent, checkouts, agreement expiry, registrations, and missing documents. Refresh explicitly or use the scheduler. Marking an alert read affects the shared admin inbox. Historical alerts remain available after their underlying condition changes.
- **Reports:** occupancy, individual available beds, floor/room summaries, active/checked-out residents, collections, pending rent, deposits, and stay history. Export actual `.xlsx` or PDF files. Exported spreadsheet values are explicitly text to prevent formula execution.
- **Settings:** property details and administrator password changes.

## Partner accounting

The **Transactions** section keeps four concepts separate: operating profit, property cash, resident security-deposit liability, and partner positions. Existing rent and deposit payments remain canonical in `payments`; each is linked once into `financial_transactions` for the combined history. It is never entered again manually.

- Partner contributions increase property funds and that partner's direct contribution.
- A partner-paid expense increases operating expenses and that partner's invested position, without reducing property cash.
- A business-funded expense increases operating expenses and reduces property cash, without affecting either partner's contribution.
- Security deposits increase property cash and resident liability, but never profit. Refunds reduce both. Deposit applied to rent is an internal reclassification with no new cash inflow.
- Profit withdrawals reduce property cash and the selected partner's remaining entitlement. They are limited by both cumulative operating profit and property funds after deposit liability. Reimbursements are tracked separately from profit withdrawals.
- Optional profit-share percentages are not assumed. Active shares cannot total more than 100%.
- Posted financial records cannot be deleted. Use **Reverse transaction** with a reason; the original and reversal remain visible.

Available reports include partner contributions, expenses, operating income, security deposits, partner withdrawals, and the complete transaction history. All support the existing PDF and Excel exports.

## Billing conventions

Rent is charged as a **full calendar month**, due on the 5th, with no automatic prorating. Generation uses the active allocation's rent and creates at most one invoice per resident and month. A transfer takes effect for later generated invoices; existing invoices are unchanged. Late fees are set by an administrator. Deposit adjustments appear as rent settlements and are identifiable by their payment method.

Run Laravel's scheduler every minute in production:

```cron
* * * * * cd /path/to/ladies-pg && php artisan schedule:run >> /dev/null 2>&1
```

On Windows, create a Task Scheduler task that runs `php artisan schedule:run` every minute with the project as its working directory. Monthly rent is checked daily at 00:10 Asia/Kolkata (also covering newly checked-in residents); alerts refresh hourly.

Manual commands:

```sh
php artisan rent:generate 2026-09
php artisan alerts:refresh
```

## Architecture and integrity

`AllocationService` owns check-in, transfer, and checkout. It locks resident, room, and bed rows inside retryable transactions. The `active_allocations` table has unique resident, bed, and allocation foreign keys. Locking reads avoid stale repeatable-read snapshots in MariaDB, and uniqueness failures produce a friendly validation error. Historical `allocations` are never deleted during checkout or transfer.

`BillingService` serializes billing against resident lifecycle operations, enforces resident/invoice ownership, and prevents overpayment. A unique `(resident_id, month)` index prevents duplicate rent. Room occupancy and effective bed status derive from current allocations, with room closure and bed maintenance/reservation flags handled consistently.

Authentication uses session regeneration, CSRF protection, password hashing, rate limiting, an explicit admin Gate, private responses, and secure file routes. Public self-registration is disabled. Residents, rooms, and document metadata support soft deletion; historical payments and allocations are protected by foreign keys. `created_by` / `updated_by` are recorded for key resident and financial operations.

## Verification

```sh
php artisan test
php vendor/bin/pint --test
```

PHPUnit uses an isolated in-memory SQLite database and never refreshes `ladies_pg`. Coverage includes access control, page rendering, double-allocation prevention, blocked beds, transfer rollback, deposit settlement, duplicate rent, overpayment, file privacy, and PDF/XLSX export.

To exercise **real concurrent MariaDB processes**, run `php tests/mysql-concurrency.php`. It creates a new timestamped `ladies_pg_test_*` database and leaves it for inspection. It verifies both same-bed and same-resident races without modifying the main database.

For browser checks, run `npm install`, start the app on port 8000, then `node tests/browser/smoke.mjs`. This uses a fresh headless Chrome session, tests seeded demo data without changing it, and saves screenshots under `storage/app/qa`. Set `CHROME_PATH` if Chrome is installed elsewhere.

## Production configuration

Use HTTPS, `APP_ENV=production`, `APP_DEBUG=false`, `SESSION_SECURE_COOKIE=true`, a strong application key, and a dedicated database account. Set writable permissions only for `storage` and `bootstrap/cache`. Configure encrypted backups for both the database and private files. Run `php artisan optimize` after deployment. Seed only the admin account in production; demo data is explicitly refused there. Tune upload limits and worker/HTTP timeouts for your deployment. Large report exports currently collect report rows in memory; move exports to queued/chunked jobs for very large installations.
# ladiesPG
# ladiesPG
