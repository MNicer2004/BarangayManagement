<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Resident; // uncomment + swap models to your schema
// use App\Models\Blotter;
// use App\Models\Purok;
// ...

class DashboardController extends Controller
{
    public function index()
    {
        // TODO: replace these with real queries from your tables
        $stats = [
            'population'   => 2,   // Resident::count()
            'male'         => 1,   // Resident::where('sex','male')->count()
            'female'       => 1,   // Resident::where('sex','female')->count()
            'voters'       => 0,   // Resident::where('is_voter',1)->count()
            'non_voters'   => 2,   // Resident::where('is_voter',0)->count()
            'precinct'     => 2,   // Precinct::count()
            'purok'        => 7,   // Purok::count()
            'blotter'      => 1,   // Blotter::count()
            'revenue'      => 250, // Receipt::sum('amount')
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
