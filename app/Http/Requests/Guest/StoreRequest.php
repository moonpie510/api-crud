<?php

namespace App\Http\Requests\Guest;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'phone' => ['required', 'unique:guests,phone', 'string', 'min:8', 'max:25'],
            'email' => ['email', 'unique:guests,email', 'max:255'],
            'country_id' => ['string', 'exists:countries,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->phone = (string) new PhoneNumber($this->phone);
    }
}
