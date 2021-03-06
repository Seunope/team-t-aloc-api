<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class QuestionFlagged extends Model
{
    protected $table = 'question_flag';

    protected  $fillable = ['subject','question','question_id','question_number', 'option_a','option_b','option_c','option_d','answer','solution','exam_type','exam_year' ];

    public static function subjectArray (){
        return ['english', 'commerce', 'accounting', 'biology', 'chemistry'];
    }

    public function  vote()
    {
        return $this->belongsTo('App\Models\Vote', 'id','question_flag_id');
    }

}
