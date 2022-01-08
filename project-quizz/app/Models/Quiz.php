<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'duration', 'question_count', 'category_id', 'description'
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
}
