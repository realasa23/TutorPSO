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
            background: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: -5px;
            z-index: 5;
            position: relative;

        }

        .title {
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        /* Card */
        .card-detail-sesi {
            background-size: cover;
            background-position: right;
            background-repeat: no-repeat;
            border-radius: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            padding: 15px;
            position: relative;
            display: flex;
            align-items: stretch;
            gap: 10px;
            margin-bottom: 20px;
        }

        /* Foto tutor */
        .card-detail-sesi .profile-img {
            width: 100px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            /* supaya rapi seperti card kanan */
        }

        /* Container text */
        .details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
            margin-bottom: 40px;
            /* ruang untuk tombol detail */
        }

        /* Styling text */
        .nama-tutor {
            font-size: 22px;
            font-weight: 600;
            color: #212529;
        }

        .nama-matkul {
            margin-top: -2px;
            font-size: 16px;
            color: #212529;
        }

        .hari-tanggal {
            font-size: 15px;
            color: #636363;
        }

        .photo-area {
            width: 120px;
            height: 100px;
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
                <h3 class="page-title">List Tutor</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    <div class="content-container">
        @forelse ($sesis as $sesi)
            @php
                // Mengambil data dari relasi
                $tutorObj = $sesi->tutor;

                // Mendefinisikan variabel yang digunakan di HTML
                $namaTutor = optional($tutorObj)->nama ?? 'N/A';
                $ratingTutor = optional($tutorObj)->ratingtutor ?? 0;
                $namaMatkul = optional($sesi->matakuliah)->namamatkul ?? 'Matakuliah Tidak Diketahui';
                $harga = $sesi->harga;
                $fotoProfil = optional($tutorObj)->fototutor ?? 'default.png';

                // Logika Gradient (untuk mencocokkan visual List Tutor (1).png)
                $isOdd = $loop->odd;
                $gradientColor = $isOdd
                    ? 'bg-gradient-to-r from-pink-100 to-pink-200'
                    : 'bg-gradient-to-r from-orange-100 to-orange-200';
            @endphp

            <div class="card-detail-sesi">

                {{-- FOTO PROFIL --}}
                <div class="flex-shrink-0 photo-area rounded-full overflow-hidden border-4 border-white shadow-md">
                    {{-- Menggunakan asset() untuk URL, disesuaikan dengan asumsi path folder: public/assets/images/tutor/ --}}
                    <img src="{{ asset($sesi->tutor->fototutor) }}" alt="{{ $namaTutor }}" class="w-100 h-100 object-cover"
                        onerror="this.onerror=null;this.src='https://placehold.co/100x100/AAAAAA/FFFFFF?text=NO+IMG';" />
                </div>

                <div class="flex-grow">

                    {{-- NAMA TUTOR --}}
                    <h2 class="text-xl font-semibold text-gray-800">{{ $namaTutor }}</h2>

                    {{-- Nama Matakuliah --}}
                    <p class="text-sm text-gray-600 mb-1">{{ $namaMatkul }}</p>

                    {{-- Rating --}}
                    <div class="flex items-center text-sm mb-1">
                        <span class="font-bold text-gray-700">{{ number_format($ratingTutor, 1) }}</span>
                        <svg class="w-4 h-4 text-yellow-500 ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.817 2.046a1 1 0 00-.363 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.817-2.046a1 1 0 00-1.175 0l-2.817 2.046c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.363-1.118L2.203 8.72a1 1 0 01.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>

                    {{-- Harga --}}
                    <div class="flex justify-between items-end">
                        <span class="text-lg font-bold text-gray-800">Rp{{ number_format($harga, 0, ',', '.') }}</span>

                        {{-- Tombol Pesan Sesi --}}
                        <a href="{{ route('pesanan.tanggal', $sesi->idsesi) }}"
                            class="bg-white text-pink-500 text-xs font-semibold py-1 px-3 rounded-full shadow-md hover:shadow-lg transition duration-200">
                            Pesan Sesi
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 mt-10">Tidak ada sesi yang tersedia saat ini.</p>
        @endforelse
    </div>
@endsection
