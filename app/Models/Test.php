<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['title', 'classroom_id'];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
