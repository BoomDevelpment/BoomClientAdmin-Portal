<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\Donative\DonativeVideo;
use App\Models\Clients\Profile\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }

    public function Dashboard(Request $request)
    {
        try {
            $cli    =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);   
        } catch (\Exception $e) {
            return redirect('/404');
        }

        $user       =   User::find(auth()->user()->id);
        $cli        =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);
        $myWallet   =   $user->getWallet(auth()->user()->identified);
        
        return view('page/clients/dashboard/index',[
            'wallet'    =>  $myWallet->balanceFloat,
            'cli'       =>  $cli,
            'video'     =>  DonativeVideo::GetVideo()
        ]);
    }
}
