<?php

namespace Database\Seeders;

use App\Models\Clients\Country\Estate;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[1]  = ['status' => $status, 'name' => ucfirst('Amazonas')];
        $data[2]  = ['status' => $status, 'name' => ucfirst('Anzoategui')];
        $data[3]  = ['status' => $status, 'name' => ucfirst('Apure')];
        $data[4]  = ['status' => $status, 'name' => ucfirst('Aragua')];
        $data[5]  = ['status' => $status, 'name' => ucfirst('Barinas')];
        $data[6]  = ['status' => $status, 'name' => ucfirst('Bolivar')];
        $data[7]  = ['status' => $status, 'name' => ucfirst('Carabobo')];
        $data[8]  = ['status' => $status, 'name' => ucfirst('Cojedes')];
        $data[9]  = ['status' => $status, 'name' => ucfirst('Delta Amacuro')];
        $data[10] = ['status' => $status, 'name' => ucfirst('Falcon')];
        $data[11] = ['status' => $status, 'name' => ucfirst('Guarico')];
        $data[12] = ['status' => $status, 'name' => ucfirst('Lara')];
        $data[13] = ['status' => $status, 'name' => ucfirst('Merida')];
        $data[14] = ['status' => $status, 'name' => ucfirst('Miranda')];
        $data[15] = ['status' => $status, 'name' => ucfirst('Monagas')];
        $data[16] = ['status' => $status, 'name' => ucfirst('Nueva Esparta')];
        $data[17] = ['status' => $status, 'name' => ucfirst('Portuguesa')];
        $data[18] = ['status' => $status, 'name' => ucfirst('Sucre')];
        $data[19] = ['status' => $status, 'name' => ucfirst('Tachira')];
        $data[20] = ['status' => $status, 'name' => ucfirst('Trujillo')];
        $data[21] = ['status' => $status, 'name' => ucfirst('Vargas')];
        $data[22] = ['status' => $status, 'name' => ucfirst('Yaracuy')];
        $data[23] = ['status' => $status, 'name' => ucfirst('Zulia')];
        $data[24] = ['status' => $status, 'name' => ucfirst('Distrito Capital')];
        $data[25] = ['status' => $status, 'name' => ucfirst('Dependencias Federales')];

        foreach ($data as $d => $da) 
        {
            $new    =   New Estate();
            $new->name          =   $da['name'];
            $new->status_id     =   $da['status'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
