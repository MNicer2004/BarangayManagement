<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CertificateController extends Controller
{
    public function index()
    {
        // Sample certificate data
        $certificates = [
            [
                'id' => 1,
                'certificate_number' => 'BC-2025-001',
                'type' => 'Barangay Clearance',
                'resident_name' => 'Juan dela Cruz',
                'purpose' => 'Employment',
                'amount' => 50.00,
                'status' => 'Paid',
                'date_issued' => '2025-09-27',
                'issued_by' => 'Maria Santos',
            ],
            [
                'id' => 2,
                'certificate_number' => 'CI-2025-002',
                'type' => 'Certificate of Indigency',
                'resident_name' => 'Ana Reyes',
                'purpose' => 'Medical Assistance',
                'amount' => 0.00,
                'status' => 'Generated',
                'date_issued' => '2025-09-26',
                'issued_by' => 'Pedro Garcia',
            ],
            [
                'id' => 3,
                'certificate_number' => 'BP-2025-003',
                'type' => 'Business Permit',
                'resident_name' => 'Roberto Villanueva',
                'purpose' => 'Sari-sari Store',
                'amount' => 200.00,
                'status' => 'Pending Payment',
                'date_issued' => '2025-09-25',
                'issued_by' => 'Carmen Lopez',
            ],
            [
                'id' => 4,
                'certificate_number' => 'BC-2025-004',
                'type' => 'Barangay Clearance',
                'resident_name' => 'Luz Fernandez',
                'purpose' => 'Loan Application',
                'amount' => 50.00,
                'status' => 'Paid',
                'date_issued' => '2025-09-24',
                'issued_by' => 'Jose Mendoza',
            ],
            [
                'id' => 5,
                'certificate_number' => 'CI-2025-005',
                'type' => 'Certificate of Indigency',
                'resident_name' => 'Carlos Bautista',
                'purpose' => 'Educational Assistance',
                'amount' => 0.00,
                'status' => 'Generated',
                'date_issued' => '2025-09-23',
                'issued_by' => 'Teresa Cruz',
            ],
        ];

        // Certificate types and fees
        $certificateTypes = [
            'Barangay Clearance' => 50.00,
            'Certificate of Indigency' => 0.00,
            'Business Permit' => 200.00,
            'Certificate of Residency' => 30.00,
            'Barangay ID' => 25.00,
        ];

        // Statistics
        $stats = [
            'total_certificates' => count($certificates),
            'paid_certificates' => count(array_filter($certificates, fn($cert) => $cert['status'] === 'Paid')),
            'pending_payments' => count(array_filter($certificates, fn($cert) => $cert['status'] === 'Pending Payment')),
            'total_revenue' => array_sum(array_column(array_filter($certificates, fn($cert) => $cert['status'] === 'Paid'), 'amount')),
        ];

        return view('admin.certificates.index', compact('certificates', 'certificateTypes', 'stats'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'certificate_type' => 'required|string',
            'resident_name' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Generate certificate number
        $prefix = $this->getCertificatePrefix($request->certificate_type);
        $year = date('Y');
        $number = str_pad(rand(1, 9999), 3, '0', STR_PAD_LEFT);
        $certificateNumber = "{$prefix}-{$year}-{$number}";

        // Get certificate fee
        $certificateTypes = [
            'Barangay Clearance' => 50.00,
            'Certificate of Indigency' => 0.00,
            'Business Permit' => 200.00,
            'Certificate of Residency' => 30.00,
            'Barangay ID' => 25.00,
        ];

        $amount = $certificateTypes[$request->certificate_type] ?? 0.00;

        // Store certificate data in session for printing
        $certificateData = [
            'certificate_number' => $certificateNumber,
            'type' => $request->certificate_type,
            'resident_name' => $request->resident_name,
            'purpose' => $request->purpose,
            'address' => $request->address,
            'amount' => $amount,
            'date_issued' => date('F d, Y'),
            'issued_by' => auth()->user()->name ?? 'Administrator',
        ];

        session(['generated_certificate' => $certificateData]);

        return redirect()->route('admin.certificates.print', ['id' => $certificateNumber])
                         ->with('success', 'Certificate generated successfully! Proceeding to print...');
    }

    public function print($id)
    {
        $certificate = session('generated_certificate');
        
        if (!$certificate) {
            return redirect()->route('admin.certificates')->with('error', 'Certificate not found.');
        }

        return view('admin.certificates.print', compact('certificate'));
    }

    private function getCertificatePrefix($type)
    {
        $prefixes = [
            'Barangay Clearance' => 'BC',
            'Certificate of Indigency' => 'CI',
            'Business Permit' => 'BP',
            'Certificate of Residency' => 'CR',
            'Barangay ID' => 'BID',
        ];

        return $prefixes[$type] ?? 'CERT';
    }
}