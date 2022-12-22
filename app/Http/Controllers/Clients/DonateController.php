<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Donative\DonativeImage;
use App\Models\Clients\Donative\DonativeRegister;
use App\Models\Clients\General\Status;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class DonateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }

    public function index(Request $request)
    {
        $user       =   User::findOrFail(auth()->user()->id);

        $iPhotos    =   DonativeImage::where('status_id', '=', Status::where('name', 'like', '%act%')->first()->id)->orderBy('id', 'ASC')->get();

        return view('page/clients/donatives/index',[
            'pho'   =>  $iPhotos
        ]);
    }

    public function Register(Request $request)
    {
       
        try {
            
            $user       =   User::findOrFail(auth()->user()->id);
            $myWallet   =   $user->getWallet(auth()->user()->identified);
            $balance    =   $myWallet->balanceFloat;

            if( $request->to > $balance)
            {
                return response()->json([
                    'success'   =>  false,
                    'message'   =>  "Su balance actual es menor al monto que desea donar.",
                    'url'       =>  url('/donate')
                ], Response::HTTP_UNAUTHORIZED);
            }

            $donate     =   $myWallet->WithdrawFloat($request->to, ['Description' => 'DONATIVO DE $ '.$request->to.' PARA MANITOS BOOM']);

            if($donate->confirmed ==  true)
            {
                $iData  =   [
                    'client'        =>  auth()->user()->client->client_id,
                    'amount'        =>  $request->to,
                    'transaction'   =>  $donate->id,
                    'status_id'     =>  TransferenceStatus::where('name', 'LIKE', '%pro%')->first()->id
                ];
            
                $insert     =   DonativeRegister::Register($iData);

                return response()->json([
                    'success'   =>  true,
                    'message'   =>  "Procesado correctamente",
                    'url'       =>  url('/donate')
                ], Response::HTTP_OK);
            }

        } catch (\Exception $e) {
            
            return response()->json([
                'success'   =>  false,
                'message'   =>  $e->getMessage(),
                'url'       =>  url('/donate')
            ], Response::HTTP_UNAUTHORIZED);

        }
    }
}
