<?php

namespace Database\Seeders;

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
    {  // Tres usuarios básicos:
        User::create([
            'name' => 'Soy el ciudadano',
            'email' => 'ciudadano@test.com',
            'role' => 'Ciudadano',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Soy el periodista',
            'email' => 'periodista@test.com',
            'role' => 'Periodista',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Soy el administrador',
            'email' => 'administrador@test.com',
            'role' => 'Administrador',
            'password' => Hash::make('12345678'),
        ]);
    }
}
