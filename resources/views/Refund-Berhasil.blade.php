{{-- Michelle Lea Amanda - 5026231214  --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .success-wrapper {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .success-card {
            background-color: white;
            border-radius: 35px;
            padding: 50px 30px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .success-title {
            font-size: 24px;
            font-weight: 800;
            color: #000;
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .success-subtitle {
            font-size: 22px;
            font-weight: 800;
            color: #86CD95;
            margin-bottom: 10px;
        }

        .refund-amount {
            font-size: 18px;
            font-weight: 600;
            color: #000;
            margin-bottom: 10px;
        }

        .icon-container {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px 0 50px 0;
        }

        .glow-effect {
            position: absolute;
            width: 140px;
            height: 140px;
            background: radial-gradient(circle, rgba(255, 249, 196, 0.8) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .success-icon {
            width: 170px;
            height: auto;
            transform: rotate(-5deg);
            position: relative;
            z-index: 1;
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
            <h2 class="success-title">Pengajuan Refund</h2>
            <h3 class="success-subtitle">Berhasil!</h3>

            <p class="refund-amount">
                Rp {{ number_format($harga, 0, ',', '.') }}
            </p>

            <img src="{{ asset('Puzzle Icon.png') }}" class="success-icon" alt="Refund Berhasil">

            <a href="/profile/laporan" class="w-100 text-decoration-none">
                <button class="btn-done">Selesai</button>
            </a>
        </div>
    </div>
@endsection
