<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['content'];

    public function tests()
    {
        return $this->belongsToMany(Test::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
