<?php

namespace Database\Seeders;

use App\Models\Clients\CustomerServices\CustomerRequestType;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class CustomerRequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =   ['name'     =>  strtoupper('Customer Services'),     'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('Payment'),               'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New CustomerRequestType();
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
