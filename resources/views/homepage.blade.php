{{-- Harya Raditya Handoyo - 5026231176 --}}
@php
    $userId = session('user_id') ?? \Illuminate\Support\Facades\Auth::id();
    $namaUser = 'User';

    if ($userId) {
        $userData = \Illuminate\Support\Facades\DB::table('user')->where('userid', $userId)->first();

        if ($userData) {
            $namaUser = $userData->username;
        }
    }
@endphp

@extends('layout.Mobile-View')
@section('page-style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cat-w: 124px;
            --cat-h: 150px;
            --cat-r: 16px;
            --notch: 28px;
            --rec-w: 152px;
            --rec-h: 210px;
            --tile: 116px;
            --bg-start: #c9d2ff;
            --bg-mid: #a9b7ff;
            --bg-end: #8fc3ff;
            --ink: #1b2430;
            --ink-dim: #667085;
            --orange-1: #ffd2a6;
            --orange-2: #ffb778;
            --orange-ink: #7a3600;
            --indigo-1: #cfd6ff;
            --indigo-2: #aeb9ff;
            --indigo-ink: #24338b;
            --pink-1: #ffc7d6;
            --pink-2: #ff9fb7;
            --pink-ink: #7e2241;
            --promo-h: 180px;
        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: 'Poppins', system-ui
        }

        a {
            text-decoration: none
        }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-container {
            flex: 1;
            padding: 10px;
            background: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            z-index: 5;
            position: relative;
        }

        .homepage-container {
            display: flex;
            flex-direction: column;
        }
        .avatar-wrapper {
            position: relative;
            width: 40px;
            height: 40px;
        }

        .avatar-48 {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-fallback {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6f7cff, #8fc3ff);
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
        }

        .header-bg {
            padding: 14px;
            margin: 0px 12px;
        }

        .hello-small {
            color: #10224d;
            font-size: 16px;
            font-style: italic;
            font-weight: 400;
        }

        .hello-name {
            font-size: 18px;
            font-weight: 700;
            color: #10224d
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 2px;
            color: #fff;
            border: 0;
        }

        .hero-body {
            padding: 0 .75rem
        }

        .promo-card-detail {
            height: 160px;
            background-size: cover;
            background-position: right;
            background-repeat: no-repeat;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            padding: 18px 18px;
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .promo-card-detail.trial {
            background-image: url('{{ asset('trial-card.png') }}');
        }

        .promo-card-detail.refund {
            background-image: url('{{ asset('refund-card.png') }}');
        }

        .promo-card-detail.tutor {
            background-image: url('{{ asset('tutor-card.png') }}');
        }

        .promo-content {
            max-width: 65%;
        }

        .promo-content.trial {
            color: #FF687F;
        }

        .promo-content.refund {
            color: #D65609;
        }

        .promo-content.tutor {
            color: #566CD8;
        }


        .promo-content h5 {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .promo-content p {
            font-size: 14px;
            opacity: .9;
            margin-bottom: 12px;
        }

        .btn-resp {
            border-radius: 12px;
            padding: .45rem .85rem;
            font-weight: 600;
            background: transparent;
        }

        .btn-promo-trial {
            border: 1.5px solid #FF687F;
            color: #FF687F;
        }

        .btn-promo-refund {
            border: 1.5px solid #D65609;
            color: #D65609;
        }

        .btn-promo-tutor {
            border: 1.5px solid #566CD8;
            color: #566CD8;
        }

        .promo-indicators {
            position: static;
            margin-top: .5rem
        }

        .promo-indicators [data-bs-target] {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            border: 0;
            background: #ffffffaa;
            margin: 0 4px
        }

        .promo-indicators .active {
            background: #fff
        }

        .section-title {
            color: #10224d;
            font-weight: 700;
            font-size: 18px;
        }

        .section-sub {
            color: var(--ink-dim)
        }

        .badge-pill {
            display: inline-block;
            background: #eef1ff;
            color: #10224d;
            border-radius: 12px;
            font-weight: 500;
            font-size: 13px;
            padding: .35rem .7rem
        }

        .surface {
            padding: 16px; 
        }
        
        .snap-x {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 10px;
            padding-left: 16px;
            padding-right: 16px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .snap-x::-webkit-scrollbar {
            display: none;
        }

        .snap-x::-webkit-scrollbar-thumb {
            background: #d7dcff;
            border-radius: 10px
        }

        .cat-card {
            position: relative;
            flex: 0 0 var(--cat-w);
            height: var(--cat-h);
            border-radius: var(--cat-r);
            padding: 10px 18px 10px 12px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #1b2430;
            overflow: hidden;
            isolation: isolate;
            scroll-snap-align: start;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }


        .cat-notch {
            position: absolute;
            right: calc(-1*var(--notch)/2);
            top: 50%;
            width: var(--notch);
            height: var(--notch);
            transform: translateY(-50%);
            background: #fff;
            border-radius: 50%;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .04)
        }

        .cat-decor {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .cat-icon {
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, .08);
        }

        .cat-title {
            z-index: 1;
            margin: 2px 0 2px;
            font-weight: 600;
            line-height: 1.15;
            font-size: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cat-sub {
            z-index: 1;
            color: #ffffff;
            opacity: .96;
            font-weight: 500;
            font-size: 13px;
        }

        .cat-orange {
            background-image: url('{{ asset('card-orange.png') }}');
            color: var(--orange-ink);
        }

        .cat-indigo {
            background-image: url('{{ asset('card-lilac.png') }}');
            color: var(--indigo-ink);
        }

        .cat-pink {
            background-image: url('{{ asset('card-pink.png') }}');
            color: var(--pink-ink);
        }


        .rec-card {
            flex: 0 0 var(--rec-w);
            height: var(--rec-h);
            border-radius: 20px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            box-shadow: 0 0 10px rgba(30, 40, 80, .12);
        }


        .rec-orange {
            background-image: url('{{ asset('rec-orange.png') }}');
        }

        .rec-lilac {
            background-image: url('{{ asset('rec-lilac.png') }}');
        }

        .rec-pink {
            background-image: url('{{ asset('rec-pink.png') }}');
        }

        .rec-image {
            height: 120px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .rec-image img {
            height: 100%;
            object-fit: contain;
        }

        .rec-info {
            background: #ffffff;
            width: 100%;
            padding: 10px 14px;
        }

        .rec-name {
            font-size: 15px;
            font-weight: 700;
            color: #2b2d42;
        }

        .rec-role {
            font-size: 13px;
            color: #7b7f9e;
            margin-bottom: 5px;
        }

        .rec-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }

        .rec-rating i {
            color: #ffc107;
        }
    </style>
@endsection

@section('content')
    <div class="homepage-container">
        <div class="header-bg">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <span class="hello-small">
                        Halo,
                        <strong class="hello-name">{{ $namaUser }}</strong>
                    </span>
                </div>
                <a class="btn-icon" aria-label="Cari" href="{{ route('search') }}">
                    <i class="bi bi-search"></i>
                </a>
            </div>
        </div>

        <section class="hero">
            <div class="container hero-body">
                <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true"
                    data-bs-interval="2000">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="promo-card-detail trial">
                                <div class="promo-content trial">
                                    <h5>Mau Sesi Belajar Gratis?</h5>
                                    <p>Coba Free Trial 3 Kali!</p>
                                    <a href="/kategori" class="btn btn-resp btn-promo-trial">Coba Sekarang</a>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="promo-card-detail refund">
                                <div class="promo-content refund">
                                    <h5>Tidak Puas dengan Sesi Tutormu?</h5>
                                    <p>Lakukan Refund!</p>
                                    <a href="{{ route('aktivitas', ['tab' => 'lampau']) }}"
                                        class="btn btn-resp btn-promo-refund">Cek Sekarang</a>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="promo-card-detail tutor">
                                <div class="promo-content tutor">
                                    <h5>Susah Belajar Sendiri?</h5>
                                    <p>Cek Tutor Kita</p>
                                    <a href="/tutor" class="btn btn-resp btn-promo-tutor">Cek Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main class="content-container">
            <div class="surface p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div class="section-title">Kategori</div>
                    <a href="{{ route('kategori') }}" class="badge-pill">Lihat Semua</a>
                </div>
                <div class="section-sub small mb-3">Pilih Kategori Bidang yang Kamu Inginkan</div>

                <div class="snap-x mb-3">
                    @foreach ($kategori as $index => $kat)
                        @php
                            $styles = [
                                [
                                    'card' => 'cat-orange',
                                    'icon' => 'bi-database',
                                    'iconColor' => 'text-warning',
                                ],
                                [
                                    'card' => 'cat-indigo',
                                    'icon' => 'bi-window-sidebar',
                                    'iconColor' => 'text-primary',
                                ],
                                [
                                    'card' => 'cat-pink',
                                    'icon' => 'bi-code-slash',
                                    'iconColor' => 'text-danger',
                                ],
                            ];

                            $style = $styles[$index % count($styles)];
                        @endphp

                        <article class="cat-card {{ $style['card'] }}"
                            onclick="location.href='{{ route('materi', $kat->idkategori) }}'" style="cursor:pointer">

                            <div class="cat-decor"></div>
                            <span class="cat-notch"></span>

                            <div class="cat-icon">
                                <i class="bi {{ $style['icon'] }} {{ $style['iconColor'] }}"></i>
                            </div>

                            <div>
                                <div class="cat-title">{{ $kat->namakategori }}</div>
                                <small class="cat-sub">
                                    {{ $kat->total_materi }} Materi
                                </small>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-center mb-1 mt-2">
                    <div class="section-title">Rekomendasi Tutor</div>
                    <a href="{{ url('/tutor') }}" class="badge-pill">Lihat Semua</a>
                </div>
                <div class="section-sub small mb-2">Cari Tutor Yang Cocok Untukmu</div>

                <div class="snap-x">
                    @foreach ($tutor as $index => $t)
                        @php
                            $bgClass = $index % 3 == 0 ? 'rec-orange' : ($index % 3 == 1 ? 'rec-lilac' : 'rec-pink');
                        @endphp
                        <article class="rec-card {{ $bgClass }}"
                            onclick="location.href='{{ route('profiletutor', $t->idtutor) }}'" style="cursor:pointer">
                            <div class="rec-image">
                                <img src="{{ asset($t->fototutor) }}" alt="{{ $t->nama }}">
                            </div>
                            <div class="rec-info">
                                <div class="rec-name">{{ $t->nama }}</div>
                                <div class="rec-role">{{ $t->pekerjaan }}</div>
                                <div class="rec-rating">
                                    <i class="bi bi-star-fill"></i>
                                    {{ number_format($t->ratingtutor, 1) }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection


@section('navbar')
    @include('layout.Navbar')
@endsection