//Harya Raditya Handoyo 5026231176

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tutor App – Home</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
  /* ukuran KATEGORI — disamakan dgn page Pencarian */
  --cat-w:124px;
  --cat-h:150px;
  --cat-r:16px;
  --notch:28px;

  /* ukuran kartu REKOMENDASI (compact + seragam) */
  --rec-w:152px;
  --rec-h:200px;
  --tile:116px;

  /* warna & ink */
  --bg-start:#c9d2ff; --bg-mid:#a9b7ff; --bg-end:#8fc3ff;
  --surface:#ffffff; --ink:#1b2430; --ink-dim:#667085;

  --orange-1:#ffd2a6; --orange-2:#ffb778; --orange-ink:#7a3600;
  --indigo-1:#cfd6ff; --indigo-2:#aeb9ff; --indigo-ink:#24338b;
  --pink-1:#ffc7d6;  --pink-2:#ff9fb7;  --pink-ink:#7e2241;

  /* promo (banner atas) */
  --promo-h:180px;
}

*{box-sizing:border-box}
body{font-family:'Poppins',system-ui}
a{text-decoration:none} /* hilangkan underline “Lihat Semua” */

.mobile-view{
  max-width:393px;min-height:100vh;margin:0 auto;
  background:radial-gradient(120% 120% at -10% 0%,var(--bg-start) 0%,var(--bg-mid) 45%,var(--bg-end) 100%);
  padding-top:10px;padding-bottom:86px;
}

/* header kecil */
.avatar-48{width:40px;height:40px;border-radius:50%;object-fit:cover}
.hello-small{color:#e8ecff;font-size:.8rem}
.hello-name{font-weight:700;color:#10224d}
.btn-icon{width:36px;height:36px;display:grid;place-items:center;border-radius:50%;
  background:#ffffff40;color:#fff;border:0;backdrop-filter:blur(4px)}

/* promo banner (tetap ada) */
.hero-body{padding:0 .75rem}
.carousel .promo-card{
  height:var(--promo-h);
  border-radius:20px;
  padding:16px 18px;
  overflow:hidden;
  display:flex;align-items:center;justify-content:space-between;
}
.promo-indigo{background:linear-gradient(135deg,#9bb0ff,#7f92ff);color:#fff}
.promo-orange{background:linear-gradient(135deg,#ffd6ad,#ffb778);color:#5b2d00}
.promo-pink{background:linear-gradient(135deg,#ffc7d6,#ff9fb7);color:#6b1c3c}
.promo-ill{height:72%; max-height:120px; width:auto}
.btn-resp{border-radius:12px;padding:.45rem .85rem;font-weight:600}
.btn-promo-solid{background:#fff;border:0}
.promo-indicators{position:static;margin-top:.5rem}
.promo-indicators [data-bs-target]{width:8px;height:8px;border-radius:50%;border:0;background:#ffffffaa;margin:0 4px}
.promo-indicators .active{background:#fff}

/* section container */
.surface{background:var(--surface);border-radius:24px;box-shadow:0 10px 35px rgba(20,24,55,.12); overflow:hidden}
.section-title{color:#6f7cff;font-weight:800;font-size:clamp(1.05rem,4vw,1.22rem)}
.section-sub{color:var(--ink-dim)}
.badge-pill{display:inline-block;background:#eef1ff;color:#6f7cff;border-radius:12px;font-weight:700;padding:.35rem .7rem}

/* ===== scroll-snap carousel ===== */
.snap-x{display:flex;gap:12px;overflow-x:auto;scroll-snap-type:x mandatory;padding-bottom:2px}
.snap-x::-webkit-scrollbar{height:6px}
.snap-x::-webkit-scrollbar-thumb{background:#d7dcff;border-radius:10px}

/* KATEGORI (match Pencarian) */
.cat-card{
  position:relative; flex:0 0 var(--cat-w); height:var(--cat-h);
  border-radius:var(--cat-r); padding:10px 18px 10px 12px; color:#1b2430;
  overflow:hidden; isolation:isolate; scroll-snap-align:start;
  display:flex; flex-direction:column; justify-content:space-between;
}
.cat-notch{position:absolute; right:calc(-1*var(--notch)/2); top:50%;
  width:var(--notch); height:var(--notch); transform:translateY(-50%);
  background:#fff; border-radius:50%; box-shadow:inset 0 0 0 1px rgba(0,0,0,.04)}
.cat-decor{position:absolute; inset:0; z-index:0; pointer-events:none;
  background:
  radial-gradient(160px 160px at 26% 22%, rgba(255,255,255,.42), rgba(255,255,255,0) 60%),
  radial-gradient(120px 120px at 74% 14%, rgba(255,255,255,.30), rgba(255,255,255,0) 60%),
  radial-gradient(100px 100px at 40% 58%, rgba(255,255,255,.18), rgba(255,255,255,0) 70%);
}
.cat-icon{z-index:1; display:inline-flex; align-items:center; justify-content:center;
  width:40px;height:40px;border-radius:12px;background:#fff;box-shadow:0 6px 12px rgba(0,0,0,.08);}
.cat-title{z-index:1; margin:4px 0 2px; font-weight:800; line-height:1.08; font-size:.92rem;
  display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;}
.cat-sub{z-index:1; color:#ffffff; opacity:.96; font-weight:600; font-size:.8rem}
.cat-orange{background:linear-gradient(135deg,var(--orange-1),var(--orange-2)); color:var(--orange-ink)}
.cat-indigo{background:linear-gradient(135deg,var(--indigo-1),var(--indigo-2)); color:var(--indigo-ink)}
.cat-pink{background:linear-gradient(135deg,var(--pink-1),var(--pink-2)); color:var(--pink-ink)}

/* REKOMENDASI (kartu kecil + snap) */
.rec-card{
  flex:0 0 var(--rec-w); height:var(--rec-h); scroll-snap-align:start;
  background:#fff;border-radius:16px;box-shadow:0 8px 24px rgba(20,24,55,.12);
  overflow:hidden; display:flex; flex-direction:column; justify-content:flex-start;
}
.rec-top{height:100px;display:flex;align-items:flex-end;justify-content:center}
.rec-orange{background:linear-gradient(135deg,#ffd2a6,#ffb778)}
.rec-pink{background:linear-gradient(135deg,#ffc7d6,#ff9fb7)}
.rec-indigo{background:linear-gradient(135deg,#cfd6ff,#aeb9ff)}
.rec-photo{height:86px;width:auto;object-fit:contain}
.rec-body{padding:.6rem .65rem}
.rec-name{font-weight:800;margin:0 0 2px}
.rec-role{font-size:.78rem;color:#98a1b3;margin:0}
.rec-price{font-weight:800;font-size:.86rem;margin-top:.25rem}

.nav-pill{left:50%;transform:translateX(-50%);width:min(393px,96%)}
.nav-wrap{background:#fff;border-radius:20px;box-shadow:0 18px 40px rgba(20,24,55,.18);padding:10px 12px;display:flex;justify-content:space-between}
.nav-item{width:25%;text-align:center;color:#65708a;text-decoration:none}
.nav-item i{font-size:1.25rem}
.nav-item.active{color:#6a78ff}
</style>
</head>
<body>
<div class="mobile-view">

  <!-- HEADER -->
  <header class="container py-3 px-3">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('assets/profile.jpg') }}" alt="Sasha" class="avatar-48 shadow-sm">
        <div class="lh-1">
          <div class="hello-small">Hello,</div>
          <div class="hello-name">Sasha</div>
        </div>
      </div>
      <!-- tombol search -> pencarian -->
      <a class="btn-icon" aria-label="Cari" href="{{ route('pencarian') }}"><i class="bi bi-search"></i></a>
    </div>
  </header>

  <!-- PROMO CAROUSEL -->
  <section class="hero">
    <div class="container hero-body">
      <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true" data-bs-interval="5000">
        <div class="carousel-indicators promo-indicators">
          <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="promo-card promo-indigo shadow">
              <div>
                <h5 class="mb-1 text-white">Mau Sesi Belajar Gratis?</h5>
                <p class="mb-3 text-white-50 fw-semibold">Coba Free Trial 3 Kali!</p>
                <a class="btn btn-resp btn-promo-solid" href="#" style="color:#28306e">Coba Sekarang</a>
              </div>
              <img class="promo-ill" src="{{ asset('assets/ill-indigo.png') }}" alt="">
            </div>
          </div>
          <div class="carousel-item">
            <div class="promo-card promo-orange shadow">
              <div>
                <h5 class="mb-1">Tidak Puas dengan Sesi Tutormu?</h5>
                <p class="mb-3">Lakukan Refund!</p>
                <a class="btn btn-resp btn-promo-solid" href="#" style="color:#5b2d00">Cek Sekarang</a>
              </div>
              <img class="promo-ill" src="{{ asset('assets/ill-orange.png') }}" alt="">
            </div>
          </div>
          <div class="carousel-item">
            <div class="promo-card promo-pink shadow">
              <div>
                <h5 class="mb-1">Susah Belajar Sendiri?</h5>
                <p class="mb-3">Cek Tutor kita</p>
                <a class="btn btn-resp btn-promo-solid" href="#" style="color:#6b1c3c">Cek Sekarang</a>
              </div>
              <img class="promo-ill" src="{{ asset('assets/ill-pink.png') }}" alt="">
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>

  <!-- CONTENT -->
  <main class="container my-4">
    <div class="surface p-3">

      <!-- KATEGORI (carousel, ukuran = Pencarian) -->
      <div class="d-flex justify-content-between align-items-center mb-1">
        <div class="section-title">Kategori</div>
        <a href="{{ route('kategori') }}" class="badge-pill">Lihat Semua</a>
      </div>
      <div class="section-sub small mb-3">Pilih Kategori Bidang yang Kamu Inginkan</div>

      <div class="snap-x mb-3">
        <article class="cat-card cat-orange">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-database text-warning"></i></div>
          <div>
            <div class="cat-title">Sistem Basis Data</div>
            <small class="cat-sub">18 Tutor</small>
          </div>
        </article>

        <article class="cat-card cat-indigo">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-window-sidebar text-primary"></i></div>
          <div>
            <div class="cat-title">Data Lakehouse</div>
            <small class="cat-sub">18 Tutor</small>
          </div>
        </article>

        <article class="cat-card cat-pink">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-code-slash text-danger"></i></div>
          <div>
            <div class="cat-title">Pemrograman Dasar</div>
            <small class="cat-sub">18 Tutor</small>
          </div>
        </article>
      </div>

      <!-- REKOMENDASI TUTOR (carousel compact) -->
      <div class="d-flex justify-content-between align-items-center mb-1 mt-2">
        <div class="section-title">Rekomendasi Tutor</div>
        <a href="{{ route('listutor') }}" class="badge-pill">Lihat Semua</a>
      </div>
      <div class="section-sub small mb-2">Cari Tutor Yang Cocok Untukmu</div>

      <div class="snap-x">
        <div class="rec-card">
          <div class="rec-top rec-orange"><img class="rec-photo" src="{{ asset('assets/tutors/khalila.png') }}" alt=""></div>
          <div class="rec-body">
            <div class="rec-name">Khalila</div>
            <div class="rec-role">DMJK</div>
            <div class="rec-price">Rp50.000/Sesi</div>
          </div>
        </div>

        <div class="rec-card">
          <div class="rec-top rec-pink"><img class="rec-photo" src="{{ asset('assets/tutors/sasha.png') }}" alt=""></div>
          <div class="rec-body">
            <div class="rec-name">Sasha</div>
            <div class="rec-role">PWEB</div>
            <div class="rec-price">Rp50.000/Sesi</div>
          </div>
        </div>

        <div class="rec-card">
          <div class="rec-top rec-indigo"><img class="rec-photo" src="{{ asset('assets/tutors/haryadi.png') }}" alt=""></div>
          <div class="rec-body">
            <div class="rec-name">Haryadi</div>
            <div class="rec-role">Pilates</div>
            <div class="rec-price">Rp1.000/Sesi</div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- Bottom Nav -->
  <nav class="nav-pill fixed-bottom">
    <div class="nav-wrap">
      <a class="nav-item active" aria-label="Beranda"><i class="bi bi-house-door-fill"></i></a>
      <a class="nav-item" aria-label="Chat"><i class="bi bi-chat-dots"></i></a>
      <a class="nav-item" aria-label="Materi"><i class="bi bi-journal-text"></i></a>
      <a class="nav-item" aria-label="Profil"><i class="bi bi-person"></i></a>
    </div>
  </nav>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
