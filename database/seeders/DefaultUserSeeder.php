<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $defaultUsers = config('defaultValues.users');
        foreach ($defaultUsers as $defaultUser) {
            if (!User::query()->where('username','=', $defaultUser['username'])->exists()) {
                $newUser = new User();
                $newUser->name = $defaultUser['name'];
                $newUser->username = $defaultUser['username'];
                $newUser->password = Hash::make($defaultUser['password']);
                $newUser->save();
            }
        }
    }
}
