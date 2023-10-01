<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 */
class Folder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted' , 0);
    }

    public function spell_words()
    {
        return $this->hasMany(SpellWord::class , 'folder_id' , 'id');
    }
}
