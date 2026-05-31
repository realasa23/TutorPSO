{{-- Mirna Irawan - 5026221192 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .header-bg {
            height: 260px;
            background-size: cover;
            background-position: center;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 50px;
        }

        .page-title {
            font-weight: bold;
            margin: 0;
            font-size: 24px;
        }

        .profile-content {
            background: #fff;
            margin-top: -100px;
            border-top-left-radius: 35px;
            border-top-right-radius: 35px;
            padding: 30px 20px;
            box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.08);
        }

        .profile-main {
            text-align: center;
            margin-top: -80px;
        }

        .photo-wrapper {
            position: relative;
            width: 130px;
            height: 130px;
            margin: auto;
        }

        .profile-photo {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
        }

        .profile-name {
            font-size: 22px;
            font-weight: 700;
            margin-top: 15px;
            color: #212529;
        }

        .profile-email {
            font-size: 14px;
            color: #6c757d;
            margin-top: -5px;
        }

        .camera-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #b7c5ff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            cursor: pointer;
        }

        .save-photo-btn {
            display: none;
            margin: 12px auto 0;
            padding: 8px 24px;
            background: #343446;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .save-photo-btn:hover {
            background: #575778;
        }

        .menu-list {
            text-align: left;
            margin-top: 30px;
            margin-bottom: 80px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            text-align: left;
            width: 100%;
            background: none;
            border: none;
            padding: 16px 10px;
            font-weight: 600;
            color: #3a3a3a;
            text-decoration: none;
            border-bottom: 1px solid #e8ebff;
        }

        .menu-item i:first-child {
            margin-right: 10px;
            color: #9bb0ff;
        }

        .menu-item.logout {
            color: #ff6b6b;
            border-bottom: none;
        }

        .menu-item.logout i {
            color: #ff6b6b !important;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    <div class="header-bg"></div>

    <div class="profile-content">

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- FORM UPLOAD FOTO --}}
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="profile-main">
                <div class="photo-wrapper">
                    <img id="profilePreview"
                        src="{{ $user->fotoprofil ? asset($user->fotoprofil) : asset('default-profile.png') }}"
                        class="profile-photo"
                        onerror="this.src='{{ asset('default-profile.png') }}'">
                    <label class="camera-btn" title="Ganti foto">
                        <i class="bi bi-camera"></i>
                        <input type="file" name="fotoprofil" id="photoInput" accept="image/*" hidden>
                    </label>
                </div>

                <h3 class="profile-name">{{ $user->name ?? $user->username ?? 'User' }}</h3>
                <p class="profile-email">{{ $user->email }}</p>

                <button type="submit" id="saveFotoBtn" class="save-photo-btn">
                    Simpan Foto
                </button>
            </div>
        </form>

        {{-- MENU --}}
        <div class="menu-list">
            <a href="{{ route('history.laporan') }}" class="menu-item">
                <i class="bi bi-exclamation-triangle"></i> Laporan
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="menu-item logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('photoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('profilePreview').src = event.target.result;
                document.getElementById('saveFotoBtn').style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    </script>

    @include('layout.Navbar')
@endsection