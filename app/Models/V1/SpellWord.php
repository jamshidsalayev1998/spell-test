<?php

namespace App\Models\V1;

use App\Traits\ModelScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpellWord extends Model
{
    use HasFactory;
    use ModelScopeTrait;
    protected $guarded = [];

    public function folder()
    {
        return $this->belongsTo(Folder::class , 'folder_id' , 'id');
    }
}
