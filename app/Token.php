<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
