<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->get();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // 檢查 title, quizId
        // 確認quizId 確實存在 quizzes
        $request->validate([
            'title' => 'required|max:255|min:1',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        // 儲存
        $res = Question::create($request->all());
        // 若儲存失敗 導向到原本的畫面 並顯示錯誤訊息
        if (!$res) {
            return back()->withErrors(['msg' => '新增失敗']);
        }
        // 導向到原本的畫面 並顯示成功訊息
        return back()->with(['msg' => '新增成功']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {

        // 刪除該選項
        $question->delete();
        // 導向到原本的畫面
        return back();
    }
}
