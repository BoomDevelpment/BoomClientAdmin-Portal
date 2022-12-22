<?php

namespace Database\Seeders;

use App\Models\Clients\Donative\DonativeRegister;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class DonativeRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donate     =   1.57;
        $client     =   Client::WHERE('name','LIKE','%dev%')->first();
        $user       =   User::findOrFail($client->id);
        $myWallet   =   $user->getWallet($user->identified);
        $balance    =   $myWallet->balanceFloat;

        $don        =   $myWallet->WithdrawFloat($donate, ['Description' => 'DONATIVO DE $ '.$donate.' PARA MANITOS BOOM']);
      
        if($don->confirmed ==  true)
        {
            $iData  =   [
                'client'        =>  $user->client_id,
                'amount'        =>  $donate,
                'transaction'   =>  $don->id,
                'status_id'     =>  TransferenceStatus::where('name', 'LIKE', '%pro%')->first()->id
            ];
        
            $insert     =   DonativeRegister::Register($iData);
        }
    }
}
