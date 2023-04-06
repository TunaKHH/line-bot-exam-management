<div class="form-group">
    <label for="title">標題</label>
    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $quiz->title) }}"
        required>
</div>

<div class="form-group">
    <label for="description">描述</label>
    <textarea class="form-control" name="description" id="description" rows="5">{{ old('description', $quiz->description) }}</textarea>
</div>

<div id="questions-container">
    <div class="questions">
        @foreach ($quiz->questions as $question)
            <div class="card mb-3 question">
                <div class="card-header">
                    題目 {{ $loop->iteration }}
                    <button type="button" class="btn btn-sm btn-danger float-right remove-question-btn"
                        {{ $loop->iteration <= 1 ? 'disabled' : '' }}>刪除</button>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][title]">標題</label>
                        <input type="text" class="form-control" name="questions[{{ $loop->index }}][title]"
                            value="{{ old('questions.' . $loop->index . '.title', $question->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][image]">圖片</label>
                        <input type="file" class="form-control-file" name="questions[{{ $loop->index }}][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][0][title]">答案 1</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][options][0][title]"
                            value="{{ old('questions.' . $loop->index . '.options.0.title', $question->options[0]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][0][image]">答案 1 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][options][0][image]">
                    </div>
                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][1][title]">答案 2</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][options][1][title]"
                            value="{{ old('questions.' . $loop->index . '.options.1.title', $question->options[1]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][1][image]">答案 2 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][options][1][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][2][title]">答案 3</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][options][2][title]"
                            value="{{ old('questions.' . $loop->index . '.options.2.title', $question->options[2]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][2][image]">答案 3 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][options][2][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][3][title]">答案 4</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][options][3][title]"
                            value="{{ old('questions.' . $loop->index . '.options.3.title', $question->options[3]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][3][image]">答案 4 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][options][3][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][4][title]">答案 5</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][options][4][title]"
                            value="{{ old('questions.' . $loop->index . '.options.4.title', $question->options[4]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][options][4][image]">答案 5 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][options][4][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][0][title]">結果 1</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][result][0][title]"
                            value="{{ old('questions.' . $loop->index . '.result.0.title', $question->result[0]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][0][image]">結果 1 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][result][0][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][1][title]">結果 2</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][result][1][title]"
                            value="{{ old('questions.' . $loop->index . '.result.1.title', $question->result[1]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][1][image]">結果 2 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][result][1][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][2][title]">結果 3</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][result][2][title]"
                            value="{{ old('questions.' . $loop->index . '.result.2.title', $question->result[2]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][2][image]">結果 3 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][result][2][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][3][title]">結果 4</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}][result][3][title]"
                            value="{{ old('questions.' . $loop->index . '.result.3.title', $question->result[3]->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][3][image]">結果 4 圖片</label>
                        <input type="file" class="form-control-file"
                            name="questions[{{ $loop->index }}][result][3][image]">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="questions[{{ $loop->index }}][result][4][title]">結果 5</label>
                        <input type="text" class="form-control"
                            name="questions[{{ $loop->index }}
                    }}}"
                            class="btn btn-primary btn-sm add-question-btn">新增題目</button>
                    </div>
                </div>
            </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.add-question-btn').click(function() {
                var container = $(this).closest('#questions-container');
                var questions = container.find('.questions');
                var newQuestion = questions.first().clone();
                newQuestion.find('input, textarea').val('');
                newQuestion.find('.card-header').text('題目 ' + (questions.length + 1));
                newQuestion.find('.remove-question-btn').removeAttr('disabled');
                container.append(newQuestion);
            });
            $(document).on('click', '.remove-question-btn', function() {
                var container = $(this).closest('#questions-container');
                var questions = container.find('.question');
                if (questions.length <= 1) {
                    return;
                }
                $(this).closest('.question').remove();
                questions.each(function(index) {
                    $(this).find('.card-header').text('題目 ' + (index + 1));
                });
                if (questions.length === 1) {
                    questions.find('.remove-question-btn').attr('disabled', true);
                }
            });
        });
    </script>
@endpush
