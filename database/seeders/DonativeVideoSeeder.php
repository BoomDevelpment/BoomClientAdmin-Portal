<?php

namespace Database\Seeders;

use App\Models\Clients\Donative\DonativeVideo;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class DonativeVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]    =   ['name'     =>  'manitosboom2022.mp4', 'src' => '/src/videos/donative/', 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New DonativeVideo();
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
