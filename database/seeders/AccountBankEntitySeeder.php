<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\AccountBankEntity;
use Illuminate\Database\Seeder;

class AccountBankEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]   =   ['name'     =>  ucfirst('Ahorro'),    'status'   =>  $status];
        $data[1]   =   ['name'     =>  ucfirst('corriente'), 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New AccountBankEntity();
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
