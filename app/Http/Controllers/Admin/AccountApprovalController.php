<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountApprovalController extends Controller
{
    public function index()
    {
        // Check if user is captain
        if (!Auth::user()->isCaptain()) {
            abort(403, 'Access denied. Only Barangay Captain can access this page.');
        }
        $pendingUsers = User::where('approval_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedUsers = User::where('approval_status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        $rejectedUsers = User::where('approval_status', 'rejected')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.account-approvals', compact('pendingUsers', 'approvedUsers', 'rejectedUsers'));
    }

    public function approve(User $user)
    {
        // Check if user is captain
        if (!Auth::user()->isCaptain()) {
            abort(403, 'Access denied. Only Barangay Captain can access this page.');
        }

        if ($user->approval_status === 'pending') {
            $user->update(['approval_status' => 'approved']);
            return redirect()->route('admin.account-approvals')
                ->with('success', "Account for {$user->name} has been approved.");
        }

        return redirect()->route('admin.account-approvals')
            ->with('error', 'This account cannot be approved.');
    }

    public function reject(User $user)
    {
        // Check if user is captain
        if (!Auth::user()->isCaptain()) {
            abort(403, 'Access denied. Only Barangay Captain can access this page.');
        }

        if ($user->approval_status === 'pending') {
            $user->update(['approval_status' => 'rejected']);
            return redirect()->route('admin.account-approvals')
                ->with('success', "Account for {$user->name} has been rejected.");
        }

        return redirect()->route('admin.account-approvals')
            ->with('error', 'This account cannot be rejected.');
    }

    public function delete(User $user)
    {
        // Check if user is captain
        if (!Auth::user()->isCaptain()) {
            abort(403, 'Access denied. Only Barangay Captain can access this page.');
        }

        // Prevent deleting the current captain
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.account-approvals')
                ->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.account-approvals')
            ->with('success', "Account for {$userName} has been permanently deleted.");
    }
}
