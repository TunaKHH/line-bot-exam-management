<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'title', 'image'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
