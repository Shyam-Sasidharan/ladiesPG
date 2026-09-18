<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return ['resident_id' => 'required|exists:residents,id', 'rent_record_id' => 'nullable|required_if:type,rent|exists:rent_records,id', 'type' => 'required|in:rent,deposit', 'payment_date' => 'required|date|before_or_equal:today', 'amount' => 'required|numeric|min:0.01|max:9999999', 'method' => 'required|in:cash,upi,bank,card', 'reference' => 'nullable|string|max:255', 'notes' => 'nullable|string|max:5000'];
    }
}
