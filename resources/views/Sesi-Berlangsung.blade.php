{{-- Nailah Adlina - 5026231068 --}}
@extends ('layout.Mobile-View')
@section('page-style')
    <style>
        body,
        html {
            margin: 0;
            height: 100%;
        }

        .fullscreen-container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .fullscreen-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .button-row {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
        }

        .img-btn {
            width: 48px;
            height: 48px;
            padding: 0;
            border: none;
            background: transparent;
        }

        .img-btn img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
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
