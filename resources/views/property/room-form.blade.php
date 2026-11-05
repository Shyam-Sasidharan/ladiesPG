@extends('layouts.app')
@section('title', $room->exists ? 'Edit Room '.$room->number : 'Add Room')
@section('content')
<div class="page-heading">
    <div>
        <span class="eyebrow">ROOM CAPACITY & CONFIGURATION</span>
        <h1>{{ $room->exists ? 'Edit room '.$room->number : 'Create a room' }}<span class="accent">.</span></h1>
        <p>Dynamic room sharing: Change capacity anytime (2, 3, 4, 5 sharing). Beds, occupancy, and vacancies adjust automatically.</p>
    </div>
    <a class="btn" href="{{ route('rooms.index') }}">← All rooms</a>
</div>

<form class="panel" action="{{ $room->exists ? route('rooms.update', $room) : route('rooms.store') }}" method="post">
    @csrf 
    @if($room->exists)
        @method('put')
    @endif
    <div class="form-section">
        <div class="form-grid">
            <x-field name="number" label="Room number" :value="$room->number" required/>
            
            <label class="field">
                <span>Floor *</span>
                <select name="floor_id" required>
                    <option value="">Select floor</option>
                    @foreach($floors as $floor)
                        <option value="{{ $floor->id }}" @selected(old('floor_id', $room->floor_id) == $floor->id)>{{ $floor->name }}</option>
                    @endforeach
                </select>
            </label>

            <x-field name="type" label="Room type / label" :value="$room->type ?? 'Sharing'" required/>
            
            <label class="field">
                <span>Capacity / Sharing *</span>
                <input name="capacity" type="number" min="1" max="50" value="{{ old('capacity', $room->capacity ?? 4) }}" required>
                <small style="color:var(--text-muted);display:block;margin-top:4px;">Supports 2, 3, 4, 5 or any capacity. Beds adjust automatically.</small>
            </label>

            <x-field name="effective_date" label="Capacity effective from date" type="date" :value="today()->toDateString()" />

            <x-field name="monthly_rent" label="Rent with food (₹ / month)" type="number" min="0" step="0.01" :value="$room->monthly_rent ?? 6500" required/>
            
            <x-field name="rent_without_food" label="Rent without food (₹ / month)" type="number" min="0" step="0.01" :value="$room->rent_without_food ?? 4200"/>
            
            <x-field name="security_deposit" label="Deposit per resident (₹)" type="number" min="0" step="0.01" :value="$room->security_deposit ?? 1000" required/>
            
            @foreach(['ac' => 'Air conditioning', 'attached_bathroom' => 'Attached bathroom', 'food_included' => 'Food included'] as $name => $label)
                <label class="field">
                    <span>{{ $label }}</span>
                    <select name="{{ $name }}">
                        <option value="0" @selected(!old($name, $room->$name))>No</option>
                        <option value="1" @selected(old($name, $room->$name))>Yes</option>
                    </select>
                </label>
            @endforeach

            <label class="field">
                <span>Room status</span>
                <select name="status">
                    <option value="active" @selected(old('status', $room->status) === 'active')>Active</option>
                    <option value="maintenance" @selected(old('status', $room->status) === 'maintenance')>Maintenance</option>
                </select>
            </label>

            <label class="field span-3">
                <span>Notes & Capacity Change Reason</span>
                <textarea name="notes" placeholder="e.g. Changed to 2-sharing from November onwards">{{ old('notes', $room->notes) }}</textarea>
            </label>
        </div>
    </div>
    <div class="form-actions">
        <button class="btn primary">Save room & update capacity →</button>
    </div>
</form>

@if($room->exists)
    <!-- Capacity & Sharing Change History -->
    @if($room->capacityHistories && $room->capacityHistories->isNotEmpty())
        <section class="panel" style="margin-top:24px">
            <div class="panel-heading">
                <div>
                    <h2>Room Capacity History</h2>
                    <p>Timeline of sharing capacity configurations for Room {{ $room->number }}.</p>
                </div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Sharing Configuration</th>
                            <th>Beds Capacity</th>
                            <th>Effective Dates</th>
                            <th>Rent (Food / No Food)</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($room->capacityHistories as $hist)
                            <tr>
                                <td><strong>{{ $hist->sharing_type }}</strong></td>
                                <td><span class="badge {{ $hist->effective_to ? 'neutral' : 'available' }}">{{ $hist->capacity }} Beds</span></td>
                                <td>
                                    {{ $hist->effective_from->format('d M Y') }}
                                    @if($hist->effective_to)
                                        → {{ $hist->effective_to->format('d M Y') }}
                                    @else
                                        <span class="badge available" style="margin-left:6px;">Current Active</span>
                                    @endif
                                </td>
                                <td>
                                    ₹{{ number_format($hist->monthly_rent) }}
                                    @if($hist->rent_without_food)
                                        / ₹{{ number_format($hist->rent_without_food) }}
                                    @endif
                                </td>
                                <td>{{ $hist->notes ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    <!-- Individual Active Beds Management -->
    <section class="panel" style="margin-top:24px">
        <div class="panel-heading">
            <div>
                <h2>Individual Beds ({{ $room->beds->count() }} Active)</h2>
                <p>Manage bed names, positions (TOP / DOWN bunk tiers), and status.</p>
            </div>
        </div>
        @foreach($room->beds as $bed)
            <form class="filters" method="post" action="{{ route('beds.update', $bed) }}" style="align-items:flex-end;">
                @csrf 
                @method('put')
                <label class="field">
                    <span>Bed name</span>
                    <input name="name" value="{{ $bed->name }}" required>
                </label>
                <label class="field">
                    <span>Position</span>
                    <input name="position" type="number" min="1" max="1000" value="{{ $bed->position }}" required>
                </label>
                <label class="field">
                    <span>Bed Position / Tier</span>
                    <select name="tier">
                        <option value="">-- Standard --</option>
                        <option value="DOWN" @selected($bed->tier === 'DOWN')>DOWN (Lower Bunk)</option>
                        <option value="TOP" @selected($bed->tier === 'TOP')>TOP (Upper Bunk)</option>
                        <option value="SINGLE" @selected($bed->tier === 'SINGLE')>SINGLE</option>
                    </select>
                </label>
                <label class="field">
                    <span>Status · currently {{ $bed->effective_status }}</span>
                    <select name="status">
                        @foreach(['available', 'reserved', 'maintenance', 'archived'] as $status)
                            <option value="{{ $status }}" @selected($bed->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </label>
                <button class="btn">Save bed</button>
            </form>
        @endforeach
    </section>

    <!-- Archived / Historical Beds if any -->
    @php
        $archivedBeds = $room->allBeds->where('status', 'archived');
    @endphp
    @if($archivedBeds->isNotEmpty())
        <section class="panel" style="margin-top:24px;border-left:4px solid #de7b85;">
            <div class="panel-heading">
                <div>
                    <h2>Archived Beds (Preserved History)</h2>
                    <p>Beds decommissioned during capacity reductions. Historical resident stay records remain completely intact.</p>
                </div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Bed Name</th>
                            <th>Tier</th>
                            <th>Historical Resident Allocations</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($archivedBeds as $abed)
                            <tr>
                                <td><strong>{{ $abed->name }}</strong></td>
                                <td><span class="badge neutral">{{ $abed->tier ?? 'Bunk' }}</span></td>
                                <td>
                                    @forelse($abed->allocations as $alloc)
                                        <div>
                                            <a href="{{ route('residents.show', $alloc->resident_id) }}"><strong>{{ $alloc->resident->full_name }}</strong></a>
                                            <small class="muted">({{ $alloc->check_in }} → {{ $alloc->check_out ?? 'Check out' }})</small>
                                        </div>
                                    @empty
                                        <span class="muted">No allocations on this bed</span>
                                    @endforelse
                                </td>
                                <td>
                                    <form method="post" action="{{ route('beds.update', $abed) }}" style="display:inline;">
                                        @csrf 
                                        @method('put')
                                        <input type="hidden" name="name" value="{{ $abed->name }}">
                                        <input type="hidden" name="position" value="{{ $abed->position }}">
                                        <input type="hidden" name="tier" value="{{ $abed->tier }}">
                                        <input type="hidden" name="status" value="available">
                                        <button class="btn small" title="Reactivate this bed into room">Reactivate Bed</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    <form style="margin-top:20px" action="{{ route('rooms.destroy', $room) }}" method="post" data-confirm="Archive this room? It must be empty. Historical stays will be preserved.">
        @csrf 
        @method('delete')
        <button class="btn danger">Archive room</button>
    </form>
@endif
@endsection
