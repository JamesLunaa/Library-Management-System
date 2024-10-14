<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class devController extends Controller
{
    public function devAccess(Request $request) {
        $feedbackData = DB::table('suggfeed')
        ->orderBy('id', 'DESC')
        ->get();

        return view('developer.developer', ['feedbacks' => $feedbackData]);
        
    }
}