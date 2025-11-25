@extends('layout.Mobile-View')

@section('page-style')
<style>
    .header-area {
        padding-top: 40px;
        padding-bottom: 90px; 
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        position: relative;
        z-index: 0;
        flex-shrink: 0;
    }

    .page-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        margin: 0;
        font-size: 22px;
        color: #212529;
        text-align: center;
        flex: 1;
    }

    .tutor-card-wrapper {
        margin-top: -70px; 
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    .tutor-card {
        background-image: url('{{ asset('card lapor tutor-orange.png') }}');
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center;
        
        border-radius: 20px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        
        box-shadow: 0 15px 30px rgba(255, 176, 133, 0.25); 
        min-height: 100px;
    }

    .tutor-info { display: flex; align-items: center; gap: 15px; }
    .img-wrapper { background-color: rgba(255, 255, 255, 0.4); padding: 3px; border-radius: 12px; }
    .profile-img { width: 55px; height: 55px; border-radius: 10px; object-fit: cover; display: block; }
    .tutor-details { display: flex; flex-direction: column; }
    .tutor-name { font-size: 18px; font-weight: 700; color: #A0400B; margin: 0; line-height: 1.2; }
    .matkul-name { font-size: 13px; color: #A0400B; margin: 0; font-weight: 500; }

    .content-area {
        background: white;
        border-top-left-radius: 40px;
        border-top-right-radius: 40px;
        padding: 85px 25px 30px 25px; 
        margin-top: -55px; 
        position: relative;
        z-index: 5;
        flex: 1; 
        display: flex;
        flex-direction: column;
        box-shadow: 0 -10px 30px rgba(0,0,0,0.02);
    }

    .label-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    
    .label-text {
        font-weight: 700;
        font-size: 16px;
        color: #000;
        margin: 0;
    }

    .ubah-link {
        color: #F2994A; 
        font-size: 13px;
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .selected-problem-display {
        width: 100%;
        text-align: center;
        padding: 16px 0; 
        border-radius: 15px;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 25px;      
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .style-orange {
        background-image: url('{{ asset("btn masalah-orange.png") }}');
        color: #D65609;
    }
    .style-blue {
        background-image: url('{{ asset("btn masalah-blue.png.png") }}');
        color: #355389;
    }
    .style-pink {
        background-image: url('{{ asset("btn masalah-pink.png.png") }}');
        color: #9C384D;
    }
    .style-purple {
        background-image: url('{{ asset("btn masalah-purple.png.png") }}');
        color: #614A93;
    }
    .style-grey {
        background-image: url('{{ asset("btn masalah-grey.png") }}');
        color: #666666;
    }

    .custom-textarea {
        background-color: #F9F9F9;
        border: 1px solid #EAEAEA;
        border-radius: 15px;
        padding: 15px;
        width: 100%;
        resize: none;
        font-size: 14px;
        color: #555;
        outline: none;
        margin-top: 8px;
        min-height: 180px;
    }
    
    .custom-textarea:focus {
        border-color: #A4C8FF;
        background-color: #FFF;
    }

    .btn-submit {
        background-color: #312E49; 
        color: white;
        border: none;
        border-radius: 15px;
        padding: 16px;
        width: 100%;
        font-weight: 700;
        font-size: 15px;
        margin-top: 30px; 
        cursor: pointer;
        box-shadow: 0 5px 15px rgba(49, 46, 73, 0.2);
        transition: transform 0.1s;
    }
    
    .btn-submit:active {
        transform: scale(0.98);
    }

    .btn-back {
        background: none;
        border: none;
        padding: 0;
    }
</style>
@endsection

@section('content')
    @php
        $masalah = $jenisMasalah ?? 'Masalah Umum';
        $styleClass = 'style-blue'; // Default fallback

        if ($masalah == 'Tutor Tidak Hadir') {
            $styleClass = 'style-orange';
        } elseif ($masalah == 'Materi Tidak Sesuai') {
            $styleClass = 'style-pink';
        } elseif ($masalah == 'Masalah Teknis') {
            $styleClass = 'style-purple';
        } elseif ($masalah == 'Lainnya') {
            $styleClass = 'style-grey';
        } elseif ($masalah == 'Kesalahan Jadwal') {
            $styleClass = 'style-blue';
        }
    @endphp

    <div class="header-area">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <button class="btn-back" onclick="history.back()">
                    <i class="bi bi-chevron-left fs-4" style="color: #333;"></i>
                </button>
                <h3 class="page-title">Detail Masalah</h3>
                <div style="width: 24px;"></div>
            </div>
        </div>
    </div>

    <div class="tutor-card-wrapper">
        <div class="tutor-card">
            <div class="tutor-info">
                <div class="img-wrapper">
                    <img src="{{ asset('foto-tutor.jpg') }}" class="profile-img" alt="Khalila">
                </div>
                <div class="tutor-details">
                    <h4 class="tutor-name">Khalila</h4>
                    <p class="matkul-name">Dasar Pemrograman</p>
                    <small style="color: #A0400B; font-size: 11px;">ID: 12345678AB</small>
                </div>
            </div>
            <i class="bi bi-chevron-right" style="color: #A0400B; font-size: 20px;"></i>
        </div>
    </div>

    <div class="content-area">
        
        <form action="{{ route('laporan.store') }}" method="POST" style="display: flex; flex-direction: column; height: 100%;">
            @csrf
            
            <input type="hidden" name="pesanan_id" value="1">
            <input type="hidden" name="jenis_masalah" value="{{ $masalah }}">

            <div class="label-row">
                <span class="label-text">Masalah Yang dipilih</span>
                <a href="{{ route('laporan.index') }}" class="ubah-link">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            </div>

            <div class="selected-problem-display {{ $styleClass }}">
                {{ $masalah }}
            </div>

            <p class="label-text" style="margin-top: 5px;">Alasan</p>
            
            <textarea name="deskripsi" class="custom-textarea" placeholder="Beritahu kami alasannya..." required></textarea>

            <button type="submit" class="btn-submit">
                @if($masalah == 'Tutor Tidak Hadir' || $masalah == 'Kesalahan Jadwal')
                    AJUKAN REFUND
                @else
                    KIRIM LAPORAN
                @endif
            </button>
        </form>
    </div>
@endsection