<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[0]   =   ['name'     =>  strtoupper('activo')];
        $data[1]   =   ['name'     =>  strtoupper('suspendido')];

        foreach ($data as $d => $da) 
        {
            $new    =   New Status();
            $new->name      =   $da['name'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }

    }
}
