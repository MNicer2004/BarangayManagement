<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purok;
use Illuminate\Http\Request;

class PurokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $puroks = [
            [
                'id' => 1,
                'name' => 'Purok 1',
                'description' => 'Located at the northern part of the barangay',
                'total_households' => 45,
                'total_residents' => 180,
                'total_population' => 180, // Add this for consistency with view
                'leader' => 'Maria Santos',
                'contact' => '09123456789'
            ],
            [
                'id' => 2,
                'name' => 'Purok 2', 
                'description' => 'Central area near the barangay hall',
                'total_households' => 38,
                'total_residents' => 152,
                'total_population' => 152, // Add this for consistency with view
                'leader' => 'Juan Dela Cruz',
                'contact' => '09987654321'
            ],
            [
                'id' => 3,
                'name' => 'Purok 3',
                'description' => 'Eastern section near the main road',
                'total_households' => 52,
                'total_residents' => 208,
                'total_population' => 208, // Add this for consistency with view
                'leader' => 'Rosa Garcia',
                'contact' => '09876543210'
            ],
            [
                'id' => 4,
                'name' => 'Purok 4',
                'description' => 'Southern area close to the river',
                'total_households' => 41,
                'total_residents' => 164,
                'total_population' => 164, // Add this for consistency with view
                'leader' => 'Pedro Martinez',
                'contact' => '09765432109'
            ]
        ];

        // Calculate totals for the statistics cards
        $totals = [
            'total_population' => collect($puroks)->sum('total_residents'),
            'total_households' => collect($puroks)->sum('total_households'),
            'total_children' => 145, // Sample data - can be calculated from actual data
            'total_senior_citizens' => 78 // Sample data - can be calculated from actual data
        ];

        return view('admin.purok.index', compact('puroks', 'totals'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Sample data for purok details
        $puroks = [
            1 => [
                'id' => 1,
                'name' => 'Purok 1',
                'description' => 'Located at the northern part of the barangay',
                'total_households' => 45,
                'total_residents' => 180,
                'total_population' => 180,
                'registered_voters' => 98,
                'children_0_12' => 35,
                'minors_13_17' => 22,
                'adults_18_59' => 105,
                'senior_citizens' => 18,
                'pwd_count' => 3,
                'leader' => 'Maria Santos',
                'contact' => '09123456789'
            ],
            2 => [
                'id' => 2,
                'name' => 'Purok 2', 
                'description' => 'Central area near the barangay hall',
                'total_households' => 38,
                'total_residents' => 152,
                'total_population' => 152,
                'registered_voters' => 82,
                'children_0_12' => 28,
                'minors_13_17' => 18,
                'adults_18_59' => 92,
                'senior_citizens' => 14,
                'pwd_count' => 2,
                'leader' => 'Juan Dela Cruz',
                'contact' => '09987654321'
            ],
            3 => [
                'id' => 3,
                'name' => 'Purok 3',
                'description' => 'Eastern section near the main road',
                'total_households' => 52,
                'total_residents' => 208,
                'total_population' => 208,
                'registered_voters' => 125,
                'children_0_12' => 42,
                'minors_13_17' => 31,
                'adults_18_59' => 112,
                'senior_citizens' => 23,
                'pwd_count' => 4,
                'leader' => 'Rosa Garcia',
                'contact' => '09876543210'
            ],
            4 => [
                'id' => 4,
                'name' => 'Purok 4',
                'description' => 'Southern area close to the river',
                'total_households' => 41,
                'total_residents' => 164,
                'total_population' => 164,
                'registered_voters' => 89,
                'children_0_12' => 32,
                'minors_13_17' => 24,
                'adults_18_59' => 88,
                'senior_citizens' => 20,
                'pwd_count' => 1,
                'leader' => 'Pedro Martinez',
                'contact' => '09765432109'
            ]
        ];

        $purok = $puroks[$id] ?? abort(404);

        return view('admin.purok.show', compact('purok'));
    }
}