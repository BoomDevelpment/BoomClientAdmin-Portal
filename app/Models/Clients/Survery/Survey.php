<?php

namespace App\Models\Clients\Survery;

use App\Models\Clients\Profile\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    public function client()    {   return $this->belongsTo(Client::class);                                                 }
    public function rating()    {   return $this->belongsTo(SurveyQuestions::class, 'rating_id');                           }
    public function rAnswer()   {   return $this->belongsTo(SurveyOptionsQuestions::class, 'rating_answer_id');             }
    public function attention() {   return $this->belongsTo(SurveyQuestions::class, 'attention_id');                        }
    public function aAnswer()   {   return $this->belongsTo(SurveyOptionsQuestions::class, 'attention_answer_id');          }
    public function hand()      {   return $this->belongsTo(SurveyQuestions::class, 'hand_id');                             }
    public function hAnswer()   {   return $this->belongsTo(SurveyOptionsQuestions::class, 'hand_answer_id');               }
}