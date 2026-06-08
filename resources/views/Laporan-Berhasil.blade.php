{{-- Michelle Lea Amanda - 5026231214 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        /* 1. Paksa parent layout menjadi flexbox seukuran kotak HP */
        .mobile-scroll {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            min-height: 100% !important;
        }

        /* 2. Gunakan flex: 1 agar presisi di tengah tanpa melorot */
        .success-wrapper {
            flex: 1 !important; 
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        /* 3. Animasi masuk (efek bounce) */
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

        /* 4. Terapkan animasi dan rapikan lebar kartu */
        .success-card {
            background-color: white;
            border-radius: 30px;
            padding: 30px 20px;
            width: 100%;
            max-width: 320px; /* Batasi lebar agar rapi */
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Panggil animasi di sini */
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .success-title {
            font-size: 24px;
            font-weight: 700;
            color: #000;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .success-icon {
            width: 180px;
            height: auto;
            margin-bottom: 15px;
        }

        .success-desc {
            font-size: 14px;
            color: #333;
            margin-bottom: 25px;
            line-height: 1.5;
            font-weight: 500;
        }

        .btn-done {
            background-color: #312E49;
            color: white;
            border: none;
            border-radius: 15px;
            padding: 14px 0;
            width: 100%;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: opacity 0.2s;
            box-shadow: 0 4px 10px rgba(49, 46, 73, 0.3);
        }

        .btn-done:hover {
            opacity: 0.9;
        }
    </style>
@endsection

@section('content')
    <div class="success-wrapper">
        <div class="success-card">

            @if ($type === 'refund')
                <h2 class="success-title">
                    Ajuan Refund<br>Berhasil Dilakukan!
                </h2>

                <img src="{{ asset('Pending Email.png') }}" class="success-icon" alt="Refund Berhasil">

                <p class="success-desc">
                    Pengajuan refund Anda telah kami terima. Proses verifikasi maksimal 3 hari kerja.
                </p>
            @else
                <h2 class="success-title">
                    Laporan Berhasil<br>Dilakukan!
                </h2>

                <img src="{{ asset('Pending Email.png') }}" class="success-icon" alt="Laporan Berhasil">

                <p class="success-desc">
                    Terima kasih telah melaporkan kendala Anda.<br>
                </p>
            @endif

            <a href="{{ route('history.laporan') }}" class="w-100 text-decoration-none">
                <button class="btn-done">Selesai</button>
            </a>

        </div>
    </div>
@endsection