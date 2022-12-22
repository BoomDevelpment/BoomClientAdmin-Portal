<?php

namespace App\Models\Admins\Payments;

use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceZelle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class    ConsolidateZelle extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(TransferenceStatus::class);     }
    public function operator()  {   return $this->belongsTo(Operator::class);               }
    public function client()    {   return $this->belongsTo(Client::class);                 }
    public function zelle()     {   return $this->belongsTo(TransferenceZelle::class, 'transference_id');      }


    public static function RegisterData($data)
    {

        $new                =   new ConsolidateZelle();
        $new->report_date   =   $data['date'];
        $new->report_code   =   $data['code'];
        $new->Report_amount =   $data['amount'];
        $new->status_id     =   $data['status'];
        $new->operator_id   =   $data['operator'];
        
        try {
            return  ( $new->save() ) ? true : false;
        } catch (\Exception $e) {
            return false;
        }

    }

    public static function GetCode($code)
    {
        try {
            return ConsolidateZelle::where('report_code', '=', $code)->first();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public static function GetByDate($d, $st)
    {
        try {
            return ConsolidateZelle::whereBetween('created_at', [$d['ini'], $d['end']])
                        ->orderBy('id', 'DESC')
                        ->with('operator', 'status', 'client', 'zelle')
                        ->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public static function GetDateStatus($d, $st)
    {
        try {
            $cont   =   ConsolidateZelle::where('status_id', '=', $st)
                        ->whereBetween('created_at', [$d['ini'], $d['end']])
                        ->orderBy('id', 'DESC')
                        ->with('operator', 'status', 'client', 'zelle')
                        ->get();

            return ( count($cont) == 0) ? false : $cont;

        } catch (\Exception $e) {
            // dd($e->getMessage());
            return false;
        }
    }

    public static function Consolidate($d, $st)
    {
        $rClients       =   TransferenceZelle::GetRangeDateStatus($d, 3);
        $rConsolidate   =   ConsolidateZelle::GetDateStatus($d, 3);
        $status         =   TransferenceStatus::GetId('conso');
        $cont           =   0;

        if( ($rClients <> false) && ($rConsolidate <> false) )
        {
            foreach ($rClients as $r => $rcli) 
            {
                foreach ($rConsolidate as $c => $rcon) 
                {
                    if(strpos(substr(strtoupper($rcli['reference']), -5), substr(strtoupper($rcon['report_code']), -5) ) !== false)
	                {
                        try {
                            $iData          =   ['identified' => $rcli->identified, 'client' => $rcli->client_id];
                            $transaction    =   TransferencePending::GetRefClient($iData);

                            $upd    =   ConsolidateZelle::where('report_code', '=', $rcon['report_code'])->first();
                            $upd->client_id             =   $rcli->client_id;
                            $upd->transaction_id        =   ($transaction <> false) ? $transaction->transaction : 1;
                            $upd->transference_id       =   $rcli->id;
                            $upd->transference_code     =   $rcli->reference;
                            $upd->transference_date     =   $rcli->date_trans;
                            $upd->transference_total    =   $rcli->total;   
                            $upd->status_id             =   $status->id;
                            $upd->save();
                            
                            $zUp                =   TransferenceZelle::where('reference', '=', $rcli['reference'])->first();
                            $zUp->status_id     =   $status->id;
                            $zUp->save();

                            $cont   =   $cont + 1;

                        } catch (\Exception $e) {
                            dd($e->getMessage());
                            return [
                                'status'    => false,
                                'message'   =>  $e->getMessage()
                            ];
                        }
                    }
                }
            }

            return [
                'status'    =>  ($cont > 0) ? true : false,
                'message'   =>  ($cont > 0) ? 'Consolidation completed' : 'Nothing to consolidate'
            ];           
        }

        return [
            'status'    =>  false,
            'message'   =>  'Nothing to consolidate'
        ]; 
    }

    public static function GetCodeId($c)
    {
        try {
            return ConsolidateZelle::where('id', '=', $c)->first();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

}
