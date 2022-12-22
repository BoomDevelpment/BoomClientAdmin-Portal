<?php

namespace App\Models\Clients\Survery;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestions extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);                 }
    public function type()      {   return $this->belongsTo(SurveyQuestionsType::class);    }
    public function questions() {   return $this->hasMany(SurveyOptionsQuestions::class, 'question_id');    }
}
