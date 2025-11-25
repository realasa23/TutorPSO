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
            /* Full layar */
            overflow: hidden;
        }

        .fullscreen-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Foto penuh layar */
        }

        .button-row {
            position: absolute;
            bottom: 30px;
            /* Margin bottom 30 px */
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
            <a href="/berlangsung/end-call">
                <button class="img-btn">
                    <img src="/icons/endcall.png" alt="">
                </button>
            </a>
        </div>
    </div>


@endsection
