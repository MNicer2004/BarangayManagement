<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Template: {{ $templateType }} - Barangay Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --ink-50: #f8fafc;
            --ink-100: #f1f5f9;
            --ink-200: #e2e8f0;
            --ink-300: #cbd5e1;
            --ink-400: #94a3b8;
            --ink-500: #64748b;
            --ink-600: #475569;
            --ink-700: #334155;
            --ink-800: #1e293b;
            --ink-900: #0f172a;
        }

        body {
            background: linear-gradient(135deg, var(--ink-700), var(--ink-900));
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            padding: 2rem;
            min-height: 100vh;
        }

        .editor-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .editor-header {
            background: var(--ink-700);
            color: white;
            padding: 2rem;
        }

        .editor-content {
            padding: 2rem;
        }

        .preview-card {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .certificate-preview {
            background: white;
            border: 2px solid #333;
            padding: 2rem;
            font-family: 'Times New Roman', serif;
            /* A4 Paper dimensions - 210mm x 297mm scaled down */
            width: 210mm;
            min-height: 297mm;
            max-width: 100%;
            transform: scale(0.7);
            transform-origin: top center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: relative;
        }

        @media (max-width: 1200px) {
            .certificate-preview {
                transform: scale(0.6);
            }
        }

        @media (max-width: 992px) {
            .certificate-preview {
                transform: scale(0.5);
            }
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--ink-700);
        }

        .certificate-title {
            color: var(--ink-700);
            font-weight: bold;
            font-size: 1.5rem;
            margin: 2rem 0;
            text-decoration: underline;
        }

        .certificate-body {
            text-align: justify;
            line-height: 1.8;
            font-size: 14px;
            color: #000;
            margin-bottom: 4rem;
        }

        .certificate-signature {
            text-align: right;
            margin-top: 4rem;
            color: var(--ink-700);
        }

        .signature-line {
            border-bottom: 2px solid var(--ink-700);
            width: 250px;
            margin: 0 0 0.5rem auto;
        }

        .form-label {
            font-weight: 600;
            color: var(--ink-700);
            margin-bottom: 0.5rem;
        }

        .btn-primary {
            background: var(--ink-700);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: var(--ink-800);
        }

        .btn-secondary {
            background: var(--ink-500);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
        }

        .btn-secondary:hover {
            background: var(--ink-600);
        }

        .form-control, .form-select {
            border: 2px solid var(--ink-200);
            border-radius: 8px;
            padding: 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--ink-700);
            box-shadow: 0 0 0 0.2rem rgba(51, 65, 85, 0.25);
        }

        textarea.form-control {
            min-height: 200px;
            resize: vertical;
        }

        .placeholder-hint {
            background: var(--ink-50);
            border: 1px solid var(--ink-200);
            border-radius: 4px;
            padding: 0.5rem;
            font-size: 0.875rem;
            color: var(--ink-600);
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="row">
            <div class="col-12">
                <div class="editor-card">
                    <div class="editor-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-2">
                                    <i class="fas fa-edit me-2"></i>Edit Template: {{ $templateType }}
                                </h3>
                                <p class="mb-0 opacity-75">Customize the certificate template layout and content</p>
                            </div>
                            <a href="{{ route('admin.certificates') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Certificates
                            </a>
                        </div>
                    </div>

                    <div class="editor-content">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.templates.update', $templateType) }}">
                            @csrf
                            
                            <div class="row">
                                <!-- Editor Section -->
                                <div class="col-lg-6">
                                    <h5 class="mb-4"><i class="fas fa-cog me-2"></i>Template Settings</h5>
                                    
                                    <div class="mb-4">
                                        <label for="title" class="form-label">Certificate Title</label>
                                        <input type="text" class="form-control" id="title" name="title" 
                                               value="{{ old('title', $template['title']) }}" 
                                               onkeyup="updatePreview()" required>
                                        @error('title')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="fee" class="form-label">Certificate Fee (₱)</label>
                                        <input type="number" class="form-control" id="fee" name="fee" 
                                               value="{{ old('fee', $template['fee']) }}" 
                                               step="0.01" min="0" required>
                                        @error('fee')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="content" class="form-label">Certificate Content</label>
                                        <textarea class="form-control" id="content" name="content" 
                                                  onkeyup="updatePreview()" required>{{ old('content', $template['content']) }}</textarea>
                                        @error('content')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="placeholder-hint mb-4">
                                        <strong>Available Placeholders:</strong><br>
                                        <code>[RESIDENT_NAME]</code> - Name of the resident<br>
                                        <code>[AGE]</code> - Age of the resident<br>
                                        <code>[CIVIL_STATUS]</code> - Civil status<br>
                                        <code>[DATE]</code> - Current date<br>
                                        <code>[MONTH]</code> - Current month<br>
                                        <code>[YEAR]</code> - Current year<br>
                                        <code>[BUSINESS_TYPE]</code> - Type of business (for business permits)<br>
                                        <code>[BUSINESS_ADDRESS]</code> - Business address
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Template
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="resetTemplate()">
                                            <i class="fas fa-undo me-2"></i>Reset
                                        </button>
                                    </div>
                                </div>

                                <!-- Preview Section -->
                                <div class="col-lg-6">
                                    <h5 class="mb-4"><i class="fas fa-eye me-2"></i>Live Preview</h5>
                                    
                                    <div class="preview-card">
                                        <div class="certificate-preview" id="certificatePreview">
                                            <!-- Header -->
                                            <div class="text-center" style="margin-bottom: 3rem;">
                                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                                                    <small>9/27/25, 7:47 PM</small>
                                                    <small>Barangay Clearance - BC-2025-470</small>
                                                </div>
                                                
                                                <h4 style="margin-bottom: 0.5rem; font-weight: bold; color: black;">REPUBLIC OF THE PHILIPPINES</h4>
                                                <p style="margin: 0; font-size: 14px;">Province of Pangasinan</p>
                                                <p style="margin: 0; font-size: 14px;">Municipality of Alcala</p>
                                                <p style="margin: 0; font-size: 14px; font-weight: bold;">BARANGAY SAN PEDRO APARTADO</p>
                                                <p style="margin: 0; font-size: 12px;">Purok 3, Alcala, Pangasinan</p>
                                                <p style="margin: 0; font-size: 12px;">Tel: (075) 123-4567 | Email: brgy.sanpedroapartado31@gmail.com</p>
                                                
                                                <hr style="border: 2px solid black; margin: 2rem 0;">
                                            </div>
                                            
                                            <!-- Certificate Title -->
                                            <div class="text-center" style="margin-bottom: 2rem;">
                                                <h3 id="previewTitle" style="font-weight: bold; text-decoration: underline; color: black; letter-spacing: 2px;">{{ $template['title'] }}</h3>
                                                <p style="margin-top: 1rem; font-size: 14px;">Certificate No.: BC-2025-470</p>
                                            </div>
                                            
                                            <!-- Certificate Body -->
                                            <div style="text-align: justify; line-height: 1.6; margin-bottom: 3rem;">
                                                <p style="font-weight: bold; margin-bottom: 1.5rem;">TO WHOM IT MAY CONCERN:</p>
                                                <div id="previewContent" style="white-space: pre-line; text-indent: 2rem;">{{ $template['content'] }}</div>
                                                <div style="text-align: right; margin-top: 2rem;">
                                                    <p><strong>Date Issued: September 27, 2025</strong></p>
                                                </div>
                                            </div>
                                            
                                            <!-- Signatures -->
                                            <div style="display: flex; justify-content: space-between; margin-top: 4rem; margin-bottom: 3rem;">
                                                <div style="text-align: center; width: 45%;">
                                                    <div style="border-bottom: 2px solid black; margin-bottom: 0.5rem; height: 50px;"></div>
                                                    <p style="margin: 0; font-weight: bold;">ISSUED BY:</p>
                                                    <p style="margin: 0; font-weight: bold;">BARANGAY CAPTAIN</p>
                                                    <p style="margin: 0; font-size: 12px;">Barangay Officials</p>
                                                </div>
                                                <div style="text-align: center; width: 45%;">
                                                    <div style="border-bottom: 2px solid black; margin-bottom: 0.5rem; height: 50px;"></div>
                                                    <p style="margin: 0; font-weight: bold;">NOTED BY:</p>
                                                    <p style="margin: 0; font-weight: bold;">HON. [CAPTAIN NAME]</p>
                                                    <p style="margin: 0; font-size: 12px;">Barangay Captain</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Footer -->
                                            <div style="text-align: center; border-top: 2px solid black; padding-top: 1rem;">
                                                <p style="margin: 0; font-weight: bold; font-size: 12px;">NOT VALID WITHOUT OFFICIAL SEAL</p>
                                                <p style="margin: 0.5rem 0; font-size: 11px;">This certificate is computer-generated and requires no signature but official dry seal.</p>
                                                <p style="margin: 0; font-size: 11px;">Valid for one (1) month from date of issue unless otherwise specified.</p>
                                            </div>
                                            
                                            <!-- Bottom Info -->
                                            <div style="display: flex; justify-content: space-between; margin-top: 2rem; font-size: 10px;">
                                                <span>127.0.0.1:8000/admin/certificates/print/BC-2025-003</span>
                                                <span>1/2</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updatePreview() {
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            
            document.getElementById('previewTitle').textContent = title;
            document.getElementById('previewContent').textContent = content;
        }

        function resetTemplate() {
            if (confirm('Are you sure you want to reset the template to its original content?')) {
                document.getElementById('title').value = '{{ $template['title'] }}';
                document.getElementById('content').value = `{{ $template['content'] }}`;
                document.getElementById('fee').value = '{{ $template['fee'] }}';
                updatePreview();
            }
        }

        // Initialize preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePreview();
        });
    </script>
</body>
</html>