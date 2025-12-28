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
            font-size: 24px;
        }

        .content-container {
            flex: 1;
            padding: 20px;
            background-color: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, .1);
            margin-top: 0px;
            position: relative;
        }

        .detail-label {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
        }

        .title-sesi {
            font-size: 18px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 6px;
        }

        .card-detail-sesi {
            background-image: url('{{ asset('card-detail-orange.png') }}');
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

        .harga {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
        }

        .profile-img {
            background: #fff;
            width: 100px;
            height: 100px;
            border-radius: 15px;
            margin-right: 15px;
            object-fit: cover;
        }

        .nama-tutor {
            color: #D65609;
            font-size: 20px;
            font-weight: 600;
        }

        .nama-matkul {
            color: #D65609;
            font-size: 16px;
        }

        .harga {
            font-size: 16px;
            font-weight: 600;
            color: #212529;
        }

        .rating-star {
            color: #ffffff;
            font-size: 16px;
        }

        .text {
            font-size: 15px;
            margin: 0;
        }

        /* Kotak Materi Unduhan */
        .download-box {
            background-image: url('{{ asset('materibox.png') }}');
            background-size: cover;
            /* gambar memenuhi box */
            background-position: center;
            /* posisi tengah */
            background-repeat: no-repeat;
            /* jangan diulang */
            border-radius: 10px;
            padding: 1.5rem;
            color: #495057;
        }

        .play-box {
            background-image: url('{{ asset('playbox.png') }}');
            background-size: cover;
            /* gambar memenuhi box */
            background-position: center;
            /* posisi tengah */
            background-repeat: no-repeat;
            /* jangan diulang */
            border-radius: 10px;
            padding: 1.5rem;
            color: #495057;
        }

        /* Tombol Utama Bawah */
        .full-width-btn {
            background-color: #495057;
            /* Warna tombol sesuai contoh (abu tua/hitam) */
            color: white;
            padding: 0.75rem 0;
            border-radius: 10px;
            border: none;
        }

        .overlay-dark {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, .6);
            backdrop-filter: blur(2px);
            z-index: 1055;
        }

        .card-overlay {
            width: 347px;
            height: 405px;
            border-radius: 18px;
            background: #fff;
            padding: 26px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .15);
        }

        .btn-gradient {
            width: 250px;
            height: 39px;
            font-size: 14px;
            font-weight: 600;
            color: white;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #4A9FFF 0%, #377DFF 100%);
            box-shadow: 0 4px 10px rgba(55, 125, 255, .3);
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
                <h3 class="page-title">Detail Sesi</h3>
                <div style="width:24px"></div>
            </div>
        </div>
    </div>

    <div class="content-container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="title-sesi">Detail</span>

            @if ($pesanan->status === 'akan datang')
                <span class="badge rounded-pill text-bg-success">Online</span>
            @elseif ($pesanan->status === 'berlangsung')
                <span class="badge rounded-pill text-bg-success">Online</span>
            @elseif ($pesanan->status === 'lampau')
                <span class="badge rounded-pill text-bg-success">Online</span>
            @endif
        </div>

        {{-- CARD TUTOR --}}
        <div class="card-detail-sesi mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center card-content-wrapper">
                    <img src="{{ asset($pesanan->fototutor) }}" class="profile-img">
                    <div>
                        <p class="nama-tutor m-0">{{ $pesanan->nama_tutor }}</p>
                        <p class="nama-matkul m-0">{{ $pesanan->namamatkul }}</p>
                        <span class="rating-star">★</span>
                        {{ number_format($pesanan->ratingtutor, 1) }}
                        <p class="harga m-0">
                            Rp{{ number_format($pesanan->harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- JADWAL --}}
        <div class="mb-4">
            <p class="title-sesi">Sesi Tutor</p>
            <p class="text">Topik: {{ $pesanan->namaSesi }}</p>
            <p class="text mb-0">
                Tanggal: {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->translatedFormat('d F Y') }}
            </p>
            <p class="text">
                Pukul: {{ $pesanan->jam_pesanan }} WIB
            </p>
        </div>

        <hr>

        {{-- DESKRIPSI --}}
        <div class="mb-4">
            <p class="title-sesi">Deskripsi</p>
            <p class="text">{{ $pesanan->deskripsi }}</p>
        </div>

        {{-- MATERI --}}
        @if ($pesanan->filemateri)
            <div class="download-box d-flex justify-content-between align-items-center mb-3">
                <span class="fw-bold">Materi {{ $pesanan->namaSesi }}</span>
                <a href="{{ asset($pesanan->filemateri) }}" download>
                    <i class="bi bi-download fs-4"></i>
                </a>
            </div>
        @endif

        {{-- REKAMAN SESI (HANYA JIKA LAMPAU) --}}
        @if ($statusRealtime === 'lampau')
            <div class="d-flex justify-content-between align-items-end play-box mb-3">
                <span class="fw-bold">Rekaman Sesi Tutor</span>
                <button class="btn btn-lg p-0">
                    <i class="bi bi-play fs-4"></i>
                </button>
            </div>
        @endif
    </div>

    {{-- BUTTON BAWAH --}}
    <div class="p-3 bg-white">

        {{-- AKAN DATANG --}}
        @if ($statusRealtime === 'akan-datang')
            <button id="joinSessionBtn" class="btn w-100 full-width-btn fw-bold">
                Gabung Sesi
            </button>
        @elseif ($statusRealtime === 'berlangsung')
            <a href="{{ route('sesi.berlangsung', $pesanan->idsesi) }}"
                class="btn w-100 full-width-btn fw-bold text-white text-center">
                Gabung Sesi
            </a>
        @elseif ($statusRealtime === 'lampau')
            <a href="{{ route('review.create', $pesanan->idpesanan) }}"
                class="btn w-100 full-width-btn fw-bold text-white text-center">
                Ulas Sesi
            </a>
        @endif

    </div>

    {{-- OVERLAY BELUM DIMULAI --}}
    <div id="sessionOverlay" class="overlay-dark d-none align-items-center justify-content-center">
        <div class="card-overlay text-center">
            <h5 class="title mb-2">Sesi Anda<br>belum dimulai</h5>
            <img src="{{ asset('stopwatch.png') }}" class="my-3">
            <p class="desc mb-4">Gabung sesi sesuai jadwal yang dipilih</p>
            <button id="closeOverlay" class="btn-gradient">Kembali</button>
        </div>
    </div>

    <script>
        const joinBtn = document.getElementById('joinSessionBtn');
        const overlay = document.getElementById('sessionOverlay');
        const closeOverlay = document.getElementById('closeOverlay');

        if (joinBtn) {
            joinBtn.addEventListener('click', () => {
                overlay.classList.remove('d-none');
                overlay.classList.add('d-flex');
            });
        }

        if (closeOverlay) {
            closeOverlay.addEventListener('click', () => {
                overlay.classList.remove('d-flex');
                overlay.classList.add('d-none');
            });
        }
    </script>
@endsection
