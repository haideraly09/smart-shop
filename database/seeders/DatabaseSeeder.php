<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
  public function run(): void
{
    User::updateOrCreate(
        ['email' => 'admin@demo.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]
    );

    User::updateOrCreate(
        ['email' => 'staff@demo.com'],
        [
            'name' => 'Staff',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]
    );
}
}
