<style>
    .bottom-nav {
        bottom: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        padding-top: 0px;
        padding-bottom: 25px;
        background-color: #fff;
        z-index: 100;
    }


    .bottom-nav-inner {
        background: #AFC2FF;
        width: 350px;
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
        text-align: center;
        font-size: 13px;
        font-weight: 500;
        line-height: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 50px;
    }

    .nav-item img {
        width: 24px;
        height: 24px;
        margin-bottom: 4px;
    }
</style>

<div class="bottom-nav">
    <div class="bottom-nav-inner">

        <a href="/home" class="nav-item">
            <img src="{{ asset('icons/home.png') }}" alt="Beranda">
        </a>

        <a href="/aktivitas" class="nav-item">
            <img src="{{ asset('icons/activity.png') }}" alt="Aktivitas">
        </a>

        <a href="/profile" class="nav-item">
            <img src="{{ asset('icons/profile.png') }}" alt="Profil">
        </a>

    </div>
</div>
