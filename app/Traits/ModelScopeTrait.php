<?php

namespace App\Traits;

trait ModelScopeTrait
{
    public function scopeFilter($query, $filterArray)
    {
        if ($filterArray) {
            if (is_array($filterArray)) {
                foreach ($filterArray as $item) {
                    $query->where($item['fieldKey'], $item['fieldOperator'], $item['fieldValue']);
                }
            }
        }
    }

    public function scopeMine($query)
    {
        $user = auth()->user();
        $query->where('user_id', $user->id);
    }

    public function scopeRelations($query, $relationsArray)
    {
        $ifParam = is_array($relationsArray) && count($relationsArray);
        if ($ifParam) {
            foreach ($relationsArray as $relation) {
                $query->with($relation);
            }
        }
    }

    public function scopeNotDeleted($query)
    {
        $query->where('deleted', 0);
    }
}
