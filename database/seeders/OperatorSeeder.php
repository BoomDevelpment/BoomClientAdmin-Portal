<?php

namespace Database\Seeders;

use App\Models\Clients\General\Profile;
use App\Models\Clients\General\Role;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Operator;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        $role       =   Role::where('name', 'like', '%adm%')->first()->id;

        $pAdmin     =   Profile::where('name', 'like', '%adm%')->first()->id;
        $statusA    =   Status::where('name', 'like', '%act%')->first()->id;
        
        $data[0]    =   [
            'name'      =>  ucfirst('admin'),
            'username'  =>  ucfirst('admin'),  
            'ext_pr'    =>  0, 
            'ext_vz'    =>  0,
            'ext_us'    =>  0,
            'role'      =>  $role,
            'status'    =>  $status
        ];
        
        $data[1]    =   [
            'name'      =>  ucfirst('Luis Campos'),
            'username'  =>  ucfirst('lcampos'),  
            'ext_pr'    =>  0, 
            'ext_vz'    =>  0,
            'ext_us'    =>  0,
            'role'      =>  $role,
            'status'    =>  $status
        ];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New Operator();
            $new->name      =   $da['name'];
            $new->username  =   $da['username'];
            $new->ext_pr    =   $da['ext_pr'];
            $new->ext_vz    =   $da['ext_vz'];
            $new->ext_us    =   $da['ext_us'];
            $new->role_id   =   $da['role'];
            $new->status_id =   $da['status'];

            try {
                $new->save();

                $us             =   New User();
                $us->name       =   $da['name'];
                $us->username   =   $da['username'];
                $us->email      =   strtolower('admins@boomsolutions.com');
                $us->password   =   bcrypt('Boom1234');
                $us->identified =   random_int(10000000, 99999999);
                $us->profile_id =   $pAdmin;
                $us->status_id  =   $statusA;
    
                try {
                    $us->save();
                } catch (\Exception $e) {
                    var_dump($e->getMessage());
                }


            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
