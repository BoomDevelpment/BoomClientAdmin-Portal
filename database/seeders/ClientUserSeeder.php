<?php

namespace Database\Seeders;

use App\Models\Clients\Pivot\ClientUser;
use App\Models\Clients\Profile\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user   =   User::get();
        $client =   Client::get();

        foreach ($client as $c => $cl) 
        {
            foreach ($user as $u => $us) 
            {

                if($cl->name == $us->name)
                {                    
                    $new                =   new ClientUser();
                    $new->client_id     =   $cl->id;
                    $new->user_id       =   $us->id;

                    try {
                        $new->save();
                    } catch (\Exception $e) {
                        var_dump($e->getMessage());
                    }
                }
            }            
        }
    }
}
