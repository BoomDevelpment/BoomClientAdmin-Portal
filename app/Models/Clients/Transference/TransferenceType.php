<?php

namespace App\Models\Clients\Transference;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenceType extends Model
{
    use HasFactory;

    public function status()        {   return $this->belongsTo(Status::class);                 }
    public function zelle()         {   return $this->belongsTo(TransferenceZelle::class);      }
    public function paypal()        {   return $this->belongsTo(TransferencePaypal::class);     }
    public function transference()  {   return $this->belongsTo(TransferenceBank::class);       }
}