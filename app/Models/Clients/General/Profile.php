<?php

namespace App\Models\Clients\General;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);     }
    public function user()      {   return $this->belongsTo(User::class);       }
}
