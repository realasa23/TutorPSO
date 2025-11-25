@extends('layout.Mobile-View')

@section('page-style')
    <style>
        .header-bg {
            padding-top: 30px;
            padding-bottom: 1rem;
            position: relative;
            top: 0;
            z-index: 1020;
        }

        .page-title {
            font-weight: bold;
            margin: 0;
            font-size: 24px;
        }

        .content-container {
            flex: 1;
            padding: 20px;
            background: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: -5px;
            position: relative;
            z-index: 5;
        }

        .tab {
            padding: 4px 14px;
            border-radius: 20px;
            border: 1.4px solid;
            font-size: 14px;
            color: #6f6f6f;
            text-decoration: none;
            transition: 0.25s ease;
            display: inline-block;
            margin-bottom: 20px;
        }

        .tab.akan-datang {
            border-color: #ffcfac;
            color: #ffcfac;
        }

        .tab.berlangsung {
            border-color: #bfc7ff;
            color: #bfc7ff;
        }

        .tab.lampau {
            border-color: #FF687F;
            color: #FF687F;
        }

        .tab.active.akan-datang {
            background-color: #ffcfac;
            color: white;
        }

        .tab.active.berlangsung {
            background-color: #bfc7ff;
            color: white;
        }

        .tab.active.lampau {
            background-color: #FF687F;
            color: white;
        }

        .tab:hover {
            opacity: 0.85;
            transform: scale(1.03);
        }

        .card-detail-sesi {
            background-image: url('{{ asset('detailSesi.png') }}');
            background-size: cover;
            background-position: right;
            background-repeat: no-repeat;
            border-radius: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            padding: 14px;
            position: relative;
            display: flex;
            align-items: stretch;
            gap: 10px;
            margin-bottom: 20px;
        }

        .card-detail-sesi .profile-img {
            width: 100px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
        }

        .details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
            margin-bottom: 40px;
        }

        .nama-tutor {
            font-size: 22px;
            font-weight: 600;
            color: #C44B0F;
        }

        .nama-matkul {
            margin-top: -2px;
            font-size: 16px;
            color: #C44B0F;
        }

        .hari-tanggal {
            font-size: 15px;
            color: #636363;
        }

        .btn-detail,
        .btn-ulas,
        .btn-refund {
            position: absolute;
            padding: 6px 12px;
            background: white;
            border: none;
            font-size: 14px;
            font-weight: 500;
            color: #4d4d4d;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .btn-detail {
            right: 100px;
            bottom: 18px;
        }

        .btn-ulas {
            right: 170px;
            bottom: 18px;
        }

        .btn-refund {
            right: 20px;
            bottom: 18px;
        }
    </style>
@endsection


@section('content')

    {{-- HEADER --}}
    <div class="header-bg">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn p-0" onclick="history.back()">
                    <i class="bi bi-chevron-left fs-4 text-dark"></i>
                </button>
                <h3 class="page-title">Aktivitas</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-container">

        {{-- Tabs --}}
        <div class="tabs">
            <a href="/aktivitas" class="tab akan-datang">Akan Datang</a>
            <a href="/aktivitas-berlangsung" class="tab berlangsung">Berlangsung</a>
            <a href="/aktivitas-lampau" class="tab lampau active">Lampau</a>
        </div>

        {{-- CARD 1 --}}
        <div class="card-detail-sesi">
            <img src="{{ asset('foto-tutor.jpg') }}" class="profile-img" alt="Foto Profil">

            <div class="details">
                <h4 class="nama-tutor m-0">Khalila</h4>
                <p class="nama-matkul m-0">Dasar Pemrograman</p>
                <p class="hari-tanggal m-0">4 Agustus 2025, 9.00 WIB</p>
            </div>

            <a href="/aktivitas/detail-lampau">
                <button class="btn-detail">Detail</button>
            </a>

            <a href="/lampau/ulas-sesi">
                <button class="btn-ulas">Ulas</button>
            </a>

            <a href="/lampau/refund-sesi">
                <button class="btn-refund">Refund</button>
            </a>
        </div>

    </div>

@endsection
