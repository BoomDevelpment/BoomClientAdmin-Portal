<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Survery\SurveyQuestions;
use App\Models\Clients\Survery\SurveyQuestionsType;
use Illuminate\Database\Seeder;

class SurveyQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =   [
            'name'      =>  '¿Con qué puntaje calificaría usted su servicio de Internet, el último mes del 1 al 10? Teníendo en cuenta que:',
            'status'    =>  $status, 
            'type'      =>  SurveyQuestionsType::where('name', 'LIKE', '%cal%')->first()->id 
        ];
        $data[1]   =   [
            'name'      =>  'La atención que recibes como cliente es:',
            'status'    =>  $status, 
            'type'      =>  SurveyQuestionsType::where('name', 'LIKE', '%ate%')->first()->id 
        ];
        $data[2]   =   [
            'name'     =>  '¿Conoces nuestra Fundación Manitos Boom?',
            'status'   =>  $status, 
            'type'      =>  SurveyQuestionsType::where('name', 'LIKE', '%man%')->first()->id 
        ];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New SurveyQuestions();
            $new->name      =   $da['name'];
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
