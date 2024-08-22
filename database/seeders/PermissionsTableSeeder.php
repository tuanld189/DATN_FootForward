<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            // User Permissions
            [
                'name' => 'create_user',
                'description' => 'Cho phép tạo người dùng mới',
                'is_active' => true,
            ],
            [
                'name' => 'edit_user',
                'description' => 'Cho phép chỉnh sửa người dùng hiện có',
                'is_active' => true,
            ],
            [
                'name' => 'delete_user',
                'description' => 'Cho phép xóa người dùng',
                'is_active' => true,
            ],
            [
                'name' => 'view_user',
                'description' => 'Cho phép xem chi tiết người dùng',
                'is_active' => true,
            ],

            // Product Permissions
            [
                'name' => 'create_product',
                'description' => 'Cho phép tạo sản phẩm mới',
                'is_active' => true,
            ],
            [
                'name' => 'edit_product',
                'description' => 'Cho phép chỉnh sửa sản phẩm hiện có',
                'is_active' => true,
            ],
            [
                'name' => 'delete_product',
                'description' => 'Cho phép xóa sản phẩm',
                'is_active' => true,
            ],
            [
                'name' => 'view_product',
                'description' => 'Cho phép xem chi tiết sản phẩm',
                'is_active' => true,
            ],

            // Order Permissions
            [
                'name' => 'create_order',
                'description' => 'Cho phép tạo đơn hàng mới',
                'is_active' => true,
            ],
            [
                'name' => 'edit_order',
                'description' => 'Cho phép chỉnh sửa đơn hàng',
                'is_active' => true,
            ],
            [
                'name' => 'delete_order',
                'description' => 'Cho phép xóa đơn hàng',
                'is_active' => true,
            ],
            [
                'name' => 'view_order',
                'description' => 'Cho phép xem chi tiết đơn hàng',
                'is_active' => true,
            ],

            // Voucher Permissions
            [
                'name' => 'create_voucher',
                'description' => 'Cho phép tạo voucher mới',
                'is_active' => true,
            ],
            [
                'name' => 'edit_voucher',
                'description' => 'Cho phép chỉnh sửa voucher',
                'is_active' => true,
            ],
            [
                'name' => 'delete_voucher',
                'description' => 'Cho phép xóa voucher',
                'is_active' => true,
            ],
            [
                'name' => 'view_voucher',
                'description' => 'Cho phép xem chi tiết voucher',
                'is_active' => true,
            ],

            // Post Permissions
            [
                'name' => 'create_post',
                'description' => 'Cho phép tạo bài viết mới',
                'is_active' => true,
            ],
            [
                'name' => 'edit_post',
                'description' => 'Cho phép chỉnh sửa bài viết',
                'is_active' => true,
            ],
            [
                'name' => 'delete_post',
                'description' => 'Cho phép xóa bài viết',
                'is_active' => true,
            ],
            [
                'name' => 'view_post',
                'description' => 'Cho phép xem chi tiết bài viết',
                'is_active' => true,
            ],

            // Comment Permissions
            [
                'name' => 'create_comment',
                'description' => 'Cho phép tạo bình luận mới',
                'is_active' => true,
            ],
            [
                'name' => 'edit_comment',
                'description' => 'Cho phép chỉnh sửa bình luận',
                'is_active' => true,
            ],
            [
                'name' => 'delete_comment',
                'description' => 'Cho phép xóa bình luận',
                'is_active' => true,
            ],
            [
                'name' => 'view_comment',
                'description' => 'Cho phép xem chi tiết bình luận',
                'is_active' => true,
            ],

            // Banner Permissions
            [
                'name' => 'create_banner',
                'description' => 'Cho phép tạo banner mới',
                'is_active' => true,
            ],
            [
                'name' => 'edit_banner',
                'description' => 'Cho phép chỉnh sửa banner',
                'is_active' => true,
            ],
            [
                'name' => 'delete_banner',
                'description' => 'Cho phép xóa banner',
                'is_active' => true,
            ],
            [
                'name' => 'view_banner',
                'description' => 'Cho phép xem chi tiết banner',
                'is_active' => true,
            ],
        ]);
    }
}
