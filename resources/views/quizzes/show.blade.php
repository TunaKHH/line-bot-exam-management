@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">測驗：{{ $quiz->title }}</div>

                    <div class="card-body">
                        <p>測驗描述ww：{{ $quiz->description }}</p>

                        <div class="quiz-questions">
                            @foreach ($quiz->questions as $question)
                                <div class="question" data-question-id="{{ $question->id }}">
                                    <h5>{{ $question->title }}</h5>

                                    @if ($question->image_url)
                                        <img src="{{ $question->image_url }}" alt="{{ $question->title }}"
                                            class="img-thumbnail">
                                    @endif

                                    <div class="options">
                                        @foreach ($question->options->shuffle() as $option)
                                            <label class="option">
                                                <input type="radio" name="responses[{{ $question->id }}]"
                                                    value="{{ $option->id }}">
                                                <div class="option-content">
                                                    @if ($option->image_url)
                                                        <img src="{{ $option->image_url }}" alt="{{ $option->title }}"
                                                            class="img-thumbnail">
                                                    @endif

                                                    <span class="option-title">{{ $option->title }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Modal body text goes here.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#questionModal">
                            新增題目
                        </button>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-quizzes.question-modal />
@endsection

@section('js')
    <script>
        console.log('www tuna here');
    </script>
@endsection
