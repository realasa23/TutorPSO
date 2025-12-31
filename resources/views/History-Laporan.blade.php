{{-- Michelle Lea Amanda - 5026231214  --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .header-bg {
            padding-top: 30px;
            padding-bottom: 1rem;
            position: relative;
            z-index: 1020;
        }

        .page-title {
            font-weight: bold;
            font-size: 24px;
        }

        .content-container {
            flex: 1;
            padding: 20px;
            background-color: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, .1);
            margin-top: 0px;
            position: relative;
        }

        .card-detail-sesi {
            background-image: url('{{ asset('card-detail-orange.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 18px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
        }

        .profile-img {
            width: 90px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            background: #fff;
        }

        .nama-tutor {
            font-size: 18px;
            font-weight: 700;
            color: #D65609;
            margin: 0;
        }

        .nama-matkul {
            font-size: 15px;
            color: #D65609;
            margin: 0;
        }

        .text {
            font-size: 14px;
            margin: 0;
        }

        .status {
            font-weight: 600;
            font-size: 14px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .status-refund.Pending {
            color: #ae2727;

        }

        .status-refund.Berhasil {
            color: #27AE60;
        }

        .status-laporan {
            color: #27AE60;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .card-detail-sesi.clickable {
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .card-detail-sesi.clickable:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection

@section('content')
    {{-- HEADER --}}
    <div class="header-bg">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn p-0" onclick="history.back()">
                    <i class="bi bi-chevron-left fs-4"></i>
                </button>
                <h3 class="page-title">Riwayat Laporan</h3>
                <div style="width:24px"></div>
            </div>
        </div>
    </div>

    <div class="content-container">
        @forelse ($laporan as $item)
            @php
                $isRefund = !empty($item->statusrefund);
            @endphp

            @if ($isRefund)
                <a href="{{ route('refund.selesai', $item->idlaporan) }}" class="card-link">
            @endif

            <div class="card-detail-sesi {{ $isRefund ? 'clickable' : '' }}">
                <img src="{{ asset($item->fototutor) }}" class="profile-img">

                <div>
                    <p class="nama-tutor">{{ $item->nama_tutor }}</p>
                    <p class="nama-matkul">{{ $item->namasesi }}</p>

                    <p class="text">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </p>

                    @php
                        [$jamMulai, $jamSelesai] = explode('-', $item->jam);

                        $start = \Carbon\Carbon::createFromFormat('H.i', $jamMulai);
                        $end = \Carbon\Carbon::createFromFormat('H.i', $jamSelesai);
                    @endphp

                    <p class="text">
                        {{ $start->format('H.i') }} - {{ $end->format('H.i') }} WIB
                    </p>

                    <p class="text">
                        <strong>Masalah:</strong> {{ $item->kategorimasalah }}
                    </p>

                    @if ($isRefund)
                        @php
                            $refundClass = match ($item->statusrefund) {
                                'Berhasil' => 'Berhasil',
                                'Pending' => 'Pending',
                                default => 'Pending',
                            };
                        @endphp

                        <p class="status status-refund {{ $refundClass }}">
                            Refund: {{ ucfirst($item->statusrefund) }}
                        </p>
                    @else
                        <p class="status status-laporan">
                            Status: {{ str_replace('_', ' ', $item->statuslaporan) }}
                        </p>
                    @endif

                </div>
            </div>

            @if ($isRefund)
                </a>
            @endif

        @empty
            <p class="text-center text-muted">Belum ada laporan.</p>
        @endforelse

    </div>
@endsection
