<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.6.0/css/all.css"> --}}
</head>


<body class="container">
    <header class="header">
        <h1 class="header-ttl">mogitate</h1>
    </header>
    
    <main class="main">
        @yield('content')
    </main>
</body>

</html>

