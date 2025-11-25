//Harya Raditya Handoyo 5026231176

@extends('layout.Mobile-View')

@section('page-style')
<style>
/* CSS KHUSUS LIST TUTOR */
:root{ --card-h:132px; --radius-xl:18px; }

.appbar{position:relative;padding-top:16px}
.back-btn{width:36px;height:36px;border-radius:50%;display:grid;place-items:center;background:#ffffff70;border:0;color:#1A2B4B;backdrop-filter:blur(6px)}
.title{font-weight:800;font-size:1.25rem;text-align:center;color:#1A2B4B}

.surface-list{background:#fff;border-top-left-radius:22px;border-top-right-radius:22px;box-shadow:0 -4px 18px rgba(20,24,55,.08); padding-top:1rem; min-height:80vh;}

.tutor-card{border:0;border-radius:var(--radius-xl);overflow:hidden;background:#fff;box-shadow:0 8px 24px rgba(20,24,55,.10)}
.tc-top{ height:var(--card-h); position:relative; display:flex; align-items:center; gap:.75rem; padding:.75rem .9rem; overflow:hidden; }
.tc-orange{background:linear-gradient(135deg,var(--orange-1),var(--orange-2))}
.tc-pink{background:linear-gradient(135deg,var(--pink-1),var(--pink-2))}
.tc-indigo{background:linear-gradient(135deg,var(--indigo-1),var(--indigo-2))}

.tc-avatar{ width:90px; height:110px; border-radius:12px; overflow:hidden; background:#fff; display:flex; align-items:flex-end; justify-content:center; flex-shrink: 0; }
.tc-avatar img{ height:100%; width:auto; object-fit:cover; }
.tc-text{ flex-grow: 1; }
.tc-text h6{margin:0 0 2px;font-weight:800;color:#1A2B4B}
.tc-role{font-size:.86rem;margin:0;color:#1A2B4B; opacity: 0.8;}
.tc-rating{font-size:.8rem;color:#1A2B4B;display:flex;align-items:center;}
.tc-rating i{color:#ffc107; margin-right: 4px;}
.tc-bottom-buttons{ display:flex; align-items:center; gap:.5rem; margin-top: 8px; }
.tc-price-text{ font-weight:700; color:#1A2B4B; font-size: 1rem; flex-grow: 1; }

.btn-chat-sm, .btn-order-sm{ border:0; padding:.2rem .6rem; border-radius:999px; font-weight:600; font-size: .8rem; text-decoration: none; display:inline-block;}
.btn-chat-sm{background:#fff; color:#1A2B4B; border: 1px solid #e0e0e0;}
.btn-order-sm{background:#fff; color:#1A2B4B; border: 1px solid #e0e0e0;}
</style>
@endsection

@section('content')
  <header class="appbar container pb-4">
    <div class="row align-items-center">
      <div class="col-2">
        <a href="{{ route('home') }}" class="back-btn"><i class="bi bi-chevron-left"></i></a>
      </div>
      <div class="col-8"><div class="title">Tutor</div></div>
      <div class="col-2"></div>
    </div>
  </header>

  <main class="surface-list pb-4">
    <div class="container">
      <div class="tutor-card mb-3">
        <div class="tc-top tc-orange">
          <div class="tc-avatar"><img src="{{ asset('assets/tutors/khalila.png') }}" alt="Khalila"></div>
          <div class="tc-text">
            <h6>Khalila</h6>
            <p class="tc-role">Dasar Pemrograman</p>
            <div class="tc-rating"><i class="bi bi-star-fill"></i>4.9</div>
            <div class="tc-bottom-buttons">
              <span class="tc-price-text">Rp50.000</span>
              <button class="btn btn-chat-sm">Chat</button>
              <a href="{{ route('profiletutor') }}" class="btn btn-order-sm">Pesan Sesi</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tutor-card mb-3">
        <div class="tc-top tc-pink">
          <div class="tc-avatar"><img src="{{ asset('assets/tutors/juno.png') }}" alt="Juno"></div>
          <div class="tc-text">
            <h6>Juno</h6>
            <p class="tc-role">Pemrograman Web</p>
            <div class="tc-rating"><i class="bi bi-star-fill"></i>4.9</div>
            <div class="tc-bottom-buttons">
              <span class="tc-price-text">Rp50.000</span>
              <button class="btn btn-chat-sm">Chat</button>
              <a href="{{ route('profiletutor') }}" class="btn btn-order-sm">Pesan Sesi</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
