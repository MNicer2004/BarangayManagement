<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Inventory - BM SYSTEM</title>
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

        .content-wrapper {
            padding: 2rem;
        }

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

        /* Medicine page specific styles */
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
        .stock-high{ background:#198754; color:#fff; }
        .stock-low{ background:#ffc107; color:#000; }
        .stock-out{ background:#dc3545; color:#fff; }
        
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
            .content-wrapper {
                padding: 1rem;
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

        /* Enhanced Modal Styling for Medicine */
        #medicineModal .form-control,
        #medicineModal .form-select {
            color: #212529 !important;
            background: #ffffff !important;
            border: 2px solid #e9ecef !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        #medicineModal .form-control:focus,
        #medicineModal .form-select:focus {
            border-color: var(--ink-700) !important;
            box-shadow: 0 0 0 0.25rem rgba(26, 61, 99, 0.15) !important;
            background: #ffffff !important;
            color: #212529 !important;
            transform: translateY(-1px);
        }

        #medicineModal .form-control:hover,
        #medicineModal .form-select:hover {
            border-color: var(--ink-500) !important;
            background: #ffffff !important;
            color: #212529 !important;
            transform: translateY(-1px);
        }

        #medicineModal .form-control::placeholder {
            color: #6c757d !important;
            opacity: 0.7;
        }

        #medicineModal .form-select option {
            color: #212529 !important;
            background: #ffffff !important;
        }

        #medicineModal .btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }

        #medicineModal .btn-outline-secondary:hover {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: #ffffff !important;
        }

        #medicineModal .form-label {
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: var(--ink-700) !important;
            margin-bottom: 0.5rem;
        }

        #medicineModal .modal-header {
            background: linear-gradient(135deg, var(--ink-700) 0%, var(--ink-500) 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        #medicineModal .modal-title {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        #medicineModal .btn-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: white;
            opacity: 0.8;
        }

        #medicineModal .btn-close:hover {
            opacity: 1;
        }

        #medicineModal .modal-body {
            padding: 2rem;
            background: #ffffff;
        }

        #medicineModal .modal-footer {
            padding: 1.5rem 2rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        #medicineModal .btn-primary {
            background: linear-gradient(135deg, var(--ink-700) 0%, var(--ink-500) 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 0.5rem;
        }

        #medicineModal .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            padding: 0.75rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 0.5rem;
            background: transparent;
        }

        /* Icon styling in modal */
        #medicineModal .fas {
            color: var(--ink-700);
            margin-right: 0.5rem;
        }

        /* Add fade animation */
        #medicineModal.fade .modal-dialog {
            transform: scale(0.8);
            transition: transform 0.3s ease-out;
        }

        #medicineModal.show .modal-dialog {
            transform: scale(1);
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
                <a href="{{ route('admin.certificates') }}" class="nav-link">
                    <i class="fas fa-file-text me-3"></i> Certificate Management
                </a>
                <a href="{{ route('admin.blotter') }}" class="nav-link">
                    <i class="fas fa-gavel me-3"></i> Crime / Blotter Records
                </a>
                <a href="{{ route('admin.medicine') }}" class="nav-link active">
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
                <h1 class="h3 mb-0 text-white">MEDICINE INVENTORY</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-wrapper">
            <!-- Summary Cards -->
            <div class="row g-5 mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-pills"></i>
                        </div>
                        <div class="main-label">TOTAL MEDICINES</div>
                        <div class="main-number">{{ count($medicines) }}</div>
                        <div class="description">All Medicine Items</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="main-label">IN STOCK</div>
                        <div class="main-number">{{ collect($medicines)->where('stock_status', 'In Stock')->count() }}</div>
                        <div class="description">Available Medicines</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="main-label">LOW STOCK</div>
                        <div class="main-number">{{ collect($medicines)->where('stock_status', 'Low Stock')->count() }}</div>
                        <div class="description">Need Restocking</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="main-label">OUT OF STOCK</div>
                        <div class="main-number">{{ collect($medicines)->where('stock_status', 'Out of Stock')->count() }}</div>
                        <div class="description">Unavailable Items</div>
                    </div>
                </div>
            </div>

            <!-- Medicine Table -->
            <div class="card-glass">
                <div class="card-header bg-transparent border-bottom-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Medicine Inventory Management</h5>
                            <p class="text-ink-300 mb-0">Manage and track all medicines in the barangay health center</p>
                        </div>
                        <button class="btn btn-primary btn-pill" data-bs-toggle="modal" data-bs-target="#medicineModal" onclick="showAddModal()">
                            <i class="fas fa-plus me-2"></i>Add Medicine
                        </button>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="medicineTable" class="table table-dark-lite table-striped">
                            <thead>
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Category</th>
                                    <th>Quantity (Boxes)</th>
                                    <th>Total Capsules</th>
                                    <th>Strength</th>
                                    <th>Expiry Date</th>
                                    <th>Stock Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="medicineTableBody">
                                <!-- Content will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Medicine Modal -->
    <div class="modal fade" id="medicineModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="medicineModalTitle">
                        <i class="fas fa-pills me-2"></i>Add New Medicine
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="medicineForm">
                        <input type="hidden" id="medicineIndex" value="">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="medicineName" class="form-label">
                                    <i class="fas fa-pills"></i>Medicine Name
                                </label>
                                <input type="text" class="form-control" id="medicineName" placeholder="Enter medicine name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="medicineCategory" class="form-label">
                                    <i class="fas fa-tags"></i>Category
                                </label>
                                <select class="form-select" id="medicineCategory" required>
                                    <option value="">Select category</option>
                                    <option value="Antibiotic">Antibiotic</option>
                                    <option value="Pain Relief">Pain Relief</option>
                                    <option value="Vitamins">Vitamins</option>
                                    <option value="Cough & Cold">Cough & Cold</option>
                                    <option value="Antacid">Antacid</option>
                                    <option value="Anti-inflammatory">Anti-inflammatory</option>
                                    <option value="Hypertension">Hypertension</option>
                                    <option value="Diabetes">Diabetes</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="quantityBoxes" class="form-label">
                                    <i class="fas fa-box"></i>Quantity (Boxes)
                                </label>
                                <input type="number" class="form-control" id="quantityBoxes" placeholder="0" min="0" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="capsulesPerBox" class="form-label">
                                    <i class="fas fa-capsules"></i>Capsules per Box
                                </label>
                                <input type="number" class="form-control" id="capsulesPerBox" placeholder="0" min="1" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="medicineStrength" class="form-label">
                                    <i class="fas fa-weight"></i>Strength
                                </label>
                                <input type="text" class="form-control" id="medicineStrength" placeholder="e.g., 500mg" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expiryDate" class="form-label">
                                    <i class="fas fa-calendar-times"></i>Expiry Date
                                </label>
                                <input type="date" class="form-control" id="expiryDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stockStatus" class="form-label">
                                    <i class="fas fa-info-circle"></i>Stock Status
                                </label>
                                <select class="form-select" id="stockStatus" required>
                                    <option value="">Select status</option>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Low Stock">Low Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">
                                <i class="fas fa-notes-medical"></i>Remarks
                            </label>
                            <textarea class="form-control" id="remarks" rows="3" placeholder="Additional notes or remarks"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-primary" onclick="saveMedicine()">
                        <i class="fas fa-save me-2"></i>Save Medicine
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Sample medicine data (in a real app, this would come from the backend)
        let medicines = @json($medicines);
        let currentEditIndex = -1;
        let medicineTable;

        document.addEventListener('DOMContentLoaded', function() {
            initializePage();
        });

        function initializePage() {
            setupSidebar();
            renderMedicineTable();
            setupEventListeners();
        }

        function setupSidebar() {
            const burgerMenu = document.getElementById('burgerMenu');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const mainContent = document.getElementById('mainContent');

            // Handle burger menu click
            burgerMenu?.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('show');
                } else {
                    sidebar.classList.toggle('hidden');
                    mainContent.classList.toggle('expanded');
                }
            });

            // Handle close sidebar button click
            closeSidebar?.addEventListener('click', function() {
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
        }

        function renderMedicineTable() {
            const tbody = document.getElementById('medicineTableBody');
            tbody.innerHTML = '';

            medicines.forEach((medicine, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>${medicine.medicine_name}</strong></td>
                    <td>${medicine.category}</td>
                    <td>${medicine.quantity_boxes}</td>
                    <td>${medicine.total_capsules}</td>
                    <td>${medicine.strength}</td>
                    <td>${medicine.expiry_date}</td>
                    <td>${getStockBadge(medicine.stock_status)}</td>
                    <td class="text-end">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" data-action="view" data-idx="${index}">
                                    <i class="fas fa-eye me-2"></i>View
                                </a></li>
                                <li><a class="dropdown-item" href="#" data-action="edit" data-idx="${index}">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#" data-action="delete" data-idx="${index}">
                                    <i class="fas fa-trash me-2"></i>Delete
                                </a></li>
                            </ul>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            // Initialize or reinitialize DataTable
            if (medicineTable) {
                medicineTable.destroy();
            }
            medicineTable = $('#medicineTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [7] }
                ],
                responsive: true,
                language: {
                    search: "Search medicines:",
                    lengthMenu: "Show _MENU_ medicines per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ medicines",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        }

        function getStockBadge(status) {
            switch(status) {
                case 'In Stock':
                    return '<span class="badge stock-high">In Stock</span>';
                case 'Low Stock':
                    return '<span class="badge stock-low">Low Stock</span>';
                case 'Out of Stock':
                    return '<span class="badge stock-out">Out of Stock</span>';
                default:
                    return '<span class="badge badge-soft">Unknown</span>';
            }
        }

        function setupEventListeners() {
            // Handle action button clicks
            document.addEventListener('click', function(e) {
                const action = e.target.dataset.action;
                const index = e.target.dataset.idx;

                if (action && index !== undefined) {
                    e.preventDefault();
                    
                    switch(action) {
                        case 'view':
                            viewMedicine(parseInt(index));
                            break;
                        case 'edit':
                            editMedicine(parseInt(index));
                            break;
                        case 'delete':
                            deleteMedicine(parseInt(index));
                            break;
                    }
                }
            });

            // Calculate total capsules automatically
            document.getElementById('quantityBoxes')?.addEventListener('input', calculateTotalCapsules);
            document.getElementById('capsulesPerBox')?.addEventListener('input', calculateTotalCapsules);
        }

        function calculateTotalCapsules() {
            const boxes = parseInt(document.getElementById('quantityBoxes').value) || 0;
            const capsulesPerBox = parseInt(document.getElementById('capsulesPerBox').value) || 0;
            const total = boxes * capsulesPerBox;
            
            // You could add a total capsules display field if needed
            console.log('Total capsules:', total);
        }

        function showAddModal() {
            resetForm();
            currentEditIndex = -1;
            document.getElementById('medicineModalTitle').innerHTML = '<i class="fas fa-plus me-2"></i>Add New Medicine';
        }

        function viewMedicine(index) {
            const medicine = medicines[index];
            if (!medicine) return;

            // Populate form with medicine data (read-only)
            populateForm(medicine);
            
            // Disable all form fields
            const formElements = document.querySelectorAll('#medicineForm input, #medicineForm select, #medicineForm textarea');
            formElements.forEach(element => element.disabled = true);
            
            document.getElementById('medicineModalTitle').innerHTML = '<i class="fas fa-eye me-2"></i>View Medicine Details';
            
            // Hide save button, show only close
            const saveBtn = document.querySelector('#medicineModal .btn-primary');
            if (saveBtn) saveBtn.style.display = 'none';
            
            const modal = new bootstrap.Modal(document.getElementById('medicineModal'));
            modal.show();
        }

        function editMedicine(index) {
            const medicine = medicines[index];
            if (!medicine) return;

            populateForm(medicine);
            currentEditIndex = index;
            document.getElementById('medicineModalTitle').innerHTML = '<i class="fas fa-edit me-2"></i>Edit Medicine';
            
            // Enable all form fields
            const formElements = document.querySelectorAll('#medicineForm input, #medicineForm select, #medicineForm textarea');
            formElements.forEach(element => element.disabled = false);
            
            // Show save button
            const saveBtn = document.querySelector('#medicineModal .btn-primary');
            if (saveBtn) saveBtn.style.display = 'inline-block';
            
            const modal = new bootstrap.Modal(document.getElementById('medicineModal'));
            modal.show();
        }

        function populateForm(medicine) {
            document.getElementById('medicineName').value = medicine.medicine_name;
            document.getElementById('medicineCategory').value = medicine.category;
            document.getElementById('quantityBoxes').value = medicine.quantity_boxes;
            document.getElementById('capsulesPerBox').value = medicine.capsules_per_box;
            document.getElementById('medicineStrength').value = medicine.strength;
            document.getElementById('expiryDate').value = medicine.expiry_date;
            document.getElementById('stockStatus').value = medicine.stock_status;
            document.getElementById('remarks').value = medicine.remarks;
        }

        function resetForm() {
            document.getElementById('medicineForm').reset();
            
            // Enable all form fields
            const formElements = document.querySelectorAll('#medicineForm input, #medicineForm select, #medicineForm textarea');
            formElements.forEach(element => element.disabled = false);
            
            // Show save button
            const saveBtn = document.querySelector('#medicineModal .btn-primary');
            if (saveBtn) saveBtn.style.display = 'inline-block';
        }

        function saveMedicine() {
            // Get form data
            const formData = {
                medicine_name: document.getElementById('medicineName').value,
                category: document.getElementById('medicineCategory').value,
                quantity_boxes: parseInt(document.getElementById('quantityBoxes').value),
                capsules_per_box: parseInt(document.getElementById('capsulesPerBox').value),
                strength: document.getElementById('medicineStrength').value,
                expiry_date: document.getElementById('expiryDate').value,
                stock_status: document.getElementById('stockStatus').value,
                remarks: document.getElementById('remarks').value
            };

            // Calculate total capsules
            formData.total_capsules = formData.quantity_boxes * formData.capsules_per_box;

            // Validate required fields
            if (!formData.medicine_name || !formData.category || !formData.quantity_boxes || 
                !formData.capsules_per_box || !formData.strength || !formData.expiry_date || !formData.stock_status) {
                alert('Please fill in all required fields.');
                return;
            }

            // Add or update medicine
            if (currentEditIndex >= 0) {
                medicines[currentEditIndex] = formData;
            } else {
                medicines.push(formData);
            }

            // Re-render table
            renderMedicineTable();

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('medicineModal'));
            modal.hide();

            // Show success message
            alert(currentEditIndex >= 0 ? 'Medicine updated successfully!' : 'Medicine added successfully!');
        }

        function deleteMedicine(index) {
            const medicine = medicines[index];
            if (!medicine) return;

            if (confirm(`Are you sure you want to delete "${medicine.medicine_name}"?`)) {
                medicines.splice(index, 1);
                renderMedicineTable();
                alert('Medicine deleted successfully!');
            }
        }

        function logoutAndRedirect() {
            if (confirm('Are you sure you want to leave the dashboard?')) {
                window.location.href = '/';
            }
        }

        // Function to update date and time
        function updateDateTime() {
            const now = new Date();
            const options = {
                timeZone: 'Asia/Manila',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            
            const formatter = new Intl.DateTimeFormat('en-US', options);
            const philippinesTime = formatter.format(now);
            
            document.getElementById('philippines-time').innerHTML = philippinesTime;
        }

        // Update time immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>