<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string $encrypted_emp_id
 * @property mixed $pin
 */
class AttendancePinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['encrypted_emp_id' => "string", 'pin' => "string"])]
    public function rules(): array
    {
        return [
            'encrypted_emp_id' => 'required|string|max:255',
            'pin' => 'required|numeric|min:4',
        ];
    }
}
