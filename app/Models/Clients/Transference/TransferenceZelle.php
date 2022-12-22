<?php

namespace App\Models\Clients\Transference;

use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenceZelle extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(TransferenceStatus::class);     }
    public function type()      {   return $this->belongsTo(TransferenceType::class);       }
    public function client()    {   return $this->belongsTo(Client::class);                 }

    public static function RegisteTrans($data)
    {
        try{
            $new    =   New TransferenceZelle();
            $new->identified    =   $data['identified'];
            $new->client_id     =   $data['client_id'];
            $new->subject       =   strtoupper(trim($data['subject']));
            $new->title         =   strtoupper(trim($data['title']));
            $new->date_trans    =   strtoupper(trim($data['date_trans']));
            $new->reference     =   trim($data['reference']);
            $new->total         =   trim($data['total']);
            $new->bs            =   trim($data['bs']);
            $new->amount        =   trim($data['amount']);
            $new->description   =   strtoupper(trim($data['description']));
            $new->type_id       =   $data['type'];
            $new->status_id     =   $data['status'];

            return  ( $new->save() ) ? true : false;

        } catch (\Exception $e) {

            dd($e->getMessage());
            return false;
        }
    }

    public static function GeTransferences($data)
    {
        try {
            $iRes   =   TransferenceZelle::where('client_id', '=', $data)->get();
            return  ($iRes <> false) ? $iRes : false;
        } catch (\Exception $e) {
            return false;
        }

    }

    public static function GetReference($data)
    {
        try {
            $iRes   =   TransferenceZelle::where('reference', 'LIKE', '%'.$data.'%')->get();
            return  ($iRes <> false) ? $iRes : false;
        } catch (\Exception $e) {
            return false;
        }

    }

    public static function GetByRangeDate($d)
    {
        try {
            return  TransferenceZelle::whereBetween('created_at', [$d['ini'], $d['end']])
                        ->with('client', 'status', 'type')
                        ->get();
        } catch (\Exception $e) { return false; }
    }

    public static function GetRangeDateStatus($d, $st)
    {
        try {
            return  TransferenceZelle::where('status_id', '=', $st)
                        ->whereBetween('created_at', [$d['ini'], $d['end']])
                        ->with('client', 'status', 'type')
                        ->get();
        } catch (\Exception $e) { return false; }
    }

    public static function GetImage($data)
    {
        try {
            return  TransferenceFile::where('identified', '=', $data)->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function GetReferenceById($id)
    {
        try {
            $iRes   =   TransferenceZelle::where('id', '=', $id)->first();
            return  ($iRes <> false) ? $iRes : false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
