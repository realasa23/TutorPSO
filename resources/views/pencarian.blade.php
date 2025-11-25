@extends('layout.Mobile-View')

@section('page-style')
<style>
/* CSS KHUSUS PENCARIAN */
:root{
  --card-h:116px; --card-r:16px; --notch:30px;
  --pad-x:12px; --pad-r:20px; --pad-y:10px;
  --title-size:.84rem;
  --panel-radius:24px;
}

/* Header & Search Bar */
.header-page{ display:flex; align-items:center; justify-content:space-between; color:#24304a; }
.header-page-title{ font-size:1.32rem; font-weight:800; margin:0 }
.btn-icon-back{ width:40px; height:40px; display:grid; place-items:center; border-radius:50%;
  color:#1d2433; text-decoration:none; background:rgba(255,255,255,.45); box-shadow:inset 0 0 0 1px rgba(0,0,0,.05) }

.search-input-group{ border-radius:999px; overflow:hidden; box-shadow:0 6px 16px rgba(31,43,86,.10) }
.search-input-group .form-control{ border:0; height:46px; box-shadow:none }
.search-input-group .input-group-text{ background:#fff; border:0 }

/* Card Kategori (Grid) */
.cat-card{
  position:relative; border-radius:var(--card-r); height:var(--card-h);
  padding:var(--pad-y) var(--pad-r) var(--pad-y) var(--pad-x);
  color:#1b2430; overflow:hidden; display:flex; flex-direction:column; gap:8px; isolation:isolate;
}
.cat-decor{position:absolute; inset:0; z-index:0; pointer-events:none;
  background: radial-gradient(160px 160px at 26% 22%, rgba(255,255,255,.42), rgba(255,255,255,0) 60%),
              radial-gradient(120px 120px at 74% 14%, rgba(255,255,255,.30), rgba(255,255,255,0) 60%);
}
.cat-notch{position:absolute; right:calc(-1 * var(--notch) / 2); top:50%;
  width:var(--notch); height:var(--notch); transform:translateY(-50%);
  background:#fff; border-radius:50%; box-shadow:inset 0 0 0 1px rgba(0,0,0,.03); z-index:0;
}
.cat-card::before{content:""; position:absolute; inset:0; z-index:0; border-radius:inherit;
  background:linear-gradient(180deg, rgba(255,255,255,.16), rgba(255,255,255,0)); pointer-events:none;
}
.cat-icon{z-index:1; display:inline-flex; align-items:center; justify-content:center;
  width:40px; height:40px; border-radius:12px; background:#fff;
  box-shadow:0 6px 12px rgba(0,0,0,.08); font-size:20px;
}
.cat-footer{ margin-top:auto; z-index:1; padding-top:2px; }
.cat-title{ font-size:var(--title-size); font-weight:800; line-height:1.12; margin:0 0 2px;
  display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.cat-sub{ color:#ffffff; opacity:.95; font-weight:500; font-size:.78rem }

/* Warna Card */
.cat-orange{ background:linear-gradient(135deg, var(--orange-1), var(--orange-2)); color:var(--orange-ink) }
.cat-indigo{ background:linear-gradient(135deg, var(--indigo-1), var(--indigo-2)); color:var(--indigo-ink) }
.cat-pink{ background:linear-gradient(135deg, var(--pink-1), var(--pink-2)); color:var(--pink-ink) }
</style>
@endsection

@section('content')
  <header class="container py-3 px-3 header-page">
    <a href="{{ route('home') }}" class="btn-icon-back" aria-label="Kembali">
      <i class="bi bi-chevron-left"></i>
    </a>
    <h1 class="header-page-title">Pencarian</h1>
    <span style="width:40px"></span> </header>

  <div class="container px-3 pb-3">
    <div class="input-group search-input-group">
      <span class="input-group-text ps-3"><i class="bi bi-search"></i></span>
      <input type="text" class="form-control" placeholder="Cari Tutor dan Kategori" />
    </div>
  </div>

  <main class="container px-3 pb-4">
    <div class="surface p-3">
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
        </div>
    </div>
  </main>

  {{-- @include('layout.Navbar') --}}
@endsection
