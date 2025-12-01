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
            margin-top: -5px;
            z-index: 5;
            position: relative;
        }
        .detail-label {
            font-size: 20px;
            /* Mengatur ukuran font menjadi 20px */
            color: #212529;
            /* Opsional: Memastikan warna teks tetap gelap */
        }

        .title-sesi {
            font-size: 18px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 0px;
        }

        .text-muted {
            margin-bottom: 0px
                /* Warna abu-abu untuk teks muted */
        }

        .card-detail-sesi {
            background-image: url('{{ asset('detailSesi.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            position: relative;
            top: 0 rem;
            /* lebih halus daripada -2rem */
        }

        .card-detail-sesi .card-body {
            padding: 0.75rem 1rem;
            /* sebelumnya p-3 = 1rem; jadi lebih kecil */
        }

        .card-detail-sesi .profile-img {
            width: 80px;
            /* lebih kecil dari 100px */
            height: 90px;
            margin-right: 10px;
        }

        .card-detail-sesi h4,
        .card-detail-sesi p {
            margin-bottom: 4px;
            /* rapatin antar teks */
        }

        .harga {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
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

        /* Styling Gambar Profil */
        .profile-img {
            width: 100px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }

        /* Warna Bintang Rating */
        .rating-star {
            color: rgb(255, 255, 254);
            font-size: 18px;
        }

        /* Warna teks Nama Tutor */
        .nama-tutor {
            color: #D65609 !important;
            /* !important ditambahkan untuk override warna default H4 Bootstrap jika ada */
        }

        /* Warna teks Nama Mata Kuliah */
        .nama-matkul {
            color: #D65609 !important;
        }

        .harga {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
        }
        .rating-star {
            color: rgb(255, 255, 253);
            /* Mengganti warna ke gold (lebih umum untuk bintang) */
            font-size: 18px;
        }

        .overlay-dark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(2px);
            z-index: 1055;
        }

        .card-overlay {
            width: 347px;
            height: 405px;
            border-radius: 18px;
            background: #fff;
            padding: 26px 28px 40px 26px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .card-overlay .title {
            font-size: 27px;
            font-weight: 600;
            color: #2C2C2C;
            line-height: 1.2;
        }

        .card-overlay .desc {
            font-size: 14px;
            color: #6c757d;
        }

        .card-overlay .stopwatch {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .btn-gradient {
            width: 250px;
            height: 39px;
            font-size: 14.63px;
            font-weight: 600;
            color: white;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #4A9FFF 0%, #377DFF 100%);
            box-shadow: 0 4px 10px rgba(55, 125, 255, 0.3);
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
                <h3 class="page-title">Detail Sesi</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    <div class="content-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="text fw-bold detail-label">Detail</span>
            <span class="badge rounded-pill text-bg-success">ONLINE</span>
        </div>

        <div class="card-detail-sesi">
            <div class="card-body">
                <div class="d-flex align-items-center card-content-wrapper">
                    <img src="{{ asset('foto-tutor.jpg') }}" class="profile-img full-height-img" alt="Foto Profil">
                    <div>
                        <h4 class="nama-tutor fw-semibold m-0">Khalila</h4>
                        <p class="nama-matkul m-0">Dasar Pemrograman</p>
                        <span class="rating-star">★ </span> 4.9
                        <p class="harga m-0">Rp50.000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <p class="title-sesi">Sesi yang Akan Datang</p>
            <p class="text mb-0">Pertemuan 1 Object Oriented Programming</p>
            <p class="text-muted">4 Agustus 2024</p>
            <p class="text-muted">16.00–16.50 WIB</p>
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <p class="title-sesi">Deskripsi</p>
            <p class="text-muted mb-0">
                OOP Java (Object-Oriented Programming in Java) adalah paradigma pemrograman yang menggunakan konsep objek
                dan kelas untuk merancang dan membangun program.
            </p>
        </div>

        <div class="d-flex justify-content-between align-items-center download-box mb-3">
            <span class="fw-bold">Materi Java Object Oriented Programming</span>
            <button id="downloadBtn" class="btn btn-lg p-0" aria-label="Unduh Materi">
                <i class="bi bi-download fs-4"></i>
            </button>
        </div>
    </div>

    <div class="p-3 bg-white">
        <button id="joinSessionBtn" class="btn w-100 full-width-btn fw-bold">
            <h5 class=join-button my-0>Gabung Sesi</h5>
        </button>
    </div>

    {{-- Overlay: Belum Dimulai --}}
    <div id="sessionOverlay" class="overlay-dark d-none align-items-center justify-content-center">
        <div class="card-overlay text-center">
            <h5 class="title mb-2">Sesi Anda<br>belum dimulai</h5>
            <div class="my-2">
                <img src="{{ asset('stopwatch.png') }}" alt="Stopwatch Icon" class="stopwatch">
            </div>
            <p class="desc mb-5">
                Gabung sesi sesuai jadwal<br>yang dipilih
            </p>
            <button id="closeOverlay" class="btn-gradient">Kembali</button>
        </div>
    </div>

    {{-- Overlay: Download Berhasil --}}
    <div id="downloadOverlay" class="overlay-dark d-none align-items-center justify-content-center">
        <div class="card-overlay text-center">
            <h5 class="title mb-3">Materi <br> Sesi Tutor <br>Berhasil <br> Diunduh</h5>

            <div class="my-4">
                <img src="{{ asset('downloadsuccess.png') }}" alt="Download Success" class="stopwatch">
            </div>

            <button id="closeDownloadOverlay" class="btn-gradient">Tutup</button>
        </div>
    </div>

    <script>
        const sessionOverlay = document.getElementById('sessionOverlay');
        const downloadOverlay = document.getElementById('downloadOverlay');

        const joinBtn = document.getElementById('joinSessionBtn');
        const closeOverlay = document.getElementById('closeOverlay');

        const downloadBtn = document.getElementById('downloadBtn');
        const closeDownloadOverlay = document.getElementById('closeDownloadOverlay');

        // === Overlay Gabung Sesi ===
        joinBtn.addEventListener('click', () => {
            sessionOverlay.classList.remove('d-none');
            sessionOverlay.classList.add('d-flex');
        });

        closeOverlay.addEventListener('click', () => {
            sessionOverlay.classList.remove('d-flex');
            sessionOverlay.classList.add('d-none');
        });

        // === Overlay Download ===
        downloadBtn.addEventListener('click', () => {
            // Hanya tampilkan notifikasi overlay (tanpa download file)
            downloadOverlay.classList.remove('d-none');
            downloadOverlay.classList.add('d-flex');
        });

        closeDownloadOverlay.addEventListener('click', () => {
            downloadOverlay.classList.remove('d-flex');
            downloadOverlay.classList.add('d-none');
        });
    </script>
@endsection
