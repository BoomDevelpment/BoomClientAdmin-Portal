<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users     =   User::get();

        foreach ($users as $u => $cl) 
        {
            $user       =   User::find($cl->id);
            $myWallet   =   $user->getWallet($user->identified);
               
            if($myWallet == false)
            {
                $user->createWallet([
                    'name'          =>  $cl->identified,
                    'slug'          =>  $cl->identified,
                    'meta'          =>  'USD',
                    'description'   =>  'Wallet Client: '.$cl->name.''
                ]);
            }
        }
    }
}
