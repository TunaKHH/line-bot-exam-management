<div class="modal fade" id="questionModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="questionModalLabel">新增題目</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">題目圖片</label>
                </div> --}}
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">題目描述</span>
                    <input type="text" class="form-control" placeholder="題目描述" name="questionTitle">
                </div>
                答案選項
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary">新增</button>
            </div>
        </div>
    </div>
</div>
