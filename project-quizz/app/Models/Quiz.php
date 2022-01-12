<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'duration'
    ];

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function userQuizzes()
    {
        return $this->hasMany(UserQuiz::class);
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quiz_questions', 'quiz_id', 'question_id');
    }

}
