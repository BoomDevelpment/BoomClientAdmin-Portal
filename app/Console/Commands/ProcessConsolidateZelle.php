<?php

namespace App\Console\Commands;

use App\Models\Clients\Pivot\ClientUser;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\Admins\Payments\ConsolidateZelle;
use App\Models\User;
use Illuminate\Console\Command;

use Carbon\Carbon;

class ProcessConsolidateZelle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zelle:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cronjob to process payments reported by customers and zelle administrative reporting';

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
        $iDate     =   [
            'ini'       =>  Carbon::now()->startOfMonth()->toDateString(),
            'end'       =>  Carbon::now()->endOfMonth()->toDateString(),  
        ];

        $consolidate    =   ConsolidateZelle::GetDateStatus($iDate, 1);
        $status         =   TransferenceStatus::where('name','like','%proce%')->first()->id;
        $cont           =   $pend   =   0;

        if($consolidate <> false)
        {
            foreach ($consolidate as $c => $cons) 
            {
                $client         =   ClientUser::where('client_id', '=', $cons->client_id)->first();
                $user           =   User::find($client->user_id);
                $myWallet       =   $user->getWallet($user->identified);

                if($cons->report_amount == $cons->transference_total)
                {
                    $iPend  =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', $cons->transaction_id], ['confirmed', 0]])->first();

                    if($myWallet->confirm($iPend) == true)
                    {
                        $report             =   TransferenceZelle::where('identified', '=', $cons->zelle->identified)->first();
                        $report->amount     =   $cons->report_amount;
                        $report->status_id  =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $report->save();
            
                        $pending            =   TransferencePending::where('identified', '=', $cons->zelle->identified)->first();
                        $pending->status_id =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $pending->save();

                        $pending            =   ConsolidateZelle::where('id', '=', $cons->id)->first();
                        $pending->status_id =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $pending->save();
                        $cont = $cont + 1;

                        \Log::info(date("Y-m-d H:m:s")." - Process Consolidate Zelle Cronjob - Client: ".$cons->client_id." - Code: ".$cons->report_code." - Date: ".$cons->report_date." - Total: ".$cons->report_amount." - Status: SUCCESSFULLY");
                    }

                }else{

                    $iPend  =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', 3], ['confirmed', 0]])->first();
                    $iData  =   [
                        "BS"            =>  ROUND( ($cons->report_amount * $iPend->meta['DIVISA'] ), 2),
                        "USD"           =>  ROUND( $cons->report_amount ,2),
                        "DIVISA"        =>  $iPend->meta['DIVISA'],
                        "Description"   =>  $iPend->meta['Description']
                    ];
                    $iPend->meta    =   $iData;
                    $iPend->amount  =  ROUND( ($cons->report_amount * 100), 2);
                    $iPend->save();

                    $iPend2 =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', $cons->transaction_id], ['confirmed', 0]])->first();

                    if($myWallet->confirm($iPend2) == true)
                    {
                        $report             =   TransferenceZelle::where('identified', '=', $cons->zelle->identified)->first();
                        $report->amount     =   $cons->report_amount;
                        $report->status_id  =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $report->save();
            
                        $pending            =   TransferencePending::where('identified', '=', $cons->zelle->identified)->first();
                        $pending->status_id =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $pending->save();

                        $pending            =   ConsolidateZelle::where('id', '=', $cons->id)->first();
                        $pending->status_id =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $pending->save();
                        $cont = $cont + 1;

                        \Log::info(date("Y-m-d H:m:s")." - Process Consolidate Zelle Cronjob - Client: ".$cons->client_id." - Code: ".$cons->report_code." - Date: ".$cons->report_date." - Total: ".$cons->report_amount." - Status: SUCCESSFULLY");
                    }
                }
            }

            if($cont = 0)
            {
                \Log::info(date("Y-m-d H:m:s")." - Consolidate Zelle Cronjob - Status: NOTHING TO CONSOLIDATE");  
            }

        }else{
            \Log::info(date("Y-m-d H:m:s")." - Consolidate Zelle Cronjob - Status: NOTHING TO CONSOLIDATE");           
        }

        return 0;
    }
}
