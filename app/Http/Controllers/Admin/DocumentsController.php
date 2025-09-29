<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index()
    {
        // Sample documents data with different statuses
        $documentsData = [
            [
                'id' => 1,
                'name' => 'John Cena',
                'document_type' => 'Barangay Clearance',
                'pickup_date' => '09-10-2025',
                'payment_method' => 'Cash on Pick Up',
                'reference_no' => 'REF001',
                'purpose' => 'Multi Purpose',
                'date_requested' => '09-10-2025',
                'status' => 'Released',
                'tracking_code' => '91b-31h'
            ],
            [
                'id' => 2,
                'name' => 'Maria Santos',
                'document_type' => 'Residency Certificate',
                'pickup_date' => '09-11-2025',
                'payment_method' => 'GCash',
                'reference_no' => 'REF002',
                'purpose' => 'Employment',
                'date_requested' => '09-09-2025',
                'status' => 'Pick Up Ready',
                'tracking_code' => '82c-42i'
            ],
            [
                'id' => 3,
                'name' => 'Pedro Dela Cruz',
                'document_type' => 'Barangay Business Permit',
                'pickup_date' => '09-12-2025',
                'payment_method' => 'Cash on Pick Up',
                'reference_no' => 'REF003',
                'purpose' => 'Applying ng trabaho',
                'date_requested' => '09-08-2025',
                'status' => 'Processing',
                'tracking_code' => '73d-53j'
            ],
            [
                'id' => 4,
                'name' => 'Ana Rodriguez',
                'document_type' => 'Certificate of Indigency',
                'pickup_date' => '09-13-2025',
                'payment_method' => 'PayMaya',
                'reference_no' => 'REF004',
                'purpose' => 'School Requirements',
                'date_requested' => '09-07-2025',
                'status' => 'Pending',
                'tracking_code' => '64e-64k'
            ],
            [
                'id' => 5,
                'name' => 'Carlos Mendoza',
                'document_type' => 'Barangay Clearance',
                'pickup_date' => '09-14-2025',
                'payment_method' => 'Cash on Pick Up',
                'reference_no' => 'REF005',
                'purpose' => 'Passport Application',
                'date_requested' => '09-06-2025',
                'status' => 'Released',
                'tracking_code' => '55f-75l'
            ],
            [
                'id' => 6,
                'name' => 'Isabella Garcia',
                'document_type' => 'Residency Certificate',
                'pickup_date' => '09-15-2025',
                'payment_method' => 'Bank Transfer',
                'reference_no' => 'REF006',
                'purpose' => 'Visa Application',
                'date_requested' => '09-05-2025',
                'status' => 'Pick Up Ready',
                'tracking_code' => '46g-86m'
            ],
            [
                'id' => 7,
                'name' => 'Roberto Silva',
                'document_type' => 'Barangay Business Permit',
                'pickup_date' => '09-16-2025',
                'payment_method' => 'Cash on Pick Up',
                'reference_no' => 'REF007',
                'purpose' => 'Business Permit',
                'date_requested' => '09-04-2025',
                'status' => 'Processing',
                'tracking_code' => '37h-97n'
            ],
            [
                'id' => 8,
                'name' => 'Sofia Reyes',
                'document_type' => 'Certificate of Indigency',
                'pickup_date' => '09-17-2025',
                'payment_method' => 'GCash',
                'reference_no' => 'REF008',
                'purpose' => 'Multi Purpose',
                'date_requested' => '09-03-2025',
                'status' => 'Pending',
                'tracking_code' => '28i-08o'
            ]
        ];

        // Calculate statistics
        $statistics = [
            'total' => count($documentsData),
            'released' => count(array_filter($documentsData, fn($doc) => $doc['status'] === 'Released')),
            'ready' => count(array_filter($documentsData, fn($doc) => $doc['status'] === 'Pick Up Ready')),
            'processing' => count(array_filter($documentsData, fn($doc) => $doc['status'] === 'Processing')),
            'pending' => count(array_filter($documentsData, fn($doc) => $doc['status'] === 'Pending'))
        ];

        return view('admin.documents.index', compact('documentsData', 'statistics'));
    }
}