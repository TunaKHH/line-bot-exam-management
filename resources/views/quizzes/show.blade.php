@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">測驗：{{ $quiz->title }}</div>

                    <div class="card-body">
                        <h3>測驗描述：{{ $quiz->description }}</h3>
                        {{-- 靠右 --}}
                        <div class="float-end">
                            <form action="{{ route('question.store') }}" method="post">
                                @csrf
                                <input type="text" name="title">
                                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                <button type="submit" class="btn btn-primary">
                                    新增題目
                                </button>
                            </form>
                        </div>

                        <div class="quiz-questions">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">圖片</th>
                                        <th scope="col">題目</th>
                                        <th scope="col">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quiz->questions as $question)
                                        <tr>
                                            <td>
                                                @if ($question->image_url)
                                                    <img src="{{ $question->image_url }}" alt="{{ $question->title }}"
                                                        class="img-thumbnail">
                                                @endif
                                            </td>
                                            <td>{{ $question->title }}</td>
                                            <td>
                                                {{-- 編輯此題目 --}}
                                                {{--
                                                <a href="{{ route('question.edit', $question->id) }}"
                                                    class="btn btn-secondary btn-sm">編輯</a> --}}
                                                {{-- 查看題目選項 --}}
                                                <a href="{{ route('option.index', $question->id) }}"
                                                    class="btn btn-primary btn-sm">選項</a>
                                                {{-- 刪除此題目 --}}
                                                <form action="{{ route('question.destroy', $question->id) }}" method="post"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('確認刪除題目？')">刪除</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <x-quizzes.question-modal /> --}}
@endsection

@section('js')
    <script>
        function fetchData(questionId) {
            return axios.get(`/question/${questionId}/options`)
                .then(function(response) {
                    // 渲染數據到 modal 的 div 元素中
                    document.getElementById('modal-content').innerHTML = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection
