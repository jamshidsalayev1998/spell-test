<?php

namespace App\Rules\V1;

use App\Models\V1\Folder;
use Illuminate\Contracts\Validation\Rule;

class BelongsToUser implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        // Implement the logic to check if the folder belongs to the user.
        // You can use Eloquent or your preferred method to perform this check.
        return Folder::query()->where('id', $value)
            ->where('user_id', $this->userId)
            ->exists();
    }

    public function message()
    {
        return 'The selected folder does not belong to the authenticated user.';
    }
}
