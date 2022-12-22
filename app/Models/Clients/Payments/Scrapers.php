<?php

namespace App\Models\Clients\Payments;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scrapers extends Model
{
    use HasFactory;

    public function Status() {   return $this->belongsTo(Status::class);    }

    public static function insertData($data)
    {
        try {
            $new    =   new Scrapers();
            $new->euro      =   $data['euro'];
            $new->yuan      =   $data['yuan'];
            $new->lira      =   $data['lira'];
            $new->rublo     =   $data['rublo'];
            $new->dolar     =   $data['dolar'];
            $new->paralelo  =   $data['paralelo'];
            $new->status_id =   1;
            $new->save();
            
            $upd    =   Scrapers::where('id', '<>', $new->id)->update(['status_id' => '2']);
            
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getLast()
    {
        try {
            return Scrapers::orderBy('id', 'desc')->first();

        } catch (\Exception $e) {
            return false;
        }    
    }
}
