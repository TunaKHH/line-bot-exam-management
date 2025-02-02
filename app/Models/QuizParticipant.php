<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_line_id',
        'quiz_id',
        'last_question_index',
        'is_completed',
    ];


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
