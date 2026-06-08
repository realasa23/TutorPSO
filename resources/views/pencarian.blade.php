{{-- Harya Raditya Handoyo - 5026231176 --}}
@extends('layout.Mobile-View')
@section('title', 'Pencarian')

@section('page-style')
    <style>
        :root {
            --bg-start: #c9d2ff;
            --bg-mid: #a9b7ff;
            --surface: #ffffff;
            --ink-dim: #667085;
            
            /* Warna Teks Kartu */
            --orange-ink: #7a3600;
            --indigo-ink: #24338b;
            --pink-ink: #7e2241;
            
            --panel-radius: 24px;
            --cat-w: 100%;
            --cat-h: 140px; /* Disesuaikan dengan kategori */
            --card-r: 16px;
            --notch: 30px;
        }

        .header-page {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #24304a;
        }

        .header-page-title {
            font-size: 1.32rem;
            font-weight: 800;
            margin: 0
        }

        .btn-icon-back {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #1d2433;
            text-decoration: none;
        }

        .search-input-group {
            border-radius: 999px;
            overflow: hidden;
            box-shadow: none;
        }

        .search-input-group .form-control {
            border: 0;
            height: 46px;
            box-shadow: none
        }

        .search-input-group .input-group-text {
            background: #fff;
            border: 0
        }

        .surface {
            background: var(--surface);
            border-top-left-radius: var(--panel-radius);
            border-top-right-radius: var(--panel-radius);
            box-shadow: none;
            min-height: 100vh;
            margin-bottom: -50px;
            padding-bottom: 150px;
        }

        /* --- Gaya Kartu Disesuaikan dengan Kategori --- */
        .cat-card {
            border-radius: var(--card-r);
            position: relative;
            flex: 0 0 var(--cat-w);
            height: var(--cat-h);
            width: 100%;
            padding: 10px 18px 10px 12px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #1b2430;
            overflow: hidden;
            isolation: isolate;
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
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .04);
            z-index: 0;
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
            font-size: 20px;
        }

        .cat-title {
            z-index: 1;
            margin: 20px 0 2px;
            padding-right: 15px;
            font-weight: 600;
            line-height: 1.15;
            font-size: 15px;
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
            font-size: 14px;
        }

        /* Menggunakan Background Image seperti di Kategori */
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
    </style>
@endsection

@section('content')
    <header class="container py-3 px-3 header-page">
        <a href="{{ route('home') }}" class="btn-icon-back" aria-label="Kembali"><i class="bi bi-chevron-left"></i></a>
        <h1 class="header-page-title">Pencarian</h1>
        <span class="btn-icon-back" style="opacity:0"></span>
    </header>

    <div class="container px-3 pb-3">
        <form method="GET" action="{{ route('search') }}">
            <div class="input-group search-input-group">
                <span class="input-group-text ps-3">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="q" value="{{ $keyword ?? '' }}" class="form-control"
                    placeholder="Cari Tutor, Sesi, Mata Kuliah" />
            </div>
        </form>
    </div>

    <main class="container px-0">
        <div class="surface p-3">
            @if (!empty($keyword))
                {{-- Diubah menjadi 2 kolom (row-cols-2) mengikuti Kategori --}}
                <div class="row g-3 row-cols-2">
                    @forelse ($results as $item)
                        @php
                            $url = '#';
                            $theme = 'cat-indigo'; // Default
                            $icon = 'bi-search';
                            $iconColor = 'text-dark';
                            $title = $item->nama;
                            $subtitle = '';

                            // Penyesuaian tipe dan warna icon
                            if ($item->tipe === 'matkul') {
                                $url = route('sesi', $item->id);
                                $theme = 'cat-indigo';
                                $icon = 'bi-window-sidebar';
                                $iconColor = 'text-primary';
                                $subtitle = 'Mata Kuliah';
                            } elseif ($item->tipe === 'tutor') {
                                $url = route('profiletutor', $item->id);
                                $theme = 'cat-pink';
                                $icon = 'bi-person';
                                $iconColor = 'text-danger';
                                $subtitle = 'Tutor';
                            } elseif ($item->tipe === 'sesi') {
                                $url = route('pesanan.tanggal', $item->id);
                                $theme = 'cat-orange';
                                $icon = 'bi-calendar-event';
                                $iconColor = 'text-warning';
                                $subtitle = 'Sesi Tutor';
                            }
                        @endphp

                        <div class="col">
                            <a href="{{ $url }}" class="text-decoration-none">
                                <article class="cat-card {{ $theme }}" style="cursor:pointer">
                                    <div class="cat-decor"></div>
                                    <span class="cat-notch"></span>

                                    <div class="cat-icon">
                                        <i class="bi {{ $icon }} {{ $iconColor }}"></i>
                                    </div>

                                    <div>
                                        <div class="cat-title">{{ $title }}</div>
                                        <small class="cat-sub">{{ $subtitle }}</small>
                                    </div>
                                </article>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted mt-5" style="width: 100%">
                            Tidak ada hasil pencarian
                        </div>
                    @endforelse
                </div>
            @else
                <div class="text-center text-muted mt-5">
                    Ketik kata kunci untuk mulai mencari
                </div>
            @endif
        </div>
    </main>
@endsection