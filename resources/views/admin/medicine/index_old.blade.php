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
            width: 250px;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .main-content {
            margin-left: 250px;
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
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white !important;
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            color: white !important;
        }

        .burger-menu {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .leave-dashboard-btn {
            background: none;
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .leave-dashboard-btn:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
        }

        .btn-close-sidebar {
            background: none;
            border: none;
            color: white;
            font-size: 1.25rem;
        }

        .sidebar-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .text-ink-300 {
            color: var(--ink-300) !important;
        }

        .text-ink-900 {
            color: var(--ink-900) !important;
        }

        .btn-pill {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }

        .table-dark-lite {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255, 255, 255, 0.05);
            --bs-table-striped-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-active-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            --bs-table-hover-color: #212529;
            color: #212529;
        }

        .table-dark-lite th {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #495057;
            font-weight: 600;
        }

        .table-dark-lite td {
            border-color: #dee2e6;
        }

        .badge.status-high { 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%); 
            color: white;
        }
        .badge.status-low { 
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); 
            color: white;
        }
        .badge.status-out { 
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); 
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
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
            letter-spacing: 0.5px;
            font-size: 0.85rem !important;
            color: var(--ink-900) !important;
        }

        #medicineModal .modal-content {
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
                        <img src="/assets/images/logo.png" class="sidebar-logo" alt="BM System Logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="logo-container" style="display:none; background: rgba(255,255,255,0.2); border-radius: 12px; width: 32px; height: 32px; align-items: center; justify-content: center;">
                            <span style="color: white; font-weight: bold; font-size: 14px;">BM</span>
                        </div>
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
                    <div class="fw-semibold text-white">Admin</div>
                    <div class="small text-light">Administrator</div>
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
            <a href="{{ route('admin.blotter') }}" class="nav-link">
                <i class="fas fa-gavel me-3"></i> Crime / Blotter Records
            </a>
            <a href="{{ route('admin.documents') }}" class="nav-link">
                <i class="fas fa-folder-open me-3"></i> Requested Documents
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-house-user me-3"></i> Purok & Household Record
            </a>
            <a href="{{ route('admin.medicine') }}" class="nav-link active">
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
                <h1 class="h3 mb-0 text-white">MEDICINE INVENTORY</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
                <div class="d-flex align-items-center text-white">
                    <span class="me-3">Admin Administrator</span>
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medicine Content -->
        <div class="p-4">
            {{-- Barangay summary card --}}
            <div class="card-glass p-3 p-md-4 mb-4">
                <div class="d-flex gap-3 align-items-center">
                    <div class="rounded-circle d-inline-grid place-items-center" style="width:92px;height:92px;background:#1A3D63;border:1px solid rgba(255,255,255,.25)">
                        <i class="fas fa-pills text-white" style="font-size: 2rem;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-ink-300 small">Medicine Inventory</div>
                        <h2 class="h4 fw-bold mb-1">{{ count($medicineData) }} Medicines Available</h2>
                        <div class="text-ink-300">{{ collect($medicineData)->where('stock_status', 'High Stock')->count() }} High Stock • {{ collect($medicineData)->where('stock_status', 'Low Stock')->count() }} Low Stock</div>
                    </div>
                </div>
            </div>

            {{-- Table card --}}
            <div class="card-glass p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 fw-bold">Medicine Inventory</h5>
                    <div class="d-flex gap-2">
                        <!-- Stock Status Filter -->
                        <select id="stockFilter" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">All Stock Status</option>
                            <option value="High Stock">High Stock</option>
                            <option value="Low Stock">Low Stock</option>
                            <option value="Out of Stock">Out of Stock</option>
                        </select>
                        <button class="btn btn-primary fw-bold btn-pill" data-bs-toggle="modal" data-bs-target="#medicineModal">
                            <i class="fas fa-plus me-1"></i> Add Medicine
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="medicineTable" class="table table-dark-lite table-striped w-100">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Category</th>
                                <th>Quantity (Boxes)</th>
                                <th>Capsules per Box</th>
                                <th>Strength</th>
                                <th>Total Capsules</th>
                                <th>Expiry Date</th>
                                <th>Stock Status</th>
                                <th>Remarks</th>
                                <th style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicineData as $index => $medicine)
                            <tr>
                                <td class="fw-bold">{{ $medicine['medicine_name'] }}</td>
                                <td>{{ $medicine['category'] }}</td>
                                <td>{{ $medicine['quantity_boxes'] }}</td>
                                <td>{{ $medicine['capsules_per_box'] }}</td>
                                <td>{{ $medicine['strength'] }}</td>
                                <td>{{ $medicine['total_capsules'] }}</td>
                                <td>{{ $medicine['expiry_date'] }}</td>
                                <td>
                                    @switch($medicine['stock_status'])
                                        @case('High Stock')
                                            <span class="badge status-high">High Stock</span>
                                            @break
                                        @case('Low Stock')
                                            <span class="badge status-low">Low Stock</span>
                                            @break
                                        @case('Out of Stock')
                                            <span class="badge status-out">Out of Stock</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $medicine['stock_status'] }}</span>
                                    @endswitch
                                </td>
                                <td>{{ $medicine['remarks'] }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="viewMedicine({{ $index }})"><i class="fas fa-eye me-2"></i>View</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="editMedicine({{ $index }})"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteMedicine({{ $index }})"><i class="fas fa-trash me-2"></i>Delete</a></li>
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

    {{-- Enhanced Add/Edit Medicine Modal --}}
    <div class="modal fade" id="medicineModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <form id="medicineForm">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                        <h5 class="modal-title fw-bold d-flex align-items-center" id="medicineModalTitle" style="font-size: 1.4rem; margin: 0;">
                            <i class="fas fa-plus-circle me-3" style="font-size: 1.3rem;"></i>
                            Add Medicine
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1rem;"></button>
                    </div>
                    <div class="modal-body" style="padding: 35px 30px; background: #ffffff;">
                        <input type="hidden" id="medicineIndex">

                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-pills me-2" style="color: var(--ink-700);"></i>MEDICINE NAME
                                </label>
                                <input type="text" class="form-control" id="medMedicineName" placeholder="Amoxicillin" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-tags me-2" style="color: var(--ink-700);"></i>CATEGORY
                                </label>
                                <select id="medCategory" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select category</option>
                                    <option>Antibiotic</option>
                                    <option>Analgesic</option>
                                    <option>Anti-inflammatory</option>
                                    <option>Supplement</option>
                                    <option>Anti-diabetic</option>
                                    <option>Anti-acid</option>
                                    <option>Antihistamine</option>
                                    <option>Antihypertensive</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-boxes me-2" style="color: var(--ink-700);"></i>QUANTITY (BOXES)
                                </label>
                                <input type="number" class="form-control" id="medQuantityBoxes" placeholder="8" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-capsules me-2" style="color: var(--ink-700);"></i>CAPSULES PER BOX
                                </label>
                                <input type="number" class="form-control" id="medCapsulesPerBox" placeholder="100" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-weight me-2" style="color: var(--ink-700);"></i>STRENGTH
                                </label>
                                <input type="text" class="form-control" id="medStrength" placeholder="500 mg" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt me-2" style="color: var(--ink-700);"></i>EXPIRY DATE
                                </label>
                                <input type="text" class="form-control" id="medExpiryDate" placeholder="Dec 2025" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-chart-line me-2" style="color: var(--ink-700);"></i>STOCK STATUS
                                </label>
                                <select id="medStockStatus" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select stock status</option>
                                    <option>High Stock</option>
                                    <option>Low Stock</option>
                                    <option>Out of Stock</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.85rem; margin-bottom: 8px;">
                                    <i class="fas fa-comment me-2" style="color: var(--ink-700);"></i>REMARKS
                                </label>
                                <textarea class="form-control" id="medRemarks" rows="3" placeholder="For bacterial infections" required 
                                          style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa; resize: vertical;"></textarea>
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
                            <i class="fas fa-save me-2"></i>Save Medicine
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Sidebar functionality
        document.getElementById('burgerMenu').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('expanded');
        });

        document.getElementById('closeSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.add('hidden');
        });

        // Logout function
        function logoutAndRedirect() {
            if (confirm('Are you sure you want to logout?')) {
                // Add logout functionality here
                window.location.href = '/';
            }
        }

        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#medicineTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [9] } // Disable ordering on Action column
                ]
            });

            // Stock status filter functionality
            $('#stockFilter').on('change', function() {
                const status = $(this).val();
                if (status) {
                    table.column(7).search('^' + status + '$', true, false).draw(); // Stock Status column is at index 7
                } else {
                    table.column(7).search('').draw();
                }
            });

            // Sample data for JavaScript functions
            const medicineData = @json($medicineData);

            // View medicine function
            window.viewMedicine = function(index) {
                const med = medicineData[index];
                alert(`Medicine: ${med.medicine_name}\nCategory: ${med.category}\nStock: ${med.stock_status}\nRemarks: ${med.remarks}`);
            };

            // Edit medicine function
            window.editMedicine = function(index) {
                const med = medicineData[index];
                document.getElementById('medicineModalTitle').innerHTML = '<i class="fas fa-edit me-3" style="font-size: 1.3rem;"></i>Edit Medicine';
                document.getElementById('medicineIndex').value = index;
                document.getElementById('medMedicineName').value = med.medicine_name;
                document.getElementById('medCategory').value = med.category;
                document.getElementById('medQuantityBoxes').value = med.quantity_boxes;
                document.getElementById('medCapsulesPerBox').value = med.capsules_per_box;
                document.getElementById('medStrength').value = med.strength;
                document.getElementById('medExpiryDate').value = med.expiry_date;
                document.getElementById('medStockStatus').value = med.stock_status;
                document.getElementById('medRemarks').value = med.remarks;
                new bootstrap.Modal('#medicineModal').show();
            };

            // Delete medicine function
            window.deleteMedicine = function(index) {
                const med = medicineData[index];
                if (confirm(`Are you sure you want to delete ${med.medicine_name}?`)) {
                    // Remove from data array and reload table
                    medicineData.splice(index, 1);
                    location.reload(); // Simple reload for demo
                }
            };

            // Reset modal to "Add"
            $('#medicineModal').on('hidden.bs.modal', function () {
                document.getElementById('medicineModalTitle').innerHTML = '<i class="fas fa-plus-circle me-3" style="font-size: 1.3rem;"></i>Add Medicine';
                document.getElementById('medicineIndex').value = '';
                document.getElementById('medicineForm').reset();
            });

            // Save (add or edit) medicine
            document.getElementById('medicineForm').addEventListener('submit', (e) => {
                e.preventDefault();
                const index = document.getElementById('medicineIndex').value;

                if (index === '') {
                    // Add new medicine
                    alert('Medicine added successfully!');
                } else {
                    // Edit existing medicine
                    alert('Medicine updated successfully!');
                }

                // Close modal and reset form
                bootstrap.Modal.getInstance('#medicineModal').hide();
                document.getElementById('medicineForm').reset();
                
                // In a real application, you would submit the data to the server
                // For now, we'll just reload the page
                setTimeout(() => location.reload(), 500);
            });
        });
    </script>
</body>
</html>

    <!-- View Medicine Modal -->
    <div class="modal fade" id="viewMedicineModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                    <h5 class="modal-title fw-bold d-flex align-items-center" style="font-size: 1.4rem; margin: 0;">
                        <i class="fas fa-pills me-3" style="font-size: 1.3rem;"></i>
                        Medicine Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3" id="viewMedicineContent">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer" style="background: #f8f9fc; border: none; border-radius: 0 0 20px 20px; padding: 25px 30px;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Medicine Modal -->
    <div class="modal fade" id="medicineModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <form id="medicineForm">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                        <h5 class="modal-title fw-bold d-flex align-items-center" id="medicineModalTitle" style="font-size: 1.4rem; margin: 0;">
                            <i class="fas fa-plus-circle me-3" style="font-size: 1.3rem;"></i>
                            Add Medicine
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1rem;"></button>
                    </div>
                    <div class="modal-body" style="padding: 35px 30px; background: #ffffff;">
                        <input type="hidden" id="medicineIndex">

                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-pills me-2" style="color: var(--ink-700);"></i>Medicine Name
                                </label>
                                <input type="text" class="form-control" id="medMedicineName" placeholder="Amoxicillin" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-tags me-2" style="color: var(--ink-700);"></i>Category
                                </label>
                                <select id="medCategory" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select category</option>
                                    <option>Antibiotic</option>
                                    <option>Analgesic</option>
                                    <option>Anti-inflammatory</option>
                                    <option>Supplement</option>
                                    <option>Anti-diabetic</option>
                                    <option>Anti-acid</option>
                                    <option>Antihistamine</option>
                                    <option>Antihypertensive</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-boxes me-2" style="color: var(--ink-700);"></i>Quantity (Boxes)
                                </label>
                                <input type="number" class="form-control" id="medQuantityBoxes" placeholder="8" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-capsules me-2" style="color: var(--ink-700);"></i>Capsules per Box
                                </label>
                                <input type="number" class="form-control" id="medCapsulesPerBox" placeholder="100" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-weight me-2" style="color: var(--ink-700);"></i>Strength (mg)
                                </label>
                                <input type="text" class="form-control" id="medStrength" placeholder="500 mg" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt me-2" style="color: var(--ink-700);"></i>Expiry Date
                                </label>
                                <input type="text" class="form-control" id="medExpiryDate" placeholder="Dec 2025" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-chart-line me-2" style="color: var(--ink-700);"></i>Stock Status
                                </label>
                                <select id="medStockStatus" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select stock status</option>
                                    <option>High Stock</option>
                                    <option>Low Stock</option>
                                    <option>Out of Stock</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-comment me-2" style="color: var(--ink-700);"></i>Remarks
                                </label>
                                <textarea class="form-control" id="medRemarks" rows="3" placeholder="For bacterial infections" required 
                                          style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa; resize: vertical;"></textarea>
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
                            <i class="fas fa-save me-2"></i>Save Medicine
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Sidebar toggle functionality
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('toggleSidebar');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Initialize DataTables
            const table = $('#medicineTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [10] } // Disable ordering on Action column
                ]
            });

            // Stock status filter functionality
            $('#stockFilter').on('change', function() {
                const status = $(this).val();
                if (status) {
                    table.column(8).search('^' + status + '$', true, false).draw(); // Stock Status column is at index 8
                } else {
                    table.column(8).search('').draw();
                }
            });

            // Sample data for JavaScript functions
            const medicineData = @json($medicineData);

            // View medicine function
            window.viewMedicine = function(index) {
                const med = medicineData[index];
                const content = document.getElementById('viewMedicineContent');
                
                content.innerHTML = `
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-pills me-2"></i>Medicine Name</div>
                            <div class="info-value">${med.medicine_name}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-tags me-2"></i>Category</div>
                            <div class="info-value">${med.category}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-boxes me-2"></i>Quantity (Boxes)</div>
                            <div class="info-value">${med.quantity_boxes}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-capsules me-2"></i>Capsules per Box</div>
                            <div class="info-value">${med.capsules_per_box}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-weight me-2"></i>Strength</div>
                            <div class="info-value">${med.strength}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-calculator me-2"></i>Total Capsules</div>
                            <div class="info-value">${med.total_capsules}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-calendar-alt me-2"></i>Expiry Date</div>
                            <div class="info-value">${med.expiry_date}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-chart-line me-2"></i>Stock Status</div>
                            <div class="info-value">
                                <span class="badge ${getStockStatusClass(med.stock_status)}">${med.stock_status}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-comment me-2"></i>Remarks</div>
                            <div class="info-value">${med.remarks}</div>
                        </div>
                    </div>
                `;
                
                new bootstrap.Modal('#viewMedicineModal').show();
            };

            // Edit medicine function
            window.editMedicine = function(index) {
                const med = medicineData[index];
                document.getElementById('medicineModalTitle').innerHTML = '<i class="fas fa-edit me-3" style="font-size: 1.3rem;"></i>Edit Medicine';
                document.getElementById('medicineIndex').value = index;
                document.getElementById('medMedicineName').value = med.medicine_name;
                document.getElementById('medCategory').value = med.category;
                document.getElementById('medQuantityBoxes').value = med.quantity_boxes;
                document.getElementById('medCapsulesPerBox').value = med.capsules_per_box;
                document.getElementById('medStrength').value = med.strength;
                document.getElementById('medExpiryDate').value = med.expiry_date;
                document.getElementById('medStockStatus').value = med.stock_status;
                document.getElementById('medRemarks').value = med.remarks;
                new bootstrap.Modal('#medicineModal').show();
            };

            // Delete medicine function
            window.deleteMedicine = function(index) {
                const med = medicineData[index];
                if (confirm(`Are you sure you want to delete ${med.medicine_name}?`)) {
                    // Remove from data array and reload table
                    medicineData.splice(index, 1);
                    location.reload(); // Simple reload for demo
                }
            };

            // Helper function to get stock status badge class
            function getStockStatusClass(status) {
                switch(status) {
                    case 'High Stock': return 'status-high';
                    case 'Low Stock': return 'status-low';
                    case 'Out of Stock': return 'status-out';
                    default: return 'badge-soft';
                }
            }

            // Reset modal to "Add"
            $('#medicineModal').on('hidden.bs.modal', function () {
                document.getElementById('medicineModalTitle').innerHTML = '<i class="fas fa-plus-circle me-3" style="font-size: 1.3rem;"></i>Add Medicine';
                document.getElementById('medicineIndex').value = '';
                document.getElementById('medicineForm').reset();
            });

            // Calculate total capsules automatically
            $('#medQuantityBoxes, #medCapsulesPerBox').on('input', function() {
                const quantityBoxes = parseInt($('#medQuantityBoxes').val()) || 0;
                const capsulesPerBox = parseInt($('#medCapsulesPerBox').val()) || 0;
                const totalCapsules = quantityBoxes * capsulesPerBox;
                
                // You can display this calculated value somewhere if needed
                console.log('Total Capsules:', totalCapsules);
            });

            // Save (add or edit) medicine
            document.getElementById('medicineForm').addEventListener('submit', (e) => {
                e.preventDefault();
                const index = document.getElementById('medicineIndex').value;

                if (index === '') {
                    // Add new medicine
                    alert('Medicine added successfully!');
                } else {
                    // Edit existing medicine
                    alert('Medicine updated successfully!');
                }

                // Close modal and reset form
                bootstrap.Modal.getInstance('#medicineModal').hide();
                document.getElementById('medicineForm').reset();
                
                // In a real application, you would submit the data to the server
                // For now, we'll just reload the page
                setTimeout(() => location.reload(), 500);
            });
        });
    </script>
</body>
</html>