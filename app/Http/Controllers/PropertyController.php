<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PropertyController extends Controller
{
    public function floors()
    {
        return view('property.floors', ['floors' => Floor::withCount('rooms')->orderBy('number')->paginate(20)]);
    }

    public function saveFloor(Request $r, ?Floor $floor = null)
    {
        $data = $r->validate(['name' => ['required', 'string', 'max:100', Rule::unique('floors')->ignore($floor?->id)], 'number' => 'required|integer|min:-10|max:200', 'notes' => 'nullable|string|max:2000']);
        ($floor ?? new Floor)->fill($data)->save();

        return back()->with('success', 'Floor saved.');
    }

    public function deleteFloor(Floor $floor)
    {
        if (Room::withTrashed()->where('floor_id', $floor->id)->exists()) {
            return back()->withErrors(['floor' => 'This floor has rooms or historical rooms and cannot be removed.']);
        } $floor->delete();

        return back()->with('success', 'Floor removed.');
    }

    public function rooms(Request $r)
    {
        $rooms = Room::with(['floor', 'beds.activeAllocation', 'beds.room'])->when($r->floor_id, fn ($q) => $q->where('floor_id', $r->floor_id))->when($r->q, fn ($q) => $q->where('number', 'like', '%'.$r->q.'%'))->orderBy('number')->paginate(12)->withQueryString();

        return view('property.rooms', ['rooms' => $rooms, 'floors' => Floor::orderBy('number')->get()]);
    }

    public function roomForm(?Room $room = null)
    {
        if ($room?->exists) {
            $room->load(['floor', 'beds.activeAllocation.resident', 'allBeds.allocations', 'capacityHistories.creator']);
        }

        return view('property.room-form', ['room' => $room ?? new Room, 'floors' => Floor::orderBy('number')->get()]);
    }

    public function saveRoom(Request $r, ?Room $room = null)
    {
        $data = $r->validate([
            'number' => ['required', 'string', 'max:30', Rule::unique('rooms')->ignore($room?->id)],
            'floor_id' => 'required|exists:floors,id',
            'type' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1|max:50',
            'effective_date' => 'nullable|date',
            'monthly_rent' => 'required|numeric|min:0|max:9999999',
            'rent_without_food' => 'nullable|numeric|min:0|max:9999999',
            'security_deposit' => 'required|numeric|min:0|max:9999999',
            'ac' => 'boolean',
            'attached_bathroom' => 'boolean',
            'food_included' => 'boolean',
            'status' => 'required|in:active,maintenance',
            'notes' => 'nullable|string|max:2000',
        ]);

        DB::transaction(function () use ($room, $data) {
            $effectiveDate = $data['effective_date'] ?? today()->toDateString();
            $newCapacity = (int) $data['capacity'];

            if ($room?->exists) {
                $room = Room::lockForUpdate()->findOrFail($room->id);
                $beds = $room->beds()->lockForUpdate()->get();

                if ($data['status'] === 'maintenance' && $beds->contains(fn ($bed) => $bed->activeAllocation !== null)) {
                    throw ValidationException::withMessages(['status' => 'Transfer or check out all residents before closing this room.']);
                }

                $capacityChanged = ($room->capacity !== $newCapacity);

                $room->fill($data)->save();

                if ($capacityChanged) {
                    $room->applyCapacityChange(
                        $newCapacity,
                        $effectiveDate,
                        $data['notes'] ?? "Capacity updated to {$newCapacity} sharing",
                        auth()->id()
                    );
                }
            } else {
                $newRoom = new Room;
                $newRoom->fill($data)->save();
                $newRoom->applyCapacityChange(
                    $newCapacity,
                    $effectiveDate,
                    $data['notes'] ?? 'Initial room setup',
                    auth()->id()
                );
            }
        }, 5);

        return redirect()->route('rooms.index')->with('success', 'Room and beds saved successfully.');
    }

    public function deleteRoom(Room $room)
    {
        return DB::transaction(function () use ($room) {
            $room = Room::lockForUpdate()->findOrFail($room->id);
            $beds = $room->beds()->lockForUpdate()->get();
            if ($beds->contains(fn ($b) => $b->activeAllocation !== null)) {
                return back()->withErrors(['room' => 'Occupied rooms cannot be archived.']);
            }
            $room->update(['status' => 'maintenance']);
            $room->delete();

            return redirect()->route('rooms.index')->with('success', 'Room archived.');
        });
    }

    public function updateBed(Request $r, Bed $bed)
    {
        $data = $r->validate([
            'name' => ['required', 'string', 'max:20', Rule::unique('beds')->where('room_id', $bed->room_id)->ignore($bed->id)],
            'position' => 'required|integer|min:1|max:1000',
            'tier' => 'nullable|in:DOWN,TOP,SINGLE',
            'status' => 'required|in:available,reserved,maintenance,archived',
        ]);
        DB::transaction(function () use ($bed, $data) {
            $bed = Bed::lockForUpdate()->findOrFail($bed->id);
            if ($bed->activeAllocation && ! in_array($data['status'], ['available', 'occupied'])) {
                throw ValidationException::withMessages(['status' => 'An occupied bed cannot be reserved or blocked.']);
            }
            $bed->update($data);
        });

        return back()->with('success', 'Bed updated.');
    }
}
