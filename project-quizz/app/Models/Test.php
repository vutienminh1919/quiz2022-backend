<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function questions() {
        return $this->belongsToMany(Question::class,'question_test','test_id','question_id');
    }

    public function users() {
        return $this->belongsToMany(User::class,'test_user','test_id','user_id');
    }
}
