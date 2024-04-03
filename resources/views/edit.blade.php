@extends('layouts.app')

@section('page-style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1 class="text-right">تعديل الحجز</h1>

        <div id="editReservationForm" class="mt-5 mb-5 px-5">
            <form action="{{ route('reservations.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Specify the method to be used for the form (PUT for update) --}}

                <div class="form-group">
                    <label for="student_name">اسم الطالب:</label>
                    <input type="text" id="student_name" name="student_name" value="{{ $student->student_name }}" required>
                </div>

                <div class="form-group">
                    <label for="college_id">الكلية:</label>
                    <select id="college_id" name="college_id" required>
                        @foreach($colleges as $college)
                            <option value="{{ $college->id }}" {{ $student->college_id == $college->id ? 'selected' : '' }}>{{ $college->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="department_id">القسم:</label>
                    <select id="department_id" name="department_id" required>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ $student->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
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
                                    <input type="checkbox" name="uniform[]" value="{{ $uniform->id }}" {{ $student->uniforms->contains($uniform->id) ? 'checked' : '' }}>
                                    {{ $uniform->item }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="student_price">سعر حجز الطالب:</label>
                    <input type="number" id="student_price" name="student_price" value="{{ $student->student_price }}" required oninput="calculateTotalPrice()">
                </div>

                <div class="form-group">
                    <label for="family_members">عدد المرافقين:</label>
                    <input type="number" id="family_members" name="family_members" value="{{ $student->family_members }}" oninput="calculateTotalPrice()">
                </div>

                <div class="form-group">
                    <label for="member_price">سعر حجز المرافق:</label>
                    <input type="number" id="member_price" name="member_price" value="{{ $student->member_price }}" oninput="calculateTotalPrice()">
                </div>

                <div class="form-group">
                    <label for="total_price">السعر الإجمالي:</label>
                    <input type="number" id="total_price" name="total_price" value="{{ $student->total_price }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary btn-block">تحديث</button>
            </form>
        </div>
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
