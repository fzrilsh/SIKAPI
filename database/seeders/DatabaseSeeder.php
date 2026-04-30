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
        User::create([
            'name' => 'Super Admin SIKAPI',
            'email' => 'admin@sikapi.go.id',
            'password' => Hash::make('admin123'),
            'is_super_admin' => true,
            'ministry_id' => null,
        ]);
    }
}
