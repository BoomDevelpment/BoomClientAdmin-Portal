<?php

namespace App\Models\Clients\Transference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferencePending extends Model
{
    use HasFactory;

    public static function RegisteTrans($data)
    {
        try{
            $new    =   New TransferencePending();
            $new->identified    =   $data['identified'];
            $new->client_id     =   $data['client'];
            $new->transaction   =   $data['transaction'];
            $new->method_id     =   $data['method'];
            $new->status_id     =   $data['status'];

            return  ( $new->save() ) ? true : false;

        } catch (\Exception $e) {

            return false;
        }
    }

    public static function GetRefClient($i)
    {
        try {
           $res =   TransferencePending::where([
            ['identified', '=', $i['identified']],
            ['client_id',  '=', $i['client']]
           ])->first();

           return ($res <> null) ? $res : false;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
