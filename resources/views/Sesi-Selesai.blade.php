@extends ('layout.Mobile-View')
@section('page-style')
<style>
    .notif-wrapper {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .notif-card {
        background-image: url('{{ asset('sesidone.png') }}');
        background-size: cover;
        background-position: center;
        padding: 35px 25px;
        border-radius: 22px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        height:33%;
        width: auto;
        max-width: 300px;
    }

    .notif-text {
        padding-top: 90px;
        font-size: 18px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 25px;
    }

    .notif-button {
        width: 100%;
        background-color: #112712;
        border: none;
        border-radius: 14px;
        padding: 12px 0;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .notif-button:hover {
        background-color: #45a049;
    }
</style>
@endsection

@section('content')

<div class="notif-wrapper">
    <div class="notif-card">
        <div class="notif-text">Sesi Tutor Telah Selesai</div>
        <button class="notif-button" onclick="window.location.href='/aktivitas-lampau'">
            Selesai
        </button>

    </div>
</div>

@endsection
