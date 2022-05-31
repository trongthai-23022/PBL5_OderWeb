<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Gà', 'parent_id' =>'0', 'slug' => 'ga'],
            ['name' => 'Gà Nướng', 'parent_id' =>'1', 'slug' => 'ga-nuong'],
            ['name' => 'Gà Hấp', 'parent_id' =>'1', 'slug' => 'ga-hap'],
            ['name' => 'Gà Chiên', 'parent_id' =>'1', 'slug' => 'ga-chien'],
            ['name' => 'Bò', 'parent_id' =>'0', 'slug' => 'bo'],
            ['name' => 'Bò Xào', 'parent_id' =>'5', 'slug' => 'bo-xao'],
            ['name' => 'Bò Hầm', 'parent_id' =>'5', 'slug' => 'bo-xao'],
            ['name' => 'Cá', 'parent_id' =>'0','slug' => 'ca'],
            ['name' => 'Cá Nướng', 'parent_id' =>'8','slug' => 'ca-nuong'],
            ['name' => 'Cá Om', 'parent_id' =>'8','slug' => 'ca-om'],
            ['name' => 'Heo', 'parent_id' =>'0','slug' => 'heo'],
            ['name' => 'Heo Quay', 'parent_id' =>'11','slug' => 'heo-quay'],
        ]);
    }
}
