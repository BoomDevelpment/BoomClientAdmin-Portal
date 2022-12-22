<?php

namespace App\Models\Clients\Payments;

use App\Helpers\DataCypher;
use App\Models\Clients\General\Bank;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountBank extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);             }
    public function bank()      {   return $this->belongsTo(Bank::class);               }
    public function type()      {   return $this->belongsTo(AccountBankType::class);    }
    public function entity()    {   return $this->belongsTo(AccountBankEntity::class);  }
    public function client()    {   return $this->belongsTo(Client::class);             }
    public function key()       {   return $this->belongsTo(AccountBankKey::class);     }

    public static function RegisterData($data)
    {

        $kCy    =   bin2hex(random_bytes(16));
        $key    =   bin2hex(random_bytes(16));
        
        $cy     =   new DataCypher($key);

        $new                =   new AccountBank();
        $new->name          =   strtoupper($data['name']);
        $new->last          =   strtoupper($data['last']);
        $new->cypher        =   $cy->CypherData(json_encode($data['cypher']), $kCy)['cypher'];
        $new->keygen        =   $key;
        $new->key_id        =   AccountBankKey::Register($cy->CypherData(json_encode($kCy), $key), $key);
        $new->type_id       =   strtoupper($data['type_id']);
        $new->entity_id     =   strtoupper($data['entity_id']);
        $new->bank_id       =   strtoupper($data['bank_id']);
        $new->status_id     =   strtoupper($data['status_id']);
        $new->client_id     =   strtoupper($data['client_id']);

        try {
            return  ( $new->save() ) ? true : false;
        } catch (\Exception $e) {
            return false;
        }

    }
    public static function Register($data)
    {
        $status             =   false;

        $kCy    =   bin2hex(random_bytes(16));
        $key    =   bin2hex(random_bytes(16));
        
        $cy     =   new DataCypher($key);
       
        $AB    =   [
            'name'      =>  strtoupper($data['aTitle']),
            'account'   =>  $data['aNumber'],
            'entity'    =>  AccountBankEntity::findOrFail($data['aEntity'])->name,
            'type'      =>  AccountBankType::findOrFail($data['aType'])->name,
            'bank'      =>  Bank::findOrFail($data['aBank'])->name,
        ];
        
        $ab                 =   new AccountBank();
        $ab->name           =   strtoupper($data['aTitle']);
        $ab->last           =   substr($data['aNumber'], -5);
        $ab->cypher         =   $cy->CypherData(json_encode($AB), $kCy)['cypher'];
        $ab->keygen         =   $key;
        $ab->key_id         =   AccountBankKey::Register($cy->CypherData(json_encode($kCy), $key), $key);
        $ab->type_id        =   strtoupper($data['aType']);
        $ab->entity_id      =   strtoupper($data['aEntity']);
        $ab->bank_id        =   strtoupper($data['aBank']);
        $ab->status_id      =   1;
        $ab->client_id      =   auth()->user()->client->client_id;

        try {
            $ab->save();
            $upd    =   AccountBank::where('id', '<>', $ab->id)->update(['status_id' => '2']);
            $status =   true;
            
        } catch (\Exception $e) {
            $status =   false;
        }
        
        return  $status;

    }

    public static function Search($id)
    {
        try {
            $card       =   AccountBank::findOrFail($id);

            $cy         =   new DataCypher($card->keygen);

            $keygen     =   $cy->UnCypher(json_encode(AccountBankKey::find($card->key_id)->cypher), $card->keygen);
            
            $cypher     =   $cy->UnCypher(json_encode($card->cypher), $keygen);

            return  [
                'id'        =>  $card->id,
                'name'      =>  $cypher['name'],
                'account'   =>  $cypher['account'],
                'entity'    =>  $card->entity_id,
                'type'      =>  $card->type_id,
                'status'    =>  $card->status_id,
                'bank'      =>  $card->bank_id
            ];

        } catch (\Exception $e) {

            return false;
        }

    }

    public static function UpdateAB($data)
    {        
        $status     =   false;

        $update     =   AccountBank::findOrFail($data->abId);
        $kUpdate    =   AccountBankKey::findOrFail($update->key_id);

        $kCy        =   bin2hex(random_bytes(16));
        $key        =   bin2hex(random_bytes(16));
        
        $cy         =   new DataCypher($key);

        $AB         =   [
            'name'      =>  strtoupper($data['abTitle']),
            'account'   =>  $data['abNumber'],
            'entity'    =>  AccountBankEntity::findOrFail($data['abEntity'])->name,
            'type'      =>  AccountBankType::findOrFail($data['abType'])->name,
            'bank'      =>  Bank::findOrFail($data['abBank'])->name,
        ];

        $update->name           =   strtoupper($data['abTitle']);
        $update->last           =   substr($data['abNumber'], -5);
        $update->cypher         =   $cy->CypherData(json_encode($AB), $kCy)['cypher'];
        $update->keygen         =   $key;
        $update->key_id         =   AccountBankKey::UpdateKey($cy->CypherData(json_encode($kCy), $key), $update->key_id);
        $update->type_id        =   strtoupper($data['abType']);
        $update->entity_id      =   strtoupper($data['abEntity']);
        $update->bank_id        =   strtoupper($data['abBank']);
        $update->status_id      =   strtoupper($data['abStatus']);
        $update->client_id      =   auth()->user()->client->client_id;

        try {
            $update->save();
            if( $data['abStatus'] == 1)
            {
                $upd    =   AccountBank::where('id', '<>', $update->id)->update(['status_id' => '2']);
            }
            $status =   true;
            
        } catch (\Exception $e) {
            $status =   false;
        }
        
        return  $status;

    }

    public static function GetData($data)
    {
        $iAB    =   false;

        foreach ($data as $d => $da) 
        {
            $cy     =   new DataCypher($da->keygen);
            $keygen =   $cy->UnCypher(json_encode(AccountBankKey::find($da->key->id)->cypher), $da->keygen);
            $card   =   $cy->UnCypher(json_encode($da->cypher), $keygen);
   
            $iAB[$d] =   [
                'name'      =>  $card['name'],
                'account'   =>  $card['account'],
                'last'      =>  $da->last,
                'entity'    =>  $da->entity->name,
                'type'      =>  $da->type->name,
                'status'    =>  $da->status->name,
                'bank'      =>  $da->bank->name
            ];   
        }

        return $iAB;
    }
}
