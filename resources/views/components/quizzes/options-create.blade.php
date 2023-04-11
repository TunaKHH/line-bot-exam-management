{{-- 新增選項 --}}
<form action="{{ route('option.store') }}" method="post">
    @csrf
    <input type="text" name="title">
    <input type="hidden" name="question_id" value="{{ $question->id }}">
    <button type="submit" class="btn btn-primary">
        新增選項
    </button>
</form>
