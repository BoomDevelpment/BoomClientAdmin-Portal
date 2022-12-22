<?php

namespace App\Models\Clients\Country;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);                     }
}
