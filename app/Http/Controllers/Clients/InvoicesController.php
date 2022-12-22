<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Profile\Client;
use App\Models\TestOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class InvoicesController extends Controller
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

        return view('page/clients/invoices/index',[
            'data'      =>  $cli,
            'wallet'    =>  $myWallet,
            'bs'        =>  $bs,
            'order'     =>  TestOrder::get(),
            'divisa'    =>  Scrapers::getLast()
        ]);
    }
}
