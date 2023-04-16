<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParkingStopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parking_id' => ['required', 'integer', 'exists:parkings,id,deleted_at,NULL,user_id,' . auth()->id()],
        ];
    }
}
