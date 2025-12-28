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
            margin-top: 7px;
            z-index: 5;
            position: relative;

        }

        .title {
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .tab {
            padding: 4px 16px;
            border-radius: 20px;
            border: 1.4px solid;
            font-size: 14px;
            color: #6f6f6f;
            text-decoration: none;
            transition: 0.25s ease;
            display: inline-block;
            margin-bottom: 20px;
        }

        /* === Warna default (outline) === */
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

        .card-detail-sesi {
            background-size: cover;
            background-position: right;
            background-repeat: no-repeat;
            border-radius: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            padding: 15px;
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            position: relative;
        }

        .card-detail-sesi.card-orange {
            background-image: url('{{ asset('card-detail-orange.png') }}');
            color: #7a3600;
        }

        .card-detail-sesi.card-pink {
            background-image: url('{{ asset('card-detail-pink.png') }}');
            color: #7e2241;
        }

        .card-detail-sesi.card-indigo {
            background-image: url('{{ asset('card-detail-lilac.png') }}');
            color: #24338b;
        }

        .profile-img {
            background: #fff;
            width: 90px;
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
            font-size: 18px;
            font-weight: 600;
        }

        .nama-matkul {
            font-size: 14px;
            margin-top: -2px;
        }

        .hari-tanggal {
            font-size: 13px;
            color: #636363;
        }

        .btn-detail {
            position: absolute;
            bottom: 18px;
            right: 20px;
            padding: 6px 15px;
            background: white;
            border: none;
            font-size: 13px;
            font-weight: 500;
            color: #4d4d4d;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .btn-gabung {
            position: absolute;
            bottom: 18px;
            right: 90px;
            padding: 6px 15px;
            background: white;
            border: none;
            font-size: 13px;
            font-weight: 500;
            color: #4d4d4d;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .btn-ulas {
            position: absolute;
            bottom: 18px;
            right: 172px;
            /* geser kiri sedikit supaya sejajar dengan tombol detail */
            padding: 6px 12px;
            background: white;
            border: none;
            font-size: 13px;
            font-weight: 500;
            color: #4d4d4d;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .btn-refund {
            position: absolute;
            bottom: 18px;
            right: 95px;
            /* geser kiri sedikit supaya sejajar dengan tombol detail */
            padding: 6px 12px;
            background: white;
            border: none;
            font-size: 13px;
            font-weight: 500;
            color: #4d4d4d;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

    </style>
@endsection


@section('content')
    <div class="header-bg">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center justify-content-center">
                <h3 class="page-title">Aktivitas</h3>
                <div style="width:24px;"></div>
            </div>
        </div>
    </div>

    <div class="content-container">

        {{-- TABS --}}
        <div class="tabs">
            <a href="{{ route('aktivitas', ['tab' => 'akan-datang']) }}"
                class="tab akan-datang {{ $tab === 'akan-datang' ? 'active' : '' }}">
                Akan Datang
            </a>

            <a href="{{ route('aktivitas', ['tab' => 'berlangsung']) }}"
                class="tab berlangsung {{ $tab === 'berlangsung' ? 'active' : '' }}">
                Berlangsung
            </a>

            <a href="{{ route('aktivitas', ['tab' => 'lampau']) }}"
                class="tab lampau {{ $tab === 'lampau' ? 'active' : '' }}">
                Lampau
            </a>
        </div>

        {{-- CARD LIST --}}
        @forelse ($sesi as $s)
            @php
                $colorClass = match ($loop->index % 3) {
                    0 => 'card-orange',
                    1 => 'card-indigo',
                    default => 'card-pink',
                };
            @endphp

            <div class="card-detail-sesi {{ $colorClass }}">
                <img src="{{ asset($s->fototutor) }}" class="profile-img">

                <div class="details">
                    <h4 class="nama-tutor m-0">{{ $s->nama_tutor }}</h4>
                    <p class="nama-matkul m-0">{{ $s->namaSesi }}</p>

                    <p class="hari-tanggal m-0">
                        {{ \Carbon\Carbon::parse($s->tanggal)->translatedFormat('d F Y') }}
                    </p>
                    <p class="hari-tanggal m-0">
                        {{ $s->jam }} WIB
                    </p>
                </div>

                <div class="row">
                    {{-- AKAN DATANG --}}
                    @if ($s->status_realtime === 'akan-datang')
                        <a href="{{ route('aktivitas.detail', $s->idpesanan) }}">
                            <button class="btn-detail">Detail</button>
                        </a>

                        {{-- BERLANGSUNG --}}
                    @elseif ($s->status_realtime === 'berlangsung')
                        <a href="{{ route('aktivitas.detail', $s->idpesanan) }}">
                            <button class="btn-detail">Detail</button>
                        </a>

                        <a href="{{ route('sesi.berlangsung', $s->idpesanan) }}">
                            <button class="btn-gabung">Gabung Sesi</button>
                        </a>

                        {{-- LAMPAU --}}
                    @elseif ($s->status_realtime === 'lampau')
                        <a href="{{ route('aktivitas.detail', $s->idpesanan) }}">
                            <button class="btn-detail">Detail</button>
                        </a>

                        <a href="{{ route('review.create', $s->idpesanan) }}">
                            <button class="btn-ulas">Ulas</button>
                        </a>

                        <a href="{{ route('laporan.create', $s->idpesanan) }}">
                            <button class="btn-refund">Refund</button>
                        </a>
                    @endif

                </div>


            </div>
        @empty
            <div class="text-center text-muted mt-5">
                @if ($tab === 'akan-datang')
                    Belum ada sesi yang akan datang
                @elseif ($tab === 'berlangsung')
                    Tidak ada sesi yang sedang berlangsung
                @else
                    Belum ada riwayat sesi
                @endif
            </div>
        @endforelse

    </div>
    @include('layout.Navbar')
@endsection
