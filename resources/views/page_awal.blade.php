{{-- Peter Christian Erastus - 5026231138 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Awal - Tutor App</title>
    <style>
        body, html { margin:0; padding:0; height:100%; display:flex; justify-content:center; align-items:center; background: #e0e7ff; font-family: Arial, sans-serif;}
        .container { width: 100%; max-width: 400px; padding:20px; background:white; border-radius:20px; box-shadow:0 4px 15px rgba(0,0,0,0.2); text-align:center;}
        button { width:100%; padding:10px; margin-top:10px; background:#1e3a8a; color:white; border:none; border-radius:5px; cursor:pointer; }
        button:hover { background:#3749b0; }
        .link { margin-top:10px; }
        .link a { color:#1e3a8a; text-decoration:none; font-weight:bold; }
    </style>
</head>

<body>
    <div class="container">
        <h2>TUTOR</h2>
        <button onclick="location.href='/register'">Create Account</button>
        <div class="link">
            Already have an account? <a href="/login">Login</a>
        </div>
    </div>
</body>

</html>
