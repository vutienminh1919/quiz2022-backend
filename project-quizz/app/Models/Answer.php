<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static findOrFail($object)
 * @method static create($data)
 * @method static find(int $int)
 * @method static get()
 */

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
