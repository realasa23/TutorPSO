@extends('layout.Mobile-View')

@section('page-style')
<style>
    .mobile-container {
        
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .success-card {
        background-image: url('{{ asset('bg-callout review done.png') }}');
        background-size: 100% 100%; 
        background-repeat: no-repeat;
        background-position: center;
        background-color: transparent;
        
        border-radius: 30px; 
        padding: 60px 30px 40px 30px; 
        width: 100%;
        text-align: center;
        
        box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
        
        display: flex;
        flex-direction: column;
        align-items: center;
        
        border: none; 
    }

    /* Container Icon Checkmark */
    .check-circle {
        width: 100px;
        height: 100px;
        background-color: #ffffff54; 
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .check-img {
        width: 70px; 
        height: auto;
        object-fit: contain;
    }

    .success-text {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 18px;
        color: #333;
        margin-bottom: 30px;
        line-height: 1.4;
    }

    .btn-selesai {
        background-color: #312E49; 
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 0;
        width: 100%;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    
    .btn-selesai:hover {
        opacity: 0.9;
    }

</style>
@endsection

@section('content')
    
    <div class="success-card">
        <div class="check-circle">
            <img src="{{ asset('icon centang.png') }}" class="check-img" alt="Sukses">
        </div>

        <p class="success-text">
            Terimakasih Atas<br>Tanggapan mu
        </p>

        <a href="{{ route('aktivitas.lampau') }}" class="w-100 text-decoration-none">
            <button class="btn-selesai">Selesai</button>
        </a>
    </div>

@endsection