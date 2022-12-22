<?php

namespace Database\Seeders;

use App\Models\Clients\Profile\Client;
use App\Models\Clients\Survery\Survey;
use App\Models\Clients\Survery\SurveyReferred;
use App\Models\User;
use Illuminate\Database\Seeder;

class SurveyReferredSeeder extends Seeder
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
        $survey     =   Survey::first();
        
        $data[0]    =   [
            'name'      =>  "Referred Test - 01",
            'phones'    =>  "584241234567",
            'client_id' =>  $client->id,
            'survey_id' =>  $survey->id
        ];

        $data[1]    =   [
            'name'      =>  "Referred Test - 02",
            'phones'    =>  "584269876543",
            'client_id' =>  $client->id,
            'survey_id' =>  $survey->id
        ];

        $data[2]    =   [
            'name'      =>  "Referred Test - 03",
            'phones'    =>  "584124567893",
            'client_id' =>  $client->id,
            'survey_id' =>  $survey->id
        ];
        foreach ($data as $d => $da) 
        {
            $new    =   New SurveyReferred();
            $new->name          =   $da['name'];
            $new->phones        =   $da['phones'];
            $new->client_id     =   $da['client_id'];
            $new->survey_id     =   $da['survey_id'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
