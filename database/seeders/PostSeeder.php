<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::pluck('id')->toArray();
        foreach (range(1, 50) as $index) {

            Post::create([
                'title' => $faker->word(),
                'content' =>  $faker->paragraph(),
                'user_id' => $faker->randomElement($users),
            ]);
        }
    }
}
