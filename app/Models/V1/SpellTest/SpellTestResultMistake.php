<?php

namespace App\Models\V1\SpellTest;

use App\Traits\ModelScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpellTestResultMistake extends Model
{
    use HasFactory;
    use ModelScopeTrait;
    protected $guarded = [];
}
