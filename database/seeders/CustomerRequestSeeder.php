<?php

namespace Database\Seeders;

use App\Models\Clients\CustomerServices\CustomerFiel;
use App\Models\Clients\CustomerServices\CustomerRequest;
use App\Models\Clients\CustomerServices\CustomerRequestType;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class CustomerRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        $customer   =   CustomerRequestType::where('name', 'like', '%serv%')->first()->id;
        $payment    =   CustomerRequestType::where('name', 'like', '%pay%')->first()->id;

        $data[0]   =   ['name'     =>  strtoupper('Segunda Cuenta'),                    'field' => CustomerFiel::where('name', 'like', '%act%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('Mudanza de Equipos'),                'field' => CustomerFiel::where('name', 'like', '%and%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[2]   =   ['name'     =>  strtoupper('Aumento de Velocidad'),              'field' => CustomerFiel::where('name', 'like', '%inf%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[3]   =   ['name'     =>  strtoupper('Descenso de Velocidad'),             'field' => CustomerFiel::where('name', 'like', '%inf%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[4]   =   ['name'     =>  strtoupper('Cambio de Clave de Red Wifi'),       'field' => CustomerFiel::where('name', 'like', '%mes%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[5]   =   ['name'     =>  strtoupper('Cambio de Nombre de Red Wifi'),      'field' => CustomerFiel::where('name', 'like', '%mes%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[6]   =   ['name'     =>  strtoupper('Presento inconveniente con mi UPS'), 'field' => CustomerFiel::where('name', 'like', '%rea%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[7]   =   ['name'     =>  strtoupper('Como Puedo Medir mi Velocidad'),     'field' => CustomerFiel::where('name', 'like', '%rea%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        $data[8]   =   ['name'     =>  strtoupper('Estoy Presentando Fallas'),          'field' => CustomerFiel::where('name', 'like', '%and%')->first()->id, 'type' => $customer, 'status'   =>  $status];
        
        $data[9]   =   ['name'     =>  strtoupper('Metodos de Pago'),                   'field' => CustomerFiel::where('name', 'like', '%tion info%')->first()->id, 'type' => $payment, 'status'   =>  $status];
        $data[10]  =   ['name'     =>  strtoupper('Reclamos'),                          'field' => CustomerFiel::where('name', 'like', '%mes%')->first()->id, 'type' => $payment, 'status'   =>  $status];

        foreach ($data as $d => $da) 
        {
            $new    =   New CustomerRequest();
            $new->name      =   $da['name'];
            $new->field_id  =   $da['field'];
            $new->type_id   =   $da['type'];
            $new->status_id =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
