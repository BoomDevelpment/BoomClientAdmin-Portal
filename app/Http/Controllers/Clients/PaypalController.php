<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Paypal\Paypal;
use App\Models\Clients\Paypal\PaypalOrder;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferencePaypal;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\TestOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as GuzzleClient;
use Image;

class PaypalController extends Controller
{
    private $paypalClient;
    private $accessToken;

    public function __construct()
    {

        $this->middleware('auth');

        $this->middleware('survey');

        $credentials    =   Paypal::WHERE('status_id', 'like', '%'. Status::WHERE('name', 'LIKE', '%act%')->get()[0]->id .'%')->get();

        if(COUNT($credentials) > 0)
        {
            if( $credentials[0]->mode == 'live' )
            {
                $baseUri    =   'https://api-m-paypal.com';
            }else{
                $baseUri    =   'https://api-m.sandbox.paypal.com';
            }
            $clientId       =   $credentials[0]->client;
            $secret         =   $credentials[0]->secret;

        }else{

            if(config('paypal')['credentials']['settings']['mode'] === 'live')
            {
                $clientId   =   config('paypal')['credentials']['live_client'];
                $secret     =   config('paypal')['credentials']['live_secret'];
                $baseUri    =   'https://api-m-paypal.com';
            }else{
                $clientId   =   config('paypal')['credentials']['sandbox_client'];
                $secret     =   config('paypal')['credentials']['sandbox_secret'];
                $baseUri    =   'https://api-m.sandbox.paypal.com';
            }
        }

        try {
            $this->client       =   new GuzzleClient(['verify' => false,'base_uri' => $baseUri]);
            $this->accessToken  =   $this->getAccessToken($clientId, $secret);
        } catch (\Exception $e) {   $this->accessToken  =   false;  $this->client = false;    }

    }

    public function Verificate(Request $request)
    {
        try 
        {
            
            $verf   =   TransferencePaypal::GeTransferences(auth()->user()->client->client_id);

            $iComp  =   false;
    
            if($verf)
            {
                foreach ($verf as $v => $ver)   {   if( strpos( substr($ver->reference, -6), substr($request->r, -6) ) !== false ){   $iComp  =   true; }  }
                
                if($iComp == true)
                {
                    return response()->json([
                        'success'   =>  false,
                        'message'   => 'El código de referencia ya se encuentra registrado',
                    ],  Response::HTTP_UNAUTHORIZED);
    
                }
            }

            $data   =   $this->CalculatorPaypal($request->a, 2);

            return response()->json([
                'success'   =>  true,
                'iPUSD'     =>  round($data['tInv'],2),
                'cPUSD'     =>  round($data['tCom'], 2),
                'aPUSD'     =>  round($data['tAmo'], 2),
            ],  Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success'   =>  false,
            ],  Response::HTTP_UNAUTHORIZED);
        }
    }
    
    public function Register(Request $request)
    {
        $validator      =   Validator::make($request->all(), [
            'p_asu'         => 'required|min:5',
            'p_date'        => 'required',
            'p_total'       => 'required',
            'p_reference'   => 'required',
            'p_email'       => 'required|min:5',
        ]);
      
        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Parametros Incompletos',
            ], Response::HTTP_UNAUTHORIZED);
        }

        // $verf   =   TransferencePaypal::GeTransferences(auth()->user()->client->client_id);

        // $iComp  =   false;

        if(COUNT(TransferenceFile::SearchFile($request->p_ide)) == 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Para completar la solicitud debe ingresar al menos un archivo adjunto.',
            ], Response::HTTP_UNAUTHORIZED); 
        }

        $verificate =   false;
        $divisa     =   Scrapers::getLast();
        $type       =   TransferenceType::where([ ['status_id', '=', 1], ['name', 'like', '%dol%'] ])->get()[0];
        $status     =   TransferenceStatus::where([ ['status_id', '=', 1], ['name', 'like', '%pen%'] ])->get()[0];

        try {
            $responseOrder   =   $this->client->request('GET', '/v2/payments/captures/'.$request->p_reference.'', [
                'headers'   =>  $this->getHeaders(),
                ],
            );

            $resOrder       =   json_decode($responseOrder->getBody(), true);

            if($resOrder['final_capture'])
            {
                $total      =   round( ($resOrder['amount']['value'] - ( ($resOrder['amount']['value'] * 0.054) + 0.30) ), 2);
                $verificate =   true;
            }else{
                $total      =   round( ($request->p_total - ( ($request->p_total * 0.054) + 0.30) ), 2);
                $verificate =   false;
            }
        } catch (\Exception $e) {
            $total          =   round( ($request->p_total - ( ($request->p_total * 0.054) + 0.30) ), 2);
            $verificate     =   false;
        }

        $iData  =   [
            'identified'    =>  $request->p_ide,
            'client_id'     =>  auth()->user()->client->client_id,
            'subject'       =>  $request->p_asu,
            'title'         =>  $request->p_asu,
            'date_trans'    =>  $request->p_date,
            'reference'     =>  $request->p_reference,
            'total'         =>  round( $total, 2),
            'bs'            =>  round( ($total * $divisa->dolar), 2),
            'amount'        =>  0.00,
            'email'         =>  $request->p_email,
            'description'   =>  ($request->p_message <> '') ? $request->p_message : 'Transference date: '.date("Y-m-d H:m:s").'',
            'type'          =>  $type->id,
            'status'        =>  $status->id,
        ];

        $reg    =   TransferencePaypal::RegisteTrans($iData);
      
        if($reg <> false)
        {
            $user       =   User::find(auth()->user()->id);
            $myWallet   =   $user->getWallet(auth()->user()->identified);

            $transaction    =   $myWallet->depositFloat($iData['total'], 
                [
                    'Description'   =>  $iData['description'],
                    'USD'           =>  $iData['total'],
                    'BS'            =>  $iData['bs'],
                    'DIVISA'        =>  $divisa->dolar,
                ], false);
            
            $iPend   =   [
                'identified'    =>  $request->p_ide,
                'client'        =>  auth()->user()->client->client_id,
                'transaction'   =>  $transaction->id,
                'status'        =>  $status->id,
                'method'        =>  TransferenceMethod::where('name', 'like', '%pay%')->get()[0]->id
            ];

            $pen    =   TransferencePending::RegisteTrans($iPend);

            if($pen <> false)
            {

                if($verificate == true)
                {
                    $trans  =   TransferencePending::where('identified', '=', $request->p_ide)->first()->transaction;
    
                    $iPend      =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', $trans], ['confirmed', 0]])->first();
    
                    if($myWallet->confirm($iPend) == true)
                    {
                        $report             =   TransferencePaypal::where('identified', '=', $request->p_ide)->first();
                
                        $report->status_id  =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $report->save();
            
                        $pending            =   TransferencePending::where('identified', '=', $request->p_ide)->first();
                        $pending->status_id =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                        $pending->save();
                    }

                    return response()->json([
                        'success'   =>  true,
                        'message'   =>  'Codigo de referencia verificado con Paypal bajo los siguientes parametros: Total Enviado: $'.$resOrder['amount']['value'].' Total Recibido: $'.$iData['total'].'',
                        'url'       =>  url('/wallet')
                    ], Response::HTTP_OK);
                
                }
                return response()->json([
                    'success'       =>  true,
                    'message'       =>  'Los datos fueron almacenados correctamente, pendiente por verificación.',
                    'url'           =>  url('/wallet')
                ], Response::HTTP_OK);

            }else{

                return response()->json([
                    'success' => false,
                    'message' => 'Error al intentar almancenar la información, intente nuevamente.',
                ], Response::HTTP_UNAUTHORIZED); 

            }

        }else{

            return response()->json([
                'success' => false,
                'message' => 'Error al intentar almancenar la información, intente nuevamente.',
            ], Response::HTTP_UNAUTHORIZED); 
        }

    }

    public function Files(Request $request)
    {
        if($request->file('p_file'))
        {
            try {
                $fileName   =   auth()->user()->client->client_id.'-'.$request->p_ide_f.'-'.time().'.'.$request->file('p_file')->extension();
                $request->file('p_file')->move(public_path('files/paypal'), $fileName);

                $data   =   [
                    'identified'    =>  $request->p_ide_f,
                    'name'          =>  $fileName,
                    'dir'           =>  'files/movil'
                ];

                $res    =   TransferenceFile::RegFile($data);

                if($res <> false)
                {
                    return response()->json([
                        'success'   =>  true,
                        'file'      =>  $fileName,
                        'tp'        =>  3,
                        'id'        =>  $request->p_ide_f
                    ],  Response::HTTP_OK);

                }else{
                    return response()->json([
                        'success'   => false,
                        'file'      => '',
                    ], Response::HTTP_UNAUTHORIZED);
                }    

            } catch (\Throwable $th) {
                return response()->json([
                    'success'   => false,
                    'file'      => '',
                ], Response::HTTP_UNAUTHORIZED);
            }

        }else{
            return response()->json([
                'success'   => false,
                'file'      => 'asdfasf',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $files  =   TransferenceFile::where('identified', '=', $request->id)->delete();
            
            return response()->json([
                'success'   =>  true,
            ],  Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'file'      => '',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function Calculate(Request $request)
    {
        try {
            $por        =   5.4;
            $com        =   0.3;

            if($request->ty == 'i')
            {
                $order      =   TestOrder::findOrFail($request->id);
                $amount     =   $order->amount;
            }
            elseif($request->ty == 'c')
            {
                $amount     =   $request->id;   
            }
            $res    =   $this->CalculatorPaypal($amount, 1);

            $iData      =   [
                'tInv'  =>  ROUND($res['tInv'],2),
                'tCom'  =>  ROUND($res['tCom'],2),
                'tAmo'  =>  ROUND($res['tAmo'],2)
            ];

            return response()->json([
                'success'   =>  true,
                'd'         =>  $iData
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success'   =>  false,
                'message'   =>  'Invoice not found.'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function Order(Request $request)
    {
        $identified     =   random_int(10000000, 99999999);
        try {
            $por        =   5.4;
            $com        =   0.3;
           
            $order      =   TestOrder::findOrFail($request->id);

            $tAmo       =   (100 * ($com + $order->amount)) / ((0-$por) + 100);
            $tCom       =   ($tAmo - $order->amount);

            $iData  =   [
                'identified'    =>  $identified,
                'invoice_id'    =>  $request->id,
                'http'          =>  $_SERVER['REQUEST_SCHEME'],
                'host'          =>  $request->getHttpHost(),
                'amount'        =>  ROUND($tAmo,2),
                'comi'          =>  ROUND($tCom,2),
                'invo'          =>  ROUND($order->amount,2)
            ];

            $cOrder     =   $this->CreateOrder($iData);
           
            return response()->json([
                'success'   =>  true,
                'd'         =>  $cOrder
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json([
                'success'   =>  false,
                'message'   =>  'Invoice not found.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
        ], Response::HTTP_OK);
    }

    public function Process(Request $request)
    {
        $iResult    =   false;

        try {
    
            $response = $this->client->request('POST', '/v2/checkout/orders/'.$request->token.'/capture', [
                'headers'   =>  $this->getHeaders(),
                ],
            );

            $result     =   json_decode($response->getBody(), true);

            if($result['status']  ==  'COMPLETED')
            {
                $responseOrder   =   $this->client->request('GET', '/v2/checkout/orders/'.$result['id'].'', [
                    'headers'   =>  $this->getHeaders(),
                    ],
                );

                $resOrder   =   json_decode($responseOrder->getBody(), true);

                $getInfo    =   PaypalOrder::DataGet($result['id']);

                $identified =   ($getInfo <> false) ? $getInfo->identified : random_int(10000000, 99999999);

                $iResult    =   [
                    'identified'    =>  $identified,
                    'client_id'     =>  auth()->user()->client->client_id,
                    'invoice_id'    =>  $getInfo->invoice_id,
                    'orderID'       =>  $result['id'],
                    'currency'      =>  $result['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                    'amount'        =>  $result['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['gross_amount']['value'],
                    'tax'           =>  $result['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['value'],
                    'total'         =>  $result['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['net_amount']['value'],
                    'link'          =>  '',
                    'gross_amount'  =>  $result['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['gross_amount']['value'],
                    'paypal_fee'    =>  $result['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['value'],
                    'net_amount'    =>  $result['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['net_amount']['value'],
                    'status'        =>  $result['status'],
                    'paypal_client' =>  $result['payer']['payer_id'],
                    'paypal_email'  =>  $result['payer']['email_address'],
                    'transactionID' =>  $resOrder['purchase_units'][0]['payments']['captures'][0]['id']
                ];

                $insOrder   =   PaypalOrder::DataUpdate($iResult);

                $user       =   User::where('id','=',auth()->user()->id)->first();

                $divisa     =   Scrapers::getLast();
                $type       =   TransferenceType::where([ ['status_id', '=', 1], ['name', 'like', '%dol%'] ])->first();
                $status     =   TransferenceStatus::where([ ['status_id', '=', 1], ['name', 'like', '%pen%'] ])->first();

                $fileName   =   auth()->user()->client->client_id.'-'.$identified.'-'.time().'.jpg';


                $img        =   Image::make(public_path('/src/images/supPaypal.png'));  
                $img->text($iResult['net_amount'], 510, 112.5, function($font) {  
                    $font->size(12);  $font->file(public_path('src/images/fonts/Montserrat-Italic.ttf')); $font->color('#00000');  $font->align('center');  $font->valign('bottom');    
                });
                $img->text($user->name, 300, 170, function($font) {  
                    $font->size(12);  $font->file(public_path('src/images/fonts/Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
                });
                $img->text($iResult['paypal_email'], 300, 195, function($font) {  
                    $font->size(12);  $font->file(public_path('src/images/fonts/Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
                });   
                $img->text('$ '.$iResult['net_amount'].'', 250, 257, function($font) {  
                    $font->size(20);  $font->file(public_path('src/images/fonts/Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
                });   
                $img->text('$ '.$iResult['paypal_fee'].'', 230, 307, function($font) {  
                    $font->size(20);  $font->file(public_path('src/images/fonts/Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
                });
                $img->text('$ '.$iResult['gross_amount'].'', 240, 364, function($font) {  
                    $font->size(20);  $font->file(public_path('src/images/fonts/Montserrat-Italic.ttf'));$font->color('#00000');  $font->align('center');  $font->valign('bottom');    
                });
                $img->save(base_path('public/files/transference/'.$fileName.''));

                $data   =   [
                    'identified'    =>  $identified,
                    'name'          =>  $fileName,
                    'dir'           =>  'files/paypal'
                ];

                $rTransference  =   TransferenceFile::RegFile($data);
               
                $iData  =   [
                    'identified'    =>   $identified,
                    'client_id'     =>   auth()->user()->client->client_id,
                    'subject'       =>   'Paypal Payment - Invoice: $'.$iResult['gross_amount'].'',
                    'title'         =>   'Paypal Payment - Invoice: $'.$iResult['gross_amount'].'',
                    'date_trans'    =>   date("Y-m-d"),
                    'reference'     =>   $iResult['transactionID'],
                    'total'         =>   $iResult['net_amount'],
                    'bs'            =>   round( ($iResult['net_amount'] * $divisa->dolar), 2),
                    'email'         =>   $iResult['paypal_email'],
                    'description'   =>   'Paypal Payment - Invoice: $'.$iResult['gross_amount'].' - Fee: $'.$iResult['paypal_fee'].' - Total: $'.$iResult['net_amount'].'',
                    'type'          =>   $type->id,
                    'status'        =>   $status->id,
                ];
        
                $reg        =   TransferencePaypal::RegisteTrans($iData);

                $myWallet   =   $user->getWallet(auth()->user()->identified);
            
                $transaction    =   $myWallet->depositFloat($iResult['net_amount'], 
                    [
                        'Description'   =>  'Paypal Payment - Invoice: $'.$iResult['gross_amount'].' - Fee: $'.$iResult['paypal_fee'].' - Total: $'.$iResult['net_amount'].'',
                        'USD'           =>  $iResult['net_amount'],
                        'BS'            =>  ROUND( ($iResult['net_amount'] / $divisa->dolar), 2),
                        'DIVISA'        =>  $divisa->dolar,
                    ], false);
                
                $iPend   =   [
                    'identified'    =>  $identified,
                    'client'        =>  auth()->user()->client->client_id,
                    'transaction'   =>  $transaction->id,
                    'status'        =>  $status->id,
                    'method'        =>  TransferenceMethod::where('name', 'like', '%pay%')->first()->id
                ];
    
                $pen    =   TransferencePending::RegisteTrans($iPend);

                $trans  =   TransferencePending::where('identified', '=', $identified)->first()->transaction;

                $iPend      =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', $trans], ['confirmed', 0]])->first();

                if($myWallet->confirm($iPend) == true)
                {
                    $report             =   TransferencePaypal::where('identified', '=', $identified)->first();
            
                    $report->status_id  =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                    $report->save();
        
                    $pending            =   TransferencePending::where('identified', '=', $identified)->first();
                    $pending->status_id =   TransferenceStatus::where('name','like','%proce%')->first()->id;
                    $pending->save();
        
                }

                return view('page/clients/wallet/paypal/confirmed',[
                    'd'     =>  $iResult,
                    'u'     =>  $user
                ]);            
            }         
                
        } catch (\Exception $e) {

            return view('pages/clients/wallet/paypal/process');
        }
    }

    public function Cancel(Request $request)
    {
        try {
            if(isset($request->token) <> false)
            {
                $cancel     =   PaypalOrder::DataGet($request->token);
                $cancel->status     =   'CANCEL';
                $cancel->save();

                return view('page/clients/wallet/paypal/cancel');
                
            }else{
                return redirect('/404');
            }
        } catch (\Exception $e) {
            return redirect('/404');
        }
    }

    private function CalculatorPaypal($amount, $ty)
    {

        $por        =   5.4;
        $fee        =   0.3;

        if($ty == 1)
        {
            $tAmo       =   (100 * ($fee + $amount)) / ((0-$por) + 100);
            $tCom       =   ($tAmo - $amount);
            $tGen       =   $amount + $tCom;
            
        }else{
            $tAmo       =   $amount - ((($por * $amount) / 100) + $fee);
            $tCom       =   (($por * $amount) / 100) + $fee;
            $tGen       =   $amount - $tCom;
        }


        $iData      =   [
            'tInv'  =>  ROUND($amount ,2),
            'tCom'  =>  ROUND($tCom, 2),
            'tAmo'  =>  ROUND($tGen, 2)
        ];

        return $iData;
    }

    private function getAccessToken($clientId, $secret)
    {
        try {
            $response   =   $this->client->request('POST', '/v1/oauth2/token', [
                'header'    =>  [
                    'Accept'        =>  'application/json',
                    'Content-Type'  =>  'application/x-www-form-urlencoded',
                ],
                'body'  =>  'grant_type=client_credentials',
                'auth'  =>  [
                    $clientId, 
                    $secret, 
                    'basic'
                ]
            ]);
          
            $data   =   json_decode($response->getBody(), true);

            return  $data['access_token'];

        } catch (\Exception $e)  { return false; }
    }

    private function getHeaders()
    {
        return  [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type'  => 'application/json'
        ];
    }

    private function OrderBody($iData)
    {
        return json_encode([
            "intent"            =>  "CAPTURE",
            "purchase_units"    =>  [
                [
                    "amount"    =>  [
                        "currency_code" =>  "USD",
                        "value" =>  $iData["amount"]
                    ],
                ],
            ],
            "application_context"   =>  [
                "brand_name"    =>  "BoomSolutions - Venezuela",
                "landing_page"  =>  "NO_PREFERENCE",
                "user_action"   =>  "PAY_NOW",
                "return_url"    =>  $iData["http"]."://".$iData["host"]."/paypal/process",
                "cancel_url"    =>  $iData["http"]."://".$iData["host"]."/paypal/cancel"                
            ]
        ]);
    }

    private function CreateOrder($iData)
    {
        $iResult    =   false;

        try {
            $response = $this->client->request('POST', '/v2/checkout/orders', [
                    'headers'   =>  $this->getHeaders(),
                    'body'      =>  $this->OrderBody($iData)
                ],
            );
    
            $result     =   json_decode($response->getBody(), true);
            
            foreach ($result['links'] as $r => $res) {   if($res['rel'] == "approve")  { $link   =   $res['href'];   }   }

            $iResult    =   [
                'identified'    =>  $iData["identified"],
                'client_id'     =>  auth()->user()->client->client_id,
                'invoice_id'    =>  $iData["invoice_id"],
                'orderID'       =>  $result['id'],
                'currency'      =>  'USD',
                'amount'        =>  $iData["invo"],
                'tax'           =>  $iData['comi'],
                'total'         =>  $iData['amount'],
                'link'          =>  $link,
                'status'        =>  ''
            ];

            $insOrder   =   PaypalOrder::DataInsert($iResult);

            if($insOrder <> false)
            {
                return $iResult;
            }else{
                return false;
            }
            
        } catch (\Exception $e) {

            return $iResult;
        }
    }
}