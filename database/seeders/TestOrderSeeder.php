<?php

namespace Database\Seeders;

use App\Models\TestOrder;
use Illuminate\Database\Seeder;

class TestOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $key => $each) {
            TestOrder::create([
                'transaction_id' => null,
                'amount' => 1 + $each,
                'payment_status' => 0,
            ]);
        }
    }
}
