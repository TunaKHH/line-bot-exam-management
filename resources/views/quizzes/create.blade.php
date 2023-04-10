@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">新增測驗</div>

                    <div class="card-body">
                        <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">標題</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="(選填)">
                            </div>

                            <div class="form-group">
                                <label for="description">描述</label>
                                <textarea name="description" id="description" class="form-control" placeholder="(選填)"></textarea>
                            </div>
                            <hr>
                            {{-- 置右的按鈕 --}}
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">新增測驗</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var questionCount = 1;
        $(document).ready(function() {
            // Add question
            $('.add-question').click(function() {
                var questionTemplate = $('.question-template').clone().removeClass('question-template')
                    .show();
                var questionNumber = $('.questions-list .card').length + 1;
                questionTemplate.find('.question-number').text('題目 ' + questionNumber);

                // Add option
                questionTemplate.find('.add-option').click(function() {
                    var optionTemplate = questionTemplate.find('.option-template').clone()
                        .removeClass('option-template').show();
                    var optionCount = questionTemplate.find('.options .input-group').length + 1;

                    optionTemplate.find('.option-title').attr('name', 'questions[' + (
                        questionCount - 1) + '][options][' + (optionCount - 1) + '][title]');
                    optionTemplate.find('input[type="radio"]').attr('name', 'questions[' + (
                        questionCount - 1) + '][correct_option_id]');

                    optionTemplate.find('.delete-option').click(function() {
                        $(this).closest('.input-group').remove();
                    });

                    questionTemplate.find('.options .options-list').append(optionTemplate);
                });

                // Delete question
                questionTemplate.find('.delete-question').click(function() {
                    $(this).closest('.card').remove();
                    updateQuestionNumbers();
                });

                $('.questions-list').append(questionTemplate);

                questionCount++;
            });

            // Delete option
            $('.delete-option').click(function() {
                $(this).closest('.input-group').remove();
            });
        });

        function updateQuestionNumbers() {
            $('.questions-list .card').each(function(index) {
                $(this).find('.question-number').text('題目 ' + (index + 1));
            });
        }
    </script>
@endsection
