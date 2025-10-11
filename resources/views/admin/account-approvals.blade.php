<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approvals - BM SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stats-card .icon-container i {
            font-size: 1.5rem;
            color: white;
        }

        .stats-card .main-label {
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
            opacity: 0.9;
        }

        .stats-card .main-number {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.75rem;
        }

        .stats-card .description {
            font-size: 0.9rem;
            opacity: 0.8;
            margin: 0;
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

        .table-container {
            background: var(--ink-50);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid var(--ink-300);
        }

        .table-container h5 {
            color: var(--ink-700);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .table th {
            background: var(--ink-700);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            border-top: 1px solid var(--ink-300);
            color: var(--ink-900) !important;
            background-color: white !important;
        }

        .table tbody tr {
            background-color: white !important;
        }

        .table tbody tr td strong {
            color: var(--ink-900) !important;
        }

        .btn-action {
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-approve {
            background: #198754;
            color: white;
        }

        .btn-approve:hover {
            background: #157347;
            transform: translateY(-2px);
        }

        .btn-reject {
            background: #dc3545;
            color: white;
        }

        .btn-reject:hover {
            background: #b02a37;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #6c757d;
            color: white;
        }

        .btn-delete:hover {
            background: #545b62;
            transform: translateY(-2px);
        }

        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .status-staff {
            background: var(--ink-300);
            color: var(--ink-700);
        }

        .status-captain {
            background: #ffc107;
            color: #212529;
        }

        .status-bhw {
            background: #28a745;
            color: white;
        }

        .status-bhw {
            background: #28a745;
            color: white;
        }

        /* Ensure all table text is visible */
        .table-container .table td,
        .table-container .table td *,
        .table-container .table tbody tr td {
            color: var(--ink-900) !important;
        }

        .table-container .table {
            color: var(--ink-900) !important;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--ink-500);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--ink-300);
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
            <a href="{{ route('admin.medicine') }}" class="nav-link">
                <i class="fas fa-pills me-3"></i> Medicine Inventory
            </a>
            
            @if(Auth::check() && Auth::user()->isCaptain())
                <div class="px-3 py-2 mt-3">
                    <small class="text-light opacity-75">ADMINISTRATION</small>
                </div>
                <a href="{{ Route::has('admin.account-approvals') ? route('admin.account-approvals') : url('/admin/account-approvals') }}" class="nav-link active">
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
                <h1 class="h3 mb-0 text-white">ACCOUNT APPROVALS</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="main-label">Pending Approvals</div>
                        <div class="main-number">{{ $pendingUsers->count() }}</div>
                        <div class="description">Awaiting review</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="main-label">Recent Approvals</div>
                        <div class="main-number">{{ $approvedUsers->count() }}</div>
                        <div class="description">Last 10 approved</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="main-label">Recent Rejections</div>
                        <div class="main-number">{{ $rejectedUsers->count() }}</div>
                        <div class="description">Last 5 rejected</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="main-label">Total Active Users</div>
                        <div class="main-number">{{ App\Models\User::where('approval_status', 'approved')->count() }}</div>
                        <div class="description">Approved accounts</div>
                    </div>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="table-container mb-4">
                <h5><i class="fas fa-clock me-2"></i>Pending Account Approvals</h5>
                @if($pendingUsers->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Requested</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingUsers as $user)
                                    <tr>
                                        <td><strong>{{ $user->role === 'captain' ? 'Ador G. Espiritu' : $user->name }}</strong></td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $user->role }}">
                                                @if($user->role === 'captain')
                                                    Barangay Captain
                                                @elseif($user->role === 'staff')
                                                    Barangay Secretary
                                                @elseif($user->role === 'bhw')
                                                    BHW
                                                @else
                                                    {{ ucfirst($user->role) }}
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y \a\t g:i A') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <form method="POST" action="{{ route('admin.account-approvals.approve', $user) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-action btn-approve" 
                                                            onclick="return confirm('Approve this account for {{ $user->name }}?')">
                                                        <i class="fas fa-check me-1"></i>Approve
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.account-approvals.reject', $user) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-action btn-reject" 
                                                            onclick="return confirm('Reject this account for {{ $user->name }}?')">
                                                        <i class="fas fa-times me-1"></i>Reject
                                                    </button>
                                                </form>
                                                @if($user->role !== 'captain')
                                                <form method="POST" action="{{ route('admin.account-approvals.delete', $user) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-action btn-delete" 
                                                            onclick="return confirm('Permanently delete account for {{ $user->name }}? This action cannot be undone.')">
                                                        <i class="fas fa-trash me-1"></i>Delete
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <h5>No pending approvals</h5>
                        <p>All account requests have been processed.</p>
                    </div>
                @endif
            </div>

            <!-- Recent Activity -->
            <div class="row">
                @if($approvedUsers->count() > 0)
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="table-container">
                            <h5><i class="fas fa-user-check me-2"></i>Recently Approved</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Approved</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($approvedUsers as $user)
                                            <tr>
                                                <td><strong>{{ $user->role === 'captain' ? 'Ador G. Espiritu' : $user->name }}</strong></td>
                                                <td><span class="status-badge status-{{ $user->role }}">
                                                    @if($user->role === 'captain')
                                                        Barangay Captain
                                                    @elseif($user->role === 'staff')
                                                        Barangay Secretary
                                                    @elseif($user->role === 'bhw')
                                                        BHW
                                                    @else
                                                        {{ ucfirst($user->role) }}
                                                    @endif
                                                </span></td>
                                                <td>{{ $user->updated_at->format('M d, Y') }}</td>
                                                <td>
                                                    @if($user->role !== 'captain')
                                                    <form method="POST" action="{{ route('admin.account-approvals.delete', $user) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-action btn-delete btn-sm" 
                                                                onclick="return confirm('Permanently delete account for {{ $user->name }}? This action cannot be undone.')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @else
                                                        <span class="text-muted"><i class="fas fa-shield-alt me-1"></i>Protected Account</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                @if($rejectedUsers->count() > 0)
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="table-container">
                            <h5><i class="fas fa-user-times me-2"></i>Recently Rejected</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Rejected</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rejectedUsers as $user)
                                            <tr>
                                                <td><strong>{{ $user->role === 'captain' ? 'Ador G. Espiritu' : $user->name }}</strong></td>
                                                <td><span class="status-badge status-{{ $user->role }}">
                                                    @if($user->role === 'captain')
                                                        Barangay Captain
                                                    @elseif($user->role === 'staff')
                                                        Barangay Secretary
                                                    @elseif($user->role === 'bhw')
                                                        BHW
                                                    @else
                                                        {{ ucfirst($user->role) }}
                                                    @endif
                                                </span></td>
                                                <td>{{ $user->updated_at->format('M d, Y') }}</td>
                                                <td>
                                                    @if($user->role !== 'captain')
                                                    <form method="POST" action="{{ route('admin.account-approvals.delete', $user) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-action btn-delete btn-sm" 
                                                                onclick="return confirm('Permanently delete account for {{ $user->name }}? This action cannot be undone.')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @else
                                                        <span class="text-muted"><i class="fas fa-shield-alt me-1"></i>Protected Account</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerMenu = document.getElementById('burgerMenu');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const closeSidebar = document.getElementById('closeSidebar');

            function toggleSidebar() {
                sidebar.classList.toggle('hidden');
                mainContent.classList.toggle('expanded');
            }

            burgerMenu.addEventListener('click', toggleSidebar);
            closeSidebar.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && 
                    !sidebar.contains(e.target) && 
                    !burgerMenu.contains(e.target) && 
                    !sidebar.classList.contains('hidden')) {
                    sidebar.classList.add('hidden');
                    mainContent.classList.add('expanded');
                }
            });
        });

        function logoutAndRedirect() {
            if (confirm('Are you sure you want to leave the dashboard? You will need to log in again to access it.')) {
                // Create a form and submit it for logout
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