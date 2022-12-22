<?php

namespace App\Models\Clients\CustomerServices;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequest extends Model
{
    use HasFactory;

    public function ctype()     {   return $this->belongsTo(CustomerRequestType::class, 'type_id'); }
    public function types()     {   return $this->hasMany(CustomerType::class, 'request_id');       }
    public function field()     {   return $this->belongsTo(CustomerFiel::class, 'field_id');       }
    public function status()    {   return $this->belongsTo(Status::class);                         }
}
