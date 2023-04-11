@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">測驗列表</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>測驗標題</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $quiz)
                                    <tr>
                                        <td>{{ $quiz->id }}</td>
                                        <td>{{ $quiz->title }}</td>
                                        <td>
                                            <a href="{{ route('quizzes.show', $quiz->id) }}"
                                                class="btn btn-primary btn-sm">查看</a>
                                            <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                                class="btn btn-secondary btn-sm disabled">編輯</a>
                                            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('確認刪除測驗？')">刪除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('quizzes.create') }}" class="btn btn-primary">新增測驗</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
