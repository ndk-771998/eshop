<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrPermissions = [
            1 => 'Categories',
            2 => 'Products',
            3 => 'Menus',
            4 => 'Sliders',
            5 => 'Settings',
            6 => 'Posts',
            7 => 'Users',
            8 => 'Roles'
        ];
        foreach ($arrPermissions as $value) {
            DB::table('permissions')->insert([
                ['name' => $value, 'display_name' => $value, 'parent_id' => 0],
            ]);
        }
        foreach ($arrPermissions as $key => $value) {
            DB::table('permissions')->insert([
                ['name' => 'List '.$value, 'display_name' => 'Danh sách', 'parent_id' => $key, 'key_code' => 'list_'.strtolower($value)],
                ['name' => 'Add '.$value, 'display_name' => 'Thêm', 'parent_id' => $key, 'key_code' => 'add_'.strtolower($value)],
                ['name' => 'Fix '.$value, 'display_name' => 'Sửa', 'parent_id' => $key, 'key_code' => 'fix_'.strtolower($value)],
                ['name' => 'Delete '.$value, 'display_name' => 'Xoá', 'parent_id' => $key, 'key_code' => 'delete_'.strtolower($value)],
            ]);
        }
    }
}
