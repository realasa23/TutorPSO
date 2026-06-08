{{-- Nailah Adlina - 5026231068 --}}
@extends ('layout.Mobile-View')

@section('page-style')
    <style>
        /* 1. Paksa parent layout HP menjadi flexbox seukuran persis kotak HP */
        .mobile-scroll {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            min-height: 100% !important;
            overflow: hidden !important; /* Mencegah scroll sama sekali */
        }

        /* 2. Ganti 100vh menjadi flex: 1 agar mengisi sisa ruang tanpa bablas */
        .fullscreen-container {
            flex: 1 !important; 
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 20px; /* Membuat ujung foto melengkung mengikuti ujung HP */
        }

        /* 3. Pastikan gambar tidak menyisakan ruang putih di bawahnya */
        .fullscreen-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block; /* Menghapus celah default di bawah tag img */
        }

        .button-row {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 10;
        }

        .img-btn {
            width: 48px;
            height: 48px;
            padding: 0;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .img-btn img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 50%; /* Memastikan ikon tombolnya membulat sempurna */
        }
    </style>
@endsection {{-- <-- Tadi kamu lupa menambahkan penutup ini --}}

@section('content')
    <div class="fullscreen-container">
        <img src="/vidcall.png" class="fullscreen-photo" alt="Foto">

        <div class="button-row">
            <button class="img-btn">
                <img src="/icons/mic.png" alt="">
            </button>
            <button class="img-btn">
                <img src="/icons/video.png" alt="">
            </button>
            <button class="img-btn">
                <img src="/icons/sharescreen.png" alt="">
            </button>
            <a href="{{ route('sesi.end-call', $pesanan->idpesanan) }}">
                <button class="img-btn">
                    <img src="/icons/endcall.png" alt="End Call">
                </button>
            </a>
        </div>
    </div>
@endsection