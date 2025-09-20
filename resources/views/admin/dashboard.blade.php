<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BM SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .stats-card {
            background: var(--ink-500);
            border: none;
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
                            <img src="/assets/images/logo.png" class="sidebar-logo" alt="BM System Logo">
                        </div>
                        <div>
                            <span class="fw-bold text-white fs-5 d-block">BM SYSTEM</span>
                            <small class="text-light opacity-75">Barangay Management</small>
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                    <i class="fas fa-tachometer-alt me-3"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users me-3"></i> Brgy Officials and Staff
                </a>
                <a href="#" class="nav-link">
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
                <a href="#" class="nav-link">
                    <i class="fas fa-gavel me-3"></i> Crime / Blotter Records
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-folder-open me-3"></i> Requested Documents
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-house-user me-3"></i> Purok & Household Record
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-pills me-3"></i> Inventory Medicines
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
                <h1 class="h3 mb-0 text-white">DASHBOARD</h1>
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

        <!-- Dashboard Content -->
        <div class="p-4">
            <div class="alert alert-success mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong>
                    <span class="ms-2">You have successfully logged in to Automated Brgy Management System!</span>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="main-label">POPULATION</div>
                        <div class="main-number">{{ $stats['population'] }}</div>
                        <div class="description">Total Population</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-male"></i>
                        </div>
                        <div class="main-label">MALE</div>
                        <div class="main-number">{{ $stats['male'] }}</div>
                        <div class="description">Total Male</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-female"></i>
                        </div>
                        <div class="main-label">FEMALE</div>
                        <div class="main-number">{{ $stats['female'] }}</div>
                        <div class="description">Total Female</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-vote-yea"></i>
                        </div>
                        <div class="main-label">VOTERS</div>
                        <div class="main-number">{{ $stats['voters'] }}</div>
                        <div class="description">Total Voters</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div class="main-label">NON VOTERS</div>
                        <div class="main-number">{{ $stats['non_voters'] }}</div>
                        <div class="description">Total Non Voters</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div class="main-label">PRECINCT</div>
                        <div class="main-number">{{ $stats['precinct'] }}</div>
                        <div class="description">Precinct Information</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="main-label">PUROK</div>
                        <div class="main-number">{{ $stats['purok'] }}</div>
                        <div class="description">Purok Information</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="main-label">BLOTTER</div>
                        <div class="main-number">{{ $stats['blotter'] }}</div>
                        <div class="description">Blotter Information</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="icon-container">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="main-label">REVENUE</div>
                        <div class="main-number">₱{{ number_format($stats['revenue'], 0) }}</div>
                        <div class="description">All Revenue</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    </script>
</body>
</html>
