<?php

namespace Database\Seeders;

use App\Models\UserNoticiaLike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserNoticiaLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lógica para generar datos de votación ficticios
        UserNoticiaLike::factory()->count(10)->create();
    }
}
