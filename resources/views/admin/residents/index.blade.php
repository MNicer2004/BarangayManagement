<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residents Record - BM SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/residents.css') }}?v={{ time() }}">
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
            <a href="{{ route('admin.officials') }}" class="nav-link">
                <i class="fas fa-users me-3"></i> Brgy Officials and Staff
            </a>
            <a href="{{ route('admin.residents') }}" class="nav-link active">
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
                <h1 class="h3 mb-0 text-white">RESIDENTS RECORD</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Residents Content -->
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
                    <h5 class="m-0 fw-bold">Current Residents</h5>
                    <button class="btn btn-primary fw-bold btn-pill" data-bs-toggle="modal" data-bs-target="#residentModal">
                        <i class="bi bi-plus-circle me-1"></i> Add Resident
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="residentsTable" class="w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>National ID</th>
                                <th>Age</th>
                                <th>Birthday</th>
                                <th>Civil Status</th>
                                <th>Gender</th>
                                <th>Purok</th>
                                <th>4Ps</th>
                                <th>PWD</th>
                                <th>Religion</th>
                                <th>Occupation</th>
                                <th>Voter Status</th>
                                <th style="width: 120px;">Action</th>
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

    {{-- Enhanced Add/Edit Resident Modal --}}
    <div class="modal fade" id="residentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <form id="residentForm">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                        <h5 class="modal-title fw-bold d-flex align-items-center" id="residentModalTitle" style="font-size: 1.4rem; margin: 0;">
                            <i class="fas fa-user-plus me-3" style="font-size: 1.3rem;"></i>
                            Add Resident
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
                                    <i class="fas fa-id-card me-2" style="color: var(--ink-700);"></i>National ID
                                </label>
                                <input type="text" class="form-control" id="nationalId" placeholder="00000012113213" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-birthday-cake me-2" style="color: var(--ink-700);"></i>Age
                                </label>
                                <input type="number" class="form-control" id="age" placeholder="25" min="0" max="120" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt me-2" style="color: var(--ink-700);"></i>Birthday
                                </label>
                                <input type="date" class="form-control" id="birthday" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-heart me-2" style="color: var(--ink-700);"></i>Civil Status
                                </label>
                                <select id="civilStatus" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Widowed</option>
                                    <option>Divorced</option>
                                    <option>Separated</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-venus-mars me-2" style="color: var(--ink-700);"></i>Gender
                                </label>
                                <select id="gender" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-map-marker-alt me-2" style="color: var(--ink-700);"></i>Purok
                                </label>
                                <select id="purok" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select purok</option>
                                    <option>Purok 1</option>
                                    <option>Purok 2</option>
                                    <option>Purok 3</option>
                                    <option>Purok 4</option>
                                    <option>Purok 5</option>
                                    <option>Purok 6</option>
                                    <option>Purok 7</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-pray me-2" style="color: var(--ink-700);"></i>Religion
                                </label>
                                <input type="text" class="form-control" id="religion" placeholder="Roman Catholic" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-briefcase me-2" style="color: var(--ink-700);"></i>Occupation
                                </label>
                                <input type="text" class="form-control" id="occupation" placeholder="Farmer" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-family me-2" style="color: var(--ink-700);"></i>4Ps Beneficiary
                                </label>
                                <select id="fourPs" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-wheelchair me-2" style="color: var(--ink-700);"></i>PWD Status
                                </label>
                                <select id="pwd" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-vote-yea me-2" style="color: var(--ink-700);"></i>Voter Status
                                </label>
                                <select id="voterStatus" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-phone me-2" style="color: var(--ink-700);"></i>Contact Number
                                </label>
                                <input type="text" class="form-control" id="contact" placeholder="09XXXXXXXXX" 
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
                            <i class="fas fa-save me-2"></i>Save Resident
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Resident Modal --}}
    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg" style="background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); border: none; border-radius: 20px;">
                <div class="modal-header" style="background: linear-gradient(135deg, var(--ink-900) 0%, #2c3e50 100%); color: white; border-radius: 20px 20px 0 0; border: none; padding: 25px 30px;">
                    <h5 class="modal-title fw-bold d-flex align-items-center" style="font-size: 1.4rem; margin: 0;">
                        <i class="fas fa-eye me-3" style="font-size: 1.3rem;"></i>
                        View Resident Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1rem;"></button>
                </div>
                <div class="modal-body" style="padding: 35px 30px; background: #ffffff;">
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-user me-2" style="color: var(--ink-700);"></i>Full Name
                            </label>
                            <input type="text" class="form-control" id="viewFullName" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-id-card me-2" style="color: var(--ink-700);"></i>National ID
                            </label>
                            <input type="text" class="form-control" id="viewNationalId" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-birthday-cake me-2" style="color: var(--ink-700);"></i>Age
                            </label>
                            <input type="text" class="form-control" id="viewAge" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-calendar-alt me-2" style="color: var(--ink-700);"></i>Birthday
                            </label>
                            <input type="text" class="form-control" id="viewBirthday" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-heart me-2" style="color: var(--ink-700);"></i>Civil Status
                            </label>
                            <input type="text" class="form-control" id="viewCivilStatus" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-venus-mars me-2" style="color: var(--ink-700);"></i>Gender
                            </label>
                            <input type="text" class="form-control" id="viewGender" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-map-marker-alt me-2" style="color: var(--ink-700);"></i>Purok
                            </label>
                            <input type="text" class="form-control" id="viewPurok" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-pray me-2" style="color: var(--ink-700);"></i>Religion
                            </label>
                            <input type="text" class="form-control" id="viewReligion" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-briefcase me-2" style="color: var(--ink-700);"></i>Occupation
                            </label>
                            <input type="text" class="form-control" id="viewOccupation" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-family me-2" style="color: var(--ink-700);"></i>4Ps Beneficiary
                            </label>
                            <input type="text" class="form-control" id="viewFourPs" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-wheelchair me-2" style="color: var(--ink-700);"></i>PWD Status
                            </label>
                            <input type="text" class="form-control" id="viewPwd" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-vote-yea me-2" style="color: var(--ink-700);"></i>Voter Status
                            </label>
                            <input type="text" class="form-control" id="viewVoterStatus" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                <i class="fas fa-phone me-2" style="color: var(--ink-700);"></i>Contact Number
                            </label>
                            <input type="text" class="form-control" id="viewContact" readonly 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; background: #f8f9fa;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: #f8f9fc; border: none; border-radius: 0 0 20px 20px; padding: 25px 30px; justify-content: center;">
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

        // Residents table functionality
        (() => {
            // Demo dataset – replace with server data later
            const seed = [
                { name:'USER USER', nationalId:'00000012113213', age:13, birthday:'2010-01-15', civilStatus:'Single', gender:'Male', purok:'Purok 1', fourPs:'No', pwd:'No', religion:'Roman Catholic', occupation:'Student', voterStatus:'No', contact:'09123456789' },
                { name:'USER', nationalId:'00000012113213', age:27, birthday:'1996-05-20', civilStatus:'Single', gender:'Male', purok:'Purok 2', fourPs:'Yes', pwd:'No', religion:'Born Again', occupation:'Farmer', voterStatus:'No', contact:'09123456790' },
                { name:'USER', nationalId:'00000012113213', age:31, birthday:'1992-12-10', civilStatus:'Single', gender:'Male', purok:'Purok 3', fourPs:'No', pwd:'No', religion:'Iglesia ni Cristo', occupation:'Driver', voterStatus:'Yes', contact:'09123456791' },
                { name:'USER', nationalId:'00000012113213', age:41, birthday:'1982-08-05', civilStatus:'Married', gender:'Male', purok:'Purok 4', fourPs:'Yes', pwd:'Yes', religion:'Roman Catholic', occupation:'Carpenter', voterStatus:'No', contact:'09123456792' },
                { name:'USER', nationalId:'00000012113213', age:31, birthday:'1992-03-25', civilStatus:'Single', gender:'Female', purok:'Purok 5', fourPs:'No', pwd:'No', religion:'Methodist', occupation:'Teacher', voterStatus:'Yes', contact:'09123456793' },
                { name:'Maria Santos', nationalId:'00000012113214', age:28, birthday:'1995-11-18', civilStatus:'Married', gender:'Female', purok:'Purok 6', fourPs:'Yes', pwd:'No', religion:'Roman Catholic', occupation:'Housewife', voterStatus:'Yes', contact:'09123456794' },
                { name:'Jose Garcia', nationalId:'00000012113215', age:45, birthday:'1978-07-12', civilStatus:'Married', gender:'Male', purok:'Purok 7', fourPs:'No', pwd:'No', religion:'Seventh Day Adventist', occupation:'Businessman', voterStatus:'Yes', contact:'09123456795' },
            ];

            let rows = [...seed];
            let dt;

            const voterBadge = (status) => {
                return `<span class="badge ${status==='Yes' ? 'voter-yes' : 'voter-no'}">${status}</span>`;
            };

            const statusBadge = (status, type) => {
                const colorMap = {
                    'fourPs': status === 'Yes' ? 'bg-success' : 'bg-secondary',
                    'pwd': status === 'Yes' ? 'bg-warning' : 'bg-secondary'
                };
                return `<span class="badge ${colorMap[type]} text-white">${status}</span>`;
            };

            function renderTable(){
                const tbody = document.querySelector('#residentsTable tbody');
                tbody.innerHTML = '';
                rows.forEach((r, idx) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${r.name}</td>
                        <td>${r.nationalId}</td>
                        <td>${r.age}</td>
                        <td>${r.birthday || 'N/A'}</td>
                        <td>${r.civilStatus}</td>
                        <td>${r.gender}</td>
                        <td>${r.purok || 'N/A'}</td>
                        <td>${statusBadge(r.fourPs || 'No', 'fourPs')}</td>
                        <td>${statusBadge(r.pwd || 'No', 'pwd')}</td>
                        <td>${r.religion || 'N/A'}</td>
                        <td>${r.occupation || 'N/A'}</td>
                        <td>${voterBadge(r.voterStatus)}</td>
                        <td class="text-center">
                            <div class="action-buttons d-flex justify-content-center">
                                <button class="btn btn-view btn-sm" data-action="view" data-idx="${idx}" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-sm" data-action="edit" data-idx="${idx}" title="Edit Resident">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-delete btn-sm" data-action="remove" data-idx="${idx}" title="Delete Resident">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

                // (Re)init DataTable
                if (dt) dt.destroy();
                dt = new $.fn.dataTable.Api($('#residentsTable').DataTable({
                    pageLength: 10,
                    lengthMenu: [5,10,25,50],
                    order: [[0,'asc']],
                    columnDefs: [
                        { orderable:false, targets: [12] }
                    ],
                    scrollX: true,
                    responsive: true
                }));

                // Bind button actions
                document.querySelectorAll('[data-action]').forEach(a => {
                    a.addEventListener('click', (e) => {
                        e.preventDefault();
                        const idx = +a.dataset.idx;
                        const act = a.dataset.action;
                        if (act === 'view') viewResident(idx);
                        if (act === 'edit') openEdit(idx);
                        if (act === 'remove') removeRow(idx);
                    });
                });
            }

            function viewResident(index){
                const r = rows[index];
                // Populate the view modal with resident data
                document.getElementById('viewFullName').value = r.name;
                document.getElementById('viewNationalId').value = r.nationalId || '';
                document.getElementById('viewAge').value = r.age || '';
                document.getElementById('viewBirthday').value = r.birthday || 'N/A';
                document.getElementById('viewCivilStatus').value = r.civilStatus || '';
                document.getElementById('viewGender').value = r.gender || '';
                document.getElementById('viewPurok').value = r.purok || 'N/A';
                document.getElementById('viewReligion').value = r.religion || 'N/A';
                document.getElementById('viewOccupation').value = r.occupation || 'N/A';
                document.getElementById('viewFourPs').value = r.fourPs || 'No';
                document.getElementById('viewPwd').value = r.pwd || 'No';
                document.getElementById('viewVoterStatus').value = r.voterStatus || '';
                document.getElementById('viewContact').value = r.contact || 'N/A';
                new bootstrap.Modal('#viewModal').show();
            }

            function openEdit(index){
                const r = rows[index];
                document.getElementById('residentModalTitle').innerHTML = '<i class="fas fa-user-edit me-3" style="font-size: 1.3rem;"></i>Edit Resident';
                document.getElementById('rowIndex').value = index;
                document.getElementById('fullName').value = r.name;
                document.getElementById('nationalId').value = r.nationalId || '';
                document.getElementById('age').value = r.age || '';
                document.getElementById('birthday').value = r.birthday || '';
                document.getElementById('civilStatus').value = r.civilStatus || '';
                document.getElementById('gender').value = r.gender || '';
                document.getElementById('purok').value = r.purok || '';
                document.getElementById('fourPs').value = r.fourPs || '';
                document.getElementById('pwd').value = r.pwd || '';
                document.getElementById('religion').value = r.religion || '';
                document.getElementById('occupation').value = r.occupation || '';
                document.getElementById('voterStatus').value = r.voterStatus || '';
                document.getElementById('contact').value = r.contact || '';
                new bootstrap.Modal('#residentModal').show();
            }

            function removeRow(index){
                if (confirm('Are you sure you want to remove this resident?')) {
                    rows.splice(index, 1);
                    renderTable();
                }
            }

            // Reset modal to "Add"
            document.getElementById('residentModal').addEventListener('show.bs.modal', (e) => {
                if (e.relatedTarget && e.relatedTarget.getAttribute('data-bs-target') === '#residentModal') {
                    document.getElementById('residentModalTitle').innerHTML = '<i class="fas fa-user-plus me-3" style="font-size: 1.3rem;"></i>Add Resident';
                    document.getElementById('rowIndex').value = '';
                    document.getElementById('residentForm').reset();
                }
            });

            // Save (add or edit)
            document.getElementById('residentForm').addEventListener('submit', (e) => {
                e.preventDefault();
                const idx = document.getElementById('rowIndex').value;
                const payload = {
                    name: document.getElementById('fullName').value.trim(),
                    nationalId: document.getElementById('nationalId').value.trim(),
                    age: document.getElementById('age').value,
                    birthday: document.getElementById('birthday').value,
                    civilStatus: document.getElementById('civilStatus').value,
                    gender: document.getElementById('gender').value,
                    purok: document.getElementById('purok').value,
                    fourPs: document.getElementById('fourPs').value,
                    pwd: document.getElementById('pwd').value,
                    religion: document.getElementById('religion').value.trim(),
                    occupation: document.getElementById('occupation').value.trim(),
                    voterStatus: document.getElementById('voterStatus').value,
                    contact: document.getElementById('contact').value.trim(),
                };
                
                // Basic validation
                if (!payload.name || !payload.nationalId || !payload.age || !payload.birthday || 
                    !payload.civilStatus || !payload.gender || !payload.purok || !payload.fourPs || 
                    !payload.pwd || !payload.religion || !payload.occupation || !payload.voterStatus) {
                    alert('Please fill in all required fields.');
                    return;
                }

                if (idx === '') rows.unshift(payload);     // add new at top
                else rows[idx] = payload;                  // update

                bootstrap.Modal.getInstance(document.getElementById('residentModal')).hide();
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
