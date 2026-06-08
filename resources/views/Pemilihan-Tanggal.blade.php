{{-- Nailah Adlina - 5026231068 --}}
@extends('layout.Mobile-View')
@section('page-style')
    <style>
        .header-bg {
            padding-top: 30px;
            position: relative;
            top: 0;
        }

        .mobile-scroll {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 100%;
        }

        .container {
            width: 100%;
            max-width: 430px;
            background-image: url('{{ asset('bg-image.png') }}');
            background-size: cover;
            position: relative;
            padding: 0;
            overflow-y: hidden;
            overflow-x: hidden;
            overscroll-behavior: none !important;
            -webkit-overflow-scrolling: touch;
            display: flex !important;
            flex-direction: column !important;
            flex: 1 !important;
            min-height: 100% !important;
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
            background: white;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            margin-top: 180px;
            padding: 15px 15px 0px;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
            border: none;
            flex: 1 !important; 
            display: flex;
            flex-direction: column;
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
            display: inline-block;
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
            color: #ffffff;
            font-weight: 500;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .month-title {
            font-size: 18px;
            font-weight: 700;
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .month-title button {
            background: none;
            border: none;
            font-size: 22px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .calendar {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .calendar th {
            font-size: 14px;
            font-weight: 500;
            color: #777;
            padding-bottom: 12px;
            text-align: center;
        }

        .calendar td {
            font-size: 14px;
            font-weight: 500;
            padding: 8px 0;
            text-align: center;
            height: 49px;
            width: 36px;
        }

        .calendar td.disabled {
            color: #ccc;
        }

        .calendar td:not(.disabled):not(:empty) {
            cursor: pointer;
        }

        .calendar td.selected {
            background-color: #C6C8F8;
            color: #333;
            border-radius: 50%;
            font-weight: bold;
        }

        .calendar th.highlight {
            color: #D9824F;
            background-color: #FBEAE1;
            border-radius: 8px;
            padding-top: 4px;
            padding-bottom: 8px;
        }

        .calendar td.highlight {
            background-color: #FDF3E6;
            color: #D9824F;
            border: 1.5px solid #D9824F;
            border-radius: 50%;
            font-weight: bold;
        }

        #form-tanggal {
            margin-top: auto;
            position: sticky; /* Membuat elemen ini melayang menempel */
            bottom: 0; /* Menempel tepat di garis bawah layar */
            background: white; /* Latar putih agar teks kalender di belakangnya tertutup */
            padding: 15px 0 25px 0; /* Memberi ruang aman untuk tombol */
            z-index: 100; /* Memastikan tombol selalu ada di tumpukan paling depan */
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
            cursor: pointer;
            width: 15px;
            height: 15px;
            margin-left: 10px;
        }

        .container::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .container {
            scrollbar-width: none;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="header-bg">
            <div class="container-fluid px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <button class="btn p-0" onclick="history.back()">
                        <i class="bi bi-chevron-left fs-4 text-dark"></i>
                    </button>
                    <h3 class="page-title">Pesan Sesi</h3>
                    <div style="width: 24px;"></div>
                </div>
            </div>
        </div>

        <div class="top-bar"> </div>
        <div class="teacher-photo">
            <img src="{{ asset($sesi->fototutor) }}">
        </div>

        <div class="card">
            <div style="display:flex; align-items:center;">
                <div class="title">{{ $sesi->namaSesi}}</div>
                @if ($sesi->tipe == 'online')
                    <div class="badge-online">ONLINE</div>
                @endif

            </div>

            <div class="name">{{ $sesi->nama }}</div>

            <div class="month-title">
                <button id="prevMonth">‹</button>
                <span id="monthLabel">August, 2025</span>
                <button id="nextMonth">›</button>
            </div>

            <table class="calendar">
                <thead>
                    <tr>
                        <th>Su</th>
                        <th>Mo</th>
                        <th>Tu</th>
                        <th>We</th>
                        <th>Th</th>
                        <th>Fr</th>
                        <th>Sa</th>
                    </tr>
                </thead>

                <tbody id="calendar-body"></tbody>
            </table>

            <form id="form-tanggal" method="POST"
                action="{{ route('pesanan.tanggal.store', ['idsesi' => $sesi->idsesi]) }}">
                @csrf
                <input type="hidden" id="selected-date" name="tanggal">
                <button id="tombol-konfirmasi" class="btn-konfirmasi">KONFIRMASI</button>
            </form>
        </div>
    </div>

    <script>
        const bookedDates = @json($bookedDates);
        document.addEventListener('DOMContentLoaded', function() {
            const calendarBody = document.getElementById('calendar-body');
            const monthLabel = document.getElementById('monthLabel');
            const confirmButton = document.getElementById('tombol-konfirmasi');
            const prevBtn = document.getElementById('prevMonth');
            const nextBtn = document.getElementById('nextMonth');

            const today = new Date();
            let tahun = today.getFullYear();
            let bulan = today.getMonth();

            const namaBulan = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            function updateMonthLabel() {
                monthLabel.textContent = `${namaBulan[bulan]}, ${tahun}`;
            }

            function renderCalendar() {
                const firstDay = new Date(tahun, bulan, 1).getDay();
                const lastDate = new Date(tahun, bulan + 1, 0).getDate();

                calendarBody.innerHTML = "";
                let day = 1;

                for (let row = 0; row < 6; row++) {
                    const tr = document.createElement('tr');

                    for (let col = 0; col < 7; col++) {
                        const td = document.createElement('td');

                        if (row === 0 && col < firstDay) {
                            td.classList.add("disabled");
                        } else if (day > lastDate) {
                            td.classList.add("disabled");
                        } else {
                            td.textContent = day;

                            const fullDate =
                                `${tahun}-${String(bulan + 1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
                            const currentDate = new Date(fullDate);

                            if (currentDate < new Date(today.toDateString())) {
                                td.classList.add("disabled");
                            }

                            if (bookedDates.includes(fullDate)) {
                                td.classList.add("highlight");
                                td.classList.add("disabled");
                            }

                            day++;
                        }

                        tr.appendChild(td);
                    }

                    calendarBody.appendChild(tr);
                }
            }

            prevBtn.addEventListener('click', function() {
                bulan--;
                if (bulan < 0) {
                    bulan = 11;
                    tahun--;
                }
                updateMonthLabel();
                renderCalendar();
                confirmButton.classList.remove('show');
            });

            nextBtn.addEventListener('click', function() {
                bulan++;
                if (bulan > 11) {
                    bulan = 0;
                    tahun++;
                }
                updateMonthLabel();
                renderCalendar();
                confirmButton.classList.remove('show');
            });

            calendarBody.addEventListener('click', function(event) {
                const cell = event.target;

                if (cell.tagName === 'TD' && !cell.classList.contains('disabled') && cell.textContent !==
                    "") {
                    calendarBody.querySelectorAll('td.selected').forEach(c => c.classList.remove(
                        'selected'));

                    if (!cell.classList.contains('highlight')) {
                        cell.classList.add('selected');
                    }

                    confirmButton.classList.add('show');
                }
            });

            confirmButton.addEventListener('click', function(event) {
                event.preventDefault();

                const selectedCell = calendarBody.querySelector('td.selected');
                if (selectedCell) {
                    const tanggal = selectedCell.textContent.trim();
                    const fullDate =
                        `${tahun}-${String(bulan + 1).padStart(2,'0')}-${String(tanggal).padStart(2,'0')}`;
                    document.getElementById('selected-date').value = fullDate;
                    document.getElementById('form-tanggal').submit();
                }
            });

            updateMonthLabel();
            renderCalendar();
        });
    </script>
@endsection
