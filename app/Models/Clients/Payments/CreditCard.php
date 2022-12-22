<?php

namespace App\Models\Clients\Payments;

use App\Helpers\DataCypher;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    public function Status()    {   return $this->belongsTo(Status::class);             }
    public function type()      {   return $this->belongsTo(CreditCardType::class);     }
    public function entity()    {   return $this->belongsTo(CreditCardEntity::class);   }
    public function client()    {   return $this->belongsTo(Client::class);             }
    public function key()       {   return $this->belongsTo(CreditCardKey::class);      }

    public static function RegisterData($data)
    {
        $status =   false;

        $kCy    =   bin2hex(random_bytes(16));
        $key    =   bin2hex(random_bytes(16));
        
        $cy     =   new DataCypher($key);

        $new    =   new CreditCard();
        $new->name          =   strtoupper($data['name']);
        $new->last          =   strtoupper($data['last']);
        $new->month         =   strtoupper($data['month']);
        $new->year          =   strtoupper($data['year']);
        $new->cvv           =   strtoupper($data['cvv']);
        $new->cypher        =   $cy->CypherData(json_encode($data['cypher']), $kCy)['cypher'];
        $new->keygen        =   $key;
        $new->key_id        =   CreditCardKey::Register($cy->CypherData(json_encode($kCy), $key), $key);
        $new->type_id       =   strtoupper($data['type_id']);
        $new->entity_id     =   strtoupper($data['entity_id']);
        $new->status_id     =   strtoupper($data['status_id']);
        $new->client_id     =   strtoupper($data['client_id']);
        
        try {
            
            return ($new->save()) ? true : false;

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

        $card  =   [
            'name'      =>  strtoupper($data['cTitle']),
            'card'      =>  $data['cNumber'],
            'cvv'       =>  $data['cCvv'],
            'month'     =>  $data['cMonth'],
            'year'      =>  $data['cYear'],
            'entity'    =>  CreditCardEntity::find($data['cEntity'])->name,
            'type'      =>  CreditCardType::find($data['cType'])->name
        ];


        $new    =   new CreditCard();
        $new->name          =   strtoupper($data['cTitle']);
        $new->last          =   strtoupper( substr($data['cNumber'], -8) );
        $new->month         =   strtoupper($data['cMonth']);
        $new->year          =   strtoupper($data['cYear']);
        $new->cvv           =   strtoupper($data['cCvv']);
        $new->cypher        =   $cy->CypherData(json_encode($card), $kCy)['cypher'];
        $new->keygen        =   $key;
        $new->key_id        =   CreditCardKey::Register($cy->CypherData(json_encode($kCy), $key), $key);
        $new->type_id       =   $data['cType'];
        $new->entity_id     =   $data['cEntity'];
        $new->status_id     =   1;
        $new->client_id     =   auth()->user()->client->client_id;

        try {
            $new->save();
            $upd    =   CreditCard::where('id', '<>', $new->id)->update(['status_id' => '2']);
            $status =   true;
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            $status =   false;
        }
        
        return  $status;

    }

    public static function Search($id)
    {
        try {
            $card       =   CreditCard::findOrFail($id);

            $cy         =   new DataCypher($card->keygen);
            $keygen     =   $cy->UnCypher(json_encode(CreditCardKey::find($card->key->id)->cypher), $card->keygen);
            $cypher     =   $cy->UnCypher(json_encode($card->cypher), $keygen);

            return  [
                'id'        =>  $card->id,
                'name'      =>  $card->name,
                'card'      =>  $cypher['card'],
                'month'     =>  $card->month,
                'year'      =>  $card->year,
                'cvv'       =>  $card->cvv,
                'entity'    =>  $card->entity_id,
                'type'      =>  $card->type_id,
                'status'    =>  $card->status_id,
            ];

        } catch (\Exception $e) {
            return false;
        }

    }

    public static function UpdateTDC($data)
    {
        $status     =   false;

        $update     =   CreditCard::findOrFail($data->mId);
        $kUpdate    =   CreditCardKey::findOrFail($update->key_id);

        $kCy        =   bin2hex(random_bytes(16));
        $key        =   bin2hex(random_bytes(16));
        
        $cy         =   new DataCypher($key);

        $card  =   [
            'name'      =>  strtoupper($data['mTitle']),
            'card'      =>  $data['mNumber'],
            'cvv'       =>  $data['mCvv'],
            'month'     =>  $data['mMonth'],
            'year'      =>  $data['mYear'],
            'entity'    =>  CreditCardEntity::find($data['mEntity'])->name,
            'type'      =>  CreditCardType::find($data['mType'])->name
        ];

        $update->name          =   strtoupper($data['mTitle']);
        $update->last          =   strtoupper( substr($data['mNumber'], -8) );
        $update->month         =   strtoupper($data['mMonth']);
        $update->year          =   strtoupper($data['mYear']);
        $update->cvv           =   strtoupper($data['mCvv']);
        $update->cypher        =   $cy->CypherData(json_encode($card), $kCy)['cypher'];
        $update->keygen        =   $key;
        $update->key_id        =   CreditCardKey::UpdateKey($cy->CypherData(json_encode($kCy), $key), $update->key_id);
        $update->type_id       =   $data['mType'];
        $update->entity_id     =   $data['mEntity'];
        $update->status_id     =   $data['mStatus'];
        $update->client_id     =   auth()->user()->client->client_id;
        
        try {
            $update->save();

            if($data['mStatus'] == 1)
            {
                $upd    =   CreditCard::where('id', '<>', $update->id)->update(['status_id' => '2']);
            }
            
            $status =   true;
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            $status =   false;
        }
        
        return  $status;
    
    }

    public static function GetData($data)
    {
        $iCards     =   false;

        if($data->count() <> 0)
        {
            foreach ($data as $d => $da) 
            {
                $cy     =   new DataCypher($da->keygen);
                $keygen =   $cy->UnCypher(json_encode(CreditCardKey::find($da->key->id)->cypher), $da->keygen);
                $card   =   $cy->UnCypher(json_encode($da->cypher), $keygen);
    
                $iCards[$d] =   [
                    'name'      =>  $card->name,
                    'card'      =>  $card['card'],
                    'last'      =>  $da->last,
                    'month'     =>  $card['month'],
                    'year'      =>  $card['year'],
                    'entity'    =>  $da->entity->name,
                    'type'      =>  $da->type->name,
                    'status'    =>  $da->status->name,
                ];    
            }
        }

        return $iCards;
    
    }
}
