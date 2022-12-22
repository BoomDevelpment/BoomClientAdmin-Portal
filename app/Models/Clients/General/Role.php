<?php

namespace App\Models\Clients\General;

use App\Models\Clients\Profile\Operator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);    }
    public function operator()  {   return $this->belongsTo(Operator::class);    }
}
