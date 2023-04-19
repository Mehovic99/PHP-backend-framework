<?php

namespace Database\Seeders;

use App\Models\Post;
use illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        Post::factory()
        ->count(10)
        ->create();
    }
}