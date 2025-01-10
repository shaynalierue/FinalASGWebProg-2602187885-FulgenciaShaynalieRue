<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Connect Friend</title>
    <style>
        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background: #343a40;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid m-0 p-0 flex-grow-1">
        @include('component.navbar')

        <div>
            @yield('content')
        </div>
    </div>

    @include('layout.footer') 
</body>
</html>
