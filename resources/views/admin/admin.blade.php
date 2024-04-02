@extends('layouts.app')

@section('content')

    <style>
        /* Custom styling for section buttons */
        .section-btn {
            margin-top: 5px; /* Adjust top margin */
            margin-bottom: 5px; /* Adjust bottom margin */
            padding: 10px 20px; /* Adjust padding */
            font-size: 16px; /* Adjust font size */
            border-radius: 10px; /* Rounded corners */
        }


        /* Custom styling for active section button */
        #collegesBtn.active {
            background-color: #007bff; /* Blue background color for active button */
            border-color: #007bff; /* Blue border color for active button */
            color: white; /* White text color for active button */
        }

        #departmentsBtn.active {
            background-color: #6c757d; /* Grey background color for active button */
            border-color: #6c757d; /* Grey border color for active button */
            color: white; /* White text color for active button */
        }

        #uniformsBtn.active {
            background-color: #28a745; /* Green background color for active button */
            border-color: #28a745; /* Green border color for active button */
            color: white; /* White text color for active button */
        }

    </style>
    <div class="container mt-4">
        <h1 class="text-right">لوحة التحكم</h1>

        <!-- Navigation Buttons -->
        <div class="text-right mb-3" style="margin-right: 15px;">
            <button id="collegesBtn" class="btn btn-outline-primary section-btn mr-2" onclick="showSection('colleges')">الكليات</button>
            <button id="departmentsBtn" class="btn btn-outline-secondary section-btn mr-2" onclick="showSection('departments')">الأقسام</button>
            <button id="uniformsBtn" class="btn btn-outline-success section-btn" onclick="showSection('uniforms')">الزي الرسمي</button>
        </div>



        <!-- Colleges Section -->
        <div id="colleges" class="admin-section" style="display: none;">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between ps-5 pe-5">
                    <h2>الكليات</h2>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addCollegeModal">إضافة كلية</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>اسم الكلية</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colleges as $college)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $college->name }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCollegeModal{{$college->id}}">حذف</button>
                                </td>
                            </tr>
                            <!-- Delete Confirmation Modal for College -->
                            <div class="modal fade" id="deleteCollegeModal{{$college->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteCollegeModal{{$college->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteCollegeModal{{$college->id}}Label">تأكيد الحذف</h5>
                                        </div>
                                        <div class="modal-body">
                                            هل أنت متأكد أنك تريد حذف هذه الكلية؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                            <form action="{{ route('admin.colleges.delete', $college->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Departments Section -->
        <div id="departments" class="admin-section" style="display: none;">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between ps-5 pe-5">
                    <h2>الأقسام</h2>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#addDepartmentModal">إضافة قسم</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>اسم القسم</th>
                            <th>الكلية</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->college->name }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDepartmentModal{{$department->id}}">حذف</button>
                                </td>
                            </tr>
                            <!-- Delete Confirmation Modal for Department -->
                            <div class="modal fade" id="deleteDepartmentModal{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteDepartmentModal{{$department->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteDepartmentModal{{$department->id}}Label">تأكيد الحذف</h5>
                                        </div>
                                        <div class="modal-body">
                                            هل أنت متأكد أنك تريد حذف هذا القسم؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                            <form action="{{ route('admin.departments.delete', $department->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Uniforms Section -->
        <div id="uniforms" class="admin-section" style="display: none;">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between ps-5 pe-5">
                    <h2>الزي الرسمي</h2>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addUniformModal">إضافة زي</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>اسم الزي</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($uniforms as $uniform)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $uniform->item }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUniformModal{{$uniform->id}}">حذف</button>
                                </td>
                            </tr>
                            <!-- Delete Confirmation Modal for Uniform -->
                            <div class="modal fade" id="deleteUniformModal{{$uniform->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUniformModal{{$uniform->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteUniformModal{{$uniform->id}}Label">تأكيد الحذف</h5>
                                        </div>
                                        <div class="modal-body">
                                            هل أنت متأكد أنك تريد حذف هذا الزي؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                            <form action="{{ route('admin.uniforms.delete', $uniform->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @include('admin.partials.add_college_modal')
    @include('admin.partials.add_department_modal')
    @include('admin.partials.add_uniform_modal')


        <script>


            document.addEventListener('DOMContentLoaded', function() {
                // Retrieve the active section from local storage, if available
                const activeSection = localStorage.getItem('activeSection');

                // Show the active section or default to 'colleges' if not found
                showSection(activeSection || 'colleges');
            });

            function showSection(section) {
                // Store the active section in local storage
                localStorage.setItem('activeSection', section);

                // Hide all sections
                document.querySelectorAll('.admin-section').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.getElementById(section).style.display = 'block';

                // Update button styles
                document.querySelectorAll('.section-btn').forEach(function(btn) {
                    btn.classList.remove('active', 'btn-primary');
                    btn.classList.add('btn-outline-primary');
                });

                // Add 'active' class and change to 'btn-primary' for the active section button
                document.getElementById(section + 'Btn').classList.add('active', 'btn-primary');
                document.getElementById(section + 'Btn').classList.remove('btn-outline-primary');
            }
        </script>

@endsection
