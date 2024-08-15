<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:guests,phone,' . $this->guest->id, 'string', 'min:8', 'max:25'],
            'email' => ['email', 'unique:guests,email,' . $this->guest->id, 'max:255'],
            'country_id' => ['string', 'exists:countries,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->phone = (string) new PhoneNumber($this->phone);
    }
}
