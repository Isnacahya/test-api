<?php

use App\Data;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Data::create();
    	foreach (range(1,1000) as $index) {
            DB::table('data')->insert([
                'orderId' => $faker->orderId,
                'invoiceNumber' => $faker->invoiceNumber,
                'orderName' => $faker->orderName,
                'orderDetail' => $faker->orderDetail,
            ]);
        }
    }
}
