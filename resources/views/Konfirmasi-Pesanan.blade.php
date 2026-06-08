{{-- Nailah Adlina - 5026231068 --}}
@extends ('layout.Mobile-View')
@section('page-style')
<style>
    .mobile-scroll {
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        min-height: 100% !important;
    }

    .notif-wrapper {
        flex: 1 !important; 
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    /* 2. Buat animasi masuk (muncul dari bawah ke atas dengan efek bounce) */
    @keyframes popIn {
        0% {
            opacity: 0;
            transform: translateY(30px) scale(0.9);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* 3. Terapkan animasi ke kartu */
    .notif-card {
        background-image: url('{{ asset('sesidone.png') }}');
        background-size: cover;
        background-position: center;
        padding: 35px 25px;
        border-radius: 22px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        width: 100%;
        max-width: 300px;
        animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
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
        <div class="notif-text">Sesi Tutor Berhasil Dipesan</div>
        <button class="notif-button" onclick="window.location.href='/aktivitas'">
            Selesai
        </button>
    </div>
</div>
@endsection
