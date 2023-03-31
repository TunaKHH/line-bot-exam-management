<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Option;
use App\Models\Result;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'options_count' => 'required|integer',
            'options' => 'required|array',
            'options.*.title' => 'required',
            'options.*.image' => 'nullable|image',
            'results' => 'required|array',
            'results.*.title' => 'required',
            'results.*.image' => 'nullable|image',
            'results.*.description' => 'nullable',
        ]);

        $quiz = Quiz::create([
            'title' => $request->input('title'),
            'options_count' => $request->input('options_count'),
        ]);

        foreach ($request->input('options') as $optionData) {
            $option = new Option([
                'title' => $optionData['title'],
            ]);

            if ($optionData['image']) {
                $path = $optionData['image']->store('images', 'public');
                $option->image = $path;
            }

            $quiz->options()->save($option);
        }

        foreach ($request->input('results') as $resultData) {
            $result = new Result([
                'title' => $resultData['title'],
                'description' => $resultData['description'],
            ]);

            if ($resultData['image']) {
                $path = $resultData['image']->store('images', 'public');
                $result->image = $path;
            }

            $quiz->results()->save($result);
        }

        return redirect()->route('quizzes.index');
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required',
            'options_count' => 'required|integer',
            'options' => 'required|array',
            'options.*.title' => 'required',
            'options.*.image' => 'nullable|image',
            'results' => 'required|array',
            'results.*.title' => 'required',
            'results.*.image' => 'nullable|image',
            'results.*.description' => 'nullable',
        ]);

        $quiz->update([
            'title' => $request->input('title'),
            'options_count' => $request->input('options_count'),
        ]);

        $optionIds = collect($request->input('options'))->pluck('id')->toArray();
        $resultIds = collect($request->input('results'))->pluck('id')->toArray();

        $quiz->options()
            ->whereNotIn('id', $optionIds)
            ->get()
            ->each(function ($option) {
                Storage::disk('public')->delete($option->image);
                $option->delete();
            });

        $quiz->results()
            ->whereNotIn('id', $resultIds)
            ->get()
            ->each(function ($result) {
                Storage::disk('public')->delete($result->image);
                $result->delete();
            });

        foreach ($request->input('options') as $optionData) {
            $option = Option::updateOrCreate(
                ['id' => $optionData['id']],
                ['title' => $optionData['title']]
            );

            if ($optionData['image']) {
                $path = $optionData['image']->store('images', 'public');
                Storage::disk('public')->delete($option->image);
                $option->image = $path;
            } elseif (isset($optionData['remove_image'])) {
                Storage::disk('public')->delete($option->image);
                $option->image = null;
            }

            $quiz->options()->save($option);
        }

        foreach ($request->input('results') as $resultData) {
            $result = Result::updateOrCreate(
                ['id' => $resultData['id']],
                [
                    'title' => $resultData['title'],
                    'description' => $resultData['description'],
                ]
            );

            if ($resultData['image']) {
                $path = $resultData['image']->store('images', 'public');
                Storage::disk('public')->delete($result->image);
                $result->image = $path;
            } elseif (isset($resultData['remove_image'])) {
                Storage::disk('public')->delete($result->image);
                $result->image = null;
            }

            $quiz->results()->save($result);
        }

        return redirect()->route('quizzes.index');
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
