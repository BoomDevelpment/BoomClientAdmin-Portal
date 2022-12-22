<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Survery\SurveyQuestionsType;
use Illuminate\Database\Seeder;

class SurveyQuestionsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =   ['name'     =>  strtoupper('Calificacion'),  'status'   =>  $status];
        $data[1]   =   ['name'     =>  strtoupper('Atencion'),      'status'   =>  $status];
        $data[2]   =   ['name'     =>  strtoupper('Manintos Boom'), 'status'   =>  $status];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New SurveyQuestionsType();
            $new->name      =   $da['name'];
            $new->status_id =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
