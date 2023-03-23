<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Vĩnh Cường',
                'user_name' => 'vinhcuongqbh',
                'email' => 'vinhcuongqbh@gmail.com',
                'password' => Hash::make('123456'),      
                'center_id' => null,        
                'role_id' => 1,
                'created_at' => Carbon::now(),
            ],
            // [
            //     'name' => 'Ngọc Mai',
            //     'user_name' => 'ngocmaiqbh',
            //     'email' => 'ngocmaiqbh@gmail.com',
            //     'password' => Hash::make('123456'),
            //     'center_id' => 1,
            //     'role_id' => 2,
            //     'created_at' => Carbon::now(),
            // ],
            // [
            //     'name' => 'Vĩnh Linh',
            //     'user_name' => 'vinhlinhqbh',
            //     'email' => 'vinhlinhqbh@gmail.com',
            //     'password' => Hash::make('123456'),
            //     'center_id' => 2,
            //     'role_id' => 2,
            //     'created_at' => Carbon::now(),
            // ],
            // [
            //     'name' => 'Minh Hồng',
            //     'user_name' => 'minhhongqbh',
            //     'email' => 'minhhongqbh@gmail.com',
            //     'password' => Hash::make('123456'),
            //     'center_id' => 1,
            //     'role_id' => 2,
            //     'created_at' => Carbon::now(),
            // ],
            // [
            //     'name' => 'Vĩnh Khang',
            //     'user_name' => 'vinhkhangqbh',
            //     'email' => 'vinhkhangqbh@gmail.com',
            //     'password' => Hash::make('123456'),
            //     'center_id' => 2,
            //     'role_id' => 2,
            //     'created_at' => Carbon::now(),
            // ],
            // [
            //     'name' => 'Vĩnh Thành',
            //     'user_name' => 'vinhthanhqbh',
            //     'email' => 'vinhthanhqbh@gmail.com',
            //     'password' => Hash::make('123456'),
            //     'center_id' => null,
            //     'role_id' => 3,
            //     'created_at' => Carbon::now(),
            // ],
            // [
            //     'name' => 'Khánh Trinh',
            //     'user_name' => 'khanhtrinhqbh',
            //     'email' => 'khanhtrinhqbh@gmail.com',
            //     'password' => Hash::make('123456'),
            //     'center_id' => null,
            //     'role_id' => 4,
            //     'created_at' => Carbon::now(),
            // ]
        ];

        User::insert($users);
    }
}
