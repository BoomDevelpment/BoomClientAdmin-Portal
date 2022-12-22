<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferencePaypal;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ZelleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }
    
    public function Verificate(Request $request)
    {
        try {
            $verf   =   TransferenceZelle::GetReference($request->to);
            
            if($verf == false)
            {
                return response()->json([
                    'success'   =>  true,
                ],  Response::HTTP_OK);
            }else{
                return response()->json([
                    'success'   =>  false,
                ],  Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success'   =>  false,
            ],  Response::HTTP_UNAUTHORIZED);
        }
    }

    public function Register(Request $request)
    {
        
        $validator      =   Validator::make($request->all(), [
            'zl_r_asu'          => 'required|min:5',
            'zl_r_titular'      => 'required|min:5',
            'zl_r_date'         => 'required|min:5',
            'zl_r_reference'    => 'required|min:5',
            'zl_r_amount'       => 'required',
        ]);

        
        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Parámetros incompletos o no superaron la validación',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $verf   =   TransferenceZelle::GeTransferences(auth()->user()->client->client_id);

        $iComp  =   false;

        if($verf)
        {
            foreach ($verf as $v => $ver)   {   if( strpos( substr($ver->reference, -5), substr($request->zl_r_reference, -5) ) !== false ){   $iComp  =   true; }  }
            
            if($iComp == true)
            {
                return response()->json([
                    'success'   =>  false,
                    'message'   => 'El código de referencia ya se encuentra registrado',
                ],  Response::HTTP_UNAUTHORIZED);

            }
        }
       
        if(COUNT(TransferenceFile::SearchFile($request->zl_r_ide)) == false)
        {
            return response()->json([
                'success' => false,
                'message' => 'Para completar la solicitud debe ingresar al menos un archivo adjunto.',
            ], Response::HTTP_UNAUTHORIZED); 
        }
        
        $divisa     =   Scrapers::getLast();
        $type       =   TransferenceType::where([ ['status_id', '=', 1], ['name', 'like', '%dol%'] ])->get()[0];
        $status     =   TransferenceStatus::where([ ['status_id', '=', 1], ['name', 'like', '%pen%'] ])->get()[0];

        $iData  =   [
            'identified'    =>  $request->zl_r_ide,
            'client_id'     =>  auth()->user()->client->client_id,
            'subject'       =>  $request->zl_r_asu,
            'title'         =>  $request->zl_r_titular,
            'date_trans'    =>  $request->zl_r_date,
            'reference'     =>  $request->zl_r_reference,
            'total'         =>  $request->zl_r_amount,
            'amount'        =>  0.00,
            'bs'            =>  round( ($divisa->dolar * $request->zl_r_amount), 2),
            'description'   =>  ($request->zl_r_message <> '') ? $request->zl_r_message : 'Transference date: '.date("Y-m-d H:m:s").'',
            'type'          =>  $type->id,
            'status'        =>  $status->id,
        ];

        $reg    =   TransferenceZelle::RegisteTrans($iData);
      
        if($reg <> false)
        {
            $user       =   User::find(auth()->user()->id);
            $myWallet   =   $user->getWallet(auth()->user()->identified);

            $transaction    =   $myWallet->depositFloat($iData['total'], 
                [
                    'Description'   =>  $iData['description'],
                    'USD'           =>  $request->zl_r_amount,
                    'BS'            =>  $iData['bs'],
                    'DIVISA'        =>  $divisa->dolar,
                ], false);
            
            $iPend   =   [
                'identified'    =>  $request->zl_r_ide,
                'client'        =>  auth()->user()->client->client_id,
                'transaction'   =>  $transaction->id,
                'status'        =>  $status->id,
                'method'        =>  TransferenceMethod::where('name', 'like', '%zel%')->get()[0]->id
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
        if($files   =   $request->file('file'))
        {
            try {
                $fileName   =   auth()->user()->client->client_id.'-'.$request->zl_r_ide_f.'-'.time().'.'.$request->file->extension();
                $request->file->move(public_path('files/zelle'), $fileName);
               
                $data   =   [
                    'identified'    =>  $request->zl_r_ide_f,
                    'name'          =>  $fileName,
                    'dir'           =>  'files/zelle'
                ];

                $res    =   TransferenceFile::RegFile($data);

                if($res <> false)
                {
                    return response()->json([
                        'success'   =>  true,
                        'file'      =>  $fileName,
                        'id'        =>  $request->zl_r_ide_f
                    ],  Response::HTTP_OK);

                }else{
                    return response()->json([
                        'success'   => false,
                        'file'      => '',
                    ], Response::HTTP_UNAUTHORIZED);
                }    

            } catch (\Exception $e) {
                dd($e->getMessage());
                return response()->json([
                    'success'   => false,
                    'file'      => '',
                ], Response::HTTP_UNAUTHORIZED);
            }

        }else{
            return response()->json([
                'success'   => false,
                'file'      => '',
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
