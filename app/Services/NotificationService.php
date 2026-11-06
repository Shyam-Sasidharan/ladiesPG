<?php

namespace App\Services;

use App\Models\PgNotification;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\ResidentDocument;

class NotificationService
{
    public function refresh(): void
    {
        // 1 Day Before Due Date Reminder (Automatically alerts 1 day in advance)
        RentRecord::with('resident', 'payments')->whereDate('due_date', today()->addDay())->chunkById(100, function ($records) {
            foreach ($records as $r) {
                if ($r->pending > 0 && $r->resident) {
                    $this->add(
                        'rent-reminder-1day-'.$r->id.'-'.$r->due_date->toDateString(),
                        'reminder',
                        'Rent Due Tomorrow: '.$r->resident->full_name,
                        'Advance Reminder: Monthly rent of INR '.number_format($r->pending, 2).' for '.$r->month->format('F Y').' is due tomorrow ('.$r->due_date->format('d M Y').'). Resident: '.$r->resident->full_name.($r->resident->mobile ? ' ('.$r->resident->mobile.')' : ''),
                        route('billing.index', ['q' => $r->resident->full_name])
                    );
                }
            }
        });

        // Due Today Reminder
        RentRecord::with('resident', 'payments')->whereDate('due_date', today())->chunkById(100, function ($records) {
            foreach ($records as $r) {
                if ($r->pending > 0 && $r->resident) {
                    $this->add(
                        'rent-due-today-'.$r->id.'-'.$r->due_date->toDateString(),
                        'warning',
                        'Rent Due Today: '.$r->resident->full_name,
                        'Monthly rent of INR '.number_format($r->pending, 2).' for '.$r->month->format('F Y').' is due today ('.$r->due_date->format('d M Y').'). Resident: '.$r->resident->full_name.($r->resident->mobile ? ' ('.$r->resident->mobile.')' : ''),
                        route('billing.index', ['q' => $r->resident->full_name])
                    );
                }
            }
        });

        // Overdue Rent Alert
        RentRecord::with('resident', 'payments')->whereDate('due_date', '<', today())->chunkById(100, function ($records) {
            foreach ($records as $r) {
                if ($r->pending > 0 && $r->resident) {
                    $this->add(
                        'overdue-'.$r->id,
                        'overdue',
                        'Rent overdue: '.$r->resident->full_name,
                        'INR '.number_format($r->pending, 2).' outstanding for '.$r->month->format('F Y'),
                        route('billing.index', ['q' => $r->resident->full_name])
                    );
                }
            }
        });

        Resident::whereIn('status', ['active', 'notice_period'])->whereBetween('expected_checkout', [today(), today()->addDays(30)])->chunkById(100, function ($residents) {
            foreach ($residents as $r) {
                $this->add('checkout-'.$r->id.'-'.$r->expected_checkout->toDateString(), 'checkout', 'Upcoming checkout: '.$r->full_name, 'Expected on '.$r->expected_checkout->format('d M Y').'. The bed may become available.', route('residents.show', $r));
            }
        });

        Resident::whereIn('status', ['active', 'notice_period'])->whereDoesntHave('documents')->chunkById(100, function ($residents) {
            foreach ($residents as $r) {
                $this->add('documents-'.$r->id, 'documents', 'Documents pending: '.$r->full_name, 'Add ID proof and required resident documents.', route('residents.show', $r));
            }
        });

        Resident::where('created_at', '>=', now()->subDays(7))->chunkById(100, function ($residents) {
            foreach ($residents as $r) {
                $this->add('registration-'.$r->id, 'registration', 'Welcome '.$r->full_name, 'New resident registered on '.$r->created_at->format('d M Y'), route('residents.show', $r));
            }
        });

        ResidentDocument::with('resident')->where('type', 'agreement')->whereBetween('expires_at', [today(), today()->addDays(30)])->chunkById(100, function ($documents) {
            foreach ($documents as $d) {
                $this->add('agreement-'.$d->id.'-'.$d->expires_at, 'agreement', 'Agreement expiring: '.$d->resident->full_name, 'Expiry date: '.$d->expires_at, route('residents.show', $d->resident_id));
            }
        });
    }

    private function add(string $key, string $type, string $title, string $message, string $url): void
    {
        PgNotification::firstOrCreate(['key' => $key], compact('type', 'title', 'message', 'url'));
    }
}
