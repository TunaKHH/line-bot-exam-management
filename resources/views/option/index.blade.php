@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $question->title }} 的選項列表</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($options as $option)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $option->title }}
                                    <form action="{{ route('option.destroy', $option->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            刪除
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <form action="{{ route('option.store') }}" method="post">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="title">新增選項</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <button type="submit" class="btn btn-primary">
                                新增選項
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
