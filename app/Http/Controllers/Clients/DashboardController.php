<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('survey'); 
    }
    
    public function Dashboard(Request $request)
    {
        dd("Clients Dashboard");
        // try {
        //     $cli    =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);
        // } catch (\Exception $e) {
        //     return redirect('/404');
        // }
        
        // $user       =   User::find(auth()->user()->id);
        // $cli        =   Client::GetClient(['field'=>'id', 'id' => auth()->user()->client->client_id]);
        // $myWallet   =   $user->getWallet(auth()->user()->identified);

        
        // $videos     =   DonativeVideo::where('status_id', '=', Status::where('name', 'like', '%act%')->first()->id)->first();
        // $iVid       =   ($videos != null) ? $videos : ['status_id' => 0, 'name' => '', 'src' => ''];

        // return view('pages/clients/dashboard/index',[
        //     'wallet'    =>  $myWallet->balanceFloat,
        //     'cli'       =>  $cli,
        //     'video'     =>  $iVid
        // ]);
    }
}
