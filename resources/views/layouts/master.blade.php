<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <!-- DataTables JS -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

</head>

<body>
    <div class="wrapper">
        @include('partials.sidebar')
        <div class="main">
            @include('partials.navbar')
            <main class="content p-4">
                @yield('content')
            </main>

            @include('partials.footer')
            <div class="overlay"></div>
        </div>
    </div>
</body>
<script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
@include('sweetalert::alert')

</html>