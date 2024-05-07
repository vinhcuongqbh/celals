<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Center;


class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $center = [
            [
                'center_id' => 1,
                'center_name' => 'Trung tâm Đồng Hới',
                'center_tel' => '0232 3822012',
                'center_address' => 'Phường Đồng Phú - TP. Đồng Hới - Tỉnh Quảng Bình',
                'created_at' => Carbon::now(),
            ],
            [
                'center_id' => 2,
                'center_name' => 'Trung tâm Bố Trạch',
                'center_tel' => '0232 3823995',
                'center_address' => 'Thị trấn Hoàn Lão - Huyện Bố Trạch - Tỉnh Quảng Bình',
                'created_at' => Carbon::now(),
            ],
            // [
            //     'center_id' => 3,
            //     'center_name' => 'Trung tâm Ba Đồn',
            //     'center_tel' => '0232 3826103',
            //     'center_address' => 'Thị xã Ba Đồn - Tỉnh Quảng Bình',
            //     'created_at' => Carbon::now(),
            // ],
            // [
            //     'center_id' => 4,
            //     'center_name' => 'Trung tâm Lệ Thủy',
            //     'center_tel' => '0232 3823995',
            //     'center_address' => 'Thị trấn Kiến Giang - Huyện Lệ Thủy - Tỉnh Quảng Bình',
            //     'created_at' => Carbon::now(),
            // ],
        ];

        Center::insert($center);
    }
}
