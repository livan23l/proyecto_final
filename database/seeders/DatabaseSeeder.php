<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([  // Se ejecutan todos los seeders con llamar solo a este para utilizar "php artisan db:seed" solo
            EstadoSeeder::class,
            CategoriaSeeder::class,
            PartidoSeeder::class,
            UserSeeder::class,
            CandidatoSeeder::class,
            VotacionSeeder::class,
        ]);
    }
}
