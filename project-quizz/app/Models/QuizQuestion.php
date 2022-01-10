<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_id', 'question_id'
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function question ()
    {
        return $this->belongsTo(Question::class);
    }
}
