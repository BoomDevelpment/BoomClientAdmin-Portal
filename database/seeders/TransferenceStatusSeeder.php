<?php

namespace Database\Seeders;

use App\Models\Clients\Transference\TransferenceStatus;
use Illuminate\Database\Seeder;

class TransferenceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[0]   =   ['name'     =>  strtoupper('Consolidado')];
        $data[1]   =   ['name'     =>  strtoupper('Procesado')];
        $data[2]   =   ['name'     =>  strtoupper('Pendiente')];
        $data[3]   =   ['name'     =>  strtoupper('Rechazado')];
        $data[4]   =   ['name'     =>  strtoupper('Cancelado')];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New TransferenceStatus();
            $new->name      =   $da['name'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
