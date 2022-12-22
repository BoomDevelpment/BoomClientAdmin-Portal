<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferenceMovil;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PagoMovilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }
    
    public function Register(Request $request)
    {       
        $validator      =   Validator::make($request->all(), [
            'm_asu'         => 'required|min:5',
            'm_title'       => 'required|min:5',
            'm_phone'       => 'required',
            'm_total'       => 'required',
            'm_date'        => 'required',
            'm_dni'         => 'required',
            'm_bank'        => 'required',
            'm_reference'   => 'required',
        ]);
       
        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Parametros Incompletos',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $verf   =   TransferenceMovil::GeTransferences(auth()->user()->client->client_id);

        $iComp  =   false;

        if($verf)
        {
            foreach ($verf as $v => $ver)   {   if( strpos( substr($ver->reference, -5), substr($request->m_reference, -5) ) !== false ){   $iComp  =   true; }  }
            
            if($iComp == true)
            {
                return response()->json([
                    'success'   =>  false,
                    'message'   => 'El código de referencia ya se encuentra registrado',
                ],  Response::HTTP_UNAUTHORIZED);

            }
        }

        if(COUNT(TransferenceFile::SearchFile($request->m_ide)) == 0)
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
            'identified'    =>   $request->m_ide,
            'client_id'     =>   auth()->user()->client->client_id,
            'subject'       =>   $request->m_asu,
            'title'         =>   $request->m_title,
            'date_trans'    =>   $request->m_date,
            'dni'           =>   $request->m_dni,
            'phone'         =>   ($request->m_phone <> '') ? $request->m_phone : '',
            'reference'     =>   $request->m_reference,
            'total'         =>   round( ($request->m_total / $divisa->dolar), 2),
            'bs'            =>   $request->m_total,
            'description'   =>   ($request->m_message <> '') ? $request->m_message : 'Transference date: '.date("Y-m-d H:m:s").'',
            'bank'          =>   $request->m_bank,
            'type'          =>   $type->id,
            'status'        =>   $status->id,
        ];

        $reg    =   TransferenceMovil::RegisteTrans($iData);
      
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
                'identified'    =>  $request->m_ide,
                'client'        =>  auth()->user()->client->client_id,
                'transaction'   =>  $transaction->id,
                'status'        =>  $status->id,
                'method'        =>  TransferenceMethod::where('name', 'like', '%pag%')->get()[0]->id
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

    public function Files(Request $request)
    {
        if($request->file('m_file'))
        {
            try {
                $fileName   =   auth()->user()->client->client_id.'-'.$request->m_ide_f.'-'.time().'.'.$request->file('m_file')->extension();
                $request->file('m_file')->move(public_path('files/movil'), $fileName);

                $data   =   [
                    'identified'    =>  $request->m_ide_f,
                    'name'          =>  $fileName,
                    'dir'           =>  'files/movil'
                ];

                $res    =   TransferenceFile::RegFile($data);

                if($res <> false)
                {
                    return response()->json([
                        'success'   =>  true,
                        'file'      =>  $fileName,
                        'tp'        =>  2,
                        'id'        =>  $request->m_ide_f
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
