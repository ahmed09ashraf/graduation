<div class="modal fade" id="addCollegeModal" tabindex="-1" role="dialog" aria-labelledby="addCollegeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-subtle">
                <h5 class="modal-title" id="addCollegeModalLabel">إضافة كلية جديدة</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.colleges.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="collegeName">اسم الكلية</label>
                        <input type="text" class="form-control" id="collegeName" name="name" required placeholder="ادخل اسم الكلية">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
