<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Barangay Management and Medicine Inventory')</title>

  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome 6 (CDN) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

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
    .navbar-ink{
      background:var(--ink-700);
      border-bottom:1px solid rgba(255,255,255,.15);
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    
    .navbar-ink .navbar-brand {
      transition: all 0.3s ease;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    
    .navbar-ink .navbar-brand:hover {
      color: var(--ink-300) !important;
      transform: scale(1.02);
    }
    
    .navbar-ink .nav-link {
      color: #e8f3fb;
      opacity: .85;
      transition: all 0.3s ease;
      position: relative;
      padding: 0.75rem 1rem !important;
      margin: 0 0.25rem;
      border-radius: 8px;
      font-weight: 600;
      background: transparent;
    }
    
    /* Regular nav links (Home, Map) - just underline effect */
    .navbar-ink .nav-link:not(.btn-dashboard):hover {
      opacity: 1;
      color: white !important;
      background: transparent;
    }
    
    .navbar-ink .nav-link:not(.btn-dashboard).active {
      opacity: 1;
      color: white !important;
      background: transparent;
    }
    
    .navbar-ink .nav-link:not(.btn-dashboard)::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 50%;
      background: var(--ink-300);
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }
    
    .navbar-ink .nav-link:not(.btn-dashboard):hover::after,
    .navbar-ink .nav-link:not(.btn-dashboard).active::after {
      width: 80%;
    }
    
    /* Dashboard button styling */
    .navbar-ink .nav-link.btn-dashboard {
      background: #dc3545;
      color: white !important;
      opacity: 1;
      border-radius: 20px;
      padding: 0.75rem 1.2rem !important;
      margin-left: 0.5rem;
      margin-top: 0;
      margin-bottom: 0;
      font-weight: 600;
      border: none;
      box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      height: auto;
      line-height: 1;
    }
    
    .navbar-ink .nav-link.btn-dashboard:hover {
      background: #c82333;
      color: white !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(220, 53, 69, 0.4);
    }
    
    .navbar-ink .nav-link.btn-dashboard::after {
      display: none; /* No underline for button */
    }
    
    /* Icon spacing */
    .navbar-ink .nav-link i {
      margin-right: 0.5rem;
    }
    
    .navbar-toggler {
      border: none;
      padding: 0.5rem;
      transition: all 0.3s ease;
    }
    
    .navbar-toggler:hover {
      background: rgba(255,255,255,0.1);
      transform: scale(1.05);
    }
    
    .navbar-toggler:focus {
      box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
    }

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
      <a class="navbar-brand fw-bold" href="{{ route('public.home') }}">BM & MI SYSTEM</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainMenu">
        <ul class="navbar-nav ms-auto mb-2 mb-md-0 fw-semibold">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.home') ? 'active' : '' }}" href="{{ route('public.home') }}"><i class="fa-solid fa-house-circle-check"></i></i>Home</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.map') ? 'active' : '' }}" href="{{ route('public.map') }}"><i class="fa-solid fa-magnifying-glass-location"></i></i>Map</a></li>
          <li class="nav-item"><a class="nav-link btn-dashboard" href="{{ route('admin.dashboard') }}"><i class="fa-brands fa-hashnode"></i></i>Dashboard</a></li>
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
