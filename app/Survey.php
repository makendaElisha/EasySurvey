<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'question_id', 'answer_id' 
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function question(){
        $this->belongsTo(Question::class);
    }

}
