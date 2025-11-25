@extends('layout.Mobile-View')

@section('page-style')
<style>
    .profile-header {
        background: linear-gradient(135deg, #c9d6ff, #e2e2ff);
        padding: 40px 20px 60px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        text-align: center;
    }
    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        margin-top: -40px;
    }
    .profile-name {
        font-weight: 700;
        font-size: 20px;
        margin-top: 15px;
    }
    .profile-email {
        font-size: 14px;
        color: #555;
        margin-bottom: 20px;
    }
    .menu-card {
        background: white;
        padding: 18px 20px;
        border-radius: 15px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0px 1px 5px rgba(0,0,0,0.08);
    }
    .menu-label {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 15px;
        font-weight: 600;
    }
    .logout-btn {
        color: #e06464;
        font-weight: 700;
    }
</style>
@endsection

@section('content')

<div class="profile-header">
    <h3 class="text-white fw-bold">Profile</h3>
</div>

<div class="container mt-4">

    <div class="text-center">
        <img src="/foto-tutor2.jpg" class="profile-photo">
        <div class="profile-name">Sasha</div>
        <div class="profile-email">sahahahahaha@gmail.com</div>
    </div>

    {{-- Menu --}}
    <div class="mt-3">
        <div class="menu-card">
            <div class="menu-label">
                <i class="fa fa-user"></i> Personal Data
            </div>
            <i class="fa fa-chevron-right"></i>
        </div>

        <div class="menu-card">
            <div class="menu-label">
                <i class="fa fa-heart"></i> Your Favorites
            </div>
            <i class="fa fa-chevron-right"></i>
        </div>

        <div class="menu-card">
            <div class="menu-label">
                <i class="fa fa-bell"></i> Notification
            </div>
            <i class="fa fa-chevron-right"></i>
        </div>

        <div class="menu-card">
            <div class="menu-label">
                <i class="fa fa-gear"></i> Settings
            </div>
            <i class="fa fa-chevron-right"></i>
        </div>

        <div class="menu-card">
            <div class="menu-label">
                <i class="fa fa-warning"></i> Laporan
            </div>
            <i class="fa fa-chevron-right"></i>
        </div>

        <div class="menu-card">
            <div class="menu-label logout-btn">
                <i class="fa fa-sign-out"></i> Logout
            </div>
        </div>
    </div>

</div>

@endsection
