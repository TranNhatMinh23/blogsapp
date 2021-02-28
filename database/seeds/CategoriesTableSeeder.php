<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Lập Trình',
            'slug' => 'lap-trinh'
        ]);
        DB::table('categories')->insert([
            'name' => 'Data',
            'slug' => 'data'
        ]);
        DB::table('categories')->insert([
            'name' => 'Ai',
            'slug' => 'ai'
            
        ]);
        DB::table('categories')->insert([
            'name' => 'DevOps',
            'slug' => 'devops'
        ]);
    }
}
