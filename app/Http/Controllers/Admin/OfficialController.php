<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Official;
use App\Models\Precinct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = Official::with(['creator', 'precinct'])->latest()->get();
        $precincts = Precinct::all();
        return view('admin.officials.index', compact('officials', 'precincts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:officials,national_id',
            'age' => 'required|integer|min:18|max:100',
            'birthday' => 'required|date',
            'civil_status' => 'required|in:Single,Married,Widowed,Divorced,Separated',
            'gender' => 'required|in:Male,Female',
            'purok' => 'required|string',
            'precinct_id' => 'nullable|exists:precincts,id',
            'religion' => 'required|string',
            'occupation' => 'required|string',
            'position' => 'required|string',
            'chairmanship' => 'nullable|string',
            'four_ps_beneficiary' => 'boolean',
            'pwd_status' => 'boolean',
            'voter_status' => 'boolean',
            'contact_number' => 'nullable|string',
            'email' => 'nullable|email',
            'status' => 'in:Active,Inactive',
        ]);

        $official = Official::create([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'age' => $request->age,
            'birthday' => $request->birthday,
            'civil_status' => $request->civil_status,
            'gender' => $request->gender,
            'purok' => $request->purok,
            'precinct_id' => $request->precinct_id,
            'religion' => $request->religion,
            'occupation' => $request->occupation,
            'position' => $request->position,
            'chairmanship' => $request->chairmanship,
            'four_ps_beneficiary' => $request->boolean('four_ps_beneficiary'),
            'pwd_status' => $request->boolean('pwd_status'),
            'voter_status' => $request->boolean('voter_status'),
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'status' => $request->status ?? 'Active',
            'created_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Official added successfully!',
            'official' => $official->load(['creator', 'precinct'])
        ]);
    }

    public function update(Request $request, Official $official)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:officials,national_id,' . $official->id,
            'age' => 'required|integer|min:18|max:100',
            'birthday' => 'required|date',
            'civil_status' => 'required|in:Single,Married,Widowed,Divorced,Separated',
            'gender' => 'required|in:Male,Female',
            'purok' => 'required|string',
            'precinct_id' => 'nullable|exists:precincts,id',
            'religion' => 'required|string',
            'occupation' => 'required|string',
            'position' => 'required|string',
            'chairmanship' => 'nullable|string',
            'four_ps_beneficiary' => 'boolean',
            'pwd_status' => 'boolean',
            'voter_status' => 'boolean',
            'contact_number' => 'nullable|string',
            'email' => 'nullable|email',
            'status' => 'in:Active,Inactive',
        ]);

        $official->update([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'age' => $request->age,
            'birthday' => $request->birthday,
            'civil_status' => $request->civil_status,
            'gender' => $request->gender,
            'purok' => $request->purok,
            'precinct_id' => $request->precinct_id,
            'religion' => $request->religion,
            'occupation' => $request->occupation,
            'position' => $request->position,
            'chairmanship' => $request->chairmanship,
            'four_ps_beneficiary' => $request->boolean('four_ps_beneficiary'),
            'pwd_status' => $request->boolean('pwd_status'),
            'voter_status' => $request->boolean('voter_status'),
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'status' => $request->status ?? 'Active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Official updated successfully!',
            'official' => $official->load(['creator', 'precinct'])
        ]);
    }

    public function show(Official $official)
    {
        return response()->json($official);
    }

    public function destroy(Official $official)
    {
        $official->delete();

        return response()->json([
            'success' => true,
            'message' => 'Official deleted successfully!'
        ]);
    }
}
