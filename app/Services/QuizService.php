<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class QuizService
{
    public function getQuizInfo()
    {
        // 取得當前測驗資訊
        // 返回測驗標題、描述等資訊
    }

    public function getFirstQuestion(User $user, Quiz $quiz)
    {
        // 取得使用者未作答的第一題目
        // 更新使用者狀態
        // 返回題目資訊
    }

    public function getNextQuestion(User $user, Quiz $quiz, Question $question, $answer)
    {
        // 更新使用者答題狀態
        // 取得下一題未作答的題目
        // 更新使用者狀態
        // 返回題目資訊
    }

    public function finishQuiz(User $user, Quiz $quiz)
    {
        // 標記使用者完成測驗
        // 返回完成訊息
    }
}
