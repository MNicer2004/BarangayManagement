<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        // Sample medicine data based on the provided table
        $medicineData = [
            [
                'id' => 1,
                'medicine_name' => 'Amoxicillin',
                'category' => 'Antibiotic',
                'quantity_boxes' => 8,
                'capsules_per_box' => 100,
                'strength' => '500 mg',
                'total_capsules' => 800,
                'expiry_date' => 'Dec 2025',
                'stock_status' => 'In Stock',
                'remarks' => 'For bacterial infections'
            ],
            [
                'id' => 2,
                'medicine_name' => 'Paracetamol',
                'category' => 'Analgesic',
                'quantity_boxes' => 4,
                'capsules_per_box' => 100,
                'strength' => '500 mg',
                'total_capsules' => 400,
                'expiry_date' => 'Jan 2026',
                'stock_status' => 'Low Stock',
                'remarks' => 'For Fever & Pain'
            ],
            [
                'id' => 3,
                'medicine_name' => 'Ibuprofen',
                'category' => 'Anti-inflammatory',
                'quantity_boxes' => 10,
                'capsules_per_box' => 50,
                'strength' => '200 mg',
                'total_capsules' => 500,
                'expiry_date' => 'Nov 2025',
                'stock_status' => 'In Stock',
                'remarks' => 'For pain & inflammation'
            ],
            [
                'id' => 4,
                'medicine_name' => 'Vitamin C',
                'category' => 'Supplement',
                'quantity_boxes' => 3,
                'capsules_per_box' => 120,
                'strength' => '500 mg',
                'total_capsules' => 360,
                'expiry_date' => 'Oct 2025',
                'stock_status' => 'Low Stock',
                'remarks' => 'For immune system'
            ],
            [
                'id' => 5,
                'medicine_name' => 'Metformin',
                'category' => 'Anti-diabetic',
                'quantity_boxes' => 6,
                'capsules_per_box' => 60,
                'strength' => '850 mg',
                'total_capsules' => 360,
                'expiry_date' => 'Mar 2026',
                'stock_status' => 'In Stock',
                'remarks' => 'For diabetes'
            ],
            [
                'id' => 6,
                'medicine_name' => 'Omeprazole',
                'category' => 'Anti-acid',
                'quantity_boxes' => 2,
                'capsules_per_box' => 100,
                'strength' => '20 mg',
                'total_capsules' => 200,
                'expiry_date' => 'Aug 2026',
                'stock_status' => 'Low Stock',
                'remarks' => 'For hyperacidity'
            ],
            [
                'id' => 7,
                'medicine_name' => 'Cetirizine',
                'category' => 'Antihistamine',
                'quantity_boxes' => 5,
                'capsules_per_box' => 100,
                'strength' => '10 mg',
                'total_capsules' => 500,
                'expiry_date' => 'Sep 2025',
                'stock_status' => 'In Stock',
                'remarks' => 'For allergies'
            ],
            [
                'id' => 8,
                'medicine_name' => 'Losartan',
                'category' => 'Antihypertensive',
                'quantity_boxes' => 4,
                'capsules_per_box' => 60,
                'strength' => '50 mg',
                'total_capsules' => 240,
                'expiry_date' => 'Jun 2026',
                'stock_status' => 'Low Stock',
                'remarks' => 'For high blood pressure'
            ]
        ];

        return view('admin.medicine.index', ['medicines' => $medicineData]);
    }

    public function store(Request $request)
    {
        // Handle store logic here
        return redirect()->back()->with('success', 'Medicine added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Handle update logic here
        return redirect()->back()->with('success', 'Medicine updated successfully!');
    }

    public function destroy($id)
    {
        // Handle delete logic here
        return redirect()->back()->with('success', 'Medicine deleted successfully!');
    }
}