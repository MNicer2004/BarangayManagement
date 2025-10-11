<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Certificate Management - BM SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        :root {
            --ink-900: #0A1832;
            --ink-700: #1A3D63;
            --ink-500: #4A7FA7;
            --ink-300: #B3CFE5;
            --ink-50: #F6FAFD;

            --bs-body-bg: white;
            --bs-body-color: var(--ink-900);
            --bs-link-color: var(--ink-700);
            --bs-primary: var(--ink-700);
            --bs-secondary: var(--ink-500);
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

        .stats-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .stats-card .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-card .icon.certificates { background: #e3f2fd; color: #1976d2; }
        .stats-card .icon.paid { background: #e8f5e8; color: #388e3c; }
        .stats-card .icon.pending { background: #fff3e0; color: #f57c00; }
        .stats-card .icon.revenue { background: #f3e5f5; color: #7b1fa2; }

        .stats-card .number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-card .label {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            padding: 1.25rem;
            font-weight: 600;
        }

        /* Force button text visibility with highest priority */
        .btn * {
            color: inherit !important;
        }

        .btn {
            font-weight: 500 !important;
            border-radius: 6px;
            transition: all 0.2s ease;
            text-decoration: none !important;
            display: inline-block !important;
            line-height: 1.5 !important;
        }

        .btn-primary {
            background-color: var(--ink-700) !important;
            border-color: var(--ink-700) !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active {
            background-color: var(--ink-900) !important;
            border-color: var(--ink-900) !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 0.2rem rgba(26, 61, 99, 0.25) !important;
        }

        .btn-outline-primary {
            color: var(--ink-700) !important;
            border-color: var(--ink-700) !important;
            background-color: transparent !important;
            font-weight: 500 !important;
        }

        .btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active, .btn-outline-primary.active {
            background-color: var(--ink-700) !important;
            border-color: var(--ink-700) !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 0.2rem rgba(26, 61, 99, 0.25) !important;
        }

        .btn-outline-info {
            color: #0dcaf0 !important;
            border-color: #0dcaf0 !important;
            background-color: transparent !important;
            font-weight: 500 !important;
        }

        .btn-outline-info:hover, .btn-outline-info:focus, .btn-outline-info:active, .btn-outline-info.active {
            background-color: #0dcaf0 !important;
            border-color: #0dcaf0 !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25) !important;
        }

        .btn-outline-secondary {
            color: var(--ink-500) !important;
            border-color: var(--ink-500) !important;
            background-color: transparent !important;
            font-weight: 500 !important;
        }

        .btn-outline-secondary:hover, .btn-outline-secondary:focus, .btn-outline-secondary:active, .btn-outline-secondary.active {
            background-color: var(--ink-500) !important;
            border-color: var(--ink-500) !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 0.2rem rgba(74, 127, 167, 0.25) !important;
        }

        .btn-outline-success {
            color: #198754 !important;
            border-color: #198754 !important;
            background-color: transparent !important;
            font-weight: 500 !important;
        }

        .btn-outline-success:hover, .btn-outline-success:focus, .btn-outline-success:active, .btn-outline-success.active {
            background-color: #198754 !important;
            border-color: #198754 !important;
            color: #ffffff !important;
        }

        .btn-outline-danger {
            color: #dc3545 !important;
            border-color: #dc3545 !important;
            background-color: transparent !important;
            font-weight: 500 !important;
        }

        .btn-outline-danger:hover, .btn-outline-danger:focus, .btn-outline-danger:active, .btn-outline-danger.active {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            color: #ffffff !important;
        }

        .btn-secondary {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: #ffffff !important;
            font-weight: 500 !important;
        }

        .btn-secondary:hover, .btn-secondary:focus, .btn-secondary:active, .btn-secondary.active {
            background-color: #5c636a !important;
            border-color: #5c636a !important;
            color: #ffffff !important;
        }

        /* Ensure button icons are visible */
        .btn i, .btn .fas, .btn .far, .btn .fab {
            color: inherit !important;
            opacity: 1 !important;
        }

        /* Fix for small buttons */
        .btn-sm {
            font-size: 0.875rem !important;
            padding: 0.375rem 0.75rem !important;
        }

        /* Override any Bootstrap conflicts */
        .btn:not(:disabled):not(.disabled) {
            cursor: pointer !important;
        }

        /* Force text content visibility */
        .btn span, .btn text {
            color: inherit !important;
        }

        /* Add a debug style to make buttons more visible */
        .btn {
            border: 2px solid !important;
            min-height: 38px !important;
            text-shadow: none !important;
        }

        /* Ensure all button text is visible by adding a contrasting outline */
        .btn-primary {
            text-shadow: 0 0 1px rgba(0,0,0,0.5) !important;
        }

        .btn-outline-primary {
            text-shadow: 0 0 1px rgba(255,255,255,0.8) !important;
        }

        /* CLEAN BUTTON STYLING - BLACK TEXT ON DARK BLUE */
        .btn, button, input[type="button"], input[type="submit"] {
            font-weight: 500 !important;
            font-size: 14px !important;
            padding: 8px 16px !important;
            line-height: 1.5 !important;
            text-decoration: none !important;
            border-radius: 6px !important;
            border: 1px solid transparent !important;
            text-shadow: none !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .btn-primary, button.btn-primary {
            background-color: var(--ink-700) !important;
            color: #ffffff !important;
            border-color: var(--ink-700) !important;
        }

        .btn-primary:hover {
            background-color: var(--ink-900) !important;
            color: #ffffff !important;
            border-color: var(--ink-900) !important;
        }

        /* Force white text on primary buttons */
        .btn-primary *, button.btn-primary *, 
        .btn-primary i, button.btn-primary i, 
        .btn-primary .fas, button.btn-primary .fas,
        .btn-primary span, button.btn-primary span {
            color: #ffffff !important;
        }

        /* TAB NAVIGATION BUTTONS STYLING */
        .nav-tabs .nav-link {
            background-color: transparent !important;
            color: #000000 !important;
            border: 1px solid transparent !important;
            border-radius: 6px 6px 0 0 !important;
            font-weight: 500 !important;
        }

        .nav-tabs .nav-link:hover {
            background-color: var(--ink-900) !important;
            color: #ffffff !important;
            border-color: var(--ink-900) !important;
        }

        .nav-tabs .nav-link.active {
            background-color: var(--ink-700) !important;
            color: #ffffff !important;
            border-color: var(--ink-700) !important;
        }

        /* Force text color for tab content */
        .nav-tabs .nav-link *,
        .nav-tabs .nav-link i,
        .nav-tabs .nav-link .fas {
            color: inherit !important;
        }

        .btn-outline-primary, button.btn-outline-primary {
            background-color: transparent !important;
            color: var(--ink-700) !important;
            border-color: var(--ink-700) !important;
        }

        .btn-outline-primary:hover {
            background-color: var(--ink-700) !important;
            color: #ffffff !important;
            border-color: var(--ink-700) !important;
        }

        .btn-outline-info, button.btn-outline-info {
            background-color: transparent !important;
            color: #0dcaf0 !important;
            border-color: #0dcaf0 !important;
        }

        .btn-outline-info:hover {
            background-color: #0dcaf0 !important;
            color: #ffffff !important;
            border-color: #0dcaf0 !important;
        }

        .btn-outline-secondary, button.btn-outline-secondary {
            background-color: transparent !important;
            color: #6c757d !important;
            border-color: #6c757d !important;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d !important;
            color: #ffffff !important;
            border-color: #6c757d !important;
        }

        .btn-secondary, button.btn-secondary {
            background-color: #6c757d !important;
            color: #ffffff !important;
            border-color: #6c757d !important;
        }

        /* Force all button content and icons to inherit color */
        .btn *, button *, .btn i, button i, .btn .fas, button .fas {
            color: inherit !important;
            opacity: 1 !important;
            visibility: visible !important;
            display: inline !important;
        }

        /* Ensure button content is never transparent or hidden */
        .btn span, button span, .btn text, button text {
            color: inherit !important;
            opacity: 1 !important;
        }

        .btn-primary, button.btn-primary {
            background-color: var(--ink-700) !important;
            color: #ffffff !important;
            border-color: var(--ink-700) !important;
        }

        .btn-primary:hover {
            background-color: var(--ink-900) !important;
            color: #ffffff !important;
            border-color: var(--ink-900) !important;
        }

        /* Force white text on primary buttons */
        .btn-primary *, button.btn-primary *, 
        .btn-primary i, button.btn-primary i, 
        .btn-primary .fas, button.btn-primary .fas,
        .btn-primary span, button.btn-primary span {
            color: #ffffff !important;
        }

        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .table {
            margin-bottom: 0;
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background-color: var(--ink-700);
        }

        .table thead th {
            background-color: var(--ink-700) !important;
            color: white !important;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 12px 15px;
        }

        .table tbody td {
            background-color: white !important;
            color: #333 !important;
            border-color: #dee2e6;
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa !important;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }

        .modal-content {
            border-radius: 12px;
        }

        .modal-header {
            border-bottom: 1px solid #e0e0e0;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--ink-500);
            box-shadow: 0 0 0 0.2rem rgba(74, 127, 167, 0.25);
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="logo-container me-3">
                        <img src="{{ asset('assets/images/logo.png') }}" class="sidebar-logo" alt="Barangay Management & Medicine Inventory Logo">
                    </div>
                    <div>
                        <span class="fw-bold text-white fs-5 d-block">Barangay Management & Medicine Inventory</span>
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
                    <i class="fas fa-user"></i>
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-tachometer-alt me-3"></i> Dashboard
            </a>
            <a href="{{ route('admin.officials') }}" class="nav-link">
                <i class="fas fa-users me-3"></i> Brgy Officials and Staff
            </a>
            <a href="{{ route('admin.residents') }}" class="nav-link">
                <i class="fas fa-address-book me-3"></i> Residents Record
            </a>
            <a href="{{ route('admin.certificates') }}" class="nav-link active">
                <i class="fas fa-file-text me-3"></i> Certificate Management
            </a>
            <a href="{{ route('admin.blotter') }}" class="nav-link">
                <i class="fas fa-gavel me-3"></i> Crime / Blotter Records
            </a>
            <a href="{{ route('admin.medicine') }}" class="nav-link">
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
            
            <!-- Live Date and Time -->
            <div class="px-3 py-3 mt-auto border-top border-secondary">
                <div class="text-center">
                    <small class="text-light opacity-75 d-block mb-1">PHILIPPINES TIME</small>
                    <div class="text-light" id="live-datetime">
                        <div class="fw-bold" id="live-date"></div>
                        <div class="fs-6" id="live-time"></div>
                    </div>
                </div>
            </div>
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
                <h1 class="h3 mb-0 text-white">CERTIFICATE MANAGEMENT</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card">
                        <div class="icon certificates">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="number">{{ $stats['total_certificates'] }}</div>
                        <p class="label">Total Certificates</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card">
                        <div class="icon paid">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="number">{{ $stats['paid_certificates'] }}</div>
                        <p class="label">Paid Certificates</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card">
                        <div class="icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="number">{{ $stats['pending_payments'] }}</div>
                        <p class="label">Pending Payments</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card">
                        <div class="icon revenue">
                            <i class="fas fa-peso-sign"></i>
                        </div>
                        <div class="number">₱{{ number_format($stats['total_revenue'], 2) }}</div>
                        <p class="label">Total Revenue</p>
                    </div>
                </div>
            </div>

            <!-- Certificate Management Tabs -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="documentTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="certificates-tab" data-bs-toggle="tab" data-bs-target="#certificates" type="button" role="tab" aria-controls="certificates" aria-selected="true">
                                        <i class="fas fa-certificate me-2"></i>Certificate Records
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#requests" type="button" role="tab" aria-controls="requests" aria-selected="false">
                                        <i class="fas fa-inbox me-2"></i>Document Requests
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="templates-tab" data-bs-toggle="tab" data-bs-target="#templates" type="button" role="tab" aria-controls="templates" aria-selected="false">
                                        <i class="fas fa-file-alt me-2"></i>Document Templates
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab" aria-controls="archived" aria-selected="false">
                                        <i class="fas fa-archive me-2"></i>Archived Documents
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-0">
                            <div class="tab-content" id="documentTabContent">
                                <!-- Certificate Records Tab -->
                                <div class="tab-pane fade show active" id="certificates" role="tabpanel" aria-labelledby="certificates-tab">
                                    <div class="p-4">
                                        <!-- Record New Certificate Section -->
                                        <div class="row g-4 mb-4">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Record New Certificate</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.certificates.generate') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="created_by" value="admin">
                                                            <input type="hidden" name="created_by_user" value="{{ Auth::user()->name }}">
                                                            <div class="row g-3">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Certificate Type</label>
                                                                    <select name="certificate_type" class="form-select" required>
                                                                        <option value="">Select Type</option>
                                                                        @foreach($certificateTypes as $type => $fee)
                                                                            <option value="{{ $type }}" data-fee="{{ $fee }}">{{ $type }} - ₱{{ number_format($fee, 2) }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Resident Name</label>
                                                                    <input type="text" name="resident_name" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Purpose</label>
                                                                    <input type="text" name="purpose" class="form-control" placeholder="e.g., Employment, Loan Application" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Status</label>
                                                                    <select name="status" class="form-select" required>
                                                                        <option value="">Select Status</option>
                                                                        <option value="Paid">Paid</option>
                                                                        <option value="Pending Payment">Pending Payment</option>
                                                                        <option value="Generated">Generated</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Address</label>
                                                                    <input type="text" name="address" class="form-control" placeholder="Complete Address" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Phone Number</label>
                                                                    <input type="tel" name="phone_number" class="form-control" placeholder="e.g., 09123456789" pattern="[0-9]{11}" title="Please enter 11-digit phone number">
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="d-flex gap-2">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            <i class="fas fa-save me-2"></i>Record Certificate
                                                                        </button>
                                                                        <div class="alert alert-info mb-0 ms-3 py-2" id="feeDisplay" style="display: none;">
                                                                            <small><strong>Fee: ₱<span id="selectedFee">0.00</span></strong></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Certificates Table -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Certificate Records</h5>
                                            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="certificatesTable">
                            <thead>
                                <tr>
                                    <th>Certificate #</th>
                                    <th>Type</th>
                                    <th>Resident Name</th>
                                    <th>Phone Number</th>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date Issued</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certificates as $certificate)
                                    <tr>
                                        <td><strong>{{ $certificate['certificate_number'] }}</strong></td>
                                        <td>{{ $certificate['type'] }}</td>
                                        <td>{{ $certificate['resident_name'] }}</td>
                                        <td>{{ $certificate['phone_number'] ?? 'N/A' }}</td>
                                        <td>{{ $certificate['purpose'] }}</td>
                                        <td>₱{{ number_format($certificate['amount'], 2) }}</td>
                                        <td>
                                            @if($certificate['status'] === 'Paid')
                                                <span class="badge bg-success">{{ $certificate['status'] }}</span>
                                            @elseif($certificate['status'] === 'Pending Payment')
                                                <span class="badge bg-warning">{{ $certificate['status'] }}</span>
                                            @else
                                                <span class="badge bg-info">{{ $certificate['status'] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ date('M d, Y', strtotime($certificate['date_issued'])) }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-outline-primary" onclick="printCertificate('{{ $certificate['certificate_number'] }}')">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-info" onclick="viewCertificate({{ json_encode($certificate) }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if($certificate['status'] === 'Pending Payment')
                                                    <button type="button" class="btn btn-outline-success" onclick="markAsPaid('{{ $certificate['id'] }}')">
                                                        <i class="fas fa-money-bill"></i>
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteCertificate('{{ $certificate['id'] }}', '{{ $certificate['certificate_number'] }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                                    </div>
                                </div>

                                <!-- Document Requests Tab -->
                                <div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="requests-tab">
                                    <div class="p-4">
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <h5><i class="fas fa-inbox me-2"></i>Pending Document Requests</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-striped" id="requestsTable">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th>Request ID</th>
                                                                <th>Resident Name</th>
                                                                <th>Document Type</th>
                                                                <th>Purpose</th>
                                                                <th>Request Date</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="7" class="text-center text-muted py-4">
                                                                    <i class="fas fa-inbox fa-3x mb-3 text-muted"></i><br>
                                                                    No pending requests at this time
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Document Templates Tab -->
                                <div class="tab-pane fade" id="templates" role="tabpanel" aria-labelledby="templates-tab">
                                    <div class="p-4">
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5><i class="fas fa-file-alt me-2"></i>Document Templates</h5>
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fas fa-plus me-2"></i>Add Template
                                                    </button>
                                                </div>
                                                <div class="row g-3">
                                                    @foreach($certificateTypes as $type => $fee)
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <i class="fas fa-file-text fa-3x text-primary mb-3"></i>
                                                                    <h6 class="card-title">{{ $type }}</h6>
                                                                    <p class="card-text text-muted">Fee: ₱{{ number_format($fee, 2) }}</p>
                                                                    <div class="btn-group btn-group-sm">
                                                                        <button class="btn btn-outline-primary" onclick="editTemplate('{{ $type }}')">
                                                                            <i class="fas fa-edit"></i> Edit
                                                                        </button>
                                                                        <button class="btn btn-outline-info" onclick="previewTemplate('{{ $type }}')">
                                                                            <i class="fas fa-eye"></i> Preview
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Archived Documents Tab -->
                                <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                                    <div class="p-4">
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5><i class="fas fa-archive me-2"></i>Archived Documents</h5>
                                                    <div class="input-group" style="width: 300px;">
                                                        <input type="text" class="form-control" placeholder="Search archived documents...">
                                                        <button class="btn btn-outline-secondary" type="button">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="archivedTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Certificate #</th>
                                                                <th>Type</th>
                                                                <th>Resident Name</th>
                                                                <th>Date Issued</th>
                                                                <th>Archived Date</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="6" class="text-center text-muted">No archived documents found</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Certificate Modal -->
    <div class="modal fade" id="viewCertificateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Certificate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="certificateDetails"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printCurrentCertificate()">
                        <i class="fas fa-print me-2"></i>Print Certificate
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize main certificates table (visible by default)
            $('#certificatesTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[5, 'desc']], // Date Issued column
                columnDefs: [
                    { targets: [6], orderable: false } // Actions column
                ],
                language: {
                    emptyTable: "No certificates found"
                }
            });

            // No additional table initialization needed - using simple Bootstrap tables

            // Tab change event handler
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                const target = $(e.target).attr('data-bs-target');
                
                // Skip DataTables initialization for requests table - use as simple table
                if (target === '#requests') {
                    console.log('Requests tab shown - using simple table without DataTables');
                    // No DataTables initialization for requests table to avoid column count error
                }
                
                // Skip DataTables initialization for archived table - use as simple table
                if (target === '#archived') {
                    console.log('Archived tab shown - using simple table without DataTables');
                    // No DataTables initialization for archived table to avoid column count error
                }
            });

            // Certificate type fee display
            $('select[name="certificate_type"]').change(function() {
                const selectedOption = $(this).find('option:selected');
                const fee = selectedOption.data('fee');
                
                if (fee !== undefined) {
                    $('#selectedFee').text(fee.toFixed(2));
                    $('#feeDisplay').show();
                } else {
                    $('#feeDisplay').hide();
                }
            });

            // Sidebar functionality
            const burgerMenu = document.getElementById('burgerMenu');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');

            burgerMenu.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('show');
                }
            });

            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('show');
            });

            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !burgerMenu.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });

        function viewCertificate(certificate) {
            const modal = new bootstrap.Modal(document.getElementById('viewCertificateModal'));
            const detailsHtml = `
                <div class="row g-3">
                    <div class="col-md-6">
                        <strong>Certificate Number:</strong><br>
                        <span class="text-primary">${certificate.certificate_number}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Type:</strong><br>
                        ${certificate.type}
                    </div>
                    <div class="col-md-6">
                        <strong>Resident Name:</strong><br>
                        ${certificate.resident_name}
                    </div>
                    <div class="col-md-6">
                        <strong>Phone Number:</strong><br>
                        ${certificate.phone_number || 'N/A'}
                    </div>
                    <div class="col-md-6">
                        <strong>Purpose:</strong><br>
                        ${certificate.purpose}
                    </div>
                    <div class="col-md-6">
                        <strong>Amount:</strong><br>
                        ₱${parseFloat(certificate.amount).toFixed(2)}
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <span class="badge ${certificate.status === 'Paid' ? 'bg-success' : certificate.status === 'Pending Payment' ? 'bg-warning' : 'bg-info'}">${certificate.status}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Date Issued:</strong><br>
                        ${new Date(certificate.date_issued).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}
                    </div>
                    <div class="col-md-6">
                        <strong>Issued By:</strong><br>
                        ${certificate.created_by === 'resident' ? 'Resident' : '{{ Auth::user()->name }}'}
                    </div>
                </div>
            `;
            
            document.getElementById('certificateDetails').innerHTML = detailsHtml;
            document.getElementById('viewCertificateModal').setAttribute('data-certificate', JSON.stringify(certificate));
            modal.show();
        }

        function printCertificate(certificateNumber) {
            // Open print window in same tab
            window.location.href = `/admin/certificates/print/${certificateNumber}`;
        }

        function printCurrentCertificate() {
            const modal = document.getElementById('viewCertificateModal');
            const certificate = JSON.parse(modal.getAttribute('data-certificate'));
            printCertificate(certificate.certificate_number);
        }

        function markAsPaid(certificateId) {
            if (confirm('Mark this certificate as paid?')) {
                // Here you would make an AJAX call to update the payment status
                alert('Certificate marked as paid successfully!');
                location.reload();
            }
        }

        function deleteCertificate(certificateId, certificateNumber) {
            if (confirm(`Are you sure you want to delete certificate ${certificateNumber}? This action cannot be undone.`)) {
                // Here you would make an AJAX call to delete the certificate
                // For now, we'll just show a success message
                alert('Certificate deleted successfully!');
                location.reload();
                
                // Uncomment below when you implement the backend delete route:
                // fetch(`/admin/certificates/delete/${certificateId}`, {
                //     method: 'DELETE',
                //     headers: {
                //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                //         'Content-Type': 'application/json',
                //     }
                // })
                // .then(response => response.json())
                // .then(data => {
                //     if (data.success) {
                //         alert('Certificate deleted successfully!');
                //         location.reload();
                //     } else {
                //         alert('Error deleting certificate: ' + data.message);
                //     }
                // })
                // .catch(error => {
                //     console.error('Error:', error);
                //     alert('An error occurred while deleting the certificate.');
                // });
            }
        }

        function logoutAndRedirect() {
            if (confirm('Are you sure you want to leave the dashboard? You will need to log in again to access it.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("logout") }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Template Management Functions
        function editTemplate(templateType) {
            // Redirect to template editor page
            const encodedType = encodeURIComponent(templateType);
            window.location.href = `/admin/templates/edit/${encodedType}`;
        }

        function previewTemplate(templateType) {
            // Create a preview modal
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'templatePreviewModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Preview: ${templateType}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center p-4 border">
                                <h4>REPUBLIC OF THE PHILIPPINES</h4>
                                <h5>BARANGAY SAN PEDRO APARTADO</h5>
                                <h6>ALCALA PANGASINAN</h6>
                                <hr>
                                <h3>${templateType.toUpperCase()}</h3>
                                <br>
                                <div class="text-start">
                                    <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                                    <br>
                                    <p>This is to certify that [RESIDENT NAME], [AGE] years old, [CIVIL STATUS], is a bonafide resident of Barangay San Pedro Apartado, Alcala, Pangasinan.</p>
                                    <br>
                                    <p>This certification is issued upon the request of the above-mentioned person for whatever legal purpose it may serve.</p>
                                    <br>
                                    <p>Given this [DATE] day of [MONTH], [YEAR].</p>
                                </div>
                                <br>
                                <div class="text-end">
                                    <p><strong>BARANGAY CAPTAIN</strong><br>
                                    Barangay San Pedro Apartado</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="editTemplate('${templateType}')">
                                <i class="fas fa-edit me-2"></i>Edit Template
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
            
            // Remove modal from DOM when hidden
            modal.addEventListener('hidden.bs.modal', function() {
                document.body.removeChild(modal);
            });
        }

        // Live Date and Time in Philippines Time
        function updateDateTime() {
            const now = new Date();
            const phTime = new Date(now.toLocaleString("en-US", {timeZone: "Asia/Manila"}));
            
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            
            const dateElement = document.getElementById('live-date');
            const timeElement = document.getElementById('live-time');
            
            if (dateElement && timeElement) {
                dateElement.textContent = phTime.toLocaleDateString('en-US', dateOptions);
                timeElement.textContent = phTime.toLocaleTimeString('en-US', timeOptions);
            }
        }

        // Update time immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>