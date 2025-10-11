<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purok & Household - BM SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --ink-900: #0A1832;
            --ink-700: #1A3D63;
            --ink-500: #4A7FA7;
            --ink-300: #B3CFE5;
            --ink-50: #F6FAFD;

            --bs-body-bg: var(--ink-900);
            --bs-body-color: var(--ink-50);
            --bs-link-color: var(--ink-50);
            --bs-primary: var(--ink-700);
            --bs-secondary: var(--ink-500);
        }

        body {
            background-color: white !important;
            color: var(--ink-900);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: var(--ink-900) !important;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .main-content {
            margin-left: 300px;
            transition: margin-left 0.3s ease;
            background-color: white;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .top-header {
            background: var(--ink-700);
            border-bottom: 1px solid rgba(255,255,255,.15);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .user-info {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin: 0.25rem 0.75rem;
            position: relative;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white !important;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            color: white !important;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .burger-menu {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .leave-dashboard-btn {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .leave-dashboard-btn:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-2px);
        }

        .btn-close-sidebar {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-close-sidebar:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar.show {
            transform: translateX(0) !important;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
            .burger-menu {
                display: inline-block !important;
            }
            .stats-card {
                margin-bottom: 1.5rem;
                min-height: 160px;
            }
            .logo-container {
                width: 40px;
                height: 40px;
            }
            .sidebar-logo {
                width: 24px;
                height: 24px;
            }
        }

        @media (min-width: 769px) {
            .burger-menu {
                display: none !important;
            }
            .sidebar {
                transform: translateX(0) !important;
            }
        }

        @media (max-width: 576px) {
            .top-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }
            .top-header .d-flex:last-child {
                width: 100%;
                justify-content: space-between;
            }
            .leave-dashboard-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }
        }

        /* Professional Card Styling */
        .card {
            transition: all 0.3s ease;
            border: none !important;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
        }

        /* Professional Button Hover Effects */
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Clean Brand Styling - No Gradients */

        /* Badge Professional Styling */
        .badge {
            font-weight: 500 !important;
            letter-spacing: 0.5px;
        }

        /* Responsive Card Heights */
        .card.h-100 {
            min-height: 280px;
        }

        /* Professional Typography */
        .fw-bold {
            font-weight: 600 !important;
        }

        /* Enhanced Mobile Responsiveness */
        @media (max-width: 768px) {
            .card.h-100 {
                min-height: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="logo-container me-3">
                        <img src="{{ asset('/assets/images/logo.png') }}" class="sidebar-logo" alt="BM System Logo">
                    </div>
                    <div>
                        <span class="fw-bold text-white fs-5 d-block">BM SYSTEM</span>
                        <small class="text-light opacity-75">Brgy. San Pedro Apartado, Alcala Pangasinan</small>
                    </div>
                </div>
                <button class="btn-close-sidebar d-md-none" id="closeSidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="user-info">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                    <i class="fas fa-user" style="color: var(--ink-700);"></i>
                </div>
                <div>
                    <div class="fw-semibold text-white">{{ Auth::user()->role === 'captain' ? 'Ador G. Espiritu' : (Auth::user()->name ?? 'Admin') }}</div>
                    <div class="small text-light">
                        @if(Auth::check())
                            @if(Auth::user()->role === 'captain')
                                Barangay Captain
                            @elseif(Auth::user()->role === 'staff')
                                Barangay Secretary
                            @else
                                Administrator
                            @endif
                        @else
                            Administrator
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <nav class="nav flex-column">
            <div class="px-3 py-2">
                <small class="text-light opacity-75">MENU</small>
            </div>
            <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}" class="nav-link">
                <i class="fas fa-tachometer-alt me-3"></i> Dashboard
            </a>
            <a href="{{ Route::has('admin.officials') ? route('admin.officials') : url('/admin/officials') }}" class="nav-link">
                <i class="fas fa-users me-3"></i> Brgy Officials and Staff
            </a>
            <a href="{{ Route::has('admin.residents') ? route('admin.residents') : url('/admin/residents') }}" class="nav-link">
                <i class="fas fa-address-book me-3"></i> Residents Record
            </a>
            <a href="{{ Route::has('admin.certificates') ? route('admin.certificates') : url('/admin/certificates') }}" class="nav-link">
                <i class="fas fa-file-text me-3"></i> Certificate Management
            </a>
            <a href="{{ Route::has('admin.blotter') ? route('admin.blotter') : url('/admin/blotter') }}" class="nav-link">
                <i class="fas fa-gavel me-3"></i> Crime / Blotter Records
            </a>
            <a href="{{ Route::has('admin.purok') ? route('admin.purok') : url('/admin/purok') }}" class="nav-link active">
                <i class="fas fa-house-user me-3"></i> Purok & Household Records
            </a>
            <a href="{{ Route::has('admin.medicine') ? route('admin.medicine') : url('/admin/medicine') }}" class="nav-link">
                <i class="fas fa-pills me-3"></i> Medicine Inventory
            </a>
            
            @if(Auth::check() && Auth::user()->isCaptain())
                <div class="px-3 py-2 mt-3">
                    <small class="text-light opacity-75">ADMINISTRATION</small>
                </div>
                <a href="{{ Route::has('admin.account-approvals') ? route('admin.account-approvals') : url('/admin/account-approvals') }}" class="nav-link">
                    <i class="fas fa-user-check me-3"></i> Account Approvals
                </a>
            @endif
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Header -->
        <div class="top-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="burger-menu me-3" id="burgerMenu" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h3 mb-0 text-white">PUROK & HOUSEHOLD RECORDS</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-4" style="background-color: #f8f9fa;">
            {{-- Professional Stats Overview --}}
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card shadow-sm" style="border: none; border-radius: 12px; background: var(--ink-700);">
                        <div class="card-body text-center py-4 px-3">
                            <div class="mb-3" style="color: white;">
                                <i class="fas fa-users" style="font-size: 2.5rem;"></i>
                            </div>
                            <h3 class="mb-1 text-white fw-bold">{{ number_format($totals['total_population']) }}</h3>
                            <p class="mb-0" style="color: rgba(255,255,255,0.8);">Total Population</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm" style="border: none; border-radius: 12px; background: var(--ink-700);">
                        <div class="card-body text-center py-4 px-3">
                            <div class="mb-3" style="color: white;">
                                <i class="fas fa-home" style="font-size: 2.5rem;"></i>
                            </div>
                            <h3 class="mb-1 text-white fw-bold">{{ $totals['total_households'] }}</h3>
                            <p class="mb-0" style="color: rgba(255,255,255,0.8);">Total Households</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm" style="border: none; border-radius: 12px; background: var(--ink-700);">
                        <div class="card-body text-center py-4 px-3">
                            <div class="mb-3" style="color: white;">
                                <i class="fas fa-child" style="font-size: 2.5rem;"></i>
                            </div>
                            <h3 class="mb-1 text-white fw-bold">{{ $totals['total_children'] }}</h3>
                            <p class="mb-0" style="color: rgba(255,255,255,0.8);">Children (0-12)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm" style="border: none; border-radius: 12px; background: var(--ink-700);">
                        <div class="card-body text-center py-4 px-3">
                            <div class="mb-3" style="color: white;">
                                <i class="fas fa-user-alt" style="font-size: 2.5rem;"></i>
                            </div>
                            <h3 class="mb-1 text-white fw-bold">{{ $totals['total_senior_citizens'] }}</h3>
                            <p class="mb-0" style="color: rgba(255,255,255,0.8);">Senior Citizens</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Purok Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="width: 4px; height: 40px; background: var(--ink-700); border-radius: 2px;"></div>
                            <div>
                                <h4 class="mb-0" style="color: var(--ink-900); font-weight: 600;">All Puroks</h4>
                                <p class="mb-0" style="color: var(--ink-500);">Manage and view all purok records</p>
                            </div>
                        </div>
                        <span class="badge px-3 py-2" style="background: var(--ink-700); color: white;">{{ count($puroks) }} Puroks</span>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($puroks as $purok)
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100" style="border: 1px solid var(--ink-300); border-radius: 12px; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-header border-0" style="background: var(--ink-700); border-radius: 12px 12px 0 0; padding: 1.25rem;">
                                <div class="d-flex align-items-center text-white">
                                    <div class="me-3" style="width: 45px; height: 45px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-map-marker-alt" style="font-size: 1.2rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $purok['name'] }}</h6>
                                        <small style="color: rgba(255,255,255,0.8);">Leader: {{ $purok['leader'] }}</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body" style="padding: 1.5rem;">
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="text-center p-3" style="background: var(--ink-50); border-radius: 10px; border: 1px solid var(--ink-300);">
                                            <div class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--ink-700);">
                                                {{ $purok['total_population'] }}
                                            </div>
                                            <small style="color: var(--ink-500); font-weight: 500;">Population</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center p-3" style="background: var(--ink-50); border-radius: 10px; border: 1px solid var(--ink-300);">
                                            <div class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--ink-700);">
                                                {{ $purok['total_households'] }}
                                            </div>
                                            <small style="color: var(--ink-500); font-weight: 500;">Households</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <a href="{{ Route::has('admin.purok.show') ? route('admin.purok.show', $purok['id']) : '#' }}" 
                                       class="btn" style="background: var(--ink-700); color: white; border: none; border-radius: 8px; padding: 0.75rem; font-weight: 500; transition: transform 0.2s;">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const burgerMenu = document.getElementById('burgerMenu');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');

            // Handle burger menu click
            burgerMenu.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });

            // Handle close sidebar button click
            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('show');
            });

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !burgerMenu.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                }
            });
        });

        // Logout and redirect function
        function logoutAndRedirect() {
            if (confirm('Are you sure you want to leave the dashboard?')) {
                // Create a form to submit logout request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ Route::has("logout") ? route("logout") : url("/logout") }}';
                
                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                // Add to body and submit
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>