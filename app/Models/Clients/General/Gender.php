<?php

namespace App\Models\Clients\General;

use App\Models\Clients\Profile\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    public function status() {   return $this->belongsTo(Status::class);    }
    public function client() {   return $this->belongsTo(Client::class);    }
}
