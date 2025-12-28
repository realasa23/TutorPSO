{{-- 
    Tutor Profile Page
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
--}}

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

        /* HEADER PROFILE */
        .profile-header {
            text-align: center;
            padding: 1rem 0;
        }

        .profile-pic {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            background: rgba(255, 255, 255, .25);
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .profile-name {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 4px;
            color: #1A2B4B;
        }

        .profile-title {
            background: #FEDDE2;
            border-radius: 12px;
            display: inline-block;
            padding: 5px 14px;
            font-size: 16px;
            color: #FD4965;
            opacity: .9;
        }

        .profile-rating {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 0px;
            font-weight: 600;
            color: #1A2B4B;
        }

        .profile-rating i {
            color: #ffc107;
        }

        .surface-profile {
            background: #fff;
            border-top-left-radius: 22px;
            border-top-right-radius: 22px;
            box-shadow: 0 -4px 18px rgba(20, 24, 55, .08);
            padding: 24px 20px 120px;
            flex: 1;
        }

        .surface-profile h2 {
            font-weight: 700;
            font-size: 17px;
            margin-bottom: .75rem;
            color: #1A2B4B;
        }

        .surface-profile p {
            color: #6c757d;
            line-height: 1.6;
        }

        /* REVIEW */
        .review-card {
            display: flex;
            gap: .75rem;
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 1px solid #f0f0f0;
            flex: 1;
        }

        .review-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #dee2ff;
            display: grid;
            place-items: center;
            font-weight: 700;
            color: #3f51b5;
            flex-shrink: 0;
        }

        .review-name {
            font-weight: 700;
            margin: 0;
            color: #1A2B4B;
        }

        .review-text {
            margin-top: 4px;
            font-size: .95rem;
        }

        /* BOTTOM ACTION */
        .bottom-action-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: min(393px, 100%);
            background: #fff;
            padding: 1rem;
            padding-bottom: calc(1rem + env(safe-area-inset-bottom));
            border-top-left-radius: 22px;
            border-top-right-radius: 22px;
            box-shadow: 0 -4px 18px rgba(20, 24, 55, .10);
            display: flex;
            gap: .75rem;
            z-index: 100;
        }

        .bottom-action-nav .btn {
            flex: 1;
            border-radius: 999px;
            font-weight: 700;
        }
    </style>
@endsection

@section('content')
    {{-- APP BAR --}}
    <div class="header-bg">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn p-0" onclick="history.back()">
                    <i class="bi bi-chevron-left fs-4 text-dark"></i>
                </button>
                <h3 class="page-title">Profile Tutor</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    {{-- HEADER PROFILE --}}
    <section class="profile-header container">
        <div class="profile-pic">
            <img src="{{ asset($tutor->fototutor) }}" alt="{{ $tutor->nama }}">
        </div>

        <h1 class="profile-name">
            {{ $tutor->nama }}
        </h1>

        <p class="profile-title">
            {{ $tutor->pekerjaan }}
        </p>

        <div class="profile-rating">
            <i class="bi bi-star-fill"></i>
            {{ number_format($tutor->ratingtutor, 1) }}
            <span class="text-muted">
                ({{ $tutor->total_review }} ulasan)
            </span>
        </div>
    </section>

    {{-- CONTENT --}}
    <div class="surface-profile">
        <section>
            <h2>Deskripsi</h2>
            <p>
                {{ $tutor->deskripsi ?? 'Tutor ini belum menambahkan deskripsi.' }}
            </p>
        </section>

        <section class="mt-4">
            <h2>Ulasan</h2>

            @forelse ($reviews as $r)
                <div class="review-card">
                    <div class="review-avatar">
                        {{ strtoupper(substr($r->username, 0, 1)) }}
                    </div>
                    <div>
                        <p class="review-name">
                            {{ $r->username }}
                        </p>
                        <div class="profile-rating justify-content-start">
                            <i class="bi bi-star-fill"></i>
                            {{ number_format($r->rating, 1) }}
                        </div>
                        <p class="review-text">
                            {{ $r->komentar }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-muted">
                    Belum ada ulasan untuk tutor ini.
                </p>
            @endforelse
        </section>
    </div>
@endsection
