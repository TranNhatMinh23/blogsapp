<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<10; $i++){
            DB::table('category_post')->insert([
                'post_id' => random_int(1,2),
                'category_id' => random_int(1,2)
            ]);
        }
    }
}
