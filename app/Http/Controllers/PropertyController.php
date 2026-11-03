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
        return view('property.room-form', ['room' => $room ?? new Room, 'floors' => Floor::orderBy('number')->get()]);
    }

    public function saveRoom(Request $r, ?Room $room = null)
    {
        $data = $r->validate(['number' => ['required', 'string', 'max:30', Rule::unique('rooms')->ignore($room?->id)], 'floor_id' => 'required|exists:floors,id', 'type' => 'required|string|max:100', 'capacity' => 'required|integer|min:1|max:50', 'monthly_rent' => 'required|numeric|min:0|max:9999999', 'rent_without_food' => 'nullable|numeric|min:0|max:9999999', 'security_deposit' => 'required|numeric|min:0|max:9999999', 'ac' => 'boolean', 'attached_bathroom' => 'boolean', 'food_included' => 'boolean', 'status' => 'required|in:active,maintenance', 'notes' => 'nullable|string|max:2000']);
        DB::transaction(function () use ($room, $data) {
            if ($room?->exists) {
                $room = Room::lockForUpdate()->findOrFail($room->id);
                $beds = $room->beds()->lockForUpdate()->get();
                if ($data['capacity'] < $beds->count()) {
                    throw ValidationException::withMessages(['capacity' => 'Capacity cannot be reduced after beds exist. Block unused beds to preserve history.']);
                } if ($data['status'] === 'maintenance' && $beds->contains(fn ($bed) => $bed->activeAllocation !== null)) {
                    throw ValidationException::withMessages(['status' => 'Transfer or check out all residents before closing this room.']);
                }
            }
            $room ??= new Room;
            $room->fill($data)->save();
            $count = $room->beds()->count();
            for ($i = $count + 1; $i <= $data['capacity']; $i++) {
                $name = 'B'.$i;
                while ($room->beds()->where('name', $name)->exists()) {
                    $name .= 'N';
                } $room->beds()->create(['name' => $name, 'position' => $i]);
            }
        }, 5);

        return redirect()->route('rooms.index')->with('success', 'Room and beds saved.');
    }

    public function deleteRoom(Room $room)
    {
        return DB::transaction(function () use ($room) {
            $room = Room::lockForUpdate()->findOrFail($room->id);
            $beds = $room->beds()->lockForUpdate()->get();
            if ($beds->contains(fn ($b) => $b->activeAllocation !== null)) {
                return back()->withErrors(['room' => 'Occupied rooms cannot be archived.']);
            } $room->update(['status' => 'maintenance']);
            $room->delete();

            return redirect()->route('rooms.index')->with('success', 'Room archived.');
        });
    }

    public function updateBed(Request $r, Bed $bed)
    {
        $data = $r->validate(['name' => ['required', 'string', 'max:20', Rule::unique('beds')->where('room_id', $bed->room_id)->ignore($bed->id)], 'position' => 'required|integer|min:1|max:1000', 'status' => 'required|in:available,reserved,maintenance']);
        DB::transaction(function () use ($bed, $data) {
            $bed = Bed::lockForUpdate()->findOrFail($bed->id);
            if ($bed->activeAllocation && $data['status'] !== 'available') {
                throw ValidationException::withMessages(['status' => 'An occupied bed cannot be reserved or blocked.']);
            } $bed->update($data);
        });

        return back()->with('success', 'Bed updated.');
    }
}
