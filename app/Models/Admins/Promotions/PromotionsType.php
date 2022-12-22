<?php

namespace App\Models\Admins\Promotions;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionsType extends Model
{
    use HasFactory;

    public function status()        {   return $this->belongsTo(Status::class);                     }
    
}
