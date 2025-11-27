{{-- Peter Christian Erastus - 5026231138 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tutor App</title>
    <style>
        body, html { margin:0; padding:0; height:100%; display:flex; justify-content:center; align-items:center; background: #e0e7ff; font-family: Arial, sans-serif;}
        .container { width: 100%; max-width: 400px; padding:20px; background:white; border-radius:20px; box-shadow:0 4px 15px rgba(0,0,0,0.2);}
        h2 { text-align:center; color:#1e3a8a;}
        input { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc;}
        button { width:100%; padding:10px; margin-top:10px; background:#1e3a8a; color:white; border:none; border-radius:5px; cursor:pointer; }
        button:hover { background:#3749b0; }
        .link { text-align:center; margin-top:10px; }
        .link a { color:#1e3a8a; text-decoration:none; font-weight:bold; }
        .errors { color:#b91c1c; margin-bottom:10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>

        @if($errors->any())
            <div class="errors">
                <ul style="margin:0; padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" required>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <input type="text" name="phone" placeholder="Phone (optional)" value="{{ old('phone') }}">
            <button type="submit">Create Account</button>
        </form>

        <div class="link">
            Already have an account? <a href="/login">Login</a>
        </div>
    </div>
</body>
</html>
