<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return ['full_name' => 'required|string|max:150', 'mobile' => 'required|string|max:20', 'whatsapp' => 'nullable|string|max:20', 'email' => 'nullable|email|max:255', 'date_of_birth' => 'nullable|date|before:today', 'address' => 'nullable|string|max:2000', 'emergency_name' => 'nullable|string|max:150', 'emergency_phone' => 'nullable|string|max:20', 'guardian_name' => 'nullable|string|max:150', 'guardian_phone' => 'nullable|string|max:20', 'id_type' => 'nullable|string|max:100', 'id_number' => 'nullable|string|max:100', 'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096', 'joining_date' => 'required|date', 'expected_checkout' => 'nullable|date|after_or_equal:joining_date', 'occupation' => 'nullable|string|max:150', 'organization' => 'nullable|string|max:150', 'monthly_rent' => 'required|numeric|min:0|max:9999999', 'security_deposit' => 'required|numeric|min:0|max:9999999', 'food_required' => 'boolean', 'status' => 'required|in:active,notice_period', 'notes' => 'nullable|string|max:5000'];
    }
}
