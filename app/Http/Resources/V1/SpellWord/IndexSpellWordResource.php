<?php

namespace App\Http\Resources\V1\SpellWord;

use App\Http\Resources\V1\Folder\IndexFolderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexSpellWordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'word' => $this->word,
            'translate' => $this->translate,
            'folder' => $this->folder?[
                'id' => $this->folder->id,
                'name' => $this->folder->name,
            ]:null,
            'user_id' => $this->user_id
        ];
    }
}
