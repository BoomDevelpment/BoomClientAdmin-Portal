<?php

namespace Database\Seeders;

use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Voucher\VoucherLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use FrittenKeeZ\Vouchers\Facades\Vouchers;
use FrittenKeeZ\Vouchers\Models\Voucher;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user       =   User::findOrFail(1);
        
        $amount     =   '3.00';
        $ticket     =   Vouchers::withMask('***-***')
        ->withOwner($user)
        ->withMetadata([
            'amount'    =>  $amount,
            'title'     =>  'Premiamos tu fidelidad',
            'message'   =>  'Por ser tan buen cliente, te obsequiamos un vale por el monto de $ '.$amount.''
            ])
        ->withStartDateIn(CarbonInterval::create('P0D'))
        ->withExpireDateIn(CarbonInterval::create('P1W'))
        ->create();

        $voucher    =   Voucher::where('owner_id','=', $user->id)->first();

        $divisa     =   Scrapers::getLast();
        $success    =   Vouchers::redeem($voucher->code, $user);
        $myWallet   =   $user->getWallet($user->identified);
        $t          =   $voucher->metadata['amount'];

        $transaction    =   $myWallet->depositFloat(round($t,2), 
            [
                'Description'   =>  'Abono: Premio por ticket',
                'USD'           =>  round($t,2),
                'BS'            =>  round(($t * $divisa->dolar),2),
                'DIVISA'        =>  $divisa->dolar,
            ], false);

        $myWallet->confirm($transaction);
        
        $tData  =   [
            'client'    =>  $user->client->client_id,
            'ticket'    =>  $voucher->code,
            'bs'        =>  round(($t * $divisa->dolar),2),
            'total'     =>  round($t,2)
        ];

        $lVou   =   VoucherLog::Register($tData);
    }
}
