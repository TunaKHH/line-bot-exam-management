@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold my-4">{{ __('編輯測驗') }}</h1>
        <form action="{{ route('quizzes.update', $quiz) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">{{ __('測驗標題') }}</label>
                <input type="text" name="title" id="title"
                    class="form-input w-full @error('title') border-red-500 @enderror"
                    value="{{ old('title', $quiz->title) }}" required autofocus>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">{{ __('測驗描述') }}</label>
                <textarea name="description" id="description"
                    class="form-textarea w-full @error('description') border-red-500 @enderror" required>{{ old('description', $quiz->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @foreach ($questions as $question)
                <div class="mb-4">
                    <h2 class="text-xl font-bold">{{ __('問題 :index', ['index' => $loop->iteration]) }}</h2>
                    <div class="my-2">
                        <label for="question-{{ $question->id }}-title"
                            class="block text-gray-700 font-bold mb-2">{{ __('問題內容') }}</label>
                        <input type="text" name="questions[{{ $loop->index }}][title]"
                            id="question-{{ $question->id }}-title"
                            class="form-input w-full @error('questions.' . $loop->index . '.title') border-red-500 @enderror"
                            value="{{ old('questions.' . $loop->index . '.title', $question->title) }}" required>
                        @error('questions.' . $loop->index . '.title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="question-{{ $question->id }}-image"
                            class="block text-gray-700 font-bold mb-2">{{ __('問題圖片') }}</label>
                        <input type="file" name="questions[{{ $loop->index }}][image]"
                            id="question-{{ $question->id }}-image"
                            class="form-input w-full @error('questions.' . $loop->index . '.image') border-red-500 @enderror"
                            accept="image/*">
                        @error('questions.' . $loop->index . '.image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="question-{{ $question->id }}-options-{{ $option->id }}-title"
                            class="block text-gray-700 font-bold mb-2">{{ __('選項內容') }}</label>
                        <input type="text"
                            name="questions[{{ $loop->parent->index }}][options][{{ $loop->index }}][title]"
                            id="question-{{ $question->id }}-options-{{ $option->id }}-title"
                            class="form-input w-full @error('questions.' . $loop->parent->index . '.options.' . $loop->index . '.title') border-red-500 @enderror"
                            value="{{ old('questions.' . $loop->parent->index . '.options.' . $loop->index . '.title', $option->title) }}"
                            required>
                        @error('questions.' . $loop->parent->index . '.options.' . $loop->index . '.title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="question-{{ $question->id }}-options-{{ $option->id }}-correct"
                            class="block text-gray-700 font-bold mb-2">{{ __('是否正確選項') }}</label>
                        <label class="inline-flex items-center">
                            <input type="radio"
                                name="questions[{{ $loop->parent->index }}][options][{{ $loop->index }}][correct]"
                                id="question-{{ $question->id }}-options-{{ $option->id }}-correct" value="1"
                                class="form-radio @error('questions.' . $loop->parent->index . '.options.' . $loop->index . '.correct') border-red-500 @enderror"
                                {{ old('questions.' . $loop->parent->index . '.options.' . $loop->index . '.correct', $option->correct) ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('是') }}</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio"
                                name="questions[{{ $loop->parent->index }}][options][{{ $loop->index }}][correct]"
                                id="question-{{ $question->id }}-options-{{ $option->id }}-incorrect" value="0"
                                class="form-radio @error('questions.' . $loop->parent->index . '.options.' . $loop->index . '.correct') border-red-500 @enderror"
                                {{ old('questions.' . $loop->parent->index . '.options.' . $loop->index . '.correct', $option->correct) ? '' : 'checked' }}>
                            <span class="ml-2">{{ __('否') }}</span>
                        </label>
                        @error('questions.' . $loop->parent->index . '.options.' . $loop->index . '.correct')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endforeach
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('儲存') }}
                </button>
            </div>
        </form>
    </div>
@endsection
