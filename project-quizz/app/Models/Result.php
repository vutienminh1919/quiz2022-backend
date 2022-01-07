<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $table = 'results';

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
