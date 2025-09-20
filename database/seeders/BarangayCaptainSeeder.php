<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BarangayCaptainSeeder extends Seeder {
    public function run(): void {
        User::updateOrCreate(
            ['email' => 'captain@brgy.local'],
            ['name'=>'Barangay Captain','password'=>Hash::make('capt123'),'role'=>'captain']
        );
    }
}

