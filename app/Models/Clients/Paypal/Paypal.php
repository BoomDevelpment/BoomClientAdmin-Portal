<?php

namespace App\Models\Clients\Paypal;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    use HasFactory;

    public function Status() {   return $this->belongsTo(Status::class);    }
}
