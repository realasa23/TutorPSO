<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tutor' }}</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ======== BODY WRAPPER ======== */
        body {
            background-color: #f3f4f6;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ======== MOBILE FRAME ======== */
        .mobile-container {
            width: 393px;
            height: 852px;
            background-image: url('{{ asset('bg-image.png') }}');
            background-size: cover;
            background-position: top center;
            border-radius: 22px;
            box-shadow: 0 0 22px rgba(0, 0, 0, 0.12);
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Hilangkan scrollbar */
        .mobile-container::-webkit-scrollbar {
            width: 0;
        }

        ::placeholder {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            color: #9ca3af;
        }

        /* ======== NAVBAR FIXED ======== */
        .navbar-fixed {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 50;
        }

        /* Supaya konten tidak ketutup navbar */
        .content-wrapper {
            padding-bottom: 110px;
        }
    </style>

    @yield('page-style')
</head>

<body>

    <div class="mobile-container">

        {{-- === KONTEN HALAMAN === --}}
        <div class="content-wrapper">
            @yield('content')
        </div>

        {{-- === NAVBAR BAWAH (FIXED) === --}}
        <div class="navbar-fixed">
            @include('layout.Navbar')
        </div>

    </div>

</body>

</html>
