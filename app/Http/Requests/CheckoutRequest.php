<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date|before_or_equal:today',
            'reason' => 'required|string|max:2000',
            'refund_security_deposit' => 'required|boolean',
            'refund_amount' => [Rule::requiredIf($this->boolean('refund_security_deposit')), 'nullable', 'numeric', 'min:0.01', 'max:9999999'],
        ];
    }
}
