<?php

namespace Database\Seeders;

use App\Models\Clients\General\Bank;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]    =  ["code"  =>  "0174", "rif" => "J000423032", "status" => $status, "name"  =>  "Banplus Banco Universal, C.A"];
        $data[1]    =  ["code"  =>  "0001", "rif" => "G200001100", "status" => $status, "name"  =>  "Banco Central de Venezuela"];
        $data[2]    =  ["code"  =>  "0102", "rif" => "G200099976", "status" => $status, "name"  =>  "Banco de Venezuela S.A.C.A. Banco Universal"];
        $data[3]    =  ["code"  =>  "0104", "rif" => "J000029709", "status" => $status, "name"  =>  "Venezolano de Crédito, S.A. Banco Universal"];
        $data[4]    =  ["code"  =>  "0105", "rif" => "J000029610", "status" => $status, "name"  =>  "Banco Mercantil, C.A. Banco Universal"];
        $data[5]    =  ["code"  =>  "0108", "rif" => "J000029679", "status" => $status, "name"  =>  "Banco Provincial, S.A. Banco Universal"];
        $data[6]    =  ["code"  =>  "0114", "rif" => "J000029490", "status" => $status, "name"  =>  "Bancaribe C.A. Banco Universal"];
        $data[7]    =  ["code"  =>  "0115", "rif" => "J000029504", "status" => $status, "name"  =>  "Banco Exterior C.A. Banco Universal"];
        $data[8]    =  ["code"  =>  "0116", "rif" => "J300619460", "status" => $status, "name"  =>  "Banco Occidental de Descuento, Banco Universal C.A"];
        $data[9]    =  ["code"  =>  "0128", "rif" => "J095048551", "status" => $status, "name"  =>  "Banco Caroní C.A. Banco Universal"];
        $data[10]   =  ["code"  =>  "0134", "rif" => "J070133805", "status" => $status, "name"  =>  "Banesco Banco Universal S.A.C.A."];
        $data[11]   =  ["code"  =>  "0137", "rif" => "J090283846", "status" => $status, "name"  =>  "Banco Sofitasa, Banco Universal"];
        $data[12]   =  ["code"  =>  "0138", "rif" => "J002970553", "status" => $status, "name"  =>  "Banco Plaza, Banco Universal"];
        $data[13]   =  ["code"  =>  "0146", "rif" => "J301442040", "status" => $status, "name"  =>  "Banco de la Gente Emprendedora C.A"];
        $data[14]   =  ["code"  =>  "0151", "rif" => "J000723060", "status" => $status, "name"  =>  "BFC Banco Fondo Común C.A. Banco Universal"];
        $data[15]   =  ["code"  =>  "0156", "rif" => "J085007768", "status" => $status, "name"  =>  "100% Banco, Banco Universal C.A."];
        $data[16]   =  ["code"  =>  "0157", "rif" => "J000797234", "status" => $status, "name"  =>  "DelSur Banco Universal C.A."];
        $data[17]   =  ["code"  =>  "0163", "rif" => "G200051876", "status" => $status, "name"  =>  "Banco del Tesoro, C.A. Banco Universal"];
        $data[18]   =  ["code"  =>  "0166", "rif" => "G200057955", "status" => $status, "name"  =>  "Banco Agrícola de Venezuela, C.A. Banco Universal"];
        $data[19]   =  ["code"  =>  "0168", "rif" => "J316374173", "status" => $status, "name"  =>  "Bancrecer, S.A. Banco Microfinanciero"];
        $data[20]   =  ["code"  =>  "0169", "rif" => "J315941023", "status" => $status, "name"  =>  "Mi Banco, Banco Microfinanciero C.A."];
        $data[21]   =  ["code"  =>  "0171", "rif" => "J080066227", "status" => $status, "name"  =>  "Banco Activo, Banco Universal"];
        $data[22]   =  ["code"  =>  "0172", "rif" => "J316287599", "status" => $status, "name"  =>  "Bancamica, Banco Microfinanciero C.A."];
        $data[23]   =  ["code"  =>  "0173", "rif" => "J294640109", "status" => $status, "name"  =>  "Banco Internacional de Desarrollo, C.A. Banco Universal"];
        $data[24]   =  ["code"  =>  "0175", "rif" => "G200091487", "status" => $status, "name"  =>  "Banco Bicentenario del Pueblo de la Clase Obrera, Mujer y Comunas B.U."];
        $data[25]   =  ["code"  =>  "0176", "rif" => "J308918644", "status" => $status, "name"  =>  "Novo Banco, S.A. Sucursal Venezuela Banco Universal"];
        $data[26]   =  ["code"  =>  "0177", "rif" => "G200106573", "status" => $status, "name"  =>  "Banco de la Fuerza Armada Nacional Bolivariana, B.U."];
        $data[27]   =  ["code"  =>  "0190", "rif" => "J000526621", "status" => $status, "name"  =>  "Citibank N.A."];
        $data[28]   =  ["code"  =>  "0191", "rif" => "J309841327", "status" => $status, "name"  =>  "Banco Nacional de Crédito, C.A. Banco Universal"];
        $data[29]   =  ["code"  =>  "0601", "rif" => "G200068973", "status" => $status, "name"  =>  "Instituto Municipal de Crédito Popular"];
        
        foreach ($data as $d => $da) 
        {
            $new    = New Bank();
            $new->code          =   $da['code'];
            $new->name          =   strtoupper($da['name']);
            $new->rif           =   $da['rif'];
            $new->status_id     =   $da['status'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }

        }
    
    }
}
