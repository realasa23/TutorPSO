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

        .profile-bg {
            height: 260px;
            background-size: cover;
            background-position: center;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 20px;
        }

        .profile-title {
            font-size: 26px;
            font-weight: 700;
            color: #4a4a4a;
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

        .menu-list {
            text-align: left;
            margin-top: 30px;
            margin-bottom: 300px;
        }

        .menu-item {
            display: flex;
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

        .menu-item.logout {
            color: #ff6b6b;
        }


        .menu-item i:first-child {
            margin-right: 10px;
            color: #9bb0ff;
        }

        .menu-item.logout {
            color: #ff6b6b;
            border-bottom: none;
        }
    </style>
@endsection

@section('content')
    <div class="header-bg">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center justify-content-center">
                <h3 class="page-title">Profile</h3>
                <div style="width:24px;"></div>
            </div>
        </div>
    </div>

    <div class="profile-content">
        {{-- FOTO + NAMA --}}
        <div class="profile-main profile-row">
            <div class="photo-wrapper">
                <img id="profilePreview" src="{{ asset($user->fotoprofil ?? 'default-profile.png') }}" class="profile-photo">
                <label class="camera-btn">
                    <i class="bi bi-camera"></i>
                    <input type="file" name="fotoprofil" id="photoInput" accept="image/*" hidden>
                </label>

            </div>

            <h3 class="profile-name">{{ $user->name ?? $user->username ?? 'User' }}</h3>
            <p class="profile-email">{{ $user->email }}</p>
        </div>

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
            };
            reader.readAsDataURL(file);
        });
    </script>


@endsection


@section('navbar')
    @include('layout.Navbar')
@endsection