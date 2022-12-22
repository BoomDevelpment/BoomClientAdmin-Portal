<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Payments\ConsolidateZelle;
use App\Models\Clients\Pivot\ClientUser;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function Index(Request $request)
    // {  
    //     return view('page/admins/payments/index',[
    //         'date'  =>  Carbon::now()
    //     ]);
    // }

    // public function Image(Request $request)
    // {  
        
    //     try {
    //         $img    =   TransferenceFile::where('identified', $request->ref)->get();
            
    //         return response()->json(['datos' => $img], Response::HTTP_OK);

    //     } catch (\Exception $e) {            
    //         return response()->json(['message' => "Data not found"], Response::HTTP_UNAUTHORIZED);
    //     }
    // }

    // public function ImageId(Request $request)
    // {  
    //     try {
    //         $img    =   TransferenceFile::where('id', $request->id)->first();
    //         return response()->json(['datos' => $img], Response::HTTP_OK);

    //     } catch (\Exception $e) {            
    //         return response()->json(['message' => "Data not found"], Response::HTTP_UNAUTHORIZED);
    //     }
    // }







    // public function Paypal(Request $request)
    // {  
    //     return view('page/admins/payments/paypal/index',[
    //     ]);
    // }

    // public function Transference(Request $request)
    // {  
    //     return view('page/admins/payments/transference/index',[
    //     ]);
    // }

    // public function Movil(Request $request)
    // {  
    //     return view('page/admins/payments/movil/index',[
    //     ]);
    // }



    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }   

        return $data;
    }

    private function StaticsGeneral($d)
    {
        $status     =   TransferenceStatus::get();

        $t1 =   'transference_zelles';
        $t2 =   'consolidate_zelles';
        $BW =   'created_at BETWEEN "'.$d['ini'].'" AND "'.$d['end'].'"';

        foreach ($status as $s => $st) 
        {
            $iConsStatus[$st->name] =   DB::select('SELECT COUNT(*) T, IF( SUM(report_amount) > 0, SUM(report_amount), "0.00" ) as cAbsolute 
                                            FROM '.$t2.'    
                                            WHERE status_id = "'.$st->id.'" 
                                            AND '.$BW.'')[0];

            $iTranStatus[$st->name] =   DB::select('SELECT COUNT(*) T, 
                                            IF( SUM(total) > 0, SUM(total), "0.00" ) as cTotal, 
                                            IF( SUM(amount) > 0, SUM(amount), "0.00" ) as cAbsolute 
                                            FROM '.$t1.'    
                                            WHERE status_id = "'.$st->id.'" 
                                            AND '.$BW.'')[0];
        }

        $iTranInfo  =   DB::SELECT('SELECT COUNT(*) T, SUM(TOTAL) TOTAL, SUM(AMOUNT) AMOUNT, ROUND(AVG(AMOUNT),2) PROMEDIO 
                            FROM '.$t1.' 
                            WHERE '.$BW.'')[0];

        $iConsInfo  =   DB::SELECT('SELECT COUNT(*) T, SUM(report_amount) AMOUNT, ROUND(AVG(report_amount),2) PROMEDIO
                            FROM '.$t2.' 
                            WHERE '.$BW.'')[0];
       
        return  [
            'E'     =>  [
                'r'     =>  $iTranInfo->T,
                'c'     =>  $iConsStatus['CONSOLIDADO']->T,
                'pe'    =>  $iConsStatus['PENDIENTE']->T,
                'pr'    =>  $iConsStatus['PROCESADO']->T
            ],
            'E1'    =>   [
                't' =>  ROUND($iConsInfo->AMOUNT,2),
                'r' =>  $iConsInfo->T,
                'a' =>  $iConsInfo->PROMEDIO 
            ],
            'E2'    =>   [
                'T' =>  ($iConsStatus['PENDIENTE']->T <> 0 ) ? ROUND( ( ($iTranStatus['PROCESADO']->T * 100 ) / $iConsStatus['PENDIENTE']->T),2) : 0,
                's' =>  [
                    're'    =>  ($iTranInfo->T <> 0) ? ROUND(( ($iTranInfo->T * 100 ) / $iTranInfo->T),2) : 0,
                    'co'    =>  ($iTranInfo->T <> 0) ? ROUND(( ($iTranStatus['CONSOLIDADO']->T * 100 ) / $iTranInfo->T),2) : 0,
                    'pr'    =>  ($iTranInfo->T <> 0) ? ROUND(( ($iTranStatus['PROCESADO']->T * 100 ) / $iTranInfo->T),2) : 0,
                    'pe'    =>  ($iTranInfo->T <> 0) ? ROUND(( ($iTranStatus['PENDIENTE']->T * 100 ) / $iTranInfo->T),2) : 0,
                ]
            ],
            'E3'    =>   [
                'T' =>  ($iConsInfo->AMOUNT <> 0) ? ROUND( ( ($iTranInfo->AMOUNT * 100 ) / $iConsInfo->AMOUNT),2) : 0,
                's' =>  [
                    'co'    =>  ($iTranInfo->AMOUNT <> 0) ? ROUND(( ($iTranStatus['CONSOLIDADO']->cAbsolute * 100 ) / $iTranInfo->AMOUNT),2) : 0,
                    'pr'    =>  ($iTranInfo->AMOUNT <> 0) ? ROUND(( ($iTranStatus['PROCESADO']->cAbsolute * 100 ) / $iTranInfo->AMOUNT),2) : 0,
                    'pe'    =>  ($iTranInfo->AMOUNT <> 0) ? ROUND(( ($iTranStatus['PENDIENTE']->cAbsolute * 100 ) / $iTranInfo->AMOUNT),2) : 0,
                ]
            ]
        ];
    }

    /*************************************************************************
     ************************ General Zelle Functions ************************
     *************************************************************************/

    public function zIndex(Request $request)
    {
        return view('page/admins/payments/zelle/index',[
            'date'  =>  Carbon::now()
        ]);
    }

    public function zLoad(Request $request)
    {
        $iDate     =   [
            'ini'       =>  Carbon::now()->startOfMonth()->toDateString(),
            'end'       =>  Carbon::now()->endOfMonth()->toDateString(),
        ];

        $transference   =   TransferenceZelle::GetByRangeDate($iDate);
        $consolidate    =   ConsolidateZelle::GetByDate($iDate, 3);

        return response()->json([
            'data'          =>  $transference,
            'consolidate'   =>  $consolidate,
            'info'          =>  $this->StaticsGeneral($iDate)
        ], Response::HTTP_OK);
    }

    public function zEdit(Request $request)
    {
        $params     =   [];
        $c       =   0;
        parse_str($request->data, $params);
        $status     =   TransferenceStatus::GetId('canc');
        $sPend      =   TransferenceStatus::GetId('pend');

        if($request->tp == 'charge')
        {
            $tp     =   'charId';
        }elseif($request->tp == 'client')
        {
            $tp     =   'clieId';
        }elseif($request->tp == 'consolidate')
        {
            $tp     =   'consId';
        }

        if($request->id == 1)
        {
            foreach ($params as $p => $pa) 
            {   
                if($p != 'tCharger_length') 
                { 
                    if(strpos($p, $tp) !== false )    
                    {   
                        $info[$c++] = ['id' => substr($p, 6, strlen($p)), 'status' => $status->id];
                    }
                }   
            }
    
            if($c < 1)
            {
                return response()->json([
                    'success'   =>  false,
                    'message'   =>  "You must select at least one valid option",
                ], Response::HTTP_UNAUTHORIZED);
            }

            foreach ($info as $i => $in) 
            {
                try {

                    if( ( $request->tp == 'charge') || ( $request->tp == 'consolidate') )
                    {   $up     =   ConsolidateZelle::where('id', '=', $in['id'])->first();
                        $up->operator_id    =   auth()->user()->operator->operator_id;
                    }elseif($request->tp == 'client')
                    {   $up     =   TransferenceZelle::where('id', '=', $in['id'])->first();    }

                    $up->status_id      =   $in['status'];
                    $up->save();

                } catch (\Exception $e) {
                    return response()->json([
                        'success'   =>  false,
                        'message'   =>  $e->getMessage(),
                    ], Response::HTTP_UNAUTHORIZED);
                }
            }

            return response()->json([
                'success'   =>  true,
                'message'   =>  'References updated correctly'
            ], Response::HTTP_OK);
        }

        if($request->id == 2)
        {
            $d     =   [
                'ini'       =>  Carbon::now()->startOfMonth()->toDateString(),
                'end'       =>  Carbon::now()->endOfMonth()->toDateString(),
            ];

            try {

                if($request->tp == 'charge')
                {   $update     =   ConsolidateZelle::where('status_id', '=', $sPend->id)->whereBetween('created_at', [$d['ini'], $d['end']])->get();
                }elseif($request->tp == 'client')
                {   $update     =   TransferenceZelle::where('status_id', '=', $sPend->id)->whereBetween('created_at', [$d['ini'], $d['end']])->get();    }

                foreach ($update as $u => $up) 
                {
                    $up->status_id      =   $status->id;
                    $up->operator_id    =   auth()->user()->operator->operator_id;
                    $up->save();
                }

                return response()->json([
                    'success'   =>  true,
                    'message'   =>  'References updated correctly'
                ], Response::HTTP_OK);
                
            } catch (\Exception $e) {
                return response()->json([
                    'success'   =>  false,
                    'message'   =>  $e->getMessage(),
                ], Response::HTTP_UNAUTHORIZED);
            }
        }
    }

    public function zEditClients(Request $request)
    {
        try {
            return response()->json(['status' => true, 'data' => TransferenceZelle::GetReferenceById($request->id)], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }

    }

    public function zUpload(Request $request)
    {

        $count = 0;
        $iError = false;
        $status     =   TransferenceStatus::where('name', 'LIKE', '%pend%')->first()->id;

        switch ($request->delimite) {
            case '1':   $delimite   =   ','; break;
            case '2':   $delimite   =   ';'; break;
            default:    $delimite   =   ','; break;
        }

        if($request->file('file') == null)
        {                
            return response()->json([
                'success'   =>  false,
                'message'   =>  "You must upload an attachment",
            ], Response::HTTP_UNAUTHORIZED);
        }

        if($request->file('file')->extension() == 'csv')
        {
            $data       =   array();
            $filename   =   $request->file('file')->getRealPath();

            $customerArr = $this->csvToArray($filename);

            if( ($handle = fopen($filename, 'r') ) !== false )
            {
                set_time_limit(0);  $c  =   0;
                while(($data = fgetcsv($handle, 1000, $delimite)) !== FALSE) { while(isset($data[$c]) == true) { $field[$c] = $data[$c]; $c++; } }
            }

            if( isset($field[0]) && isset($field[1]) && isset($field[2]))
            {
                foreach ($customerArr as $k => $val) 
                {

                    $data   =   [
                        'date'      =>  \Carbon\Carbon::parse($val['Date'])->format('Y-m-d'),
                        'code'      =>  trim($val['Code']),
                        'amount'    =>  trim( round($val['Amount'],2) ),
                        'status'    =>  $status,
                        'operator'  =>  auth()->user()->operator->operator_id
                    ];

                    $code  =    ConsolidateZelle::GetCode($data['code']);

                    if($code == null)
                    {
                        $reg    =   ConsolidateZelle::RegisterData($data);
                       
                        if($reg == false)
                        {
                            $iData[$k]  =    [
                                'date'      =>  \Carbon\Carbon::parse($val['Date'])->format('Y-m-d'),
                                'code'      =>  trim($val['Code']),
                                'status'    =>  "Error"
                            ];
                        }else{
                            $iData[$k]  =    [
                                'date'      =>  \Carbon\Carbon::parse($val['Date'])->format('Y-m-d'),
                                'code'      =>  trim($val['Code']),
                                'status'    =>  "New"
                            ];
                        }
                    }else{

                        $iData[$k]  =    [
                            'date'      =>  \Carbon\Carbon::parse($val['Date'])->format('Y-m-d'),
                            'code'      =>  trim($val['Code']),
                            'status'    =>  "Register"
                        ];
                    }                  
                }
                                
                return response()->json([
                    'success'   =>  true,
                    'idata'     =>  $iData
                ], Response::HTTP_OK);

            }else{
                return response()->json([
                    'success'   =>  false,
                    'message'   =>  "Incompatible file format",
                ], Response::HTTP_UNAUTHORIZED);
            }
        }
    }

    public function zSearchConsolidate(Request $request)
    {
        $iDate     =   [
            'ini'       =>  Carbon::now()->startOfMonth()->toDateString(),
            'end'       =>  Carbon::now()->endOfMonth()->toDateString(),
        ];
        $consolidate    =   ConsolidateZelle::Consolidate($iDate, 1);

        return response()->json([
            'status'    =>  $consolidate['status'],
            'message'   =>  $consolidate['message'],
        ], Response::HTTP_OK);

    }

    public function zConsolidate(Request $request)
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
                    }

                }else{

                    $iPend  =   $user->transactions()->where([['wallet_id', $myWallet->id], ['id', $cons->transaction_id], ['confirmed', 0]])->first();

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
                    }
                }
            }

            if($cont > 0)
            {
                return response()->json([
                    'status'    =>  true,
                    'message'   =>  "Reconciliation performed successfully, please wait while the information is updated"
                ], Response::HTTP_OK);

            }else{
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  "No Matching information for reconciliation"
                ], Response::HTTP_UNAUTHORIZED);
            }

        }

        return response()->json([
            'status'   =>  false,
            'message'   =>  "No Matching information for reconciliation"
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function zImage(Request $request)
    {  
        
        try {
            $img    =   TransferenceFile::where('identified', $request->ref)->get();
            
            return response()->json(['datos' => $img], Response::HTTP_OK);

        } catch (\Exception $e) {            
            return response()->json(['message' => "Data not found"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function zImageId(Request $request)
    {  
        try {
            $img    =   TransferenceFile::where('id', $request->id)->first();
            return response()->json(['datos' => $img], Response::HTTP_OK);

        } catch (\Exception $e) {            
            return response()->json(['message' => "Data not found"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function zRefEdit(Request $request)
    {  

        try {
            $conStatus    =   TransferenceStatus::GetId('cons')->id;
            $penStatus    =   TransferenceStatus::GetId('pend')->id;
            $proStatus    =   TransferenceStatus::GetId('proc')->id;

            $upd    =   TransferenceZelle::GetReferenceById($request->crIdReport);
            
            $iRes   =   TransferenceZelle::where([
                ['reference',   'LIKE', '%'.$request->crReport.'%'],
                ['id',          '!=', $request->crIdReport]
            ])
            ->whereIn('status_id', [$conStatus, $penStatus, $proStatus])
            ->get();

            if(COUNT($iRes) > 0)
            {            
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  "The reference code is already registered, please try again."
                ], Response::HTTP_UNAUTHORIZED);
            }

            $upd->reference     =   $request->crReport;
            $upd->total         =   $request->arReport;
            $upd->save();

            return response()->json([
                'status'    =>  true,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
