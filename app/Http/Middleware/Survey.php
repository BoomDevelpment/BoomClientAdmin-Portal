<?php

namespace App\Http\Middleware;

use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
use App\Models\Clients\Survery\Survey as ModelSurvey;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class Survey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $s      =   ModelSurvey::where('client_id', '=', auth()->user()->client->client_id)->orderBy('id', 'DESC')->limit(1)->first();
        $date   =   Carbon::now();

        if($s == null)
        {
            return redirect('/encuesta');
        }

        $d1     =   new \DateTime($s->created_at);
        $d2     =   new \DateTime($date);
        $trans  =   $d1->diff($d2);

        if($trans->m > 0)
        {
            return redirect('/encuesta');

        }else{
            return $next($request);
        }

    }
}