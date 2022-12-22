<?php

namespace Database\Seeders;

use App\Models\Clients\General\Bank;
use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\AccountBank;
use App\Models\Clients\Payments\AccountBankEntity;
use App\Models\Clients\Payments\AccountBankType;
use App\Models\Clients\Profile\Client;
use Illuminate\Database\Seeder;

class AccountBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aStatus     =   Status::where('name', 'like', '%act%')->first()->name;
        $sStatus     =   Status::where('name', 'like', '%sus%')->first()->name;

        
        $AB[0]    =   [
            'name'      =>  strtoupper("Boldizsar Fuerst"),
            'account'   =>  '1030864164',
            'bank'      =>  Bank::where('name', 'LIKE', '%pro%')->first()->name,
            'entity'    =>  AccountBankEntity::where('name', 'LIKE', '%corr%')->first()->name,
            'type'      =>  AccountBankType::where('name', 'LIKE', '%nac%')->first()->name,
            'status'    =>  $aStatus
        ];
        
        $AB[1]    =   [
            'name'      =>  strtoupper("Durrah Hynek"),
            'account'   =>  '8554440572',
            'bank'      =>  Bank::where('name', 'LIKE', '%banes%')->first()->name,
            'entity'    =>  AccountBankEntity::where('name', 'LIKE', '%corr%')->first()->name,
            'type'      =>  AccountBankType::where('name', 'LIKE', '%int%')->first()->name,
            'status'    =>  $sStatus
        ];
        
        try {
            $client =   Client::first();
             
            foreach ($AB as $c => $tab) 
            {
                $iAB     =   [
                    'name'          =>  $tab['name'],
                    'last'          =>  substr($tab['account'],-8),
                    'cypher'        =>  $tab,
                    'bank_id'       =>  Bank::where('name', 'LIKE', '%'.substr($tab['bank'],0,6).'%')->first()->id,
                    'type_id'       =>  AccountBankType::where('name', 'LIKE', '%'.substr($tab['type'],0,3).'%')->first()->id,
                    'entity_id'     =>  AccountBankEntity::where('name', 'LIKE', '%'.substr($tab['entity'],0,3).'%')->first()->id,
                    'status_id'     =>  Status::where('name', 'LIKE', '%'.substr($tab['status'],0,3).'%')->first()->id,
                    'client_id'    =>  $client->id,
                ];

                $tdc    =   AccountBank::RegisterData($iAB);
            } 

        } catch (\Exception $e) {
            var_dump('AccountBankSeeder: ',$e->getMessage());
        }
    }
}
