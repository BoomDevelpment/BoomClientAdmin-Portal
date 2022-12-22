<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Survery\SurveyOptionsQuestions;
use App\Models\Clients\Survery\SurveyQuestions;
use Illuminate\Database\Seeder;

class SurveyOptionsQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status         =   Status::where('name', 'like', '%act%')->first()->id;
        $calificacion   =   SurveyQuestions::where('name', 'LIKE', '%cal%')->first()->id;
        $atencion       =   SurveyQuestions::where('name', 'LIKE', '%ate%')->first()->id;
        $manitos        =   SurveyQuestions::where('name', 'LIKE', '%man%')->first()->id;

        $data[0]   =   ['name' => '01 - Muy insatisfecho',  'question' => $calificacion, 'status' => $status];
        $data[1]   =   ['name' => '02 - Insatisfecho',      'question' => $calificacion, 'status' => $status];
        $data[2]   =   ['name' => '03 - Deficiente',        'question' => $calificacion, 'status' => $status];
        $data[3]   =   ['name' => '04 - Irregular',         'question' => $calificacion, 'status' => $status];
        $data[4]   =   ['name' => '05 - Regular',           'question' => $calificacion, 'status' => $status];
        $data[5]   =   ['name' => '06 - Aceptable',         'question' => $calificacion, 'status' => $status];
        $data[6]   =   ['name' => '07 - Satisfecho',        'question' => $calificacion, 'status' => $status];
        $data[7]   =   ['name' => '08 - Muy satisfecho',    'question' => $calificacion, 'status' => $status];
        $data[8]   =   ['name' => '09 - Excelente',         'question' => $calificacion, 'status' => $status];
        $data[9]   =   ['name' => '10 - Lo recomiendo',     'question' => $calificacion, 'status' => $status];

        $data[10]  =   ['name' => 'Excelente',  'question' => $atencion, 'status' => $status];
        $data[11]  =   ['name' => 'Buena',      'question' => $atencion, 'status' => $status];
        $data[12]  =   ['name' => 'Deficiente', 'question' => $atencion, 'status' => $status];
        
        $data[13]  =   ['name' => 'Si', 'question' => $manitos, 'status' => $status];
        $data[14]  =   ['name' => 'No', 'question' => $manitos, 'status' => $status];

        foreach ($data as $d => $da) 
        {
            $new    =   New SurveyOptionsQuestions();
            $new->name          =   $da['name'];
            $new->question_id   =   $da['question'];
            $new->status_id     =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
