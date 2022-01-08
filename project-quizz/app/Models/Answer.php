<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = "answers";

    protected $fillable = [
        "answer_content",
        "question_id",
        "correct"
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }
}
