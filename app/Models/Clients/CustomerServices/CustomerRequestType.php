<?php

namespace App\Models\Clients\CustomerServices;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequestType extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);                     }
}
