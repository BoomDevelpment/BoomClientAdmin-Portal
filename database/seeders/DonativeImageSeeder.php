<?php

namespace Database\Seeders;

use App\Models\Clients\Donative\DonativeImage;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class DonativeImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]    =   ['name'     =>  '01-2022.png', 'src' => '/src/images/donative/', 'status'   =>  $status];
        $data[1]    =   ['name'     =>  '02-2022.png', 'src' => '/src/images/donative/', 'status'   =>  $status];
        $data[2]    =   ['name'     =>  '03-2022.png', 'src' => '/src/images/donative/', 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New DonativeImage();
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
