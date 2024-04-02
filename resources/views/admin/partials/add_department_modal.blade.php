<div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle">
                <h5 class="modal-title" id="addDepartmentModalLabel">إضافة قسم جديد</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.departments.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="departmentName">اسم القسم</label>
                        <input type="text" class="form-control" id="departmentName" name="name" required placeholder="ادخل اسم القسم">
                    </div>
                    <div class="form-group">
                        <label for="college_id">اختر الكلية</label>
                        <select class="form-control" id="college_id" name="college_id" required>
                            <option value="">-- اختر الكلية --</option>
                            @foreach($colleges as $college)
                                <option value="{{ $college->id }}">{{ $college->name }}</option>
                            @endforeach
                        </select>
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
