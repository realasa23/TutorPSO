{{-- Harya Raditya Handoyo - 5026231176 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        :root {
            --bg-start: #c9d2ff;
            --bg-mid: #a9b7ff;
            --bg-end: #8fc3ff;
            --surface: #ffffff;
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
            --panel-radius: 24px;
            --cat-w: 100px;
            --card-h: 116px;
            --card-r: 16px;
            --notch: 30px;
            --pad-x: 12px;
            --pad-r: 20px;
            --pad-y: 10px;
            --title-size: .84rem;
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

        .cat-card {
            position: relative;
            border-radius: var(--card-r);
            height: var(--card-h);
            padding: var(--pad-y) var(--pad-r) var(--pad-y) var(--pad-x);
            color: #1b2430;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 8px;
            isolation: isolate;
        }

        .cat-decor {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
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
            z-index: 0;
        }

        .cat-card::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            border-radius: inherit;
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

        .cat-footer {
            margin-top: auto;
            z-index: 1;
            padding-top: 2px;
        }

        .cat-title {
            font-size: var(--title-size);
            font-weight: 800;
            line-height: 1.12;
            margin: 0 0 2px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }

        .cat-sub {
            color: #ffffff;
            opacity: .95;
            font-weight: 500;
            font-size: .78rem
        }

        .cat-orange {
            background: linear-gradient(135deg, var(--orange-1), var(--orange-2));
            color: var(--orange-ink);
        }

        .cat-indigo {
            background: linear-gradient(135deg, var(--indigo-1), var(--indigo-2));
            color: var(--indigo-ink);
        }

        .cat-pink {
            background: linear-gradient(135deg, var(--pink-1), var(--pink-2));
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
                <div class="row g-3 row-cols-3">
                    @forelse ($results as $item)
                        <div class="col">
                            @php
                                $url = '#';
                                if ($item->type === 'Kategori') {
                                    $url = route('materi', $item->id);
                                } elseif ($item->type === 'Mata Kuliah') {
                                    $url = route('sesi', $item->id);
                                } elseif ($item->type === 'Tutor') {
                                    $url = route('profiletutor', $item->id);
                                }
                                elseif ($item->type === 'Sesi Tutor') {
                                    $url = route('pesanan.tanggal', $item->id);
                                }
                            @endphp

                            <a href="{{ $url }}" class="text-decoration-none">
                                <article class="cat-card cat-{{ $item->theme }} h-100">
                                    <div class="cat-decor"></div>
                                    <span class="cat-notch"></span>
                                    <div class="cat-icon">
                                        <i class="bi {{ $item->icon }}"></i>
                                    </div>
                                    <div class="cat-footer">
                                        <h6 class="cat-title">{{ $item->title }}</h6>
                                        <small class="cat-sub">{{ $item->subtitle }}</small>
                                    </div>
                                </article>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted mt-5">
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
