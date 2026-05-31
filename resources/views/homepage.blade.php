{{-- Harya Raditya Handoyo - 5026231176 --}}
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
            --rec-w: 148px;
            --rec-h: 200px;
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
        }

        * { box-sizing: border-box }
        body { font-family: 'Poppins', system-ui }
        a { text-decoration: none }

        /* ── Header ── */
        .header-bg {
            padding: 14px 14px 0;
        }

        .hello-small {
            color: #10224d;
            font-size: 15px;
            font-style: italic;
            font-weight: 400;
        }

        .hello-name {
            font-size: 17px;
            font-weight: 700;
            color: #10224d;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            color: #10224d;
            border: 0;
            background: transparent;
            font-size: 18px;
        }

        /* ── Promo carousel ── */
        .hero-body {
            padding: 10px 14px 0;
        }

        .promo-card-detail {
            height: 155px;
            background-size: cover;
            background-position: right center;
            background-repeat: no-repeat;
            border-radius: 18px;
            box-shadow: 0 4px 10px rgba(0,0,0,.12);
            padding: 18px 18px;
            display: flex;
            align-items: center;
            margin-bottom: 4px;
        }

        .promo-card-detail.trial  { background-image: url('{{ asset('trial-card.png') }}'); }
        .promo-card-detail.refund { background-image: url('{{ asset('refund-card.png') }}'); }
        .promo-card-detail.tutor  { background-image: url('{{ asset('tutor-card.png') }}'); }

        .promo-content { max-width: 60%; }
        .promo-content.trial  { color: #FF687F; }
        .promo-content.refund { color: #D65609; }
        .promo-content.tutor  { color: #566CD8; }

        .promo-content h5 {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 3px;
            line-height: 1.3;
        }

        .promo-content p {
            font-size: 13px;
            opacity: .9;
            margin-bottom: 10px;
        }

        .btn-resp {
            border-radius: 10px;
            padding: .35rem .8rem;
            font-weight: 600;
            font-size: 13px;
            background: transparent;
        }

        .btn-promo-trial  { border: 1.5px solid #FF687F; color: #FF687F; }
        .btn-promo-refund { border: 1.5px solid #D65609; color: #D65609; }
        .btn-promo-tutor  { border: 1.5px solid #566CD8; color: #566CD8; }

        /* Carousel dots */
        .carousel-indicators {
            position: static;
            margin: 6px 0 0;
            justify-content: center;
        }

        .carousel-indicators [data-bs-target] {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            border: 0;
            background: #c5ceff;
            margin: 0 3px;
            opacity: 1;
        }

        .carousel-indicators .active {
            background: #566CD8;
            width: 20px;
            border-radius: 4px;
        }

        /* ── White content card ── */
        .content-container {
            flex: 1;
            padding: 16px 14px;
            background: white;
            border-top-left-radius: 22px;
            border-top-right-radius: 22px;
            box-shadow: 0 -2px 10px rgba(0,0,0,.08);
            margin-top: 14px;
            position: relative;
            z-index: 5;
            /* Enough padding at bottom for navbar */
            padding-bottom: 90px;
        }

        .section-title {
            color: #10224d;
            font-weight: 700;
            font-size: 17px;
        }

        .section-sub { color: var(--ink-dim) }

        .badge-pill {
            display: inline-block;
            background: #eef1ff;
            color: #10224d;
            border-radius: 12px;
            font-weight: 500;
            font-size: 12px;
            padding: .3rem .65rem;
        }

        /* ── Horizontal scroll strip ── */
        .snap-x {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 4px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .snap-x::-webkit-scrollbar { display: none }

        /* ── Category cards ── */
        .cat-card {
            position: relative;
            flex: 0 0 var(--cat-w);
            height: var(--cat-h);
            border-radius: var(--cat-r);
            padding: 10px 16px 10px 10px;
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
            right: calc(-1 * var(--notch) / 2);
            top: 50%;
            width: var(--notch);
            height: var(--notch);
            transform: translateY(-50%);
            background: #fff;
            border-radius: 50%;
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
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
        }

        .cat-title {
            z-index: 1;
            margin: 2px 0 2px;
            font-weight: 600;
            line-height: 1.2;
            font-size: 13px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cat-sub {
            z-index: 1;
            color: #ffffff;
            opacity: .95;
            font-weight: 500;
            font-size: 12px;
        }

        .cat-orange { background-image: url('{{ asset('card-orange.png') }}');  color: var(--orange-ink); }
        .cat-indigo { background-image: url('{{ asset('card-lilac.png') }}');   color: var(--indigo-ink); }
        .cat-pink   { background-image: url('{{ asset('card-pink.png') }}');    color: var(--pink-ink);   }

        /* ── Tutor recommendation cards ── */
        .rec-card {
            flex: 0 0 var(--rec-w);
            height: var(--rec-h);
            border-radius: 18px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            box-shadow: 0 2px 10px rgba(30,40,80,.12);
            scroll-snap-align: start;
        }

        .rec-orange { background-image: url('{{ asset('rec-orange.png') }}'); }
        .rec-lilac  { background-image: url('{{ asset('rec-lilac.png') }}');  }
        .rec-pink   { background-image: url('{{ asset('rec-pink.png') }}');   }

        /* Photo area — flex-grow fills remaining space above the info strip */
        .rec-image {
            flex: 1;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            overflow: hidden;
            padding: 0 6px;
        }

        .rec-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            border-radius: 12px 12px 0 0;
        }

        /* Fallback avatar when no real photo */
        .rec-avatar-fallback {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,.7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 700;
            color: #566CD8;
            margin-bottom: 8px;
        }

        .rec-info {
            background: #ffffff;
            width: 100%;
            padding: 8px 10px 10px;
        }

        .rec-name {
            font-size: 13px;
            font-weight: 700;
            color: #2b2d42;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rec-role {
            font-size: 11px;
            color: #7b7f9e;
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rec-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 600;
            color: #1b2430;
        }

        .rec-rating i { color: #ffc107; font-size: 11px; }
    </style>
@endsection

@section('content')
    <div class="homepage-container">

        {{-- Header --}}
        <div class="header-bg">
            <div class="d-flex justify-content-between align-items-center">
                <span class="hello-small">
                    Halo, <strong class="hello-name">{{ $user->name ?? $user->username ?? 'User' }}</strong>
                </span>
                <a class="btn-icon" aria-label="Cari" href="{{ route('search') }}">
                    <i class="bi bi-search"></i>
                </a>
            </div>
        </div>

        {{-- Promo Carousel --}}
        <section class="hero">
            <div class="hero-body">
                <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel"
                     data-bs-touch="true" data-bs-interval="3000">

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2"></button>
                    </div>

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

        {{-- Main content --}}
        <main class="content-container">

            {{-- Kategori --}}
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div class="section-title">Kategori</div>
                <a href="{{ route('kategori') }}" class="badge-pill">Lihat Semua</a>
            </div>
            <div class="section-sub small mb-3">Pilih Kategori Bidang yang Kamu Inginkan</div>

            <div class="snap-x mb-4">
                @foreach ($kategori as $index => $kat)
                    @php
                        $styles = [
                            ['card' => 'cat-orange', 'icon' => 'bi-database',      'iconColor' => 'text-warning'],
                            ['card' => 'cat-indigo', 'icon' => 'bi-window-sidebar','iconColor' => 'text-primary'],
                            ['card' => 'cat-pink',   'icon' => 'bi-code-slash',    'iconColor' => 'text-danger'],
                        ];
                        $style = $styles[$index % count($styles)];
                    @endphp

                    <article class="cat-card {{ $style['card'] }}"
                             onclick="location.href='{{ route('materi', $kat->idkategori) }}'"
                             style="cursor:pointer">
                        <div class="cat-decor"></div>
                        <span class="cat-notch"></span>
                        <div class="cat-icon">
                            <i class="bi {{ $style['icon'] }} {{ $style['iconColor'] }}"></i>
                        </div>
                        <div>
                            <div class="cat-title">{{ $kat->namakategori }}</div>
                            <small class="cat-sub">{{ $kat->total_materi }} Materi</small>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Rekomendasi Tutor --}}
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div class="section-title">Rekomendasi Tutor</div>
                <a href="{{ url('/tutor') }}" class="badge-pill">Lihat Semua</a>
            </div>
            <div class="section-sub small mb-3">Cari Tutor Yang Cocok Untukmu</div>

            <div class="snap-x">
                @foreach ($tutor as $index => $t)
                    @php
                        $bgClass = $index % 3 == 0 ? 'rec-orange' : ($index % 3 == 1 ? 'rec-lilac' : 'rec-pink');
                        $initials = collect(explode(' ', $t->nama))->take(2)->map(fn($w) => strtoupper($w[0]))->join('');
                        $isExternal = str_starts_with($t->fototutor, 'http');
                    @endphp
                    <article class="rec-card {{ $bgClass }}"
                             onclick="location.href='{{ route('profiletutor', $t->idtutor) }}'"
                             style="cursor:pointer">
                        <div class="rec-image">
                            @if ($isExternal)
                                {{-- URL eksternal (ui-avatars dll) — tampilkan sebagai inisial sendiri --}}
                                <div class="rec-avatar-fallback">{{ $initials }}</div>
                            @else
                                <img src="{{ asset($t->fototutor) }}"
                                     alt="{{ $t->nama }}"
                                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="rec-avatar-fallback" style="display:none">{{ $initials }}</div>
                            @endif
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

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('layout.Navbar')
@endsection