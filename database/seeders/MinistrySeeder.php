<?php

namespace Database\Seeders;

use App\Models\Ministry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MinistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ministries = [
            'Kementerian Kesehatan',
            'Kementerian Komunikasi dan Informatika',
            'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi',
            'Kementerian Hukum dan HAM',
            'Kementerian Ketenagakerjaan',
        ];

        foreach ($ministries as $name) {
            Ministry::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'logo' => null,
                ]
            );
        }
    }
}
