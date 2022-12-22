<?php

namespace Database\Seeders;

use App\Models\Clients\Profile\Client;
use App\Models\Clients\Survery\Survey;
use App\Models\Clients\Survery\SurveyOptionsQuestions;
use App\Models\Clients\Survery\SurveyQuestions;
use App\Models\User;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user       =   User::where('name', 'LIKE', '%develop%')->first();
        $client     =   Client::findOrFail($user->client->client_id);
        
        $data[0]    =   [
            'mikrowisp'             =>  $client->mikrowisp,
            'client_id'             =>  $user->client->client_id,
            'rating_id'             =>  SurveyQuestions::where('name', 'LIKE', '%cali%')->first()->id,
            'rating_answer_id'      =>  SurveyOptionsQuestions::where('name', 'LIKE', '%recomi%')->first()->id,
            'attention_id'          =>  SurveyQuestions::where('name', 'LIKE', '%aten%')->first()->id,
            'attention_answer_id'   =>  SurveyOptionsQuestions::where('name', '=', 'Excelente')->first()->id,
            'hand_id'               =>  SurveyQuestions::where('name', 'LIKE', '%mani%')->first()->id,
            'hand_answer_id'        =>  SurveyOptionsQuestions::where('name', '=', 'Si')->first()->id,
        ];

        foreach ($data as $d => $da) 
        {
            $new    =   New Survey();
            $new->mikrowisp             =   $da['mikrowisp'];
            $new->client_id             =   $da['client_id'];
            $new->rating_id             =   $da['rating_id'];
            $new->rating_answer_id      =   $da['rating_answer_id'];
            $new->attention_id          =   $da['attention_id'];
            $new->attention_answer_id   =   $da['attention_answer_id'];
            $new->hand_id               =   $da['hand_id'];
            $new->hand_answer_id        =   $da['hand_answer_id'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
