<!-- General Add Modal -->
<div class="modal fade" id="generalAddModal" tabindex="-1" aria-labelledby="generalAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generalAddModalLabel">إضافة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="generalAddForm" method="POST" action="{{route('admin.colleges.store')}}">
                    @csrf
                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="generalAddInputName">الاسم</label>
                        <input type="text" class="form-control" id="generalAddInputName" name="name">
                    </div>
                    <!-- College Field (hidden by default, shown only for departments) -->
                    <div class="form-group d-none" id="collegeSelectGroup">
                        <label for="generalAddInputCollege">الكلية</label>
                        <select class="form-control" id="generalAddInputCollege" name="college_id">
                            @foreach($colleges as $college)
                                <option value="{{ $college->id }}">{{ $college->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function configureModal(section) {
        var modal = $('#generalAddModal');
        modal.modal('show');

        // Reset form fields and hide college selector by default
        $('#generalAddForm')[0].reset();
        $('#collegeSelectGroup').addClass('d-none');

        // Update form action dynamically based on the section
        if (section === 'department') {
            modal.find('.modal-title').text('إضافة قسم جديد');
            $('#generalAddForm').attr('action', "{{ route('admin.departments.store') }}");
            $('#collegeSelectGroup').removeClass('d-none');  // Show college selector for departments
        } else if (section === 'college') {
            modal.find('.modal-title').text('إضافة كلية جديدة');
            $('#generalAddForm').attr('action', "{{ route('admin.colleges.store') }}");
        } else if (section === 'uniform') {
            modal.find('.modal-title').text('إضافة زي جديد');
            $('#generalAddForm').attr('action', "{{ route('admin.uniforms.store') }}");
        }
    }
</script>
