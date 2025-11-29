{{-- Peter Christian Erastus - 5026231138 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tutor App</title>
    <style>
        h1 { text-align:left; color:#343446; font-size: 48px}
        h2 { text-align:left; color:#343446; font-size: 16px; margin-bottom: -3px;}
        input { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc;}
        .errors { color:#b91c1c; margin-bottom:10px; }
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
        .container { width: 90%; max-width: 393px; padding:20px; border-radius:20px; margin-top:30%; text-align:center;}
        .form { width: 90%; max-width: 393px; border-radius:20px; text-align:center;}
        .input { border-color: #343446; border-width: 2px; }
        button { width:100%; padding:10px;margin-bottom: 20px; margin-top:10px; background:#343446; color:white; border:none; border-radius:22px; cursor:pointer; box-shadow:0 4px 15px rgba(0,0,0,0.2);}
        button:hover { background:#575778; }
        .link { margin-top:20px; text-decoration:none; color: #343446;}
        .link a { color:#343446; text-decoration:none; font-weight:bold; }
        .link a:hover { color: #575778; text-decoration:none;}
        .mobile-container {
            width: 393px;
            height: 852px;
            background:#B8CAFD;
            background-image: url('{{ asset('Register BG.png') }}');
            background-size: cover;
            background-position: top center;
            border-radius: 22px;
            box-shadow: 0 0 22px rgba(0, 0, 0, 0.12);
            overflow-y: hidden;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        <div class="container">
            <h1>Register</h1>

            @if($errors->any())
                <div class="errors">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST" class="form">
                @csrf
                <h2>Username <a style="color: #F94931">*</a></h2>
                <input class="input" type="text" name="name" placeholder="Masukkan Username Anda" value="{{ old('name') }}" required>
                <h2>Email <a style="color: #F94931">*</a></h2>
                <input class="input" type="email" name="email" placeholder="Massukkan Email Anda" value="{{ old('email') }}" required>
                <h2>Password <a style="color: #F94931">*</a></h2>
                <input class="input" type="password" name="password" placeholder="Masukkan Password Anda" required>
                <h2>Konfirmasi Password <a style="color: #F94931">*</a></h2>
                <input class="input" type="password" name="password_confirmation" placeholder="Konfirmasi Password Anda" required>
                <h2>Nomor Telepon <a style="color: #F94931">*</a></h2>
                <input class="input" type="text" name="phone" placeholder="87xxxxxxxxx" value="{{ old('phone') }}">
                <div class="container" style="margin: auto">
                    <button type="submit">Create Account</button>
                    Already have an account? <a href="/login" style="text-decoration: none; color: #566CD8;">Login</a>
                </div>
            </form>
        </div>


    </div>
</body>
</html>
