<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BaselineSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            ['email' => 'admin@cadde1905.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'editor@cadde1905.test'],
            [
                'name' => 'Editor',
                'password' => Hash::make('12345678'),
                'role' => 'editor',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Category::updateOrCreate(
            ['slug' => 'futbol'],
            [
                'name' => 'Futbol',
                'type' => 'haber',
                'sort_order' => 0,
                'is_active' => true,
            ]
        );
    }
}