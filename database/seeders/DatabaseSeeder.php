<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make(123) ,
            'remember_token' => '1234567890'
        ]);
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

            ['id'=> 11, 'name' => 'user', 'display_name' => 'người dùng', 'parent_id'=> 0, 'key_code' => 'user'],
            ['id'=> 12, 'name' => 'view user', 'display_name' => 'Danh sách người dùng', 'parent_id'=> 11, 'key_code' => 'user_view'],
            ['id'=> 13, 'name' => 'add user', 'display_name' => 'Thêm người dùng', 'parent_id'=> 11, 'key_code' => 'user_add'],
            ['id'=> 14, 'name' => 'edit user', 'display_name' => 'Sửa người dùng', 'parent_id'=> 11, 'key_code' => 'user_edit'],
            ['id'=> 15, 'name' => 'delete user', 'display_name' => 'Xóa người dùng', 'parent_id'=> 11, 'key_code' => 'user_delete'],

            ['id'=> 16, 'name' => 'menu', 'display_name' => 'menu', 'parent_id'=> 0, 'key_code' => 'menu'],
            ['id'=> 17, 'name' => 'view menu', 'display_name' => 'Danh sách menu', 'parent_id'=> 16, 'key_code' => 'menu_view'],
            ['id'=> 18, 'name' => 'add menu', 'display_name' => 'Thêm menu', 'parent_id'=> 16, 'key_code' => 'menu_add'],
            ['id'=> 19, 'name' => 'edit menu', 'display_name' => 'Sửa menu', 'parent_id'=> 16, 'key_code' => 'menu_edit'],
            ['id'=> 20, 'name' => 'delete user', 'display_name' => 'Xóa menu', 'parent_id'=> 16, 'key_code' => 'menu_delete'],

            ['id'=> 21, 'name' => 'order', 'display_name' => 'đơn hàng', 'parent_id'=> 0, 'key_code' => 'order'],
            ['id'=> 22, 'name' => 'view order', 'display_name' => 'Danh sách đơn hàng', 'parent_id'=> 21, 'key_code' => 'order_view'],
            ['id'=> 23, 'name' => 'add order', 'display_name' => 'Thêm đơn hàng', 'parent_id'=> 21, 'key_code' => 'order_add'],
            ['id'=> 24, 'name' => 'edit order', 'display_name' => 'Sửa đơn hàng', 'parent_id'=> 21, 'key_code' => 'order_edit'],
            ['id'=> 25, 'name' => 'delete order', 'display_name' => 'Xóa đơn hàng', 'parent_id'=> 21, 'key_code' => 'order_delete'],

            //slider
            ['id'=> 26, 'name' => 'slider', 'display_name' => 'quảng cáo', 'parent_id'=> 0, 'key_code' => 'slider'],
            ['id'=> 27, 'name' => 'view slider', 'display_name' => 'Danh sách quảng cáo', 'parent_id'=> 26, 'key_code' => 'slider_view'],
            ['id'=> 28, 'name' => 'add slider', 'display_name' => 'Thêm quảng cáo', 'parent_id'=> 26, 'key_code' => 'slider_add'],
            ['id'=> 29, 'name' => 'edit slider', 'display_name' => 'Sửa quảng cáo', 'parent_id'=> 26, 'key_code' => 'slider_edit'],
            ['id'=> 30, 'name' => 'delete slider', 'display_name' => 'Xóa quảng cáo', 'parent_id'=> 26, 'key_code' => 'slider_delete'],
            //product
            ['id'=> 31, 'name' => 'product', 'display_name' => 'sản phẩm', 'parent_id'=> 0, 'key_code' => 'product'],
            ['id'=> 32, 'name' => 'view product', 'display_name' => 'Danh sách sản phẩm', 'parent_id'=> 31, 'key_code' => 'product_view'],
            ['id'=> 33, 'name' => 'add product', 'display_name' => 'Thêm sản phẩm', 'parent_id'=> 31, 'key_code' => 'product_add'],
            ['id'=> 34, 'name' => 'edit product', 'display_name' => 'Sửa sản phẩm', 'parent_id'=> 31, 'key_code' => 'product_edit'],
            ['id'=> 35, 'name' => 'delete product', 'display_name' => 'Xóa sản phẩm', 'parent_id'=> 31, 'key_code' => 'product_delete'],
            //category
            ['id'=> 36, 'name' => 'category', 'display_name' => 'danh mục', 'parent_id'=> 0, 'key_code' => 'category'],
            ['id'=> 37, 'name' => 'view category', 'display_name' => 'Danh sách danh mục', 'parent_id'=> 36, 'key_code' => 'category_view'],
            ['id'=> 38, 'name' => 'add category', 'display_name' => 'Thêm danh mục', 'parent_id'=> 36, 'key_code' => 'category_add'],
            ['id'=> 39, 'name' => 'edit category', 'display_name' => 'Sửa danh mục', 'parent_id'=> 36, 'key_code' => 'category_edit'],
            ['id'=> 40, 'name' => 'delete category', 'display_name' => 'Xóa danh mục', 'parent_id'=> 36, 'key_code' => 'category_delete'],

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

            ['role_id' => 1, 'permission_id'=>12],
            ['role_id' => 1, 'permission_id'=>13],
            ['role_id' => 1, 'permission_id'=>14],
            ['role_id' => 1, 'permission_id'=>15],

            ['role_id' => 1, 'permission_id'=>17],
            ['role_id' => 1, 'permission_id'=>18],
            ['role_id' => 1, 'permission_id'=>19],
            ['role_id' => 1, 'permission_id'=>20],

            ['role_id' => 1, 'permission_id'=>22],
            ['role_id' => 1, 'permission_id'=>23],
            ['role_id' => 1, 'permission_id'=>24],
            ['role_id' => 1, 'permission_id'=>25],

            ['role_id' => 1, 'permission_id'=>27],
            ['role_id' => 1, 'permission_id'=>28],
            ['role_id' => 1, 'permission_id'=>29],
            ['role_id' => 1, 'permission_id'=>30],

            ['role_id' => 1, 'permission_id'=>32],
            ['role_id' => 1, 'permission_id'=>33],
            ['role_id' => 1, 'permission_id'=>34],
            ['role_id' => 1, 'permission_id'=>35],

            ['role_id' => 1, 'permission_id'=>37],
            ['role_id' => 1, 'permission_id'=>38],
            ['role_id' => 1, 'permission_id'=>39],
            ['role_id' => 1, 'permission_id'=>40],
        ]);
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        //

    }
}
