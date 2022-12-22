<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\AccountBankType;
use Illuminate\Database\Seeder;

class AccountBankTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]   =   ['name'     =>  strtoupper('nacional'),      'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('internacional'), 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New AccountBankType();
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
