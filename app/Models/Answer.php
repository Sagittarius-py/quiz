<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['content', 'is_correct'];

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
}
