<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'name',
        'category_id',
        'difficulty_id',
        'quantity',
    ];

    public function categories() {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function difficulties() {
        return $this->belongsTo(Difficulty::class,'difficulty_id','id');
    }

    public function answer() {
        return $this->hasMany(Answer::class,'question_id','id');
    }

    public function tests() {
        return $this->belongsToMany(Test::class,'question_test','test_id','question_id');
    }
}
