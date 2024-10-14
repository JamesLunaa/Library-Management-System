<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{

    public function changePassword(Request $request)
    {

        \Log::info('Change Password Method Hit');
        
        $request->validate([
            'curPass' => 'required',
            'newPass' => 'required|confirmed', // Add validation as needed
        ]);

        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->curPass, $user->pass)) {
            return back()->withErrors(['curPass' => 'Current password is incorrect.']);
        }

        // Update the password
        $user->pass = Hash::make($request->newPass);
        $user->save();

        Auth::logout();

        return redirect('/')->with('success', 'Password changed successfully!');
    }
}