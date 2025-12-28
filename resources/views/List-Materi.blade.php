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

        html,
        body {
            height: 100%;
        }

        .materi {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .cat-card {
            position: relative;
            height: 120px;
            border-radius: 16px;
            padding: 16px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cat-orange {
            background-image: url('{{ asset('card-detail-orange.png') }}');
            color: #7a3600;
        }

        .cat-indigo {
            background-image: url('{{ asset('card-detail-lilac.png') }}');
            color: #24338b;
        }

        .cat-pink {
            background-image: url('{{ asset('card-detail-pink.png') }}');
            color: #7e2241;
        }

        .cat-title {
            font-weight: 600;
            font-size: 18px;
        }

        .cat-sub {
            font-size: 15px;
            font-weight: 500;
            color: #7a3600;
            padding-top: 2px;
        }

        .btn-order {
            display: inline-block;
            padding: .35rem .85rem;
            background: #ffffff;
            border-radius: 12px;
            font-weight: 500;
            font-size: 13px;
            color: #1A2B4B;
            text-decoration: none;
            border: 1px solid rgba(0, 0, 0, .08);
            transition: all .2s ease;
        }
    </style>
@endsection

@section('content')
    <div class="materi">
        <div class="header-bg">
            <div class="container-fluid px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <button class="btn p-0" onclick="history.back()">
                        <i class="bi bi-chevron-left fs-4 text-dark"></i>
                    </button>
                    <h3 class="page-title">Materi</h3>
                    <div style="width: 24px;"></div>
                </div>
            </div>
        </div>

        <div class="content-container">
            @php
                $cardStyles = ['cat-orange', 'cat-indigo', 'cat-pink'];
            @endphp

            <div class="row g-3">
                @forelse ($matakuliah as $index => $m)
                    @php
                        $style = $cardStyles[$index % count($cardStyles)];
                    @endphp

                    <div class="col-12">
                        <div class="cat-card {{ $style }}">
                            <div>
                                <div class="cat-title">
                                    {{ $m->namamatkul }}
                                </div>
                                <div class="cat-sub">
                                    {{ $m->jumlah_sesi }} Sesi Tutor
                                </div>
                            </div>

                            <div class="text-end">
                                <a href="{{ route('sesi', $m->idmatkul) }}" class="btn-order">
                                    Lihat Sesi
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-muted text-center py-5">
                        Belum ada materi di kategori ini
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
