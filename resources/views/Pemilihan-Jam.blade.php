{{-- Nailah Adlina - 5026231068 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .header-bg {
            padding-top: 30px;
            position: relative;
            top: 0;
        }

        .container {
            width: 100%;
            height: 100vh;
            background-image: url('{{ asset('bg-image.png') }}');
            position: relative;
            padding: 0;
            overflow: hidden;

        }

        .page-title {
            font-weight: bold;
            margin: 0;
            font-size: 24px;
        }

        .btn-back-icon {
            color: #212529 !important;
        }

        .top-bar {
            margin: 10px 0 0 10px;
            display: flex;
            align-items: center;
            padding: 20px;
            font-size: 28px;
            font-weight: 600;
            position: relative;
            z-index: 3;
        }

        .divider {
            margin-bottom: 60px;
            display: flex;
            align-items: center;
            padding: 20px;
            font-size: 28px;
            font-weight: 600;
            position: relative;
            z-index: 3;
        }

        .teacher-photo {
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            width: 260px;
            z-index: 6;
            pointer-events: none;
        }

        .teacher-photo img {
            width: 100%;
            height: auto;
            display: block;
        }

        .card {
            position: relative;
            background: white;
            border-radius: 30px 30px 0 0;
            background: white;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            margin-top: 200px;
            padding: 15px 15px 68px;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
            border-color: white;
            min-height: calc(100vh - 230px);
        }

        .title {
            font-size: 22px;
            font-weight: 700;
        }

        .name {
            font-size: 16px;
            margin-top: 3px;
            color: #555;
        }

        .badge-online {
            background: #C6FCD7;
            color: #1A8E44;
            padding: 3px 10px;
            font-size: 10px;
            border-radius: 10px;
            margin-left: 5px;
        }

        .tags {
            margin-top: 18px;
            display: flex;
            gap: 10px;
        }

        .tag {
            background: #C6C8F8;
            padding: 6px 18px;
            font-size: 12px;
            border-radius: 18px;
            color: #fff;
            font-weight: 500;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .time-section-title {
            font-size: 20px;
            font-weight: 700;
            margin-top: 25px;
        }

        .legend-container {
            display: flex;
            gap: 15px;
            margin: 10px 0 15px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: #555;
        }

        .legend-box {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            margin-right: 6px;
        }

        .available {
            background-color: #DDE2FC;
            border: 1px solid #C6C8F8;
        }

        .unavailable {
            background-color: #FCDADC;
            border: 1px solid #E57373;
        }

        .time-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }

        .time-slot {
            flex: 1 1 calc(25% - 10px);
            min-width: 70px;
            height: 50px;
            padding: 10px 5px;
            font-size: 11px;
            font-weight: 500;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            border: 1px solid #DDE2FC;
            background-color: #F0F2FF;
            transition: 0.2s;
        }

        .time-slot.unavailable {
            background-color: #FCDADC;
            color: #E57373;
            border-color: #FCDADC;
            pointer-events: none;
            cursor: not-allowed;
            opacity: 0.8;
        }



        .time-slot.selected {
            background-color: #C6C8F8;
            color: #fff;
            font-weight: bold;
            border-color: #C6C8F8;
        }

        .btn-konfirmasi {
            width: 100%;
            height: 46px;
            background-color: #312E49;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
        }

        .btn-konfirmasi.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-btn {
            width: 15px;
            height: 15px;
        }

        .container::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .container {
            scrollbar-width: none;
        }

        .container {
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
    </style>
@endsection

@section('content')
    @php
        use Carbon\Carbon;
        $today = Carbon::today();
        $now = Carbon::now();
    @endphp

    <div class="container">
        <div class="header-bg">
            <div class="container-fluid px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <button class="btn p-0" onclick="history.back()">
                        <i class="bi bi-chevron-left fs-4 text-dark"></i>
                    </button>
                    <h3 class="page-title">Pilih Jadwal</h3>
                    <div style="width: 24px;"></div>
                </div>
            </div>
        </div>

        <div class="top-bar">
        </div>

        <div class="teacher-photo">
            <img src="{{ asset($sesi->fototutor) }}">
        </div>

        <div class="card">
            <div style="display:flex; align-items:center;">
                <div class="title">{{ $sesi->namaSesi }}</div>
                @if ($sesi->tipe == 'online')
                    <div class="badge-online">ONLINE</div>
                @endif

            </div>

            <div class="name">{{ $sesi->nama }}</div>

            <div class="time-section-title">Pilih Jam</div>

            <div class="legend-container">
                <div class="legend-item"><span class="legend-box available"></span>Tersedia</div>
                <div class="legend-item"><span class="legend-box unavailable"></span>Tidak Tersedia</div>
            </div>

            <div class="time-grid" id="time-grid-container" data-tanggal="{{ $tanggal }}">
                @foreach (['10.00-10.50', '11.00-11.50', '12.00-12.50', '13.00-13.50', '14.00-14.50', '15.00-15.50', '16.00-16.50', '17.00-17.50', '18.00-18.50', '19.00-19.50', '20.00-20.50', '21.00-21.50'] as $slot)
                    <button class="time-slot {{ in_array($slot, $jamTerbooking) ? 'unavailable' : '' }}"
                        data-slot="{{ $slot }}" {{ in_array($slot, $jamTerbooking) ? 'disabled' : '' }}>
                        {{ $slot }}
                    </button>
                @endforeach
            </div>

            <div class="divider"></div>

            <form id="form-jam" method="POST" action="{{ route('pesanan.jam.store', $sesi->idsesi) }}">
                @csrf
                <input type="hidden" id="selected-jam" name="jam">
                <button id="tombol-konfirmasi" class="btn-konfirmasi">KONFIRMASI</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const grid = document.getElementById('time-grid-container');
            const buttons = grid.querySelectorAll('.time-slot');
            const confirmBtn = document.getElementById('tombol-konfirmasi');
            const form = document.getElementById('form-jam');
            const hiddenJam = document.getElementById('selected-jam');

            const selectedDate = grid.dataset.tanggal;
            const now = new Date();

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const pickedDate = new Date(selectedDate);
            pickedDate.setHours(0, 0, 0, 0);

            buttons.forEach(btn => {
                if (btn.disabled) return;
                const slot = btn.dataset.slot;
                const startTime = slot.split('-')[0].replace('.', ':');
                const slotDateTime = new Date(`${selectedDate}T${startTime}:00`);

                if (
                    pickedDate.getTime() === today.getTime() &&
                    slotDateTime.getTime() <= now.getTime()
                ) {
                    btn.classList.add('unavailable');
                    btn.disabled = true;
                }
            });

            grid.addEventListener('click', e => {
                if (!e.target.classList.contains('time-slot') || e.target.disabled) return;

                buttons.forEach(b => b.classList.remove('selected'));
                e.target.classList.add('selected');

                hiddenJam.value = e.target.dataset.slot;
                confirmBtn.classList.add('show');
            });

            confirmBtn.addEventListener('click', () => {
                if (!hiddenJam.value) return;
                form.submit();
            });
        });
    </script>
@endsection
