<?php

namespace Database\Seeders;

use App\Models\Admins\Promotions\PromotionsTechnology;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class PromotionsTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   = ['status' => $status, 'name' => ucfirst('Fibra Inalambrica')];
        $data[1]   = ['status' => $status, 'name' => ucfirst('Fibra Optica')];

        foreach ($data as $d => $dat) 
        {          
            try {
                $new    =   new PromotionsTechnology();
                $new->name      =   $dat['name'];
                $new->status_id =   $dat['status'];
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
