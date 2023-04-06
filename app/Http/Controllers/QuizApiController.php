<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Result;
use Illuminate\Http\Request;

class QuizApiController extends Controller
{
    /**
     * Start a quiz.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function start(Quiz $quiz)
    {
        $questions = $quiz->questions->map(function ($question) {
            $options = $question->options->map(function ($option) {
                return [
                    'id' => $option->id,
                    'title' => $option->title,
                    'imageUrl' => $option->image_url,
                ];
            });
            return [
                'id' => $question->id,
                'title' => $question->title,
                'imageUrl' => $question->image_url,
                'options' => $options->shuffle()->values()->all(),
            ];
        });

        return response()->json([
            'quiz' => [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'description' => $quiz->description,
                'questions' => $questions->shuffle()->values()->all(),
            ]
        ]);
    }

    /**
     * Submit a quiz.
     *
     * @param  \App\Models\Quiz  $quiz
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Quiz $quiz, Request $request)
    {
        $data = $request->validate([
            'responses' => 'required|array',
            'responses.*.question_id' => 'required|integer|exists:questions,id',
            'responses.*.option_id' => 'required|integer|exists:options,id',
        ]);

        $responses = collect($data['responses']);

        $resultCounts = $responses->groupBy('option_id')->map->count();

        $result = $quiz->results->filter(function ($result) use ($resultCounts) {
            return $result->options->pluck('id')->diff($resultCounts->keys())->isEmpty();
        })->first();
        if (!$result) {
            return response()->json(['error' => 'No result found.'], 400);
        }

        return response()->json([
            'result' => [
                'id' => $result->id,
                'title' => $result->title,
                'description' => $result->description,
                'imageUrl' => $result->image_url,
            ]
        ]);
    }
}
