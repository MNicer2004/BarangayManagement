<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Barangay Officials - BM SYSTEM</title>
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

        /* Officials page specific styles */
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

        /* Enhanced Modal Styling */
        #officialModal .form-control,
        #officialModal .form-select {
            color: #212529 !important;
            background: #ffffff !important;
            border: 2px solid #e9ecef !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        #officialModal .form-control:focus,
        #officialModal .form-select:focus {
            border-color: var(--ink-700) !important;
            box-shadow: 0 0 0 0.25rem rgba(26, 61, 99, 0.15) !important;
            background: #ffffff !important;
            color: #212529 !important;
            transform: translateY(-1px);
        }

        #officialModal .form-control:hover,
        #officialModal .form-select:hover {
            border-color: var(--ink-500) !important;
            background: #ffffff !important;
            color: #212529 !important;
            transform: translateY(-1px);
        }

        #officialModal .form-control::placeholder {
            color: #6c757d !important;
            opacity: 0.7;
        }

        #officialModal .form-select option {
            color: #212529 !important;
            background: #ffffff !important;
        }

        #officialModal .btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }

        #officialModal .btn-outline-secondary:hover {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: #ffffff !important;
        }

        #officialModal .form-label {
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem !important;
            color: var(--ink-900) !important;
        }

        #officialModal .modal-content {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Action Button Styles */
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 6px;
            border: none;
            transition: all 0.2s ease-in-out;
            color: white;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529 !important;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            color: #212529 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .d-flex.gap-2 {
            gap: 0.5rem !important;
        }

        /* Action buttons styling - simplified and direct */
        .btn.btn-sm {
            min-width: 36px !important;
            height: 36px !important;
            padding: 8px 12px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 6px !important;
            font-size: 0.875rem !important;
            line-height: 1 !important;
            margin: 2px !important;
        }

        .btn.btn-sm i {
            font-size: 14px !important;
            display: inline-block !important;
            width: auto !important;
            height: auto !important;
        }

        /* Ensure FontAwesome icons are visible */
        .fas {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
            display: inline-block !important;
        }

        /* Action column specific styles */
        td .d-flex.gap-2 {
            display: flex !important;
            gap: 0.5rem !important;
            justify-content: center !important;
            align-items: center !important;
            min-height: 40px !important;
        }

        /* Remove all outline button overrides - let Bootstrap handle it */
        
        /* Force outline button styles - override everything */
        .btn-outline-info,
        .btn-outline-info:not(:disabled):not(.disabled) {
            color: #0dcaf0 !important;
            border: 2px solid #0dcaf0 !important;
            background-color: transparent !important;
            background-image: none !important;
            transition: all 0.3s ease !important;
        }
        
        .btn-outline-warning,
        .btn-outline-warning:not(:disabled):not(.disabled) {
            color: #ffc107 !important;
            border: 2px solid #ffc107 !important;
            background-color: transparent !important;
            background-image: none !important;
            transition: all 0.3s ease !important;
        }
        
        .btn-outline-danger,
        .btn-outline-danger:not(:disabled):not(.disabled) {
            color: #dc3545 !important;
            border: 2px solid #dc3545 !important;
            background-color: transparent !important;
            background-image: none !important;
            transition: all 0.3s ease !important;
        }

        .btn-outline-info:hover {
            background-color: #0dcaf0 !important;
            color: white !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(13, 202, 240, 0.4) !important;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107 !important;
            color: black !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4) !important;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545 !important;
            color: white !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4) !important;
        }

        /* Fix table styling - remove dark background - FORCE WHITE */
        #officialsTable,
        #officialsTable.table-dark-lite,
        .table-dark-lite {
            background-color: #ffffff !important;
            color: #212529 !important;
        }

        #officialsTable thead th,
        .table-dark-lite thead th {
            background-color: #f8f9fa !important;
            color: #495057 !important;
            border-bottom: 2px solid #dee2e6 !important;
            font-weight: 700 !important;
        }

        #officialsTable tbody tr,
        .table-dark-lite tbody tr {
            background-color: #ffffff !important;
            color: #212529 !important;
        }

        #officialsTable tbody tr:nth-of-type(odd),
        .table-dark-lite tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa !important;
            color: #212529 !important;
        }

        #officialsTable tbody td,
        .table-dark-lite tbody td {
            border-top: 1px solid #dee2e6 !important;
            color: #212529 !important;
            background-color: inherit !important;
        }

        /* Force text to be visible */
        #officialsTable td,
        #officialsTable th,
        .table-dark-lite td,
        .table-dark-lite th {
            color: #212529 !important;
        }

        /* Override any dark theme styles completely */
        .table-dark,
        .table-dark th,
        .table-dark td,
        .table-dark thead th {
            color: #212529 !important;
            background-color: #ffffff !important;
            border-color: #dee2e6 !important;
        }

        /* Additional table fixes */
        table.dataTable.table-dark-lite tbody tr {
            background-color: #ffffff !important;
        }

        table.dataTable.table-dark-lite tbody tr:hover {
            background-color: #f5f5f5 !important;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Header -->
        <div class="top-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="burger-menu me-3" id="burgerMenu" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h3 mb-0 text-white">BARANGAY OFFICIALS</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Officials Content -->
        <div class="p-4">
            {{-- Barangay summary card --}}
            <div class="card-glass p-3 p-md-4 mb-4">
                <div class="d-flex gap-3 align-items-center">
                    <div class="rounded-circle d-inline-grid place-items-center" style="width:92px;height:92px;background:#1A3D63;border:1px solid rgba(255,255,255,.25)"></div>
                    <div class="flex-grow-1">
                        <div class="text-ink-300 small">Barangay</div>
                        <h2 class="h4 fw-bold mb-1">San Pedro Apartado</h2>
                        <div class="text-ink-300">San Pedro Apartado, Alcala, Pangasinan</div>
                    </div>
                </div>
            </div>

            {{-- Table card --}}
            <div class="card-glass p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 fw-bold">Current Barangay Officials</h5>
                    <button class="btn btn-primary fw-bold btn-pill" data-bs-toggle="modal" data-bs-target="#officialModal">
                        <i class="bi bi-plus-circle me-1"></i> Add Official
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="officialsTable" class="table table-dark-lite table-striped w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Position</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Purok</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($officials as $official)
                                <tr>
                                    <td>{{ $official->name }}</td>
                                    <td>{{ $official->position }}</td>
                                    <td>{{ $official->age }}</td>
                                    <td>{{ $official->gender }}</td>
                                    <td>{{ $official->purok }}</td>
                                    <td>{{ $official->contact_number ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $official->status === 'Active' ? 'status-active' : 'status-inactive' }}">
                                            {{ $official->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button class="btn btn-sm btn-outline-info action-btn" data-action="view" data-id="{{ $official->id }}" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning action-btn" data-action="edit" data-id="{{ $official->id }}" title="Edit Official">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger action-btn" data-action="delete" data-id="{{ $official->id }}" title="Delete Official">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No officials found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Add/Edit Official Modal --}}
    <!-- Enhanced Add/Edit Official Modal -->
    <div class="modal fade" id="officialModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <form id="officialForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST" id="formMethod">
                    <input type="hidden" name="official_id" id="officialId">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                        <h5 class="modal-title fw-bold d-flex align-items-center" id="officialModalTitle" style="font-size: 1.4rem; margin: 0;">
                            <i class="fas fa-user-tie me-3" style="font-size: 1.3rem;"></i>
                            Add Official
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1rem;"></button>
                    </div>
                    <div class="modal-body" style="padding: 35px 30px; background: #ffffff;">
                        <input type="hidden" id="rowIndex">

                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-user me-2" style="color: var(--ink-700);"></i>FULL NAME
                                </label>
                                <input type="text" class="form-control" name="name" id="fullName" placeholder="Juan Dela Cruz" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-id-card me-2" style="color: var(--ink-700);"></i>NATIONAL ID
                                </label>
                                <input type="text" class="form-control" name="national_id" id="nationalId" placeholder="0000001213213" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt me-2" style="color: var(--ink-700);"></i>AGE
                                </label>
                                <input type="number" class="form-control" name="age" id="age" placeholder="25" min="18" max="100" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-birthday-cake me-2" style="color: var(--ink-700);"></i>BIRTHDAY
                                </label>
                                <input type="date" class="form-control" name="birthday" id="birthday" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-heart me-2" style="color: var(--ink-700);"></i>CIVIL STATUS
                                </label>
                                <select name="civil_status" id="civilStatus" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-venus-mars me-2" style="color: var(--ink-700);"></i>GENDER
                                </label>
                                <select name="gender" id="gender" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-map-marker-alt me-2" style="color: var(--ink-700);"></i>PUROK
                                </label>
                                <select name="purok" id="purok" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select purok</option>
                                    <option value="Purok 1">Purok 1</option>
                                    <option value="Purok 2">Purok 2</option>
                                    <option value="Purok 3">Purok 3</option>
                                    <option value="Purok 4">Purok 4</option>
                                    <option value="Purok 5">Purok 5</option>
                                    <option value="Purok 6">Purok 6</option>
                                    <option value="Purok 7">Purok 7</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-building me-2" style="color: var(--ink-700);"></i>PRECINCT
                                </label>
                                <select name="precinct_id" id="precinctId" class="form-select" 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="">Select precinct (optional)</option>
                                    @foreach($precincts as $precinct)
                                        <option value="{{ $precinct->id }}">{{ $precinct->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-pray me-2" style="color: var(--ink-700);"></i>RELIGION
                                </label>
                                <input type="text" class="form-control" name="religion" id="religion" placeholder="Roman Catholic" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-briefcase me-2" style="color: var(--ink-700);"></i>OCCUPATION
                                </label>
                                <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Farmer" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-crown me-2" style="color: var(--ink-700);"></i>POSITION
                                </label>
                                <select name="position" id="position" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select position</option>
                                    <option>Captain</option>
                                    <option>Secretary</option>
                                    <option>Treasurer</option>
                                    <option>Kagawad 1</option>
                                    <option>Kagawad 2</option>
                                    <option>Kagawad 3</option>
                                    <option>Kagawad 4</option>
                                    <option>Kagawad 5</option>
                                    <option>Kagawad 6</option>
                                    <option>SK Chairman</option>
                                    <option>SK Kagawad</option>
                                    <option>Tanod 1</option>
                                    <option>Tanod 2</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-hand-holding-heart me-2" style="color: var(--ink-700);"></i>4PS BENEFICIARY
                                </label>
                                <select name="four_ps_beneficiary" id="fourPsBeneficiary" class="form-select" 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-wheelchair me-2" style="color: var(--ink-700);"></i>PWD STATUS
                                </label>
                                <select name="pwd_status" id="pwdStatus" class="form-select" 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-vote-yea me-2" style="color: var(--ink-700);"></i>VOTER STATUS
                                </label>
                                <select name="voter_status" id="voterStatus" class="form-select" 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-phone me-2" style="color: var(--ink-700);"></i>CONTACT NUMBER
                                </label>
                                <input type="text" class="form-control" name="contact_number" id="contact" placeholder="09XXXXXXXXX" 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-clipboard-list me-2" style="color: var(--ink-700);"></i>Chairmanship
                                </label>
                                <input type="text" class="form-control" name="chairmanship" id="chairmanship" placeholder="Committee on Education" 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-toggle-on me-2" style="color: var(--ink-700);"></i>Status
                                </label>
                                <select name="status" id="status" class="form-select" 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="Active" selected>Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-envelope me-2" style="color: var(--ink-700);"></i>Email
                                </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@email.com" 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="background: #f8f9fc; border: none; border-radius: 0 0 20px 20px; padding: 25px 30px;">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal" 
                                style="border-radius: 12px; padding: 12px 24px; font-weight: 600; border: 2px solid #6c757d; transition: all 0.3s ease;">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary fw-bold" 
                                style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); border: none; border-radius: 12px; padding: 12px 24px; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-save me-2"></i>Save Official
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
    
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

        // Initialize DataTable
        $('#officialsTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [7] }
            ],
            scrollX: true,
            responsive: true
        });

        // Handle action buttons with event delegation  
        $(document).on('click', '.action-btn', function(e) {
            e.preventDefault();
            const action = $(this).data('action');
            const id = $(this).data('id');
            
            if (action === 'view') {
                viewOfficial(id);
            } else if (action === 'edit') {
                editOfficial(id);
            } else if (action === 'delete') {
                deleteOfficial(id);
            }
        });

        // View Official
        function viewOfficial(id) {
            $.ajax({
                url: `/admin/officials/${id}`,
                type: 'GET',
                success: function(official) {
                    $('#officialModalTitle').html('<i class="fas fa-eye me-3"></i>View Official');
                    fillForm(official);
                    $('#officialForm input, #officialForm select').prop('readonly', true).prop('disabled', true);
                    $('#officialForm button[type="submit"]').hide();
                    new bootstrap.Modal('#officialModal').show();
                },
                error: function() {
                    alert('Error loading official data');
                }
            });
        }

        // Edit Official
        function editOfficial(id) {
            $.ajax({
                url: `/admin/officials/${id}`,
                type: 'GET',
                success: function(official) {
                    $('#officialModalTitle').html('<i class="fas fa-edit me-3"></i>Edit Official');
                    $('#formMethod').val('PUT');
                    $('#officialId').val(id);
                    $('#officialForm').attr('action', `/admin/officials/${id}`);
                    fillForm(official);
                    $('#officialForm input, #officialForm select').prop('readonly', false).prop('disabled', false);
                    $('#officialForm button[type="submit"]').show();
                    new bootstrap.Modal('#officialModal').show();
                },
                error: function() {
                    alert('Error loading official data');
                }
            });
        }

        // Delete Official
        function deleteOfficial(id) {
            if (confirm('Are you sure you want to delete this official?')) {
                const form = $('<form>', {
                    method: 'POST',
                    action: `/admin/officials/${id}`
                }).append(
                    $('<input>', {type: 'hidden', name: '_token', value: '{{ csrf_token() }}'}),
                    $('<input>', {type: 'hidden', name: '_method', value: 'DELETE'})
                );
                $('body').append(form);
                form.submit();
            }
        }

        // Fill form helper
        function fillForm(official) {
            $('#fullName').val(official.name || '');
            $('#nationalId').val(official.national_id || '');
            $('#age').val(official.age || '');
            $('#birthday').val(official.birthday || '');
            $('#civilStatus').val(official.civil_status || '');
            $('#gender').val(official.gender || '');
            $('#purok').val(official.purok || '');
            $('#precinctId').val(official.precinct_id || '');
            $('#religion').val(official.religion || '');
            $('#occupation').val(official.occupation || '');
            $('#position').val(official.position || '');
            $('#fourPsBeneficiary').val(official.four_ps_beneficiary ? '1' : '0');
            $('#pwdStatus').val(official.pwd_status ? '1' : '0');
            $('#voterStatus').val(official.voter_status ? '1' : '0');
            $('#contact').val(official.contact_number || '');
            $('#chairmanship').val(official.chairmanship || '');
            $('#status').val(official.status || '');
            $('#email').val(official.email || '');
        }

        // Reset form when adding new official
        $('#officialModal').on('show.bs.modal', function(e) {
            if ($(e.relatedTarget).hasClass('btn-primary')) {
                $('#officialModalTitle').html('<i class="fas fa-user-tie me-3"></i>Add Official');
                $('#formMethod').val('POST');
                $('#officialId').val('');
                $('#officialForm').attr('action', '/admin/officials');
                $('#officialForm')[0].reset();
                $('#officialForm input, #officialForm select').prop('readonly', false).prop('disabled', false);
                $('#officialForm button[type="submit"]').show();
            }
        });

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
                document.getElementById('fullName').value = official.name || '';
                document.getElementById('nationalId').value = official.national_id || '';
                document.getElementById('age').value = official.age || '';
                document.getElementById('birthday').value = official.birthday || '';
                document.getElementById('civilStatus').value = official.civil_status || '';
                document.getElementById('gender').value = official.gender || '';
                document.getElementById('purok').value = official.purok || '';
                document.getElementById('precinctId').value = official.precinct_id || '';
                document.getElementById('religion').value = official.religion || '';
                document.getElementById('occupation').value = official.occupation || '';
                document.getElementById('position').value = official.position || '';
                document.getElementById('fourPsBeneficiary').value = official.four_ps_beneficiary ? '1' : '0';
                document.getElementById('pwdStatus').value = official.pwd_status ? '1' : '0';
                document.getElementById('voterStatus').value = official.voter_status ? '1' : '0';
                document.getElementById('contact').value = official.contact_number || '';
                document.getElementById('chairmanship').value = official.chairmanship || '';
                document.getElementById('status').value = official.status || '';
                document.getElementById('email').value = official.email || '';
                
                // Make all fields readonly for view mode
                const form = document.getElementById('officialForm');
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.readOnly = true;
                    input.disabled = true;
                });
                
                // Hide the save button
                const saveBtn = document.querySelector('#officialForm button[type="submit"]');
                if (saveBtn) {
                    saveBtn.style.display = 'none';
                }
                
                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('officialModal'));
                modal.show();
            } catch (error) {
                console.error('Error parsing officials data:', error);
                alert('Error loading official data');
            }
        };

        window.editOfficial = function(id) {
            console.log('Edit official with ID:', id);
            
            // Find the official data - using safer JSON parsing
            try {
                const officialsJson = {!! json_encode($officials) !!};
                const official = officialsJson.find(o => o.id == id);
                
                if (!official) {
                    alert('Official not found');
                    return;
                }
                
                // Set modal title for editing
                document.getElementById('officialModalTitle').innerHTML = '<i class="fas fa-edit me-3" style="font-size: 1.3rem;"></i>Edit Official';
                
                // Set form method to PUT for editing
                document.getElementById('formMethod').value = 'PUT';
                document.getElementById('officialId').value = id;
                
                // Fill the form with data
                document.getElementById('fullName').value = official.name || '';
                document.getElementById('nationalId').value = official.national_id || '';
                document.getElementById('age').value = official.age || '';
                document.getElementById('birthday').value = official.birthday || '';
                document.getElementById('civilStatus').value = official.civil_status || '';
                document.getElementById('gender').value = official.gender || '';
                document.getElementById('purok').value = official.purok || '';
                document.getElementById('precinctId').value = official.precinct_id || '';
                document.getElementById('religion').value = official.religion || '';
                document.getElementById('occupation').value = official.occupation || '';
                document.getElementById('position').value = official.position || '';
                document.getElementById('fourPsBeneficiary').value = official.four_ps_beneficiary ? '1' : '0';
                document.getElementById('pwdStatus').value = official.pwd_status ? '1' : '0';
                document.getElementById('voterStatus').value = official.voter_status ? '1' : '0';
                document.getElementById('contact').value = official.contact_number || '';
                document.getElementById('chairmanship').value = official.chairmanship || '';
                document.getElementById('status').value = official.status || '';
                document.getElementById('email').value = official.email || '';
                
                // Ensure all fields are editable for edit mode
                const form = document.getElementById('officialForm');
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.readOnly = false;
                    input.disabled = false;
                });
                
                // Show the save button
                const saveBtn = document.querySelector('#officialForm button[type="submit"]');
                if (saveBtn) {
                    saveBtn.style.display = 'inline-block';
                }
                
                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('officialModal'));
                modal.show();
            } catch (error) {
                console.error('Error parsing officials data:', error);
                alert('Error loading official data');
            }
        };

        window.deleteOfficial = function(id) {
            console.log('Delete official with ID:', id);
            
            // Find the official data for confirmation - using safer JSON parsing
            try {
                const officialsJson = {!! json_encode($officials) !!};
                const official = officialsJson.find(o => o.id == id);
                
                if (!official) {
                    alert('Official not found');
                    return;
                }
                
                if (confirm(`Are you sure you want to delete ${official.name}?`)) {
                    // Create a form to submit the delete request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("admin.officials.destroy", ":id") }}'.replace(':id', id);
                    
                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    // Add method override for DELETE
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);
                    
                    // Submit the form
                    document.body.appendChild(form);
                    form.submit();
                }
            } catch (error) {
                console.error('Error parsing officials data:', error);
                alert('Error loading official data');
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const burgerMenu = document.getElementById('burgerMenu');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const mainContent = document.getElementById('mainContent');

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

        // Officials table functionality
        $(document).ready(function() {
            // Initialize DataTable
            let table = $('#officialsTable').DataTable({
                pageLength: 10,
                lengthMenu: [5,10,25,50],
                order: [[0,'asc']],
                columnDefs: [
                    { orderable: false, targets: [7] }
                ]
            });

            // Bind button actions
            document.querySelectorAll('[data-action]').forEach(a => {
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    const idx = +a.dataset.idx;
                    const act = a.dataset.action;
                    if (act === 'view') viewOfficial(idx);
                    if (act === 'edit') openEdit(idx);
                    if (act === 'remove') removeRow(idx);
                });
            });

            // Handle modal show event - only reset for new additions
            $('#officialModal').on('show.bs.modal', function (e) {
                // Only reset if triggered by the "Add Official" button with data-bs-target
                const triggerButton = e.relatedTarget;
                
                // Check if this is specifically the "Add Official" button
                if (triggerButton && triggerButton.hasAttribute('data-bs-target') && 
                    triggerButton.textContent.includes('Add Official')) {
                    // This is the "Add Official" button
                    document.getElementById('officialModalTitle').innerHTML = '<i class="fas fa-user-tie me-3" style="font-size: 1.3rem;"></i>Add Official';
                    document.getElementById('officialForm').reset();
                    document.getElementById('formMethod').value = 'POST';
                    document.getElementById('officialId').value = '';
                    
                    // Ensure all fields are editable
                    const form = document.getElementById('officialForm');
                    const inputs = form.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        input.readOnly = false;
                        input.disabled = false;
                    });
                    
                    // Show save button
                    const saveBtn = document.querySelector('#officialForm button[type="submit"]');
                    if (saveBtn) {
                        saveBtn.style.display = 'inline-block';
                    }
                }
                // If no relatedTarget (programmatically opened), don't reset
                // This allows edit/view functions to work properly
                }
            });

            // Reset form when modal is hidden
            $('#officialModal').on('hidden.bs.modal', function () {
                // Reset all fields to editable state
                const form = document.getElementById('officialForm');
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.readOnly = false;
                    input.disabled = false;
                });
                
                // Show save button
                const saveBtn = document.querySelector('#officialForm button[type="submit"]');
                if (saveBtn) {
                    saveBtn.style.display = 'inline-block';
                }
            });

            // Handle form submission
            $('#officialForm').on('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                console.log('Form submitted via AJAX');
                
                const formData = new FormData(this);
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                
                // Show loading state
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...').prop('disabled', true);
                
                // Determine the correct URL and method
                let url = '{{ route("admin.officials.store") }}';
                let method = 'POST';
                
                // If it's an edit operation, use PUT method
                const officialId = document.getElementById('officialId').value;
                if (officialId) {
                    method = 'PUT';
                    url = '{{ route("admin.officials.update", ":id") }}'.replace(':id', officialId);
                }
                
                console.log('AJAX Request:', { url, method, officialId });
                
                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-HTTP-Method-Override': method,
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Success response:', response);
                        if (response.success) {
                            // Show success message
                            alert('Official saved successfully!');
                            
                            // Hide modal
                            $('#officialModal').modal('hide');
                            
                            // Reload page to show updated data
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        } else {
                            alert('An error occurred: ' + (response.message || 'Unknown error'));
                        }
                    },
                    error: function(xhr) {
                        console.error('Error response:', xhr);
                        // Handle validation errors
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = 'Please fix the following errors:\n';
                            for (const field in errors) {
                                errorMessage += '- ' + errors[field][0] + '\n';
                            }
                            alert(errorMessage);
                        } else {
                            alert('An error occurred while saving the official. Status: ' + xhr.status);
                        }
                    },
                    complete: function() {
                        // Reset button state
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });
        });

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
