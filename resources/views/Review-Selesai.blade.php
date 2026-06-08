{{-- Michelle Lea Amanda - 5026231214  --}}
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

        /* 2. Wrapper baru agar elemen berada persis di tengah */
        .review-wrapper {
            flex: 1 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        /* 3. Animasi pop-in (bounce) */
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

        /* 4. Update kartu agar mendukung animasi dan ukuran yang pas */
        .success-card {
            background-image: url('{{ asset('bg-callout review done.png') }}');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-color: transparent;
            border-radius: 30px;
            padding: 60px 30px 40px 30px;
            width: 100%;
            max-width: 300px; /* Batasi lebar maksimal agar terlihat proporsional */
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            border: none;
            /* Panggil animasi di sini */
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .check-circle {
            width: 100px;
            height: 100px;
            background-color: #ffffff54;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .check-img {
            width: 70px;
            height: auto;
            object-fit: contain;
        }

        .success-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 18px;
            color: #333;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        .btn-selesai {
            background-color: #312E49;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 0;
            width: 100%;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-selesai:hover {
            opacity: 0.9;
        }
    </style>
@endsection

@section('content')
    {{-- Bungkus kartu dengan review-wrapper --}}
    <div class="review-wrapper">
        <div class="success-card">
            <div class="check-circle">
                <img src="{{ asset('icon centang.png') }}" class="check-img" alt="Sukses">
            </div>
            <p class="success-text">
                Terimakasih Atas<br>Tanggapan mu
            </p>
            <a href="{{ route('aktivitas', ['tab' => 'lampau']) }}" class="w-100 text-decoration-none">
                <button class="btn-selesai">Selesai</button>
            </a>
        </div>
    </div>
@endsection