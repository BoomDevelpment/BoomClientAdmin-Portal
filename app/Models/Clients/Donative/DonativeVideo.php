<?php

namespace App\Models\Clients\Donative;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonativeVideo extends Model
{
    use HasFactory;

    public function Status() {   return $this->belongsTo(Status::class);    }

    public static function GetVideo()
    {
        try {

            $video  =   DonativeVideo::where('status_id', '=', Status::where('name', 'like', '%act%')->first()->id)->first();

            return  ($videos != null) ? $video : ['status_id' => 0, 'name' => '', 'src' => ''];

        } catch (\Exception $e) {

            return ['status_id' => 0, 'name' => '', 'src' => ''];
        }
    }
}
