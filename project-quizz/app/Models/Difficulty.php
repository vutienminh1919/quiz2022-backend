<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    use HasFactory;

    protected $table = 'difficulties';

    public function question() {
        return $this->hasMany(Question::class,'difficulty_id','id');
    }
}
