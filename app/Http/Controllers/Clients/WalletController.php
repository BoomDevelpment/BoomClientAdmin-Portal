<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\General\Bank;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Transference\TransferenceBank;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMovil;
use App\Models\Clients\Transference\TransferencePaypal;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }
    
    public function index(Request $request)
    {
        try {

            $cli    =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);

        } catch (\Exception $e) {
            return redirect('/404');

        }
        
        $user       =   User::find(auth()->user()->id);
        $myWallet   =   $user->getWallet(auth()->user()->identified);

        if($myWallet == false)
        {
            $user->createWallet([
                'name'          =>  $user->identified,
                'slug'          =>  $user->identified,
                'meta'          =>  'USD',
                'description'   =>  'Wallet Client: '.$user->name.''
            ]);
        }

        $myWallet   =   $user->getWallet(auth()->user()->identified);

        $divisa     =   Scrapers::getLast();
        $bs         =   ($myWallet->balanceFloat > 0) ? ROUND(($myWallet->balanceFloat * $divisa->dolar),2) : '0.00';

        return view('page/clients/wallet/index',[
            'data'      =>  $cli,
            'wallet'    =>  $myWallet,
            'bs'        =>  $bs,
            'divisa'    =>  Scrapers::getLast(),
            'zelle'     =>  TransferenceZelle::where('client_id',  $cli->id)->limit(5)->orderBy('id', 'DESC')->get(),
            'paypal'    =>  TransferencePaypal::where('client_id', $cli->id)->limit(5)->orderBy('id', 'DESC')->get(),
            'trans'     =>  TransferenceBank::where('client_id', $cli->id)->limit(5)->orderBy('id', 'DESC')->get(),
            'movil'     =>  TransferenceMovil::where('client_id', $cli->id)->limit(5)->orderBy('id', 'DESC')->get(),
        ]);
    }

    public static function View(Request $request)
    {

        switch ($request->ty) 
        {
            case '1':
                try {
                    $data   =   TransferenceZelle::findOrFail($request->id);
                } catch (\Exception $e) {
                    $data   =   false;
                }
                break;
            case '2':
                try {
                    $data   =   TransferencePaypal::findOrFail($request->id);
                } catch (\Exception $e) {
                    $data   =   false;
                }
                break;
            case '3':
                try {
                    $data   =   TransferenceBank::findOrFail($request->id);
                } catch (\Exception $e) {
                    $data   =   false;
                }
                break;
            case '4':
                try {
                    $data   =   TransferenceMovil::findOrFail($request->id);
                } catch (\Exception $e) {
                    $data   =   false;
                }
                break;
            
            default:
                try {
                    $data   =   TransferenceZelle::findOrFail($request->id);
                } catch (\Exception $e) {
                    $data   =   false;
                }
                break;
        }
        if($data == false)
        {
            return response()->json([
                'success' =>    false,
                'message' =>    'Data not found.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $iData  =   [
            'sub'   =>  $data->subject,
            'des'   =>  $data->description,
            'date'  =>  $data->date_trans,
            'ref'   =>  $data->reference,
            'dol'   =>  $data->total,
            'bs'    =>  $data->bs,
            'sta'   =>  $data->status->name
        ];
        return response()->json([
            'success'   =>    true,
            'd' =>    $iData,
            'f' =>    TransferenceFile::SearchFile($data->identified),
        ], Response::HTTP_OK);
    }

    public static function ViewAll(Request $request)
    {
        switch ($request->ty) 
        {
            case '1':   $data   =   TransferenceZelle::orderBy('id', 'DESC')->get();   break;
            case '2':   $data   =   TransferencePaypal::orderBy('id', 'DESC')->get();   break;
            case '3':   $data   =   TransferenceBank::orderBy('id', 'DESC')->get();   break;
            case '4':   $data   =   TransferenceMovil::orderBy('id', 'DESC')->get();   break;
        }

        $iData  =   [];

        if(COUNT($data) > 0)
        {
            foreach ($data as $d => $da) 
            {
                $iData[$d]  =   [
                    'id'            =>  $da['id'],
                    'subject'       =>  $da['subject'],
                    'date_trans'    =>  $da['date_trans'],
                    'reference'     =>  $da['reference'],
                    'total'         =>  $da['total'],
                    'bs'            =>  $da['bs'],
                    'status'        =>  $da['status_id'],
                    'created'       =>  $da['created_at']
                ];
            }

        }

        return response()->json([
            'success'   =>    true,
            'd'         =>    $iData,
        ], Response::HTTP_OK);
    }

    public function WaRegister(Request $request)
    {
        return view('page/clients/wallet/register/index', [
            'bank'      =>  Bank::get(),
            'divisa'    =>  Scrapers::getLast()
        ]);
    }
}
