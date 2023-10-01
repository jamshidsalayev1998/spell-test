<?php

namespace App\Http\Requests\V1\SpellTest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSpellTestResultRequest extends FormRequest
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
            'count_words' => ['required' , 'integer'],
            'corrects_count' => ['required' , 'integer'],
            'incorrects_count' => ['required' , 'integer'],
            'mistakes' => ['array' , 'nullable'],
            'mistakes.*' => ['integer' , Rule::exists('spell_words' , 'id')->where('user_id' , $user->id)]
        ];
    }
}
