<?php

namespace App\Models\Clients\Donative;

use App\Models\Clients\Profile\Client;
use App\Models\Clients\Transference\TransferenceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonativeRegister extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(TransferenceStatus::class);     }
    public function client()    {   return $this->belongsTo(Client::class);       }

    public static function Register($data)
    {
        try {
            $new                =   new DonativeRegister();
            $new->client_id     =   $data['client'];
            $new->amount        =   $data['amount'];
            $new->transaction   =   $data['transaction'];
            $new->status_id     =   $data['status_id'];
            
            return  ( $new->save() ) ? true : false;

        } catch (\Exception $e) {
            return false;
        }
    }
}
