<?php

namespace Database\Seeders;

use App\Models\Clients\CustomerServices\CustomerFiel;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class CustomerFielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =   ['name'     =>  strtoupper('action'),                'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('information'),           'status'   =>  $status];
        $data[2]   =   ['name'     =>  strtoupper('information read'),      'status'   =>  $status];
        $data[3]   =   ['name'     =>  strtoupper('information info read'), 'status'   =>  $status];
        $data[4]   =   ['name'     =>  strtoupper('message'),               'status'   =>  $status];
        $data[5]   =   ['name'     =>  strtoupper('List'),                  'status'   =>  $status];
        $data[6]   =   ['name'     =>  strtoupper('List And Message'),      'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New CustomerFiel();
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
