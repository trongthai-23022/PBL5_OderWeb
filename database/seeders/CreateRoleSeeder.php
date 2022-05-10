<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name'=>'Quản trị'],
            ['name' => 'guest', 'display_name'=>'Khách vãng lai'],
            ['name' => 'customer', 'display_name'=>'Khách hàng'],
            ['name' => 'moderator', 'display_name'=>'Kiểm duyệt'],
        ]);
    }
}
