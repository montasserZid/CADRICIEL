<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\Models\User;
use Faker\Factory as Faker;

class ForumSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            $language = $faker->randomElement(['fr', 'en']);

            Forum::create([
                'user_id' => $user->id,
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'language' => $language,
            ]);
        }
    }
}
