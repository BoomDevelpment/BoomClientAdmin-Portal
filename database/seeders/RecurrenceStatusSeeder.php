<?php

namespace Database\Seeders;

use App\Models\Admins\Clients\RecurrenceStatus;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class RecurrenceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   = ['status' => $status, 'name' => ucfirst('Pendiente')];
        $data[1]   = ['status' => $status, 'name' => ucfirst('Procesado')];
        $data[2]   = ['status' => $status, 'name' => ucfirst('Anulado')];
        $data[3]   = ['status' => $status, 'name' => ucfirst('Cancelado')];

        foreach ($data as $d => $dat) 
        {          
            try {
                $new    =   new RecurrenceStatus();
                $new->name      =   $dat['name'];
                $new->status_id =   $dat['status'];
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
