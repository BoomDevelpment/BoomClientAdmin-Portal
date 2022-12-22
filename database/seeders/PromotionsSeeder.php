<?php

namespace Database\Seeders;

use App\Models\Admins\Promotions\Promotions;
use App\Models\Admins\Promotions\PromotionsActivation;
use App\Models\Admins\Promotions\PromotionsRecurrence;
use App\Models\Admins\Promotions\PromotionsTechnology;
use App\Models\Admins\Promotions\PromotionsType;
use App\Models\Clients\Country\City;
use App\Models\Clients\Country\Estate;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status =   Status::where('name', 'like', '%act%')->first()->id;
        $data   =   [
            'title'         =>  ucfirst('Promocion I - Trimestre III - 2022'),
            'subtitle'      =>  ucfirst('Internet Residencial GPON 50 MB'),
            'cost'          =>  19.99,
            'ivaCost'       =>  16.00,
            'inst'          =>  199.99,
            'ivaInst'       =>  16.00,
            'estate'        =>  Estate::where('name', 'LIKE', '%lara%')->first()->id,
            'city'          =>  City::where('name', 'LIKE', '%barq%')->first()->id,
            'type'          =>  PromotionsType::where('name', 'LIKE', '%resi%')->first()->id,
            'technology'    =>  PromotionsTechnology::where('name', 'LIKE', '%Opti%')->first()->id,
            'iniDate'       =>  Carbon::now()->format('Y-m-d'),
            'endDate'       =>  Carbon::now()->addMonth(3)->format('Y-m-d'),
            'status'        =>  $status
        ];

        $recurrence[0]  =   [   'month' =>  1,  'cost'  =>  $data['cost'],  'mult'  =>  0,      'iva'   =>  16.00,  'total' =>  round(($data['cost']*(0/100)+($data['cost']*(0/100)*(16/100))), 2)      ];
        $recurrence[1]  =   [   'month' =>  2,  'cost'  =>  $data['cost'],  'mult'  =>  100,    'iva'   =>  16.00,  'total' =>  round(($data['cost']*(100/100)+($data['cost']*(100/100)*(16/100))), 2)  ];
        $recurrence[2]  =   [   'month' =>  4,  'cost'  =>  $data['cost'],  'mult'  =>  50,     'iva'   =>  16.00,  'total' =>  round(($data['cost']*(50/100)+($data['cost']*(50/100)*(16/100))), 2)    ];
        $recurrence[3]  =   [   'month' =>  6,  'cost'  =>  $data['cost'],  'mult'  =>  50,     'iva'   =>  16.00,  'total' =>  round(($data['cost']*(50/100)+($data['cost']*(50/100)*(16/100))), 2)    ];    

        $instalation[0] =   [   'month' =>  0,  'cost'  =>  $data['inst'],  'mult'  =>  50,     'iva'   =>  16.00,  'total' =>  round(($data['inst']*(50/100)+($data['inst']*(50/100)*(16/100))), 2)];
        $instalation[1] =   [   'month' =>  1,  'cost'  =>  $data['inst'],  'mult'  =>  25,     'iva'   =>  16.00,  'total' =>  round(($data['inst']*(25/100)+($data['inst']*(25/100)*(16/100))), 2)];
        $instalation[2] =   [   'month' =>  2,  'cost'  =>  $data['inst'],  'mult'  =>  25,     'iva'   =>  16.00,  'total' =>  round(($data['inst']*(25/100)+($data['inst']*(25/100)*(16/100))), 2)];

        try {
            $new                =    new    Promotions();
            $new->title         =   $data['title'];
            $new->subtitle      =   $data['subtitle'];
            $new->cost          =   $data['cost'];
            $new->iva_cost      =   $data['ivaCost'];
            $new->inst          =   $data['inst'];
            $new->iva_inst      =   $data['ivaInst'];
            $new->estate_id     =   $data['estate'];
            $new->city_id       =   $data['city'];
            $new->technology_id =   $data['technology'];
            $new->type_id       =   $data['type'];
            $new->date_ini      =   $data['iniDate'];
            $new->date_end      =   $data['endDate'];
            $new->status_id     =   $data['status'];
            $new->save();

            foreach ($recurrence as $r => $re) 
            {
                $rec    =   new PromotionsRecurrence();
                $rec->promotion_id  =   $new->id;
                $rec->month         =   $re['month'];
                $rec->cost          =   $re['cost'];
                $rec->mult          =   $re['mult'];
                $rec->iva           =   $re['iva'];
                $rec->total         =   $re['total'];
                $rec->save();
            }

            foreach ($instalation as $i => $in) 
            {
                $int    =   new PromotionsActivation();
                $int->promotion_id  =   $new->id;
                $int->month         =   $in['month'];
                $int->cost          =   $in['cost'];
                $int->mult          =   $in['mult'];
                $int->iva           =   $in['iva'];
                $int->total         =   $in['total'];
                $int->save();
            }

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
