<?php

namespace App\Http\Requests\V1\Folder;

use App\Helpers\ResponseHelper;
use App\Models\V1\Folder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFolderRequest extends FormRequest
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
            'name' => ['required' , 'min:3' , 'max:30' , Rule::unique('folders' , 'name')->where('user_id' , $user->id)->where('deleted' , 0)->ignore($this->route('folder'))]
        ];
    }

    public function withValidator($validator)
    {
        $user = auth()->user();
        $validator->after(function($validator) use ($user){
            $folder = $this->route('folder');
            if ($folder->deleted){
                $validator->errors()->add('name' , 'Folder deleted');
            }
        });
    }
}
