<?php

namespace Database\Seeders;

use App\Models\Admins\Promotions\PromotionsType;
use App\Models\Clients\General\Status;
use Illuminate\Database\Seeder;

class PromotionsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   = ['status' => $status, 'name' => ucfirst('Residencial')];
        $data[1]   = ['status' => $status, 'name' => ucfirst('Comercial')];

        foreach ($data as $d => $dat) 
        {          
            try {
                $new    =   new PromotionsType();
                $new->name      =   $dat['name'];
                $new->status_id =   $dat['status'];
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}