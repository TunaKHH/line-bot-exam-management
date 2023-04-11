<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'quiz_id'];

    // 一個問題有多個選項
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
