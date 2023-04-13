<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\QuizService;

class QuizServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(QuizService::class, function ($app) {
            return new QuizService();
        });
    }
}
