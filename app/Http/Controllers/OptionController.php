<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(Question $question)
    {
        $options = $question->options;
        return view('option.index', compact('question', 'options'));
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
        // 驗證輸入資料
        $request->validate([
            'title' => 'required',
            'question_id' => 'required|exists:questions,id',
        ]);

        // 建立選項
        $option = new Option([
            'title' => $request->title,
            'question_id' => $request->question_id,
        ]);
        $option->save();

        // 導回原頁面
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        // 刪除該選項
        $option->delete();
        // 導向到原本的畫面
        return back();
    }
}
