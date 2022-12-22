<?php

namespace Database\Seeders;

use App\Models\Clients\CustomerServices\CustomerImagen;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class CustomerImagenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]    =   ['name'     =>  'customer.png', 'src' => '/src/images/customer/', 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New CustomerImagen();
            $new->name      =   $da['name'];
            $new->src       =   $da['src'];
            $new->status_id =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
