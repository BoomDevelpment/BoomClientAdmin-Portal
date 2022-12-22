<?php

namespace App\Models\Clients\General;

use App\Models\Clients\Payments\AccountBank;
use App\Models\Clients\Payments\AccountBankType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public function Status()    {   return $this->belongsTo(Status::class);             }
    public function bank()      {   return $this->belongsTo(AccountBank::class);        }
    
}
