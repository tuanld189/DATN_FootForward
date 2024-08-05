<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo các role chính
        $superAdmin = Role::create(['name' => 'superadmin']);
        $user = Role::create(['name' => 'user']);

        // Tạo admin roles cho từng module
        $adminRoles = [
            'user admin',
            'product admin',
            // Thêm các admin roles khác nếu cần
        ];

        foreach ($adminRoles as $role) {
            Role::create(['name' => $role]);
        }

        // Tạo các permission
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view products',
            'create products',
            'edit products',
            'delete products',
            // Thêm các permissions khác nếu cần
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Gán tất cả permissions cho superadmin
        $superAdmin->permissions()->attach(Permission::all());

        // Gán permissions cho các vai trò admin cụ thể
        $userAdminPermissions = Permission::whereIn('name', ['create users', 'edit users', 'delete users', 'view users'])->get();
        Role::where('name', 'user admin')->first()->permissions()->attach($userAdminPermissions);

        $productAdminPermissions = Permission::whereIn('name', ['create products', 'edit products', 'delete products', 'view products'])->get();
        Role::where('name', 'product admin')->first()->permissions()->attach($productAdminPermissions);
    }
}
