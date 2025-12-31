{{-- Nailah Adlina - 5026231068 --}}
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

        .btn-back-icon {
            color: #212529 !important;
        }

        .content-container {
            flex: 1;
            padding: 20px;
            background-color: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 0px;
            z-index: 5;
            position: relative;
        }

        .detail-label {
            font-size: 20px;
            color: #212529;
        }

        .title-sesi {
            font-size: 18px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 0px;
        }

        .text-muted {
            margin-bottom: 0px
        }

        .card-detail-sesi {
            background-image: url('{{ asset('card-detail-orange.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            position: relative;
            padding: 15px;
        }

        .card-detail-sesi .profile-img {
            width: 80px;
            height: 90px;
            margin-right: 10px;
        }

        .card-detail-sesi h4,
        .card-detail-sesi p {
            margin-bottom: 4px;

        }

        .full-width-btn {
            background-color: #495057;
            color: white;
            padding: 0.75rem 0;
            border-radius: 10px;
            border: none;
        }

        .profile-img {
            background: #fff;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }

        .rating-star {
            color: rgb(255, 255, 254);
            font-size: 18px;
        }

        .nama-tutor {
            color: #D65609 !important;

        }

        .nama-matkul {
            color: #D65609 !important;
        }

        .harga {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
        }

        .order-box {
            background-image: url('{{ asset('card-detail-lilac.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 10px;
            padding: 1.5rem;
            color: #495057;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .pembayaran {
            padding: 16px;
            margin-bottom: 20px;
        }

        .border {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .total-row {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100%;
            margin-top: 100px;
        }

        .total-title,
        .total-price {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            white-space: nowrap;

        }

        .full-width-btn {
            margin-top: 5px;
            display: block;
            width: 100%;
            background-color: #343446 !important;
            color: white !important;
            padding: 12px 0;
            border-radius: 16px;
            text-align: center;
            text-decoration: none;
        }

        .order-button {
            font-weight: 600 !important;
            color: white !important;
            margin: 0;
            font-size: 18px;
        }

        .full-width-btn:hover {
            opacity: 0.9;
        }
    </style>
@endsection

@section('content')
    <div class="header-bg">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn p-0" onclick="history.back()">
                    <i class="bi bi-chevron-left fs-4 text-dark"></i>
                </button>
                <h3 class="page-title">Detail Pesanan</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    <div class="content-container">
        <div class="card-detail-sesi">
            <div class="d-flex align-items-center card-content-wrapper">
                <img src="{{ asset($sesi->tutor->fototutor) }}" class="profile-img full-height-img" alt="Foto Profil">
                <div>
                    <h5 class="nama-tutor fw-semibold m-0">{{ $sesi->tutor->nama }}</h5>
                    <p class="nama-matkul m-0">{{ $sesi->namaSesi }}</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center order-box">
            <span class="fw-semibold">
                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }},
                {{ $jam }} <br>
                {{ 'Rp' . number_format($sesi->harga, 0, ',', '.') }}
            </span>
        </div>


        <div class= "pembayaran">
            <h3 style="font-size: 1.1rem; font-weight: bold;">Pembayaran</h3>

            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                <p style="margin: 0;">Harga Pokok</p>
                <p style="margin: 0;">{{ 'Rp' . number_format($sesi->harga, 0, ',', '.') }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                <p style="margin: 0;">Biaya Admin</p>
                <p style="margin: 0;">Rp5.000</p>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                <p style="margin: 0;">Promo</p>
                <p style="margin: 0;">Rp5.000</p>
            </div>

            <hr class="border border-2 opacity-50">

            <div class="total-row">
                <h2 class="total-title">Total</h2>
                <h2 class="total-price">
                    Rp{{ number_format($sesi->harga + 5000 - 5000, 0, ',', '.') }}
                </h2>
            </div>

        </div>

        <div class="p-2 bg-white">
            <form action="{{ route('pesanan.store.regular') }}" method="POST">
                @csrf
                <button type="submit" class="btn w-100 full-width-btn">
                    <p class="order-button my-0">Pesan Sesi</p>
                </button>
            </form>
        </div>

        <div class="p-2 bg-white">
            <form action="{{ route('pesanan.store.trial') }}" method="POST">
                @csrf
                <button type="submit" class="btn w-100 full-width-btn">
                    <p class="order-button my-0">Gunakan Trial</p>
                </button>
            </form>
        </div>
    @endsection
