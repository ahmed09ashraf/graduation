<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الإدارة</title>
    <!-- Include Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('page-style')

</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark px-5">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ request()->routeIs('reservations.index') ? 'active' : '' }}" aria-current="page" href="{{ route('reservations.index') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <!-- Add data attributes for PIN and the admin route -->
                    <a class="nav-link fs-5" href="#" data-pin="1234" data-route="{{ route('admin') }}" onclick="checkPIN(this)">لوحة التحكم</a>
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

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    function checkPIN(element) {
        // Retrieve the correct PIN and route from data attributes
        var correctPIN = element.getAttribute('data-pin');
        var route = element.getAttribute('data-route');

        // Prompt the user to enter the PIN
        var enteredPIN = prompt("Please enter the PIN:");

        // Navigate based on whether the entered PIN is correct
        if (enteredPIN === correctPIN) {
            window.location.href = route;
        } else {
            alert("Incorrect PIN.");
            window.location.href = "{{ route('reservations.index') }}";
        }
    }
</script>
@yield('page-script') <!-- Section for page-specific scripts -->

</body>
</html>
