<?php

namespace App\Http\Controllers;

use App\Models\Clients\Profile\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $user       =   Client::findOrFail(auth()->user()->client_id);
            return redirect('/dashboard');

        } catch (\Exception $e) {
            dd("Controller Admin");
            return redirect('/404');
        }
        
        return view('home');
    }
}
