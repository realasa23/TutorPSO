{{-- Peter Christian Erastus - 5026231138 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .container {
            width: 90%;
            max-width: 393px;
            margin: auto;
            padding-top: 35%;
            text-align: center;
        }

        .logo {
            width: 180px;
            margin-bottom: 40px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #343446;
            color: white;
            border: none;
            border-radius: 22px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background: #575778;
        }

        .link {
            margin-top: 20px;
            text-align: center;
        }

        .link a {
            color: #343446;
            text-decoration: none;
            font-weight: bold;
        }

        .link a:hover {
            color: #575778;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <img src="/Tutor Logo.png" class="logo">
    </div>

    <div class="container">
        <button onclick="location.href='/register'">Create Account</button>
        <div class="link">
            Already have an account?
            <a href="/login">Login</a>
        </div>
    </div>
@endsection
