@extends('layout.Mobile-View')

@section('page-style')
    <style>
        /* --- Layout Base --- */
        .mobile-container {
            background-image: url('{{ asset('Background Review.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 0;
        }

        /* --- Header --- */
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

        /* --- Profile Image Section --- */
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
            background-image: url('{{ asset('foto tutor - circle.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            z-index: 1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* --- Text & Rating --- */
        .content-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 25px;
        }

        .title-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 22px;
            color: #212529;
            margin-top: 15px;
            margin-bottom: 5px;
            text-align: center;
        }

        .subtitle-text {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            line-height: 1.4;
            margin-bottom: 2px;
        }

        .star-container {
            display: flex;
            margin-bottom: 10px;
        }

        /* Styling Gambar Bintang */
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

        /* --- Tags --- */
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
            white-space: nowrap;
            cursor: pointer; 
            transition: background-color 0.2s ease;
        }

        .tag-pill:hover {
            background-color: #8E9DDB; 
            transform: translateY(-2px); 
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); 
        }

        .tag-pill:active {
            transform: scale(0.95);
            background-color: #7F92E6;
        }

        /* --- Form & Buttons --- */
        .form-area {
            width: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
            padding-bottom: 30px;
        }

        .custom-textarea {
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

        .custom-textarea:focus {
            outline: none;
        }

        /* Tombol KIRIM */
        .btn-kirim {
            background-color: #312E49;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s ease; 
        }

        .btn-kirim:hover {
            background-color: #403D58; 
            transform: translateY(-2px); 
            box-shadow: 0 6px 12px rgba(49, 46, 73, 0.3); 
        }

        .btn-kirim:active {
            transform: scale(0.98); 
        }

        /* Tombol LAPORKAN */
        .btn-lapor {
            background-color: #FF8E72;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            font-size: 14px;
            display: block;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease; 
        }

        .btn-lapor:hover {
            background-color: #E67E65; 
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 142, 114, 0.3);
            color: white; 
        }

        .btn-lapor:active {
            transform: scale(0.98);
        }

        
    </style>
@endsection

@section('content')

    <div class="header-nav">
        <button class="btn-back" onclick="history.back()">
            <i class="bi bi-chevron-left fs-3" style="color: #333;"></i>
        </button>
    </div>

    <div class="profile-section">
        <div class="circle-asset"></div>
    </div>

    <div class="content-section">
        <h2 class="title-text">Ayo Ulas Tutor-mu</h2>
        <p class="subtitle-text">Bagaimana sesi-mu? Bagikan pengalamanmu kepada dunia</p>

        <div class="star-container" id="starContainer">
            <img src="{{ asset('star rating-grey.png') }}" class="star-img" data-value="1">
            <img src="{{ asset('star rating-grey.png') }}" class="star-img" data-value="2">
            <img src="{{ asset('star rating-grey.png') }}" class="star-img" data-value="3">
            <img src="{{ asset('star rating-grey.png') }}" class="star-img" data-value="4">
            <img src="{{ asset('star rating-grey.png') }}" class="star-img" data-value="5">
        </div>

        <p class="label-small">Tentang Tutor-mu...</p>

        <div class="tags-wrapper">
            <span class="tag-pill">Tepat Waktu</span>
            <span class="tag-pill">Ramah</span>
            <span class="tag-pill">Berwawasan Luas</span>
            <span class="tag-pill">Mudah Dipahami</span>
            <span class="tag-pill">Sopan</span>
            <span class="tag-pill">Materi Jelas</span>
        </div>

        <div class="form-area">
            <form action="{{ route('review.store') }}" method="POST" style="width: 100%;">
                @csrf <input type="hidden" name="rating" id="ratingValue" value="0">
                
                <input type="hidden" name="tagpenilaian" id="tagValue" value="">

                <textarea name="ulasan" id="reviewText" class="custom-textarea" placeholder="Beritahu kami lebih..."></textarea>

                <button type="submit" class="btn-kirim">KIRIM</button>

                <a href="{{ route('laporan.index') }}" class="btn-lapor">
                    LAPORKAN TUTOR
                </a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const stars = document.querySelectorAll('.star-img');
            const ratingInput = document.getElementById('ratingValue');
            const yellowStarUrl = "{{ asset('star rating-yellow.png') }}";
            const greyStarUrl = "{{ asset('star rating-grey.png') }}";

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    ratingInput.value = value;
                    updateStars(value);
                });
            });

            function updateStars(rating) {
                stars.forEach(star => {
                    const starVal = parseInt(star.getAttribute('data-value'));
                    if (starVal <= rating) {
                        star.src = yellowStarUrl;
                    } else {
                        star.src = greyStarUrl;
                    }
                });
            }

            const pills = document.querySelectorAll('.tag-pill');
            const textArea = document.getElementById('reviewText');
            const tagInput = document.getElementById('tagValue');
            
            let selectedTags = []; 
            pills.forEach(pill => {
                pill.addEventListener('click', function() {
                    const text = this.innerText; 
                    let currentVal = textArea.value;

                    this.style.backgroundColor = '#8E9DDB'; 
                    setTimeout(() => { this.style.backgroundColor = '#B1BCF1'; }, 200);

                    if (currentVal.trim() === "") {
                        textArea.value = text;
                    } else if (!currentVal.includes(text)) { 
                        textArea.value = currentVal + ", " + text;
                    }

                    if (!selectedTags.includes(text)) {
                        selectedTags.push(text);
                        tagInput.value = selectedTags.join(',');
                    }
                });
            });
        });
    </script>

@endsection