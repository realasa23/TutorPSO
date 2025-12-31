{{-- Peter Christian Erastus - 5026231138 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        h1 {
            text-align: left;
            color: #343446;
            font-size: 48px;
        }

        h2 {
            text-align: left;
            color: #343446;
            font-size: 16px;
            margin-bottom: -3px;
        }

        .input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 2px solid #343446;
        }

        .errors {
            color: #b91c1c;
            margin-bottom: 10px;
            text-align: left;
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

        .container {
            width: 90%;
            max-width: 393px;
            margin: auto;
            padding-top: 40%;
            text-align: center;
        }

        .form {
            margin-top: 20px;
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1>Login</h1>
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul style="padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST" class="form">
            @csrf
            <h2>Email <span style="color:#F94931">*</span></h2>
            <input class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

            <h2>Password <span style="color:#F94931">*</span></h2>
            <input class="input" type="password" name="password" placeholder="Password" required>

            <button type="submit">Log in</button>

            <div style="margin-top:15px; text-align:center;">
                Don't have an account yet?
                <a href="/register" style="text-decoration:none; color:#566CD8;">Register</a>
            </div>
        </form>
    </div>
@endsection
