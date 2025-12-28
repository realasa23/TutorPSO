@extends('layout.Mobile-View')

@section('page-style')
    <style>
        .mobile-container {
            background-image: url('{{ asset('Background Review.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 0;
        }

        .header-nav {
            padding: 40px 20px 7px 25px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-back {
            background: none;
            border: none;
            padding: 0;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            margin-top: 5px;
            margin-bottom: 20px;
            height: 160px;
            justify-content: center;
        }

        .circle-asset {
            position: absolute;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border: 5px solid #FFB7C5;
            z-index: 2;
        }

        .content-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            padding: 0 25px;
        }

        .title-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: #212529;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle-text {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .star-container {
            display: flex;
            margin-bottom: 10px;
        }

        .star-img {
            width: 50px;
            height: 50px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .star-img:hover {
            transform: scale(1.1);
        }

        .label-small {
            font-size: 16px;
            font-weight: 600;
            color: #555;
            margin-bottom: 10px;
        }

        .tags-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tag-pill {
            background-color: #B1BCF1;
            color: #FFFFFF;
            padding: 4px 14px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #B1BCF1;
            cursor: pointer;
            transition: all .2s ease;
        }

        .tag-pill:hover {
            background-color: #8E9DDB;
            transform: translateY(-2px);
        }

        .tag-pill.active {
            background-color: #8E9DDB;
            transform: scale(0.95);
        }


        .form-area {
            width: 100%;
            padding-bottom: 30px;
        }

        .comment-box {
            border-radius: 20px;
            border: none;
            padding: 15px;
            font-size: 14px;
            resize: none;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 200px;
            width: 100%;
        }

        .btn-kirim {
            background-color: #312E49;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 18px;
            width: 100%;
            margin-bottom: 12px;
        }

        .btn-lapor {
            background-color: #FF8E72;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 18px;
            width: 100%;
            text-align: center;
            text-decoration: none;
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="mobile-container">

        {{-- HEADER --}}
        <div class="header-nav">
            <button class="btn-back" onclick="history.back()">
                <i class="bi bi-chevron-left fs-3" style="color:#333;"></i>
            </button>
        </div>

        {{-- FOTO TUTOR --}}
        <div class="profile-section">
            <div class="circle-asset" style="background-image: url('{{ asset($pesanan->fototutor) }}');">
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="content-section">
            <h2 class="title-text">Ayo Ulas Sesi Tutormu</h2>
            <p class="subtitle-text">
                Bagaimana sesimu bersama <strong>{{ $pesanan->nama_tutor }}</strong>?
                Bagikan pengalamanmu dengan kami!
            </p>

            {{-- STAR RATING --}}
            <div class="star-container">
                @for ($i = 1; $i <= 5; $i++)
                    <img src="{{ asset('star rating-grey.png') }}" class="star-img" data-value="{{ $i }}">
                @endfor
            </div>

            <p class="label-small">Tentang Tutormu...</p>

            {{-- TAG --}}
            <div class="tags-wrapper">
                @foreach (['Tepat Waktu', 'Ramah', 'Berwawasan Luas', 'Mudah Dipahami', 'Sopan', 'Materi Jelas'] as $tag)
                    <span class="tag-pill">{{ $tag }}</span>
                @endforeach
            </div>

            {{-- FORM --}}
            <div class="form-area">
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="idpesanan" value="{{ $pesanan->idpesanan }}">

                    <input type="hidden" name="rating" id="ratingValue">

                    <input type="hidden" name="tagpenilaian" id="tagValue">

                    <textarea name="komentar" class="comment-box" placeholder="Beritahu kami lebih..."></textarea>

                    <button type="submit" class="btn-kirim"> KIRIM </button>
                </form>

                {{-- <a href="{{ route('laporan.create', $idpesanan) }}">
                    <button type="button" class="btn-report">
                        LAPORKAN TUTOR
                    </button>
                </a> --}}
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* ================= STAR RATING ================= */
            const stars = document.querySelectorAll('.star-img');
            const ratingInput = document.getElementById('ratingValue');
            const yellowStar = "{{ asset('star rating-yellow.png') }}";
            const greyStar = "{{ asset('star rating-grey.png') }}";

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.dataset.value);
                    ratingInput.value = value;

                    stars.forEach(s => {
                        s.src = parseInt(s.dataset.value) <= value ?
                            yellowStar :
                            greyStar;
                    });
                });
            });

            /* ================= VALIDASI SUBMIT ================= */
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                if (!ratingInput.value || parseInt(ratingInput.value) < 1) {
                    e.preventDefault();
                    alert('Silakan pilih rating terlebih dahulu ⭐');
                }
            });

            /* ================= TAG PILL ================= */
            const pills = document.querySelectorAll('.tag-pill');
            const tagInput = document.getElementById('tagValue');
            const textArea = document.querySelector('textarea[name="komentar"]');

            let selectedTags = [];

            pills.forEach(pill => {
                pill.addEventListener('click', () => {
                    const text = pill.innerText;

                    pill.classList.toggle('active');

                    if (selectedTags.includes(text)) {
                        selectedTags = selectedTags.filter(t => t !== text);
                    } else {
                        selectedTags.push(text);
                    }

                    // hidden input (buat DB)
                    tagInput.value = selectedTags.join(',');

                    // textarea (visual feedback)
                    textArea.value = selectedTags.join(', ');
                });
            });

        });
    </script>
@endsection
