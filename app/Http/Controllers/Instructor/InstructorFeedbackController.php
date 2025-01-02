<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Exception;

class InstructorFeedbackController extends Controller
{
    public function sendFeedback(Request $request) {
        if ($request->has('send') && $request->filled('suggFeed')) {
            $feedback = $request->input('suggFeed');
            $userId = session('libId');

            $check = DB::table('suggfeed')
            ->where('userId', $userId)
            ->exists();

            if($check) {
                return redirect()->route('instructor.feedback')->with('error', 'You have reached the limit of submitting a suggestion/feedback today.');
            }else {
                Feedback::create([
                    'info' => $feedback,
                    'userId' => $userId,
                    'date' => now()->toDateString()
                ]);
            
                return redirect()->route('instructor.feedback')->with('success', 'Suggestion/Feedback submitted successfully.');

            }

        }
    }
}