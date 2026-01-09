<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan updateOrCreate agar tidak error duplicate
        Admin::updateOrCreate(
            ['email' => 'mahiratourindonesiaofficial@gmail.com'],
            [
                'name' => 'Susi Sasmita',
                'password' => Hash::make('@Berkah01')
            ]
        );
    }
}