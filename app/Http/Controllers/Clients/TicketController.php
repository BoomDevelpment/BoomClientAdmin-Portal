<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Voucher\VoucherImage;
use App\Models\Clients\Voucher\VoucherLog;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use FrittenKeeZ\Vouchers\Facades\Vouchers;
use FrittenKeeZ\Vouchers\Models\Voucher;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }

    public function index(Request $request)
    {
        $user   =   User::findOrFail(auth()->user()->id);
        $info   =   Voucher::WHERE('owner_id',    '=', $user->id)->orderBy('id', 'DESC')->get();
        $iData  =   [];
        
        if(count($info) > 0)
        {
            foreach ($info as $i => $inf) 
            {
                $iData[$i]  =   [
                    'id'        =>  $inf->id,
                    'ticket'    =>  $inf->code,
                    'title'     =>  $inf->metadata['title'],
                    'message'   =>  $inf->metadata['message'],
                    'amount'    =>  round($inf->metadata['amount'],2),
                    'status'    =>  ($inf->redeemed_at == null) ?   0   :   1
                ];
            }
        }
        
        $iPhotos    =   VoucherImage::where('status_id', '=', Status::where('name', 'like', '%act%')->first()->id)->orderBy('id', 'ASC')->get();

        return view('page/clients/vouchers/index',[
            'c'     =>  count($info),
            'inf'   =>  $iData,
            'pho'   =>  $iPhotos,
        ]);
    }

    public static function Change(Request $request)
    {
        
        try {
            if($request->ty == 1)
            {
                $voucher    =   Voucher::findOrFail($request->id);
            }else{
                $voucher    =   Voucher::where('code','=', trim($request->id))->first();
            }

            $iData  =   [
                'ticket'        =>  $voucher->code,
                'client'        =>  auth()->user()->id,
                'description'   =>  'Abono: Premio por ticket'
            ];
             
            $iTicket    =   TicketController::ValidateVoucher($iData);

            if($iTicket['status'] <> false)
            {
    
                try {
                    $user       =   User::find(auth()->user()->id);
                    $divisa     =   Scrapers::getLast();
                    $success    =   Vouchers::redeem($iData['ticket'], $user);
                    $myWallet   =   $user->getWallet(auth()->user()->identified);
                    $t          =   $iTicket['d']->metadata['amount'];
    
                    $transaction    =   $myWallet->depositFloat(round($t,2), 
                        [
                            'Description'   =>  $iData['description'],
                            'USD'           =>  round($t,2),
                            'BS'            =>  round(($t * $divisa->dolar),2),
                            'DIVISA'        =>  $divisa->dolar,
                        ], false);
    
                    $myWallet->confirm($transaction);
                    
                    $tData  =   [
                        'client'    =>  auth()->user()->client->client_id,
                        'ticket'    =>  $iData['ticket'],
                        'bs'        =>  round(($t * $divisa->dolar),2),
                        'total'     =>  round($t,2)
                    ];
    
                    $lVou   =   VoucherLog::Register($tData);
    
                    return response()->json([
                        'success'   =>  true,
                        'url'       =>  url('/tickets'),
                        'message'   =>  "Solicitud procesada correctamente"
                    ], Response::HTTP_OK);
    
                } catch (\Exception $e) {
    
                    return response()->json([
                        'success'   =>  true,
                        'url'       =>  url('/tickets'),
                        'message'   =>  "Error cangeando el ticket, intente nuevamente"
                        
                    ], Response::HTTP_UNAUTHORIZED);

                }
    
            }
            else{
                return response()->json([
                    'success'   =>  true,
                    'url'       =>  url('/tickets'),
                    'message'   =>  $iTicket['message']
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Exception $e) {

            return response()->json([
                'success'   =>  true,
                'url'       =>  url('/tickets'),
                'message'   =>  "Error cangeando el ticket, intente nuevamente"
            ], Response::HTTP_UNAUTHORIZED);

        }
    }

    public static function ValidateVoucher($iData)
    {
        $valid = Vouchers::redeemable($iData['ticket']);

        if(Vouchers::redeemable($iData['ticket']) == true)
        {
            $info   =   Voucher::WHERE([ 
                ['owner_id',    '=', $iData['client']],
                ['code',        '=', $iData['ticket']]
                ] )->first();

            if($info)
            {
                return ['status'    =>  true,   'd'         =>  $info];
            }else{
                return ['status'    =>  false,  'message'   =>  'Ticket no asociado'];
            }
        }else{
            return ['status' =>  false, 'message'   =>    "Ticket no válido o ya fue procesado"];
        }
    }
}
