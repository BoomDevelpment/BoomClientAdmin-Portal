<?php

namespace App\Models\Clients\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountBankKey extends Model
{
    use HasFactory;

    public static function Register($data, $key)
    {
        $key            =   new AccountBankKey();
        $key->cypher    =   $data['cypher'];

        try {
            return  ( $key->save() ) ? $key->id : false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function UpdateKey($data, $id)
    {
        $key            =   AccountBankKey::findOrFail($id);
        $key->cypher    =   $data['cypher'];
        
        try {
            return  ( $key->save() ) ? $key->id : false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
