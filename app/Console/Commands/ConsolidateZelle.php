<?php

namespace App\Console\Commands;

use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\Admins\Payments\ConsolidateZelle as ConsZelle;

use Illuminate\Console\Command;

use Carbon\Carbon;

class ConsolidateZelle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zelle:consolidate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cronjob to reconcile payments reported by customers in zelle';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $d     =   [
            'ini'       =>  Carbon::now()->startOfMonth()->toDateString(),
            'end'       =>  Carbon::now()->endOfMonth()->toDateString(),
        ];

        $rClients       =   TransferenceZelle::GetRangeDateStatus($d, 3);
        $rConsolidate   =   ConsZelle::GetDateStatus($d, 3);
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

                            $upd                        =   ConsZelle::where('report_code', '=', $rcon['report_code'])->first();
                            $upd->client_id             =   $rcli->client_id;
                            $upd->transaction_id        =   ($transaction <> false) ? $transaction->transaction : null;
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

                            \Log::info(date("Y-m-d H:m:s")." - Consolidate Zelle Cronjob - Client: ".$rcli->client_id." - Code: ".$upd->transference_code." - Date: ".$rcli->date_trans." - Total: ".$rcli->total." - Status: SUCCESSFULLY");

                        } catch (\Exception $e) {
                            \Log::info(date("Y-m-d H:m:s")." - Error Consolidate Zelle Cronjob - Client: ".$rcli->client_id." - Code: ".$upd->transference_code." - Date: ".$rcli->date_trans." - Total: ".$rcli->total." - Status: ERROR");
                        }
                    }
                }
            }

        }

        return 0;
    }
}
