<?php

namespace App\Models\Clients\Voucher;

use App\Models\Clients\Profile\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherLog extends Model
{
    use HasFactory;

    public function client()      {   return $this->belongsTo(Client::class);       }

    public static function Register($data)
    {        
        try {
            $new    =   new VoucherLog();
            $new->client_id     =   $data['client'];
            $new->ticket        =   $data['ticket'];
            $new->amount        =   $data['bs'];
            $new->total         =   $data['total'];

            return ( $new->save() ) ? true : false;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
