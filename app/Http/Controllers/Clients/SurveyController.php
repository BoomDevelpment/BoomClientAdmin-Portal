<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Survery\Survey;
use App\Models\Clients\Survery\SurveyQuestions;
use App\Models\Clients\Survery\SurveyReferred;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use GuzzleHttp\Client as GuzzleClient;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $cli    =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);
        } catch (\Exception $e) {
            return redirect('/404');
        }
        // dd($q[0]->questions, count($q[0]->questions));

        return view('page/clients/survey/index',[
            'q' =>  SurveyQuestions::get()
        ]);
    }

    public function Search(Request $request)
    {
        
        $api    =   ['url' => env('MIKROWISP_VE_URL').'/GetClientsDetails', 'token' => env('MIKROWISP_VE_TOKEN')];
        try {
            $client     =   new GuzzleClient(['headers' => ['Content-Type' => 'application/json']]);
            $res        =   $client->request('POST', $api['url'], ['body' => json_encode(
                [
                    'token'     =>  $api['token'],
                    'cedula'    =>  '1234567891'
                ]
            )]);

            if($res->getStatusCode() == 200)
            {
                if(json_decode($res->getBody())->estado != "error")
                {
                    return response()->json([
                        'success'   =>  true,
                        'd'         =>  json_decode($res->getBody())->datos[0]['nombre'],
                    ], Response::HTTP_OK); 
                }else{
                    return response()->json([
                        'success'   =>  false,
                        'message'   =>  'Cliente no encontrado.',
                    ], Response::HTTP_UNAUTHORIZED); 
                }
            }else{
                return response()->json([
                    'success'   =>  false,
                    'message'   =>  'Error estableciendo conexion.',
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  'Error estableciendo conexion.',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function Register(Request $request)
    {
        try {

            $validator      =   Validator::make($request->all(), [
                'qRating'   => 'required',
                'qAtt'      => 'required',
                'qHand'     => 'required',
            ]);
    
            if ($validator->fails()) 
            {   
                return response()->json([
                    'success' => false,
                    'message' => 'Datos faltantes, por favor verificar las opciones seleccionables.',
                ], Response::HTTP_UNAUTHORIZED);
            }

            try {
                $client     =   Client::findOrFail(auth()->user()->client->client_id);

                $new    =   new Survey();
                $new->mikrowisp             =   $client->mikrowisp;
                $new->client_id             =   auth()->user()->client->client_id;
                $new->rating_id             =   $request->qRatingId;
                $new->rating_answer_id      =   $request->qRating;
                $new->attention_id          =   $request->qAttId;
                $new->attention_answer_id   =   $request->qAtt;
                $new->hand_id               =   $request->qHandId;
                $new->hand_answer_id        =   $request->qHand;
                $new->save();

                for ($i=1; $i <=5; $i++) 
                { 
                    $name   =   'qrName'.$i;
                    $phone  =   'qrPhone'.$i;
                    if( ($request->$name != null) && ($request->$phone != null))
                    {
                        $ref    =   new SurveyReferred();
                        $ref->name      =   ucfirst($request->$name);
                        $ref->phones    =   $request->$phone;
                        $ref->client_id =   auth()->user()->client->client_id;
                        $ref->survey_id =   $new->id;
                        $rSave          =   $ref->save();
                    }
                }

                return response()->json([
                    'success'   =>  true,
                    'message'   =>  "Datos almacenados correctamente.",
                    'url'       =>  url('/dashboard')
                ],  Response::HTTP_OK);

            } catch (\Exception $e) {
                dd($e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrio un error inesperado, por favor intente nuevamente.',
                ], Response::HTTP_UNAUTHORIZED);
            }

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Existen datos faltantes.',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
