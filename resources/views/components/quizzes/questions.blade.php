<div class="questions">
    <div class="question-template">
        <div class="card">
            <div class="card-header">
                <span class="question-number"></span>
                <button type="button" class="btn btn-danger btn-sm float-right delete-question"><i
                        class="fas fa-trash"></i></button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="question-title" class="col-form-label">題目</label>
                    <textarea class="form-control question-title" name="questions[][title]" required></textarea>
                </div>

                <div class="form-group">
                    <label for="question-image" class="col-form-label">圖片</label>
                    <input type="file" class="form-control-file question-image" name="questions[][image]">
                </div>

                <div class="form-group options">
                    <div class="option-template" style="display: none;">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="questions[][correct_option_id]">
                                </div>
                            </div>
                            <input type="text" class="form-control option-title" name="questions[][options][][title]"
                                placeholder="選項內容" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger delete-option"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <label for="options" class="col-form-label">選項</label>

                    <div class="options-list">
                        <button type="button" class="btn btn-primary add-option"><i class="fas fa-plus"></i>
                            新增選項</button>
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
