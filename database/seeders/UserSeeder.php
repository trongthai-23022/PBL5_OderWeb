<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SharingPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        User::factory(20)->create()
            ->each(function($user) use($categories) {
            Product::factory(rand(1, 10))->create([
                'user_id' => $user->id,
                'category_id' => $categories[rand(0,($categories->count()-1))]->id,
            ]);
        });
    }
}
