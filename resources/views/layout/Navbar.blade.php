<style>
    .bottom-nav {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        padding-bottom: 20px;
        background-color: #fff;
        z-index: 1000;
    }

    .bottom-nav-inner {
        background: #AFC2FF;
        width: 320px;
        height: 50px;
        padding: 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 50px;
        box-shadow: 0 -4px 10px rgba(30, 40, 80, 0.1);
    }

    .nav-item {
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 50px;
        opacity: 0.55;
        transition: opacity 0.2s;
    }

    .nav-item.active { opacity: 1; }

    .nav-item img {
        width: 24px;
        height: 24px;
    }
</style>

@php
    $path = request()->path();
    $isHome      = $path === 'home';
    $isAktivitas = str_starts_with($path, 'aktivitas');
    $isProfile   = str_starts_with($path, 'profile');
@endphp

<div class="bottom-nav">
    <div class="bottom-nav-inner">
        <a href="/home"      class="nav-item {{ $isHome      ? 'active' : '' }}">
            <img src="{{ asset('icons/home.png') }}"     alt="Beranda">
        </a>
        <a href="/aktivitas" class="nav-item {{ $isAktivitas ? 'active' : '' }}">
            <img src="{{ asset('icons/activity.png') }}" alt="Aktivitas">
        </a>
        <a href="/profile"   class="nav-item {{ $isProfile   ? 'active' : '' }}">
            <img src="{{ asset('icons/profile.png') }}"  alt="Profil">
        </a>
    </div>
</div>