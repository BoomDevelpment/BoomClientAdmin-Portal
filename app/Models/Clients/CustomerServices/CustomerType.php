<?php

namespace App\Models\Clients\CustomerServices;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);                         }
    public function request()   {   return $this->belongsTo(CustomerRequest::class);                }
    public function requests()  {   return $this->hasMany(CustomerRequest::class, 'request_id');    }
    public function field()     {   return $this->belongsTo(CustomerFiel::class, 'field_id');       }
}
