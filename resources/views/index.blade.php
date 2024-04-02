@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-right">قائمة الحجوزات</h1>
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
                    <td>{{ $reservation->student_name }}</td> <!-- Adjust based on your column names -->
                    <td>{{ $reservation->college->name }}</td> <!-- Assuming relationship -->
                    <td>{{ $reservation->department->name }}</td> <!-- Assuming relationship -->
                    <td>{{ $reservation->uniform }}</td> <!-- Adjust based on your column names -->
                    <td>{{ $reservation->student_price }}</td> <!-- Adjust based on your column names -->
                    <td>{{ $reservation->number_of_companions }}</td> <!-- Adjust based on your column names -->
                    <td>{{ $reservation->companion_price }}</td> <!-- Adjust based on your column names -->
                    <td>{{ $reservation->total_price }}</td> <!-- Calculate total -->
                    <td>
                        <!-- Link for edit page, adjust the route as necessary -->
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary">تعديل</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
