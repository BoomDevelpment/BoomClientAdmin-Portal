<?php

namespace App\Models\Clients\Country;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;
    
    public function status()            {   return $this->belongsTo(Status::class);                     }
    public function citys()             {   return $this->hasMany(City::class, 'estate_id');            }
    public function municipalities()    {   return $this->hasMany(Municipality::class, 'estate_id');    }

}
