<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Management - BM SYSTEM</title>
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

        .top-header {
            background-color: var(--ink-700);
            padding: 1rem 2rem;
            border-radius: 0;
            margin-bottom: 0;
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

        /* Documents page - exact dashboard styling */
        .stats-card {
            background: var(--ink-700);
            border: 4px solid var(--ink-300);
            border-radius: 16px;
            padding: 2rem;
            text-align: left;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
            background: var(--ink-500);
        }

        .stats-card * {
            color: white !important;
        }

        .stats-card .icon-container {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
            justify-content: center;
        }

        .stats-card .icon-container i {
            font-size: 1.5rem;
            color: white;
        }

        .stats-card .main-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            opacity: 0.8;
        }

        .stats-card .main-number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stats-card .description {
            font-size: 0.9rem;
            opacity: 0.8;
            margin: 0;
        }

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
        .status-released{ background:#198754; color:#fff; }
        .status-ready{ background:#0dcaf0; color:#fff; }
        .status-processing{ background:#fd7e14; color:#fff; }
        .status-pending{ background:#dc3545; color:#fff; }
        
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

        /* Enhanced Modal Styling for Documents */
        #documentModal .form-control,
        #documentModal .form-select {
            color: #212529 !important;
            background: #ffffff !important;
            border: 2px solid #e9ecef !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        #documentModal .form-control:focus,
        #documentModal .form-select:focus {
            border-color: var(--ink-700) !important;
            box-shadow: 0 0 0 0.25rem rgba(26, 61, 99, 0.15) !important;
            background: #ffffff !important;
            color: #212529 !important;
            transform: translateY(-1px);
        }

        #documentModal .form-control:hover,
        #documentModal .form-select:hover {
            border-color: var(--ink-500) !important;
            background: #ffffff !important;
            color: #212529 !important;
            transform: translateY(-1px);
        }

        #documentModal .form-control::placeholder {
            color: #6c757d !important;
            opacity: 0.7;
        }

        #documentModal .form-select option {
            color: #212529 !important;
            background: #ffffff !important;
        }

        #documentModal .btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }

        #documentModal .btn-outline-secondary:hover {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: #ffffff !important;
        }

        #documentModal .form-label {
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem !important;
            color: var(--ink-900) !important;
        }

        #documentModal .modal-content {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        #viewDocumentModal .modal-body {
            background: #f8f9fc !important;
        }

        #viewDocumentModal .info-row {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 12px;
        }

        #viewDocumentModal .info-label {
            color: var(--ink-700) !important;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        #viewDocumentModal .info-value {
            color: #212529 !important;
            font-size: 1rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Header -->
        <div class="top-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <button class="burger-menu me-3" id="burgerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h3 mb-0 text-white">REQUESTED DOCUMENTS</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="window.location.href='{{ route('admin.dashboard') }}'" class="leave-dashboard-btn me-3">
                    ← Back to Dashboard
                </button>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-4">
            <!-- Statistics Cards -->
            <div class="row g-5 mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="main-label">TOTAL</div>
                        <div class="main-number">{{ $statistics['total'] }}</div>
                        <div class="description">Total Documents</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="main-label">RELEASED</div>
                        <div class="main-number">{{ $statistics['released'] }}</div>
                        <div class="description">Released</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="main-label">READY</div>
                        <div class="main-number">{{ $statistics['ready'] }}</div>
                        <div class="description">Pick Up Ready</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="main-label">PENDING</div>
                        <div class="main-number">{{ $statistics['processing'] + $statistics['pending'] }}</div>
                        <div class="description">In Progress</div>
                    </div>
                </div>
            </div>

            <!-- Documents Table -->
            <div class="card card-glass">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list me-2"></i>List of Requested Documents
                    </h5>
                    <div class="d-flex gap-2">
                        <!-- Status Filter -->
                        <select id="statusFilter" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">All Status</option>
                            <option value="Released">Released</option>
                            <option value="Pick Up Ready">Pick Up Ready</option>
                            <option value="Processing">Processing</option>
                            <option value="Pending">Pending</option>
                        </select>
                        <!-- Add Document Button -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#documentModal">
                            <i class="fas fa-plus me-2"></i>Add Document
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="documentsTable" class="table table-dark-lite table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Document Type</th>
                                    <th>Pick up Date</th>
                                    <th>Payment Method</th>
                                    <th>Reference No.</th>
                                    <th>Purpose</th>
                                    <th>Date Requested</th>
                                    <th>Status</th>
                                    <th>Tracking Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentsData as $index => $document)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $document['name'] }}</td>
                                    <td>
                                        @switch($document['document_type'])
                                            @case('Barangay Clearance')
                                                <span class="badge bg-primary">{{ $document['document_type'] }}</span>
                                                @break
                                            @case('Residency Certificate')
                                                <span class="badge bg-info">{{ $document['document_type'] }}</span>
                                                @break
                                            @case('Barangay Business Permit')
                                                <span class="badge bg-warning">{{ $document['document_type'] }}</span>
                                                @break
                                            @case('Certificate of Indigency')
                                                <span class="badge bg-success">{{ $document['document_type'] }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $document['document_type'] }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $document['pickup_date'] }}</td>
                                    <td>{{ $document['payment_method'] }}</td>
                                    <td>{{ $document['reference_no'] }}</td>
                                    <td>{{ $document['purpose'] }}</td>
                                    <td>{{ $document['date_requested'] }}</td>
                                    <td>
                                        @switch($document['status'])
                                            @case('Released')
                                                <span class="badge status-released">Released</span>
                                                @break
                                            @case('Pick Up Ready')
                                                <span class="badge status-ready">Pick Up Ready</span>
                                                @break
                                            @case('Processing')
                                                <span class="badge status-processing">Processing</span>
                                                @break
                                            @case('Pending')
                                                <span class="badge status-pending">Pending</span>
                                                @break
                                            @default
                                                <span class="badge badge-soft">{{ $document['status'] }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $document['tracking_code'] }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="viewDocument({{ $index }})"><i class="fas fa-eye me-2"></i>View</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="editDocument({{ $index }})"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteDocument({{ $index }})"><i class="fas fa-trash me-2"></i>Delete</a></li>
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
    </div>

    <!-- Enhanced Add/Edit Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <form id="documentForm">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                        <h5 class="modal-title fw-bold d-flex align-items-center" id="documentModalTitle" style="font-size: 1.4rem; margin: 0;">
                            <i class="fas fa-file-plus me-3" style="font-size: 1.3rem;"></i>
                            Add Document Request
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1rem;"></button>
                    </div>
                    <div class="modal-body" style="padding: 35px 30px; background: #ffffff;">
                        <input type="hidden" id="documentIndex">

                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-user me-2" style="color: var(--ink-700);"></i>Full Name
                                </label>
                                <input type="text" class="form-control" id="docName" placeholder="Juan Dela Cruz" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-file-alt me-2" style="color: var(--ink-700);"></i>Document Type
                                </label>
                                <select id="docDocumentType" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select document type</option>
                                    <option>Barangay Clearance</option>
                                    <option>Residency Certificate</option>
                                    <option>Barangay Business Permit</option>
                                    <option>Certificate of Indigency</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-calendar me-2" style="color: var(--ink-700);"></i>Pick up Date
                                </label>
                                <input type="date" class="form-control" id="docPickupDate" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-credit-card me-2" style="color: var(--ink-700);"></i>Payment Method
                                </label>
                                <select id="docPaymentMethod" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select payment method</option>
                                    <option>Cash on Pick Up</option>
                                    <option>GCash</option>
                                    <option>PayMaya</option>
                                    <option>Bank Transfer</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-hashtag me-2" style="color: var(--ink-700);"></i>Reference No.
                                </label>
                                <input type="text" class="form-control" id="docReferenceNo" placeholder="REF001" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-bullseye me-2" style="color: var(--ink-700);"></i>Purpose
                                </label>
                                <input type="text" class="form-control" id="docPurpose" placeholder="Multi Purpose" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt me-2" style="color: var(--ink-700);"></i>Date Requested
                                </label>
                                <input type="date" class="form-control" id="docDateRequested" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-info-circle me-2" style="color: var(--ink-700);"></i>Status
                                </label>
                                <select id="docStatus" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option>Pending</option>
                                    <option>Processing</option>
                                    <option>Pick Up Ready</option>
                                    <option>Released</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-barcode me-2" style="color: var(--ink-700);"></i>Tracking Code
                                </label>
                                <input type="text" class="form-control" id="docTrackingCode" placeholder="91b-31h" required 
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
                            <i class="fas fa-save me-2"></i>Save Document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced View Document Modal -->
    <div class="modal fade" id="viewDocumentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                    <h5 class="modal-title fw-bold d-flex align-items-center" style="font-size: 1.4rem; margin: 0;">
                        <i class="fas fa-file-alt me-3" style="font-size: 1.3rem;"></i>
                        Document Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1rem;"></button>
                </div>
                <div class="modal-body" style="padding: 35px 30px;">
                    <div class="row g-3" id="viewDocumentContent">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer" style="background: #f8f9fc; border: none; border-radius: 0 0 20px 20px; padding: 25px 30px;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" 
                            style="border-radius: 12px; padding: 12px 24px; font-weight: 600; border: 2px solid #6c757d; transition: all 0.3s ease;">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                </div>
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

            // Initialize DataTables
            const table = $('#documentsTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [10] } // Disable ordering on Action column (now at index 10)
                ]
            });

            // Status filter functionality
            $('#statusFilter').on('change', function() {
                const status = $(this).val();
                if (status) {
                    table.column(8).search('^' + status + '$', true, false).draw(); // Status column is now at index 8
                } else {
                    table.column(8).search('').draw();
                }
            });

            // Sample data for JavaScript functions
            const documentsData = @json($documentsData);

            // View document function
            window.viewDocument = function(index) {
                const doc = documentsData[index];
                const content = document.getElementById('viewDocumentContent');
                
                content.innerHTML = `
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-user me-2"></i>Full Name</div>
                            <div class="info-value">${doc.name}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-file-alt me-2"></i>Document Type</div>
                            <div class="info-value">
                                <span class="badge ${getDocumentTypeClass(doc.document_type)}">${doc.document_type}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-calendar me-2"></i>Pick up Date</div>
                            <div class="info-value">${doc.pickup_date}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-credit-card me-2"></i>Payment Method</div>
                            <div class="info-value">${doc.payment_method}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-hashtag me-2"></i>Reference No.</div>
                            <div class="info-value">${doc.reference_no}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-bullseye me-2"></i>Purpose</div>
                            <div class="info-value">${doc.purpose}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-calendar-alt me-2"></i>Date Requested</div>
                            <div class="info-value">${doc.date_requested}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-info-circle me-2"></i>Status</div>
                            <div class="info-value">
                                <span class="badge ${getStatusClass(doc.status)}">${doc.status}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-barcode me-2"></i>Tracking Code</div>
                            <div class="info-value">${doc.tracking_code}</div>
                        </div>
                    </div>
                `;
                
                new bootstrap.Modal('#viewDocumentModal').show();
            };

            // Edit document function
            window.editDocument = function(index) {
                const doc = documentsData[index];
                document.getElementById('documentModalTitle').innerHTML = '<i class="fas fa-file-edit me-3" style="font-size: 1.3rem;"></i>Edit Document Request';
                document.getElementById('documentIndex').value = index;
                document.getElementById('docName').value = doc.name;
                document.getElementById('docDocumentType').value = doc.document_type;
                document.getElementById('docPickupDate').value = formatDateForInput(doc.pickup_date);
                document.getElementById('docPaymentMethod').value = doc.payment_method;
                document.getElementById('docReferenceNo').value = doc.reference_no;
                document.getElementById('docPurpose').value = doc.purpose;
                document.getElementById('docDateRequested').value = formatDateForInput(doc.date_requested);
                document.getElementById('docStatus').value = doc.status;
                document.getElementById('docTrackingCode').value = doc.tracking_code;
                new bootstrap.Modal('#documentModal').show();
            };

            // Delete document function
            window.deleteDocument = function(index) {
                const doc = documentsData[index];
                if (confirm(`Are you sure you want to delete the document request for ${doc.name}?`)) {
                    // Remove from data array and reload table
                    documentsData.splice(index, 1);
                    location.reload(); // Simple reload for demo
                }
            };

            // Helper function to get status badge class
            function getStatusClass(status) {
                switch(status) {
                    case 'Released': return 'status-released';
                    case 'Pick Up Ready': return 'status-ready';
                    case 'Processing': return 'status-processing';
                    case 'Pending': return 'status-pending';
                    default: return 'badge-soft';
                }
            }

            // Helper function to get document type badge class
            function getDocumentTypeClass(documentType) {
                switch(documentType) {
                    case 'Barangay Clearance': return 'bg-primary';
                    case 'Residency Certificate': return 'bg-info';
                    case 'Barangay Business Permit': return 'bg-warning';
                    case 'Certificate of Indigency': return 'bg-success';
                    default: return 'bg-secondary';
                }
            }

            // Helper function to format date for input
            function formatDateForInput(dateStr) {
                const parts = dateStr.split('-');
                return `${parts[2]}-${parts[1]}-${parts[0]}`;
            }

            // Reset modal to "Add"
            document.getElementById('documentModal').addEventListener('show.bs.modal', (e) => {
                if (e.relatedTarget && e.relatedTarget.getAttribute('data-bs-target') === '#documentModal') {
                    document.getElementById('documentModalTitle').innerHTML = '<i class="fas fa-file-plus me-3" style="font-size: 1.3rem;"></i>Add Document Request';
                    document.getElementById('documentIndex').value = '';
                    document.getElementById('documentForm').reset();
                }
            });

            // Save (add or edit) document
            document.getElementById('documentForm').addEventListener('submit', (e) => {
                e.preventDefault();
                const index = document.getElementById('documentIndex').value;

                if (index === '') {
                    // Add new document
                    alert('Document request added successfully!');
                } else {
                    // Edit existing document
                    alert('Document request updated successfully!');
                }

                // Close modal and reset form
                bootstrap.Modal.getInstance('#documentModal').hide();
                document.getElementById('documentForm').reset();
                
                // In a real application, you would submit the data to the server
                // For now, we'll just reload the page
                setTimeout(() => location.reload(), 500);
            });
        });
    </script>
</body>
</html>