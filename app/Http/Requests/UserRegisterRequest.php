<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $baseDate = new Carbon();
        $minAge = $baseDate->subYears(18)->format('Y-m-d');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', 'min:8', Password::defaults()],
            'birth_date' => 'required|date|before:'.$minAge,
        ];
    }

    public function messages(): array
    {
        return [
            'birth_date.before' => 'You must be at least 18 years old to register.',
        ];
    }
}
