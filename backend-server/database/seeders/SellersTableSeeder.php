<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::create([
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'phone' => '0172260012',
            'password' => 'password',
        ]);
    }
}
