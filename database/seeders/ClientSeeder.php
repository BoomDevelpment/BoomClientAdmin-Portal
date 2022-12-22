<?php

namespace Database\Seeders;

use App\Models\Admins\Clients\ClientsActivation;
use App\Models\Admins\Clients\ClientsRecurrence;
use App\Models\Admins\Clients\RecurrenceStatus;
use App\Models\Admins\Promotions\Promotions;
use App\Models\Admins\Promotions\PromotionsActivation;
use App\Models\Admins\Promotions\PromotionsRecurrence;
use App\Models\Clients\Country\City;
use App\Models\Clients\Country\Estate;
use App\Models\Clients\Country\Municipality;
use App\Models\Clients\General\Gender;
use App\Models\Clients\General\Profile;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status         =   Status::where('name', 'like', '%act%')->first()->id;
        $gender         =   Gender::where('name', 'like', '%masc%')->first()->id;
        $estate         =   Estate::where('name', 'like', '%lara%')->first()->id;
        $city           =   City::where('name', 'like', '%barq%')->first()->id;
        $municipality   =   Municipality::where('name', 'like', '%iriba%')->first()->id;
        $promotion      =   Promotions::first()->id;

        $data[0]    =   [
            'mikrowisp'         =>  16,
            'name'              =>  ucfirst('Development - Cliente de pruebas'),
            'birthday'          =>  "1985-11-19",
            'address'           =>  ucfirst('avenida libertador, centro metropolitano javier'),
            'estate'            =>  $estate,
            'city'              =>  $city,
            'municipality'      =>  $municipality,
            'promotion'         =>  $promotion,
            'latitude'          =>  ucfirst('00.000000'),
            'longitude'         =>  ucfirst('-00.000000'),
            'phone_principal'   =>  ucfirst('584245387921'),
            'phone_alternative' =>  ucfirst('584145659075'),
            'email_principal'   =>  strtolower('luis.924@boomsolutions.com'),
            'email_alternative' =>  strtoupper('jesus.901@boomsolutions.com'),
            'batch'             =>  1,
            'facebook'          =>  ucfirst('boomsolutionsve'),
            'instagram'         =>  ucfirst('boomsolutionsve'),
            'twitter'           =>  ucfirst('boomsolutionsve'),
            'youtube'           =>  ucfirst('boomsolutionsve'),
            'advertising'       =>  ucfirst('si'),
            'gender'            =>  $gender,
            'status'            =>  $status,
        ];

        foreach ($data as $d => $da) 
        {
            $new    =   New Client();
            $new->mikrowisp         =   $da['mikrowisp'];
            $new->name              =   $da['name'];
            $new->birthday          =   $da['birthday'];
            $new->address           =   $da['address'];
            $new->estate_id         =   $da['estate'];
            $new->city_id           =   $da['city'];
            $new->municipality_id   =   $da['municipality'];
            $new->promotion_id      =   $da['promotion'];
            $new->latitude          =   $da['latitude'];
            $new->longitude         =   $da['longitude'];
            $new->phone_principal   =   $da['phone_principal'];
            $new->phone_alternative =   $da['phone_alternative'];
            $new->email_principal   =   $da['email_principal'];
            $new->email_alternative =   $da['email_alternative'];
            $new->batch             =   $da['batch'];
            $new->facebook          =   $da['facebook'];
            $new->instagram         =   $da['instagram'];
            $new->twitter           =   $da['twitter'];
            $new->youtube           =   $da['youtube'];
            $new->advertising       =   $da['advertising'];
            $new->gender_id         =   $da['gender'];
            $new->status_id         =   $da['status'];

            try {
                $new->save();

                $pClient    =   Profile::where('name', 'like', '%%cli%')->first()->id;
                $status     =   Status::where('name', 'like', '%act%')->first()->id;

                $us             =   New User();
                $us->name       =   $da['name'];
                $us->username   =   '123456789';
                $us->email      =   $da['email_principal'];
                $us->password   =   bcrypt('123456789');
                $us->identified =   random_int(10000000, 99999999);
                $us->profile_id =   $pClient;
                $us->status_id  =   $status;
                $us->save();

                $cli        =   Client::find($new->id);

                $iMonth[0]  =   PromotionsRecurrence::select('month')->where('promotion_id', $cli->promotion_id)->orderBy('id', 'DESC')->limit(1)->first()->month;
                $iMonth[1]  =   PromotionsActivation::select('month')->where('promotion_id', $cli->promotion_id)->orderBy('id', 'DESC')->limit(1)->first()->month;

                $status     =   RecurrenceStatus::where('name', 'LIKE', '%pend%')->first()->id;

                foreach ($iMonth as $m => $mon) 
                {
                    $w  =   ($m == 0) ? 1 : 0;

                    for ($i=$w; $i <= $mon ; $i++) 
                    {

                        if($m == 0)
                        {
                            $info           =   PromotionsRecurrence::where([['promotion_id', $cli->promotion_id],['month', $i]])->first();
                            $new            =   new ClientsRecurrence();
                        }else{
                            $info           =   PromotionsActivation::where([['promotion_id', $cli->promotion_id],['month', $i]])->first();
                            $new            =   new ClientsActivation();
                        }
                        $new->client_id =   $cli->id;
            
                        if($info)
                        {
                            $new->month =   $info->month;
                            $new->cost  =   $info->cost;
                            $new->mult  =   $info->mult;
                            $new->iva   =   $info->iva;
                            $new->total =   $info->total;
                        }else{
                            $info       =   $cli->promotion->recurrence[0];
                            $new->month =   $i;
                            $new->cost  =   $info->cost;
                            $new->mult  =   100;
                            $new->iva   =   16;
                            $new->total =   round(($info->cost*(100/100)+($info->cost*(100/100)*(16/100))), 2);
                        }
                        $new->month_date    =   Carbon::now()->addMonth($i)->startOfMonth()->toDateString();
                        $new->invoice_date  =   "";
                        $new->status_id     =   $status;
                        $new->save();
                    }
                }

            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }

    }
}
