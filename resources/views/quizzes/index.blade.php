@extends('layouts.admin.app')

@section('content')
    <h1>題目列表</h1>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-3">新增題目</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>標題</th>
                <th>圖片</th>
                <th>答案選項數量</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->title }}</td>
                    <td>
                        @if ($quiz->image)
                            <img src="{{ Storage::url($quiz->image) }}" width="100">
                        @endif
                    </td>
                    <td>{{ $quiz->options_count }}</td>
                    <td>
                        <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-primary">編輯</a>
                        <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">刪除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
