<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'name', 'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
    
}
