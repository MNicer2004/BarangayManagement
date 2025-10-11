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
    @include('components.sidebar')

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
                    <table id="residentsTable" class="table table-striped table-hover w-100">
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
                            @forelse($residents as $resident)
                                <tr>
                                    <td>{{ $resident->name }}</td>
                                    <td>{{ $resident->national_id ?? 'N/A' }}</td>
                                    <td>{{ $resident->age ?? 'N/A' }}</td>
                                    <td>{{ $resident->birthday ? $resident->birthday->format('Y-m-d') : 'N/A' }}</td>
                                    <td>{{ $resident->civil_status ?? 'N/A' }}</td>
                                    <td>{{ $resident->gender ?? 'N/A' }}</td>
                                    <td>{{ $resident->purok ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $resident->four_ps_beneficiary ? 'bg-success' : 'bg-secondary' }} text-white">
                                            {{ $resident->four_ps_beneficiary ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $resident->pwd_status ? 'bg-warning' : 'bg-secondary' }} text-white">
                                            {{ $resident->pwd_status ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>{{ $resident->religion ?? 'N/A' }}</td>
                                    <td>{{ $resident->occupation ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $resident->voter_status ? 'voter-yes' : 'voter-no' }}">
                                            {{ $resident->voter_status ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button class="btn btn-sm btn-outline-info action-btn" data-action="view" data-id="{{ $resident->id }}" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning action-btn" data-action="edit" data-id="{{ $resident->id }}" title="Edit Resident">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger action-btn" data-action="delete" data-id="{{ $resident->id }}" title="Delete Resident">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center">No residents found</td>
                                </tr>
                            @endforelse
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
                <form id="residentForm" method="POST" action="{{ route('admin.residents.store') }}">
                    @csrf
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
                                <input type="text" class="form-control" id="fullName" name="name" placeholder="Juan Dela Cruz" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-id-card me-2" style="color: var(--ink-700);"></i>National ID
                                </label>
                                <input type="text" class="form-control" id="nationalId" name="national_id" placeholder="00000012113213" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-birthday-cake me-2" style="color: var(--ink-700);"></i>Age
                                </label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="25" min="0" max="120" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt me-2" style="color: var(--ink-700);"></i>Birthday
                                </label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-heart me-2" style="color: var(--ink-700);"></i>Civil Status
                                </label>
                                <select id="civilStatus" name="civil_status" class="form-select" required 
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
                                <select id="gender" name="gender" class="form-select" required 
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
                                <select id="purok" name="purok" class="form-select" required 
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
                                <input type="text" class="form-control" id="religion" name="religion" placeholder="Roman Catholic" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-briefcase me-2" style="color: var(--ink-700);"></i>Occupation
                                </label>
                                <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Farmer" required 
                                       style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-family me-2" style="color: var(--ink-700);"></i>4Ps Beneficiary
                                </label>
                                <select id="fourPs" name="four_ps_beneficiary" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-wheelchair me-2" style="color: var(--ink-700);"></i>PWD Status
                                </label>
                                <select id="pwd" name="pwd_status" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-vote-yea me-2" style="color: var(--ink-700);"></i>Voter Status
                                </label>
                                <select id="voterStatus" name="voter_status" class="form-select" required 
                                        style="border: 2px solid #e9ecef; border-radius: 12px; padding: 12px 16px; font-size: 0.95rem; transition: all 0.3s ease; background: #f8f9fa;">
                                    <option value="" selected disabled>Select status</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold" style="color: var(--ink-900); font-size: 0.95rem; margin-bottom: 8px;">
                                    <i class="fas fa-phone me-2" style="color: var(--ink-700);"></i>Contact Number
                                </label>
                                <input type="text" class="form-control" id="contact" name="contact_number" placeholder="09XXXXXXXXX" 
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

        // Initialize DataTable after page loads
        $(document).ready(function() {
            @if($residents->count() > 0)
            // Only initialize DataTable if there are residents
            setTimeout(function() {
                // Destroy existing instance if any
                if ($.fn.DataTable.isDataTable('#residentsTable')) {
                    $('#residentsTable').DataTable().destroy();
                }
                
                // Initialize with simple configuration
                $('#residentsTable').DataTable({
                    pageLength: 10,
                    order: [[0, 'asc']],
                    columnDefs: [
                        { orderable: false, targets: -1 }  // Disable sorting on last column (Action)
                    ],
                    autoWidth: false,
                    destroy: true
                });
            }, 100);
            @endif
        });

        // Handle action buttons with event delegation
        $(document).on('click', '.action-btn', function(e) {
            e.preventDefault();
            const action = $(this).data('action');
            const id = $(this).data('id');
            
            if (action === 'view') {
                viewResident(id);
            } else if (action === 'edit') {
                editResident(id);
            } else if (action === 'delete') {
                deleteResident(id);
            }
        });

        // View Resident
        function viewResident(id) {
            $.ajax({
                url: `/admin/residents/${id}`,
                type: 'GET',
                success: function(resident) {
                    $('#residentModalTitle').html('<i class="fas fa-eye me-3"></i>View Resident');
                    fillResidentForm(resident);
                    $('#residentForm input, #residentForm select').prop('readonly', true).prop('disabled', true);
                    $('#residentForm button[type="submit"]').hide();
                    new bootstrap.Modal('#residentModal').show();
                },
                error: function() {
                    alert('Error loading resident data');
                }
            });
        }

        // Edit Resident
        function editResident(id) {
            $.ajax({
                url: `/admin/residents/${id}`,
                type: 'GET',
                success: function(resident) {
                    $('#residentModalTitle').html('<i class="fas fa-edit me-3"></i>Edit Resident');
                    $('#residentForm').attr('action', `/admin/residents/${id}`);
                    $('#residentForm').append('<input type="hidden" name="_method" value="PUT">');
                    $('#residentForm').append('<input type="hidden" name="resident_id" value="' + id + '">');
                    fillResidentForm(resident);
                    $('#residentForm input, #residentForm select').prop('readonly', false).prop('disabled', false);
                    $('#residentForm button[type="submit"]').show();
                    new bootstrap.Modal('#residentModal').show();
                },
                error: function() {
                    alert('Error loading resident data');
                }
            });
        }

        // Delete Resident
        function deleteResident(id) {
            if (confirm('Are you sure you want to delete this resident?')) {
                const form = $('<form>', {
                    method: 'POST',
                    action: `/admin/residents/${id}`
                }).append(
                    $('<input>', {type: 'hidden', name: '_token', value: '{{ csrf_token() }}'}),
                    $('<input>', {type: 'hidden', name: '_method', value: 'DELETE'})
                );
                $('body').append(form);
                form.submit();
            }
        }

        // Fill form helper
        function fillResidentForm(resident) {
            $('#fullName').val(resident.name || '');
            $('#nationalId').val(resident.national_id || '');
            $('#age').val(resident.age || '');
            $('#birthday').val(resident.birthday || '');
            $('#civilStatus').val(resident.civil_status || '');
            $('#gender').val(resident.gender || '');
            $('#purok').val(resident.purok || '');
            $('#religion').val(resident.religion || '');
            $('#occupation').val(resident.occupation || '');
            $('#fourPs').val(resident.four_ps_beneficiary ? '1' : '0');
            $('#pwd').val(resident.pwd_status ? '1' : '0');
            $('#voterStatus').val(resident.voter_status ? '1' : '0');
            $('#contact').val(resident.contact_number || '');
        }

        // Reset form when adding new resident
        $('#residentModal').on('show.bs.modal', function(e) {
            if ($(e.relatedTarget).hasClass('btn-primary')) {
                $('#residentModalTitle').html('<i class="fas fa-user-plus me-3"></i>Add Resident');
                $('#residentForm').attr('action', '/admin/residents');
                $('#residentForm input[name="_method"]').remove();
                $('#residentForm input[name="resident_id"]').remove();
                $('#residentForm')[0].reset();
                $('#residentForm input, #residentForm select').prop('readonly', false).prop('disabled', false);
                $('#residentForm button[type="submit"]').show();
            }
        });

        // Form submission
        $('#residentForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const method = $(this).find('input[name="_method"]').val() || 'POST';
            const url = $(this).attr('action');
            
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
            
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...').prop('disabled', true);
            
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    bootstrap.Modal.getInstance(document.getElementById('residentModal')).hide();
                    alert(response.message || 'Resident saved successfully!');
                    window.location.reload();
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMsg = 'Please fix the following errors:\n\n';
                        for (const [field, messages] of Object.entries(xhr.responseJSON.errors)) {
                            errorMsg += `• ${messages.join(', ')}\n`;
                        }
                        alert(errorMsg);
                    } else {
                        alert('An error occurred while saving the resident.');
                    }
                },
                complete: function() {
                    submitBtn.html(originalText).prop('disabled', false);
                }
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
