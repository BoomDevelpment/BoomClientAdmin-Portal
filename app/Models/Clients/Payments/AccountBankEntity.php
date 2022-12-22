<?php

namespace App\Models\Clients\Payments;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountBankEntity extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);    }

    public function entity()    {   return $this->belongsTo(AccountBank::class);   }
}
