<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    /**
     * Display a listing of the residents.
     */
    public function index()
    {
        $residents = Resident::with('precinct')->latest()->get();
        return view('admin.residents.index', compact('residents'));
    }

    /**
     * Store a newly created resident in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:50',
            'age' => 'nullable|integer|min:0',
            'birthday' => 'nullable|date',
            'civil_status' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'purok' => 'nullable|string|max:100',
            'precinct_id' => 'nullable|exists:precincts,id',
            'religion' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'four_ps_beneficiary' => 'nullable|boolean',
            'pwd_status' => 'nullable|boolean',
            'voter_status' => 'nullable|boolean',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $validated['created_by'] = auth()->id();
        
        $resident = Resident::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Resident added successfully!',
            'resident' => $resident
        ]);
    }

    /**
     * Display the specified resident.
     */
    public function show($id)
    {
        $resident = Resident::with('precinct')->findOrFail($id);
        return response()->json($resident);
    }

    /**
     * Update the specified resident in storage.
     */
    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:50',
            'age' => 'nullable|integer|min:0',
            'birthday' => 'nullable|date',
            'civil_status' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'purok' => 'nullable|string|max:100',
            'precinct_id' => 'nullable|exists:precincts,id',
            'religion' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'four_ps_beneficiary' => 'nullable|boolean',
            'pwd_status' => 'nullable|boolean',
            'voter_status' => 'nullable|boolean',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $resident->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Resident updated successfully!',
            'resident' => $resident
        ]);
    }

    /**
     * Remove the specified resident from storage.
     */
    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect()->route('residents')->with('success', 'Resident deleted successfully!');
    }
}
