<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Payment;
use App\Models\RentRecord;
use App\Models\Resident;
use App\Models\ResidentDocument;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $floors = Floor::with(['rooms.beds.activeAllocation', 'rooms.beds.room'])->orderBy('number')->get();
        $rooms = $floors->flatMap->rooms;
        $beds = $rooms->flatMap->beds;
        $stats = ['Total Residents' => Resident::count(), 'Active Residents' => Resident::whereIn('status', ['active', 'notice_period'])->count(), 'Available Beds' => $beds->filter(fn ($b) => $b->effective_status === 'available')->count(), 'Occupied Beds' => $beds->filter(fn ($b) => $b->effective_status === 'occupied')->count(), 'Total Rooms' => $rooms->count(), 'Available Rooms' => $rooms->filter(fn ($r) => $r->available > 0)->count(), 'Monthly Collection' => Payment::where('type', 'rent')->where('status', 'active')->whereBetween('payment_date', [today()->startOfMonth(), today()->endOfMonth()])->sum('amount'), 'Pending Payments' => RentRecord::with('payments')->get()->sum('pending')];
        $upcoming = Resident::whereIn('status', ['active', 'notice_period'])->whereBetween('expected_checkout', [today(), today()->addDays(30)])->orderBy('expected_checkout')->limit(6)->get();
        $recent = Resident::with('activeAllocation.bed.room')->latest()->limit(5)->get();
        $overdue = RentRecord::with('resident', 'payments')->whereDate('due_date', '<', today())->get()->filter(fn ($r) => $r->pending > 0);
        $missing = Resident::whereIn('status', ['active', 'notice_period'])->whereDoesntHave('documents')->count();
        $expiring = ResidentDocument::where('type', 'agreement')->whereBetween('expires_at', [today(), today()->addDays(30)])->count();
        $chart = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = today()->subMonths($i);
            $chart[] = ['label' => $date->format('M'), 'value' => Payment::where('type', 'rent')->where('status', 'active')->whereBetween('payment_date', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])->sum('amount')];
        }

        return view('dashboard', compact('stats', 'floors', 'beds', 'upcoming', 'recent', 'overdue', 'missing', 'expiring', 'chart'));
    }
}
