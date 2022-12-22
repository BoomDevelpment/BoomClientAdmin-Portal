<?php

namespace App\Models\Clients\Payments;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardType extends Model
{
    use HasFactory;

    public function Status() {   return $this->belongsTo(Status::class);            }

    public function type()   {   return $this->belongsTo(CreditCardType::class);    }
}
