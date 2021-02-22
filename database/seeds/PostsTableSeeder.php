<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i< 10; $i++) {
        DB::table('posts')->insert([
            'title' => Str::random(10),
            'content' => Str::random(150),
            'user_id' => random_int(1,20)
        ]);
        }
    }
}
