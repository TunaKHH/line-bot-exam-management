@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $quiz->title }}</div>

                    <div class="card-body">
                        <p>{{ $quiz->description }}</p>

                        <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST" id="quiz-form">
                            @csrf

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

                            <button type="submit" class="btn btn-primary">提交答案</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('quiz-form').addEventListener('submit', function(event) {
            event.preventDefault();

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        responses: Object.entries(new FormData(this)).map(([questionId, optionId]) => ({
                            question_id: questionId,
                            option_id: optionId
                        }))
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error(response.statusText);
                    }
                })
                .then(data => {
                    if (data.result) {
                        alert(data.result.title);
                    } else {
                        throw new Error('No result found.');
                    }
                })
                .catch(error => {
                    alert(error.message);
                });
        });
    </script>
@endsection
