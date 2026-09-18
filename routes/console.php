<?php

use App\Services\BillingService;
use App\Services\NotificationService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('rent:generate {month?}', function () {
    $month = $this->argument('month') ?? now()->format('Y-m');
    if (! preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $month)) {
        $this->error('Month must be YYYY-MM.');

        return 1;
    }
    $count = app(BillingService::class)->generate($month);
    $this->info("Generated {$count} rent records.");
})->purpose('Generate monthly rent without duplicates');
Schedule::command('rent:generate')->dailyAt('00:10')->withoutOverlapping();
Artisan::command('alerts:refresh', function () {
    app(NotificationService::class)->refresh();
    $this->info('Alerts refreshed.');
});
Schedule::command('alerts:refresh')->hourly()->withoutOverlapping();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
