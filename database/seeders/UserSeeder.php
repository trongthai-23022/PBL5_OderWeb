<?php

namespace Database\Seeders;

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
        //
        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name'=>'Quản trị']
        ]);
        DB::table('permissions')->insert([
            ['id'=> 1, 'name' => 'role', 'display_name' => 'vai trò', 'parent_id'=> 0, 'key_code' => 'role'],
            ['id'=> 2, 'name' => 'view role', 'display_name' => 'Danh sách vai trò', 'parent_id'=> 1, 'key_code' => 'role_view'],
            ['id'=> 3, 'name' => 'add role', 'display_name' => 'Thêm vai trò', 'parent_id'=> 1, 'key_code' => 'role_add'],
            ['id'=> 4, 'name' => 'edit role', 'display_name' => 'Sửa vai trò', 'parent_id'=> 1, 'key_code' => 'role_edit'],
            ['id'=> 5, 'name' => 'delete role', 'display_name' => 'Xóa vai trò', 'parent_id'=> 1, 'key_code' => 'role_delete'],
            ['id'=> 6, 'name' => 'permission', 'display_name' => 'phân quyền', 'parent_id'=> 0, 'key_code' => 'permission'],
            ['id'=> 7, 'name' => 'view permission', 'display_name' => 'Danh sách phân quyền', 'parent_id'=> 6, 'key_code' => 'permission_view'],
            ['id'=> 8, 'name' => 'add permission', 'display_name' => 'Thêm phân quyền', 'parent_id'=> 6, 'key_code' => 'permission_add'],
            ['id'=> 9, 'name' => 'edit permission', 'display_name' => 'Sửa phân quyền', 'parent_id'=> 6, 'key_code' => 'permission_edit'],
            ['id'=> 10, 'name' => 'delete permission', 'display_name' => 'Xóa phân quyền', 'parent_id'=> 6, 'key_code' => 'permission_delete'],
        ]);
        DB::table('users')->insert([
            ['name' => 'admin', 'email'=>'admin@gmail.com', 'password' => Hash::make('admin')],
        ]);
        DB::table('user_role')->insert([
            ['user_id' => 1, 'role_id'=>1],
        ]);
        DB::table('role_permission')->insert([
            ['role_id' => 1, 'permission_id'=>2],
            ['role_id' => 1, 'permission_id'=>3],
            ['role_id' => 1, 'permission_id'=>4],
            ['role_id' => 1, 'permission_id'=>5],
            ['role_id' => 1, 'permission_id'=>7],
            ['role_id' => 1, 'permission_id'=>8],
            ['role_id' => 1, 'permission_id'=>9],
            ['role_id' => 1, 'permission_id'=>10],
        ]);


    }
}
