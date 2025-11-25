//Harya Raditya Handoyo 5026231176

@extends('layout.Mobile-View')

@section('page-style')
<style>
/* CSS KHUSUS PROFIL */
.appbar{ position:relative; padding-top:16px; flex-shrink: 0; }
.back-btn{ width:36px; height:36px; border-radius:50%; display:grid; place-items:center; background:#ffffff70; border:0; color:#1A2B4B; backdrop-filter:blur(6px); }
.title{ font-weight:800; font-size:1.25rem; text-align:center; color:#1A2B4B; }

/* Header Profil */
.profile-header{ text-align: center; padding: 1rem 0; flex-shrink: 0; }
.profile-pic{ width: 120px; height: 120px; border-radius: 50%; margin: 0 auto 1rem auto; background: rgba(255, 255, 255, 0.25); padding: 6px; backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; }
.profile-pic img{ width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 2px solid #fff; display: block; }
.profile-name{ font-weight: 800; font-size: 1.5rem; color: #1A2B4B; margin-bottom: 0; }
.profile-title{ font-size: 1rem; color: #1A2B4B; opacity: 0.9; }

.profile-tags{ display: flex; justify-content: center; gap: .5rem; margin-top: 1rem; }
.badge-custom{ border-radius: 999px; padding: .3rem .9rem; font-weight: 600; font-size: 0.8rem; border: 0; }
.badge-pink{ background-color: #ffd6d6; color: #e65c5c; }
.badge-blue{ background-color: #e0e7ff; color: #5670ff; }

/* Konten Putih */
.surface-profile{ background:#fff; border-top-left-radius:22px; border-top-right-radius:22px; box-shadow:0 -4px 18px rgba(20,24,55,.08); flex-grow: 1; overflow-y: auto; padding-bottom: 120px; min-height: 60vh; }
.surface-profile h2{ font-weight: 700; font-size: 1.25rem; color: #1A2B4B; margin-bottom: 0.75rem; }
.surface-profile p{ color: #6c757d; line-height: 1.6; }

/* Review */
.review-card{ display: flex; gap: .75rem; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #f0f0f0; }
.review-avatar{ width: 44px; height: 44px; border-radius: 50%; background: #ff8a8a; flex-shrink: 0; }
.review-name{ font-weight: 700; color: #1A2B4B; margin: 0; }
.review-text{ margin-top: 0.5rem; font-size: 0.95rem; }

/* Tombol Aksi Bawah */
.bottom-action-nav{ position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: min(393px, 100%); background: #fff; padding: 1rem; padding-bottom: calc(1rem + env(safe-area-inset-bottom)); border-top-left-radius: 22px; border-top-right-radius: 22px; box-shadow: 0 -4px 18px rgba(20,24,55,.10); display: flex; gap: .75rem; z-index: 100; }
.bottom-action-nav .btn{ flex-grow: 1; border-radius: 999px; font-weight: 700; font-size: 1rem; padding: .6rem 0; }
</style>
@endsection

@section('content')
  <header class="appbar container pb-3">
    <div class="row align-items-center">
      <div class="col-2">
        <button class="back-btn" onclick="history.back()"><i class="bi bi-chevron-left"></i></button>
      </div>
      <div class="col-8"><div class="title">Profil Tutor</div></div>
      <div class="col-2"></div>
    </div>
  </header>

  <section class="profile-header container">
    <div class="profile-pic">
      <img src="{{ asset('assets/tutors/Haryadi.png') }}" alt="Harya">
    </div>
    <h1 class="profile-name">Harya</h1>
    <p class="profile-title">Software Engineering, Google</p>
    <div class="profile-tags">
      <span class="badge-custom badge-pink">Bussiness</span>
      <span class="badge-custom badge-blue">IT</span>
    </div>
  </section>

  <div class="surface-profile mt-3">
    <div class="container pt-4">
      <section>
        <h2>Deskripsi</h2>
        <p>Harya adalah lulusan Ilmu Komputer UI, berpengalaman di Sea Group, Seed, dan startup Fintech.</p>
      </section>

      <section class="mt-4">
        <h2>Ulasan</h2>
        <div class="review-card">
          <div class="review-avatar"></div>
          <div>
            <h6 class="review-name">Juno</h6>
            <p class="review-text">Penjelasannya mudah dimengerti.</p>
          </div>
        </div>
      </section>
    </div>
  </div>

  <nav class="bottom-action-nav">
    <button class="btn btn-outline-dark">Chat</button>
    <button class="btn btn-dark">Pesan Sesi</button>
  </nav>
@endsection
