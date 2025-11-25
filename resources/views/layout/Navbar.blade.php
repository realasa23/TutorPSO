<style>
    .bottom-nav {
        width: 100%;
        display: flex;
        justify-content: center;
        padding-top: 20px;
        padding-bottom: 20px;
        background: #ffffff;
    }

    .bottom-nav-inner {
        background: #AFC2FF;
        width: 350px;
        height: 55px;
        padding: 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 50px;
    }

    .nav-item {
        text-decoration: none;
        color: white;
        text-align: center;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.2;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 50px;
    }

    .nav-item img {
        width: 28px;
        height: 28px;
        filter: brightness(0) invert(1);
        margin-bottom: 4px;
    }
</style>

<div class="bottom-nav">
    <div class="bottom-nav-inner">

        {{-- HOME --}}
        <a href="/beranda" class="nav-item">
            <img src="{{ asset('icons/home.png') }}" alt="Beranda">
        </a>

        {{-- AKTIVITAS --}}
        <a href="/aktivitas" class="nav-item">
            <img src="{{ asset('icons/activity.png') }}" alt="Aktivitas">
        </a>

        {{-- PROFILE (FIX ROUTE) --}}
        <a href="{{ route('profile') }}" class="nav-item">
            <img src="{{ asset('icons/profile.png') }}" alt="Profil">
        </a>

    </div>
</div>
