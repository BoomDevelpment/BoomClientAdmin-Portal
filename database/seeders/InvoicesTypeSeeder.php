<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Invoices\InvoicesType;
use Illuminate\Database\Seeder;

class InvoicesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =  ["name"  =>  strtoupper("pago automatico"),    "status" => $status];
        
        foreach ($data as $d => $da) 
        {
            $new    = New InvoicesType();
            $new->name          =   $da['name'];
            $new->status_id     =   $da['status'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }

        }
    }
}
