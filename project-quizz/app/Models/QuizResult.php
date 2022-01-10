<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'quiz_id', 'question_id', 'answer_id', 'correct', 'answered', 'user_quiz_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function quizzes()
    {
        $this->belongsToMany(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function userQuiz()
    {
        return $this->belongsTo(UserQuiz::class);
    }
}
