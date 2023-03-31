<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'options_count'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
