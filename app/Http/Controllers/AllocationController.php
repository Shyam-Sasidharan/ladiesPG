<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllocationRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\Bed;
use App\Models\Floor;
use App\Models\Resident;
use App\Services\AllocationService;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    public function index(Request $r)
    {
        $floors = Floor::with(['rooms.beds.activeAllocation.resident', 'rooms.beds.room'])->orderBy('number')->get();
        $residents = Resident::when($r->boolean('transfer'), fn ($q) => $q->whereHas('activeAllocation'), fn ($q) => $q->whereDoesntHave('activeAllocation'))->orderBy('full_name')->get();

        return view('allocation.index', compact('floors', 'residents'));
    }

    public function bed(Bed $bed)
    {
        $bed->load(['room.floor', 'activeAllocation.resident.rentRecords.payments', 'activeAllocation.allocation']);
        $active = $bed->activeAllocation;

        return response()->json(['id' => $bed->id, 'name' => $bed->name, 'status' => $bed->effective_status, 'room' => $bed->room->number, 'floor' => $bed->room->floor->name, 'rent' => $bed->room->monthly_rent, 'deposit' => $bed->room->security_deposit, 'resident' => $active ? ['name' => $active->resident->full_name, 'mobile' => $active->resident->mobile, 'joined' => $active->allocation->check_in, 'checkout' => $active->resident->expected_checkout?->format('d M Y'), 'rent' => $active->allocation->rent, 'pending' => $active->resident->rentRecords->sum('pending'), 'url' => route('residents.show', $active->resident), 'photo' => $active->resident->photo ? route('residents.photo', $active->resident) : null] : null]);
    }

    public function store(AllocationRequest $r, AllocationService $service)
    {
        $service->allocate($r->integer('resident_id'), $r->integer('bed_id'), $r->validated());

        return redirect()->route('residents.show', $r->resident_id)->with('success', 'Check-in confirmed. Bed allocated successfully.');
    }

    public function transfer(AllocationRequest $r, AllocationService $service)
    {
        $data = $r->validated();
        unset($data['initial_payment']);
        $service->transfer($r->integer('resident_id'), $r->integer('bed_id'), $data);

        return redirect()->route('residents.show', $r->resident_id)->with('success', 'Room transfer completed. Previous stay preserved.');
    }

    public function checkout(CheckoutRequest $r, Resident $resident, AllocationService $service)
    {
        $checkout = $service->checkout($resident->id, $r->validated());

        return redirect()->route('residents.show', $resident)->with('success', 'Checkout complete. The bed is available and the resident history is preserved.');
    }
}
