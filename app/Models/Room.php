<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\ValidationException;

class Room extends Model
{
    protected $guarded = ['id'];

    use SoftDeletes;

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class)->where('status', '!=', 'archived')->orderBy('position');
    }

    public function allBeds()
    {
        return $this->hasMany(Bed::class)->orderBy('position');
    }

    public function capacityHistories()
    {
        return $this->hasMany(RoomCapacityHistory::class)->orderBy('effective_from', 'desc');
    }

    public static function sharingLabelFor(int $capacity): string
    {
        return match ($capacity) {
            1 => 'Single Room',
            2 => 'Two Sharing',
            3 => 'Three Sharing',
            4 => 'Four Sharing',
            5 => 'Five Sharing',
            6 => 'Six Sharing',
            default => $capacity.' Sharing',
        };
    }

    public function applyCapacityChange(int $newCapacity, ?string $effectiveDate = null, ?string $notes = null, ?int $userId = null): void
    {
        $effectiveDate = $effectiveDate ? Carbon::parse($effectiveDate)->toDateString() : now()->toDateString();

        $activeBeds = $this->beds()->with('activeAllocation')->orderBy('position')->get();
        $occupiedCount = $activeBeds->filter(fn ($b) => $b->activeAllocation !== null)->count();

        if ($newCapacity < $occupiedCount) {
            throw ValidationException::withMessages([
                'capacity' => "Cannot reduce room capacity to {$newCapacity}. There are currently {$occupiedCount} active residents in this room.",
            ]);
        }

        // Close out the previous open capacity history record if any
        $lastHistory = $this->capacityHistories()->whereNull('effective_to')->first();
        if ($lastHistory && $lastHistory->effective_from->toDateString() < $effectiveDate) {
            $lastHistory->update([
                'effective_to' => Carbon::parse($effectiveDate)->subDay()->toDateString(),
            ]);
        }

        // Record new capacity history
        $this->capacityHistories()->create([
            'capacity' => $newCapacity,
            'sharing_type' => self::sharingLabelFor($newCapacity),
            'effective_from' => $effectiveDate,
            'effective_to' => null,
            'monthly_rent' => $this->monthly_rent,
            'rent_without_food' => $this->rent_without_food,
            'notes' => $notes ?? ('Changed capacity to '.self::sharingLabelFor($newCapacity)),
            'created_by' => $userId,
        ]);

        // Update room model
        $this->update([
            'capacity' => $newCapacity,
            'type' => self::sharingLabelFor($newCapacity),
        ]);

        $currentActiveCount = $activeBeds->count();

        if ($newCapacity > $currentActiveCount) {
            // Check if any archived beds can be reactivated
            $archivedBeds = $this->allBeds()->where('status', 'archived')->orderBy('position')->get();
            $needed = $newCapacity - $currentActiveCount;

            foreach ($archivedBeds as $archivedBed) {
                if ($needed <= 0) {
                    break;
                }
                $archivedBed->update([
                    'status' => 'available',
                    'position' => $currentActiveCount + 1,
                ]);
                $currentActiveCount++;
                $needed--;
            }

            // Create remaining new beds if needed
            for ($i = $currentActiveCount + 1; $i <= $newCapacity; $i++) {
                $name = 'B'.$i;
                while ($this->allBeds()->where('name', $name)->exists()) {
                    $name .= 'N';
                }
                $tier = ($i % 2 === 1) ? 'DOWN' : 'TOP';
                $this->allBeds()->create([
                    'name' => $name,
                    'position' => $i,
                    'tier' => $tier,
                    'status' => 'available',
                ]);
            }
        } elseif ($newCapacity < $currentActiveCount) {
            // Reduce active beds starting from highest unoccupied positions
            $vacantBeds = $activeBeds->filter(fn ($b) => $b->activeAllocation === null)->sortByDesc('position');
            $toRemove = $currentActiveCount - $newCapacity;

            foreach ($vacantBeds as $bed) {
                if ($toRemove <= 0) {
                    break;
                }

                // If bed has past allocations or checkouts, archive it to preserve history
                if ($bed->allocations()->exists()) {
                    $bed->update(['status' => 'archived']);
                } else {
                    $bed->delete();
                }
                $toRemove--;
            }
        }
    }

    public function getOccupiedAttribute()
    {
        return $this->beds->filter(fn ($b) => $b->effective_status === 'occupied')->count();
    }

    public function getAvailableAttribute()
    {
        return $this->beds->filter(fn ($b) => $b->effective_status === 'available')->count();
    }

    public function getRentWithFoodAttribute(): float
    {
        return (float) $this->monthly_rent;
    }

    public function getRentWithoutFoodDisplayAttribute(): float
    {
        return (float) ($this->rent_without_food ?? $this->monthly_rent);
    }

    public function getAvailabilityStatusAttribute(): string
    {
        if ($this->status !== 'active' || $this->trashed()) {
            return 'Maintenance';
        }
        if ($this->available === 0) {
            return 'Fully Booked';
        }
        if ($this->occupied > 0) {
            return 'Available';
        }

        return 'Available';
    }

    public function getSharingLabelAttribute(): string
    {
        return match ($this->capacity) {
            2 => 'Two Sharing',
            3 => 'Three Sharing',
            4 => 'Four Sharing',
            5 => 'Five Sharing',
            6 => 'Six Sharing',
            default => $this->type ?? ($this->capacity.' Sharing'),
        };
    }
}
