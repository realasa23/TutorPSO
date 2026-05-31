<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tutor' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        * { box-sizing: border-box; }

        body {
            background-color: #f3f4f6;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .mobile-container {
            width: 393px;
            height: 852px;
            background-image: url('{{ asset('bg-image.png') }}');
            background-size: cover;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .mobile-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .mobile-scroll::-webkit-scrollbar { display: none; }

        /* Padding bawah hanya kalau navbar ada */
        .mobile-scroll.has-navbar { padding-bottom: 80px; }

        ::placeholder {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            color: #9ca3af;
        }
    </style>

    @yield('page-style')
</head>

<body>
    <div class="mobile-container">
        <div class="mobile-scroll @hasSection('navbar') has-navbar @endif">
            @yield('content')
        </div>
        @yield('navbar')
    </div>
</body>

</html>