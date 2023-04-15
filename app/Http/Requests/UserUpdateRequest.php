<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user())],
            'birth_date' => ['required', 'date', 'before:'. (new Carbon())->subYears(18)->format('Y-m-d')],
        ];
    }
}
