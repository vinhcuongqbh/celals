<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use Carbon\Carbon;


class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole =  [
            [
                'role_id' => 1,
                'role_name' => 'Quản trị hệ thống',
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 2,
                'role_name' => 'Nhân viên',
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 3,
                'role_name' => 'Cộng tác viên',
                'created_at' => Carbon::now(),
            ],
            // [
            //     'role_id' => 4,
            //     'role_name' => 'Người dùng',
            //     'created_at' => Carbon::now(),
            // ]
        ];

        UserRole::insert($userRole);
    }
}
