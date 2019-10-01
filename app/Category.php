<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function surveys(){
        return $this->hasMany(Survey::class);
    }

    public function tokens(){
        return $this->hasMany(Token::class);
    }
}
