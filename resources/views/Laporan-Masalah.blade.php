{{-- Michelle Lea Amanda - 5026231214 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .header-area {
            padding-top: 40px;
            padding-bottom: 20px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            position: relative;
            z-index: 0;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin: 0;
            font-size: 22px;
            color: #343446;
            text-align: center;
            flex: 1;
        }

        .page-content {
            padding: 0 24px;
        }

        .tutor-card {
            padding: 16px;
            background-image: url('{{ asset('card lapor tutor-orange.png') }}');
            background-size: cover;
            background-position: right;
            background-repeat: no-repeat;
            border-radius: 18px;
            display: flex;
            gap: 12px;
            align-items: center;
            position: relative;
            margin: 0 15px 15px 15px;
        }

        .tutor-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .img-wrapper {
            background: #fff;
            padding: 0;
            border-radius: 15px;
        }

        .profile-img {
            width: 80px;
            height: 95px;
            border-radius: 15px;
            object-fit: cover;
            display: block;
        }

        .tutor-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: -5px;
        }

        .tutor-name {
            font-size: 18px;
            font-weight: 600;
            color: #A0400B;
            margin: 0;
        }

        .matkul-name {
            font-size: 14px;
            margin-top: -1px;
            color: #A0400B;
        }

        .tutor-date {
            font-size: 14px;
            margin-top: -15px;
            color: #A0400B;
        }

        .tutor-time {
            font-size: 14px;
            margin-top: -15px;
            color: #A0400B;
        }

        .mobile-scroll {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            min-height: 100% !important;
        }

        .content-container {
            flex: 1 !important; 
            padding: 20px 24px 40px; 
            background: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            z-index: 5;
            position: relative;
        }

        .section-label {
            font-weight: 700;
            color: #000;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-img {
            width: 100%;
            display: block;
            text-align: center;
            padding: 16px 0;
            border-radius: 15px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            margin-bottom: 16px;
            border: none;
            background-color: transparent;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center;
            transition: all 0.2s ease-in-out;
            position: relative;
        }

        .btn-img:active {
            transform: scale(0.98);
        }

        .btn-img:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-bg-orange {
            background-image: url('{{ asset('btn masalah-orange.png') }}');
            color: #D65609;
        }

        .btn-bg-blue {
            background-image: url('{{ asset('btn masalah-blue.png.png') }}');
            color: #4566A1;
        }

        .btn-bg-pink {
            background-image: url('{{ asset('btn masalah-pink.png.png') }}');
            color: #FF687F;
        }

        .btn-bg-purple {
            background-image: url('{{ asset('btn masalah-purple.png.png') }}');
            color: #915CAE;
        }

        .btn-bg-grey {
            background-image: url('{{ asset('btn masalah-grey.png') }}');
            color: #9D9D9D;
        }

        .btn-bg-lilac {
            background-image: url('{{ asset('btn masalah-lilac.png.png') }}');
            color: #566CD8;
        }

        .btn-back {
            background: none;
            border: none;
            padding: 0;
        }
    </style>
@endsection

@section('content')
    <div class="header-area">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <button class="btn-back" onclick="history.back()">
                    <i class="bi bi-chevron-left fs-4" style="color: #333;"></i>
                </button>
                <h3 class="page-title">Laporan</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    <div class="tutor-card">
        <div class="tutor-info">
            <div class="img-wrapper">
                <img src="{{ asset($pesanan->fototutor) }}" class="profile-img" alt="{{ $pesanan->nama_tutor }}">
            </div>

            <div class="tutor-details">
                <h4 class="tutor-name">{{ $pesanan->nama_tutor }}</h4>
                <p class="matkul-name">{{ $pesanan->namasesi }}</p>
                <p class="tutor-date">{{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d F Y') }}</p>
                <p class="tutor-time">{{ $pesanan->jam }}</p>
            </div>
        </div>
    </div>

    <div class="content-container">
        <p class="section-label">Pilih Masalahmu</p>
        <a href="{{ route('laporan.detail', ['idpesanan' => $pesanan->idpesanan, 'jenis' => 'Tutor Tidak Hadir']) }}"
            class="btn-img btn-bg-orange">Tutor Tidak Hadir</a>
        <a href="{{ route('laporan.detail', ['idpesanan' => $pesanan->idpesanan, 'jenis' => 'Kesalahan Jadwal']) }}"
            class="btn-img btn-bg-blue">Kesalahan Jadwal</a>
        <a href="{{ route('laporan.detail', ['idpesanan' => $pesanan->idpesanan, 'jenis' => 'Materi Tidak Sesuai']) }}"
            class="btn-img btn-bg-pink">Materi Tidak Sesuai</a>
        <a href="{{ route('laporan.detail', ['idpesanan' => $pesanan->idpesanan, 'jenis' => 'Masalah Teknis']) }}"
            class="btn-img btn-bg-purple">Masalah Teknis</a>
        <a href="{{ route('laporan.detail', ['idpesanan' => $pesanan->idpesanan, 'jenis' => 'Lainnya']) }}"
            class="btn-img btn-bg-grey">Lainnya</a>
    </div>
@endsection
