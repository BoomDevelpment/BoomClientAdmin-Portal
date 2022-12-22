<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admins\Promotions\PromotionsTechnology;
use App\Models\Admins\Promotions\PromotionsType;
use App\Models\Clients\Country\City;
use App\Models\Clients\Country\Estate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Dashboard(Request $request)
    {
        $estates    =   Estate::where('id', 12)->orWhere('id', 22)->get();
        
        return view('page/admins/test/index',[
            'estates'       =>  $estates,
            'type'          =>  PromotionsType::get(),
            'technology'    =>  PromotionsTechnology::get(),
        ]);
    }
}
