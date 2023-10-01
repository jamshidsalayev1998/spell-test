<?php

namespace App\Http\Resources\V1\Folder;

use App\Http\Resources\V1\SpellWord\IndexSpellWordResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexFolderResource extends JsonResource
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
            'name' => $this->name,
            'created_at' => date('Y-m-d H:i:s' , strtotime($this->created_at)),
            'spell_words' => IndexSpellWordResource::collection($this->spell_words)
        ];
    }
}
