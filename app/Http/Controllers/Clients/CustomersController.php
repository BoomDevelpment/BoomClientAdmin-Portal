<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\CustomerServices\CustomerImagen;
use App\Models\Clients\CustomerServices\CustomerRequest;
use App\Models\Clients\CustomerServices\CustomerServices;
use App\Models\Clients\CustomerServices\CustomerStatus;
use App\Models\Clients\CustomerServices\CustomerType;
use App\Models\Clients\Donative\DonativeImage;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    private $_type;
    private $_html;

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
       
        $iPhotos    =   CustomerImagen::where('status_id', '=', Status::where('name', 'like', '%act%')->first()->id)->orderBy('id', 'ASC')->get();

        // dd($iPhotos);
        
        return view('page/clients/customers/index',[
            'pho'       =>  $iPhotos,
            'request'   =>  CustomerRequest::get(),
            'client'    =>  $cli
        ]);
    }

    public function Register(Request $request)
    {
        try {

            $cli    =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'No se encuentra el cliente, intente nuevamente',
            ], Response::HTTP_UNAUTHORIZED);

        }

        $status     =   CustomerStatus::where('name', 'LIKE', "%pend%")->first();

        $option     =   ( isset($request->M) ) ? $request->M : $request->R;

        if( isset($option) == true)
        {
            switch ($option) {
                case 2:
                    $validator      =   Validator::make($request->all(), [
                        'M' => 'required',
                        'L' => 'required',
                        'T' => 'required|min:5',
                    ]);
                    $iData  =   [ 
                        'client' => auth()->user()->client->client_id, 
                        'request'   =>  $request->M, 
                        'type'      =>  $request->L, 
                        'message'   =>  trim(ucfirst($request->T)), 
                        'status'    =>  $status->id ];
                break;
                case 3:
                    $validator  =   Validator::make($request->all(), ['M'     => 'required']);
                    $req        =   CustomerType::where('request_id', '=', $request->M)->first();
                    $iData  =   [ 
                        'client'    =>  auth()->user()->client->client_id,
                        'request'   =>  $request->M, 
                        'type'      =>  $req->id,
                        'message'   =>  trim(ucfirst($request->T)) ,
                        'status'    =>  $status->id
                    ];
                break;
                case 4:
                    $validator  =   Validator::make($request->all(), ['M'     => 'required']);
                    $req        =   CustomerType::where('request_id', '=', $request->M)->first();
                    $iData  =   [ 
                        'client'    =>  auth()->user()->client->client_id,
                        'request'   =>  $request->M, 
                        'type'      =>  $req->id,
                        'message'   =>  trim(ucfirst($request->T)) ,
                        'status'    =>  $status->id
                    ];
                break;
                case 5:
                    $validator  =   Validator::make($request->all(), ['M' =>  'required', 'T' =>  'required']);
                    $req        =   CustomerType::where('request_id', '=', $request->M)->first();
                    $iData  =   [ 
                        'client'    =>  auth()->user()->client->client_id,
                        'request'   =>  $request->M, 
                        'type'      =>  $req->id,
                        'message'   =>  trim($request->T),
                        'status'    =>  $status->id
                    ];
                break;
                case 6:
                    $validator  =   Validator::make($request->all(), ['M' =>  'required','T' =>  'required']);
                    $req        =   CustomerType::where('request_id', '=', $request->M)->first();
                    $iData  =   [ 
                        'client'    =>  auth()->user()->client->client_id,
                        'request'   =>  $request->M, 
                        'type'      =>  $req->id, 
                        'message'   =>  trim($request->T),
                        'status'    =>  $status->id
                    ];
                break;
                case 7:
                    $validator  =   Validator::make($request->all(), ['M'     => 'required']);
                    $iData      =   false;
                break;
                case 8:
                    $validator  =   Validator::make($request->all(), ['M'     => 'required']);
                    $iData      =   false;
                break;
                case 9:
                    $validator      =   Validator::make($request->all(), [
                        'M' => 'required',
                        'L' => 'required',
                        'T' => 'required|min:5',
                    ]);
                    $req        =   CustomerType::where('request_id', '=', $request->M)->first();
                    $iData  =   [ 
                        'client'    =>  auth()->user()->client->client_id,
                        'request'   =>  $request->M, 
                        'type'      =>  $request->L,
                        'message'   =>  trim(ucfirst($request->T)) ,
                        'status'    =>  $status->id
                    ];
                break;
                case 10:
                    $validator      =   Validator::make($request->all(), ['R' => 'required']);
                    $iData      =   false;
                break;
                case 11:
                    $validator  =   Validator::make($request->all(), ['R' =>  'required',   'T' =>  'required']);
                    $req        =   CustomerType::where('request_id', '=', $request->R)->first();
                    $iData  =   [ 
                        'client'    =>  auth()->user()->client->client_id,
                        'request'   =>  $request->R, 
                        'type'      =>  $req->id, 
                        'message'   =>  trim($request->T),
                        'status'    =>  $status->id
                    ];
                break;
                default:
                    $validator  =   Validator::make($request->all(), ['M'     => 'required']);
                break;
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Error Enviado Informaci&oacute;n',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Parametros Incompletos',
            ], Response::HTTP_UNAUTHORIZED);
        }
        if($iData <> false)
        {
            $ticket     =   "CS-".random_int(1000000, 9999999);

            try {
                $new    =   new CustomerServices();
                $new->ticket        =   $ticket;
                $new->client_id     =   $iData['client'];
                $new->request_id    =   $iData['request'];
                $new->type_id       =   $iData['type'];
                $new->message       =   $iData['message'];
                $new->status_id     =   $iData['status'];
                $new->operator_id   =   Operator::find(1)->id;

                $new->save();

                return response()->json([
                    'success'   =>  true,
                    'message'   =>  'Solicitud enviada correctamente',
                    'url'       =>  url('/customers'),
                ], Response::HTTP_OK);

            } catch (\Exception $e) {
                return response()->json([
                    'success' =>    false,
                    'message' =>    'Existe un problema al generar la solicitud, intente nuevamente.',
                ], Response::HTTP_UNAUTHORIZED);
            }
        }else{
            return response()->json([
                'success'   =>  false,
                'message'   =>  '',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function Info(Request $request)
    {
        try {
            $req    =   CustomerRequest::findOrFail($request->id);
            return response()->json([
                'success'   =>  true,
                'html'      =>  $this->HtmlType($req),
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Not Found',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    private function HtmlType($data)
    {
        switch ($data->field->id) 
        {
            case '1':   return $this->HtmlAction($data);break;
            case '2':   return $this->HtmlInformation($data);break;
            case '3':   return $this->HtmlInformationRead($data);break;
            case '4':   return $this->HtmlInformationInfoRead($data);break;
            case '5':   return $this->HtmlMessage($data);break;
            case '6':   return $this->HtmlList($data);break;
            case '7':   return $this->HtmlListMessage($data);break;
            
            default:    return $this->HtmlAction($data);break;
        }
    }

    private function HtmlAction($data)
    {
        return "Html Action";
    }

    private function HtmlInformation($data)
    {
        $html = '';
        $html.='<div class="col-md-12 m-t-10">';
        $html.='<div class="media">';
        $html.='<a class="media-left" href="#"><img class="media-object img-radius m-r-20" src="'.$data->types[0]->image.'"></a>';
        $html.='<div class="media-body b-b-theme social-client-description" style="text-align: justify;">';
        $html.='<div class="chat-header">Informaci&oacute;n</div>';
        foreach ($data->types as $t => $ty) { $html.='<p class="text-muted">'.$ty->name.'</p>'; }
        $html.='</div>';
        $html.='</div>';
        $html.='</div>';
            
        return $html;
    }

    private function HtmlInformationRead($data)
    {
        $html   =   '';
        $html.='<div class="col-md-12 m-t-10">';

        $html.='<div class="media">';
        $html.='<a class="media-left" href="#">';
        $html.='<img class="media-object img-radius m-r-20" src="'.$data->types[0]->image.'">';
        $html.='</a>';
        $html.='<div class="media-body b-b-theme social-client-description" style="text-align: justify;">';
        foreach ($data->types as $d => $da) {$html.='<p class="text-muted">'.$da->name.'</p>';   }
        $html.='</div>';
        $html.='</div>';

        $html.='</div>';

        return $html;
    }

    private function HtmlInformationInfoRead($data)
    {
        $html   =   '';
        $img    =   '';
        $cont   =   0;

        $html.='<div class="col-md-12 m-t-10">';
        foreach ($data->types as $d => $da) 
        {
            if( (isset($data->types[$d+1])) )
            {
                if($img <> $da->image) 
                {
                    $html.='<div class="media">';
                    $html.='<a class="media-left"><img class="media-object img-radius m-r-20" src="'.$da->image.'"></a>';
                    $html.='<div class="media-body b-b-theme social-client-description" style="text-align: justify;">';
                }
            }
            
            $img    =   ( isset($data->types[$d+1]->image) ) ? $data->types[$d+1]->image : '';
            $html.='<p class="text-muted">'.$da->name.'</p>';            
            if($img <> $da->image)
            { 
                $html.='</div>';
                $html.='</div>';

                if(!isset($data->types[$d+1]->image))
                {
                    goto s1;
                }

                $html.='<div class="media">';
                $html.='<a class="media-left"><img class="media-object img-radius m-r-20" src="'.$img.'"></a>';
                $html.='<div class="media-body b-b-theme social-client-description" style="text-align: justify;">';
            }           
        }        
        s1:
        $html.='</div>';

        return $html;
    }


    private function HtmlMessage($data)
    {
        $html   =   '';
        $html.='<div class="col-md-12">';
        $html.='<label for="">Indique una descripcion:</label>';
        foreach ($data->types as $d => $da) { $html.='<textarea id="T" name="T" rows="5" cols="5" class="form-control" placeholder="'.$da->name.'"></textarea>'; }
        $html.='</div>';

        return $html;
    }

    private function HtmlList($data)
    {
        return "Html List";
    }

    private function HtmlListMessage($data)
    {
        $html = '';
        $html.='<div class="col-md-12">';
        $html.='<label for="">Seleccione una Opci&oacute;n:</label>';
        $html.='<select id="L" name="L" class="form-control stock">';
        $html.='<option value="" selected>Listado de Opciones</option>';
        foreach ($data->types as $d => $da) { $html.='<option value="'.$da['id'].'">'.$da['name'].'</option>';}
        $html.='</select>';
        $html.='</div><br>';
        $html.='<div class="col-md-12">';
        $html.='<label for="">Indique una descripci&oacute;n:</label>';
        $html.='<textarea id="T" name="T" rows="5" cols="5" placeholder="Escriba su informaci&oacute;n aqu&iacute;" class="form-control"/></textarea>';
        $html.='</div>';

        return $html;
    }
    
}
