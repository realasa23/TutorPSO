{{-- Harya Raditya Handoyo - 5026231176 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        :root {
            --card-h: 132px;
            --radius-xl: 18px;
            --dark-text: #1A2B4B;

            --orange-1: #ffd2a6;
            --orange-2: #ffb778;
            --pink-1: #ffc7d6;
            --pink-2: #ff9fb7;
            --indigo-1: #cfd6ff;
            --indigo-2: #aeb9ff;
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

        .tutor-card {
            position: relative;
            height: 120px;
            border-radius: 16px;
            padding: 14px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tc-orange {
            background-image: url('{{ asset('card-detail-orange.png') }}');
            color: #7a3600;
        }

        .tc-pink {
            background-image: url('{{ asset('card-detail-pink.png') }}');
            color: #7e2241;
        }

        .tc-indigo {
            background-image: url('{{ asset('card-detail-lilac.png') }}');
            color: #24338b;
        }

        .tc-avatar {
            width: 86px;
            height: 100%;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            flex-shrink: 0;
        }

        .tc-avatar img {
            height: 100%;
            width: auto;
            object-fit: cover;
        }

        .tc-content {
            flex: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .tc-name {
            font-weight: 800;
            font-size: 16px;
            margin-bottom: 2px;
        }

        .tc-role {
            font-size: 14px;
            font-weight: 500;
            opacity: .9;
        }

        .tc-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tc-rating {
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .tc-rating i {
            color: #ffc107;
            margin-right: 4px;
        }

        .btn-detail {
            background: #fff;
            border-radius: 999px;
            padding: .25rem .7rem;
            font-size: .75rem;
            font-weight: 600;
            border: 0;
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
                <h3 class="page-title">Tutor</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    <main class="content-container">
        <div class="container">
            @php
                $bgStyles = ['tc-orange', 'tc-pink', 'tc-indigo'];
            @endphp

            @forelse ($tutor as $index => $t)
                @php
                    $bg = $bgStyles[$index % count($bgStyles)];
                @endphp

                <div class="tutor-card {{ $bg }} mb-3">
                    <a href="{{ url('/tutor/' . $t->idtutor) }}" class="tc-avatar">
                        <img src="{{ asset($t->fototutor) }}" alt="{{ $t->nama }}">
                    </a>
                    <div class="tc-content">
                        <div>
                            <div class="tc-name">{{ $t->nama }}</div>
                            <div class="tc-role">{{ $t->pekerjaan }}</div>
                        </div>
                        <div class="tc-bottom">
                            <div class="tc-rating">
                                <i class="bi bi-star-fill"></i> {{ number_format($t->ratingtutor, 1) }}
                                ({{ $t->total_review }} ulasan)
                            </div>
                            <a href="{{ url('/tutor/' . $t->idtutor) }}" class="btn btn-detail">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    Belum ada tutor tersedia
                </div>
            @endforelse
        </div>
    </main>
@endsection
