<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    
    public function run()
    {
        $faker = Factory::create();
        $users = User::pluck('id')->toArray();
        $posts = Post::pluck('id')->toArray();
        $comments = Comment::pluck('id')->toArray();
        foreach (range(1, 50) as $index) {

            Comment::create([
              
                'content' =>  $faker->sentence(),
                'user_id' => $faker->randomElement($users),
                'post_id' => $faker->randomElement($posts),
                'parent_id' => $faker->randomElement($comments),
            ]);
        }
    }
}