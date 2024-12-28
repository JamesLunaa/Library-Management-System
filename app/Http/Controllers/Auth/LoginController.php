<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon; // To handle dates

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request input
        $request->validate([
            'libraryId' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log in using either libraryId or name, and password
        $credentials = [
            'libraryId' => $request->input('libraryId'),
            'password' => $request->input('password')
        ];

        // Try using libraryId, if not found, fall back to name
        if (!Auth::attempt($credentials)) {
            $credentials = [
                'name' => $request->input('libraryId'),
                'password' => $request->input('password')
            ];
            if (!Auth::attempt($credentials)) {
                // If both attempts fail, return error
                return redirect()->back()->withErrors(['login' => 'Login Failed, Please Check your Login Credentials']);
            }
        }

        // Successful login, get the authenticated user
        $user = Auth::user();

        // Store the user info in session
        session(['user' => $user->name, 'libId' => $user->libraryId]);

        // Log attendance if user is a regular user
        if ($user->accLevel === 'user') {
            $this->logAttendance($user);
            return redirect()->route('user.rules'); // Redirect to user dashboard
        }

        // Redirect based on account level for non-regular users
        switch ($user->accLevel) {
            case 'developer':
                return redirect()->route('developer.feedback');
            case 'librarian':
                return redirect()->route('admin.searchBook');
            case 'Instructor':
                return redirect()->route('instructor.rules');
            default:
                return redirect()->back()->withErrors(['login' => 'Unknown account level. Please contact the administrator.']);
        }
    }

    // Function to log attendance
    protected function logAttendance(User $user)
    {
        $todayDate = Carbon::today()->toDateString(); // Get today's date in 'YYYY-MM-DD' format

        // Check if the user already has an attendance record for today
        $attendance = Attendance::where('libraryId', $user->libraryId)
            ->whereDate('date', $todayDate)
            ->first();

        if (!$attendance) {
            // Insert new attendance record if not already logged
            Attendance::create([
                'name' => $user->name,
                'libraryId' => $user->libraryId,
                'date' => $todayDate,
            ]);
        }
    }
}