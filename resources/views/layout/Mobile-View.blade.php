<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tutor' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        body {
            background-color: #f3f4f6;
            /* abu-abu muda */
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .mobile-container {
            width: 393px;
            /* ukuran iPhone 12 */
            height: 852px;
            background-image: url('{{ asset('bg-image.png') }}');
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .mobile-container::-webkit-scrollbar {
            width: 0;
        }

        ::placeholder {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            color: #9ca3af;
            /* optional: soft gray */
        }

        .header-bg {
            padding-top: 30px;
            padding-bottom: 1rem;
            position: relative;
            top: 0;
            z-index: 1020;
        }

        .page-title {
            font-weight: bold;
            margin: 0;
            font-size: 24px;
        }

        .btn-back-icon {
            color: #212529 !important;
        }


    </style>
</head>

<body>
    <div class="mobile-container">
        @yield('content')
    </div>
</body>

</html>
