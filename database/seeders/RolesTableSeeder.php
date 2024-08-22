<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo các role mới
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Admin có quyền quản trị toàn bộ hệ thống',
            ],
            [
                'name' => 'editor',
                'description' => 'Editor có quyền quản lý nội dung',
            ],
            [
                'name' => 'user',
                'description' => 'User có quyền sử dụng chức năng của hệ thống',
            ],
        ];

        foreach ($roles as $roleData) {
            // Tạo role
            $role = Role::create($roleData);

            // Gán các permission theo role
            switch ($role->name) {
                case 'admin':
                    // Gán tất cả các quyền cho admin
                    $permissions = Permission::all();
                    $role->permissions()->attach($permissions);
                    break;

                case 'editor':
                    // Gán các quyền liên quan đến quản lý nội dung cho editor
                    $permissions = Permission::whereIn('name', [
                        'create_post', 'edit_post', 'delete_post', 'view_post',
                        'create_comment', 'edit_comment', 'delete_comment', 'view_comment',
                        'create_banner', 'edit_banner', 'delete_banner', 'view_banner',
                    ])->get();
                    $role->permissions()->attach($permissions);
                    break;

                case 'user':
                    // Gán các quyền cơ bản cho user
                    $permissions = Permission::whereIn('name', [
                        'view_post', 'view_comment',
                    ])->get();
                    $role->permissions()->attach($permissions);
                    break;
            }
        }
    }
}
