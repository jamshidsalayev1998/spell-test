<?php

namespace App\Http\Requests\V1\SpellWord;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSpellWordRequest extends FormRequest
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
            'word' => ['required' , Rule::unique('spell_words' , 'word')->where('folder_id' , $this->folder_id)],
            'translate' => ['required'],
            'folder_id' => ['required' , Rule::exists('folders' , 'id')->where('deleted' , 0)->where('user_id' , $user->id)],
        ];
    }
}
