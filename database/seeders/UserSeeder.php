<?php

namespace Database\Seeders;

use App\Models\Clients\General\Profile;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pAdmin     =   Profile::where('name', 'like', '%adm%')->first()->id;
        $pClient    =   Profile::where('name', 'like', '%%cli%')->first()->id;
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        
        /**
         * Register Operators
         */
        
        $operator    =   Operator::get();

        foreach ($operator as $o => $ope) 
        {
        
            $us             =   New User();
            $us->name       =   $ope->name;
            $us->username   =   $ope->username;
            $us->email      =   strtolower('luis.924@boomsolutions.com');
            $us->password   =   bcrypt('Boom1234');
            $us->identified =   random_int(10000000, 99999999);
            $us->profile_id =   $pAdmin;
            $us->status_id  =   $status;

            try {
                $us->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }

        /**
         * Register Clients
         */

        $clients    =   Client::get();

        foreach ($clients as $c => $cli) 
        {
        
            $us             =   New User();
            $us->name       =   $cli->name;
            $us->username   =   '123456789';
            $us->email      =   $cli->email_principal;
            $us->password   =   bcrypt('123456789');
            $us->identified =   random_int(10000000, 99999999);
            $us->profile_id =   $pClient;
            $us->status_id  =   $status;

            try {
                $us->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
