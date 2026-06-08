{{-- Michelle Lea Amanda - 5026231214 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .header-area {
            padding-top: 40px;
            padding-bottom: 20px;
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

        .page-content {
            padding: 0 24px;
        }

        .tutor-card {
            padding: 16px;
            background-image: url('{{ asset('card lapor tutor-orange.png') }}');
            background-size: cover;
            background-position: right;
            background-repeat: no-repeat;
            border-radius: 18px;
            display: flex;
            gap: 12px;
            align-items: center;
            position: relative;
            margin: 0 15px 15px 15px;
        }

        .tutor-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .img-wrapper {
            background: #fff;
            padding: 0;
            border-radius: 15px;
        }

        .profile-img {
            background: #fff;
            width: 80px;
            height: 95px;
            border-radius: 15px;
            object-fit: cover;
            display: block;
        }

        .tutor-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: -5px;
        }

        .tutor-name {
            font-size: 18px;
            font-weight: 600;
            color: #A0400B;
            margin: 0;
        }

        .matkul-name {
            font-size: 14px;
            margin-top: -1px;
            color: #A0400B;
        }

        .tutor-date {
            font-size: 14px;
            margin-top: -15px;
            color: #A0400B;
        }

        .tutor-time {
            font-size: 14px;
            margin-top: -15px;
            color: #A0400B;
        }

        .mobile-scroll {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            min-height: 100% !important;
        }

        .content-area {
            flex: 1 !important;
            display: flex; /* Tambahkan ini */
            flex-direction: column; /* Tambahkan ini */
            padding: 20px;
            padding-bottom: 25px; /* Beri ruang aman di bawah tombol */
            background: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            z-index: 5;
            position: relative;
        }

        .custom-textarea {
            width: 100%;
            min-height: 160px;
            border-radius: 15px;
            padding: 15px;
            border: 1px solid #EAEAEA;
            margin-top: 5px; /* Sedikit dikurangi */
            resize: none; /* Mencegah user merusak layout dengan menarik sudut textarea */
        }
        
        .label-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .label-text {
            font-weight: 700;
            font-size: 16px;
        }

        .ubah-link {
            color: #F2994A;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .selected-problem-display {
            padding: 16px;
            text-align: center;
            border-radius: 15px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .style-orange {
            background-image: url('{{ asset('btn masalah-orange.png') }}');
            color: #D65609;
        }

        .style-blue {
            background-image: url('{{ asset('btn masalah-blue.png.png') }}');
            color: #4566A1;
        }

        .style-pink {
            background-image: url('{{ asset('btn masalah-pink.png.png') }}');
            color: #FF687F;
        }

        .style-purple {
            background-image: url('{{ asset('btn masalah-purple.png.png') }}');
            color: #915CAE;
        }

        .style-grey {
            background-image: url('{{ asset('btn masalah-grey.png') }}');
            color: #9D9D9D;
        }

        form {
            display: flex;
            flex-direction: column;
            flex: 1; /* Biarkan form memenuhi sisa tinggi .content-area */
        }

        .custom-textarea {
            width: 100%;
            min-height: 160px;
            border-radius: 15px;
            padding: 15px;
            border: 1px solid #EAEAEA;
            margin-top: 8px;
        }

        .btn-submit {
            margin-top: auto; /* Ini kunci rahasianya! */
            width: 100%;
            padding: 16px;
            border-radius: 15px;
            background: #312E49;
            color: #fff;
            font-weight: 700;
            border: none;
            /* Tambahan: efek hover dan transition agar tombol terasa hidup */
            transition: opacity 0.2s; 
            cursor: pointer;
        }

        .btn-submit:hover {
            opacity: 0.9;
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
        $map = [
            'Tutor Tidak Hadir' => 'style-orange',
            'Kesalahan Jadwal' => 'style-blue',
            'Materi Tidak Sesuai' => 'style-pink',
            'Masalah Teknis' => 'style-purple',
            'Lainnya' => 'style-grey',
        ];
        $styleClass = $map[$jenisMasalah] ?? 'style-blue';
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

    <div class="tutor-card">
        <img src="{{ asset($pesanan->fototutor) }}" class="profile-img">
        <div class="tutor-details">
            <p class="tutor-name">{{ $pesanan->nama_tutor }}</p>
            <p class="matkul-name">{{ $pesanan->namasesi }}</p>
            <p class="tutor-date">
                {{ \Carbon\Carbon::parse($pesanan->tanggal)->translatedFormat('d F Y') }}
            </p>
            <p class="tutor-time">{{ $pesanan->jam }}</p>
        </div>
    </div>

    <div class="content-area">
        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf

            <input type="hidden" name="idpesanan" value="{{ $pesanan->idpesanan }}">
            <input type="hidden" name="jenis_masalah" value="{{ $jenisMasalah }}">

            <div class="label-row">
                <span class="label-text">Masalah yang dipilih</span>
                <a href="{{ route('laporan.create', $pesanan->idpesanan) }}" class="ubah-link">
                    <i class="bi bi-pencil"></i> Ubah
                </a>
            </div>

            <div class="selected-problem-display {{ $styleClass }}">
                {{ $jenisMasalah }}
            </div>

            <p class="label-text">Alasan</p>
            <textarea name="deskripsi" class="custom-textarea" required></textarea>

            <button class="btn-submit">
                {{ in_array($jenisMasalah, ['Tutor Tidak Hadir', 'Kesalahan Jadwal']) ? 'AJUKAN REFUND' : 'KIRIM LAPORAN' }}
            </button>
        </form>
    </div>
@endsection
