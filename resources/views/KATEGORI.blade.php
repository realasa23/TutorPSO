{{--
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
--}}

@extends('layout.Mobile-View')

@section('title', 'Tutor App – Home')

@section('page-style')
    <style>
        :root {
            --radius-xl: 18px;
            --bg-start: #c9d2ff;
            --bg-mid: #a9b7ff;
            --dark-text: #1A2B4B;
            --grey-text: #6c757d;

            --orange-1: #ffd2a6;
            --orange-2: #ffb778;
            --orange-ink: #7a3600;
            --indigo-1: #cfd6ff;
            --indigo-2: #aeb9ff;
            --indigo-ink: #24338b;
            --pink-1: #ffc7d6;
            --pink-2: #ff9fb7;
            --pink-ink: #7e2241;

            --card-h: 140px;
            --card-r: 16px;
            --notch: 30px;
            --pad-x: 12px;
            --pad-r: 20px;
            --pad-y: 10px;
            --title-size: .84rem;
        }

        html,
        body {
            height: 100%;
        }

        .category {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }


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
            margin-top: 0px;
            z-index: 5;
            position: relative;

        }

        /* CSS Kartu (dari 'pencarian') */
        .cat-card {
            border-radius: 16px;
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
            margin: 20px 0 2px;
            padding-right: 30px;
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
    <div class="category">
        <div class="header-bg">
            <div class="container-fluid px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <button class="btn p-0" onclick="history.back()">
                        <i class="bi bi-chevron-left fs-4 text-dark"></i>
                    </button>
                    <h3 class="page-title">Kategori</h3>
                    <div style="width: 24px;"></div>
                </div>
            </div>
        </div>

        <div class="content-container">
            @php
                $iconMap = [
                    'Teknologi Informasi' => ['icon' => 'bi-book', 'color' => 'text-warning'],
                    'Software Development' => ['icon' => 'bi-code-slash', 'color' => 'text-primary'],
                    'UI & UX Design' => ['icon' => 'bi-palette', 'color' => 'text-danger'],
                    'Data & Algoritma' => ['icon' => 'bi-diagram-3', 'color' => 'text-warning'],
                    'Sistem Informasi' => ['icon' => 'bi-database', 'color' => 'text-primary'],
                    'Manajemen Proyek' => ['icon' => 'bi-kanban', 'color' => 'text-danger'],
                ];

                $cardStyles = ['cat-orange', 'cat-indigo', 'cat-pink'];
            @endphp

            <div class="row g-3 row-cols-2">
                @foreach ($kategori as $index => $kat)
                    @php
                        $style = $cardStyles[$index % count($cardStyles)];
                        $iconData = $iconMap[$kat->namakategori] ?? [
                            'icon' => 'bi-book',
                            'color' => 'text-secondary',
                        ];
                    @endphp

                    <div class="col">
                        <article class="cat-card {{ $style }}"
                            onclick="location.href='{{ url('/kategori/' . $kat->idkategori . '/materi') }}'"
                            style="cursor:pointer">
                            <div class="cat-decor"></div>
                            <span class="cat-notch"></span>

                            <div class="cat-icon">
                                <i class="bi {{ $iconData['icon'] }} {{ $iconData['color'] }}"></i>
                            </div>

                            <div>
                                <div class="cat-title">{{ $kat->namakategori }}</div>
                                <small class="cat-sub">
                                    {{ $kat->total_materi }} Materi
                                </small>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const tabs = document.querySelectorAll('.btn-tab');

        function handleTabClick(event) {
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', handleTabClick);
        });
    </script>
@endsection
