<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return ['resident_id' => 'required|exists:residents,id', 'bed_id' => 'required|exists:beds,id', 'date' => 'required|date|before_or_equal:today', 'initial_payment' => 'nullable|numeric|min:0|max:9999999', 'method' => 'nullable|in:cash,upi,bank,card', 'notes' => 'nullable|string|max:5000'];
    }
}
