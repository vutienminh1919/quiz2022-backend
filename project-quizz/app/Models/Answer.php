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
    protected $fillable = [
        'option', 'question_id', 'correct'
    ];

    protected $table = 'answers';

    public function question()
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }
}
