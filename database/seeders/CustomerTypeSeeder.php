<?php

namespace Database\Seeders;

use App\Models\Clients\CustomerServices\CustomerFiel;
use App\Models\Clients\CustomerServices\CustomerRequest;
use App\Models\Clients\CustomerServices\CustomerType;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $request    =   CustomerRequest::where('name', 'like', '%Seg%')->first()->id;
        
        $data[0]   =   [
            'name'      =>  ucfirst('Estimado cliente, en breves instantes ser&aacute; dirigido a nuestro portal para el registro de las nuevas cuentas, gracias por preferirnos.'),
            'url'       =>  '/customer/account/',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $request    =   CustomerRequest::where('name', 'like', '%Mud%')->first()->id;

        $data[1]   =   [
            'name'      =>  ucfirst('Casa'),
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[2]   =   [
            'name'      =>  ucfirst('Apartamento'),
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[3]   =   [
            'name'      =>  ucfirst('Comercio'),                           
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[4]   =   [
            'name'      =>  ucfirst('Otro'),
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $request    =   CustomerRequest::where('name', 'like', '%aum%')->first()->id;

        $data[5]    =   [
            'name'      =>  ucfirst('Estimado cliente, su solicitud ser&aacute; procesada a la brevedad posible, uno de nuestros ejecutivos se estar&aacute; comunic&aacute;ndose con UD, recuerde que debe enviar la solicitud mediante el bot&oacute;n procesar.'),   
            'url'       =>  '',
            'image'     =>  'src/images/customer/up.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $request    =   CustomerRequest::where('name', 'like', '%desc%')->first()->id;

        $data[6]   =   [
            'name'      =>  ucfirst('Estimado cliente, su solicitud ser&aacute; procesada a la brevedad posible, uno de nuestros ejecutivos se estar&aacute; comunic&aacute;ndose con UD, recuerde que debe enviar la solicitud mediante el bot&oacute;n procesar.'),   
            'url'       =>  '',
            'image'     =>  'src/images/customer/down.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $request    =   CustomerRequest::where('name', 'like', '%cla%')->first()->id;

        $data[7]    =   [
            'name'      =>  ucfirst('Ingrese el nuevo password para su red wifi'),        
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $request    =   CustomerRequest::where('name', 'like', '%nomb%')->first()->id;

        $data[8]   =   [
            'name'      =>  ucfirst('Ingrese el nuevo nombre para su red wifi'),
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $request    =   CustomerRequest::where('name', 'like', '%med%')->first()->id;

        $data[9]   =   [
            'name'      =>  ucfirst('Paso 1: Desconectar el cable del puerto WAN del Router.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/speedtest.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[10]   =   [
            'name'      =>  ucfirst('Paso 2: Conectar el cable al puerto de red de la Laptop o PC.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/speedtest.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[11]   =   [
            'name'      =>  ucfirst('Paso 3: Ingresar al navegador web de tu preferencia y buscar la siguiente p&aacute;gina web: https://www.speedtest.net/es'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/speedtest.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[12]   =   [
            'name'      =>  ucfirst('Paso 4: Verificar que el servidor al que se est&aacute; conectando sea Barquisimeto - Boom Solutions.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/speedtest.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[13]   =   [
            'name'      =>  ucfirst('Paso 5: Seleccionar la opci&oacute;n de Inicio o Go para visualizar tu velocidad.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/speedtest.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $request    =   CustomerRequest::where('name', 'like', '%ups%')->first()->id;

        $data[14]   =   [
            'name'      =>  ucfirst('Paso 1: Debe traer el equipo en su caja respectiva a nuestra sede de atenci&aacute;n al cliente ubicado en el C. C. Chur&uacute; Mer&uacute; (Primer Piso), en horario de 8:00 am hasta las 3:00 pm.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/ups.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $data[15]   =   [
            'name'      =>  ucfirst('Paso 2: El equipo debe ser entregado por el Titular de la Cuenta con su Cédula de Identidad Laminada, en el caso de tercera persona, debe presentar una autorizaci&oacute;n del titular.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/ups.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[16]   =   [
            'name'      =>  ucfirst('Paso 3: El equipo entrara en un banco de pruebas por 48 Horas, el cual determinara si es necesario el reemplazo del mismo.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/ups.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[17]   =   [
            'name'      =>  ucfirst('Paso 4: Recibir&aacute; una llamada para que pueda venir a retirar el equipo.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/ups.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[18]   =   [
            'name'      =>  ucfirst('Informaci&oacute;n: Es importante recordarle que, si existe un daño ocasionado por terceros, se debe realizar un pago de $120 por reposici&oacute;n de equipo.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/ups.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $request    =   CustomerRequest::where('name', 'like', '%fall%')->first()->id;

        $data[18]    =   [
            'name'      =>  ucfirst('Ausencia'),                           
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[19]   =   [
            'name'      =>  ucfirst('Lentitud'),                           
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[20]   =   [
            'name'      =>  ucfirst('Intermitencia'),                      
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[21]   =   [
            'name'      =>  ucfirst('Otro'),
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $request    =   CustomerRequest::where('name', 'like', '%meto%')->first()->id;

        $data[22]   =   [
            'name'      =>  ucfirst('Transferencia por Zelle'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/zelle-1.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $data[23]   =   [
            'name'      =>  ucfirst('Correo: pagos.net@boomsolutions.com'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/zelle-1.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[24]   =   [
            'name'      =>  ucfirst('Titular: Boom Solutions'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/zelle-1.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $data[25]   =   [
            'name'      =>  ucfirst('Transferencia por Paypal'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/paypal-1.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $data[26]   =   [
            'name'      =>  ucfirst('Correo: pagos.net@boomsolutions.com'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/paypal-1.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[27]   =   [
            'name'      =>  ucfirst('Titular: Boom Solutions'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/paypal-1.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[28]   =   [
            'name'      =>  ucfirst('Pago por Oficina:'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/dollar.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];
        
        $data[29]   =   [
            'name'      =>  ucfirst('Barquisimeto: C.C. Chur&uacute; Mer&uacute;, Planta Alta, Local B-08.'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/dollar.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[30]   =   [
            'name'      =>  ucfirst('San Felipe: 4ta Avenida entre calles 12 y 13, Edificio Capri, Oficina 1-8'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/dollar.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $data[31]   =   [
            'name'      =>  ucfirst('Horario: Lunes a S&aacute;bados de 8:00 am a 4:00 pm'),
            'url'       =>  '',
            'image'     =>  'src/images/customer/dollar.png',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        $request    =   CustomerRequest::where('name', 'like', '%recla%')->first()->id;

        $data[32]   =   [
            'name'      =>  ucfirst('Por favor ind&iacute;quenos su solicitud'),
            'url'       =>  '',
            'image'     =>  '',
            'status'    =>  $status, 
            'request'   =>  $request,
        ];

        foreach ($data as $d => $da) 
        {
            $new    =   New CustomerType();
            $new->name          =   $da['name'];
            $new->url           =   $da['url'];
            $new->image         =   $da['image'];
            $new->request_id    =   $da['request'];
            $new->status_id     =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
