<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime / Blotter Records - BM SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            background-color: #f8f9fa;
            color: #212529;
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
            background-color: #f8f9fa;
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

        .stats-card {
            background: var(--ink-700);
            border: 4px solid var(--ink-300);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .stats-card * {
            color: white !important;
        }

        .stats-card .icon-container {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stats-card .main-number {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stats-card .main-label {
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .active-card {
            background: #dc3545 !important;
        }

        .settled-card {
            background: #fd7e14 !important;
        }

        .scheduled-card {
            background: #28a745 !important;
        }

        /* Card glass and button styles */
        .card-glass{ 
            background: #ffffff; 
            border:1px solid #e9ecef; 
            border-radius:16px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
            color: #212529;
        }
        .text-ink-300{ color:#6c757d; }
        .btn-pill{ border-radius:999px; }
        .badge-soft{ background:#e9ecef; border:1px solid #dee2e6; color:#495057; }
        .status-active{ background:#198754; color:#fff; }
        .status-inactive{ background:#dc3545; color:#fff; }
        
        /* Button hover effects */
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .dropdown-menu {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid #dee2e6;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* DataTables light look */
        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate { color:#495057; }
        .dataTables_wrapper .form-select,
        .dataTables_wrapper .dataTables_filter input{
            background:#ffffff; border:1px solid #ced4da; color:#495057;
        }
        table.dataTable.table-dark-lite{ --bs-table-bg: #ffffff; --bs-table-border-color: #dee2e6; color:#495057; }
        table.dataTable.table-dark-lite thead th{ color:#495057; font-weight:700; background-color: #f8f9fa; }
        table.dataTable.table-dark-lite tbody td{ vertical-align: middle; color:#495057; }

        /* Form validation styles */
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .form-select.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* Modal enhancements */
        .modal-header {
            background-color: #f8f9fa;
        }

        .modal-title {
            color: #495057;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        /* View modal text styling */
        .form-control-plaintext {
            color: #212529 !important;
            font-weight: 500;
            background-color: #f8f9fa;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #e9ecef;
            margin-top: 0.25rem;
        }

        .form-label.fw-semibold {
            color: #495057 !important;
            font-weight: 600 !important;
            margin-bottom: 0.25rem;
        }

        /* Status badge in view modal */
        #view_case_status .badge {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        /* Enhanced form styling for add/edit modals */
        .modal-content .form-control,
        .modal-content .form-select {
            background-color: #ffffff;
            border: 2px solid #e9ecef;
            color: #212529;
            font-weight: 500;
            padding: 0.75rem;
            border-radius: 0.5rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .modal-content .form-control:focus,
        .modal-content .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            background-color: #ffffff;
        }

        .modal-content .form-label {
            color: #495057;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .modal-content textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        /* Section headers in modals */
        .modal-content h6.fw-bold {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
            font-size: 1rem;
        }

        .modal-content h6.fw-bold:first-of-type {
            margin-top: 0;
        }

        /* Required field indicator */
        .modal-content .form-label:has(+ .form-control[required])::after,
        .modal-content .form-label:has(+ .form-select[required])::after {
            content: " *";
            color: #dc3545;
            font-weight: bold;
        }

        /* Modal body styling */
        .modal-body {
            background-color: #fbfbfb;
            border-radius: 0.5rem;
        }

        /* Modal footer styling */
        .modal-footer {
            background-color: #f8f9fa;
            border-top: 2px solid #e9ecef;
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
                min-height: 140px;
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="logo-container me-3">
                        <img src="{{ asset('assets/images/logo.png') }}" class="sidebar-logo" alt="BM System Logo">
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
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <div class="fw-semibold text-white">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="small text-light">
                        @if(Auth::check())
                            @if(Auth::user()->role === 'captain')
                                Barangay Captain
                            @elseif(Auth::user()->role === 'staff')
                                Admin Staff
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
            <a href="#" class="nav-link">
                <i class="fas fa-certificate me-3"></i> Barangay Certificates
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-hand-holding-usd me-3"></i> Certificate of Indigency
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-briefcase me-3"></i> Brgy Business Clearance
            </a>
            <a href="{{ route('admin.blotter') }}" class="nav-link active">
                <i class="fas fa-gavel me-3"></i> Crime / Blotter Records
            </a>
            <a href="{{ route('admin.documents') }}" class="nav-link">
                <i class="fas fa-folder-open me-3"></i> Requested Documents
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-house-user me-3"></i> Purok & Household Record
            </a>
            <a href="{{ route('admin.medicine') }}" class="nav-link">
                <i class="fas fa-pills me-3"></i> Medicine Inventory
            </a>
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
                <h1 class="h3 mb-0 text-white">BLOTTER AND CRIME MANAGEMENT</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-4">
            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stats-card active-card">
                        <div class="icon-container">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="main-number">{{ $stats['active_count'] }}</div>
                        <div class="main-label">ACTIVE</div>
                        <small>Active Case</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card settled-card">
                        <div class="icon-container">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="main-number">{{ $stats['settled_count'] }}</div>
                        <div class="main-label">SETTLED</div>
                        <small>Settled Case</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card scheduled-card">
                        <div class="icon-container">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="main-number">{{ $stats['scheduled_count'] }}</div>
                        <div class="main-label">SCHEDULED</div>
                        <small>Scheduled Case</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="main-number">{{ $stats['total_count'] }}</div>
                        <div class="main-label">TOTAL</div>
                        <small>Total Cases</small>
                    </div>
                </div>
            </div>

            {{-- All Blotter Records Table --}}
            <div class="card-glass p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 fw-bold">Blotter and Crime Records</h5>
                    <button class="btn btn-primary fw-bold btn-pill" data-bs-toggle="modal" data-bs-target="#blotterModal">
                        <i class="fas fa-plus-circle me-1"></i> Add Record
                    </button>
                </div>

                {{-- Status Filter --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="statusFilter" class="form-label">Filter by Status:</label>
                        <select id="statusFilter" class="form-select">
                            <option value="">All Records</option>
                            <option value="Active">Active Cases</option>
                            <option value="Settled">Settled Cases</option>
                            <option value="Scheduled">Scheduled Cases</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="blotterTable" class="table table-dark-lite table-striped w-100">
                        <thead>
                            <tr>
                                <th>Complainant</th>
                                <th>Respondent</th>
                                <th>Victim(s)</th>
                                <th>Blotter / Crime</th>
                                <th>Status</th>
                                <th>Date Reported</th>
                                <th style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blotterData['active'] as $case)
                            <tr>
                                <td>{{ $case['complainant'] }}</td>
                                <td>{{ $case['respondent'] }}</td>
                                <td>{{ $case['victims'] }}</td>
                                <td>{{ $case['blotter_crime'] }}</td>
                                <td><span class="badge bg-danger px-2 py-1">{{ $case['status'] }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($case['date_reported'])->format('M d, Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item view-record" href="#" 
                                                data-id="{{ $case['id'] }}"
                                                data-complainant="{{ $case['complainant'] }}"
                                                data-respondent="{{ $case['respondent'] }}"
                                                data-victims="{{ $case['victims'] }}"
                                                data-crime="{{ $case['blotter_crime'] }}"
                                                data-status="{{ $case['status'] }}"
                                                data-date="{{ $case['date_reported'] }}"
                                                data-action="{{ $case['action'] }}">
                                                <i class="fas fa-eye me-2"></i>View</a></li>
                                            <li><a class="dropdown-item edit-record" href="#"
                                                data-id="{{ $case['id'] }}"
                                                data-complainant="{{ $case['complainant'] }}"
                                                data-respondent="{{ $case['respondent'] }}"
                                                data-victims="{{ $case['victims'] }}"
                                                data-crime="{{ $case['blotter_crime'] }}"
                                                data-status="{{ $case['status'] }}"
                                                data-date="{{ $case['date_reported'] }}"
                                                data-action="{{ $case['action'] }}">
                                                <i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i>Mark as Settled</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($blotterData['settled'] as $case)
                            <tr>
                                <td>{{ $case['complainant'] }}</td>
                                <td>{{ $case['respondent'] }}</td>
                                <td>{{ $case['victims'] }}</td>
                                <td>{{ $case['blotter_crime'] }}</td>
                                <td><span class="badge bg-warning px-2 py-1">{{ $case['status'] }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($case['date_reported'])->format('M d, Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item view-record" href="#" 
                                                data-id="{{ $case['id'] }}"
                                                data-complainant="{{ $case['complainant'] }}"
                                                data-respondent="{{ $case['respondent'] }}"
                                                data-victims="{{ $case['victims'] }}"
                                                data-crime="{{ $case['blotter_crime'] }}"
                                                data-status="{{ $case['status'] }}"
                                                data-date="{{ $case['date_reported'] }}"
                                                data-action="{{ $case['action'] }}">
                                                <i class="fas fa-eye me-2"></i>View</a></li>
                                            <li><a class="dropdown-item edit-record" href="#"
                                                data-id="{{ $case['id'] }}"
                                                data-complainant="{{ $case['complainant'] }}"
                                                data-respondent="{{ $case['respondent'] }}"
                                                data-victims="{{ $case['victims'] }}"
                                                data-crime="{{ $case['blotter_crime'] }}"
                                                data-status="{{ $case['status'] }}"
                                                data-date="{{ $case['date_reported'] }}"
                                                data-action="{{ $case['action'] }}">
                                                <i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-undo me-2"></i>Reopen Case</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($blotterData['scheduled'] as $case)
                            <tr>
                                <td>{{ $case['complainant'] }}</td>
                                <td>{{ $case['respondent'] }}</td>
                                <td>{{ $case['victims'] }}</td>
                                <td>{{ $case['blotter_crime'] }}</td>
                                <td><span class="badge bg-success px-2 py-1">{{ $case['status'] }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($case['date_reported'])->format('M d, Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item view-record" href="#" 
                                                data-id="{{ $case['id'] }}"
                                                data-complainant="{{ $case['complainant'] }}"
                                                data-respondent="{{ $case['respondent'] }}"
                                                data-victims="{{ $case['victims'] }}"
                                                data-crime="{{ $case['blotter_crime'] }}"
                                                data-status="{{ $case['status'] }}"
                                                data-date="{{ $case['date_reported'] }}"
                                                data-action="{{ $case['action'] }}">
                                                <i class="fas fa-eye me-2"></i>View</a></li>
                                            <li><a class="dropdown-item edit-record" href="#"
                                                data-id="{{ $case['id'] }}"
                                                data-complainant="{{ $case['complainant'] }}"
                                                data-respondent="{{ $case['respondent'] }}"
                                                data-victims="{{ $case['victims'] }}"
                                                data-crime="{{ $case['blotter_crime'] }}"
                                                data-status="{{ $case['status'] }}"
                                                data-date="{{ $case['date_reported'] }}"
                                                data-action="{{ $case['action'] }}">
                                                <i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-calendar me-2"></i>Reschedule</a></li>
                                        </ul>
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

    {{-- View Blotter Record Modal --}}
    <div class="modal fade" id="viewBlotterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background:#ffffff;color:#212529;border:1px solid #dee2e6">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">View Blotter Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        {{-- Complainant Information --}}
                        <div class="col-12">
                            <h6 class="fw-bold text-primary border-bottom pb-2">Complainant Information</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Complainant Name:</label>
                            <p class="form-control-plaintext" id="view_complainant_name">-</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Contact Number:</label>
                            <p class="form-control-plaintext" id="view_complainant_contact">-</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Address:</label>
                            <p class="form-control-plaintext" id="view_complainant_address">-</p>
                        </div>

                        {{-- Respondent Information --}}
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2">Respondent Information</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Respondent Name:</label>
                            <p class="form-control-plaintext" id="view_respondent_name">-</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Contact Number:</label>
                            <p class="form-control-plaintext" id="view_respondent_contact">-</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Address:</label>
                            <p class="form-control-plaintext" id="view_respondent_address">-</p>
                        </div>

                        {{-- Incident Information --}}
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2">Incident Information</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Victim(s):</label>
                            <p class="form-control-plaintext" id="view_victims">-</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type of Crime/Blotter:</label>
                            <p class="form-control-plaintext" id="view_crime_type">-</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date of Incident:</label>
                            <p class="form-control-plaintext" id="view_incident_date">-</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Time of Incident:</label>
                            <p class="form-control-plaintext" id="view_incident_time">-</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Location of Incident:</label>
                            <p class="form-control-plaintext" id="view_incident_location">-</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description of Incident:</label>
                            <p class="form-control-plaintext" id="view_incident_description">-</p>
                        </div>

                        {{-- Case Status --}}
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2">Case Information</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Case Status:</label>
                            <p class="form-control-plaintext" id="view_case_status">-</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date Reported:</label>
                            <p class="form-control-plaintext" id="view_date_reported">-</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Action Taken/Remarks:</label>
                            <p class="form-control-plaintext" id="view_action_taken">-</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editFromView">Edit Record</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Blotter Record Modal --}}
    <div class="modal fade" id="editBlotterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background:#ffffff;color:#212529;border:1px solid #dee2e6">
                <form id="editBlotterForm">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">Edit Blotter Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_record_id">
                        <div class="row g-3">
                            {{-- Complainant Information --}}
                            <div class="col-12">
                                <h6 class="fw-bold text-primary">Complainant Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_complainant_name" class="form-label">Complainant Name *</label>
                                <input type="text" class="form-control" id="edit_complainant_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_complainant_contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="edit_complainant_contact">
                            </div>
                            <div class="col-12">
                                <label for="edit_complainant_address" class="form-label">Address</label>
                                <textarea class="form-control" id="edit_complainant_address" rows="2"></textarea>
                            </div>

                            {{-- Respondent Information --}}
                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-primary">Respondent Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_respondent_name" class="form-label">Respondent Name *</label>
                                <input type="text" class="form-control" id="edit_respondent_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_respondent_contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="edit_respondent_contact">
                            </div>
                            <div class="col-12">
                                <label for="edit_respondent_address" class="form-label">Address</label>
                                <textarea class="form-control" id="edit_respondent_address" rows="2"></textarea>
                            </div>

                            {{-- Incident Information --}}
                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-primary">Incident Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_victims" class="form-label">Victim(s) *</label>
                                <input type="text" class="form-control" id="edit_victims" required placeholder="Names of victims">
                            </div>
                            <div class="col-md-6">
                                <label for="edit_crime_type" class="form-label">Type of Crime/Blotter *</label>
                                <select class="form-select" id="edit_crime_type" required>
                                    <option value="">Select Crime Type</option>
                                    <option value="Theft">Theft</option>
                                    <option value="Assault">Assault</option>
                                    <option value="Harassment">Harassment</option>
                                    <option value="Vandalism">Vandalism</option>
                                    <option value="Property Dispute">Property Dispute</option>
                                    <option value="Noise Complaint">Noise Complaint</option>
                                    <option value="Public Disturbance">Public Disturbance</option>
                                    <option value="Verbal Threat">Verbal Threat</option>
                                    <option value="Trespassing">Trespassing</option>
                                    <option value="Shoplifting">Shoplifting</option>
                                    <option value="Fraud">Fraud</option>
                                    <option value="Domestic Violence">Domestic Violence</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_incident_date" class="form-label">Date of Incident *</label>
                                <input type="date" class="form-control" id="edit_incident_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_incident_time" class="form-label">Time of Incident</label>
                                <input type="time" class="form-control" id="edit_incident_time">
                            </div>
                            <div class="col-12">
                                <label for="edit_incident_location" class="form-label">Location of Incident *</label>
                                <input type="text" class="form-control" id="edit_incident_location" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_incident_description" class="form-label">Description of Incident *</label>
                                <textarea class="form-control" id="edit_incident_description" rows="4" required placeholder="Detailed description of what happened"></textarea>
                            </div>

                            {{-- Case Status --}}
                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-primary">Case Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_case_status" class="form-label">Case Status *</label>
                                <select class="form-select" id="edit_case_status" required>
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Settled">Settled</option>
                                    <option value="Scheduled">Scheduled</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_date_reported" class="form-label">Date Reported *</label>
                                <input type="date" class="form-control" id="edit_date_reported" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_action_taken" class="form-label">Action Taken/Remarks</label>
                                <textarea class="form-control" id="edit_action_taken" rows="3" placeholder="Actions taken or scheduled actions"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add/Edit Blotter Record Modal --}}
    <div class="modal fade" id="blotterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background:#ffffff;color:#212529;border:1px solid #dee2e6">
                <form id="blotterForm">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="blotterModalTitle">Add Blotter Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            {{-- Complainant Information --}}
                            <div class="col-12">
                                <h6 class="fw-bold text-primary">Complainant Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="complainant_name" class="form-label">Complainant Name *</label>
                                <input type="text" class="form-control" id="complainant_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="complainant_contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="complainant_contact">
                            </div>
                            <div class="col-12">
                                <label for="complainant_address" class="form-label">Address</label>
                                <textarea class="form-control" id="complainant_address" rows="2"></textarea>
                            </div>

                            {{-- Respondent Information --}}
                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-primary">Respondent Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="respondent_name" class="form-label">Respondent Name *</label>
                                <input type="text" class="form-control" id="respondent_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="respondent_contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="respondent_contact">
                            </div>
                            <div class="col-12">
                                <label for="respondent_address" class="form-label">Address</label>
                                <textarea class="form-control" id="respondent_address" rows="2"></textarea>
                            </div>

                            {{-- Incident Information --}}
                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-primary">Incident Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="victims" class="form-label">Victim(s) *</label>
                                <input type="text" class="form-control" id="victims" required placeholder="Names of victims">
                            </div>
                            <div class="col-md-6">
                                <label for="crime_type" class="form-label">Type of Crime/Blotter *</label>
                                <select class="form-select" id="crime_type" required>
                                    <option value="">Select Crime Type</option>
                                    <option value="Theft">Theft</option>
                                    <option value="Assault">Assault</option>
                                    <option value="Harassment">Harassment</option>
                                    <option value="Vandalism">Vandalism</option>
                                    <option value="Property Dispute">Property Dispute</option>
                                    <option value="Noise Complaint">Noise Complaint</option>
                                    <option value="Public Disturbance">Public Disturbance</option>
                                    <option value="Verbal Threat">Verbal Threat</option>
                                    <option value="Trespassing">Trespassing</option>
                                    <option value="Shoplifting">Shoplifting</option>
                                    <option value="Fraud">Fraud</option>
                                    <option value="Domestic Violence">Domestic Violence</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="incident_date" class="form-label">Date of Incident *</label>
                                <input type="date" class="form-control" id="incident_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="incident_time" class="form-label">Time of Incident</label>
                                <input type="time" class="form-control" id="incident_time">
                            </div>
                            <div class="col-12">
                                <label for="incident_location" class="form-label">Location of Incident *</label>
                                <input type="text" class="form-control" id="incident_location" required>
                            </div>
                            <div class="col-12">
                                <label for="incident_description" class="form-label">Description of Incident *</label>
                                <textarea class="form-control" id="incident_description" rows="4" required placeholder="Detailed description of what happened"></textarea>
                            </div>

                            {{-- Case Status --}}
                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-primary">Case Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label for="case_status" class="form-label">Case Status *</label>
                                <select class="form-select" id="case_status" required>
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Settled">Settled</option>
                                    <option value="Scheduled">Scheduled</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="date_reported" class="form-label">Date Reported *</label>
                                <input type="date" class="form-control" id="date_reported" required>
                            </div>
                            <div class="col-12">
                                <label for="action_taken" class="form-label">Action Taken/Remarks</label>
                                <textarea class="form-control" id="action_taken" rows="3" placeholder="Actions taken or scheduled actions"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerMenu = document.getElementById('burgerMenu');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const mainContent = document.getElementById('mainContent');

            // Initialize DataTable
            const table = $('#blotterTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[5, 'desc']], // Sort by date reported (column 5) descending
                columnDefs: [
                    { orderable: false, targets: [6] } // Disable sorting on Action column
                ]
            });

            // Status Filter Functionality
            $('#statusFilter').on('change', function() {
                const selectedStatus = this.value;
                if (selectedStatus === '') {
                    table.column(4).search('').draw(); // Clear filter, show all
                } else {
                    table.column(4).search(selectedStatus).draw(); // Filter by status
                }
            });

            // Set today's date as default for date reported
            document.getElementById('date_reported').valueAsDate = new Date();

            // Handle View Record buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.view-record')) {
                    e.preventDefault();
                    const link = e.target.closest('.view-record');
                    
                    // Populate view modal with data
                    document.getElementById('view_complainant_name').textContent = link.dataset.complainant || '-';
                    document.getElementById('view_complainant_contact').textContent = '-'; // Not in current data
                    document.getElementById('view_complainant_address').textContent = '-'; // Not in current data
                    document.getElementById('view_respondent_name').textContent = link.dataset.respondent || '-';
                    document.getElementById('view_respondent_contact').textContent = '-'; // Not in current data
                    document.getElementById('view_respondent_address').textContent = '-'; // Not in current data
                    document.getElementById('view_victims').textContent = link.dataset.victims || '-';
                    document.getElementById('view_crime_type').textContent = link.dataset.crime || '-';
                    document.getElementById('view_incident_date').textContent = '-'; // Not in current data
                    document.getElementById('view_incident_time').textContent = '-'; // Not in current data
                    document.getElementById('view_incident_location').textContent = '-'; // Not in current data
                    document.getElementById('view_incident_description').textContent = '-'; // Not in current data
                    document.getElementById('view_case_status').innerHTML = `<span class="badge bg-${getStatusBadgeClass(link.dataset.status)} px-2 py-1">${link.dataset.status}</span>`;
                    document.getElementById('view_date_reported').textContent = formatDate(link.dataset.date) || '-';
                    document.getElementById('view_action_taken').textContent = link.dataset.action || '-';
                    
                    // Store the record ID for edit button
                    document.getElementById('editFromView').dataset.recordData = JSON.stringify({
                        id: link.dataset.id,
                        complainant: link.dataset.complainant,
                        respondent: link.dataset.respondent,
                        victims: link.dataset.victims,
                        crime: link.dataset.crime,
                        status: link.dataset.status,
                        date: link.dataset.date,
                        action: link.dataset.action
                    });
                    
                    // Show view modal
                    new bootstrap.Modal(document.getElementById('viewBlotterModal')).show();
                }
                
                if (e.target.closest('.edit-record')) {
                    e.preventDefault();
                    const link = e.target.closest('.edit-record');
                    showEditModal(link);
                }
            });

            // Handle Edit from View button
            document.getElementById('editFromView').addEventListener('click', function() {
                const recordData = JSON.parse(this.dataset.recordData);
                bootstrap.Modal.getInstance(document.getElementById('viewBlotterModal')).hide();
                
                // Create a mock link element with the data
                const mockLink = {
                    dataset: {
                        id: recordData.id,
                        complainant: recordData.complainant,
                        respondent: recordData.respondent,
                        victims: recordData.victims,
                        crime: recordData.crime,
                        status: recordData.status,
                        date: recordData.date,
                        action: recordData.action
                    }
                };
                
                setTimeout(() => showEditModal(mockLink), 300); // Small delay for modal transition
            });

            // Function to show edit modal
            function showEditModal(link) {
                // Populate edit modal with data
                document.getElementById('edit_record_id').value = link.dataset.id || '';
                document.getElementById('edit_complainant_name').value = link.dataset.complainant || '';
                document.getElementById('edit_complainant_contact').value = ''; // Not in current data
                document.getElementById('edit_complainant_address').value = ''; // Not in current data
                document.getElementById('edit_respondent_name').value = link.dataset.respondent || '';
                document.getElementById('edit_respondent_contact').value = ''; // Not in current data
                document.getElementById('edit_respondent_address').value = ''; // Not in current data
                document.getElementById('edit_victims').value = link.dataset.victims || '';
                document.getElementById('edit_crime_type').value = link.dataset.crime || '';
                document.getElementById('edit_incident_date').value = ''; // Not in current data
                document.getElementById('edit_incident_time').value = ''; // Not in current data
                document.getElementById('edit_incident_location').value = ''; // Not in current data
                document.getElementById('edit_incident_description').value = ''; // Not in current data
                document.getElementById('edit_case_status').value = link.dataset.status || '';
                document.getElementById('edit_date_reported').value = link.dataset.date || '';
                document.getElementById('edit_action_taken').value = link.dataset.action || '';
                
                // Show edit modal
                new bootstrap.Modal(document.getElementById('editBlotterModal')).show();
            }

            // Helper functions
            function getStatusBadgeClass(status) {
                switch(status) {
                    case 'Active': return 'danger';
                    case 'Settled': return 'warning';
                    case 'Scheduled': return 'success';
                    default: return 'secondary';
                }
            }

            function formatDate(dateString) {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
            }

            // Handle Edit Form Submission
            document.getElementById('editBlotterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = {
                    id: document.getElementById('edit_record_id').value,
                    complainant_name: document.getElementById('edit_complainant_name').value,
                    complainant_contact: document.getElementById('edit_complainant_contact').value,
                    complainant_address: document.getElementById('edit_complainant_address').value,
                    respondent_name: document.getElementById('edit_respondent_name').value,
                    respondent_contact: document.getElementById('edit_respondent_contact').value,
                    respondent_address: document.getElementById('edit_respondent_address').value,
                    victims: document.getElementById('edit_victims').value,
                    crime_type: document.getElementById('edit_crime_type').value,
                    incident_date: document.getElementById('edit_incident_date').value,
                    incident_time: document.getElementById('edit_incident_time').value,
                    incident_location: document.getElementById('edit_incident_location').value,
                    incident_description: document.getElementById('edit_incident_description').value,
                    case_status: document.getElementById('edit_case_status').value,
                    date_reported: document.getElementById('edit_date_reported').value,
                    action_taken: document.getElementById('edit_action_taken').value
                };

                // Validate required fields
                const requiredFields = ['edit_complainant_name', 'edit_respondent_name', 'edit_victims', 'edit_crime_type', 'edit_incident_date', 'edit_incident_location', 'edit_incident_description', 'edit_case_status', 'edit_date_reported'];
                let isValid = true;
                
                requiredFields.forEach(field => {
                    const element = document.getElementById(field);
                    if (!element.value.trim()) {
                        element.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        element.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill in all required fields.');
                    return;
                }

                // Here you would normally send the data to your backend
                // For now, we'll just show a success message and close the modal
                alert('Blotter record updated successfully!');
                
                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('editBlotterModal')).hide();

                // In a real application, you would refresh the table data here
                // table.ajax.reload();
            });

            // Clear validation errors when edit modal is closed
            document.getElementById('editBlotterModal').addEventListener('hidden.bs.modal', function() {
                const form = document.getElementById('editBlotterForm');
                form.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
            });

            // Handle Add Record Form Submission
            document.getElementById('blotterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = {
                    complainant_name: document.getElementById('complainant_name').value,
                    complainant_contact: document.getElementById('complainant_contact').value,
                    complainant_address: document.getElementById('complainant_address').value,
                    respondent_name: document.getElementById('respondent_name').value,
                    respondent_contact: document.getElementById('respondent_contact').value,
                    respondent_address: document.getElementById('respondent_address').value,
                    victims: document.getElementById('victims').value,
                    crime_type: document.getElementById('crime_type').value,
                    incident_date: document.getElementById('incident_date').value,
                    incident_time: document.getElementById('incident_time').value,
                    incident_location: document.getElementById('incident_location').value,
                    incident_description: document.getElementById('incident_description').value,
                    case_status: document.getElementById('case_status').value,
                    date_reported: document.getElementById('date_reported').value,
                    action_taken: document.getElementById('action_taken').value
                };

                // Validate required fields
                const requiredFields = ['complainant_name', 'respondent_name', 'victims', 'crime_type', 'incident_date', 'incident_location', 'incident_description', 'case_status', 'date_reported'];
                let isValid = true;
                
                requiredFields.forEach(field => {
                    const element = document.getElementById(field);
                    if (!element.value.trim()) {
                        element.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        element.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill in all required fields.');
                    return;
                }

                // Here you would normally send the data to your backend
                // For now, we'll just show a success message and close the modal
                alert('Blotter record added successfully!');
                
                // Reset form and close modal
                this.reset();
                document.getElementById('date_reported').valueAsDate = new Date();
                bootstrap.Modal.getInstance(document.getElementById('blotterModal')).hide();

                // In a real application, you would refresh the table data here
                // table.ajax.reload();
            });

            // Clear validation errors when modal is closed
            document.getElementById('blotterModal').addEventListener('hidden.bs.modal', function() {
                const form = document.getElementById('blotterForm');
                form.reset();
                form.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                document.getElementById('date_reported').valueAsDate = new Date();
            });

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

        // Logout and redirect function
        function logoutAndRedirect() {
            if (confirm('Are you sure you want to leave the dashboard? You will need to log in again to access it.')) {
                // Create a form to submit logout request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("logout") }}';
                
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