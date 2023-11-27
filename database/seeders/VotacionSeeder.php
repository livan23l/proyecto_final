<?php

namespace Database\Seeders;

use App\Models\Votacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VotacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lógica para generar datos de votación ficticios
        Votacion::factory()->count(10)->create();
    }
}
