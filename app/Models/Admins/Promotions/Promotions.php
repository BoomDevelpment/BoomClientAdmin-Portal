<?php

namespace App\Models\Admins\Promotions;

use App\Models\Clients\Country\City;
use App\Models\Clients\Country\Estate;
use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    use HasFactory;

    public function status()        {   return $this->belongsTo(Status::class);                                 }
    public function city()          {   return $this->belongsTo(City::class);                                   }
    public function estate()        {   return $this->belongsTo(Estate::class);                                 }
    public function type()          {   return $this->belongsTo(PromotionsType::class, 'type_id');              }
    public function technology()    {   return $this->belongsTo(PromotionsTechnology::class, 'technology_id');  }
    public function recurrence()    {   return $this->hasMany(PromotionsRecurrence::class, 'promotion_id');     }
    public function activation()    {   return $this->hasMany(PromotionsActivation::class, 'promotion_id');     }
}
