<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Check if user is approved
        if (!Auth::user()->isApproved()) {
            Auth::logout();
            
            return redirect()->route('public.auth')
                ->withErrors(['email' => 'Your account is pending approval by the barangay captain. You will receive an email confirmation once approved.']);
        }

        return redirect()->intended('/admin/dashboard');
    }
}
