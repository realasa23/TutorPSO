<<<<<<< HEAD
{{-- Peter Christian Erastus - 5026231138 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Awal - Tutor App</title>
    <style>
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
        .container { width: 90%; max-width: 393px; padding:20px; border-radius:20px; margin-top:55%; text-align:center;}
        button { width:100%; padding:10px; margin-top:10px; background:#343446; color:white; border:none; border-radius:22px; cursor:pointer; box-shadow:0 4px 15px rgba(0,0,0,0.2);}
        button:hover { background:#575778; }
        .link { margin-top:20px; color: white}
        .link a { color:#343446; text-decoration:none; font-weight:bold; }
        .link a:hover { color: #575778; }
        .mobile-container {
            width: 393px;
            height: 852px;
            background-image: url('{{ asset('bg-image.png') }}');
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
            <img src="/Tutor Logo.png" class="profile-photo">
        </div>
        <div class="container">
            <button onclick="location.href='/register'">Create Account</button>
            <div class="link">
                Already have an account? <a href="/login">Login</a>
            </div>
        </div>
    </div>
=======
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class=table table-striped>
        <tr>
            <th>Nama</th>
        </tr>
        @foreach ($user as $u)
            <tr>
                <td>{{ $u->username }}</td>
            </tr>
        @endforeach

    </table>
>>>>>>> Nailah-Adlina
</body>

</html>
