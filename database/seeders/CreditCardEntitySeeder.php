<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\CreditCardEntity;
use Illuminate\Database\Seeder;

class CreditCardEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]   =   ['name'     =>  strtoupper('VISA'),              'status'   =>  $status, 'path' =>   'src/images/payment/visa.jpg'];
        $data[1]   =   ['name'     =>  strtoupper('MASTERCARD'),        'status'   =>  $status, 'path' =>   'src/images/payment/mastercard.jpg'];
        $data[2]   =   ['name'     =>  strtoupper('AMERICAN EXPRESS'),  'status'   =>  $status, 'path' =>   'src/images/payment/amex.jpg'];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New CreditCardEntity();
            $new->name      =   $da['name'];
            $new->path      =   $da['path'];
            $new->status_id =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
