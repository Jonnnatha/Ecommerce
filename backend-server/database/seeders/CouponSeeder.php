<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::insert([
            [
                "id" => 1,
                "code" => "CODERS",
                "value" => "200",
                "type" => "fixed",
                "status" => "active"
            ],
            [
                "id" => 2,
                "code" => "EID",
                "value" => "10",
                "type" => "percent",
                "status" => "active"
            ],
        ]);
    }
}
