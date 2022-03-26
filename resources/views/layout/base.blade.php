<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/alertifyjs/css/alertify.min.css">
    <script src="/alertifyjs/alertify.min.js"></script>
    <link rel="stylesheet" href="/css/app.css">
    <title>LARAVEL TODO APP</title>
</head>
<body>
    @yield('content')
    @if (session()->has('message') && session()->get("type") == 'success')
    <script>alertify.success('{{ session()->get("message") }}');</script>
    @endif
    @if (session()->has('message') && session()->get("type") == 'error')
    <script>alertify.success('{{ session()->get("message") }}');</script>
    @endif
    <script src="/js/app.js"></script>
</body>
</html>