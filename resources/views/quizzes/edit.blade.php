@extends('layouts.admin.app')

@section('content')
    <h1>編輯題目</h1>
    <form action="{{ route('quizzes.update', $quiz) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $quiz->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">圖片</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                name="image">
            @if ($quiz->image)
                <div class="mt-2">
                    <img src="{{ Storage::url($quiz->image) }}" width="200">
                </div>
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="options_count">答案選項數量</label>
            <input type="number" class="form-control @error('options_count') is-invalid @enderror" id="options_count"
                name="options_count" value="{{ old('options_count', $quiz->options_count) }}">
            @error('options_count')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group" id="options-container">
            <label>答案選項</label>
            <div class="options">
                @foreach ($quiz->options as $option)
                    <div class="option mb-3">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control @error('options.*.title') is-invalid @enderror"
                                    name="options[{{ $loop->index }}][title]"
                                    value="{{ old('options.' . $loop->index . '.title', $option->title) }}"
                                    placeholder="答案選項 {{ $loop->iteration }}">
                                @error('options.*.title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="file"
                                    class="form-control-file @error('options.*.image') is-invalid @enderror"
                                    name="options[{{ $loop->index }}][image]">
                                @if ($option->image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($option->image) }}" width="100">
                                    </div>
                                @endif
                                @error('options.*.image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-danger remove-option-btn"
                                    {{ $loop->iteration <= 2 ? 'disabled' : '' }}>刪除</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary add-option-btn">新增答案選項</button>
        </div>
        <div class="form-group" id="results-container">
            <label>結果</label>
            <div class="results">
                @foreach ($quiz->results as $result)
                    <div class="result mb-3">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control @error('results.*.title') is-invalid @enderror"
                                    name="results[{{ $loop->index }}][title]"
                                    value="{{ old('results.' . $loop->index . '.title', $result->title) }}"
                                    placeholder="結果 {{ $loop->iteration }} 標題">
                                @error('results.*.title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="file"
                                    class="form-control-file @error('results.*.image') is-invalid @enderror"
                                    name="results[{{ $loop->index }}][image]">
                                @if ($result->image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($result->image) }}" width="100">
                                    </div>
                                @endif
                                @error('results.*.image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            </textarea>
                        </div>
                    </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <button type="button" class="btn btn-sm btn-danger remove-result-btn"
                        {{ $loop->iteration <= 2 ? 'disabled' : '' }}>刪除</button>
                </div>
            </div>
        </div>
        @endforeach
        </div>
        <button type="button" class="btn btn-primary add-result-btn">新增結果</button>
        </div>
        <button type="submit" class="btn btn-primary">儲存</button>
    </form>
@endsection

@section('scripts')
    <script>
        function updateOptionRemoveBtns() {
            $('.option').each(function(index, el) {
                $(el).find('.remove-option-btn').prop('disabled', $('.option').length <= 2);
            });
        }

        function updateResultRemoveBtns() {
            $('.result').each(function(index, el) {
                $(el).find('.remove-result-btn').prop('disabled', $('.result').length <= 2);
            });
        }

        $(function() {
            updateOptionRemoveBtns();
            updateResultRemoveBtns();

            $('.add-option-btn').click(function() {
                var lastOption = $('.option:last-child').clone();
                var newIndex = $('.option').length;

                lastOption.find('input[name^="options"][name$="[title]"]').attr('name', 'options[' +
                    newIndex + '][title]').val('');
                lastOption.find('input[name^="options"][name$="[image]"]').attr('name', 'options[' +
                    newIndex + '][image]').val('');
                lastOption.find('.remove-option-btn').prop('disabled', false);

                $('#options-container .options').append(lastOption);

                updateOptionRemoveBtns();
            });

            $('.add-result-btn').click(function() {
                var lastResult = $('.result:last-child').clone();
                var newIndex = $('.result').length;

                lastResult.find('input[name^="results"][name$="[title]"]').attr('name', 'results[' +
                    newIndex + '][title]').val('');
                lastResult.find('input[name^="results"][name$="[image]"]').attr('name', 'results[' +
                    newIndex + '][image]').val('');
                lastResult.find('textarea[name^="results"][name$="[description]"]').attr('name',
                    'results[' + newIndex + '][description]').val('');
                lastResult.find('.remove-result-btn').prop('disabled', false);

                $('#results-container .results').append(lastResult);

                updateResultRemoveBtns();
            });

            $('#options-container').on('click', '.remove-option-btn', function() {
                $(this).closest('.option').remove();
                updateOptionRemoveBtns();
            });

            $('#results-container').on('click', '.remove-result-btn', function() {
                $(this).closest('.result').remove();
                updateResultRemoveBtns();
            });
        });
    </script>
@endsection
