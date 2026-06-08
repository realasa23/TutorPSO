{{-- Peter Christian Erastus - 5026231138 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .welcome-wrapper {
            flex: 1 !important;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            padding: 30px;
            height: 100%;
        }

        .logo-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* 1. Logo diperbesar */
        .logo {
            width: 200px; 
            animation: fadeIn 0.8s ease-out;
        }

        .bottom-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-out;
        }

        /* 2. Tombol dibuat lebih kecil/compact */
        button {
            width: 85%; /* Dibuat sedikit lebih ramping */
            padding: 12px 0; /* Padding vertikal dikurangi */
            background: #343446;
            color: white;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(52, 52, 70, 0.2);
            transition: all 0.3s ease;
        }

        /* 3. Efek hover untuk tombol */
        button:hover {
            background: #4a4a63;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 52, 70, 0.4);
        }

        .link {
            margin-top: 15px;
            font-size: 14px;
            color: #ffffff;
            text-align: center;
        }

        /* 4. Efek hover untuk link Login */
        .link a {
            color: #343446;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .link a:hover {
            color: #7a7a9e;
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
@endsection

@section('content')
    <div class="welcome-wrapper">
        <div class="logo-container">
            <img src="/Tutor Logo.png" class="logo" alt="Logo">
        </div>
        
        <div class="bottom-content">
            <button onclick="location.href='/register'">Create Account</button>
            <div class="link">
                Already have an account?
                <a href="/login">Login</a>
            </div>
        </div>
    </div>
@endsection 