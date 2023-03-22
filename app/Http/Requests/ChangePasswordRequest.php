<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class ChangePasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:user,id',
            'password' => 'required|min:8|max:255',
        ];
    }
}
