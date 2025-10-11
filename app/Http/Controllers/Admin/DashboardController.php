<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\Official;
use App\Models\Blotter;
use App\Models\Purok;
use App\Models\Precinct;
use App\Models\Revenue;

class DashboardController extends Controller
{
    public function index()
    {
        // Count both residents and officials for total population
        $residentCount = Resident::count();
        $officialCount = Official::count();
        
        // Gender counts from both residents and officials
        $residentMale = Resident::where('gender', 'Male')->count();
        $residentFemale = Resident::where('gender', 'Female')->count();
        $officialMale = Official::where('gender', 'Male')->count();
        $officialFemale = Official::where('gender', 'Female')->count();
        
        // Voter counts from both residents and officials
        $residentVoters = Resident::where('voter_status', true)->count();
        $residentNonVoters = Resident::where('voter_status', false)->count();
        $officialVoters = Official::where('voter_status', true)->count();
        $officialNonVoters = Official::where('voter_status', false)->count();

        // Real database queries for dashboard statistics
        $stats = [
            'population'   => $residentCount + $officialCount,
            'male'         => $residentMale + $officialMale,
            'female'       => $residentFemale + $officialFemale,
            'voters'       => $residentVoters + $officialVoters,
            'non_voters'   => $residentNonVoters + $officialNonVoters,
            'precinct'     => Precinct::count(),
            'purok'        => Purok::count(),
            'blotter'      => Blotter::count(),
            'revenue'      => Revenue::where('status', 'completed')->sum('amount'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
