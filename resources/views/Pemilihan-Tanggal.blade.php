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
            max-width: 430px;
            /* height: 100vh; */
            /* penuh viewport agar container bisa scroll sendiri */
            background-image: url('{{ asset('bg-image.png') }}');
            position: relative;
            padding: 0;
            overflow-y: auto;
            overflow-x: hidden;
            overscroll-behavior: none !important;
            -webkit-overflow-scrolling: touch;
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
            margin-top: 200px;
            padding: 15px 15px 68px;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
            border-color: white;
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

        /* --------------------
           HIDE SCROLLBAR (visual only)
           - WebKit (Chrome, Safari, Android WebView, iOS WebView)
           - Firefox
           - IE/Edge legacy
           -------------------- */
        .container::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        /* Firefox */
        .container {
            scrollbar-width: none;
            /* hides scrollbar in Firefox */
        }

        /* IE 10+ */
        .container {
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

        <div class="top-bar">
            <a href="/adlin2"><img src="{{ asset('assets/img/back.png') }}" class="back-btn"></a>
        </div>

        <div class="teacher-photo">
            <img src="{{ asset('profile.png') }}">
        </div>

        <div class="card">
            <div style="display:flex; align-items:center;">
                <div class="title">Dasar Pemrograman</div>
                <div class="badge-online">ONLINE</div>
            </div>

            <div class="name">Khalila</div>

            <div class="tags">
                <div class="tag">IT</div>
                <div class="tag">Business</div>
                <div class="tag">Computer Science</div>
            </div>

            <div class="month-title">August, 2025</div>

            <table class="calendar">
                <thead>
                    <tr>
                        <th>Su</th>
                        <th>Mo</th>
                        <th>Tu</th>
                        <th>We</th>
                        <th class="highlight">Th</th>
                        <th>Fr</th>
                        <th>Sa</th>
                    </tr>
                </thead>

                <tbody id="calendar-body">
                    <tr>
                        <td class="disabled">27</td>
                        <td class="disabled">28</td>
                        <td class="disabled">29</td>
                        <td class="disabled">30</td>
                        <td class="disabled">31</td>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td class="highlight">7</td>
                        <td>8</td>
                        <td>9</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                        <td>16</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                        <td>22</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                        <td>29</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>31</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <button id="tombol-konfirmasi" class="btn-konfirmasi">KONFIRMASI</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarBody = document.getElementById('calendar-body');
            const confirmButton = document.getElementById('tombol-konfirmasi');

            calendarBody.addEventListener('click', function(event) {
                const cell = event.target;

                if (cell.tagName === 'TD' && !cell.classList.contains('disabled') && cell.textContent
                    .trim() !== '') {
                    const allCells = calendarBody.querySelectorAll('td.selected');
                    allCells.forEach(c => c.classList.remove('selected'));

                    if (!cell.classList.contains('highlight')) {
                        cell.classList.add('selected');
                    }

                    updateButton();
                }
            });

            function updateButton() {
                const selected = calendarBody.querySelectorAll('td.selected');
                if (selected.length > 0) {
                    confirmButton.classList.add('show');
                } else {
                    confirmButton.classList.remove('show');
                }
            }
            confirmButton.addEventListener('click', function() {
                const selectedCell = calendarBody.querySelector('td.selected');
                if (selectedCell) {
                    window.location.href = '{{ route('pesanan.jam') }}';
                }
            });
        });
    </script>
@endsection
