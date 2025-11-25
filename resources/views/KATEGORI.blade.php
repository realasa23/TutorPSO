//Harya Raditya Handoyo 5026231176

@extends('layout.Mobile-View')

@section('page-style')
<style>
/* CSS KHUSUS KATEGORI */
:root{
  --card-h:116px; --card-r:16px; --notch:30px;
  --pad-x:12px; --pad-r:20px; --pad-y:10px;
  --title-size:.84rem;
}

/* Header */
.appbar{ position:relative; padding-top:16px; flex-shrink: 0; }
.back-btn{ width:36px; height:36px; border-radius:50%; display:grid; place-items:center;
  background:#ffffff70; border:0; color:#1A2B4B; backdrop-filter:blur(6px); text-decoration: none; }
.title{ font-weight:800; font-size:1.25rem; text-align:center; color:#1A2B4B; }

/* Tabs */
.category-tabs { flex-shrink: 0; padding: 0 1rem; margin-bottom: 0.75rem; display: flex; gap: 8px; overflow-x: auto; scrollbar-width: none; justify-content: center; }
.category-tabs::-webkit-scrollbar { display: none; }
.btn-tab { border: 0; font-weight: 700; white-space: nowrap; font-size: 0.9rem; height: 42px; padding: 0 1.1rem;
  display: inline-flex; align-items: center; justify-content: center; background: #ffffff40; color: #fff; border-radius: 999px; }
.btn-tab.active { background: #fff; color: #1A2B4B; }

/* Surface & Scroll */
.surface-scroll{ background:#fff; border-top-left-radius:22px; border-top-right-radius:22px; box-shadow:0 -4px 18px rgba(20,24,55,.08);
  flex-grow: 1; overflow-y: auto; padding-bottom: 2rem; height: calc(100vh - 140px); } /* Adjust height biar scrollable */

/* Card Styles sama dengan Pencarian, disederhanakan disini */
.cat-card{ position:relative; border-radius:var(--card-r); height:var(--card-h); padding:var(--pad-y) var(--pad-r) var(--pad-y) var(--pad-x);
  color:#1b2430; overflow:hidden; display:flex; flex-direction:column; gap:8px; isolation:isolate; }
.cat-decor{ position:absolute; inset:0; z-index:0; pointer-events:none; background: radial-gradient(160px 160px at 26% 22%, rgba(255,255,255,.42), rgba(255,255,255,0) 60%); }
.cat-notch{ position:absolute; right:-15px; top:50%; width:30px; height:30px; transform:translateY(-50%); background:#fff; border-radius:50%; }
.cat-icon{ z-index:1; display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; border-radius:12px; background:#fff; box-shadow:0 6px 12px rgba(0,0,0,.08); }
.cat-footer{ margin-top:auto; z-index:1; }
.cat-title{ font-size:var(--title-size); font-weight:800; line-height:1.12; margin:0; }
.cat-sub{ color:#ffffff; opacity:.95; font-weight:500; font-size:.78rem }

.cat-orange{ background:linear-gradient(135deg, var(--orange-1), var(--orange-2)); color:var(--orange-ink) }
.cat-indigo{ background:linear-gradient(135deg, var(--indigo-1), var(--indigo-2)); color:var(--indigo-ink) }
.cat-pink{ background:linear-gradient(135deg, var(--pink-1), var(--pink-2)); color:var(--pink-ink) }
</style>
@endsection

@section('content')
  <header class="appbar container pb-3">
    <div class="row align-items-center">
      <div class="col-2">
        <a href="{{ route('home') }}" class="back-btn"><i class="bi bi-chevron-left"></i></a>
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

  <main class="surface-scroll p-3">
    <div class="row g-3 row-cols-3">
      <div class="col">
        <article class="cat-card cat-orange h-100">
          <div class="cat-decor"></div><span class="cat-notch"></span>
          <div class="cat-icon"><i class="bi bi-database text-warning"></i></div>
          <div class="cat-footer"><h6 class="cat-title">Sistem Basis Data</h6><small class="cat-sub">18 Tutor</small></div>
        </article>
      </div>
      </div>
  </main>
@endsection
