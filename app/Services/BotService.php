<?php

namespace App\Services;
use App\Models\Quiz;
use App\Models\QuizParticipant;

class BotService
{

    /**
     * 使用者開始測驗
     *
     * @param integer $quizId
     * @param string $userId
     * @return array
     */
    public function start(int $quizId, string $userId): array
    {
        // 取得測驗資料
        $quiz = Quiz::firstWhere('id', $quizId);
        // 建立使用者狀態
        QuizParticipant::create([
            'user_line_id' => $userId,
            'quiz_id' => $quizId,
            'last_question_index' => 0,
            'is_completed' => false,
        ]);
        // 回傳問題和使用者狀態
        return [
            'quizTitle' => $quiz->title,
        ];
    }

}
