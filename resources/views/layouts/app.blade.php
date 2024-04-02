<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الإدارة</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark px-5">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active fs-5" aria-current="page" href="{{route('reservations.index')}}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5" href="{{route('admin')}}">لوحة التحكم</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- jQuery and Bootstrap Bundle with Popper.js -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{--<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>--}}

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>
