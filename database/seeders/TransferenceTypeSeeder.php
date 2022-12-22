<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Transference\TransferenceType;
use Illuminate\Database\Seeder;

class TransferenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =   ['name'     =>  strtoupper('Dolares'),   'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('Bolivares'), 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New TransferenceType();
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
