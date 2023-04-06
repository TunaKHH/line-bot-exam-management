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
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">描述</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>

                            <hr>

                            <div class="questions">
                                <div class="question-template" style="display: none;">
                                    <div class="card">
                                        <div class="card-header">
                                            <span class="question-number"></span>
                                            <button type="button"
                                                class="btn btn-danger btn-sm float-right delete-question"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="question-title" class="col-form-label">題目</label>
                                                <textarea class="form-control question-title" name="questions[][title]" required></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="question-image" class="col-form-label">圖片</label>
                                                <input type="file" class="form-control-file question-image"
                                                    name="questions[][image]">
                                            </div>

                                            <div class="form-group options">
                                                <div class="option-template" style="display: none;">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input type="radio" name="questions[][correct_option_id]">
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control option-title"
                                                            name="questions[][options][][title]" placeholder="選項內容"
                                                            required>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-danger delete-option"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label for="options" class="col-form-label">選項</label>

                                                <div class="options-list">
                                                    <button type="button" class="btn btn-primary add-option"><i
                                                            class="fas fa-plus"></i> 新增選項</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="questions-list">
                                    <button type="button" class="btn btn-primary add-question"><i class="fas fa-plus"></i>
                                        新增題目</button>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="result1-title">結果1 標題</label>
                                <input type="text" name="results[][title]" id="result1-title" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="result1-description">結果1 描述</label>
                                <textarea name="results[][description]" id="result1-description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="result1-image">結果1 圖片</label>
                                <input type="file" name="results[][image]" id="result1-image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="result2-title">結果2 標題</label>
                                <input type="text" name="results[][title]" id="result2-title" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="result2-description">結果2 描述</label>
                                <textarea name="results[][description]" id="result2-description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="result2-image">結果2 圖片</label>
                                <input type="file" name="results[][image]" id="result2-image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="result3-title">結果3 標題</label>
                                <input type="text" name="results[][title]" id="result3-title" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="result3-description">結果3 描述</label>
                                <textarea name="results[][description]" id="result3-description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="result3-image">結果3 圖片</label>
                                <input type="file" name="results[][image]" id="result3-image"
                                    class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="result4-title">結果4 標題</label>
                                <input type="text" name="results[][title]" id="result4-title" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="result4-description">結果4 描述</label>
                                <textarea name="results[][description]" id="result4-description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="result4-image">結果4 圖片</label>
                                <input type="file" name="results[][image]" id="result4-image"
                                    class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="result5-title">結果5 標題</label>
                                <input type="text" name="results[][title]" id="result5-title" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="result5-description">結果5 描述</label>
                                <textarea name="results[][description]" id="result5-description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="result5-image">結果5 圖片</label>
                                <input type="file" name="results[][image]" id="result5-image"
                                    class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary">新增測驗</button>
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
