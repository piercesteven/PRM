<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRM</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <a href="{{ route('dashboard') }}" class="btn btn-info fw-bold">
            Go to dashboard
        </a>
    </div>
</body>
<script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>

</html>