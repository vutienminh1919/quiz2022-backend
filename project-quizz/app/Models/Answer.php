<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($object)
 * @method static create($data)
 */
class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'question_id', 'correct'
    ];

    public function questions() {
        return $this->belongsTo(Question::class,'question_id','id');
    }
}
