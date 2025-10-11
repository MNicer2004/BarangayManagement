<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateBarangayCaptainSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'captain@brgy.local'],
            [
                'name' => 'Ador G. Espiritu',
                'email' => 'captain@brgy.local',
                'password' => Hash::make('password'),
                'role' => 'captain',
                'approval_status' => 'approved'
            ]
        );
    }
}
