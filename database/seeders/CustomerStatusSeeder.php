<?php

namespace Database\Seeders;

use App\Models\Clients\CustomerServices\CustomerStatus;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =   ['name'     =>  strtoupper('Procesado'),     'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('Pendiente'),     'status'   =>  $status];
        $data[2]   =   ['name'     =>  strtoupper('Suspendido'),    'status'   =>  $status];
        $data[3]   =   ['name'     =>  strtoupper('Anulado'),       'status'   =>  $status];
        $data[4]   =   ['name'     =>  strtoupper('Eliminado'),     'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New CustomerStatus();
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
