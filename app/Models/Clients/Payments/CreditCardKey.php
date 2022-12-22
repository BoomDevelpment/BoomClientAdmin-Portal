<?php

namespace App\Models\Clients\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardKey extends Model
{
    use HasFactory;

    public static function Register($data, $key)
    {
        $key            =   new CreditCardKey();
        $key->cypher    =   $data['cypher'];

        try {
            return  ( $key->save() ) ? $key->id : false;

        } catch (\Exception $e) {
            return false;
        }

    }

    public static function UpdateKey($data,  $id)
    {
        try {
            $key    =   CreditCardKey::findOrFail($id);
            $key->cypher    =   $data['cypher'];
            
            return  ( $key->save() ) ? $key->id : false;

        } catch (\Exception $e) {
            return false;
        }
    }
}
