<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a href="{{ route('admin.officials') }}" class="nav-link active">
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
                                <th>Chairmanship</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- rows injected via JS so you can keep this page static --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Add/Edit Official Modal --}}
    <!-- Enhanced Add/Edit Official Modal -->
    <div class="modal fade" id="officialModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <form id="officialForm">
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
                                    <i class="fas fa-user me-2" style="color: var(--ink-700);"></i>Full Name
                                </label>
                                <input type="text" class="form-control" id="fullName" placeholder="Juan Dela Cruz" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-briefcase me-2" style="color: var(--ink-700);"></i>Position
                                </label>
                                <select id="position" class="form-select" required 
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

                            <div class="col-12">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-clipboard-list me-2" style="color: var(--ink-700);"></i>Chairmanship
                                </label>
                                <input type="text" class="form-control" id="chairmanship" placeholder="Committee on Education" 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-toggle-on me-2" style="color: var(--ink-700);"></i>Status
                                </label>
                                <select id="status" class="form-select" 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-phone me-2" style="color: var(--ink-700);"></i>Contact
                                </label>
                                <input type="text" class="form-control" id="contact" placeholder="09XXXXXXXXX" 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-envelope me-2" style="color: var(--ink-700);"></i>Email
                                </label>
                                <input type="email" class="form-control" id="email" placeholder="name@email.com" 
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
        (() => {
            // Demo dataset – replace with server data later
            const seed = [
                { name:'USER USER', chair:'Committee of Infra', position:'Captain', status:'Active' },
                { name:'USER USER', chair:'Committee of Education', position:'Kagawad 2', status:'Active' },
                { name:'USER USER', chair:'Committee of Sports', position:'SK Chairman', status:'Active' },
                { name:'USER USER', chair:'Committee on Peace & Order', position:'Kagawad 3', status:'Active' },
                { name:'USER USER', chair:'Committee on Rules', position:'Kagawad 1', status:'Active' },
                { name:'USER USER', chair:'Committee on Health', position:'Treasurer', status:'Active' },
                { name:'USER USER', chair:'Committee of Solid Waste', position:'Tanod 1', status:'Active' },
                { name:'USER USER', chair:'No Chairmanship', position:'Tanod 2', status:'Active' },
            ];

            let rows = [...seed];
            let dt;

            const statusBadge = (s) => {
                return `<span class="badge ${s==='Active' ? 'status-active' : 'status-inactive'}">${s}</span>`;
            };

            function renderTable(){
                const tbody = document.querySelector('#officialsTable tbody');
                tbody.innerHTML = '';
                rows.forEach((r, idx) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${r.name}</td>
                        <td>${r.chair}</td>
                        <td>${r.position}</td>
                        <td>${statusBadge(r.status)}</td>
                        <td class="text-end">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#" data-action="edit" data-idx="${idx}">Edit</a></li>
                                    <li><a class="dropdown-item" href="#" data-action="toggle" data-idx="${idx}">${r.status==='Active' ? 'Deactivate' : 'Activate'}</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" data-action="remove" data-idx="${idx}">Remove</a></li>
                                </ul>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

                // (Re)init DataTable
                if (dt) dt.destroy();
                dt = new $.fn.dataTable.Api($('#officialsTable').DataTable({
                    pageLength: 10,
                    lengthMenu: [5,10,25,50],
                    order: [[2,'asc']],
                    columnDefs: [
                        { orderable:false, targets: [4] }
                    ]
                }));

                // Bind dropdown actions
                document.querySelectorAll('[data-action]').forEach(a => {
                    a.addEventListener('click', (e) => {
                        e.preventDefault();
                        const idx = +a.dataset.idx;
                        const act = a.dataset.action;
                        if (act === 'edit') openEdit(idx);
                        if (act === 'toggle') toggleStatus(idx);
                        if (act === 'remove') removeRow(idx);
                    });
                });
            }

            function openEdit(index){
                const r = rows[index];
                document.getElementById('officialModalTitle').innerHTML = '<i class="fas fa-user-edit me-3" style="font-size: 1.3rem;"></i>Edit Official';
                document.getElementById('rowIndex').value = index;
                document.getElementById('fullName').value = r.name;
                document.getElementById('chairmanship').value = r.chair || '';
                document.getElementById('position').value = r.position || '';
                document.getElementById('status').value = r.status || 'Active';
                document.getElementById('contact').value = r.contact || '';
                document.getElementById('email').value = r.email || '';
                new bootstrap.Modal('#officialModal').show();
            }

            function toggleStatus(index){
                rows[index].status = rows[index].status === 'Active' ? 'Inactive' : 'Active';
                renderTable();
            }

            function removeRow(index){
                if (confirm('Remove this official?')) {
                    rows.splice(index, 1);
                    renderTable();
                }
            }

            // Reset modal to "Add"
            document.getElementById('officialModal').addEventListener('show.bs.modal', (e) => {
                if (e.relatedTarget && e.relatedTarget.getAttribute('data-bs-target') === '#officialModal') {
                    document.getElementById('officialModalTitle').innerHTML = '<i class="fas fa-user-tie me-3" style="font-size: 1.3rem;"></i>Add Official';
                    document.getElementById('rowIndex').value = '';
                    document.getElementById('officialForm').reset();
                }
            });

            // Save (add or edit)
            document.getElementById('officialForm').addEventListener('submit', (e) => {
                e.preventDefault();
                const idx = document.getElementById('rowIndex').value;
                const payload = {
                    name: document.getElementById('fullName').value.trim(),
                    chair: document.getElementById('chairmanship').value.trim(),
                    position: document.getElementById('position').value,
                    status: document.getElementById('status').value,
                    contact: document.getElementById('contact').value.trim(),
                    email: document.getElementById('email').value.trim(),
                };
                if (!payload.name || !payload.position) return;

                if (idx === '') rows.unshift(payload);     // add new at top
                else rows[idx] = payload;                  // update

                bootstrap.Modal.getInstance(document.getElementById('officialModal')).hide();
                renderTable();
            });

            // First render
            renderTable();
        })();

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
