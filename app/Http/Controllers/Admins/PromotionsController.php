<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Promotions\Promotions;
use App\Models\Admins\Promotions\PromotionsActivation;
use App\Models\Admins\Promotions\PromotionsRecurrence;
use App\Models\Admins\Promotions\PromotionsTechnology;
use App\Models\Admins\Promotions\PromotionsType;
use App\Models\Clients\Country\Estate;
use App\Models\Clients\General\Status;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Carbon\Carbon;

class PromotionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $estates    =   Estate::where('id', 12)->orWhere('id', 22)->get();    
        return view('page/admins/policys/index',[
            'estates'       =>  $estates,
            'type'          =>  PromotionsType::get(),
            'technology'    =>  PromotionsTechnology::get(),
        ]);
    }

    public function Policy(Request $request)
    {
        $estates    =   Estate::where('id', 12)->orWhere('id', 22)->get();
        
        return view('page/admins/policys/register/index',[
            'estates'       =>  $estates,
            'type'          =>  PromotionsType::get(),
            'technology'    =>  PromotionsTechnology::get(),
        ]);
    }

    public function Register(Request $request)
    {
        $tyCant =   ($request->tyPromo == 1) ? 24 : 36;

        try {
            $iniDateCheck   =   checkdate(substr($request->dIniPromo, 5,2), substr($request->dIniPromo, 8,2), substr($request->dIniPromo, 0,4));
            $iniDate        =   ($iniDateCheck == true) ? $request->dIniPromo : Carbon::now()->format('Y-m-d');
        } catch (\Exception $e) {   $iniDate        =   Carbon::now()->format('Y-m-d'); }

        try {
            $endDateCheck   =   checkdate(substr($request->dEndPromo, 5,2), substr($request->dEndPromo, 8,2), substr($request->dEndPromo, 0,4));
            $endDate        =   ($endDateCheck == true) ? $request->dEndPromo : Carbon::now()->addMonth(3)->format('Y-m-d');
        } catch (\Exception $e) { $endDate        =   Carbon::now()->addMonth(3)->format('Y-m-d'); }

        $i  =   $w  =   1;

        for ($i=0; $i <= $tyCant; $i++) 
        { 
            if(isset($_POST['RMO'.$i])) { $iPromo[$i]   = ['month' =>  $_POST['RMO'.$i], 'cost'  =>  $_POST['RCO'.$i], 'mult'  =>  $_POST['RMU'.$i], 'iva'  =>  $_POST['RIVA'.$i], 'total' =>  $_POST['RTO'.$i] ]; }
            if(isset($_POST['IAO'.$i])) { $iInst[$i]   =  ['month' =>  $_POST['IAO'.$i], 'cost'  =>  $_POST['ICO'.$i], 'mult'  =>  $_POST['IMU'.$i], 'iva'  =>  $_POST['IIVA'.$i], 'total' =>  $_POST['ITO'.$i] ]; }
        }

        try {
            $new                =    new    Promotions();
            $new->title         =   ucfirst($request->tPromo);
            $new->subtitle      =   ucfirst($request->sbPromo);
            $new->cost          =   $request->cPromo;
            $new->iva_cost      =   $request->cIvaPromo;
            $new->inst          =   $request->iPromo;
            $new->iva_inst      =   $request->iIvaPromo;
            $new->estate_id     =   $request->esPromo;
            $new->city_id       =   $request->ciPromo;
            $new->technology_id =   $request->tePromo;
            $new->type_id       =   $request->tyPromo;
            $new->date_ini      =   $iniDate;
            $new->date_end      =   $endDate;
            $new->status_id     =   Status::where('name', 'like', '%act%')->first()->id;
            $new->save();

        } catch (\Exception $e) {

            return response()->json([
                'success'   =>  false,
                'message'   =>  "Error al intentar crear la promocion, intente nuevamente.",
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {

            foreach ($iPromo as $r => $re) 
            {
                $rec                =   new PromotionsRecurrence();
                $rec->promotion_id  =   $new->id;
                $rec->month         =   $re['month'];
                $rec->cost          =   $re['cost'];
                $rec->mult          =   $re['mult'];
                $rec->iva           =   $re['iva'];
                $rec->total         =   $re['total'];
                $rec->save();
            }
        } catch (\Exception $e) {
            
            return response()->json([
                'success'   =>  false,
                'message'   =>  "Error creando la recurrencia de la promocion, contacte a su administrador de sistemas.",
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {

            foreach ($iInst as $i => $in) 
            {
                $int                =   new PromotionsActivation();
                $int->promotion_id  =   $new->id;
                $int->month         =   $in['month'];
                $int->cost          =   $in['cost'];
                $int->mult          =   $in['mult'];
                $int->iva           =   $in['iva'];
                $int->total         =   $in['total'];
                $int->save();
            }
        } catch (\Exception $e) {
            
            return response()->json([
                'success'   =>  false,
                'message'   =>  "Error creando la recurrencia de la promocion, contacte a su administrador de sistemas.",
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success'   =>  true,
            'message'   =>  "Política creada satisfactoriamente.",
            'url'       =>  url('/admins')
        ], Response::HTTP_OK);
    }
}
