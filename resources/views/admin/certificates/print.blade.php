<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $certificate['type'] }} - {{ $certificate['certificate_number'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/certificate-print.css') }}" rel="stylesheet">
    <style>
        :root {
            --ink-900: #0A1832;
            --ink-700: #1A3D63;
            --ink-500: #4A7FA7;
            --ink-300: #B3CFE5;
            --ink-50: #F6FAFD;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: white;
            color: var(--ink-900);
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

        .main-content {
            margin-left: 300px;
            transition: margin-left 0.3s ease;
            background-color: white;
            min-height: 100vh;
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

        .print-controls {
            margin-bottom: 1rem;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--ink-700);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--ink-900);
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            color: white;
        }

        .certificate-container {
            padding: 20px;
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
        }
    </style>
</head>
<body>
    @include('components.sidebar')

    <div class="main-content">
        <div class="top-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-white">CERTIFICATE PRINT VIEW</h1>
            </div>
            <div class="d-flex align-items-center">
                <button onclick="logoutAndRedirect()" class="leave-dashboard-btn me-3">
                    ← Leave Dashboard
                </button>
            </div>
        </div>

        <div class="certificate-container">
            <div class="print-controls">
                <a href="{{ Route::has('admin.certificates') ? route('admin.certificates') : url('/admin/certificates') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Certificate Management
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Print Certificate
                </button>
            </div>

            <div class="certificate">
                <div class="watermark">OFFICIAL</div>

                <div class="header">
                    <div class="logo"></div>
                    <h1>Republic of the Philippines</h1>
                    <h2>Province of Pangasinan</h2>
                    <h2>Municipality of Alcala</h2>
                    <p><strong>BARANGAY SAN PEDRO APARTADO</strong></p>
                    <p>Purok 3, Alcala, Pangasinan</p>
                    <p>Tel: (075) 123-4567 | Email: brgysanpedroapartado31@gmail.com</p>
                </div>

                <div class="title">
                    <h1>{{ strtoupper($certificate['type']) }}</h1>
                </div>

                <div class="cert-number">
                    <strong>Certificate No.: {{ $certificate['certificate_number'] }}</strong>
                </div>

                <div class="body-content">
                    <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                    
                    @if($certificate['type'] === 'Barangay Clearance')
                        <p>This is to certify that <span class="resident-name">{{ strtoupper($certificate['resident_name']) }}</span>, of legal age, Filipino citizen and a bonafide resident of <span class="address">{{ $certificate['address'] ?? 'Purok 3' }}</span>, Barangay San Pedro Apartado, Alcala, Pangasinan, is personally known to me to be of good moral character and law-abiding citizen in the community.</p>
                        <p>This certification is issued upon the request of the above-mentioned person for <span class="purpose">{{ strtolower($certificate['purpose']) }}</span> and for whatever legal purpose it may serve.</p>
                    @elseif($certificate['type'] === 'Certificate of Indigency')
                        <p>This is to certify that <span class="resident-name">{{ strtoupper($certificate['resident_name']) }}</span>, of legal age, Filipino citizen and a bonafide resident of <span class="address">{{ $certificate['address'] ?? 'Purok 3' }}</span>, Barangay San Pedro Apartado, Alcala, Pangasinan, belongs to an indigent family in this barangay.</p>
                        <p>This certification is issued upon the request of the above-mentioned person for <span class="purpose">{{ strtolower($certificate['purpose']) }}</span> and for whatever legal purpose it may serve.</p>
                    @else
                        <p>This is to certify that <span class="resident-name">{{ strtoupper($certificate['resident_name']) }}</span>, of legal age, Filipino citizen and a bonafide resident of <span class="address">{{ $certificate['address'] ?? 'Purok 3' }}</span>, Barangay San Pedro Apartado, Alcala, Pangasinan, is personally known to me to be of good moral character and law-abiding citizen in the community.</p>
                        <p>This certification is issued upon the request of the above-mentioned person for <span class="purpose">{{ strtolower($certificate['purpose']) }}</span> and for whatever legal purpose it may serve.</p>
                    @endif

                    
                </div>

                <div class="date-section">
                    <strong>Date Issued: {{ $certificate['date_issued'] }}</strong>
                </div>

                <div class="signatures">
                    <div class="sig-section">
                        <div class="sig-line"></div>
                        <div class="sig-title">Issued By</div>
                        <div class="sig-name">{{ strtoupper($certificate['issued_by']) }}</div>
                        <div class="sig-pos">Barangay Secretary</div>
                    </div>

                    <div class="sig-section">
                        <div class="sig-line"></div>
                        <div class="sig-title">Noted By</div>
                        <div class="sig-name">HON. [CAPTAIN NAME]</div>
                        <div class="sig-pos">Barangay Captain</div>
                    </div>
                </div>

                <div class="footer">
                    <p><strong>NOT VALID WITHOUT OFFICIAL SEAL</strong></p>
                    <p>This certificate is computer-generated and requires no signature but official dry seal.</p>
                    <p>Valid for six (6) months from date of issue unless otherwise specified.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function logoutAndRedirect() {
            if (confirm('Are you sure you want to leave the dashboard? You will need to log in again to access it.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ Route::has("logout") ? route("logout") : url("/logout") }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>