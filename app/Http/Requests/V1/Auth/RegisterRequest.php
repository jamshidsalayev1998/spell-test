<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed name
 * @property mixed username
 * @property mixed password
 */
class RegisterRequest extends FormRequest
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
            'name' => ['required' , 'min:3' , 'max:100'],
            'username' =>  ['required' , Rule::unique('users' , 'username') , 'regex:/^[a-zA-Z0-9_]{3,30}$/'],
            'password' => ['required', 'regex:/^[a-zA-Z0-9_]{3,30}$/']
        ];
    }
}
