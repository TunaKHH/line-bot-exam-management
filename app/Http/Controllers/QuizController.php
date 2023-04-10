<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Result;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    protected $validationRules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'questions.*.title' => 'required|string|max:255',
        'questions.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'questions.*.options.*.title' => 'required|string|max:255',
        'questions.*.options.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'questions.*.result.*.title' => 'required|string|max:255',
        'questions.*.result.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::all();

        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, $this->validationRules);

        $quiz = new Quiz;
        $quiz->title = $data['title'];
        $quiz->description = $data['description'];
        $quiz->save();

        // foreach ($data['questions'] as $questionData) {
        //     $question = new Question;
        //     $question->title = $questionData['title'];
        //     $question->quiz_id = $quiz->id;
        //     $question->save();

        //     foreach ($questionData['options'] as $optionData) {
        //         $option = new Option;
        //         $option->title = $optionData['title'];
        //         $option->question_id = $question->id;

        //         if (isset($optionData['image'])) {
        //             $path = $optionData['image']->store('public/images');
        //             $url = Storage::url($path);
        //             $option->image_url = $url;
        //         }

        //         $option->save();
        //     }

        //     foreach ($questionData['result'] as $resultData) {
        //         $result = new Result;
        //         $result->title = $resultData['title'];
        //         $result->quiz_id = $quiz->id;

        //         if (isset($resultData['image'])) {
        //             $path = $resultData['image']->store('public/images');
        //             $url = Storage::url($path);
        //             $result->image_url = $url;
        //         }

        //         $result->save();
        //     }
        // }

        return redirect()->route('quizzes.show', $quiz->id)->with('success', '測驗已創建');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->save();

        // Update questions
        foreach ($request->questions as $questionData) {
            $question = Question::find($questionData['id']);
            $question->title = $questionData['title'];
            $question->save();

            // Update question image
            if ($questionData['image']) {
                $question->updateImage($questionData['image']);
            }

            // Update options
            foreach ($questionData['options'] as $optionData) {
                $option = Option::find($optionData['id']);
                $option->title = $optionData['title'];
                $option->save();

                // Update option image
                if ($optionData['image']) {
                    $option->updateImage($optionData['image']);
                }
            }

            // Update correct option
            $correctOption = Option::find($questionData['correct_option_id']);
            $question->correctOption()->associate($correctOption);
            $question->save();
        }

        return redirect()->route('quizzes.index')->with('success', '測驗已更新。');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->options->each(function ($option) {
            Storage::disk('public')->delete($option->image);
            $option->delete();
        });

        $quiz->results->each(function ($result) {
            Storage::disk('public')->delete($result->image);
            $result->delete();
        });

        $quiz->delete();

        return redirect()->route('quizzes.index');
    }
}
