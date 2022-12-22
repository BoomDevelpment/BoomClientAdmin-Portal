<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Country\City;
use App\Models\Clients\Country\Estate;
use App\Models\Clients\Country\Municipality;
use App\Models\Clients\General\Bank;
use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\AccountBank;
use App\Models\Clients\Payments\AccountBankEntity;
use App\Models\Clients\Payments\AccountBankType;
use App\Models\Clients\Payments\CreditCard;
use App\Models\Clients\Payments\CreditCardEntity;
use App\Models\Clients\Payments\CreditCardType;
use App\Models\Clients\Profile\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }

    
    public function index(Request $request)
    {
        try {

            $cli        =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);
            $estados    =   Estate::where('name', 'like', '%lara%')->orWhere('name', 'like', '%yara%')->orderBy('id', 'ASC')->get();

            return view('page/clients/profile/index',[
                'data'      =>  $cli,
                'bank'      =>  Bank::get(),
                'tdc'       =>  CreditCard::orderBy('status_id', 'ASC')->orderBy('id', 'DESC')->get(),
                'ab'        =>  AccountBank::orderBy('status_id', 'ASC')->orderBy('id', 'DESC')->get(),
                'status'    =>  Status::get(),
                'cc_entity' =>  CreditCardEntity::get(),
                'cc_type'   =>  CreditCardType::get(),
                'ab_entity' =>  AccountBankEntity::get(),
                'ab_type'   =>  AccountBankType::get(),
                'estate'    =>  $estados,
                'town'      =>  City::where('estate_id', '=', $estados[0]->id)->orWhere('estate_id', '=', $estados[1]->id)->orderBy('id', 'ASC')->get(),
                'township'  =>  Municipality::where('estate_id', '=', $estados[0]->id)->orWhere('estate_id', '=', $estados[1]->id)->orderBy('id', 'ASC')->get()            
            ]);

        } catch (\Exception $e) {
            return redirect('/404');
        }        
    
    }

    public function Update(Request $request)
    {
        try {
            $update     =   Client::findOrFail($request->iId);

            $validator      =   Validator::make($request->all(), [
                'iName'     => 'required|string|min:5',
                'iAddress'  => 'required',
                'iPhone'    => 'required',
                'iEmail'    => 'required',
            ]);

            if ($validator->fails()) 
            {   
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect or incomplete parameters (Name, Address, Phone OR Email).',
                ], Response::HTTP_UNAUTHORIZED);
            }


            Client::UpdClient($request->all());

            return response()->json([
                'success'   =>  true,
                'url'       =>  url('/profile')
            ],  Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Incorrect or incomplete parameters.',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function RegisterTDC(Request $request)
    {
        $validator      =   Validator::make($request->all(), [
            'cTitle'    => 'required|string|min:5',
            'cNumber'   => 'required|min:13',
            'cCvv'      => 'required',
            'cMonth'    => 'required',
            'cYear'     => 'required',
            'cEntity'   => 'required',
            'cType'     => 'required',
        ]);

        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Incorrect or incomplete parameters.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $card   =   CreditCard::Register($request->all());

            return response()->json([
                'success'   =>  true,
                'url'       =>  url('/profile')
            ],  Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Incorrect or incomplete parameters.',
            ], Response::HTTP_UNAUTHORIZED);
        }      
    
    }

    public function SearchTDC(Request $request)
    {
        try {
            $card   =   CreditCard::Search($request->id);

            if($card == false)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Credit Card not Found',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'success'   => true,
                'card'      => $card,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Credit Card not Found',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function UpdateTDC(Request $request)
    {
        try 
        {
            $card   =   CreditCard::findOrFail($request->mId);

            $validator      =   Validator::make($request->all(), [
                'mTitle'    => 'required|string|min:5',
                'mNumber'   => 'required|min:13',
                'mCvv'      => 'required',
                'mMonth'    => 'required',
                'mYear'     => 'required',
                'mEntity'   => 'required',
                'mType'     => 'required',
                'mStatus'   => 'required',
            ]);
                
            if ($validator->fails()) 
            {   
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect or incomplete parameters.',
                ], Response::HTTP_UNAUTHORIZED);
            }


            $upd    =   CreditCard::UpdateTDC($request);

            if($upd == false)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Credit Card not Found adfasdf',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'success'   => true,
                'url'       =>  url('/profile')
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            dd($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Credit Card not Found',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function RegisterAB(Request $request)
    {
        $validator      =   Validator::make($request->all(), [
            'aTitle'    => 'required|min:5',
            'aNumber'   => 'required|min:5',
            'aEntity'   => 'required',
            'aType'     => 'required',
            'aBank'     => 'required',
        ]);

        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Incorrect or incomplete parameters.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {
            
            $card   =   AccountBank::Register($request->all());

            return response()->json([
                'success'   =>  true,
                'url'       =>  url('/profile')
            ],  Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Incorrect or incomplete parameters.',
            ], Response::HTTP_UNAUTHORIZED);
        } 

    }

    public function SearchAB(Request $request)
    {
        try {
            $card   =   AccountBank::Search($request->id);

            if($card == false)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Account Bank not Found',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'success'   => true,
                'card'      => $card,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Account Bank not Found',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function UpdateAB(Request $request)
    {
        try {
            $card   =   AccountBank::findOrFail($request->abId);

            $validator      =   Validator::make($request->all(), [
                'abTitle'   => 'required|min:5',
                'abNumber'  => 'required|min:5',
                'abEntity'  => 'required',
                'abType'    => 'required',
                'abBank'    => 'required',
                'abStatus'  => 'required',
            ]);
    
            if ($validator->fails()) 
            {   
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect or incomplete parameters.',
                ], Response::HTTP_UNAUTHORIZED);
            }

            $upd    =   AccountBank::UpdateAB($request);

            if($upd == false)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Account Bank not Found adfasdf',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'success'   => true,
                'url'       =>  url('/profile')
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Account Bank not Found',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
