<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\CreditCard;
use App\Models\Clients\Payments\CreditCardEntity;
use App\Models\Clients\Payments\CreditCardType;
use App\Models\Clients\Profile\Client;
use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
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

        $CC[0]    =   [
            'name'      =>  strtoupper("Robin Alem"),
            'card'      =>  '4768125234841228',
            'cvv'       =>  '322',
            'month'     =>  '09',
            'year'      =>  '2023',
            'entity'    =>  CreditCardEntity::where('name', 'LIKE', '%vis%')->first()->name,
            'type'      =>  CreditCardType::where('name', 'LIKE', '%nac%')->first()->name,
            'status'    =>  $aStatus
        ];

        $CC[1]    =   [
            'name'      =>  strtoupper("Miralem Brown"),
            'card'      =>  '5414766402970672',
            'cvv'       =>  '270',
            'month'     =>  '04',
            'year'      =>  '2028',
            'entity'    =>  CreditCardEntity::where('name', 'LIKE', '%mas%')->first()->name,
            'type'      =>  CreditCardType::where('name', 'LIKE', '%int%')->first()->name,
            'status'    =>  $sStatus
        ];

        try {

            $cli    =   Client::first();

            foreach ($CC as $c => $ca) 
            {
                $iCard  =   [
                    'name'      =>  $ca['name'],
                    'last'      =>  substr($ca['card'],-8),
                    'cvv'       =>  $ca['cvv'],
                    'month'     =>  $ca['month'],
                    'year'      =>  $ca['year'],
                    'cypher'    =>  $ca,
                    'type_id'   =>  CreditCardType::where('name', 'like', '%'.substr($ca['type'],0,3).'%')->first()->id,
                    'entity_id' =>  CreditCardEntity::where('name', 'like', '%'.substr($ca['entity'],0,3).'%')->first()->id,
                    'status_id' =>  Status::where('name', 'LIKE', '%'.substr($ca['status'],0,3).'%')->first()->id,
                    'client_id' =>  $cli->id
                ];

                $tdc    =   CreditCard::RegisterData($iCard);
            }         
            
        } catch (\Exception $e) {
            echo 'CreditCardSeeder: ',  $e->getMessage(), "\n";
        }
    }
}
