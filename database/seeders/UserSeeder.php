<?php

namespace Database\Seeders;

use App\Models\Ministry;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        User::firstOrCreate(
            ['email' => 'admin@sikapi.go.id'],
            [
                'name' => 'Super Admin SIKAPI',
                'password' => $password,
                'is_super_admin' => true,
            ]
        );

        $kemenkes = Ministry::where('slug', 'kementerian-kesehatan')->first();
        if ($kemenkes) {
            User::firstOrCreate(
                ['email' => 'admin.kemenkes@sikapi.go.id'],
                [
                    'name' => 'Admin Kemenkes RI',
                    'password' => $password,
                    'is_expert_verified' => false,
                    'ministry_id' => $kemenkes->id
                ]
            );
        }

        User::firstOrCreate(
            ['email' => 'budi.santoso@gmail.id'],
            [
                'name' => 'Dr. Budi Santoso, S.H., M.H.',
                'password' => $password,
                'is_expert_verified' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'siti.aminah@gmail.id'],
            [
                'name' => 'Siti Aminah',
                'password' => $password,
                'is_expert_verified' => false,
            ]
        );

        User::firstOrCreate(
            ['email' => 'fazril@sikapi.go.id'],
            [
                'name' => 'Fazril Syaveral Hillaby',
                'password' => $password,
                'is_expert_verified' => false,
            ]
        );
    }
}
