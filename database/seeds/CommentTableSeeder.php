<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<50; $i++){
            DB::table('comments')->insert([
                'content' => Str::random(30),
                'post_id' => random_int(1,10),
                'user_id' => random_int(1,20),
            ]);
        }
    }
}
