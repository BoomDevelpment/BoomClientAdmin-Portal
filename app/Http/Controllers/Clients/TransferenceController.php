<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Transference\TransferenceBank;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TransferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }
    
    public function Register(Request $request)
    {
        $validator      =   Validator::make($request->all(), [
            't_asu'         => 'required|min:5',
            't_title'       => 'required|min:5',
            't_total'       => 'required',
            't_date'        => 'required',
            't_dni'         => 'required|min:5',
            't_bank'        => 'required',
            't_reference'   => 'required',
        ]);
       
        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Parametros Incompletos',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $verf   =   TransferenceBank::GeTransferences(auth()->user()->client->client_id);

        $iComp  =   false;

        if($verf)
        {
            foreach ($verf as $v => $ver)   {   if( strpos( substr($ver->reference, -5), substr($request->t_reference, -5) ) !== false ){   $iComp  =   true; }  }
            
            if($iComp == true)
            {
                return response()->json([
                    'success'   =>  false,
                    'message'   => 'El código de referencia ya se encuentra registrado',
                ],  Response::HTTP_UNAUTHORIZED);

            }
        }
       
        if(COUNT(TransferenceFile::SearchFile($request->t_ide)) == 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Para completar la solicitud debe ingresar al menos un archivo adjunto.',
            ], Response::HTTP_UNAUTHORIZED); 
        }
        
        $divisa     =   Scrapers::getLast();
        $type       =   TransferenceType::where([ ['status_id', '=', 1], ['name', 'like', '%bol%'] ])->get()[0];
        $status     =   TransferenceStatus::where([ ['status_id', '=', 1], ['name', 'like', '%pen%'] ])->get()[0];

        $iData  =   [
            'identified'    =>   $request->t_ide,
            'client_id'     =>   auth()->user()->client->client_id,
            'subject'       =>   $request->t_asu,
            'title'         =>   $request->t_title,
            'date_trans'    =>   $request->t_date,
            'dni'           =>   $request->t_dni,
            'account'       =>   ($request->t_account <> '') ? $request->t_account : '',
            'reference'     =>   $request->t_reference,
            'total'         =>   round( ($request->t_total / $divisa->dolar), 2),
            'bs'            =>   $request->t_total,
            'description'   =>   ($request->t_message <> '') ? $request->t_message : 'Transference date: '.date("Y-m-d H:m:s").'',
            'bank'          =>   $request->t_bank,
            'type'          =>   $type->id,
            'status'        =>   $status->id,
        ];

        $reg    =   TransferenceBank::RegisteTrans($iData);
      
        if($reg <> false)
        {
            $user       =   User::find(auth()->user()->id);
            $myWallet   =   $user->getWallet(auth()->user()->identified);

            $transaction    =   $myWallet->depositFloat($iData['total'], 
                [
                    'Description'   =>  $iData['description'],
                    'USD'           =>  $request->t_amount,
                    'BS'            =>  $iData['bs'],
                    'DIVISA'        =>  $divisa->dolar,
                ], false);
            
            $iPend   =   [
                'identified'    =>  $request->t_ide,
                'client'        =>  auth()->user()->client->client_id,
                'transaction'   =>  $transaction->id,
                'status'        =>  $status->id,
                'method'        =>  TransferenceMethod::where('name', 'like', '%trans%')->get()[0]->id
            ];

            $pen    =   TransferencePending::RegisteTrans($iPend);

            if($pen <> false)
            {
                return response()->json([
                    'success'   =>  true,
                    'message'   =>  'Datos almacenados correctamente.',
                    'url'       =>  url('/wallet')
                ], Response::HTTP_OK);        

            }else{

                return response()->json([
                    'success' => false,
                    'message' => 'Error al intentar almancenar la informaci&oacute;n, intente nuevamente. Pending',
                ], Response::HTTP_UNAUTHORIZED); 

            }

        }else{

            return response()->json([
                'success' => false,
                'message' => 'Error al intentar almancenar la informaci&oacute;n, intente nuevamente. Register',
            ], Response::HTTP_UNAUTHORIZED); 
        }

    }

    public function Confirm(Request $request)
    {
        $divisa     =   Scrapers::getLast();

        return response()->json([
            'success'   =>  true,
            'bs'        =>  round($request->amount,2),
            'usd'       =>  round( ($request->amount / $divisa->dolar), 2),
            'dolar'     =>  $divisa->dolar
        ],  Response::HTTP_OK);

    }

    public function Files(Request $request)
    {
        if($request->file('t_file'))
        {
            try {
                $fileName   =   auth()->user()->client->client_id.'-'.$request->t_ide_f.'-'.time().'.'.$request->file('t_file')->extension();
                $request->file('t_file')->move(public_path('files/transference'), $fileName);

                $data   =   [
                    'identified'    =>  $request->t_ide_f,
                    'name'          =>  $fileName,
                    'dir'           =>  'files/transference'
                ];

                $res    =   TransferenceFile::RegFile($data);

                if($res <> false)
                {
                    return response()->json([
                        'success'   =>  true,
                        'file'      =>  $fileName,
                        'tp'        =>  1,
                        'id'        =>  $request->t_ide_f
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
}
