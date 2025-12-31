{{-- Nailah Adlina - 5026231068 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .header-bg {
            padding-top: 30px;
            padding-bottom: 1rem;
            position: relative;
            z-index: 1020;
        }

        .page-title {
            font-weight: bold;
            margin: 0;
            font-size: 20px;
        }

        .content-container {
            flex: 1;
            padding: 14px;
            background: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .sesi-card {
            height: 120px;
            border-radius: 16px;
            padding: 14px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sc-orange {
            background-image: url('{{ asset('card-detail-orange.png') }}');
            color: #7a3600;
        }

        .sc-pink {
            background-image: url('{{ asset('card-detail-pink.png') }}');
            color: #7e2241;
        }

        .sc-indigo {
            background-image: url('{{ asset('card-detail-lilac.png') }}');
            color: #24338b;
        }

        .sc-avatar {
            width: 86px;
            height: 100%;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            flex-shrink: 0;
        }

        .sc-avatar img {
            height: 100%;
            width: auto;
            object-fit: cover;
        }

        .sc-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sc-name {
            font-weight: 800;
            font-size: 15px;
        }

        .sc-role {
            font-size: 13px;
            opacity: .9;
        }

        .sc-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-order {
            padding: .35rem .85rem;
            margin-top: 8px;
            background: #ffffff;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            color: #1A2B4B;
            border: 1px solid rgba(0, 0, 0, .08);
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
                <h3 class="page-title">Sesi {{ $tutor->nama }}</h3>
                <div style="width:24px"></div>
            </div>
        </div>
    </div>

    <main class="content-container">
        <div class="container">
            @php
                $styles = ['sc-orange', 'sc-pink', 'sc-indigo'];
            @endphp

            @forelse ($sesi as $index => $s)
                @php $bg = $styles[$index % count($styles)]; @endphp

                <div class="sesi-card {{ $bg }} mb-3">
                    <div class="sc-avatar">
                        <img src="{{ asset($tutor->fototutor) }}" alt="{{ $tutor->nama }}">
                    </div>

                    <div class="sc-content">
                        <div>
                            <div class="sc-name">{{ $s->namaSesi }}</div>
                            <div class="sc-role">{{ $s->namamatkul }}</div>
                        </div>

                        <div class="sc-bottom">
                            <span class="fw-semibold">
                                Rp{{ number_format($s->harga, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('pesanan.tanggal', $s->idsesi) }}" class="btn-order">
                                Pesan Sesi
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    Tutor ini belum memiliki sesi
                </div>
            @endforelse

        </div>
    </main>
@endsection
