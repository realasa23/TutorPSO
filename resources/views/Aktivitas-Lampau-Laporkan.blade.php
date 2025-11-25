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
    }

    .page-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        margin: 0;
        font-size: 22px;
        color: #343446;
        text-align: center;
        flex: 1;
    }

    .tutor-card-wrapper {
        margin-top: -70px; 
        padding: 0 35px;
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
        box-shadow: 0 10px 25px rgba(255, 176, 133, 0.3); 
        z-index: 2; 
        min-height: 100px; 
    }

    .tutor-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .img-wrapper {
        background-color: rgba(255, 255, 255, 0.5);
        padding: 3px;
        border-radius: 12px;
    }

    .profile-img {
        width: 55px;
        height: 55px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
    }

    .tutor-details {
        display: flex;
        flex-direction: column;
    }

    .tutor-name {
        font-size: 18px;
        font-weight: 700;
        color: #A0400B; 
        margin: 0;
        line-height: 1.2;
    }
    
    .matkul-name {
        font-size: 13px;
        color: #A0400B;
        margin: 0;
        font-weight: 500;
    }

    .problem-container {
        background: white;
        border-top-left-radius: 40px;
        border-top-right-radius: 40px;
        padding: 40px 25px 30px 25px;
        margin-top: -55px;
        box-shadow: 0 -5px 20px rgba(0,0,0,0.03);
        position: relative;
        z-index: 1;
        flex: 1;
        width: 100%;
    }

    .section-label {
        font-weight: 700;
        color: #000;
        font-size: 16px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .btn-img {
        width: 100%;
        display: block;
        text-align: center;
        padding:16px 0;
        border-radius: 15px; 
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        margin-bottom: 16px;
        border: none;
        background-color: transparent;
        background-size: 100% 100%; 
        background-repeat: no-repeat;
        background-position: center;
        
        transition: all 0.2s ease-in-out;
        position: relative;
    }

    .btn-img:active {
        transform: scale(0.98);
    }

    .btn-img:hover {
        transform: translateY(-2px); /* Naik sedikit saat hover */
        filter: brightness(1.05); /* Sedikit lebih terang */
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    
    .btn-bg-orange {
        background-image: url('{{ asset("btn masalah-orange.png") }}');
        color: #D65609; /* Teks Coklat */
        
    }

    .btn-bg-blue {
        background-image: url('{{ asset("btn masalah-blue.png.png") }}');
        color: #4566A1; /* Teks Biru Tua */
    }

    .btn-bg-pink {
        background-image: url('{{ asset("btn masalah-pink.png.png") }}');
        color: #FF687F; /* Teks Merah Muda Tua */
    }
    
    .btn-bg-purple {
        background-image: url('{{ asset("btn masalah-purple.png.png") }}');
        color: #915CAE; /* Teks Ungu Tua */
    }

    .btn-bg-grey {
        background-image: url('{{ asset("btn masalah-grey.png") }}');
        color: #9D9D9D; /* Teks Abu Tua */
    }

    .btn-bg-lilac {
        background-image: url('{{ asset("btn masalah-lilac.png.png") }}');
        color: #566CD8;
    }

    .btn-back {
        background: none;
        border: none;
        padding: 0;
    }

</style>
@endsection

@section('content')
    
    <div class="header-area">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <button class="btn-back" onclick="history.back()">
                    <i class="bi bi-chevron-left fs-4" style="color: #333;"></i>
                </button>
                
                <h3 class="page-title">Laporan</h3>
                
                <div style="width: 24px;"></div>
            </div>
        </div>

        <div style="height: 20px;"></div>

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

    <div class="problem-container">
        <p class="section-label">Pilih Masalahmu</p>

        <a href="{{ route('laporan.detail', ['jenis' => 'Tutor Tidak Hadir']) }}" class="btn-img btn-bg-orange">
            Tutor Tidak Hadir
        </a>

        <a href="{{ route('laporan.detail', ['jenis' => 'Kesalahan Jadwal']) }}" class="btn-img btn-bg-blue">
            Kesalahan Jadwal
        </a>

        <a href="{{ route('laporan.detail', ['jenis' => 'Materi Tidak Sesuai']) }}" class="btn-img btn-bg-pink">
            Materi Tidak Sesuai
        </a>

        <a href="{{ route('laporan.detail', ['jenis' => 'Tutor Tidak Hadir']) }}" class="btn-img btn-bg-blue">
            Tutor Tidak Hadir
        </a>

        <a href="{{ route('laporan.detail', ['jenis' => 'Masalah Teknis']) }}" class="btn-img btn-bg-purple">
            Masalah Teknis
        </a>

        <a href="{{ route('laporan.detail', ['jenis' => 'Lainnya']) }}" class="btn-img btn-bg-grey">
            Lainnya
        </a>
        
    </div>
@endsection