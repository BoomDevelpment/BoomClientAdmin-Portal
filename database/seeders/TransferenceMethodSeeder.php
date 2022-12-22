<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Transference\TransferenceMethod;
use Illuminate\Database\Seeder;

class TransferenceMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =   ['name'     =>  strtoupper('Zelle'),                     'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('Paypal'),                    'status'   =>  $status];
        $data[2]   =   ['name'     =>  strtoupper('transferencia bancaria'),    'status'   =>  $status];
        $data[3]   =   ['name'     =>  strtoupper('pago movil'),                'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New TransferenceMethod();
            $new->name      =   $da['name'];
            $new->status_id =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
