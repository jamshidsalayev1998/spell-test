<?php

namespace App\Http\Requests\V1\SpellTest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexSpellTestRequest extends FormRequest
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
        $user = auth()->user();
        return [
            'limit' => ['required' , Rule::in([5,10,15,20,25,30])],
            'folder_id' => ['required' , Rule::exists('folders' , 'id')->where('deleted' , 0)->where('user_id' , $user->id)]
        ];
    }
}
