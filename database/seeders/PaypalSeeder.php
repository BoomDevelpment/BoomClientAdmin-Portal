<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Paypal\Paypal;
use Illuminate\Database\Seeder;

class PaypalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0] = [
            'client'    =>  env('PAYPAL_SANDBOX_CLIENT'),
            'secrect'   =>  env('PAYPAL_SANDBOX_SECRET'),
            'mode'      =>  env('PAYPAL_MODE'),
            'status'    =>  $status
        ];

        foreach ($data as $d => $da) 
        {
            $new    =   New Paypal();
            $new->client    =   $da['client'];
            $new->secret    =   $da['secrect'];
            $new->mode      =   $da['mode'];
            $new->status_id =   $da['status'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }


    }
}
