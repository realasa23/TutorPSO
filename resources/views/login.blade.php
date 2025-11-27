{{-- Peter Christian Erastus - 5026231138 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tutor App</title>
    <style>
        body, html { margin:0; padding:0; height:100%; display:flex; justify-content:center; align-items:center; background: #e0e7ff; font-family: Arial, sans-serif;}
        .container { width: 100%; max-width: 400px; padding:20px; background:white; border-radius:20px; box-shadow:0 4px 15px rgba(0,0,0,0.2);}
        h2 { text-align:center; color:#1e3a8a;}
        input { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc;}
        button { width:100%; padding:10px; margin-top:10px; background:#1e3a8a; color:white; border:none; border-radius:5px; cursor:pointer; }
        button:hover { background:#3749b0; }
        .link { text-align:center; margin-top:10px; }
        .link a { color:#1e3a8a; text-decoration:none; font-weight:bold; }
        .forgot { text-align:right; margin-top:5px; }
        .errors { color:#b91c1c; margin-bottom:10px; }
        .success { color:#065f46; margin-bottom:10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="errors">
                <ul style="margin:0; padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="forgot">
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Log in</button>
        </form>

        <div class="link">
            Don't have an account yet? <a href="/register">Register</a>
        </div>
    </div>
</body>
</html>
