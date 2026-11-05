<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidentRequest;
use App\Models\Floor;
use App\Models\Resident;
use App\Services\AllocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    public function index(Request $r)
    {
        $query = Resident::with(['activeAllocation.bed.room.floor', 'allocations.bed.room.floor']);
        if ($r->filled('q')) {
            $query->where(fn ($q) => $q->where('full_name', 'like', '%'.$r->q.'%')->orWhere('mobile', 'like', '%'.$r->q.'%')->orWhereHas('activeAllocation.bed', fn ($b) => $b->where('name', 'like', '%'.$r->q.'%')->orWhereHas('room', fn ($room) => $room->where('number', 'like', '%'.$r->q.'%'))));
        }
        if ($r->filled('status')) {
            $query->where('status', $r->status);
        }
        if ($r->filled('floor_id')) {
            $query->whereHas('activeAllocation.bed.room', fn ($q) => $q->where('floor_id', $r->floor_id));
        }
        if ($r->filled('joining_from')) {
            $query->whereDate('joining_date', '>=', $r->joining_from);
        }
        if ($r->filled('checkout_to')) {
            $query->whereDate('expected_checkout', '<=', $r->checkout_to);
        }

        return view('residents.index', ['residents' => $query->latest()->paginate(15)->withQueryString(), 'floors' => Floor::orderBy('number')->get()]);
    }

    public function create()
    {
        return view('residents.form', ['resident' => new Resident]);
    }

    public function store(ResidentRequest $r)
    {
        $data = $r->safe()->except('photo');
        if ($r->hasFile('photo')) {
            $data['photo'] = $r->file('photo')->store('photos', 'local');
        } $resident = Resident::create($data + ['created_by' => auth()->id(), 'updated_by' => auth()->id()]);

        return redirect()->route('residents.show', $resident)->with('success', 'Resident registered. You can now upload documents and allocate a bed.');
    }

    public function show(Resident $resident, AllocationService $allocationService)
    {
        $resident->load(['activeAllocation.bed.room.floor', 'allocations.bed.room.floor', 'documents', 'payments', 'rentRecords.payments', 'transfers.fromAllocation.bed.room', 'transfers.toAllocation.bed.room', 'checkouts.allocation.bed.room', 'financialTransactions']);
        $depositHeld = $allocationService->depositHeldForResident($resident);

        return view('residents.show', compact('resident', 'depositHeld'));
    }

    public function edit(Resident $resident)
    {
        return view('residents.form', compact('resident'));
    }

    public function update(ResidentRequest $r, Resident $resident)
    {
        $data = $r->safe()->except('photo');
        if ($resident->status === 'checked_out') {
            unset($data['status']);
        }
        if ($r->hasFile('photo')) {
            $data['photo'] = $r->file('photo')->store('photos', 'local');
            if ($resident->photo) {
                Storage::disk('local')->delete($resident->photo);
            }
        }

        DB::transaction(function () use ($resident, $data) {
            $resident->update($data + ['updated_by' => auth()->id()]);

            // Synchronize current active allocation rent and deposit
            if ($activeAllocation = $resident->activeAllocation) {
                $activeAllocation->allocation->update([
                    'rent' => $resident->monthly_rent,
                    'deposit' => $resident->security_deposit,
                ]);
            }

            // Synchronize open / unpaid monthly rent invoices for current & future months
            $currentMonth = today()->startOfMonth()->toDateString();
            $openRecords = $resident->rentRecords()
                ->where('month', '>=', $currentMonth)
                ->with('payments')
                ->get();

            foreach ($openRecords as $record) {
                $paid = $record->payments->sum('amount');
                if ($paid <= (float) $resident->monthly_rent) {
                    $record->update(['amount' => $resident->monthly_rent]);
                }
            }
        });

        return redirect()->route('residents.show', $resident)->with('success', 'Resident details and active rent updated successfully.');
    }

    public function destroy(Resident $resident)
    {
        return DB::transaction(function () use ($resident) {
            $resident = Resident::lockForUpdate()->findOrFail($resident->id);
            if ($resident->activeAllocation) {
                return back()->withErrors(['resident' => 'Check out this resident before archiving.']);
            } if ($resident->rentRecords()->with('payments')->get()->sum('pending') > 0) {
                return back()->withErrors(['resident' => 'Settle outstanding rent before archiving this resident.']);
            } $resident->delete();

            return redirect()->route('residents.index')->with('success', 'Resident archived. History has been preserved.');
        });
    }

    public function photo(Resident $resident)
    {
        abort_unless($resident->photo && Storage::disk('local')->exists($resident->photo), 404);

        return Storage::disk('local')->response($resident->photo, null, ['Cache-Control' => 'private, no-store', 'X-Content-Type-Options' => 'nosniff']);
    }
}
