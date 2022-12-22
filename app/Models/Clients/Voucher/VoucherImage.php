<?php

namespace App\Models\Clients\Voucher;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherImage extends Model
{
    use HasFactory;

    public function Status() {   return $this->belongsTo(Status::class);    }
}
