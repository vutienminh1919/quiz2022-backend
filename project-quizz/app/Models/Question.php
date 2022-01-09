<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';

    protected $fillable = [
      'question',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }



    public function correctOptionsCount() {
        return $this->answers()->where('correct', 1 )->count();
    }

    public function correctAnswers() {
        return  $this->answers()->where('correct', 1)->get();
    }


    public function tests()
        {
            return $this->belongsToMany(Test::class);
        }
}
