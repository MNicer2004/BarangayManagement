<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $purok['name'] }} Details - Barangay Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: white;
            color: var(--ink-900);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background-color: var(--ink-900);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo-container {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255,255,255,0.2);
        }

        .sidebar-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-header h4 {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .sidebar-header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            line-height: 1.3;
        }

        .user-info {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            object-fit: cover;
        }

        .user-name {
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .user-role {
            color: rgba(255,255,255,0.7);
            font-size: 0.8rem;
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
            background-color: rgba(255,255,255,0.12);
            color: #ffffff !important;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            color: white !important;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
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

        /* Stats card styles copied from dashboard */
        .stats-card {
            background: #ffffff;
            border: 4px solid var(--ink-300);
            border-radius: 16px;
            padding: 2rem;
            text-align: left;
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
            background: var(--ink-50);
        }

        /* Explicit colors for readability on light background */
        .stats-card .main-label {
            color: var(--ink-700);
        }
        .stats-card .main-number {
            color: var(--ink-900);
        }
        .stats-card .description {
            color: var(--ink-500);
        }

        .stats-card .icon-container {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 50px;
            height: 50px;
            background: var(--ink-50);
            border: 1px solid var(--ink-300);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stats-card .icon-container i {
            font-size: 1.5rem;
            color: var(--ink-700);
        }

        .stats-card .main-label {
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
            opacity: 0.9;
            color: var(--ink-700);
        }

        .stats-card .main-number {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.75rem;
            color: var(--ink-900);
        }

        .stats-card .description {
            font-size: 0.9rem;
            opacity: 0.8;
            margin: 0;
            color: var(--ink-500);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .burger-menu {
                display: block !important;
            }
            .top-header {
                padding: 0.75rem 1rem;
            }
            .top-header h1 {
                font-size: 1.25rem;
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

        /* Ensure all generic cards use light background for contrast */
        .card {
            background-color: #ffffff !important;
        }
        .card-header {
            background: var(--ink-50) !important;
            color: var(--ink-900) !important;
        }
        .card.shadow-sm {
            box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
            border: 1px solid var(--ink-300) !important;
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
                        <small class="text-light opacity-75 d-block" style="font-size: 0.7rem;">Brgy. San Pedro Apartado, Alcala</small>
                        <small class="text-light opacity-75 d-block" style="font-size: 0.7rem;">Pangasinan</small>
                    </div>
                </div>
                <button class="btn-close-sidebar d-md-none" id="closeSidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="user-info">
            <div class="d-flex align-items-center">
                <div class="user-avatar me-3" style="background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <div class="user-name">{{ Auth::user()->name ?? 'Barangay Captain' }}</div>
                    <div class="user-role">{{ Auth::user()->role ?? 'Barangay Captain' }}</div>
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
                <div>
                    <h1 class="h3 mb-1 text-white">
                        <i class="fas fa-map-marker-alt me-2"></i>{{ $purok['name'] }} Details
                    </h1>
                    <p class="mb-0 text-white-50">{{ $purok['description'] ?? 'Located at the northern part of the barangay' }}</p>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ Route::has('admin.purok') ? route('admin.purok') : url('/admin/purok') }}" class="leave-dashboard-btn me-3">
                    <i class="fas fa-arrow-left me-2"></i>Back to Purok List
                </a>
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Dashboard Content -->
    <div class="p-4">
            <!-- Purok Header Info -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm" style="border: 1px solid var(--ink-300); border-radius: 12px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="me-4" style="width: 80px; height: 80px; background: var(--ink-700); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-map-marker-alt text-white" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h3 class="mb-2" style="color: var(--ink-900);">{{ $purok['name'] }}</h3>
                                    <p class="mb-1" style="color: var(--ink-500);">
                                        <i class="fas fa-user me-2"></i>
                                        <strong>Purok Leader:</strong> {{ $purok['leader'] }}
                                    </p>
                                    <p class="mb-0" style="color: var(--ink-500);">{{ $purok['description'] ?? 'Located at the northern part of the barangay' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Statistics using stats-card (exact dashboard style) -->
            <div class="row g-5">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="main-label">POPULATION</div>
                        <div class="main-number">{{ $purok['total_population'] }}</div>
                        <div class="description">Total Population</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="main-label">HOUSEHOLDS</div>
                        <div class="main-number">{{ $purok['total_households'] }}</div>
                        <div class="description">Avg {{ round($purok['total_population'] / max($purok['total_households'],1), 1) }} per household</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-vote-yea"></i>
                        </div>
                        <div class="main-label">VOTERS</div>
                        <div class="main-number">{{ $purok['registered_voters'] ?? '98' }}</div>
                        <div class="description">{{ round((($purok['registered_voters'] ?? 98) / max($purok['total_population'],1)) * 100, 1) }}% of population</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="main-label">4PS</div>
                        <div class="main-number">{{ $purok['pantawid_beneficiaries'] ?? '15' }}</div>
                        <div class="description">{{ round((($purok['pantawid_beneficiaries'] ?? 15) / max($purok['total_households'],1)) * 100, 1) }}% of households</div>
                    </div>
                </div>
            </div>

            <!-- Age Demographics -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card shadow-sm" style="border: 1px solid var(--ink-300); border-radius: 12px;">
                        <div class="card-header" style="background: var(--ink-50); border-bottom: 1px solid var(--ink-300); border-radius: 12px 12px 0 0; padding: 1.25rem;">
                            <h5 class="mb-0" style="color: var(--ink-900);">
                                <i class="fas fa-chart-pie me-2"></i>Age Demographics
                            </h5>
                        </div>
                        <div class="card-body" style="padding: 1.5rem; color: var(--ink-900);">
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <div class="text-center p-3" style="background: var(--ink-50); border-radius: 10px; border: 1px solid var(--ink-300);">
                                        <div class="mb-3" style="color: var(--ink-700);">
                                            <i class="fas fa-child" style="font-size: 2rem;"></i>
                                        </div>
                                        <div class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--ink-700);">
                                            {{ $purok['children_0_12'] ?? '35' }}
                                        </div>
                                        <div style="color: var(--ink-700); font-weight: 500; margin-bottom: 0.5rem;">Children (0-12)</div>
                                        <small style="color: var(--ink-500);">{{ round((($purok['children_0_12'] ?? 35) / $purok['total_population']) * 100, 1) }}%</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3" style="background: var(--ink-50); border-radius: 10px; border: 1px solid var(--ink-300);">
                                        <div class="mb-3" style="color: var(--ink-700);">
                                            <i class="fas fa-user-friends" style="font-size: 2rem;"></i>
                                        </div>
                                        <div class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--ink-700);">
                                            {{ $purok['minors_13_17'] ?? '22' }}
                                        </div>
                                        <div style="color: var(--ink-700); font-weight: 500; margin-bottom: 0.5rem;">Minors (13-17)</div>
                                        <small style="color: var(--ink-500);">{{ round((($purok['minors_13_17'] ?? 22) / $purok['total_population']) * 100, 1) }}%</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3" style="background: var(--ink-50); border-radius: 10px; border: 1px solid var(--ink-300);">
                                        <div class="mb-3" style="color: var(--ink-700);">
                                            <i class="fas fa-user" style="font-size: 2rem;"></i>
                                        </div>
                                        <div class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--ink-700);">
                                            {{ $purok['adults_18_59'] ?? '81' }}
                                        </div>
                                        <div style="color: var(--ink-700); font-weight: 500; margin-bottom: 0.5rem;">Adults (18-59)</div>
                                        <small style="color: var(--ink-500);">{{ round((($purok['adults_18_59'] ?? 81) / $purok['total_population']) * 100, 1) }}%</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3" style="background: var(--ink-50); border-radius: 10px; border: 1px solid var(--ink-300);">
                                        <div class="mb-3" style="color: var(--ink-700);">
                                            <i class="fas fa-user-alt" style="font-size: 2rem;"></i>
                                        </div>
                                        <div class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--ink-700);">
                                            {{ $purok['senior_citizens'] ?? '18' }}
                                        </div>
                                        <div style="color: var(--ink-700); font-weight: 500; margin-bottom: 0.5rem;">Senior Citizens (60+)</div>
                                        <small style="color: var(--ink-500);">{{ round((($purok['senior_citizens'] ?? 18) / $purok['total_population']) * 100, 1) }}%</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Special Categories -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card shadow-sm" style="border: 1px solid var(--ink-300); border-radius: 12px;">
                        <div class="card-header" style="background: var(--ink-50); border-bottom: 1px solid var(--ink-300); border-radius: 12px 12px 0 0; padding: 1.25rem;">
                            <h5 class="mb-0" style="color: var(--ink-900);">
                                <i class="fas fa-wheelchair me-2"></i>PWD Records
                            </h5>
                        </div>
                        <div class="card-body text-center" style="padding: 2rem; background: #ffffff; color: var(--ink-900);">
                            <div class="mb-3" style="width: 80px; height: 80px; background: var(--ink-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 3px solid var(--ink-300);">
                                <i class="fas fa-wheelchair" style="font-size: 2rem; color: var(--ink-700);"></i>
                            </div>
                            <h3 class="mb-2" style="color: var(--ink-700); font-weight: 700;">{{ $purok['pwd_count'] ?? '0' }}</h3>
                            <p class="mb-2" style="color: var(--ink-700);">Persons with Disabilities</p>
                            <small style="color: var(--ink-500);">{{ round((($purok['pwd_count'] ?? 0) / $purok['total_population']) * 100, 1) }}% of total population</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm" style="border: 1px solid var(--ink-300); border-radius: 12px;">
                        <div class="card-header" style="background: var(--ink-50); border-bottom: 1px solid var(--ink-300); border-radius: 12px 12px 0 0; padding: 1.25rem;">
                            <h5 class="mb-0" style="color: var(--ink-900);">
                                <i class="fas fa-hand-holding-heart me-2"></i>Social Services
                            </h5>
                        </div>
                        <div class="card-body text-center" style="padding: 2rem; background: #ffffff; color: var(--ink-900);">
                            <div class="mb-3" style="width: 80px; height: 80px; background: var(--ink-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 3px solid var(--ink-300);">
                                <i class="fas fa-hand-holding-heart" style="font-size: 2rem; color: var(--ink-700);"></i>
                            </div>
                            <h3 class="mb-2" style="color: var(--ink-700); font-weight: 700;">{{ $purok['pantawid_beneficiaries'] ?? '15' }}</h3>
                            <p class="mb-2" style="color: var(--ink-700);">4Ps Beneficiary Households</p>
                            <small style="color: var(--ink-500);">{{ round((($purok['pantawid_beneficiaries'] ?? 15) / $purok['total_households']) * 100, 1) }}% of households receive assistance</small>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($purok['households']) && count($purok['households']) > 0)
            <!-- Household Records -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border: 1px solid var(--ink-300); border-radius: 12px;">
                        <div class="card-header" style="background: var(--ink-50); border-bottom: 1px solid var(--ink-300); border-radius: 12px 12px 0 0; padding: 1.25rem;">
                            <h5 class="mb-0" style="color: var(--ink-900);">
                                <i class="fas fa-list me-2"></i>Household Records
                            </h5>
                        </div>
                        <div class="card-body" style="padding: 1.5rem; background: #ffffff; color: var(--ink-900);">
                            <div class="table-responsive">
                                <table class="table table-hover" style="color: var(--ink-900);">
                                    <thead style="background: var(--ink-50); color: var(--ink-900);">
                                        <tr>
                                            <th style="color: var(--ink-700); border-bottom: 2px solid var(--ink-300);">Family Name</th>
                                            <th style="color: var(--ink-700); border-bottom: 2px solid var(--ink-300);">Household Head</th>
                                            <th style="color: var(--ink-700); border-bottom: 2px solid var(--ink-300);">Members</th>
                                            <th style="color: var(--ink-700); border-bottom: 2px solid var(--ink-300);">Address</th>
                                            <th style="color: var(--ink-700); border-bottom: 2px solid var(--ink-300);">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purok['households'] as $household)
                                        <tr>
                                            <td><strong style="color: var(--ink-700);">{{ $household['family_name'] }}</strong></td>
                                            <td style="color: var(--ink-900);">{{ $household['head'] }}</td>
                                            <td>
                                                <span class="badge px-2 py-1" style="background: var(--ink-700); color: white;">{{ $household['members'] }} members</span>
                                            </td>
                                            <td style="color: var(--ink-900);">{{ $household['address'] }}</td>
                                            <td>
                                                <button class="btn btn-sm me-2" style="background: var(--ink-700); color: white; border: none;">
                                                    <i class="fas fa-eye me-1"></i>View
                                                </button>
                                                <button class="btn btn-sm" style="background: var(--ink-300); color: var(--ink-700); border: none;">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mt-3">
                                <p style="color: var(--ink-700);">Showing sample records. <a href="#" style="color: var(--ink-700);">View all {{ $purok['total_households'] }} households</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Font Awesome for icons (match dashboard) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerMenu = document.getElementById('burgerMenu');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');

            // Handle burger menu click
            burgerMenu.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('show');
                }
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

            // Initialize sidebar state based on screen size
            function initializeSidebar() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                } else {
                    sidebar.classList.add('show');
                }
            }

            initializeSidebar();
        });

        // Logout and redirect function (match dashboard)
        function logoutAndRedirect() {
            if (confirm('Are you sure you want to leave the dashboard? You will need to log in again to access it.')) {
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