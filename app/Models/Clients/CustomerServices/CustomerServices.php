<?php

namespace App\Models\Clients\CustomerServices;

use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerServices extends Model
{
    use HasFactory;

    public function request()   {   return $this->belongsTo(CustomerRequest::class);    }
    public function type()      {   return $this->belongsTo(CustomerType::class);       }
    public function status()    {   return $this->belongsTo(CustomerStatus::class);     }
    public function client()    {   return $this->belongsTo(Client::class);             }
    public function operator()  {   return $this->belongsTo(Operator::class);           }
}
