<?php

namespace App\Http\Controllers;

use App\Models\PgNotification;
use App\Models\PgSetting;
use App\Models\ResidentDocument;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function settings()
    {
        return view('settings', ['settings' => PgSetting::first() ?? new PgSetting(['name' => 'SJ Ladies Hostel'])]);
    }

    public function saveSettings(Request $r)
    {
        $data = $r->validate(['name' => 'required|string|max:150', 'phone' => 'nullable|string|max:20', 'email' => 'nullable|email|max:255', 'address' => 'nullable|string|max:2000', 'notes' => 'nullable|string|max:5000']);
        PgSetting::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Property details updated.');
    }

    public function notifications(Request $r)
    {
        return view('notifications', ['notifications' => PgNotification::when($r->boolean('unread'), fn ($q) => $q->whereNull('read_at'))->latest()->paginate(20)->withQueryString()]);
    }

    public function refreshNotifications(NotificationService $service)
    {
        $service->refresh();

        return back()->with('success', 'Alerts refreshed.');
    }

    public function readNotification(PgNotification $notification)
    {
        $notification->update(['read_at' => now()]);

        return back()->with('success', 'Notification marked as read.');
    }

    public function documents(Request $r)
    {
        $documents = ResidentDocument::with('resident')->when($r->q, fn ($q) => $q->where(fn ($q) => $q->where('name', 'like', '%'.$r->q.'%')->orWhereHas('resident', fn ($q) => $q->where('full_name', 'like', '%'.$r->q.'%')->orWhere('mobile', 'like', '%'.$r->q.'%'))))->when($r->type, fn ($q) => $q->where('type', $r->type))->latest()->paginate(20)->withQueryString();

        return view('documents.index', compact('documents'));
    }
}
