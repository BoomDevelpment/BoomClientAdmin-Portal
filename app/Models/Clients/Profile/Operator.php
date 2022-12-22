<?php

namespace App\Models\Clients\Profile;

use App\Models\Clients\General\Role;
use App\Models\Clients\General\Status;
use App\Models\Clients\Pivot\OperatorUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    public function status()        {   return $this->belongsTo(Status::class);     }
    public function role()          {   return $this->belongsTo(Role::class);       }
}
