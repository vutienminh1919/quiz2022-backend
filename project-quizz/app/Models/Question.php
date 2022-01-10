<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = "questions";

    protected $fillable = [
      'question',
        "question_content",
        "difficulty"
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quizQuestion()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_questions','quiz_id', 'question_id');
    }
}
