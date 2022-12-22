<?php

namespace App\Models\Clients\CustomerServices;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFiel extends Model
{
    use HasFactory;

    public function Status()    {   return $this->belongsTo(Status::class);                     }
    public function types()     {   return $this->hasMany(CustomerType::class, 'request_id');   }
}
