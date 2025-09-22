<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','BM SYSTEM')</title>

  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ---- Palette ---- */
    :root{
      --ink-900:#0A1832; /* page bg */
      --ink-700:#1A3D63; /* nav bg */
      --ink-500:#4A7FA7; /* accent */
      --ink-300:#B3CFE5; /* muted */
      --ink-50:#F6FAFD; /* light text */

      --bs-body-bg: var(--ink-900);
      --bs-body-color: var(--ink-50);
      --bs-link-color: var(--ink-50);
      --bs-primary: var(--ink-700);
      --bs-secondary: var(--ink-500);
    }

    /* Layout */
    body{min-height:100vh;display:flex;flex-direction:column;background:var(--ink-900);color:var(--ink-50)}
    main{flex:1}

    /* Navbar */
    .navbar-ink{background:var(--ink-700);border-bottom:1px solid rgba(255,255,255,.15)}
    .navbar-ink .nav-link{color:#e8f3fb;opacity:.9}
    .navbar-ink .nav-link:hover,.navbar-ink .nav-link.active{opacity:1}

    /* Card */
    .card-glass{
      background: rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.15);
      border-radius:16px;
      box-shadow: 0 12px 30px rgba(0,0,0,.25);
    }

    .text-ink-300{color:var(--ink-300)!important}
    .btn-pill{border-radius:999px}
    .btn-ghost{border:1px solid var(--ink-300);color:var(--ink-50);background:transparent}
    .btn-ghost:hover{border-color:#fff}

    /* Vertically center the hero area, with nice breathing room */
    .hero-center{
      min-height: calc(100vh - 180px); /* accounts for navbar + footer */
      display:flex;
      align-items:center;
    }
    @media (max-width: 768px){
      .hero-center{ min-height: calc(100vh - 220px); }
    }

    /* Footer */
    .footer-ink{background:rgba(26,61,99,.40);border-top:1px solid rgba(255,255,255,.15)}
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-md navbar-ink">
    <div class="container" style="max-width:1200px">
      <a class="navbar-brand fw-bold" href="{{ route('public.home') }}">BM SYSTEM</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainMenu">
        <ul class="navbar-nav ms-auto mb-2 mb-md-0 fw-semibold">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.home') ? 'active' : '' }}" href="{{ route('public.home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.services') ? 'active' : '' }}" href="{{ route('public.services') }}">Services</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.map') ? 'active' : '' }}" href="{{ route('public.map') }}">Map</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.track') ? 'active' : '' }}" href="{{ route('public.track') }}">Track My Request</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- PAGE -->
  <main>
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="footer-ink">
    <div class="container" style="max-width:1200px">
      <div class="py-3 text-ink-300 small">© {{ date('Y') }} Barangay Management System</div>
    </div>
  </footer>

  <!-- Bootstrap JS (CDN) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
