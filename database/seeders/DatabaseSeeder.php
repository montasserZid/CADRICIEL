<?php

namespace Database\Seeders;
use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Ville::factory()->count(15)->create();
        Etudiant::factory()->count(100)->create();
    }
}
