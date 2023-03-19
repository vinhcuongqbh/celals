<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferralStatus;
use Carbon\Carbon;

class ReferralStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $refStatus =  [
            [
                'ref_status_id' => 1,
                'ref_status_name' => 'Chờ xử lý',
                'created_at' => Carbon::now(),
            ],
            [
                'ref_status_id' => 2,
                'ref_status_name' => 'Đã xử lý',
                'created_at' => Carbon::now(),
            ],
            [
                'ref_status_id' => 3,
                'ref_status_name' => 'Đồng ý',
                'created_at' => Carbon::now(),
            ],
            [
                'ref_status_id' => 4,
                'ref_status_name' => 'Từ chối',
                'created_at' => Carbon::now(),
            ]
        ];

        ReferralStatus::insert($refStatus);
    }
}
