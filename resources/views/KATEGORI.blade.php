{{--
    Nama: Harya Raditya Handoyo
    NRP: 5026231176
--}}

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Kategori</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
  --radius-xl:18px;
  --bg-start:#c9d2ff; --bg-mid:#a9b7ff;
  --dark-text: #1A2B4B;
  --grey-text: #6c757d;

  --orange-1:#ffd2a6; --orange-2:#ffb778; --orange-ink:#7a3600;
  --indigo-1:#cfd6ff; --indigo-2:#aeb9ff; --indigo-ink:#24338b;
  --pink-1:#ffc7d6;     --pink-2:#ff9fb7;   --pink-ink:#7e2241;

  --card-h:116px;
  --card-r:16px;
  --notch:30px;
  --pad-x:12px;
  --pad-r:20px;
  --pad-y:10px;
  --title-size:.84rem;
}
*{box-sizing:border-box}
body{font-family:'Poppins',system-ui;background:#eef2ff}

.mobile{
  max-width:393px;
  margin:0 auto;
  min-height:100vh;
  background: linear-gradient(180deg, var(--bg-start) 0%, var(--bg-mid) 100%);
  display: flex;
  flex-direction: column;
  height: 100vh;
  overflow: hidden;
}

/* Header */
.appbar{
  position:relative;
  padding-top:16px;
  flex-shrink: 0;
}

.appbar .row{position:relative;z-index:2}
.back-btn{
  width:36px;
  height:36px;
  border-radius:50%;
  display:grid;
  place-items:center;
  background:#ffffff70;
  border:0;
  color:var(--dark-text);
  backdrop-filter:blur(6px);
  text-decoration: none;
}
.title{
  font-weight:800;
  font-size:1.25rem;
  text-align:center;
  color:var(--dark-text);
}

/* --- CSS TAB SAYA PERBAIKI DI SINI --- */
.category-tabs {
  flex-shrink: 0;
  padding: 0 1rem;
  margin-bottom: 0.75rem;

  display: flex;
  gap: 8px; /* Jarak antar tombol */
  overflow-x: auto; /* Bisa digeser jika tab-nya banyak */
  scrollbar-width: none; /* Sembunyikan scrollbar Firefox */

  justify-content: center; /* <-- SAYA TAMBAHKAN INI AGAR KE TENGAH */
}
/* Sembunyikan scrollbar Chrome/Safari */
.category-tabs::-webkit-scrollbar {
  display: none;
}


.btn-tab {
  border: 0;
  font-weight: 700;
  white-space: nowrap;
  font-size: 0.9rem;
  transition: all 0.2s ease-in-out;
  height: 42px;
  padding: 0 1.1rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;

  /* BENTUK DEFAULT (TIDAK AKTIF) */
  background: #ffffff40;
  color: #fff;
  border-radius: 999px; /* Bentuk 'pil' */
}

.btn-tab.active {
  /* BENTUK AKTIF */
  background: #fff;
  color: var(--dark-text);
  border-radius: 999px; /* Bentuk 'pil' */
}
/* ------------------------------------- */


/* Kartu Konten Putih */
.surface{
  background:#fff;
  border-top-left-radius:22px;
  border-top-right-radius:22px;
  box-shadow:0 -4px 18px rgba(20,24,55,.08);
  flex-grow: 1;
  overflow-y: auto;
  padding-bottom: 2rem;
}

/* CSS Scrollbar */
.surface::-webkit-scrollbar {
  width: 6px;
}
.surface::-webkit-scrollbar-track {
  background: transparent;
  margin-top: 22px;
}
.surface::-webkit-scrollbar-thumb {
  background-color: #d1d1d1;
  border-radius: 6px;
}

/* CSS Kartu (dari 'pencarian') */
.cat-card{
  position:relative; border-radius:var(--card-r); height:var(--card-h);
  padding:var(--pad-y) var(--pad-r) var(--pad-y) var(--pad-x);
  color:#1b2430; overflow:hidden; display:flex; flex-direction:column; gap:8px; isolation:isolate;
}
.cat-decor{
  position:absolute; inset:0; z-index:0;
  background:
    radial-gradient(160px 160px at 26% 22%, rgba(255,255,255,.42), rgba(255,255,255,0) 60%),
    radial-gradient(120px 120px at 74% 14%, rgba(255,255,255,.30), rgba(255,255,255,0) 60%),
    radial-gradient(100px 100px at 40% 58%, rgba(255,255,255,.18), rgba(255,255,255,0) 70%);
  pointer-events:none;
}
.cat-notch{
  position:absolute; right:calc(-1 * var(--notch) / 2); top:50%;
  width:var(--notch); height:var(--notch); transform:translateY(-50%);
  background:#fff; border-radius:50%; box-shadow:inset 0 0 0 1px rgba(0,0,0,.03);
  z-index:0; pointer-events:none;
}
.cat-card::before{
  content:""; position:absolute; inset:0; z-index:0; border-radius:inherit;
  background:linear-gradient(180deg, rgba(255,255,255,.16), rgba(255,255,255,0));
  pointer-events:none;
}
.cat-icon{
  z-index:1; display:inline-flex; align-items:center; justify-content:center;
  width:40px; height:40px; border-radius:12px; background:#fff;
  box-shadow:0 6px 12px rgba(0,0,0,.08); font-size:20px;
}
.cat-footer{ margin-top:auto; z-index:1; padding-top:2px; }
.cat-title{ font-size:var(--title-size); font-weight:800; line-height:1.12; margin:0 0 2px;
  display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; word-break: break-word; }
.cat-sub{ color:#ffffff; opacity:.95; font-weight:500; font-size:.78rem }

.cat-orange{ background:linear-gradient(135deg, var(--orange-1), var(--orange-2)); color:var(--orange-ink) }
.cat-indigo{ background:linear-gradient(135deg, var(--indigo-1), var(--indigo-2)); color:var(--indigo-ink) }
.cat-pink{  background:linear-gradient(135deg, var(--pink-1),   var(--pink-2));   color:var(--pink-ink) }
</style>
</head>
<body>

<div class="mobile">
  <header class="appbar container pb-3">
    <div class="row align-items-center">
      <div class="col-2">
        <a href="{{ route('home') }}" class="back-btn">
          <i class="bi bi-chevron-left"></i>
        </a>
      </div>
      <div class="col-8"><div class="title">Kategori</div></div>
      <div class="col-2"></div>
    </div>
  </header>

  <nav class="category-tabs">
    <button class="btn-tab active">Matematika</button>
    <button class="btn-tab">IT</button>
    <button class="btn-tab">Fisika</button>
    </nav>

  <main class="surface p-3">
    <div class="row g-3 row-cols-3">

      <div class="col">
        <article class="cat-card cat-orange h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-database text-warning"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Sistem Basis Data</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-indigo h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-window-sidebar text-primary"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Data Lakehouse</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-pink h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-code-slash text-danger"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Pemrograman Dasar</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>

      <div class="col">
        <article class="cat-card cat-orange h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-calculator text-warning"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Matematika</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-indigo h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-lightbulb text-primary"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Etika TI</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-pink h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-file-code text-danger"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Pemrograman Web</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>

      <div class="col">
        <article class="cat-card cat-orange h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-calculator-fill text-warning"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Riset Operasi</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-indigo h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-palette text-primary"></i></div>
          <div class="cat-footer"><h6 class="cat-title">UX Design</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-pink h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-building text-danger"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Sistem Enterprise</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>

      <div class="col">
        <article class="cat-card cat-orange h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-calculator text-warning"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Matematika</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-indigo h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-lightbulb text-primary"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Etika TI</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      <div class="col">
        <article class="cat-card cat-pink h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-file-code text-danger"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Pemrograman Web</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>

    </div>
  </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const tabs = document.querySelectorAll('.btn-tab');

  function handleTabClick(event) {
    tabs.forEach(tab => {
      tab.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', handleTabClick);
  });
</script>

</body>
</html>
