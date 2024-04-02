@extends('layouts.app')

@section('content')
    <style>
        .hidden-section {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
            padding: 0 15px;
        }

         .form-group label {
             font-weight: bold;
             margin-bottom: 5px; /* Add margin under the labels */
             font-size: 1.2rem; /* Increase font size for better readability */
         }

    </style>

    <div class="container">
        <h1 class="text-right">إدارة الحجوزات</h1>

        <button id="showListButton" class="btn btn-primary mb-3">عرض القائمة</button>
        <button id="addReservationButton" class="btn btn-success mb-3">حجز جديد</button>

        <!-- Reservation List Section -->
        <div id="reservationList" class="hidden-section">
            <table class="table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>اسم الطالب</th>
                    <th>الكلية</th>
                    <th>القسم</th>
                    <th>الزي</th>
                    <th>سعر حجز الطالب</th>
                    <th>عدد المرافقين</th>
                    <th>سعر حجز المرافق</th>
                    <th>الإجمالي</th>
                    <th>تعديل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->student_name }}</td>
                        <td>{{ $reservation->college->name }}</td>
                        <td>{{ $reservation->department->name }}</td>
                        <td>{{ $reservation->uniform }}</td>
                        <td>{{ $reservation->student_price }}</td>
                        <td>{{ $reservation->number_of_companions }}</td>
                        <td>{{ $reservation->companion_price }}</td>
                        <td>{{ $reservation->total_price }}</td>
                        <td>
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary">تعديل</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- New Reservation Form Section -->
        <div id="newReservationForm" class="hidden-section">
            <form action="{{ route('reservations.store') }}" method="POST" class="my-4 p-4 border rounded-lg">
                @csrf

                <!-- Student Name -->
                <div class="form-group mb-3">
                    <label for="student_name">اسم الطالب:</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" required>
                </div>

                <!-- College -->
                <div class="form-group mb-3">
                    <label for="college_id">الكلية:</label>
                    <select class="form-control" id="college_id" name="college_id" required>
                        @foreach($colleges as $college)
                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Department -->
                <div class="form-group mb-3">
                    <label for="department_id">القسم:</label>
                    <select class="form-control" id="department_id" name="department_id" required>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Uniform -->
                <div class="form-group mb-3">
                    <label for="uniform">الزي:</label>
                    <input type="text" class="form-control" id="uniform" name="uniform" required>
                </div>

                <!-- Student Price -->
                <div class="form-group mb-3">
                    <label for="student_price">سعر حجز الطالب:</label>
                    <input type="number" class="form-control" id="student_price" name="student_price" required>
                </div>

                <!-- Number of Companions -->
                <div class="form-group mb-3">
                    <label for="number_of_companions">عدد المرافقين:</label>
                    <input type="number" class="form-control" id="number_of_companions" name="number_of_companions">
                </div>

                <!-- Companion Price -->
                <div class="form-group mb-3">
                    <label for="companion_price">سعر حجز المرافق:</label>
                    <input type="number" class="form-control" id="companion_price" name="companion_price">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">إرسال</button>
            </form>


        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const showListButton = document.getElementById('showListButton');
                const addReservationButton = document.getElementById('addReservationButton');
                const reservationList = document.getElementById('reservationList');
                const newReservationForm = document.getElementById('newReservationForm');

                showListButton.addEventListener('click', function() {
                    reservationList.style.maxHeight = reservationList.scrollHeight + "px";
                    newReservationForm.style.maxHeight = "0";
                });

                addReservationButton.addEventListener('click', function() {
                    newReservationForm.style.maxHeight = newReservationForm.scrollHeight + "px";
                    reservationList.style.maxHeight = "0";
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

        </script>


@endsection
