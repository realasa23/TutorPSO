@extends('layout.Mobile-View')

@section('page-style')
<style>

    /* Background full layar */
    .chat-bg {
        background-image: url('{{ asset("bg-image.png") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%;
        padding: 15px;
    }

    /* HEADER */
    .chat-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 5px 5px 5px 5px;
    }

    .chat-header img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
    }

    .chat-header .online-dot {
        width: 10px;
        height: 10px;
        background-color: #4ade80;
        border-radius: 50%;
        position: absolute;
        bottom: 3px;
        right: 10px;
    }

    .chat-header-name {
        font-size: 17px;
        font-weight: 600;
        margin: 0;
    }

    /* GARIS PEMBATAS */
    .header-divider {
        width: 100%;
        height: 1px;
        background-color: rgba(0,0,0,0.15);
        margin-top: 8px;
        margin-bottom: 10px;
    }

    /* TODAY Tag */
    .today-tag {
        background: #e9e9f6;
        display: inline-block;
        padding: 3px 12px;
        margin: 10px auto;
        border-radius: 8px;
        font-size: 13px;
        color: #444;
    }

    /* KARTU DETAIL PESANAN */
    .order-card {
        background: white;
        padding: 14px;
        border-radius: 14px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 20px;
    }

    .order-card img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .order-card .close-x {
        font-size: 20px;
        color: #444;
        cursor: pointer;
    }

    /* CHAT BUBBLE */
    .bubble {
        max-width: 75%;
        padding: 12px 16px;
        border-radius: 16px;
        font-size: 14px;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .bubble-left {
        background: #d6dcff;
        color: #333;
        border-bottom-left-radius: 6px;
        align-self: flex-start;
    }

    .bubble-right {
        background: #f9cece;
        color: #333;
        border-bottom-right-radius: 6px;
        align-self: flex-end;
    }

    /* INPUT AREA */
    .chat-input-box {
        background: white;
        padding: 10px 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
    }

    .input-chat {
        flex: 1;
        border: none;
        background: #f7f7f7;
        padding: 12px 18px;
        border-radius: 20px;
        font-size: 14px;
        outline: none;
    }

    .send-btn {
        font-size: 20px;
        color: #444;
        cursor: pointer;
    }

</style>
@endsection


@section('content')
<div class="chat-bg">

    <!-- HEADER -->
    <div class="chat-header position-relative">
        <button class="btn p-0" onclick="history.back()">
            <i class="bi bi-chevron-left fs-4 text-dark"></i>
        </button>

        <div class="position-relative">
            <img src="{{ asset('foto-tutor.jpg') }}">
            <span class="online-dot"></span>
        </div>

        <div>
            <p class="chat-header-name">Sasha</p>
        </div>
    </div>

    <!-- 🔥 GARIS PEMBATAS BARU -->
    <div class="header-divider"></div>

    <!-- TODAY LABEL -->
    <div class="text-center">
        <span class="today-tag">Today</span>
    </div>

    <!-- DETAIL CARD -->
    <div class="order-card">
        <img src="{{ asset('foto-tutor.jpg') }}">

        <div class="flex-grow-1">
            <strong>Sasha</strong><br>
            <small>PWEB</small>

            <p class="mt-2 mb-0" style="font-size: 13px;">
                <strong>Detail Pesanan:</strong><br>
                4 August 2025, 02.00–02.50 <br>
                15 Mei 2025, 01.00–01.50
            </p>
        </div>

        <i class="bi bi-x-lg close-x"></i>
    </div>

    <!-- CHAT MESSAGE LIST -->
    <div class="d-flex flex-column">

        <div class="bubble bubble-right">
            Halooo kak salam kenal akuu Lilaa, aku butuh tutor buat pemrograman web, bisa gaa?
        </div>

        <div class="bubble bubble-left">
            Halo lila, salken jugaa
        </div>

        <div class="bubble bubble-left">
            Kamu butuh untuk kapann?<br>
            Untuk beberapa hari kedepan sesi tutorku masih banyak yang kosong sih, dicek ajaa
        </div>

        <div class="bubble bubble-right">
            Oke kak, nanti aku request buat diajarin pelan-pelan ya pake bahasa bayi...
        </div>

        <div class="bubble bubble-left">
            Wkwkw, oke Lila!
        </div>

    </div>
</div>

<!-- INPUT AREA -->
<div class="chat-input-box">
    <i class="bi bi-plus-lg fs-4"></i>

    <input type="text" class="input-chat" placeholder="Message...">

    <i class="bi bi-send-fill send-btn"></i>
</div>

@endsection
