<?php

namespace App\Http\Requests\V1\SpellWord;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSpellWordRequest extends FormRequest
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
            'word' => ['required', Rule::unique('spell_words', 'word')->where('folder_id', $this->folder_id)->ignore($this->route('spell_word'))],
            'translate' => ['required'],
        ];
    }
}
