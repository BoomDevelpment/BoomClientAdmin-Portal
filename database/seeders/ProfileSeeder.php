<?php

namespace Database\Seeders;

use App\Models\Clients\General\Profile;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]   =   ['name'     =>  strtoupper('cliente'),           'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('administrativo'),    'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New Profile();
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
