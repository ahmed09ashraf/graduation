<div class="modal fade" id="addUniformModal" tabindex="-1" role="dialog" aria-labelledby="addUniformModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success-subtle">
                <h5 class="modal-title" id="addUniformModalLabel">إضافة زي جديد</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.uniforms.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="uniformItem">نوع الزي</label>
                        <input type="text" class="form-control" id="uniformItem" name="item" required placeholder="ادخل اسم الزي">
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
