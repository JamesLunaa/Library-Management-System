<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class InstructorRecordController extends Controller
{
    public function userRecord(Request $request) {
        
        if($request->has('search') && $request->filled('info')) {
            $info = $request->input('info');
            $userId = session('libId');

            $userRecord = DB::table('records')
            ->select('name', 'libraryId', 'title', 'accNo',
                    'date', 'borrowedDate', 'return_date',
                    'status', 'remarks')
            ->where('accNo', $info)
            ->where('libraryId', $userId)
            ->limit(10)
            ->get();
        }else {
            $userId = session('libId');

            $userRecord = DB::table('records')
            ->select('name', 'libraryId', 'title', 'accNo',
                    'date', 'borrowedDate', 'return_date',
                    'status', 'remarks')
            ->where('libraryId', $userId)
            ->orderBy('id', 'DESC')
            ->limit(20)
            ->get();
        }
        return view('instructor.instructorRecords', ['recordList' => $userRecord]);
    }
}