@extends('layouts.app')

@section('page-style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1 class="text-right">إدارة الحجوزات</h1>


        <button id="showListButton" class="btn btn-outline-success section-btn mr-2">عرض القائمة</button>
        <button id="addReservationButton" class="btn btn-outline-primary section-btn mr-2">حجز جديد</button>

        <!-- Reservation List Section -->
        <div id="reservationList" class="hidden-section">
            <table class="smart-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>اسم الطالب</th>
                    <th>الكلية</th>
                    <th>القسم</th>
                    <th>الزي</th>
                    <th>تيكيت الطالب</th>
                    <th>عدد المرافقين</th>
                    <th>تيكيت المرافق</th>
                    <th>الإجمالي</th>
                    <th>تعديل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->college->name }}</td>
                        <td>{{ $student->department->name }}</td>
                        <td>
                            @foreach ($student->uniforms as $uniform)
                                <span class="custom-badge">{{ $uniform->item }}</span>
                            @endforeach
                        </td>
                        <td>{{ $student->student_price }}</td>
                        <td>{{ $student->family_members}}</td>
                        <td>{{ $student->member_price }}</td>
                        <td>{{ $student->total_price }}</td>
                        <td >
                            <a href="{{ route('reservations.edit', $student->id) }}" class="btn-edit ms-2">
                                <i>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                </i>
                            </a>
                            <a class="btn-delete" data-id="{{ $student->id }}" data-toggle="modal" data-target="#deleteConfirmationModal">
                                <i>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="red"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </i>
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">تأكيد الحذف</h5>
                        </div>
                        <div class="modal-body">
                            هل متأكد من حذف هذا الحجز ؟
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">خروج</button>
                            <form id="deleteForm" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- New Reservation Form Section -->
        <div id="newReservationForm" class="hidden-section mt-5 mb-5 px-5">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="student_name">اسم الطالب:</label>
                        <input type="text" id="student_name" name="student_name" required>
                    </div>

                    <div class="custom-dropdown">
                        <label for="college_id">الكلية:</label>
                        <select id="college_id" name="college_id" required>
                            <option value="" disabled selected>{{ 'اختر الكلية' }}</option>
                            @foreach($colleges as $college)
                                <option value="{{ $college->id }}">{{ $college->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="custom-dropdown">
                        <label for="department_id">القسم:</label>
                        <select id="department_id" name="department_id" required>
                            <option value="" disabled selected>{{ 'اختر القسم' }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group custom-multiselect">
                        <label for="uniform">الزي:</label>
                        <div class="multiselect-container">
                            <div class="selected-options"></div>
                            <div class="options-list">
                                @foreach($uniformsList as $uniform)
                                    <label>
                                        <input type="checkbox" name="uniform[]" value="{{ $uniform->id }}">
                                        {{ $uniform->item }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="student_price">سعر حجز الطالب:</label>
                        <input type="number" id="student_price" name="student_price" required oninput="calculateTotalPrice()">
                    </div>

                    <div class="form-group">
                        <label for="family_members">عدد المرافقين:</label>
                        <input type="number" id="family_members" name="family_members" oninput="calculateTotalPrice()">
                    </div>

                    <div class="form-group">
                        <label for="member_price">سعر حجز المرافق:</label>
                        <input type="number" id="member_price" name="member_price" oninput="calculateTotalPrice()">
                    </div>

                    <div class="form-group">
                        <label for="total_price">السعر الإجمالي:</label>
                        <input type="number" id="total_price" name="total_price" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">إرسال</button>
                </form>

        </div>


@endsection

@section('page-script')
    <script>
        $('.section-btn').click(function() {
            $('.section-btn').removeClass('active');
            $(this).addClass('active');
        });

        $(document).ready(function() {
            $('.btn-delete').click(function() {
                var studentId = $(this).data('id');
                var actionUrl = "{{ url('delete') }}/" + studentId; // Adjust if the URL structure is different
                $('#deleteForm').attr('action', actionUrl);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const showListButton = document.getElementById('showListButton');
            const addReservationButton = document.getElementById('addReservationButton');
            const reservationList = document.getElementById('reservationList');
            const newReservationForm = document.getElementById('newReservationForm');

            // Check local storage and open the reservation list if needed
            if (localStorage.getItem('showReservationList') === 'true') {
                reservationList.style.maxHeight = reservationList.scrollHeight + "px";
                newReservationForm.style.maxHeight = "0";
            }


            showListButton.addEventListener('click', function() {
                reservationList.style.maxHeight = reservationList.scrollHeight + "px";
                newReservationForm.style.maxHeight = "0";
                localStorage.setItem('showReservationList', 'true');

            });

            addReservationButton.addEventListener('click', function() {
                newReservationForm.style.maxHeight = newReservationForm.scrollHeight + "px";
                reservationList.style.maxHeight = "0";
                localStorage.setItem('showReservationList', 'false');
            });
        });

        $(document).ready(function() {
            $('#college_id').change(function() {
                var collegeId = $(this).val();
                if (collegeId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get.departments', ['college' => ':collegeId']) }}".replace(':collegeId', collegeId),
                        success: function(data) {
                            $('#department_id').empty();
                            $.each(data, function(key, value) {
                                $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#department_id').empty();
                }
            });
        });

        // Toggle selected options
        document.querySelectorAll('.options-list input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var selectedOptions = document.querySelector('.selected-options');
                if (this.checked) {
                    var selectedOption = document.createElement('div');
                    selectedOption.textContent = this.nextElementSibling.textContent;
                    selectedOptions.appendChild(selectedOption);
                } else {
                    var selectedText = this.nextElementSibling.textContent;
                    selectedOptions.querySelectorAll('div').forEach(function(option) {
                        if (option.textContent === selectedText) {
                            option.remove();
                        }
                    });
                }
            });
        });

        function calculateTotalPrice() {
            var studentPrice = parseFloat(document.getElementById('student_price').value) || 0;
            var familyMembers = parseInt(document.getElementById('family_members').value) || 0;
            var memberPrice = parseFloat(document.getElementById('member_price').value) || 0;
            var totalPrice = studentPrice + (familyMembers * memberPrice);
            document.getElementById('total_price').value = totalPrice.toFixed(2);
        }
    </script>
@endsection
